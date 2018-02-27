<?php


namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Author;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class AuthorFixture extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {

        $password = password_hash("123", PASSWORD_BCRYPT);

        $author = new Author();
        $author->setName("Hugo")
            ->setFirstName("Victor")
            ->setEmail("v.hugo@miserable.fr")
            ->setPassword($password);

        $this->addReference("auteur_1", $author);
        $manager->persist($author);

        $author = new Author();
        $author->setName("Ducasse")
            ->setFirstName("Isidore")
            ->setEmail("lautreamont@maldoror.com")
            ->setPassword($password);

        $this->addReference("auteur_2", $author);
        $manager->persist($author);

        $author = new Author();
        $author->setName("Trump")
            ->setFirstName("Donald")
            ->setEmail("president@moron.con")
            ->setPassword($password);

        $this->addReference("auteur_3", $author);
        $manager->persist($author);

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 2;
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}