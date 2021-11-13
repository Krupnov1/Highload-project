<?php

error_reporting(E_ALL);
ini_set('display_errors', 1); 

require_once('vendor/autoload.php');
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Exception\AMQPProtocolChannelException;
use PhpAmqpLib\Message\AMQPMessage;


try {
	$connection = new AMQPStreamConnection('localhost', 5672, 'admin', 'password');
	
	$channel = $connection->channel();
	$channel->queue_declare('Pizza', false, true, false, false);
	$channel->queue_declare('Cola', false, true, false, false);
	
	$msg1 = new AMQPMessage('Ordering pizza!');
	$msg2 = new AMQPMessage('Ordering cola!');
	
	$channel->basic_publish($msg1, '', 'Pizza');
	$channel->basic_publish($msg2, '', 'Cola');

	echo ' [x] Sent ' .$msg1->body."\n<br />";
	echo ' [x] Sent ' .$msg2->body."\n<br />";
	
	$channel->close();
	$connection->close();
}

catch (AMQPProtocolChannelException $e) {
	echo $e->getMessage();
}

catch (AMQPException $e) {
	echo $e->getMessage();
}