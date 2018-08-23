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
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="subject", type="string", nullable=false, length=250)
     */
    private $subject;

    /**
     * @var \DateTime
     * @ORM\Column(name="createad_at", type="datetime", nullable=false)
     */
    private $createadAt;

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
     * Set createadAt.
     *
     * @param \DateTime $createadAt
     *
     * @return Post
     */
    public function setCreateadAt($createadAt)
    {
        $this->createadAt = $createadAt;

        return $this;
    }

    /**
     * Get createadAt.
     *
     * @return \DateTime
     */
    public function getCreateadAt()
    {
        return $this->createadAt;
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
}