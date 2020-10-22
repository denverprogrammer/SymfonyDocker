<?php

namespace App\Entity;

use ApiPlatform\Core\Serializer\Filter\PropertyFilter;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Security
 *
 * @ORM\Entity(repositoryClass="App\Repository\SecurityRepository")
 * @UniqueEntity(fields={"code"})
 */
class Security implements Interfaces\SecurityInterface
{
    use Traits\IdentifierTrait;
    use Traits\CreatedTrait;
    use Traits\UpdatedTrait;
    use Traits\CodeTrait;
    use Traits\TitleTrait;
   
    /**
     * Collection of stocks
     *
     * @var Collection|Stock[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Stock", mappedBy="security")
     */
    private $stocks;

    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->stocks = new ArrayCollection();
    }
    
    /**
     * Collection of stocks
     *
     * @return Collection|Stock[]
     */
    public function getStocks(): Collection
    {
        return $this->stocks;
    }
}
