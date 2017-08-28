<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class AdminController extends Controller
{
    /**
     * @Route("/admin/room", name="admin_room")
     * @param UserInterface $user
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(UserInterface $user)
    {
        return $this->render('Admin/AdminRoom.html.twig', ['username' => $user->getUsername()]);
    }
}
