<?php

namespace PP5\MovieUniverseBundle\Handler;

use PP5\MovieUniverseBundle\Entity\Order\Order;

class PaymentProviderURLHandler {

    public static function generateURL(Order $order, $total, $url, $urlc, $customerId)
    {
        $data = array(
            'id' => $customerId,
            'amount' => $total,
            'currency' => 'PLN',
            'description' => 'Opłata za wypożecznie filmów [NR: '.$order->getNumber()."]",
            'control' => $order->getNumber(),
            'URLC' => $urlc,
            'firstname' => $order->getUser()->getName(),
            'lastname' => $order->getUser()->getSurname(),
            'email' => $order->getUser()->getEmail(),
            'URL' => $url,
            'type' => 0,
            'txtguzik' => 'Wróć do Movie Universe'
        );

        $params = http_build_query($data);

        $url = sprintf(
            '%s?%s',
            'https://ssl.dotpay.pl/',
            $params
        );

        return $url;
    }

} 