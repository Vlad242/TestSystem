<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 07.08.17
 * Time: 12:13
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Question;
use AppBundle\Form\QuestionType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class QuestionController extends Controller
{
    /**
     * @Route("/questions/new", name="questions_new")
     */
    public function newAction(Request $request)
    {
        $question = new Question();
        $form = $this->createForm(QuestionType::class, $question);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->getDoctrine()->getManager()->persist($question);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('answers_list', ['id' => $question->getId()]);
        }

        return $this->render('Questions/new_question.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/questions/list", name="questions_list")
     */
    public function listAction()
    {
        $questions = $this->getDoctrine()->getRepository(Question::class)->findAll();

        return $this->render('Questions/Questions_list.html.twig', ['questions' => $questions]);
    }

    /**
     * @Route("/questions/update/{id}", name="question_update")
     */
    public function updateAction(Request $request, Question $id)
    {
        $form = $this->createForm(QuestionType::class, $id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('questions_list');
        }

        return $this->render('Questions/update_question.html.twig', [
            'form1' => $form->createView()
        ]);

    }
}