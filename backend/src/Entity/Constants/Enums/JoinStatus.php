<?php

namespace App\Entity\Constants\Enums;

/**
 * Status of invation
 */
class JoinStatus
{
    /**
     * Status message is in a unknown state
     *
     * @var string
     */
    public const UNKNOWN = 'unknown';

    /**
     * Status message was created
     *
     * @var string
     */
    public const CREATED = 'created';

    /**
     * Status message is in a waiting state
     *
     * @var string
     */
    public const WAITING = 'waiting';

    /**
     * Status message was rejected
     *
     * @var string
     */
    public const REJECTED = 'rejected';

    /**
     * Status message was accepted
     *
     * @var string
     */
    public const ACCEPTED = 'accepted';
}
