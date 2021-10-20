<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('vendor/autoload.php');

$ts = time();

sleep(2);

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$log = new Logger('main');
$sh = new StreamHandler('log/all.log', Logger::DEBUG);
$log->pushHandler($sh);

echo "Задание 2 Урока 2" . "<br>";
echo "<br>";

echo "Произведем вычисления:" . "<br>";
$a = 4;
$b = 5;
echo $a + $b . "<br>" ;
echo $a * $b . "<br>" ;
echo $a - $b . "<br>" ;
echo $a / $b . "<br>" ;
echo $a % $b . "<br>" ;
echo $a ** $b . "<br>" ;

echo "<br>";

echo "Выстроим города по порядку:" . "<br>";
$citiesArray = [
    'Московская область' => ['Москва', 'Зеленоград', 'Клин'],
    'Ленинградская область' => ['Санкт-Петербург', 'Всеволожск', 'Павловск', 'Кронштадт'],
    'Рязанская область' => ['Шацк', 'Спасск-Рязанский', 'Касимов', 'Кораблино'],
];

foreach($citiesArray as $key => $value) {
    echo $key . ':<br/>';
    $s = " ";
    foreach($value as $my_value) {
        $s .= $my_value . ', ';
    }
    $s = substr_replace($s, '.', -2) . '<br/>';
    echo $s;        
};

echo "<br>";

echo "Выполним вычисления:" . "<br>";
echo "первый аргумент:", $arg1 = rand(0, 1000);
echo "<br/>";
echo "второй аргумент:", $arg2 = rand(0, 1000); 
echo "<br/>";

function mathOperation($arg1, $arg2, $operation) {
    switch($operation) {
        case "+":
            echo $arg1 + $arg2 . " - сумма";
        break;
        case "-":
            echo $arg1 - $arg2 . " - разность";
        break;
        case "*":
            echo $arg1 * $arg2 . " - произведение";
        break;
        case "/":
            echo $arg1 / $arg2 . " - частное";
        break;
        default:
        echo "Значение не верно!!!";
    }
}
mathOperation($arg1, $arg2, "/");
echo "<br>";

$te = time();

echo "<br>";

echo $te - $ts . " время генерации страницы";
$log->debug($te - $ts);

echo "<br>";

echo memory_get_usage() . " потребляемые ресурсы" . "<br>";
$log->debug(memory_get_usage());

echo $foo;