<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Entity\Market;

/**
 * Doctrine respository for Market entities.
 */
class MarketRepository extends ServiceEntityRepository
{
    use Traits\CodeTrait;

    /**
     * User repository constructor
     *
     * @param ManagerRegistry $registry Manager registry.
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Market::class);
    }

    /**
     * Create entity
     *
     * @return Market
     */
    public function create()
    {
        return new Market();
    }
}
