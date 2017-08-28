<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\User_newType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @param UserInterface $user
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function indexAction(UserInterface $user)
    {
       // var_dump($user->getRoles());
        $userRole = $user->getRoles();
        if ($userRole[0] == 'ROLE_ADMIN'){
            return $this->redirectToRoute('admin_room');
        }else{
            return $this->redirectToRoute('user_room');
        }
    }

    /**
     * @Route("/login", name="login")
     * @param AuthenticationUtils $authenticationUtils
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loginAction(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
            ':Default:login.html.twig',
            array(
                'last_username' => $lastUsername,
                'error'         => $error,
            )
        );
    }

    /**
     * @Route("/login_check", name="login_check")
     */
    public function loginCheckAction()
    {

    }

    /**
     * @Route("/register", name="register")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user= new User();
        $form = $this->createForm(User_newType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $user->setRole("ROLE_USER");
            $user->setLocked(false);
            $user->setEnabled(true);
            $this->getDoctrine()->getManager()->persist($user);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('login');
        }

        return $this->render(':User:new_user.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
