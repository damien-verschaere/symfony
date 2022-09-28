<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ProfilFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function update(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        
        $user = $this->getUser();
        $form = $this->createForm(ProfilFormType::class, $user,  [
            'action' => $request->getRequestUri()
        ]);
        $form->handleRequest($request);

        $password = $user->getPassword();

        if($form->isSubmitted() && $form->isValid()) {
            if(!empty($password)) {
                $user->setPassword(
                    $userPasswordHasher->hashPassword(
                        $user,
                        $form->get('password')->getData()
                    )
                ); 

                $entityManager->persist($user);
                $entityManager->flush();
            }

               
            
        }


        return $this->render('user/index.html.twig', [
            'profilForm' => $form->createView(),
        ]);

    }
}