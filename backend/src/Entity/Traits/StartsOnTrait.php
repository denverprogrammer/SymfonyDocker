<?php

namespace App\Entity\Traits;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Interfaces\StartsOnInterface;

/**
 * Expiration of entity.
 */
trait StartsOnTrait
{
    /**
     * Date & time when subscription starts
     *
     * @var DateTime|null
     *
     * @ORM\Column(type="datetime")
     */
    protected ?DateTime $startsOn = null;

    /**
     * Gets the date and time the subscription was started
     *
     * @return DateTime|null
     */
    public function getStartsOn(): ?DateTime
    {
        return $this->startsOn;
    }

    /**
     * Sets the date and time the subscription was started
     *
     * @param DateTime|null $startsOn Value of entity.
     *
     * @return self
     */
    public function setStartsOn(?DateTime $startsOn = null): self
    {
        $this->startsOn = $startsOn;

        return $this;
    }
}
