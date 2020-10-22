<?php

namespace App\Entity\Constants\Enums;

/**
 * Determins how an entity is seen
 */
class ViewState
{
    /**
     * Entity details are hidden
     *
     * @var string
     */
    public const ANOMYOUS = 'anomyous';

    /**
     * Entity details can be seen
     *
     * @var string
     */
    public const TRANSPARENT = 'transparent';
}
