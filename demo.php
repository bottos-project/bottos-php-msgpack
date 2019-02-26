<?php
require 'common.php';

$from  = "bottos";
$to    = "bottos-test-01";
$price = bcmul("1032321.83111", "100000000");

$paramPack = getParamPack($from, $to, $price);

var_dump($paramPack);