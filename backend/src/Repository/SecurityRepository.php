<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Entity\Security;

/**
 * Doctrine respository for Security entities.
 */
class SecurityRepository extends ServiceEntityRepository
{
    use Traits\CodeTrait;

    /**
     * User repository constructor
     *
     * @param ManagerRegistry $registry Manager registry.
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Security::class);
    }

    /**
     * Create entity
     *
     * @return Security
     */
    public function create()
    {
        return new Security();
    }
}
