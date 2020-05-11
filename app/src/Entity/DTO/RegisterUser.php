<?php

namespace App\Entity\DTO;

/**
 * DTO for register user.
 */
class RegisterUser
{
    /**
     * First name of user.
     *
     * @var string First name of user.
     */
    public $firstName = 'first name';

    /**
     * Last name of user.
     *
     * @var string Last name of user.
     */
    public $lastName = 'last name';

    /**
     * Email of user.
     *
     * @var string Email of user.  This will also become the username.
     */
    public $email = '';

    /**
     * Password of user.
     *
     * @var string The plaintext password.
     */
    public $password = '';

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
     * @param string|null $name Value of user's first name.
     *
     * @return self
     */
    public function setFirstName(?string $name): self
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
     * Set last name of user
     *
     * @param string|null $name Value of user's last name.
     *
     * @return self
     */
    public function setLastName(?string $name): self
    {
        $this->lastName = $name;

        return $this;
    }

    /**
     * Email of user.
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set email of user.
     *
     * @param string|null $email Value of user's email.
     *
     * @return self
     */
    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get password of user.
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Set user password.
     *
     * @param string|null $password User password.
     *
     * @return self
     */
    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }
}
