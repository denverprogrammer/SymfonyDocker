<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * Represents the unique id of the record.
 */
trait IdentifierTrait
{
    /**
     * Identifier of record.
     *
     * @var integer|null
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected ?int $id = null;

    /**
     * Get identifier of record.
     *
     * @return integer|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}
