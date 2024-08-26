<?php

namespace Laravel\Paynamics\Paygate;

interface ItemGroupInterface
{
    // Adds an Item to the ItemGroup
    public function addItem(ItemInterface|array $item): self;

    // Get total amount of items in ItemGroup
    public function getTotal(): string;

    // Returns ItemGroup to array
    public function toArray(): array;
}
