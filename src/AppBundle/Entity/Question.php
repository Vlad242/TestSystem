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
use AppBundle\Entity\Answer;
use AppBundle\Entity\SetAnswer;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\QuestionRepository")
 * @ORM\Table(name="Question")
 */
class Question
{
    /**
     * @ORM\OneToMany(targetEntity="Answer", mappedBy="question")
     */
    private $answers;

    /**
     * @ORM\OneToMany(targetEntity="SetAnswer", mappedBy="question")
     */
    private $setAnswers;

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
     * Constructor
     */
    public function __construct()
    {
        $this->answers = new ArrayCollection();
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
     * @return Question
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
     * Add answer
     *
     * @param Answer $answer
     *
     * @return Question
     */
    public function addAnswer(Answer $answer)
    {
        $this->answers[] = $answer;

        return $this;
    }

    /**
     * Remove answer
     *
     * @param Answer $answer
     */
    public function removeAnswer(Answer $answer)
    {
        $this->answers->removeElement($answer);
    }

    /**
     * Get answers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * Add setAnswer
     *
     * @param SetAnswer $setAnswer
     *
     * @return Question
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
}
