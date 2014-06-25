<?php 

require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('encabezado', false, false, false, false);

$msg = new AMQPMessage('cuerpo');
$channel->basic_publish($msg, '', 'hello');

echo " [x] Sent 'Hello1!'\n";

$channel->close();
$connection->close();

 ?>
