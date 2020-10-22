<?php

namespace App\Entity\Constants\Enums;

/**
 * Determines how a subscription role can be used
 */
class SubscriptionAction
{
    /**
     * Allowed to create entities
     *
     * @var string
     */
    public const CREATE = 'create';

    /**
     * Allowed to view a entity
     *
     * @var string
     */
    public const VIEW = 'view';

    /**
     * Allowed to edit a entity
     *
     * @var string
     */
    public const EDIT = 'edit';

    /**
     * Allowed to delete entity
     *
     * @var string
     */
    public const DELETE = 'delete';

    /**
     * Hidden entity
     *
     * @var string
     */
    public const HIDDEN = 'hidden';
}
