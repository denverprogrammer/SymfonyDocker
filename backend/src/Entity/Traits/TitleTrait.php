<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Interfaces\TitleInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Display name of entity
 */
trait TitleTrait
{
    /**
     * Title of entity
     *
     * @var string
     *
     * @ORM\Column(type="string", length=128)
     * @Assert\NotBlank()
     */
    protected string $title;

    /**
     * {inheritdoc}
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * {inheritdoc}
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }
}
