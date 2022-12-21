<?php

namespace App\Controller\Admin;

use App\Entity\Block;
use App\Entity\Category;
use App\Entity\Chapter;
use App\Entity\Language;
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
            ->setTitle('Baruu Symfony')
            ->setLocales(['fr']);
    }

    public function configureMenuItems(): iterable
    {
        // yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('User', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Progression', 'fas fa-bars', Progression::class);
        yield MenuItem::linkToCrud('Category', 'fas fa-list', Category::class);
        yield MenuItem::linkToCrud('Matter', 'fas fa-brain', Matter::class);
        yield MenuItem::linkToCrud('Type', 'fas fa-laptop-file', Type::class);
        yield MenuItem::linkToCrud('Chapter', 'fas fa-folder-tree', Chapter::class);
        yield MenuItem::linkToCrud('Lesson', 'fas fa-book-open', Lesson::class);
        yield MenuItem::linkToCrud('Block', 'fas fa-file-lines', Block::class);
        yield MenuItem::linkToCrud('Online Lesson', 'fas fa-person-chalkboard', OnlineLesson::class);
        yield MenuItem::linkToCrud('Language', 'fas fa-earth', Language::class);
    }
}
