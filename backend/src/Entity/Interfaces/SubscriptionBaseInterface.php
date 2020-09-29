<?php

namespace App\Entity\Interfaces;

/**
 * Interface for Subscriptions.
 */
interface SubscriptionBaseInterface extends
    IdentifierInterface,
    CreatedInterface,
    UpdatedInterface,
    UserTypeInterface,
    StartsOnInterface,
    EndsOnInterface,
    PrivledgesInterface
{
    /**
     * Gets the trackrecord for subscription
     *
     * @return TrackrecordInterface
     */
    public function getTrackrecord(): TrackrecordInterface;

    /**
     * Sets the trackrecord for subscription
     *
     * @param TrackrecordInterface $trackrecord Value of entity.
     *
     * @return self
     */
    public function setTrackrecord(TrackrecordInterface $trackrecord): self;
}
