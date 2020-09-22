<?php

namespace App\Entity\Traits;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Interfaces\StartsOnInterface;

/**
 * Expiration of entity
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
     * {inheritdoc}
     */
    public function getStartsOn(): ?DateTime
    {
        return $this->startsOn;
    }

    /**
     * {inheritdoc}
     */
    public function setStartsOn(?DateTime $startsOn = null): self
    {
        $this->startsOn = $startsOn;

        return $this;
    }
}
