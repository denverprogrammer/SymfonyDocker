<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Interfaces\SubscriptionBaseInterface;
use App\Entity\Interfaces\TrackrecordInterface;
use App\Entity\Trackrecord;

/**
 * SubscriptionBase class
 */

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
     * {inheritdoc}
     */
    public function getTrackrecord(): TrackrecordInterface
    {
        return $this->trackrecord;
    }

    /**
     * {inheritdoc}
     */
    public function setTrackrecord(TrackrecordInterface $trackrecord): self
    {
        $this->trackrecord = $trackrecord;

        return $this;
    }

    /**
     * {inheritdoc}
     */
    public function getUser(): UserInterface
    {
        return $this->user;
    }

    /**
     * {inheritdoc}
     */
    public function setUSer(UserInterface $user): self
    {
        $this->user = $user;

        return $this;
    }
}
