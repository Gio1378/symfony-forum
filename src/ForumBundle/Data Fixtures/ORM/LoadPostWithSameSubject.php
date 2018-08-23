<?php

namespace ForumBundle\DataFixtures\ORM;

use ForumBundle\Entity\Post;
use ForumBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

/**
 * Class LoadPostWithSameSubject
 * @package ForumBundle\DataFixture\ORM
 */
class LoadPostWithSameSubject extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with th passed EntityManager
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {

        $faker = Factory::create();
        $numberOfPosts = 150;

        for ($i = 0; $i < $numberOfPosts; $i++) {

            $numberOfAnswers = mt_rand(0, 20);

            for ($k = 0; $k < $numberOfAnswers; $k++) {
                /**
                 * @var Post
                 */
                $user = $this->getReference("user_$i");
                $subpost= $this->getReference("post_$i");

                $publishedAt = $subpost->getCreatedAt();
                $subpostDate = $publishedAt->add(new \DateInterval("P".mt_rand(0,30)."D"));
                $subpost = new Post();
                $subpost->setSubject($subpost);
                $subpost->setText($faker->text(200))
                    ->setUser($user)
                    ->setCreatedAt($subpostDate);


                $manager->persist($subpost);
            }

            $manager->flush();
        }

    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 20;
    }
}