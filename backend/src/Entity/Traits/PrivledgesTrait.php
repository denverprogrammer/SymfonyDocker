<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Interfaces\PrivledgesInterface;

/**
 * Privledges related to a subscription attached to a trackrecord.
 */
trait PrivledgesTrait
{
    /**
     * Subscription privledges for a trackrecord
     *
     * @var string[]
     *
     * @ORM\Column(type="simple_array", length=8)
     * @Assert\NotBlank()
     */
    protected array $trackrecordActions;

    /**
     * Subscription privledges for subscriptions attached to a trackrecord
     *
     * @var string[]
     *
     * @ORM\Column(type="simple_array", length=8)
     * @Assert\NotBlank()
     */
    protected array $subscriptionActions;

    /**
     * Subscription privledges for pending orders attached to a trackrecord
     *
     * @var string[]
     *
     * @ORM\Column(type="simple_array", length=8)
     * @Assert\NotBlank()
     */
    protected array $pendingOrderActions;

    /**
     * Subscription privledges for filled orders attached to a trackrecord
     *
     * @var string[]
     *
     * @ORM\Column(type="simple_array", length=8)
     * @Assert\NotBlank()
     */
    protected array $filledOrderActions;

    /**
     * Subscription privledges for open positions attached to a trackrecord
     *
     * @var string[]
     *
     * @ORM\Column(type="simple_array", length=8)
     * @Assert\NotBlank()
     */
    protected array $openPositionActions;

    /**
     * Subscription privledges for closed positions attached to a trackrecord
     *
     * @var string[]
     *
     * @ORM\Column(type="simple_array", length=8)
     * @Assert\NotBlank()
     */
    protected array $closedPositionActions;

    /**
     * Gets trackrecord actions
     *
     * @return array
     */
    public function getTrackrecordActions(): array
    {
        return $this->trackrecordActions;
    }

    /**
     * Sets trackrecord actions
     *
     * @param array $actions Value of entity.
     *
     * @return self
     */
    public function setTrackrecordActions(array $actions): self
    {
        $this->trackrecordActions = $actions;

        return $this;
    }

    /**
     * Gets subscription actions
     *
     * @return array
     */
    public function getSubscriptionActions(): array
    {
        return $this->subscriptionActions;
    }

    /**
     * Sets subscription actions
     *
     * @param array $actions Value of entity.
     *
     * @return self
     */
    public function setSubscriptionActions(array $actions): self
    {
        $this->subscriptionActions = $actions;

        return $this;
    }

    /**
     * Gets pending order actions
     *
     * @return array
     */
    public function getPendingOrderActions(): array
    {
        return $this->pendingOrderActions;
    }

    /**
     * Sets pending order actions
     *
     * @param array $actions Value of entity.
     *
     * @return self
     */
    public function setPendingOrderActions(array $actions): self
    {
        $this->pendingOrderActions = $actions;

        return $this;
    }

    /**
     * Gets filled order actions
     *
     * @return array
     */
    public function getFilledOrderActions(): array
    {
        return $this->filledOrderActions;
    }

    /**
     * Sets filled order actions
     *
     * @param array $actions Value of entity.
     *
     * @return self
     */
    public function setFilledOrderActions(array $actions): self
    {
        $this->filledOrderActions = $actions;

        return $this;
    }

    /**
     * Gets open position actions
     *
     * @return array
     */
    public function getOpenPositionActions(): array
    {
        return $this->openPositionActions;
    }

    /**
     * Sets open position actions
     *
     * @param array $actions Value of entity.
     *
     * @return self
     */
    public function setOpenPositionActions(array $actions): self
    {
        $this->openPositionActions = $actions;

        return $this;
    }

    /**
     * Gets closed position actions
     *
     * @return array
     */
    public function getClosedPositionActions(): array
    {
        return $this->closedPositionActions;
    }

    /**
     * Sets closed positions actions
     *
     * @param array $actions Value of entity.
     *
     * @return self
     */
    public function setClosedPositionActions(array $actions): self
    {
        $this->closedPositionActions = $actions;
        
        return $this;
    }
}
