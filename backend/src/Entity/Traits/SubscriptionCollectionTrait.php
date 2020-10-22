<?php

namespace App\Entity\Traits;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Interfaces\SubscriptionInterface;
use App\Entity\Interfaces\SubscriptionCollectionInterface;

/**
 * Collection of subscriptions.
 */
trait SubscriptionCollectionTrait
{
    /**
     * Collection of subscriptions
     *
     * @var Collection|SubscriptionInterface[]
     */
    protected Collection $subscriptions;

    /**
     * Get subscription collection
     *
     * @return Collection|SubscriptionInterfaces[]
     */
    public function getSubscriptions(): Collection
    {
        return $this->subscriptions;
    }

    /**
     * Set subscription collection
     *
     * @param ArrayCollection $subscriptions Value of entity.
     *
     * @return self
     */
    public function setSubscriptions(ArrayCollection $subscriptions): self
    {
        $this->subscriptions = $subscriptions;

        return $this;
    }
}
