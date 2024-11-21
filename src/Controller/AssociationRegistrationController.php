<?php

namespace App\Controller;

use App\Entity\Association;
use App\Entity\Benevole;
use App\Form\AssociationType;
use App\Form\BenevoleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class AssociationRegistrationController extends AbstractController
{
    #[Route('/association/register', name: 'register_association')]

    public function registerAssociation(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): \Symfony\Component\HttpFoundation\Response
    {


        // Création d'un nouvel objet Benevole pour le formulaire
        $association = new Association();
        $form = $this->createForm(AssociationType::class, $association);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hashedPassword = $passwordHasher->hashPassword($association, $association->getMotPasse());
            $association->setMotPasse($hashedPassword);

            $entityManager->persist($association);
            $entityManager->flush();

            $this->addFlash('success', 'Inscription réussie !');
            return $this->redirectToRoute('login');  // Redirige vers la page de connexion
        }

        return $this->render('association_registration/index.html.twig', [
            'form' => $form->createView(),

        ]);
    }
}
