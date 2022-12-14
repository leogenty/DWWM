<?php

namespace App\Controller\Front;

use App\Repository\CategoryRepository;
use App\Repository\MatterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MatterController extends AbstractController
{
    #[Route('/matter', name: 'front_matter')]
    public function index(MatterRepository $matterRepository, CategoryRepository $categoryRepository): Response
    {
        return $this->render('front/pages/matter/index.html.twig', [
            'matters' => $matterRepository->findAll(),
            'categories' => $categoryRepository->findAll(),
        ]);
    }
}
