<?php

namespace App\Entity\Interfaces;

/**
 * Notifications for a entity
 */
interface NotificationsInterface
{
    /**
     * Get notifications value of record.
     *
     * @return boolean
     */
    public function getNotifications(): bool;

    /**
     * Set notifications value of record.
     *
     * @param boolean $notifications Value of notifications.
     *
     * @return self
     */
    public function setNotifications(bool $notifications): self;
}
