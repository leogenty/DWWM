<?php

namespace App\Controller\App;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OnlineLessonsController extends AbstractController
{
    #[Route('/app/online_lessons', name: 'app_online_lessons')]
    public function index(): Response
    {
        return $this->render('app/pages/online-lessons/index.html.twig');
    }
}
