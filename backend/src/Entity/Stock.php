<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\Interfaces\StockInterface;
use App\Entity\Interfaces\ExchangeInterface;
use App\Entity\Interfaces\MarketInterface;
use App\Entity\Interfaces\SecurityInterface;
use App\Entity\Exchange;
use App\Entity\Market;
use App\Entity\Security;

/**
 * Stock
 *
 * @ORM\Entity(repositoryClass="App\Repository\StockRepository")
 */
class Stock implements Interfaces\StockInterface
{
    use Traits\IdentifierTrait;
    use Traits\CreatedTrait;
    use Traits\UpdatedTrait;
    use Traits\CodeTrait;
    use Traits\TitleTrait;

    /**
     * Exchange where stock can be found
     *
     * @var Exchange
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Exchange", inversedBy="stocks")
     * @Assert\NotBlank()
     */
    protected Exchange $exchange;

    /**
     * Market where stock can be bought
     *
     * @var Market
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Market", inversedBy="stocks")
     * @Assert\NotBlank()
     */
    protected Market $market;

    /**
     * Security where that describes the stock
     *
     * @var Security
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Security", inversedBy="stocks")
     * @Assert\NotBlank()
     */
    protected Security $security;

    /**
     * Get related Exchange
     *
     * @return ExchangeInterface
     */
    public function getExchange(): ExchangeInterface
    {
        return $this->exchange;
    }

    /**
     * Set related Exchange
     *
     * @param ExchangeInterface $exchange Value of entity.
     *
     * @return self
     */
    public function setExchange(ExchangeInterface $exchange): self
    {
        $this->exchange = $exchange;

        return $this;
    }

    /**
     * Get related Market
     *
     * @return MarketInterface
     */
    public function getMarket(): MarketInterface
    {
        return $this->market;
    }

    /**
     * Set related Market
     *
     * @param MarketInterface $market Value of entity.
     *
     * @return self
     */
    public function setMarket(MarketInterface $market): self
    {
        $this->market = $market;

        return $this;
    }

    /**
     * Get related Security
     *
     * @return SecurityInterface
     */
    public function getSecurity(): SecurityInterface
    {
        return $this->security;
    }

    /**
     * Set related Security
     *
     * @param SecurityInterface $security Value of entity.
     *
     * @return self
     */
    public function setSecurity(SecurityInterface $security): self
    {
        $this->security = $security;

        return $this;
    }
}
