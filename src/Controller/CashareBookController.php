<?php

namespace App\Controller;

use App\Entity\Carshare;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use function PHPUnit\Framework\throwException;

final class CashareBookController extends AbstractController{
    #[Route('carshare/view/{id}', name: 'app_carshare_details', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function show(Carshare $carshare): Response|Exception
    {
        $user = $carshare->getUser();
        // Let's verify user is not trying to access by URL a carshare he should not be able to see
        // CASE 01 : already booked the specified voyage from the logged => DENY
        // CASE 02 : trying to access and book his own route => DENY
        if($user->getBookHistory()->contains($carshare) || $this->getUser() === $user){
            return new Exception('Access denied');
        }

        $reviews =$user->getReviews();
        return $this->render('pages/carshare.html.twig', [
            'controller_name' => 'CashareController',
            $carshare->getId() => $carshare,
            'carshare' => $carshare,
            'reviews' => $reviews,
        ]);
    }
}
