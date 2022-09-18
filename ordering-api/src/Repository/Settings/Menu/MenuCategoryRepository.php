<?php

namespace App\Repository\Settings;

use App\Entity\MenuCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MenuCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method MenuCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method MenuCategory[]    findAll()
 * @method MenuCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MenuCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MenuCategory::class);
    }
}