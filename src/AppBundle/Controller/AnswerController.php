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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AnswerController extends Controller
{
    /**
     * @Route("/answers/new/{id}", name="answers_new")
     * @param Request $request
     * @param Question $question
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request, Question $question)
    {
        $answer = new Answer();
        $answer->setQuestion($question);
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
     * @param Question $question
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction(Question $question)
    {
        return $this->render('Answers/Answer_list.html.twig', ['question' => $question]);
    }

    /**
     * @Route("/answers/update/{id}", name="answers_update")
     * @param Request $request
     * @param Answer $answer
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function updateAction(Request $request, Answer $answer)
    {
        $form = $this->createForm(AnswerType::class, $answer);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('answers_list', ['id' => $answer->getQuestion()->getId()]);
        }

        return $this->render('Answers/update_answer.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/delete/{id}", name="answers_delete")
     * @param Answer $answer
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Answer $answer)
    {
        $em = $this->getDoctrine()->getManager();
        $answer = $em->getRepository(Answer::class)->find($answer);
        $em->remove($answer);
        $em->flush();

        return $this->redirectToRoute('answers_list', ['id'=>$answer->getQuestions()->getId()]);
    }
}