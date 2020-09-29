<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Interfaces\EmailInterface;

/**
 * Email of entity.
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
     * Email of user.
     *
     * @return string|null
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set email of user.
     *
     * @param string $email Value of entity.
     *
     * @return self
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
}
