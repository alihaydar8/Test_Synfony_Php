<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\Request;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index(ArticleRepository $repo): Response
    {
        //    $repo = $this->getDoctrine()->getRepository(Article::class);
        $articles = $repo->findAll();
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $articles
        ]);
    }
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('blog/home.html.twig');
    }

    /**
     * @Route("/create", name="blog_create")
     * @Route("/{id}/edit", name="blog_edit")
     */
    public function create(Article $article = null, Request $request, EntityManagerInterface $entityManager)

    {
        $editmode = true;
        if (!$article) {
            $article = new Article();
        }

        $form = $this->createFormBuilder($article)
            ->add('title')
            ->add('content')
            ->add('image')
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if (!$article->getId()) {
                $editmode = false;
                $article->setCreatedAt(new \DateTime());
            }

            $entityManager->persist($article);
            $entityManager->flush();
            return $this->redirectToRoute('blog_show', ['id' => $article->getId()]);
        }


        return $this->render('blog/create.html.twig', ['formArticle' => $form->createView(), 'editmode' => $editmode]);
    }

    /**
     * @Route("/blog/{id}", name="blog_show")
     */
    public function show(Article $article)
    {
        //   $repo = $this->getDoctrine()->getRepository(Article::class);
        //  $article = $repo->find($id);
        return $this->render('blog/show.html.twig', ['article' => $article]);
    }
    /**
     * @Route("/modal", name="modal")
     */

    public function modal()

    {

        return $this->render('blog/modal.html.twig');
    }
}
