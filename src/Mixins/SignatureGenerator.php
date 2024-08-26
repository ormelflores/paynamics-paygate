<?php

namespace Laravel\Paynamics\Paygate\Mixins;

use Laravel\Paynamics\Paygate\ClientInterface;

trait SignatureGenerator
{
    public function generateRequestSignature(ClientInterface $client)
    {
        $signString = $client->getMerchantId().
                    $this->request_id.
                    $this->ip_address.
                    $this->notification_url.
                    $this->response_url.
                    $this->fname.
                    $this->lname.
                    $this->mname.
                    $this->address1.
                    $this->address2.
                    $this->city.
                    $this->state.
                    $this->country.
                    $this->zip.
                    $this->email.
                    $this->phone.
                    $this->client_ip.
                    $this->amount.
                    $this->currency.
                    $this->secure3d.
                    $client->getMerchantKey();

        unset($this->attributes['_method']);

        $this->signature = hash('sha512', $signString);
    }

    public function generateQuerySignature(ClientInterface $client, ?string $response_id, ?string $response_request_id, $request_id)
    {
        $signString = $client->getMerchantId().
        $request_id.
        $response_id.
        $response_request_id.
        $client->getMerchantKey();

        return hash('sha512', $signString);
    }
}
