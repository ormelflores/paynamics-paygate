<?php

namespace Paynamics\Paygate;

use Exception;
use Paynamics\Paygate\Constants\Secure3d;
use Paynamics\Paygate\Constants\TransactionType;

class Client implements ClientInterface
{
    private string $merchantId;

    private string $merchantKey;

    private string $productionUrl;

    private string $serverIP;

    private bool $sandbox;

    private string $sandboxUrl;

    public function __construct(array $config = [])
    {
        $this->setConfig($config);
    }

    /**
     * Sets configuration
     */
    public function setConfig(array $config): self
    {
        if (isset($config['merchant_id']))
        {
            $this->setMerchantId($config['merchant_id']);
        }

        if (isset($config['merchant_key']))
        {
            $this->setMerchantKey($config['merchant_key']);
        }

        if (isset($config['sandbox']))
        {
            $this->setSandbox($config['sandbox']);
        }

        if (isset($config['sandbox_url']))
        {
            $this->sandboxUrl = $config['sandbox_url'];
        }

        if (isset($config['production_url']))
        {
            $this->productionUrl = $config['production_url'];
        }

        if (isset($config['server_ip']))
        {
            $this->serverIP = $config['server_ip'];
        }

        return $this;
    }

    /**
     * Returns the request URL to be used. Depends if sandbox or production.
     */
    public function getRequestUrl(): string
    {
        return $this->isSandbox() ? $this->sandboxUrl : $this->productionUrl;
    }

    /**
     * Returns if sandbox or production.
     */
    public function isSandbox(): bool
    {
        return $this->sandbox;
    }

    /**
     * Sets if sandbox or production.
     *
     * @throws Exception
     */
    public function setSandbox(bool $sandbox = false): self
    {
        if (! is_bool($sandbox))
        {
            throw new Exception('Sandbox value should be boolean');
        }

        $this->sandbox = $sandbox;

        return $this;
    }

    /**
     * Returns assigned Merchant ID
     */
    public function getMerchantId(): string
    {
        return $this->merchantId;
    }

    /**
     * Returns assigned Merchant Key
     */
    public function getMerchantKey(): string
    {
        return $this->merchantKey;
    }

    /**
     * Returns server IP Address
     */
    public function getServerIPAddress(): string
    {
        return $this->serverIP;
    }

    /**
     * Sets Merchant ID
     *
     * @throws Exception
     */
    public function setMerchantId($merchantId): self
    {
        if (! is_string($merchantId))
        {
            throw new Exception('Merchant ID should be string');
        }

        $this->merchantId = $merchantId;

        return $this;
    }

    /**
     * Sets Merchant Key
     *
     * @throws Exception
     */
    public function setMerchantKey($merchantKey): self
    {
        if (! is_string($merchantKey))
        {
            throw new Exception('Merchant Key should be string');
        }

        $this->merchantKey = $merchantKey;

        return $this;
    }

    /**
     * Create new request
     */
    public function createRequest(RequestBodyInterface $requestBody): RequestInterface
    {
        return new PaygateRequest($this, $requestBody);
    }

    /**
     * Executes Responsive Payment Transaction
     */
    public function responsivePayment(RequestBodyInterface $requestBody, string $requestId, string $transactionType = TransactionType::SALE, string $secure3d = Secure3d::TRY3D, ?string $expiryLimit = null)
    {
        if (! in_array($transactionType, TransactionType::toArray()))
        {
            throw new Exception('Invalid transaction type');
        }

        if (! in_array($secure3d, Secure3d::toArray()))
        {
            throw new Exception('Invalid Secure3d option');
        }

        $requestBody->setAttributes([
            '_method' => __METHOD__,
            'client_ip' => isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : request()->ip,
            'request_id' => $requestId,
            'secure3d' => $secure3d,
            'trxtype' => $transactionType,
            'expiry_limit' => $expiryLimit ? $this->dateTimeFormat($expiryLimit) : null,
        ]);

        return $this->createRequest($requestBody)->generateForm();
    }

    /**
     * Converts valid date time into format 'Y-m-d H:i'
     * To be used in expiry limit
     */
    private function dateTimeFormat(string $time): string
    {
        if (strtotime($time) === false)
        {
            throw new Exception('Invalid datetime format');
        }

        return date('Y-m-d H:i', strtotime($time));
    }
}
