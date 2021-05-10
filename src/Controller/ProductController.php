<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Livre;
use App\Repository\LivreRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{

    public function index()
    {
    }
}
