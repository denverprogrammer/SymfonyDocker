<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\Interfaces\TrackrecordInterface;
use App\Entity\Interfaces\SubscriptionInterface;
use App\Entity\Subscription;

/**
 * Trackrecord
 *
 * @ORM\Entity(repositoryClass="App\Repository\TrackrecordRepository")
 */
class Trackrecord implements TrackrecordInterface
{
    use Traits\IdentifierTrait;
    use Traits\CreatedTrait;
    use Traits\UpdatedTrait;
    use Traits\TitleTrait;
    use Traits\DescriptionTrait;
    use Traits\SubscriptionCollectionTrait;

    /**
     * Collection of subscriptions
     *
     * @var Collection|SubscriptionInterface[]
     *
     * @ORM\OneToMany(
     *      targetEntity="App\Entity\Subscription",
     *      mappedBy="trackrecord",
     *      cascade={"persist"},
     *      orphanRemoval=true
     * )
     */
    protected Collection $subscriptions;

    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->setSubscriptions(new ArrayCollection());
    }
}
