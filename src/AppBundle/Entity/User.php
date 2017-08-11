<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 04.08.17
 * Time: 11:43
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="User")
 */
class User implements AdvancedUserInterface
{
    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_USER = 'ROLE_USER';

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
     * @Assert\NotBlank(message="User's name should not be blank.")
     * @Assert\Length(max="100")
     * @Assert\Regex("/^[-a-zA-Z0-9_ \s]+$/", message="The name must contain only letters, digits, space, underscore and hyphen.")
     * @ORM\Column(type="string", length=191)
     */
    private $name;

    /**
     * @var string
     *
     * @Assert\NotBlank(message="Username should not be blank.")
     * @Assert\Length(max="30")
     * @Assert\Regex("/^[-a-zA-Z0-9_\s]+$/", message="Username must contain only letters, digits, underscore and hyphen.")
     * @ORM\Column(type="string", length=30, unique=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=191)
     */
    private $password;

    /**
     * @var string
     *
     * @Assert\NotBlank(message="Password should not be blank.")
     */
    private $plainPassword;

    /**
     * @var string
     *
     * @Assert\NotNull(message="Role should not be blank.")
     * @ORM\Column(type="string", length=191)
     */
    private $role;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", options={"default" = false})
     */
    protected $locked;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=true, options={"default" = true})
     */
    protected $enabled;

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
     * @return User
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
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * {@inheritdoc}
     */
    public function eraseCredentials()
    {
        $this->setPlainPassword(null);
    }

    /**
     * @return bool
     */
    public function isAccountNonExpired()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function isAccountNonLocked()
    {
        return !$this->isLocked();
    }

    /**
     * @return bool
     */
    public function isCredentialsNonExpired()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    /**
     * @return bool
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * @return boolean
     */
    public function isLocked()
    {
        return $this->locked;
    }

    /**
     * @return boolean
     */
    public function getLocked()
    {
        return $this->locked;
    }

    /**
     * @param boolean $locked
     */
    public function setLocked($locked)
    {
        $this->locked = $locked;
    }

    public function getRoles()
    {
        return [
            $this->getRole()
        ];
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Set role
     *
     * @param string $role
     *
     * @return User
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    private function setPlainPassword($pass)
    {
        $this->plainPassword = $pass;
    }

    /**
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }
}
