<?php

namespace App\Controller\App;

use App\Entity\Block;
use App\Entity\Chapter;
use App\Entity\Lesson;
use App\Entity\Matter;
use App\Entity\Type;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
            'types' => $managerRegistry->getRepository(Type::class)->findBy(['matter' => $managerRegistry->getRepository(Matter::class)->findOneBy(['name' => $request->get('matter')])]),
            'chapters' => $managerRegistry->getRepository(Chapter::class)->findAll(),
            'lessons' => $managerRegistry->getRepository(Lesson::class)->findAll(),
            'blocks' => $managerRegistry->getRepository(Block::class)->findAll(),
        ]);

        // form with input hidden type with userID and chapterID
        // or
        // bool if true create row with userID and chapterID
    }
}
