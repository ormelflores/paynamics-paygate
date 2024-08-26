<?php

namespace Laravel\Paynamics\Paygate\Src;

interface RequestBodyInterface
{
    /**
     * Get request body attribute by key
     *
     * @param  string  $key
     */
    public function getAttribute($key): mixed;

    // Get all request body attributes
    public function getAttributes(): array;

    /**
     * Set request body attribute by key and value
     *
     * @param  string  $key
     * @param  string  $value
     */
    public function setAttribute($key, $value): self;

    // Sets all request body attributes
    public function setAttributes(array $attributes): self;

    // Sets the default request body content
    public function setDefaults(ClientInterface $client): self;

    // Generate Paynamics request signature
    public function generateRequestSignature(ClientInterface $client): self;

    // Override default getter
    public function __get($key): mixed;

    // Override default setter
    public function __set(string $key, mixed $value);

    // Return request body to XML String
    public function __toXmlString(): string;
}
