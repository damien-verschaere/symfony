<?php

namespace App\Controller;

use App\Repository\ArticlesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Comments;
use App\Form\CommentsType;
use App\Entity\Articles;
use App\Form\CreateArticlesType;

class ArticlesController extends AbstractController
{
    #[Route('/articles', name: 'app_articles')]
    public function index(ArticlesRepository $articlesRepository ): Response
    {
       
        return $this->render('articles/index.html.twig', [
            'controller_name' => 'ArticlesController',
            'articles' => $articlesRepository->findAll(),
            
        ]);
    }




    #[Route('/article/{id}', name:'articles')]
    function article(ManagerRegistry $doctrine, $id,EntityManagerInterface $entityManager,Request $request): Response
        {
        $comment = new Comments();
        $date =new \DateTime('now');
        
        // $idUser=$comment->setCommentsUser($this->getUser());
        $form = $this->createForm(CommentsType::class, $comment);
        $entityManager = $doctrine->getManager();
        $article = $entityManager->getRepository(Articles::class)->find($id);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setCommentsUser($this->getUser());
            $comment->setDateComments($date);
            $comment->setCommentsArticle($article);
            $Comments = $form->getData();
            $entityManager->persist($Comments);
            $entityManager->flush();
        }
        return $this->render('article/index.html.twig', [
            'article' => $article,
            'commentForm' => $form->createView()
        ]);

    }
    // #[Route('/article', name: 'app_articles')]
    // public function afficheArticle(ArticlesRepository $articlesRepository) : Response
    // {
    //     return $this->render;
    // }

}
