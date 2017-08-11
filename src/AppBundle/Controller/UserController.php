<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\User_newType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends Controller
{
    /**
     * @Route("/user/new/", name="user_new")
     */
    public function newAction(Request $request)
    {
        $user= new User();
        $form = $this->createForm(User_newType::class, $user);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->getDoctrine()->getManager()->persist($user);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('login');
        }

        return $this->render(':User:new_user.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
