<?php

namespace App\Entity\Traits;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Interfaces\EndsOnInterface;

/**
 * EndsOn of entity.
 */
trait EndsOnTrait
{
    /**
     * Date & time when subscription expires
     *
     * @var DateTime|null
     *
     * @ORM\Column(type="datetime")
     */
    protected ?DateTime $endsOn = null;

    /**
     * Gets the date and time the subscription was expired
     *
     * @return DateTime|null
     */
    public function getEndsOn(): ?DateTime
    {
        return $this->endsOn;
    }

    /**
     * Sets the date and time the subscription was expired
     *
     * @param DateTime|null $endsOn When entity expires.
     *
     * @return self
     */
    public function setEndsOn(?DateTime $endsOn = null): self
    {
        $this->endsOn = $endsOn;

        return $this;
    }
}
