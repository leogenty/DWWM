<?php

namespace App\Controller\App;

use App\Repository\LanguageRepository;
use App\Repository\OnlineLessonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OnlineLessonController extends AbstractController
{
    #[Route('/app/online_lesson', name: 'app_online_lesson')]
    public function index(OnlineLessonRepository $onlineLessonRepository, LanguageRepository $languageRepository): Response
    {
        return $this->render('app/pages/online-lessons/index.html.twig', [
            'onlineLessons' => $onlineLessonRepository->findAll(),
            'languages' => $languageRepository->findAll(),
        ]);
    }
}
