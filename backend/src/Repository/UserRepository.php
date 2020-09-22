<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Doctrine respository for user entities.
 */
class UserRepository extends ServiceEntityRepository
{
    use Traits\UsernameTrait;
    use Traits\EmailTrait;
    use Traits\TokenTrait;

    /**
     * User repository constructor
     *
     * @param ManagerRegistry $registry Manager registry.
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Create entity
     *
     * @return User
     */
    public function create()
    {
        return new User();
    }
}
