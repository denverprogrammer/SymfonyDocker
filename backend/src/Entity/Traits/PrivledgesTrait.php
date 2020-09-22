<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Interfaces\PrivledgesInterface;

/**
 * Privledges related to a subscription attached to a trackrecord
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
     * {inheritdoc}
     */
    public function getTrackrecordActions(): array
    {
        return $this->trackrecordActions;
    }

    /**
     * {inheritdoc}
     */
    public function setTrackrecordActions(array $actions): self
    {
        $this->trackrecordActions = $actions;

        return $this;
    }

    /**
     * {inheritdoc}
     */
    public function getSubscriptionActions(): array
    {
        return $this->subscriptionActions;
    }

    /**
     * {inheritdoc}
     */
    public function setSubscriptionActions(array $actions): self
    {
        $this->subscriptionActions = $actions;

        return $this;
    }

    /**
     * {inheritdoc}
     */
    public function getPendingOrderActions(): array
    {
        return $this->pendingOrderActions;
    }

    /**
     * {inheritdoc}
     */
    public function setPendingOrderActions(array $actions): self
    {
        $this->pendingOrderActions = $actions;

        return $this;
    }

    /**
     * {inheritdoc}
     */
    public function getFilledOrderActions(): array
    {
        return $this->filledOrderActions;
    }

    /**
     * {inheritdoc}
     */
    public function setFilledOrderActions(array $actions): self
    {
        $this->filledOrderActions = $actions;

        return $this;
    }

    /**
     * {inheritdoc}
     */
    public function getOpenPositionActions(): array
    {
        return $this->openPositionActions;
    }

    /**
     * {inheritdoc}
     */
    public function setOpenPositionActions(array $actions): self
    {
        $this->openPositionActions = $actions;

        return $this;
    }

    /**
     * {inheritdoc}
     */
    public function getClosedPositionActions(): array
    {
        return $this->closedPositionActions;
    }

    /**
     * {inheritdoc}
     */
    public function setClosedPositionActions(array $actions): self
    {
        $this->closedPositionActions = $actions;
        
        return $this;
    }
}
