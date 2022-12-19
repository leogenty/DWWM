<?php

namespace App\Controller\App;

use App\Entity\Progression;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/app/profile', name: 'app_profile')]
    public function index(ManagerRegistry $managerRegistry): Response
    {
        return $this->render('app/pages/profile/index.html.twig', [
            'progressions' => $managerRegistry->getRepository(Progression::class)->findAll(),
        ]);
    }
}
