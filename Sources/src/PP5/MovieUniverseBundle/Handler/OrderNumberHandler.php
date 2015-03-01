<?php

namespace PP5\MovieUniverseBundle\Handler;

class OrderNumberHandler {

    protected $orderId;

    public function __construct($orderId)
    {
        $this->orderId = $orderId;
    }


    public function generateNumber()
    {
        $prefix = $this->generateRandomPrefix();

        $datetime = new \DateTime();

        $day    = $datetime->format('d');
        $month  = $datetime->format('m');
        $year   = $datetime->format('Y');

        $date = sprintf("%s%s%s", $day, $month, $year);

        $suffix = sprintf("%s-%s", "O", $this->orderId);

        return $prefix."/".$date."/".$suffix;
    }

    private function generateRandomPrefix()
    {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

        $str = "";
        $size = strlen( $chars );

        for ($i = 0; $i < 4; $i++)
        {
            $str .= $chars[ rand( 0, $size - 1 ) ];
        }

        return $str;
    }

}