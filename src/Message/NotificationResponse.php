<?php

namespace Omnipay\Anypay\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\NotificationInterface;
use Omnipay\Anypay\Traits\FieldsTrait;

class NotificationResponse extends AbstractResponse implements NotificationInterface
{
    use FieldsTrait;

    public function getTransactionStatus()
    {
        switch ($this->getStatus()) {
            case 'paid':
                return self::STATUS_COMPLETED;
            default:
                return self::STATUS_PENDING;
        }
    }

    public function isSuccessful()
    {
        return $this->getRequest()->isValid() && $this->getTransactionStatus() === self::STATUS_COMPLETED;
    }

    public function getMessage()
    {
        return $this->getRequest()->isValid() ? sprintf('Callback hash does not match expected value') : null;
    }

}
