<?php
/**
 * Created by PhpStorm.
 * User: GiO
 * Date: 23/08/2018
 * Time: 11:16
 */

namespace ForumBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class User
 * @package ForumBundle\Entity
 * @ORM\Entity(repositoryClass="ForumBundle\Repository\UserRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class User
{
    /**
     * @var ArrayCollection
     * @ORM\OneToMany(
     *     targetEntity="Post",
     *     mappedBy="user")
     *
     */
    private $posts;

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id() -----------------> Pour désigner la clé primaire
     * @ORM\GeneratedValue() -----> Pour auto-incrément de l'attribut
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank(message="Le nom ne peut être vide")
     * @ORM\Column(name="name", type="string", nullable=false, length=50)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(name="first_name", type="string", nullable=true, length=50)
     */
    private $firstName;

    /**
     * @var string
     * @ORM\Column(name="pseudo", type="string", nullable=true, length=50)
     */
    private $pseudo;

    /**
     * @var
     * @ORM\Column(name="email", type="string", nullable=false, length=50, unique=true)
     */
    private $email;
    /**
     * @var string
     * @ORM\Column(name="password", type="string", length=128)
     */
    private $password;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
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
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set firstName.
     *
     * @param string|null $firstName
     *
     * @return User
     */
    public function setFirstName($firstName = null)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName.
     *
     * @return string|null
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set pseudo.
     *
     * @param string|null $pseudo
     *
     * @return User
     */
    public function setPseudo($pseudo = null)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get pseudo.
     *
     * @return string|null
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password.
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
     * Get password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Add post.
     *
     * @param \ForumBundle\Entity\Post $post
     *
     * @return User
     */
    public function addPost(\ForumBundle\Entity\Post $post)
    {
        $this->posts[] = $post;

        return $this;
    }

    /**
     * Remove post.
     *
     * @param \ForumBundle\Entity\Post $post
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removePost(\ForumBundle\Entity\Post $post)
    {
        return $this->posts->removeElement($post);
    }

    /**
     * Get posts.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPosts()
    {
        return $this->posts;
    }
}
