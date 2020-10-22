<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Interfaces\SubscriptionBaseInterface;
use App\Entity\Interfaces\TrackrecordInterface;
use App\Entity\Trackrecord;
use App\Entity\User;
use App\Entity\Interfaces\UserInterface;

/**
 * Subscription class
 *
 * @ORM\Entity(repositoryClass="App\Repository\SubscriptionRepository")
 */
class Subscription implements SubscriptionBaseInterface
{
    use Traits\IdentifierTrait;
    use Traits\CreatedTrait;
    use Traits\UpdatedTrait;
    use Traits\StartsOnTrait;
    use Traits\EndsOnTrait;
    use Traits\PrivledgesTrait;
    use Traits\UserTypeTrait;

    /**
     * User
     *
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="subscriptions")
     */
    protected User $user;

    /**
     * Trackrecord
     *
     * @var Trackrecord
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Trackrecord", inversedBy="subscriptions")
     */
    protected Trackrecord $trackrecord;

    /**
     * Gets the trackrecord for subscription
     *
     * @return TrackrecordInterface
     */
    public function getTrackrecord(): TrackrecordInterface
    {
        return $this->trackrecord;
    }

    /**
     * Sets the trackrecord for subscription
     *
     * @param TrackrecordInterface $trackrecord Value of entity.
     *
     * @return self
     */
    public function setTrackrecord(TrackrecordInterface $trackrecord): self
    {
        $this->trackrecord = $trackrecord;

        return $this;
    }

    /**
     * Get User of entity.
     *
     * @return UserInterface
     */
    public function getUser(): UserInterface
    {
        return $this->user;
    }

    /**
     * Set User of entity.
     *
     * @param UserInterface $user Value of entity.
     *
     * @return self
     */
    public function setUSer(UserInterface $user): self
    {
        $this->user = $user;

        return $this;
    }
}
