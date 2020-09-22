<?php

namespace App\Entity\Interfaces;

/**
 * Interface for Trackrecords.
 */
interface TrackrecordInterface extends
    IdentifierInterface,
    CreatedInterface,
    UpdatedInterface,
    TitleInterface,
    DescriptionInterface,
    SubscriptionCollectionInterface
{
}
