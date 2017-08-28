<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Question;
use AppBundle\Entity\Set;
use AppBundle\Entity\SetAnswer;
use AppBundle\Form\SetType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class SetController extends Controller
{
    /**
     * @Route("/user/test", name="user_test")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $set = new Set();
        $set->setUser($this->getUser());

            $questions = $this->getDoctrine()->getRepository(Question::class)->findAll();

            foreach ($questions as $question){
                $setAnswer = new SetAnswer();
                $setAnswer->setQuestion($question);
                $setAnswer->setSet($set);
                $question->addSetAnswer($setAnswer);
                $set->addSetAnswer($setAnswer);
            }

        $form = $this->createForm(SetType::class, $set);
        if($request->getMethod() == 'POST') {

            $form->handleRequest($request);

            if ($form->isValid()) {
                $this->getDoctrine()->getManager()->persist($set);
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('test_results', [
                    'id' => $set->getId()
                ]);
            }

        }

        return $this->render('Questions/QuestionsForUser.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/test/results/{id}", name="test_results")
     * @ParamConverter("set", class="AppBundle:Set")
     * @param Set $set
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getTestResultAction(Set $set)
    {
        return $this->render('Sets/UserResults.html.twig', [
            'set' => $set,
            'trues' => $set->getSetAnswers()->filter(function (SetAnswer $setAnswer) {
                return $setAnswer->getAnswer()->getTruth();
            })->count()
        ]);
    }
}