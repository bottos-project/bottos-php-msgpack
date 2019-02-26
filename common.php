<?php
require 'lib/msgPack.php';

function getParamPack($from, $to, $price)
{
    $arsize     = msgPack::packArraySize(3);
    $fromArr    = msgPack::packStr16($from);
    $toArr      = msgPack::packStr16($to);
    $priceArr   = msgPack::packUint256($price);
    $mergeArray = array_merge($arsize, $fromArr, $toArr, $priceArr);

    $params     = "";
    for ($i = 0; $i < count($mergeArray); $i++) {
        $params .= str_pad(dechex($mergeArray[$i]), 2, "0", STR_PAD_LEFT);
    }

    return $params;
}