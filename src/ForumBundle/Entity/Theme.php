<?php
/**
 * Created by
 * User: GiO
 * Date: 23/08/2018
 * Time: 10:52
 */
namespace ForumBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @var ArrayCollection
     * @ORM\ManyToOne()
     */
    private $subjects;



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
     * @param string $subjects
     *
     * @return Theme
     */
    public function setSubject($subjects)
    {
        $this->subjects = $subjects;

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
}
