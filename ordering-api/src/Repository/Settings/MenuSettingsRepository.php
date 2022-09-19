<?php

namespace App\Repository\Settings;

use App\Entity\Settings\MenuSettings;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MenuSettings|null find($id, $lockMode = null, $lockVersion = null)
 * @method MenuSettings|null findOneBy(array $criteria, array $orderBy = null)
 * @method MenuSettings[]    findAll()
 * @method MenuSettings[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MenuSettingsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MenuSettings::class);
    }
}