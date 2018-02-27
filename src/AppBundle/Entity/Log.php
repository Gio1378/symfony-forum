<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 27/02/2018
 * Time: 12:59
 */

namespace AppBundle\Entity;


use Gedmo\Loggable\Entity\MappedSuperclass\AbstractLogEntry;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Log
 * @package AppBundle\Entity
 * @ORM\Table(name="logs")
 * @ORM\Entity(repositoryClass="Gedmo\Loggable\Entity\Repository\LogEntryRepository")
 */
class Log extends AbstractLogEntry
{

}