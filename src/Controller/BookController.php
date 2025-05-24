<?php

namespace App\Controller;

use App\Entity\Carshare;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BookController extends AbstractController{
    #[Route('carshare/book/{id}', name: 'app_book')]
    public function book(Carshare $carshare, User $user, EntityManagerInterface $entityManager): Response
    {
        $entityManager->persist($carshare);
        $entityManager->persist($user);
        $quantity = $carshare->getAvailableSeats();
        $balance = $user->getCreditBalance();
        $user->setCreditBalance($balance-5);
        $carshare->setAvailableSeats($quantity - 1);
        // Optionally, you can add logic to handle the case when no seats are available
        $entityManager->flush();
        return $this->render('pages/book-success.html.twig', [
        ]);
    }
}
