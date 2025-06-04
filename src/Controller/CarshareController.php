<?php

namespace App\Controller;

use App\Entity\Carshare;
use App\Form\CarshareType;
use App\Repository\CarshareRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/carshare')]
final class CarshareController extends AbstractController{
    #[Route(name: 'app_carshare_index', methods: ['GET'])]
    public function index(CarshareRepository $carshareRepository): Response
    {
        return $this->render('carshare/index.html.twig', [
            'carshares' => $carshareRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_carshare_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $carshare = new Carshare();
        $form = $this->createForm(CarshareType::class, $carshare);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($carshare);
            $entityManager->flush();

            return $this->redirectToRoute('app_carshare_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('carshare/new.html.twig', [
            'carshare' => $carshare,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_carshare_show', methods: ['GET'])]
    public function show(Carshare $carshare): Response
    {
        return $this->render('carshare/show.html.twig', [
            'carshare' => $carshare,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_carshare_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Carshare $carshare, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CarshareType::class, $carshare);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_carshare_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('carshare/edit.html.twig', [
            'carshare' => $carshare,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_carshare_delete', methods: ['POST'])]
    public function delete(Request $request, Carshare $carshare, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$carshare->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($carshare);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_carshare_index', [], Response::HTTP_SEE_OTHER);
    }
}
