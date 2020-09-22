<?php

namespace App\Entity\Constants\Enums;

/**
 * Status of invation
 */
class RecipientType
{
    /**
     * Message recipient is a email address
     *
     * @var string
     */
    public const EMAIL = 'email';

    /**
     * Message recipient is a user account
     *
     * @var string
     */
    public const USERNAME = 'username';

    /**
     * Message recipient is a phone number
     *
     * @var string
     */
    public const SMS = 'sms';

    /**
     * Message recipient is a twitter account
     *
     * @var string
     */
    public const TWITTER = 'twitter';

    /**
     * Message recipient is a facebook account
     *
     * @var string
     */
    public const FACEBOOK = 'facebook';
}
