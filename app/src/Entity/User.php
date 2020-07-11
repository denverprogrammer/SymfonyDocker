<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User class/table
 *
 * @ApiResource
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"email"})
 */
class User implements Interfaces\AppUserInterface
{
    use Traits\IdentifierTrait;
    use Traits\CreatedTrait;
    use Traits\UpdatedTrait;
    use Traits\TokenTrait;
    use Traits\FirstNameTrait;
    use Traits\LastNameTrait;
    use Traits\EmailTrait;

    /**
     * User roles.
     *
     * @var array
     *
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * Hashed password
     *
     * @var string
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $password;

    /**
     * Confirmed value of record
     *
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=false, options={"default": "0"})
     */
    private $confirmed = false;

    /**
     * Get confirmed value of record.
     *
     * @return boolean
     */
    public function getConfirmed(): bool
    {
        return $this->confirmed;
    }

    /**
     * Set confirmed value of record.
     *
     * @param boolean $value Value of confirmation.
     *
     * @return self
     */
    public function setConfirmed(bool $value): self
    {
        $this->confirmed = $value;

        return $this;
    }

    /**
     * Get username of user.
     *
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return (string) $this->email;
    }

    /**
     * Get roles of user.
     *
     * @return array
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * Set user roles.
     *
     * @param array $roles User roles.
     *
     * @return self
     */
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get password of user
     *
     * @return string
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    /**
     * Set user password.
     *
     * @param string $password User password.
     *
     * @return self
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password salt for user.
     *
     * @return string|null
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Erase plain text password.
     *
     * @return void
     */
    public function eraseCredentials()
    {
    }

    /**
     * Check if the given user is equal to the current user.
     *
     * @param UserInterface $user User.
     *
     * @return boolean
     */
    public function isEqualTo(UserInterface $user): bool
    {
        return $this->getUsername() === $user->getUsername();
    }
}
