<?php

namespace App\Controller\Traits;

use App\Entity\User;
use App\Entity\Message;
use App\Repository\UserRepository;
use App\Repository\MessageRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Entity Repository and Manager trait.
 */
trait RepositoryTrait
{
    /**
     * Get Doctrine entity manager.
     *
     * @return EntityManagerInterface
     */
    public function getEntityManager(): EntityManagerInterface
    {
        return $this->getDoctrine()->getManager();
    }

    /**
     * Get user repository.
     *
     * @return UserRepository
     */
    public function getUserRepository(): UserRepository
    {
        return $this->getEntityManager()->getRepository(User::class);
    }

    /**
     * Get invitation repository.
     *
     * @return MessageRepository
     */
    public function getMessageRepository(): MessageRepository
    {
        return $this->getEntityManager()->getRepository(Message::class);
    }
}
