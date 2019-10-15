<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    /**
     * @Route("/articles", name="articles_liste")
     */
    public function listeArticles(ArticleRepository $repo )
    {
        $articles = $repo->findAll();
        return $this->render('article/index.html.twig', [
            'articles' => $repo->findAll()
        ]);
    }

        /**
     * @Route("/articles/{id}", name="article_affiche")
     */
    public function afficheArticle(Article $article)
    {
        return $this->render('article/afficheArticle.html.twig', [
            'article' => $article
        ]);
    }

    /**
     * Tableau liste articles
     * 
     * @Route("/admin", name="articles_admin")
     * 
     */
    public function TableauArticles(ArticleRepository $repo)
    {
        $articles = $repo->findAll();
        return $this->render('article/tableau.html.twig', [
            'articles' => $articles
        ]);
    }

    /**
     * Creer un article  
     * 
     * @Route("/admin/add", name="admin_create")
     * 
     * @return Response
     */
    public function create(Request $request, ObjectManager $manager)
    {
        $article = new Article();
        
        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {

            $manager->persist($article);
            $manager->flush();
            
            $this->addFlash(
                'success',
                "L'article <strong>{$article->getLibelle()}</strong> a bien été enregistrée ! "
            );
        
            return $this->redirectToRoute('articles_admin');
         
        }

        return $this->render('article/new.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * Permet de modifier 
     * 
     * @Route("/admin/{libelle}/edit", name="admin_edit")
     * 
     * @return Response
     */
    public function edit(Article $article, Request $request, ObjectManager $manager)
    {
        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        $manager->persist($article);
        $manager->flush();

            $this->addFlash(
                'success', 
                "Les modifications de l'article <strong>{$article->getLibelle()}</strong> ont bien été enregistrée ! " 
            );

            return $this->redirectToRoute('articles_admin', [
                'libelle' => $article->getLibelle()
            ]);
        
        return $this->render('article/edit.html.twig',[
            'form' => $form->createView(),
            'article'=> $article
        ]);
        
    }

    /**
     * Suppression
     * 
     * @Route("/admin/{libelle}/delete", name ="admin_delete")
     * 
     * @return Response
     */
    public function delete(Article $article, ObjectManager $manager)
    {
        $manager->remove($article);
        $manager->flush();

        $this->addFlash(
            'success',
            "L'article '{$article->getLibelle()}' a bien été supprimé"
        );

        return $this->redirectToRoute("articles_admin");
    }
}



