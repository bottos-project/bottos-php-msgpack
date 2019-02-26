# bottos-php-msgpack

This is bottos's message pack special for php developers

## Usage

#### Demo:
```php
<?php
require 'common.php';

$from  = "bottos";
$to    = "bottos-test-01";
$price = bcmul("1032321.83111", "100000000");

$paramPack = getParamPack($from, $to, $price);

var_dump($paramPack);
//string(128) "dc0003da0006626f74746f73da000e626f74746f732d746573742d3031c5002000000000000000000000000000000000000000000000000000005de39d9a8d58"
```
