<?php

namespace ForumBundle\DataFixtures\ORM;

use ForumBundle\Entity\Post;
use ForumBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

/**
 * Class LoadThemesPostsUsers
 * @package ForumBundle\DataFixture\ORM
 */
class LoadThemesPostsUsers extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with th passed EntityManager
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {

        $faker = Factory::create();

        $emailList = array(
            "user1@mail.com",
            "user2@mail.com",
            "user3@mail.com",
            "user4@mail.com",
            "user5@mail.com",
            "user6@mail.com",
            "user7@mail.com",
            "user8@mail.com",
            "user9@mail.com",
            "user10@mail.com",
            "user11@mail.com",
            "user12@mail.com",
            "user13@mail.com",
            "user14@mail.com",
            "user15@mail.com",
            "user16@mail.com",

        );

        $users = array();

        $numberOfPosts = 150;

        for ($i = 0; $i < count($emailList); $i++) {
            $users[] = new User();
            $users[$i]->setName($faker->lastName)
                ->setFirstName($faker->firstName)
                ->setPseudo($faker->userName)
                ->setEmail($emailList[$i])
                ->setPassword(sha1('123'));

            $manager->persist($users[$i]);
        }
        for ($i = 0; $i < $numberOfPosts; $i++) {
            $post = new Post();
            $post->setSubject($faker->sentence)
                ->setText($faker->text(2500))
                ->setUser($users[mt_rand(0, count($users) - 1)])
                ->setCreatedAt($faker->dateTimeThisDecade());

            $this->setReference("user_$i", $post);
            $this->setReference("theme_$i", $post);

            $manager->persist($post);
        }

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 1;
    }
}