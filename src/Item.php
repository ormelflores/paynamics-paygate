<?php

namespace Paynamics\Paygate;

class Item implements ItemInterface
{
    protected array $details = [];

    public function __construct($details)
    {
        $this->setName($details['name']);
        $this->setQuantity($details['quantity']);
        $this->setAmount($details['amount']);
    }

    /**
     * Sets Item Name
     */
    public function setName(string $name): self
    {
        $this->details['itemname'] = $name;

        return $this;
    }

    /**
     * Sets Item Quantity
     */
    public function setQuantity(int $quantity): self
    {
        $this->details['quantity'] = $quantity;

        return $this;
    }

    /**
     * Sets Item Amount
     */
    public function setAmount(int|float $amount): self
    {
        $this->details['amount'] = number_format($amount, 2, '.', '');

        return $this;
    }

    /**
     * Get Item Details
     */
    public function getDetails(): array
    {
        return $this->details;
    }
}
