<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 04.08.17
 * Time: 11:43
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\SetAnswer;
use AppBundle\Entity\Question;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AnswerRepository")
 * @ORM\Table(name="Answer")
 */
class Answer
{
    /**
     * @ORM\OneToMany(targetEntity="SetAnswer", mappedBy="answer")
     */
    private $setAnswers;

    /**
     * @ORM\ManyToOne(targetEntity="Question", inversedBy="answers")
     */
    private $question;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    private $truth;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setAnswers = new ArrayCollection();
    }

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
     * Set name
     *
     * @param string $name
     *
     * @return Answer
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set truth
     *
     * @param boolean $truth
     *
     * @return Answer
     */
    public function setTruth($truth)
    {
        $this->truth = $truth;

        return $this;
    }

    /**
     * Get truth
     *
     * @return boolean
     */
    public function getTruth()
    {
        return $this->truth;
    }

    /**
     * Add setAnswer
     *
     * @param SetAnswer $setAnswer
     *
     * @return Answer
     */
    public function addSetAnswer(SetAnswer $setAnswer)
    {
        $this->setAnswers[] = $setAnswer;

        return $this;
    }

    /**
     * Remove setAnswer
     *
     * @param SetAnswer $setAnswer
     */
    public function removeSetAnswer(SetAnswer $setAnswer)
    {
        $this->setAnswers->removeElement($setAnswer);
    }

    /**
     * Get setAnswers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSetAnswers()
    {
        return $this->setAnswers;
    }

    /**
     * Set question
     *
     * @param Question $question
     *
     * @return Answer
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
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
}
