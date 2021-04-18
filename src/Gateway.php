<?php

namespace Omnipay\Anypay;

use Omnipay\Common\AbstractGateway;
use Omnipay\Anypay\Message\NotificationRequest;
use Omnipay\Anypay\Message\PurchaseRequest;

/**
 * @method \Omnipay\Common\Message\RequestInterface completeAuthorize(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface capture(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface completePurchase(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface refund(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface void(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface createCard(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface updateCard(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface deleteCard(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface authorize(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface fetchTransaction(array $options = [])
 */
class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'Anypay';
    }

    public function getDefaultParameters()
    {
        return [
            'merchant_id' => '',
            'secret_key'  => '',
            'signature'   => 'sha256',
            'success_url' => null,
            'fail_url'    => null,
        ];
    }

    public function getMerchantId()
    {
        return $this->getParameter('merchant_id');
    }

    public function setMerchantId($value)
    {
        return $this->setParameter('merchant_id', $value);
    }

    public function getSecretKey()
    {
        return $this->getParameter('secret_key');
    }

    public function setSecretKey($value)
    {
        return $this->setParameter('secret_key', $value);
    }

    public function getSuccessUrl()
    {
        return $this->getParameter('success_url');
    }

    public function setSuccessUrl($value)
    {
        return $this->setParameter('success_url', $value);
    }

    public function getFailUrl()
    {
        return $this->getParameter('fail_url');
    }

    public function setFailUrl($value)
    {
        return $this->setParameter('fail_url', $value);
    }

    public function getSignature()
    {
        return $this->getParameter('signature');
    }

    public function setSignature($value)
    {
        return $this->setParameter('signature', $value);
    }

    public function setMd5Signature()
    {
        return $this->setParameter('signature', 'md5');
    }

    public function setSha256Signature()
    {
        return $this->setParameter('signature', 'sha256');
    }

    /**
     * @param  array  $parameters
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function purchase(array $parameters = [])
    {
        return $this->createRequest(PurchaseRequest::class, $parameters);
    }

    /**
     * Handle notification callback.
     * Replaces completeAuthorize() and completePurchase()
     *
     * @return \Omnipay\Common\Message\AbstractRequest|NotificationRequest
     */
    public function acceptNotification(array $parameters = [])
    {
        return $this->createRequest(NotificationRequest::class, $parameters);
    }

    public function __call($name, $arguments)
    {
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface fetchTransaction(array $options = [])
    }
}
