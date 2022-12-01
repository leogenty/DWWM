<?php

namespace App\Controller\App;

use App\Entity\Chapter;
use App\Entity\Lesson;
use App\Entity\Matter;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LessonsController extends AbstractController
{
    #[Route('app/lessons/{title}', name: 'app_lessons')]
    public function index(Request $request, ManagerRegistry $managerRegistry): Response
    {
        return $this->render('app/pages/lessons/index.html.twig', [
            'chapters' => $managerRegistry->getRepository(Chapter::class)->findBy(['matter' => $managerRegistry->getRepository(Matter::class)->findOneBy(['name' => $request->get('title')])]),
            'lessons' => $managerRegistry->getRepository(Lesson::class)->findAll(),
        ]);
    }
}
