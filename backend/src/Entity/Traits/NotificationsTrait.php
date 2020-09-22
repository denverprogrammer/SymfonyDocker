<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * Notification for a entity
 */
trait NotificationsTrait
{
    /**
     * Notifications value of record
     *
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=false, options={"default": "0"})
     */
    private $notifications = true;

    /**
     * Get notifications value of record.
     *
     * @return boolean
     */
    public function getNotifications(): bool
    {
        return $this->notifications;
    }

    /**
     * Set notifications value of record.
     *
     * @param boolean $value Value of notifications.
     *
     * @return self
     */
    public function setNotifications(bool $notifications): self
    {
        $this->notifications = $notifications;

        return $this;
    }
}
