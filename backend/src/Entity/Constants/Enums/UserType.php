<?php

namespace App\Entity\Constants\Enums;

/**
 * Describes who is the attached user of the subscription.
 * Intended to be used in conjunction with SubscriptionAction enum
 */
class UserType
{
    /**
     * Has super user priveleges
     *
     * @var string
     */
    public const OWNER = 'owner';

    /**
     * Priviledges for remote access
     *
     * @var string
     */
    public const API = 'api';

    /**
     * Has privelges related to subscriptions
     *
     * @var string
     */
    public const ADMIN = 'admin';

    /**
     * Has generic priveleges
     *
     * @var string
     */
    public const SUBSCRIBER = 'subscriber';
}
