<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Interfaces\CodeInterface;

/**
 * A unique shortcode a entity.
 */
trait CodeTrait
{
    /**
     * A unique shortcode a entity
     *
     * @var string
     *
     * @ORM\Column(type="string", length=64)
     * @Assert\NotBlank()
     */
    protected $code;

    /**
     * Get code of entity.
     *
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Set code of entity.
     *
     * @param string $code Value of entity.
     *
     * @return self
     */
    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }
}
