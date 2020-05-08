<?php
namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * Represents the unique id of the record.
 */
trait IdentifierTrait
{
    /**
     * @var integer|null Identifier of record.
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * Get unique id of record.
     *
     * @return integer|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}
