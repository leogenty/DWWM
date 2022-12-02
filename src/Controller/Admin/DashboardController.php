<?php

namespace App\Controller\Admin;

use App\Entity\Block;
use App\Entity\Category;
use App\Entity\Chapter;
use App\Entity\Lesson;
use App\Entity\Matter;
use App\Entity\OnlineLesson;
use App\Entity\Progression;
use App\Entity\Type;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Jpl Symfony')
            ->setLocales(['fr']);
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('User', 'fas fa-list', User::class);
        yield MenuItem::linkToCrud('Category', 'fas fa-screen-users', Category::class);
        yield MenuItem::linkToCrud('Matter', 'fas fa-screen-users', Matter::class);
        yield MenuItem::linkToCrud('Type', 'fas fa-screen-users', Type::class);
        yield MenuItem::linkToCrud('Chapter', 'fas fa-screen-users', Chapter::class);
        yield MenuItem::linkToCrud('Lesson', 'fas fa-screen-users', Lesson::class);
        yield MenuItem::linkToCrud('Block', 'fas fa-screen-users', Block::class);
        yield MenuItem::linkToCrud('Online Lesson', 'fas fa-screen-users', OnlineLesson::class);
        yield MenuItem::linkToCrud('Progression', 'fas fa-screen-users', Progression::class);
    }
}
