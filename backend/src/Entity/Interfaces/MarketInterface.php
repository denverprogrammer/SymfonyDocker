<?php

namespace App\Entity\Interfaces;

interface MarketInterface extends
    IdentifierInterface,
    CreatedInterface,
    UpdatedInterface,
    CodeInterface,
    TitleInterface
{
}
