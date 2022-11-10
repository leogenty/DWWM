<?php

namespace App\Controller\App;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LessonsController extends AbstractController
{
    #[Route('/app/lessons', name: 'app_lessons')]
    public function index(): Response
    {
        return $this->render('app/pages/lessons/index.html.twig');
    }
}
