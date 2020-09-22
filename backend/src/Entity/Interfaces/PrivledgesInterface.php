<?php

namespace App\Entity\Interfaces;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\Interfaces\SubscriptionInterface;

/**
 * Interface for subscription privledges related to a trackrecord.
 */
interface PrivledgesInterface
{
    /**
     * Gets trackrecord actions
     *
     * @return array
     */
    public function getTrackrecordActions(): array;

    /**
     * Sets trackrecord actions
     *
     * @param array $actions
     *
     * @return self
     */
    public function setTrackrecordActions(array $actions): self;

    /**
     * Gets subscription actions
     *
     * @return array
     */
    public function getSubscriptionActions(): array;

    /**
     * Sets subscription actions
     *
     * @param array $actions
     *
     * @return self
     */
    public function setSubscriptionActions(array $actions): self;

    /**
     * Gets pending order actions
     *
     * @return array
     */
    public function getPendingOrderActions(): array;

    /**
     * Sets pending order actions
     *
     * @param array $actions
     *
     * @return self
     */
    public function setPendingOrderActions(array $actions): self;

    /**
     * Gets filled order actions
     *
     * @return array
     */
    public function getFilledOrderActions(): array;

    /**
     * Sets filled order actions
     *
     * @param array $actions
     *
     * @return self
     */
    public function setFilledOrderActions(array $actions): self;

    /**
     * Gets open position actions
     *
     * @return array
     */
    public function getOpenPositionActions(): array;

    /**
     * Sets open position actions
     *
     * @param array $actions
     *
     * @return self
     */
    public function setOpenPositionActions(array $actions): self;

    /**
     * Gets closed position actions
     *
     * @return array
     */
    public function getClosedPositionActions(): array;

    /**
     * Sets closed positions actions
     *
     * @param array $actions
     *
     * @return self
     */
    public function setClosedPositionActions(array $actions): self;
}
