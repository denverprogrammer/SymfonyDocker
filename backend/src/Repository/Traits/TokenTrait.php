<?php

namespace App\Repository\Traits;

use App\Entity\Interfaces\TokenInterface;

/**
 * Allow repository to find entity by a token.
 */
trait TokenTrait
{
    /**
     * Find entity by token.
     *
     * @param string $token Value to find.
     *
     * @return TokenInterface|null
     */
    public function findByToken(string $token): ?TokenInterface
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.token = :token')
            ->setParameter('token', $token)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
