<?php

namespace Omnipay\Anypay\Message;

use Omnipay\Common\Exception\InvalidRequestException;

class PurchaseRequest extends AbstractRequest
{

    public function getData()
    {
        $this->validate('amount', 'description', 'transactionId');

        $data = [
            'merchant_id' => $this->getMerchantId(),
            'pay_id'      => $this->getTransactionId(),
            'amount'      => $this->getAmount(),
            'currency'    => $this->getCurrency(),
            'desc'        => $this->getDescription(),
        ];

        if ($this->getSuccessUrl()) {
            $data['success_url'] = $this->getSuccessUrl();
        }

        if ($this->getFailUrl()) {
            $data['fail_url'] = $this->getFailUrl();
        }

        $data['sign'] = $this->getSign();

        return $data;
    }

    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data);
    }

    private function getSign()
    {
        switch ($this->getSignature()) {
            case 'md5':
                return $this->getMd5Signature();
            case 'sha256':
                return $this->getSha256Signature();
            default:
                throw new InvalidRequestException('wrong signature method');
        }
    }

    private function getSha256Signature()
    {
        return hash('sha256', implode(':', [
            $this->getMerchantId(),
            $this->getTransactionId(),
            $this->getAmount(),
            $this->getCurrency(),
            $this->getDescription(),
            $this->getSuccessUrl(),
            $this->getFailUrl(),
            $this->getSecretKey(),
        ]));
    }

    private function getMd5Signature()
    {
        return hash('md5', implode(':', [
            $this->getCurrency(),
            $this->getAmount(),
            $this->getSecretKey(),
            $this->getMerchantId(),
            $this->getTransactionId(),
        ]));
    }

}
