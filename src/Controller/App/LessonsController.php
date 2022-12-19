<?php

namespace App\Controller\App;

use App\Entity\Block;
use App\Entity\Chapter;
use App\Entity\Lesson;
use App\Entity\Matter;
use App\Entity\Progression;
use App\Entity\Type;
use App\Form\AddProgressionType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LessonsController extends AbstractController
{
    #[Route('app/lessons/{matter}', name: 'app_lessons')]
    public function index(Request $request, ManagerRegistry $managerRegistry): Response
    {
        $routeParameters = $request->attributes->get('_route_params');

        if (['matter' => 'redirect'] == $routeParameters) {
            $this->addFlash('warning', 'Sélectionnez une matière pour accéder aux leçons associées.');

            return $this->redirectToRoute('front_matter');
        }

        return $this->render('app/pages/lessons/index.html.twig', [
            'types' => $managerRegistry->getRepository(Type::class)->findBy(['matter' => $managerRegistry->getRepository(Matter::class)->findOneBy(['name' => $request->get('matter')])]),
            'chapters' => $managerRegistry->getRepository(Chapter::class)->findAll(),
            'lessons' => $managerRegistry->getRepository(Lesson::class)->findAll(),
            'blocks' => $managerRegistry->getRepository(Block::class)->findAll(),
        ]);
    }

    #[Route('app/lessons/{matter}/{typeNb}/{chapterNb}/{lessonNb}', name: 'app_lesson_single')]
    public function single(Request $request, ManagerRegistry $managerRegistry): Response
    {
        $lessonId = $request->get('lessonId');
        $typeId = $request->get('typeId');
        $progressionId = $request->get('progressionId');

        if (null === $progressionId) {
            $progression = new Progression();
            $form = $this->createForm(AddProgressionType::class, $progression, ['typeId' => $typeId]);
            $form->handleRequest($request);

            $progression->setUser($this->getUser());
            $progression->setType($managerRegistry->getRepository(Type::class)->findOneBy(['id' => $typeId]));
            $progression->setComplete(0);

            $managerRegistry->getManager()->persist($progression);
            $managerRegistry->getManager()->flush();
        } else {
            $progression = $managerRegistry->getRepository(Progression::class)->find($progressionId);
        }

        $form = $this->createForm(AddProgressionType::class, $progression, ['typeId' => $typeId]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $progression->setComplete($progression->getComplete() + 10);
            $managerRegistry->getManager()->flush();
            return $this->redirectToRoute('app_lessons', ['matter' => $request->get('matter')]);
        }

        return $this->render('app/pages/lessons/single.html.twig', [
            'form' => $form->createView(),
            'lesson' => $managerRegistry->getRepository(Lesson::class)->find($lessonId),
            'progression' => $managerRegistry->getRepository(Progression::class)->find($progressionId),
        ]);
    }
}
