<?php

namespace App\Entity\Interfaces;

interface SecurityInterface extends
    IdentifierInterface,
    CreatedInterface,
    UpdatedInterface,
    CodeInterface,
    TitleInterface
{
}
