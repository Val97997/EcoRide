<?php

namespace App\Controller;

use App\Entity\Carshare;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CashareController extends AbstractController{
    #[Route('carshare/{id}', name: 'app_carshare_details', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function show(Carshare $carshare): Response
    {
        $user = $carshare->getUser();
        $reviews =$user->getReviews();
        return $this->render('pages/carshare.html.twig', [
            'controller_name' => 'CashareController',
            $carshare->getId() => $carshare,
            'carshare' => $carshare,
            'reviews' => $reviews,
        ]);
    }
}
