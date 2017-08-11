<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 04.08.17
 * Time: 12:53
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Uses")
 */
class Uses
{
    /**
     * @var string
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $mark;

    /**
     * @ORM\ManyToOne(targetEntity="Test", inversedBy="test")
     */
    private $test;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="user")
     */
    private $user;




    /**
     * Set date
     *
     * @param string $date
     *
     * @return Uses
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set mark
     *
     * @param integer $mark
     *
     * @return Uses
     */
    public function setMark($mark)
    {
        $this->mark = $mark;

        return $this;
    }

    /**
     * Get mark
     *
     * @return integer
     */
    public function getMark()
    {
        return $this->mark;
    }

    /**
     * Set test
     *
     * @param \AppBundle\Entity\Test $test
     *
     * @return Uses
     */
    public function setTest(\AppBundle\Entity\Test $test = null)
    {
        $this->test = $test;

        return $this;
    }

    /**
     * Get test
     *
     * @return \AppBundle\Entity\Test
     */
    public function getTest()
    {
        return $this->test;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Uses
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
