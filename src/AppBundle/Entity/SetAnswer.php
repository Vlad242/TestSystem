<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 04.08.17
 * Time: 11:43
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Answer;
use AppBundle\Entity\Question;
use AppBundle\Entity\Set;

/**
 * @ORM\Entity
 * @ORM\Table(name="SetAnswer")
 */
class SetAnswer
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Answer", inversedBy="setAnswers")
     */
    private $answer;


    /**
     * @ORM\ManyToOne(targetEntity="Question", inversedBy="setAnswers")
     */
    private $question;

    /**
     * @ORM\ManyToOne(targetEntity="Set", inversedBy="setAnswers")
     */
    private $set;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set answer
     *
     * @param Answer $answer
     *
     * @return SetAnswer
     */
    public function setAnswer(Answer $answer = null)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get answer
     *
     * @return Answer
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set question
     *
     * @param Question $question
     *
     * @return SetAnswer
     */
    public function setQuestion(Question $question = null)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return Question
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set set
     *
     * @param Set $set
     *
     * @return SetAnswer
     */
    public function setSet(Set $set = null)
    {
        $this->set = $set;

        return $this;
    }

    /**
     * Get set
     *
     * @return Set
     */
    public function getSet()
    {
        return $this->set;
    }
}
