<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Post
 *
 * @ORM\Table(name="posts")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PostRepository")
 * @Gedmo\Loggable(logEntryClass="AppBundle\Entity\Log")
 */
class Post
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
     * @var string
     * @Assert\NotBlank(message="Le titre ne peut être vide")
     * @ORM\Column(name="title", type="string", length=80)
     * @Gedmo\Versioned()
     */
    private $title;

    /**
     * @var string
     * @Assert\NotBlank(message="Le texte ne peut être vide")
     * @ORM\Column(name="post_text", type="text")
     * @Gedmo\Versioned()
     */
    private $text;

    /**
     * @var string
     * @ORM\Column(name="slug", type="text", nullable=true)
     * @Gedmo\Slug(fields={"title", "createdAt"})
     */
    private $slug;

    /**
     * @var Author
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Author", inversedBy="posts")
     */
    private $author;

    /**
     * @var Theme
     *
     * @ORM\ManyToOne(targetEntity="Theme", inversedBy="posts")
     */
    private $theme;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Answer", mappedBy="post")
     */
    private $answers;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->answers = new ArrayCollection();
    }


    /**
     * @return string
     */
    public function getAuthorFullName()
    {
        return $this->author->getFirstName() . " " . $this->author->getName();
    }

    /**
     * @return Author
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param Author $author
     * @return Post
     */
    public function setAuthor(Author $author)
    {
        $this->author = $author;

        return $this;
    }


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set text
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
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set createdAt
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
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }



    /**
     * Set theme
     *
     * @param \AppBundle\Entity\Theme $theme
     *
     * @return Post
     */
    public function setTheme(Theme $theme = null)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return \AppBundle\Entity\Theme
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Add answer
     *
     * @param \AppBundle\Entity\Answer $answer
     *
     * @return Post
     */
    public function addAnswer(Answer $answer)
    {
        $this->answers[] = $answer;

        return $this;
    }

    /**
     * Remove answer
     *
     * @param \AppBundle\Entity\Answer $answer
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
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     * @return Post
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }


}
