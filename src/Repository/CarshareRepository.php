<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Carshare;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Carshare>
 */
class CarshareRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Carshare::class);
    }

//    /**
//     * @return Carshare[] Returns an array of Carshare objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Carshare
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

// Filter manage section
public function findSearch(SearchData $search){
    //create the search query
    $query = $this->createQueryBuilder('c')
        ->orderBy('c.departure_date', 'ASC');
        // ->select('c')
        // ->join('c.user', 'u')
        // ->join('c.car', 'ca');

    // create the PDO Query statement for fltering arrival locations and departure locations with the departure date:
    if(!empty($search->arrival_location)){
        $query->andWhere('c.arrival_location LIKE :arrival_location AND c.departure_location LIKE :departure_location
        AND c.departure_date = :departure_date')
        ->setParameter('departure_date', $search->departure_date)
        ->setParameter('departure_location', "%{$search->departure_location}%")
        ->setParameter('arrival_location', "%{$search->arrival_location}%");
    }
    // create the PDO Query statement for filtering the max price:
    if(!empty($search->max)){
        $query->andWhere('c.price <= :max')
        ->setParameter('max', $search->max);
    }

    if(!empty($search->duration)){
        $query->andWhere('DATE_DIFF(c.arrival_hour, c.departure_hour) <= :duration')
        ->setParameter('duration', $search->duration);
    }

    return $query->getQuery()->getResult();
}
}
