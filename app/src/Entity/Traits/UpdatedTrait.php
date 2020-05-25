<?php

namespace App\Entity\Traits;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

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
     * Date and time record was changed.
     *
     * @return DateTime
     */
    public function getUpdated(): DateTime
    {
        return $this->updated;
    }
}
