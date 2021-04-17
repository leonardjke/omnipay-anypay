<?php

namespace PHPSTORM_META
{

    /** @noinspection PhpIllegalArrayKeyTypeInspection */
    /** @noinspection PhpUnusedLocalVariableInspection */
    $STATIC_METHOD_TYPES = [
        \Omnipay\Omnipay::create('')               => [
            'Anypay' instanceof \Omnipay\Anypay\Gateway,
        ],
        \Omnipay\Common\GatewayFactory::create('') => [
            'Anypay' instanceof \Omnipay\Anypay\Gateway,
        ],
    ];
}
