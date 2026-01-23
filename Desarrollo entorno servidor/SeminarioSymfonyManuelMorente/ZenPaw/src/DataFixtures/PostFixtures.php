<?php

namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PostFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $post1 = new Post();
        $post1->setTitle('Titulo del post1');
        $post1->setSummary('Haciendo cosas en post1');
        $manager->persist($post1);

        $post2 = new Post();
        $post2->setTitle('Titulo del post2');
        $post2->setSummary('Haciendo cosas en post2');
        $manager->persist($post2);

        $manager->flush();
    }
}
