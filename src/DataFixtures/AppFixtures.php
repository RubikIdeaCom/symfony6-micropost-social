<?php

namespace App\DataFixtures;

use App\Entity\MicroPost;
use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $userPasswordHasher)
    {
        
    }

    public function load(ObjectManager $manager): void
    {
        $user1 = new User();
        $user1->setEmail('test@test.com');
        $user1->setPassword(
            $this->userPasswordHasher->hashPassword(
                $user1,
                '123456789'
            )
        );
        $manager->persist($user1);

        $user2 = new User();
        $user2->setEmail('test2@test.com');
        $user2->setPassword(
            $this->userPasswordHasher->hashPassword(
                $user2,
                '123456789'
            )
        );
        $manager->persist($user2);


        $microPost1 = new MicroPost();
        $microPost1->setTitle('Welcome to US!');
        $microPost1->setText('Welcome to US!');
        $microPost1->setCreated(new DateTime());
        $microPost1->setAuthor($user1);
        $manager->persist($microPost1);
        
        $microPost2 = new MicroPost();
        $microPost2->setTitle('Welcome to Germany!');
        $microPost2->setText('Welcome to Germany!');
        $microPost2->setCreated(new DateTime());
        $microPost1->setAuthor($user2);
        $manager->persist($microPost2);

        $manager->flush();
    }
}
