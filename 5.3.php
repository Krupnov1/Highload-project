<?php 

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('vendor/autoload.php');

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$log = new Logger('main');
$sh = new StreamHandler('log/all.log', Logger::DEBUG);
$log->pushHandler($sh);


$mem = new Memcached();
$mem->addServer('localhost', 11211);
$result = $mem->get("key_name");
if ($result) {
    echo $result;
} else {
    echo "No key found. Adding key to cache.";
    $mem->set("key_name", "Key_name's value from memcached!") or die ("Couldn't save anything to memcached...");
}


echo "<br>";

echo memory_get_usage() . " потребляемые ресурсы" . "<br>";
$log->debug(memory_get_usage());
