<?php

namespace App\Repository\Traits;

use App\Entity\Interfaces\EmailInterface;

trait EmailTrait
{
    /**
     * Find entity by email.
     *
     * @param string $email
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
