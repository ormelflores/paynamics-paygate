<?php

namespace Paynamics\Paygate;

class PaygateRequest implements RequestInterface
{
    private ClientInterface $client;

    private $requestBody;

    public function __construct(ClientInterface $client, RequestBodyInterface $requestBody)
    {
        $this->setClient($client);
        $this->setRequestBody($requestBody);
    }

    // Returns the assigned  client
    public function getClient(): ClientInterface
    {
        return $this->client;
    }

    // Sets the  client
    public function setClient(ClientInterface $client): self
    {
        $this->client = $client;

        return $this;
    }

    // Returns the assigned request body
    public function getRequestBody(): RequestBodyInterface
    {
        return $this->requestBody;
    }

    // Sets the request body
    public function setRequestBody(RequestBodyInterface $requestBody): self
    {
        $this->requestBody = $requestBody;

        return $this;
    }

    // Creates an auto-submit form that will redirect to the payment gateway
    public function generateForm(): string
    {
        $client = $this->getClient();
        $url = $client->getRequestUrl();
        $requestBody = $this->getRequestBody();
        $requestBody->setDefaults($client);

        // Generate auto-submit form
        $form = '<form name="paygate_frm" method="POST" action="'.$url.'">';
        $form .= '<input type="hidden" name="paymentrequest" value="'.base64_encode($requestBody->__toXmlString()).'">';
        $form .= '</form>';
        $form .= '<script>document.paygate_frm.submit();</script>';

        return $form;
    }
}
