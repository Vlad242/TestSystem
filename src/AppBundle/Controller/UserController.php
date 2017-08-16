<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class UserController extends Controller
{
    /**
     * @Route("/User/Room", name="User_room")
     */
    public function indexAction(UserInterface $user)
    {
       return $this->render('User/UserRoom.html.twig', ['username' => $user->getUsername()]);
    }
}
