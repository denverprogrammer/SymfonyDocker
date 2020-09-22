<?php

namespace App\Entity\Interfaces;

/**
 * Interface for Subscriptions.
 */
interface SubscriptionInterface extends SubscriptionBaseInterface
{
    /**
     * Gets the subscription user
     *
     * @return UserInterface
     */
    public function getUser(): UserInterface;

    /**
     * Sets the subscription user
     *
     * @param UserInterface $user
     *
     * @return self
     */
    public function setUSer(UserInterface $user): self;
}
