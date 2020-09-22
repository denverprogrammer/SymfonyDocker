<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Subscription;

/**
 * Doctrine respository for Subscription entities.
 */
class SubscriptionRepository extends ServiceEntityRepository
{
    /**
     * Subscription repository constructor
     *
     * @param ManagerRegistry $registry Manager registry.
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Subscription::class);
    }

    /**
     * Create entity
     *
     * @return Subscription
     */
    public function create()
    {
        return new Subscription();
    }
}
