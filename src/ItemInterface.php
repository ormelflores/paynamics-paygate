<?php

namespace Laravel\Paynamics\Paygate;

interface ItemInterface
{
    // Sets Item Name
    public function setName(string $name): self;

    // Sets Item Quantity
    public function setQuantity(int $quantity): self;

    // Sets Item Amount
    public function setAmount(int|float $amount): self;

    // Get Item Details
    public function getDetails(): array;
}
