<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 09.08.17
 * Time: 15:48
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Test;
use AppBundle\Form\SetType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SetController extends Controller
{
    /**
     * @Route("/test/new", name="test_new")
     */
    public function newAction(Request $request)
    {
        $test = new Test();
        $form = $this->createForm(SetType::class, $test);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->getDoctrine()->getManager()->persist($test);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('homepage');
        }

        return $this->render(':SetTests:new_test.html.twig', [
            'form' => $form->createView()
        ]);
    }
}