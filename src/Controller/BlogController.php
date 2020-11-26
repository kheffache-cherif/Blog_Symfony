<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
     * @Route("/blog/new", name="blog_createArticle")
     * @Route("/blog/{id}/edit",name="blog_blog_edit")  //pour la mise à jour de l'article
     */
        //confusion entre new et {id} c'est por ce la on remonte cette fonction avant 
    //public function createArticle(Request $request,EntityManagerInterface  $manager){
        public function form(Article $article = null,
         Request $request,EntityManagerInterface  $manager){
             if(!$article){
        $article = new Article();
             }

       /* $form = $this->createFormBuilder($article)  //creer un formulaire
                     ->add('title')
                     ->add('content')
                     ->add('image')
                     //->add('save',SubmitType::class,['label' =>'Enregister'] )
                     ->getForm();*//*   creation d'un formulaire via terminal*/ 

        $form = $this->createForm(ArticleType::class, $article);
            //gestion donner formulaire
        $form->handleRequest($request);// demander au formulaire d'analyser la requete
           // dump($article); 
           //si le formulaire est soumis et si il est valide
           if($form->isSubmitted() && $form->isValid()) {
               if(!$article->getId()){
                     // si mon article existe pas de date // si il a un id donc il existe
               $article->setceatedAt(new \ DateTime());

               }
               $manager->persist($article);  // demander au manager de l'enregister dans la base de donner
               $manager->flush();
               return $this->redirectToRoute('blog_show',['id' =>$article->getId()]);  //faire une redirection vert la page
           }

        return $this->render('blog/createArticle.html.twig',[
               'formArticle' => $form->createView(),
               'editMode' => $article->getId()  !==null  //si id est vide    
    ]);
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
