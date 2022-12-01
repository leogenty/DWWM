<?php

namespace App\Controller\App;

use App\Entity\Block;
use App\Entity\Chapter;
use App\Entity\Lesson;
use App\Entity\Matter;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Component\Routing\Annotation\Route;

class LessonsController extends AbstractController
{
    /* public function renderRoute(Request $request)
    {
        $route = $request->attributes->get('matter');

        $session = new Session(new NativeSessionStorage(), new AttributeBag());
        $session->set('matterMemory', $route);

        if ('redirect' == $route) {
            return $this->redirectToRoute('front_matter');
        } else {
            return $this->redirectToRoute('app_lessons', ['matter' => $session]);
        }
    } */

    #[Route('app/lessons/{matter}', name: 'app_lessons')]
    public function index(Request $request, ManagerRegistry $managerRegistry): Response
    {
        // $this->renderRoute($request);

        return $this->render('app/pages/lessons/index.html.twig', [
            'chapters' => $managerRegistry->getRepository(Chapter::class)->findBy(['matter' => $managerRegistry->getRepository(Matter::class)->findOneBy(['name' => $request->get('matter')])]),
            'lessons' => $managerRegistry->getRepository(Lesson::class)->findAll(),
            'blocks' => $managerRegistry->getRepository(Block::class)->findAll(),
        ]);
    }
}
