<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use PharIo\Manifest\Email;
use Faker\Factory;

class UserFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create('fr_FR');
        
        $user = new User();
        $user->setLastname($faker->lastName);
        $user->setFirstname($faker->firstName);
        $user->setUsername($faker->Username);

        $manager->persist($user);
        

        $manager->flush();
    }
}
