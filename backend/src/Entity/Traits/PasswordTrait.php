<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Interfaces\PasswordInterface;

/**
 * Password of entity
 */
trait PasswordTrait
{
    /**
     * Secure password
     *
     * @var string
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    protected string $password;

    /**
     * {inheritdoc}
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * {inheritdoc}
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
}
