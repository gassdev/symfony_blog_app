<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    private $repoArticle;
    private $repoCategory;

    /**
     * __construct
     *
     * @param  mixed $repoArticle
     * @return void
     */
    public function __construct(
        ArticleRepository $repoArticle,
        CategoryRepository $repoCategory
    ) {
        $this->repoArticle = $repoArticle;
        $this->repoCategory = $repoCategory;
    }

    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $articles = $this->repoArticle->findAll();
        $categories = $this->repoCategory->findAll();

        return $this->render('home/index.html.twig', [
            'articles' => $articles,
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/show/{id}", name="show")
     */
    public function show(?Article $article): Response
    {
        if (!$article) {
            return $this->redirectToRoute('home');
        }

        return $this->render('show/index.html.twig', [
            'article' => $article,
        ]);
    }

    /**
     * @Route("/category/{id}/articles", name="category.articles")
     */
    public function categoryArticles(?Category $category): Response
    {
        if (!$category) {
            return $this->redirectToRoute('home');
        }

        $articles = $category->getArticles()->getValues();
        $categories = $this->repoCategory->findAll();

        return $this->render('home/category.articles.html.twig', [
            'category' => $category,
            'articles' => $articles,
            'categories' => $categories,
        ]);
    }
}