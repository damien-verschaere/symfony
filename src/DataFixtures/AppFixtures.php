<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Articles;
use App\Entity\User;
use App\Entity\Comments;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        
        for ($i=0; $i <10 ; $i++) { 
            $user = new User();
            $user->setUsername('damien'.$i);
            $user->setRoles([]);
            $user->setPassword('123456'.$i);
            $manager->persist($user);

            $articles = new Articles();
            $articles -> setTitre('Titre Article'. $i);
            $articles -> setTexte('contenu Article' . $i);
            $articles -> setDateArticle(new \DateTime('now'));
            $articles->setSlug('Titre Article'. $i);
            $articles -> setArticleUser($user);
            $manager->persist($articles);

            $Comments = new Comments();
            $Comments -> setTextComments('com'.$i);
            $Comments -> setDateComments(new \DateTime('now'));
            $Comments ->  setCommentsUser($user);
            $Comments -> setCommentsArticle($articles);
            $manager->persist($Comments);
       } 
        $manager->flush();
    }
}
