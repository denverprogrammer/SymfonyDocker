<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Entity\Trackrecord;

/**
 * Doctrine respository for Trackrecord entities.
 */
class TrackrecordRepository extends ServiceEntityRepository
{
    /**
     * Trackrecord repository constructor
     *
     * @param ManagerRegistry $registry Manager registry.
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trackrecord::class);
    }

    /**
     * Create entity
     *
     * @return Trackrecord
     */
    public function create()
    {
        return new Trackrecord();
    }
}
