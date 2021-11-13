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
	$channel->queue_declare('Order food', false, true, false, false);
	$channel->queue_declare('Pay for food', false, true, false, false);
	$channel->queue_declare('Deliver food', false, true, false, false);
	$channel->queue_declare('Leave a review', false, true, false, false);
	
	$msg1 = new AMQPMessage('Order food');
	$msg2 = new AMQPMessage('Pay for food');
	$msg3 = new AMQPMessage('Deliver food');
	$msg4 = new AMQPMessage('Leave a review');
	
	$channel->basic_publish($msg1, '', 'Order food');
	$channel->basic_publish($msg2, '', 'Pay for food');
	$channel->basic_publish($msg3, '', 'Deliver food');
	$channel->basic_publish($msg4, '', 'Leave a review');

	echo ' [x] Sent ' .$msg1->body."\n<br />";
	echo ' [x] Sent ' .$msg2->body."\n<br />";
	echo ' [x] Sent ' .$msg3->body."\n<br />";
	echo ' [x] Sent ' .$msg4->body."\n<br />";
	
	$channel->close();
	$connection->close();
}

catch (AMQPProtocolChannelException $e) {
	echo $e->getMessage();
}

catch (AMQPException $e) {
	echo $e->getMessage();
}