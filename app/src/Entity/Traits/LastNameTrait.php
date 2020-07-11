<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Interfaces;

/**
 * Represents a last name.
 */
trait LastNameTrait
{
    /**
     * Last name of user.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=180)
     * @Assert\NotBlank()
     */
    private $lastName = 'last name';

    /**
     * {inheritdoc}
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * {inheritdoc}
     */
    public function setLastName(string $name): Interfaces\LastNameInterface
    {
        $this->lastName = $name;

        return $this;
    }
}
