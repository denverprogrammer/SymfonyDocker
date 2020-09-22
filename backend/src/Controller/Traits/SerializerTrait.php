<?php

namespace App\Controller\Traits;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;

/**
 * Creates a serializer object.
 */
trait SerializerTrait
{
    /**
     * Get common serializer.
     *
     * @return Serializer
     */
    public function getSerializer(): Serializer
    {
        return new Serializer(
            [new ObjectNormalizer()],
            [new XmlEncoder(), new JsonEncoder()]
        );
    }
}