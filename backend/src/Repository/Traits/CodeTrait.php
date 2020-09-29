<?php

namespace App\Repository\Traits;

use App\Entity\Interfaces\CodeInterface;

/**
 * Allow repository to find entity by code.
 */
trait CodeTrait
{
    /**
     * Find entity by code.
     *
     * @param string $code Value to find.
     *
     * @return CodeInterface|null
     */
    public function findByCode(string $code): ?CodeInterface
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.code = :code')
            ->setParameter('code', $code)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
