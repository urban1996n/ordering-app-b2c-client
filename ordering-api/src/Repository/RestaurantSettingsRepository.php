<?php

namespace App\Repository;

use App\Entity\RestaurantSettings;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RestaurantSettings|null find($id, $lockMode = null, $lockVersion = null)
 * @method RestaurantSettings|null findOneBy(array $criteria, array $orderBy = null)
 * @method RestaurantSettings[]    findAll()
 * @method RestaurantSettings[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RestaurantSettingsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RestaurantSettings::class);
    }
}
