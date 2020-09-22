<?php

namespace App\Entity\Traits;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Interfaces\SubscriptionInterface;
use App\Entity\Interfaces\SubscriptionCollectionInterface;

/**
 * Collection of subscriptions
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
     * {inheritdoc}
     */
    public function getSubscriptions(): Collection
    {
        return $this->subscriptions;
    }

    /**
     * {inheritdoc}
     */
    public function setSubscriptions(ArrayCollection $subscriptions): self
    {
        $this->subscriptions = $subscriptions;

        return $this;
    }
}
