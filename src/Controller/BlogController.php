<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController  // ma classe herite de cotroller de php
{
    /**
     * @Route("/blog", name="blog")      //@ anotation route. quant un site appelle mon site ...../cherif execute cette fonction index
     */
    public function index(): Response  // fonction public

    {
        return $this->render('blog/index.html.twig', [  //tu renvoies le fichier.index.html qui see trouve dans blog  synfony sais qu'il est dans template
            'controller_name' => 'BlogController',
        ]);
    }
    /**
     * @Route("/", name="home")   lier la fonction à une adresse
     */
     public function home(){  //page d'acceul du site 
             return $this->render('blog/home.html.twig');  // this.... pour appelé le fichier à afficher
     }

      /**
     * @Route("/blog/article/12",name="blog_show")   lier la fonction à une adresse
     */
     public function show(){
        return $this->render('blog/show.html.twig');
     }


}
