<?php

namespace App\Controller\App;

use App\Entity\User;
use App\Form\RegisterType;
use App\Repository\UserRepository;
use App\Security\AppAuthenticator;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('front_home');
        }

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/pages/login/index.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, AppAuthenticator $authenticator, ManagerRegistry $managerRegistry): Response
    {
        $user = new User();

        $form = $this->createForm(RegisterType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($userPasswordHasher->hashPassword($user, $form->get('password')->getData()));
            $managerRegistry->getManager()->persist($user);
            $managerRegistry->getManager()->flush();

            return $userAuthenticator->authenticateUser($user, $authenticator, $request);
        }

        return $this->render('security/pages/register/index.html.twig', ['form' => $form->createView()]);
    }

    #[Route(path: '/delete', name: 'app_delete')]
    public function deleteUser(Request $request, UserRepository $userRepository, ManagerRegistry $managerRegistry)
    {
        $user = $this->getUser();

        $this->container->get('security.token_storage')->setToken(null);
        $userRepository->remove($user);
        $managerRegistry->getManager()->flush();
        $request->getSession()->invalidate();

        $this->addFlash('success', 'Compte supprimé.');

        return $this->redirectToRoute('front_home');
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void {}
}
