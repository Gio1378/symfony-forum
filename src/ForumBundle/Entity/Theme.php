<?php
/**
 * Created by
 * User: GiO
 * Date: 23/08/2018
 * Time: 10:52
 */
namespace ForumBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use ForumBundle\Entity\Post;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Theme
 * @ORM\Table(name="theme")
 * @ORM\Entity(repositoryClass="ForumBundle\Repository\ThemeRepository")
 * @ORM\HasLifecycleCallbacks()
 * @package ForumBundle\Entity
 */
class Theme {


    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Post",
     *     mappedBy="theme")
     */
    private $posts;

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="title", type="string", nullable=false)
     */
    private $title;



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
     * Constructor
     */
    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return Theme
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Add post.
     *
     * @param \ForumBundle\Entity\Post $post
     *
     * @return Theme
     */
    public function addPost(Post $post)
    {
        $this->posts[] = $post;

        return $this;
    }

    /**
     * Remove post.
     *
     * @param Post $post
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removePost(Post $post)
    {
        return $this->posts->removeElement($post);
    }

    /**
     * Get posts.
     *
     * @return arrayCollection
     */
    public function getPosts()
    {
        return $this->posts;
    }
}
