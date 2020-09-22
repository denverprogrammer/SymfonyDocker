<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Entity\Exchange;

/**
 * Doctrine respository for Exhcnage entities.
 */
class ExchangeRepository extends ServiceEntityRepository
{
    use Traits\CodeTrait;

    /**
     * User repository constructor
     *
     * @param ManagerRegistry $registry Manager registry.
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Exchange::class);
    }

    /**
     * Create entity
     *
     * @return Exchange
     */
    public function create()
    {
        return new Exchange();
    }
}
