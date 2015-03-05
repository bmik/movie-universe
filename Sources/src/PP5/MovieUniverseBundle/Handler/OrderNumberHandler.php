<?php

namespace PP5\MovieUniverseBundle\Handler;

class OrderNumberHandler {


    public static function generateNumber($orderId)
    {
        $prefix = self::generateRandomPrefix();

        $datetime = new \DateTime();

        $day    = $datetime->format('d');
        $month  = $datetime->format('m');
        $year   = $datetime->format('Y');

        $date = sprintf("%s%s%s", $day, $month, $year);

        $suffix = sprintf("%s-%s", "O", $orderId);

        return $prefix."/".$date."/".$suffix;
    }

    private static function generateRandomPrefix()
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