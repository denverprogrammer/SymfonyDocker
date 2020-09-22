<?php

namespace App\Entity\Constants\Enums;

/**
 * Determines how a message can be viewed
 */
class PostStatus
{
    /**
     * Message has not been published
     *
     * @var string
     */
    public const DRAFT = 'draft';

    /**
     * Message was published
     *
     * @var string
     */
    public const PUBLISHED = 'published';
 
    /**
     * Message was retired
     *
     * @var string
     */
    public const RETIRE = 'retire';
}
