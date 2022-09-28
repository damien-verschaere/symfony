<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Form\CreateArticlesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateArticleController extends AbstractController
{
    #[Route('/create/article', name: 'app_create_article')]
    public function index(Request $request, EntityManagerInterface $entity): Response
    {
        $this->denyAccessUnlessGranted("ROLE_ADMIN");
        $user = $this->getUser();
        $article = new Articles();
        $date = new \DateTime('now');
        $formArticle = $this->createForm(CreateArticlesType::class, $article);
        $formArticle->handleRequest($request);
        if ($formArticle->isSubmitted() && $formArticle->isValid()) {
            $article->setDateArticle($date);
            $article->setArticleUser($user);
            $entity->persist($article);
            $entity->flush();
        }



        return $this->render('create_article/index.html.twig', [
            'controller_name' => 'CreateArticleController',
            "createArticle" => $formArticle->createView()
        ]);
    }
}
