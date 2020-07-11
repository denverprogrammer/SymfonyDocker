<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Interfaces;

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
    protected $id;

    /**
     * {inherticdoc}
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * {inherticdoc}
     */
    public function setId(int $id): Interfaces\IdentifierInterface
    {
        $this->id = $id;

        return $this;
    }
}
