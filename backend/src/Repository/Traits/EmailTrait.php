<?php

namespace App\Repository\Traits;

use App\Entity\Interfaces\EmailInterface;

/**
 * Allow repository to find entity by email.
 */
trait EmailTrait
{
    /**
     * Find entity by email.
     *
     * @param string $email Value to find.
     *
     * @return EmailInterface|null
     */
    public function findByEmail(string $email): ?EmailInterface
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.email = :email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
