<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Interfaces\EmailInterface;

/**
 * Email of entity
 */
trait EmailTrait
{
    /**
     * Email of entity
     *
     * @var string
     *
     * @ORM\Column(type="string", length=180)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    protected string $email;

    /**
     * {inheritdoc}
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * {inheritdoc}
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
}
