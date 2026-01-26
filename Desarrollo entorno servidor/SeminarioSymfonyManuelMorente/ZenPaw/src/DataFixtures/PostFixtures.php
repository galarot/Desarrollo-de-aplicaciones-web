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
        $post1->setTitle('post1');
        $post1->setSlug('buenos dias');
        $post1->setSummary('No se, hola');
        $post1->setContent("Tamales de ciruela");
        $post1->setPublishedAt(new \DateTimeImmutable());
        $manager->persist($post1);

        $post2 = new Post();
        $post2->setTitle('post2');
        $post2->setSlug('buenas tardes');
        $post2->setSummary('Tampoco se, adios');
        $post2->setContent("Lapida de terracota");
        $post2->setPublishedAt(new \DateTimeImmutable());
        $manager->persist($post2);

        $manager->flush();
    }
}

