<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Interfaces;

/**
 * Represents a first name.
 */
trait FirstNameTrait
{
    /**
     * First name of user.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=180)
     * @Assert\NotBlank()
     */
    private $firstName = 'first name';

    /**
     * {inherticdoc}
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * {inherticdoc}
     */
    public function setFirstName(string $name): Interfaces\FirstNameInterface
    {
        $this->firstName = $name;

        return $this;
    }
}
