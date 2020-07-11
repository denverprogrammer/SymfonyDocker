<?php

namespace App\Entity\Traits;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use App\Entity\Interfaces;

/**
 * Represents the when record was created.
 */
trait CreatedTrait
{
    /**
     * Date & time record was created.
     *
     * @var DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created",type="datetime")
     */
    protected $created;

    /**
     * {inheritdoc}
     */
    public function getCreated(): DateTime
    {
        return $this->created;
    }

    /**
     * {inheritdoc}
     */
    public function setCreated(DateTime $value): Interfaces\CreatedInterface
    {
        $this->created = $value;

        return $this;
    }
}
