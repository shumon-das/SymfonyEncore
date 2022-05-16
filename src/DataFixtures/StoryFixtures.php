<?php

namespace App\DataFixtures;

use App\Entity\Story;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Security;

class StoryFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $story = new Story();
        $user = new User();
        $story->setTitle('Covi Book')
              ->setType('small')
              ->setGenre('drama')
              ->setDedication('Dream Team')
              ->setWriter('myself')
              ->setPublish(true)
              ->setCreatedBy(1)
              ->setWritingDate(new \DateTimeImmutable('26-04-2021'))
              ->setCanUpdateAll(false)
              ->setCreatedAt(new \DateTimeImmutable('14-05-2022'))
              ->setContent('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores at aut blanditiis cum delectus, dolorem doloribus eius est expedita illo iste mollitia nihil reiciendis rem repellat rerum tempora veniam voluptatum.')
              ->setAuthor($user->getId())
        ;
        $manager->persist($story);
        $manager->flush();

    }
}