<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Message;

/**
 * Doctrine respository for Invitation entities.
 */
class MessageRepository extends ServiceEntityRepository
{
    use Traits\TokenTrait;
    use Traits\RecipientTrait;

    /**
     * Message repository constructor
     *
     * @param ManagerRegistry $registry Manager registry.
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Message::class);
    }

    /**
     * Create entity
     *
     * @return Message
     */
    public function create()
    {
        return new Message();
    }
}
