<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\HttpFoundation\RedirectResponse;


use Symfony\Component\HttpFoundation\Request;


class SecurityController extends AbstractController
{

    #[Route('/login', name: 'login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            $this->addFlash('info', 'Vous êtes déjà connecté.');
            return $this->redirectToRoute('dashboard_redirect');
        }

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastEmail = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_email' => $lastEmail,
            'error' => $error,
        ]);
    }

    #[Route('/dashboard_redirect', name: 'dashboard_redirect')]
    public function redirectAfterLogin(#[CurrentUser] $user): RedirectResponse
    {
        if ($user->getRoles()[0] === 'ROLE_BENEVOLE') {
            return $this->redirectToRoute('dashboard_benevole');
        }

        if ($user->getRoles()[0] === 'ROLE_ASSOCIATION') {
            return $this->redirectToRoute('dashboard_association');
        }

        throw new \LogicException('Role utilisateur inconnu.');
    }







}
