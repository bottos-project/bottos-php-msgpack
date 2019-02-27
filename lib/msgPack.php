<?php

class msgPack
{
    const STR16   = "0xda";
    const BIN16   = "0xc5";
    const ARRAY16 = "0xdc";

    public static function uint8Array($num)
    {
        $j = $num;
        if ($j < 0) {
            $j = $num + abs($num) / 256 * 256 + 256;
        }
        if ($j > 255) {
            $j = $num - $num / 256 * 256;
        }

        return $j;
    }

    public static function packUint256($num)
    {
        $hexNum     = dechex($num);
        $hexStrArr  = str_split($hexNum);
        $zeroLength = 64 - count($hexStrArr);
        $arr64      = [];
        for ($i = 0; $i < 64; $i++) {
            if ($i < $zeroLength) {
                $arr64[$i] = '0';
            } else {
                $arr64[$i] = $hexStrArr[$i - $zeroLength];
            }
        }

        $arr32 = [];
        $j     = 0;
        for ($i = 0; $i < count($arr64); $i++) {
            if ($i % 2 == 0) {
                $arr32[$j] = hexdec($arr64[$i] . $arr64[$i + 1]);
                $j++;
            }
        }

        return self::packBin16($arr32);
    }

    public static function packBin16($numArr)
    {
        $numLen  = count($numArr);
        $packs   = [];
        $packs[] = self::uint8Array(hexdec(self::BIN16));
        $packs[] = self::uint8Array($numLen >> 8);
        $packs[] = self::uint8Array($numLen);

        for ($i = 0; $i < $numLen; $i++) {
            $packs[] = $numArr[$i];
        }

        return $packs;
    }

    public static function packStr16($str)
    {

        if (!empty($str)) {
            $strArr = str_split($str);
            $strLen = count($strArr);
        } else {
            $strArr = [];
            $strLen = 0;
        }

        $packs   = [];
        $packs[] = self::uint8Array(hexdec(self::STR16));
        $packs[] = $strLen >> 8;
        $packs[] = $strLen;

        for ($i = 0; $i < $strLen; $i++) {
            $packs[] = ord($strArr[$i]);
        }

        return $packs;
    }

    public static function packArraySize($length)
    {
        $packs   = [];
        $packs[] = self::uint8Array(hexdec(self::ARRAY16));
        $packs[] = self::uint8Array($length >> 8);
        $packs[] = self::uint8Array($length);

        return $packs;
    }
}
