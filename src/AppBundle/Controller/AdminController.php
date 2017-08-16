<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class AdminController extends Controller
{
    /**
     * @Route("/Admin/Room", name="Admin_room")
     */
    public function indexAction(UserInterface $user)
    {
        return $this->render('Admin/AdminRoom.html.twig', ['username' => $user->getUsername()]);
    }
}
