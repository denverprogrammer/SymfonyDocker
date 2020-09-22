<?php

namespace App\Repository\Traits;

use App\Entity\Interfaces\RecipientInterface;

trait RecipientTrait
{
    /**
     * Find entity by recient.
     *
     * @param string $recipient
     *
     * @return RecipientInterface[]
     */
    public function findByRecipient(string $recipient): array
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.recipient = :recipient')
            ->setParameter('recipient', $recipient)
            ->getQuery()
            ->getArrayResult();
        ;
    }
}
