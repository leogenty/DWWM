<?php

namespace App\Controller\App;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/app/profile', name: 'app_profile')]
    public function index(): Response
    {
        return $this->render('front/pages/home/index.html.twig');
    }
}
