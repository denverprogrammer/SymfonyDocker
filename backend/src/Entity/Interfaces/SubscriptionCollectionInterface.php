<?php

namespace App\Entity\Interfaces;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\Interfaces\SubscriptionInterface;

/**
 * Interface for Subscriptions.
 */
interface SubscriptionCollectionInterface
{
    /**
     * Get subscription collection
     *
     * @return Collection|SubscriptionInterfaces[]
     */
    public function getSubscriptions(): Collection;

    /**
     * Set subscription collection
     *
     * @param ArrayCollection $subscriptions Value of entity.
     *
     * @return self
     */
    public function setSubscriptions(ArrayCollection $subscriptions): self;
}
