<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserUpdateType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;

class UserController extends Controller
{
    /**
     * @Route("/user/room", name="user_room")
     * @param UserInterface $user
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(UserInterface $user)
    {
       return $this->render('User/UserRoom.html.twig', ['username' => $user->getUsername()]);
    }

    /**
     * @Route("/user/list", name="user_list")
     */
    public function listAction()
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('User/User_list.html.twig', ['users' => $users]);
    }

    /**
     * @Route("/user/changeEnabled/{user}", name="user_changeEnabled")
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function changeEnabledAction(User $user)
    {
        $us = $this->getDoctrine()->getRepository(User::class)->find($user);
        if ($us->getEnabled() == true){
            $us->setEnabled(false);
        }else{
            $us->setEnabled(true);
        }
        $this->getDoctrine()->getManager()->persist($us);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('user_list');
    }

    /**
     * @Route("/user/changeLocked/{user}", name="user_changeLocked")
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function changeLockedAction(User $user)
    {
        $us = $this->getDoctrine()->getRepository(User::class)->find($user);
        if ($us->getLocked() == true){
            $us->setLocked(false);
        }else{
            $us->setLocked(true);
        }
        $this->getDoctrine()->getManager()->persist($us);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('user_list');
    }

    /**
     * @Route("/user/update/{id}", name="user_update")
     * @param Request $request
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function updateAction(Request $request, User $user)
    {
        $form = $this->createForm(UserUpdateType::class, $user);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('user_list');
        }

        return $this->render(':User:User_update.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
