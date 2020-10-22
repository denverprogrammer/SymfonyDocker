<?php

namespace App\Entity\Interfaces;

interface ExchangeInterface extends
    IdentifierInterface,
    CreatedInterface,
    UpdatedInterface,
    CodeInterface,
    TitleInterface
{
}
