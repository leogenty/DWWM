<?php

namespace App\Controller;

use App\Entity\ResetPassword;
use App\Form\ResetPasswordType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class ResetPasswordController extends AbstractController
{
    #[Route(path: '/reset-password', name: 'security_pages_reset')]
    public function settings(Request $request, UserPasswordHasherInterface $userPasswordHasher, ManagerRegistry $managerRegistry): Response
    {
        $reset = new ResetPassword();
        $user = $this->getUser();

        $form = $this->createForm(ResetPasswordType::class, $reset);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($userPasswordHasher->hashPassword($user, $form->get('newPassword')->getData()));
            $managerRegistry->getManager()->persist($user);
            $managerRegistry->getManager()->flush();

            $this->addFlash('success', 'Mot de passe modifié !');

            return $this->redirectToRoute('front_home');
        }

        return $this->render('security/pages/reset/index.html.twig', ['form' => $form->createView()]);
    }
}
