<?php

namespace App\Entity\Traits;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use App\Entity\Interfaces;

/**
 * Represents the last time the record was changed.
 */
trait UpdatedTrait
{
    /**
     * Date & time record was changed.
     *
     * @var DateTime
     *
     * @ORM\Column(name="updated",type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    protected $updated;

    /**
     * {inheritdoc}
     */
    public function getUpdated(): DateTime
    {
        return $this->updated;
    }

    /**
     * {inheritdoc}
     */
    public function setUpdated(DateTime $value): Interfaces\UpdatedInterface
    {
        $this->updated = $value;

        return $this;
    }
}
