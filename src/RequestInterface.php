<?php

namespace Laravel\Paynamics\Paygate;

interface RequestInterface
{
    // Returns the assigned Paynamics client
    public function getClient(): ClientInterface;

    // Sets the Paynamics client
    public function setClient(ClientInterface $client): self;

    // Returns the assigned request body
    public function getRequestBody(): RequestBodyInterface;

    // Sets the request body
    public function setRequestBody(RequestBodyInterface $requestBody): self;

    // Creates an auto-submit form that will redirect to the payment gateway
    public function generateForm(): string;
}
