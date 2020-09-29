<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\EquatableInterface;
use App\Entity\Interfaces\SubscriptionInterface;
use App\Entity\Interfaces\UserInterface;
use App\Entity\Subscription;
use Symfony\Component\Security\Core\User\UserInterface as SymfonyUserInterface;

/**
 * User class
 *
 * @UniqueEntity(fields={"username"})
 * @UniqueEntity(fields={"email"})
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface, EquatableInterface
{
    use Traits\IdentifierTrait;
    use Traits\CreatedTrait;
    use Traits\UpdatedTrait;
    use Traits\ViewStateTrait;
    use Traits\EmailTrait;
    use Traits\UsernameTrait;
    use Traits\SubscriptionCollectionTrait;
    use Traits\ViewStateTrait;
    use Traits\ConfirmedTrait;
    use Traits\TokenTrait;
    use Traits\PasswordTrait;
    use Traits\AgreementTrait;
    use Traits\NotificationsTrait;

    /**
     * User roles
     *
     * @var string[]
     *
     * @ORM\Column(type="json")
     */
    private array $roles = [];

    /**
     * Plain text password (used by api)
     *
     * @var string|null
     *
     * @SerializedName("password")
     */
    private ?string $plainPassword = null;

    /**
     * Collection of subscriptions
     *
     * @var Collection|SubscriptionInterface[]
     *
     * @ORM\OneToMany(
     *      targetEntity="App\Entity\Subscription",
     *      mappedBy="user",
     *      cascade={"persist"},
     *      orphanRemoval=true
     * )
     * @Assert\Valid()
     */
    protected Collection $subscriptions;

    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->setSubscriptions(new ArrayCollection());
    }

    /**
     * Gets roles.
     *
     * @see UserInterface
     *
     * @return string[]
     */
    public function getRoles(): array
    {
        $roles = $this->roles;

        return array_unique($roles);
    }

    /**
     * Set user roles.
     *
     * @param array $roles Value of entity.
     *
     * @return self
     */
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Gets salt.
     *
     * @see UserInterface
     *
     * @return void
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * Removes plain text password.
     *
     * @see UserInterface
     *
     * @return void
     */
    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }

    /**
     * Get plain password.
     *
     * @return string|null
     */
    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    /**
     * Set plain password.
     *
     * @param string|null $password Value of entity.
     *
     * @return self
     */
    public function setPlainPassword(?string $password = null): self
    {
        $this->plainPassword = $password;

        return $this;
    }

    /**
     * Check if the given user is equal to the current user.
     *
     * @param SymfonyUserInterface $user User to compare.
     *
     * @return boolean
     */
    public function isEqualTo(SymfonyUserInterface $user)
    {
        return $user instanceof UserInterface === false &&
            $this->getEmail() === $user->getEmail() &&
            $this->getUsername() === $user->getUsername();
    }
}
