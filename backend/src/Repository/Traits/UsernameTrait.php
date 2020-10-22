<?php

namespace App\Repository\Traits;

use App\Entity\Interfaces\UsernameInterface;

/**
 * Allow repository to find entity by a username.
 */
trait UsernameTrait
{
    /**
     * Find entity by username.
     *
     * @param string $username Value to find.
     *
     * @return UsernameInterface|null
     */
    public function findByUsername(string $username): ?UsernameInterface
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.username = :username')
            ->setParameter('username', $username)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
