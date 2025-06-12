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

// Search Filter manage section
public function findSearch(SearchData $search){
    //create the search query
    $query = $this->createQueryBuilder('c')
        ->orderBy('c.departure_date', 'ASC')
        // ->select('c')
        ->join('c.user', 'u')
        ->join('c.car', 'ca');
        // we join the car and driver User linked to the carshare for ulterior specifications and details

    // create the PDO Query statement for fltering arrival locations and departure locations with the departure date:
    if(!empty($search->arrival_location)){
        $query->andWhere('c.arrival_location LIKE :arrival_location AND c.departure_location LIKE :departure_location
        AND c.departure_date >= :departure_date')
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
        $durationHours = $search->duration->h + ($search->duration->d * 24);
        // Here we write the SQL builder Query in order to get the datetime interval to filter by duration 
        // (we had to install DQN functions library dependency) :
        $query->andWhere('
        (TIMESTAMPDIFF(DAY, c.departure_date, c.arrival_date) * 24) + ABS(TIMESTAMPDIFF(HOUR, c.departure_hour, c.arrival_hour))
         < :duration')
        ->setParameter('duration', $durationHours);
    }
    
    if(!empty($search->eco) && $search->eco){
        $query->andWhere('ca.fuel LIKE :ecological')
        ->setParameter('ecological', 'electric');
    }
    return $query->getQuery()->getResult();
}
}
