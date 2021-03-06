<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Interfaces\UserTypeInterface;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Constants\Enums\UserType;

/**
 * User type of entity.
 */
trait UserTypeTrait
{
    /**
     * UserType
     *
     * @var string
     *
     * @ORM\Column(type="string", length=10)
     * @Assert\NotBlank()
     */
    protected string $userType = UserType::OWNER;

    /**
     * Get UserType of entity.
     *
     * @return string
     */
    public function getUserType(): string
    {
        return $this->userType;
    }

    /**
     * Set UserType of entity.
     *
     * @param string $type Value of entity.
     *
     * @return self
     */
    public function setUserType(string $type): self
    {
        $this->userType = $type;

        return $this;
    }
}
