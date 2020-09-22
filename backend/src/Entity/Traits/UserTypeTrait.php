<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Interfaces\UserTypeInterface;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Constants\Enums\UserType;

/**
 * User type of entity
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
     * {inheritdoc}
     */
    public function getUserType(): string
    {
        return $this->userType;
    }

    /**
     * {inheritdoc}
     */
    public function setUserType(string $type): self
    {
        $this->userType = $type;

        return $this;
    }
}
