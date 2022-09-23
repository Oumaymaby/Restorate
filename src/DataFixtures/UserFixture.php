<?php

namespace App\DataFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixture extends Fixture
{
    /**
    * @var PasswordService <========
    */
    private $passwordEncoder;

    public function __construct(UserPasswordHasherInterface $passwordEncoder){

        $this->passwordEncoder=$passwordEncoder;
    }
    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create('fr_FR');

        
        
        for ($i = 0; $i <9; $i++)
        {
            $user = new User;
            $user->setUsername($faker->userName);
            $user->setFirstname($faker->firstName);
            $user->setLastname($faker->lastName);
            $user->setRoles(array('Client'));

            $user->setPassword(
                $this->passwordEncoder->encodepassword($user,'client')
            );
            $manager->persist($user);
        }

        for ($i = 0; $i < 10; $i++)
        {
            
            $user = new User;

            $test_password = 'test';

            $user->setUsername($faker->userName);
            $user->setFirstname($faker->firstName);
            $user->setLastname($faker->lastName);
            $user->setRoles(array('Restaurateur'));
            $user->setPassword(
                $this->passwordEncoder->encodepassword($user,'resto')
            );
            $manager->persist($user);
        }
        $manager->flush();
    }
}
