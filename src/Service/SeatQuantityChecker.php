<?php
// src/Service/ProductQuantityChecker.php
namespace App\Service;

use App\Entity\Carshare;
use Doctrine\ORM\EntityManagerInterface;

class SeatQuantityChecker
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function checkAndDeleteCarsharesWithZeroQuantity(): void
    {
        $productRepository = $this->entityManager->getRepository(Carshare::class);
        $carshares = $productRepository->findAll();

        foreach ($carshares as $carshare) {
            if ($carshare->getAvailableSeats() <= 0) {
                $this->entityManager->remove($carshare);
            }
        }

        $this->entityManager->flush();
    }
}
