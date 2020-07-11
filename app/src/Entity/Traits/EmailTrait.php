<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Interfaces;

/**
 * Represents a email.
 */
trait EmailTrait
{
    /**
     * Email name of user.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    protected $email = null;

    /**
     * {inheritdoc}
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * {inheritdoc}
     */
    public function setEmail(string $email): Interfaces\EmailInterface
    {
        $this->email = $email;

        return $this;
    }
}
