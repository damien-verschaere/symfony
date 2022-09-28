<?php

namespace App\Controller\Admin;



use App\Entity\Articles;
use App\Entity\Comments;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class AdminController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {   
      //   $user=new User();
      //   $idUser = $user->getRoles();
      //   dd($idUser);
      // if ($idUser ==["ROLE_ADMIN"]) {
        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        $url=$adminUrlGenerator->setController(UserCrudController::class)->generateUrl();
        return $this->redirect($url);
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        $urlArticles = $adminUrlGenerator->setController(ArticlesCrudController::class)->generateUrl();
        return $this->redirect($urlArticles);
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        $urlArticles = $adminUrlGenerator->setController(CommentsCrudController::class)->generateUrl();
        return $this->redirect($urlArticles);
        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
      // }
      // else {
      //   $url= "/";
      //   return $this->redirect($url);
      // }
        
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Symfony');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Gestion User', 'fas fa-list', User::class);
        yield MenuItem::linkToCrud('Gestion Articles', 'fas fa-list', Articles::class);
        yield MenuItem::linkToCrud('Gestion Comments', 'fas fa-list', Comments::class);

    }
}
