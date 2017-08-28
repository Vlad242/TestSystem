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
use AppBundle\Entity\User;
use AppBundle\Entity\SetAnswer;

/**
 * @ORM\Entity
 * @ORM\Table(name="`Set`")
 */
class Set
{

    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="sets")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="SetAnswer", mappedBy="set", cascade={"persist"})
     */
    private $setAnswers;

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
     * Set user
     *
     * @param User $user
     *
     * @return Set
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add setAnswer
     *
     * @param SetAnswer $setAnswer
     *
     * @return Set
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
