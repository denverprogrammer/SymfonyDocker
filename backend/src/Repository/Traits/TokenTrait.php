<?php

namespace App\Repository\Traits;

use App\Entity\Interfaces\TokenInterface;

trait TokenTrait
{
    /**
     * Find entity by token.
     *
     * @param string $token
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
