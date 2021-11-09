<?php 

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('vendor/autoload.php');

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$log = new Logger('main');
$sh = new StreamHandler('log/all.log', Logger::DEBUG);
$log->pushHandler($sh);


$redis = new Redis();
 
$redis->connect('localhost', 6379);

$redis->set("test_php_key", "test php value");
echo $redis->get("test_php_key");
echo "<br>";

echo memory_get_usage() . " потребляемые ресурсы" . "<br>";
$log->debug(memory_get_usage());
