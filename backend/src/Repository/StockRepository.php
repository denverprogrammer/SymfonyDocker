<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Entity\Stock;

/**
 * Doctrine respository for Stock entities.
 */
class StockRepository extends ServiceEntityRepository
{
    use Traits\CodeTrait;

    /**
     * User repository constructor
     *
     * @param ManagerRegistry $registry Manager registry.
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stock::class);
    }

    /**
     * Create entity
     *
     * @return Stock
     */
    public function create()
    {
        return new Stock();
    }
}
