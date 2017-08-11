<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 04.08.17
 * Time: 11:43
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Answer")
 */
class Answer
{
    /**
     * @ORM\ManyToOne(targetEntity="Question", inversedBy="answers")
     */
    private $questions;

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
     * Set questions
     *
     * @param \AppBundle\Entity\Question $questions
     *
     * @return Answer
     */
    public function setQuestions(\AppBundle\Entity\Question $questions = null)
    {
        $this->questions = $questions;

        return $this;
    }

    /**
     * Get questions
     *
     * @return \AppBundle\Entity\Question
     */
    public function getQuestions()
    {
        return $this->questions;
    }
}
