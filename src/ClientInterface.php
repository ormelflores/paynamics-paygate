<?php

namespace Paynamics\Paygate;

use Exception;

interface ClientInterface
{
    /**
     * Sets configuration
     *
     * @return self
     */
    public function setConfig(array $config);

    /**
     * Returns the request URL to be used. Depends if sandbox or production.
     *
     * @return string
     */
    public function getRequestUrl();

    /**
     * Returns if sandbox or production.
     *
     * @return bool
     */
    public function isSandbox();

    /**
     * Sets if sandbox or production.
     *
     * @param  bool  $sandbox
     * @return self
     *
     * @throws Exception
     */
    public function setSandbox(bool $sandbox = false);

    /**
     * Returns assigned Merchant ID
     *
     * @return string
     */
    public function getMerchantId();

    /**
     * Returns assigned Merchant Key
     *
     * @return string
     */
    public function getMerchantKey();

    /**
     * Sets Merchant ID
     *
     * @return self
     *
     * @throws Exception
     */
    public function setMerchantId($merchantId);

    /**
     * Sets Merchant Key
     *
     * @return self
     *
     * @throws Exception
     */
    public function setMerchantKey($merchantKey);

    /**
     * Create new request
     *
     * @return RequestInterface
     */
    public function createRequest(RequestBodyInterface $requestBody);

    // Returns server IP Address
    public function getServerIPAddress(): string;
}
