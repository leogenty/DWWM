<?php

namespace App\Controller\App;

use App\Entity\Progression;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/app/reset-progression', name: 'app_reset_progression')]
    public function resetProgression(ManagerRegistry $managerRegistry, Request $request): Response
    {
        $progressionId = $request->get('progressionId');

        $progression = $managerRegistry->getRepository(Progression::class)->find($progressionId);
        $progression->setComplete(0);
        $managerRegistry->getManager()->persist($progression);
        $managerRegistry->getManager()->flush();

        return $this->render('app/pages/profile/index.html.twig', [
            'progressions' => $managerRegistry->getRepository(Progression::class)->findAll(),
        ]);
    }
}
