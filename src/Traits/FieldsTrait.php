<?php

namespace Omnipay\Anypay\Traits;

trait FieldsTrait
{

    public function getMerchantId()
    {
        return $this->get('merchant_id');
    }

    public function getTransactionId()
    {
        return $this->get('transaction_id');
    }

    public function getPayId()
    {
        return $this->get('pay_id');
    }

    public function getAmount()
    {
        return $this->normalizeAmount($this->get('amount', 0.0));
    }

    public function getCurrency()
    {
        return $this->get('currency');
    }

    public function getProfit()
    {
        return $this->get('profit');
    }

    public function getEmail()
    {
        return $this->get('email');
    }

    public function getMethod()
    {
        return $this->get('method');
    }

    public function getDate()
    {
        return $this->get('date');
    }

    public function getPayDate()
    {
        return $this->get('pay_date');
    }

    public function getStatus()
    {
        return $this->get('status');
    }

    public function isTest()
    {
        return (bool) $this->get('test', false);
    }

    public function getSign()
    {
        return $this->get('sign');
    }

    private function get($key, $default = null)
    {
        $array = $this->getData();

        if (!is_array($array)) {
            return $default;
        }

        if (is_null($key)) {
            return $array;
        }

        if (array_key_exists($key, $array)) {
            return $array[$key];
        }

        if (strpos($key, '.') === false) {
            return $array[$key] ?? $default;
        }

        foreach (explode('.', $key) as $segment) {
            if (is_array($array) && array_key_exists($segment, $array)) {
                $array = $array[$segment];
            } else {
                return $default;
            }
        }

        return $array;
    }

    /**
     * Normalize amount.
     *
     * @param string|float|int $amount The value.
     *
     * @return string The API value.
     */
    private function normalizeAmount($amount = 0)
    {
        return number_format(round(floatval($amount), 2, PHP_ROUND_HALF_DOWN), 2, '.', '');
    }
}
