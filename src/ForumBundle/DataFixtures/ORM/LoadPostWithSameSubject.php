<?php

namespace ForumBundle\DataFixtures\ORM;

use ForumBundle\Entity\Post;
use ForumBundle\Entity\Theme;
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
     * @param ObjectManager $manager
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        return null;
        $faker = Factory::create();

        $numberOfPosts = 150;

        for ($i = 0; $i < $numberOfPosts; $i++) {

            $numberOfAnswers = mt_rand(0, 15);

            for ($k = 0; $k < $numberOfAnswers; $k++) {
                /**
                 * @var Post
                 */
                $post = $this->getReference("post_$i");

                /**
                 * @var User
                 */
                $user = $this->getReference("user_" . mt_rand(0, 15));


                $publishedAt = $post->getCreatedAt();
                $subPostDate = $publishedAt->add(new \DateInterval("P" . mt_rand(0, 30) . "D"));
                $subPost = new Post();
                $subPost->setSubject($post->getSubject());
                $subPost->setText($faker->text(200))
                    ->setUser($user)
                    ->setCreatedAt($subPostDate)
                    ->setTheme($post)
                    ->setSubPost($post);

                $manager->persist($subPost);
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