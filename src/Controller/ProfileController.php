<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/user', name: 'app_user_')]
final class ProfileController extends AbstractController{
    #[Route('/profile', name: 'profile')]
    public function index(): Response
    {

        return $this->render('pages/profile.html.twig', [
            'controller_name' => 'ProfileController',
        ]);
    }

    #[Route('/edit', name: 'edit')]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager){

        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('app_user_profile', [], Response::HTTP_SEE_OTHER);
        }

            return $this->render('pages/profile-edit.html.twig', [
            'controller_name' => 'ProfileController',
            'registrationForm' => $form,
        ]);
    }
}
