<?php

namespace App\Entity\Interfaces;

/**
 * Interface for Stocks.
 */
interface StockInterface extends
    IdentifierInterface,
    CreatedInterface,
    UpdatedInterface,
    CodeInterface,
    TitleInterface
{
    /**
     * Get related Exchange
     *
     * @return ExchangeInterface
     */
    public function getExchange(): ExchangeInterface;

    /**
     * Set related Exchange
     *
     * @param ExchangeInterface $exchange
     *
     * @return self
     */
    public function setExchange(ExchangeInterface $exchange): self;

    /**
     * Get related Market
     *
     * @return MarketInterface
     */
    public function getMarket(): ?MarketInterface;

    /**
     * Set related Market
     *
     * @param MarketInterface $market
     *
     * @return self
     */
    public function setMarket(MarketInterface $market): self;

    /**
     * Get related Security
     *
     * @return SecurityInterface
     */
    public function getSecurity(): ?SecurityInterface;

    /**
     * Set related Security
     *
     * @param SecurityInterface $security
     *
     * @return self
     */
    public function setSecurity(SecurityInterface $security): self;
}
