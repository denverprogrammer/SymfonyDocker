<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Interfaces\DescriptionInterface;

/**
 * Description of entity
 */
trait DescriptionTrait
{
    /**
     * Description of entity;
     *
     * @var string|null
     *
     * @ORM\Column(type="string", length=4000)
     */
    protected ?string $description = null;

    /**
     * {inheritdoc}
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * {inheritdoc}
     */
    public function setDescription(?string $description = null): self
    {
        $this->description = $description;

        return $this;
    }
}
