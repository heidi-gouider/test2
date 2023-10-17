<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Artist; // Import de la classe Artist

class Jeu1 extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $artist1 = new Artist();
        $artist1->setName("Queens Of The Stone Age");
        $artist1->setUrl("https://qotsa.com/");
        
        $manager->persist($artist1);

        $manager->flush();
    }
}
