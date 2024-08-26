<?php

namespace Laravel\Paynamics\Paygate;

use Paynamics\Paygate\Mixins\AttributesToXml;
use Paynamics\Paygate\Mixins\SignatureGenerator;

class RequestBody implements RequestBodyInterface
{
    use AttributesToXml, SignatureGenerator;

    protected $fillable = [
        '_method',
        'orders',
        'mid',
        'request_id',
        'ip_address',
        'notification_url',
        'response_url',
        'cancel_url',
        'mtac_url',
        'descriptor_note',
        'fname',
        'lname',
        'mname',
        'address1',
        'address2',
        'city',
        'state',
        'country',
        'zip',
        'secure3d',
        'trxtype',
        'email',
        'phone',
        'mobile',
        'client_ip',
        'amount',
        'currency',
        'expiry_limit',
        'mlogo_url',
        'pmethod',
        'org_trxid',
        'org_trxid2',
        'dispute_start_date',
        'dispute_end_date',
        'signature',
    ];

    protected array $attributes = [];

    // RequestBody constructor.
    public function __construct(array $attributes = [])
    {
        foreach ($this->fillable as $key)
        {
            $this->setAttribute($key, null);
        }

        $this->setAttributes($attributes);
    }

    // Sets the default request body content
    public function setDefaults(ClientInterface $client): self
    {
        $defaults = [
            'mid' => $client->getMerchantId(),
            'ip_address' => $client->getServerIPAddress(),
        ];

        $this->setAttributes(array_replace($this->getAttributes(), $defaults));

        if ($this->_method == 'responsivePayment')
        {
            unset($this->attributes['org_trxid']);
            unset($this->attributes['org_trxid2']);
            unset($this->attributes['dispute_start_date']);
            unset($this->attributes['dispute_end_date']);
        }

        $this->generateRequestSignature($client);

        return $this;
    }

    public function setItemGroup(ItemGroupInterface $itemGroup)
    {
        $this->setAttribute('orders', $itemGroup->toArray());
        $this->setAttribute('amount', $itemGroup->getTotal());

        return $this;
    }

    public function getAttribute($key): mixed
    {
        if ((bool) $key && in_array($key, $this->fillable))
        {
            return $this->attributes[$key];
        }
    }
    
    public function getAttributes(): array
    {
        return $this->attributes;
    }
    
    public function setAttributes(array $attributes): self
    {
        foreach ($attributes as $key => $value)
        {
            $this->setAttribute($key, $value);
        }

        return $this;
    }

    /**
     * @param  string  $key
     * @param  string  $value
     */
    public function setAttribute($key, $value): self
    {
        if (in_array($key, $this->fillable))
        {
            $this->attributes[$key] = $value;
        }

        return $this;
    }

    public function __get($key): mixed
    {
        return $this->getAttribute($key);
    }

    public function __set(string $key, mixed $value)
    {
        $this->setAttribute($key, $value);
    }
}
