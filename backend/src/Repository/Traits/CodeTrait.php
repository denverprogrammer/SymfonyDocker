<?php

namespace App\Repository\Traits;

use App\Entity\Interfaces\CodeInterface;

trait CodeTrait
{
    /**
     * Find entity by code.
     *
     * @param string $code
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
