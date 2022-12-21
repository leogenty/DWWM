<?php

namespace App\Controller\Front;

use App\Entity\Category;
use App\Entity\Lesson;
use App\Entity\Matter;
use App\Entity\Type;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MatterController extends AbstractController
{
    #[Route('/matter', name: 'front_matter')]
    public function index(ManagerRegistry $managerRegistry): Response
    {
        return $this->render('front/pages/matter/index.html.twig', [
            'categories' => $managerRegistry->getRepository(Category::class)->findAll(),
            'matters' => $managerRegistry->getRepository(Matter::class)->findAll(),
            'types' => $managerRegistry->getRepository(Type::class)->findAll(),
        ]);
    }
}
