<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 08.08.17
 * Time: 10:06
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Answer;
use AppBundle\Entity\Question;
use AppBundle\Form\AnswerType;
use Doctrine\ORM\QueryBuilder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AnswerController extends Controller
{
    /**
     * @Route("/answers/new/{id}", name="answers_new")
     */
    public function newAction(Request $request, Question $question)
    {
        $answer = new Answer();
        $answer->setQuestions($question);
        $form = $this->createForm(AnswerType::class, $answer);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->getDoctrine()->getManager()->persist($answer);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('answers_new', ['id'=> $question->getId()]);
        }

        return $this->render('Answers/new_answer.html.twig', [
            'form' => $form->createView(),
            'question' => $question
        ]);
    }

    /**
     * @Route("/answer/list/{id}", name="answers_list")
     */
    public function listAction(Question $question)
    {
        return $this->render('Answers/Answer_list.html.twig', ['question' => $question]);
    }

    /**
     * @Route("/answers/update/{id}", name="answers_update")
     */
    public function updateAction(Request $request, Answer $answer)
    {
        $form = $this->createForm(AnswerType::class, $answer);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('answers_list', ['id' => $answer->getQuestions()->getId()]);
        }

        return $this->render('Answers/update_answer.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/delete/{id}", name="answers_delete")
     */
    public function deleteAction(Answer $answer)
    {
        $em = $this->getDoctrine()->getManager();
        $answer = $em->getRepository(Answer::class)->find($answer);

        if (!$answer) {
            throw $this->createNotFoundException(
                'No product found for id ' . $answer
            );
        }
        $em->remove($answer);
        $em->flush();

        return $this->redirectToRoute('answers_list', ['id'=>$answer->getQuestions()->getId()]);
    }
}