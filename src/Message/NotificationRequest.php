<?php

namespace Omnipay\Anypay\Message;

use Omnipay\Anypay\Traits\FieldsTrait;

class NotificationRequest extends AbstractRequest
{
    use FieldsTrait;

    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getData()
    {
        return $this->httpRequest->request->all();
    }

    /**
     * {@inheritdoc}
     *
     * @param  mixed  $data
     *
     * @return NotificationResponse
     */
    public function sendData($data)
    {
        return $this->response = new NotificationResponse($this, $data);
    }

    /**
     * Check the hash against the data.
     */
    public function isValid()
    {
        if ($this->getSignature() === 'md5') {
            $sign = hash('md5', implode(':', [
                $this->getMerchantId(),
                $this->getAmount(),
                $this->getPayId(),
                $this->getSecretKey(),
            ]));
        } else {
            $sign = hash('sha256', implode(':', [
                $this->getCurrency(),
                $this->getAmount(),
                $this->getPayId(),
                $this->getMerchantId(),
                $this->getStatus(),
                $this->getSecretKey(),
            ]));
        }

        return $this->getSign() === $sign;
    }

}
