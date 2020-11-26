<?php

namespace App\DataFixtures;

use App\Entity\Article;// expliquer à php d'ou vient la class article 
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class ArticlesFixtures extends Fixture
{
    public function load(ObjectManager $manager)   // function lod qui va recevoir le manager
    {
        
        for($i = 1; $i <= 10; $i++){
            $article = new Article();
            $article->setTitle("Titre de l' article n°$i")
                    ->setContent("<p> Contenu de l'article n°$i</p>")
                    ->setImage("https://cdn.radiofrance.fr/s3/cruiser-production/2015/09/81ba4279-42b5-454b-a1a8-47053fa7ee28/870x489_fotolia_55910119_subscription_monthly_m.jpg")
                    ->setCeatedAt(new \DateTime()); // date classe est une classe qui fair partie du name space de php
             $manager->persist($article);  ///dire à manager de le persister dan le temp

                }

        $manager->flush();  // la fonction flush balace relement et crer le necessaire 
    }
}