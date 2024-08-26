<?php

namespace Laravel\Paynamics\Paygate;

class ItemGroup implements ItemGroupInterface
{
    protected array $attributes = [];

    public function __construct()
    {
        $this->attributes['items'] = [];
    }

    /**
     * Adds an Item to the ItemGroup
     */
    public function addItem(ItemInterface|array $item): self
    {
        if (is_array($item))
        {
            $item = new Item($item);
        }

        $this->attributes['items']['Items'][] = $item->getDetails();

        return $this;
    }

    public function getTotal(): string
    {
        $total = 0;

        if (isset($this->attributes['items']['Items']))
        {
            foreach ($this->attributes['items']['Items'] as $item)
            {
                $total += ((float) $item['amount'] * (int) $item['quantity']);
            }
        }

        return number_format($total, '2', '.', '');
    }

    public function getAttribute($key)
    {
        if ((bool) $key && array_key_exists($key, $this->attributes))
        {
            return $this->attributes[$key];
        }
    }

    public function __get($key)
    {
        return $this->getAttribute($key);
    }

    public function toArray(): array
    {
        return $this->attributes;
    }
}
