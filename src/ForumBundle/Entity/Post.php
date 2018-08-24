<?php
/**
 * Created by PhpStorm.
 * User: GiO
 * Date: 23/08/2018
 * Time: 11:15
 */

namespace ForumBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ForumBundle\Entity\Theme;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Post
 * @package ForumBundle\Entity
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="ForumBundle\Repository\PostRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Post
{

    /**
     * @var Theme
     * @ORM\ManyToOne(targetEntity="Theme")
     */
    private $theme;

    /**
     * @var user
     * @ORM\ManyToOne(targetEntity="User",
     *     inversedBy="posts")
     */
    private $user;

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="subject", type="string", length=250)
     */
    private $subject;

    /**
     * @var Post
     * @ORM\ManyToOne(targetEntity="Post",
     *     inversedBy="answers")
     */
    private $subPost;

    /**
     * @var arrayCollection
     * @ORM\OneToMany(targetEntity="Post",
     *     mappedBy="subPost")
     */
    private $answers;

    /**
     * @var \DateTime
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var string
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $text;

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
     * Set subject.
     *
     * @param string $subject
     *
     * @return Post
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject.
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set answers.
     *
     * @param string $answers
     *
     * @return Post
     */
    public function setAnswers($answers)
    {
        $this->answers = $answers;

        return $this;
    }

    /**
     * Get answers.
     *
     * @return string
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * Set createdAt.
     *
     * @param \DateTime $createdAt
     *
     * @return Post
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt.
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set text.
     *
     * @param string $text
     *
     * @return Post
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text.
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set theme.
     *
     * @param \ForumBundle\Entity\Theme|null $theme
     *
     * @return Post
     */
    public function setTheme(\ForumBundle\Entity\Theme $theme = null)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme.
     *
     * @return \ForumBundle\Entity\Theme|null
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Set user.
     *
     * @param \ForumBundle\Entity\User|null $user
     *
     * @return Post
     */
    public function setUser(\ForumBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return \ForumBundle\Entity\User|null
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set post.
     *
     * @param \ForumBundle\Entity\Post|null $subPost
     *
     * @return Post
     */
    public function setSubPost(\ForumBundle\Entity\Post $subPost = null)
    {
        $this->subPost = $subPost;

        return $this;
    }

    /**
     * Get post.
     *
     * @return \ForumBundle\Entity\Post|null
     */
    public function getSubPost()
    {
        return $this->subPost;
    }

//    /**
//     * @ORM\PrePersist()
//     */
//    public function prePersistEvent(){
//        $this->createdAt = new \DateTime();
//    }

}
