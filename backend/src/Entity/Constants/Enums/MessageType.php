<?php

namespace App\Entity\Constants\Enums;

/**
 * Status of invation
 */
class MessageType
{
    /**
     * Message recipient is a email address
     *
     * @var string
     */
    public const CREATE_ACCOUNT = 'create_account';

    /**
     * Message recipient is a user account
     *
     * @var string
     */
    public const RESET_PASSWORD = 'reset_password';

    /**
     * Message recipient is a phone number
     *
     * @var string
     */
    public const SITE_INVITE = 'site_invite';

    /**
     * Message recipient is a phone number
     *
     * @var string
     */
    public const USER_INVITE = 'user_invite';

    /**
     * Message recipient is a phone number
     *
     * @var string
     */
    public const TRACKRECORD_INVITE = 'trackrecord_invite';
}
