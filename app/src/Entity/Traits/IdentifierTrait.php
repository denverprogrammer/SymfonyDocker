<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * Represents the unique id of the record.
 */
trait IdentifierTrait
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * Unique id of record
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}
