<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController  // ma classe herite de cotroller de php
{
    /**
     * @Route("/blog", name="blog")      //@ anotation route. quant un site appelle mon site ...../cherif execute cette fonction index
     */
    public function index(ArticleRepository $repo): Response  // fonction public

    {
       // $repo = $this->getDoctrine()->getRepository(Article::class);

        $article =$repo->findAll(); //('Titre de l\'Article' );

        return $this->render('blog/index.html.twig', [  //tu renvoies le fichier.index.html qui see trouve dans blog  synfony sais qu'il est dans template
            'controller_name' => 'BlogController',
            'articles' =>$article
        ]);
    }
    /**
     * @Route("/", name="home")   lier la fonction à une adresse
     */
     public function home(){  //page d'acceul du site 
             return $this->render('blog/home.html.twig');  // this.... pour appelé le fichier à afficher
     }

      /**
     * @Route("/blog/{id}",name="blog_show")   lier la fonction à une adresse
     */
     //public function show(ArticleRepository $repo,$id){
         //$repo =$this->getDoctrine()->getRepository(Article::class);
         //$article = $repo->find($id);/**les deux ligne pour trouver l'import quel article */
         public function show(Article $article){
         return $this->render('blog/show.html.twig',[
            'article'=> $article
        ]);
     }


}
