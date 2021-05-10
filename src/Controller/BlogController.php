<?php

namespace App\Controller;

use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Task;
use App\Form\Type\TaskType;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
     */
    public function create(Request $request, ObjectManager $manager)

    {
        // $article = new Article();
        // $from = $this->createFromBuilder($article)
        //     ->add('title')
        //     ->add('content')
        //     ->add('image')
        //     ->getFrom();

        // return $this->render('blog/create.html.twig', ['fromArticle' => $from->createView()]);
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
}
