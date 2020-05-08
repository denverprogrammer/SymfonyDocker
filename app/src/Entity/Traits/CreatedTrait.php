<?php

namespace App\Entity\Traits;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Represents the when record was created.
 */
trait CreatedTrait
{
    /**
     * @var DateTime Date & time record was created.
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created", type="datetime")
     */
    protected $created;

    /**
     * Date & time record was created.
     *
     * @return DateTime
     */
    public function getCreated() : DateTime
    {
        return $this->created;
    }
}
