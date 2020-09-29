<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Interfaces\DescriptionInterface;

/**
 * Description of entity.
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
     * Get description of entity.
     *
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set description of entity.
     *
     * @param string|null $description Value of entity.
     *
     * @return self
     */
    public function setDescription(?string $description = null): self
    {
        $this->description = $description;

        return $this;
    }
}
