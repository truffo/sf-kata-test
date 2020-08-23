<?php

namespace App\DataFixtures;

use App\Core\Domain\Person\Person;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

class PersonFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $faker->seed(666);
        for ($i=0; $i<=15; $i++) {
            $person = new Person($faker->firstName, $faker->lastName);
            $manager->persist($person);
        }

        $manager->flush();
    }
}
