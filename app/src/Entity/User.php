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
class User implements UserInterface
{
    use Traits\IdentifierTrait;
    use Traits\CreatedTrait;
    use Traits\UpdatedTrait;
    use Traits\TokenTrait;

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
     * Last name of user.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=180)
     * @Assert\NotBlank()
     */
    private $lastName = 'last name';

    /**
     * Email name of user.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

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
     * First name of user.
     *
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * Set first name of user.
     *
     * @param string $name User's first name.
     *
     * @return self
     */
    public function setFirstName(string $name): self
    {
        $this->firstName = $name;

        return $this;
    }

    /**
     * Last name of user.
     *
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * Set last name of user.
     *
     * @param string $name User's last name.
     *
     * @return self
     */
    public function setLastName(string $name): self
    {
        $this->lastName = $name;

        return $this;
    }

    /**
     * Email of user.
     *
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Set email of user.
     *
     * @param string $email User's email.
     *
     * @return self
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

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
    public function isEqualTo(UserInterface $user)
    {
        if (!$user instanceof User) {
            return false;
        }

        if ($this->getUsername() !== $user->getUsername()) {
            return false;
        }

        return true;
    }
}
