<?php

namespace App\Repository\Traits;

use App\Entity\Interfaces\RecipientInterface;

/**
 * Allow repository to find entity by a recipient.
 */
trait RecipientTrait
{
    /**
     * Find entity by recient.
     *
     * @param string $recipient Value to find.
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
