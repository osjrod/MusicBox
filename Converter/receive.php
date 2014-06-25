<?php
include 'database.php'; 
require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPConnection;

// Create the Books model 
class Archivos extends Illuminate\Database\Eloquent\Model {

	protected $table      = 'archivos';
    protected $fillable   = array('origen','destino','direccion');
    protected $guarded    = array('id');
    public    $timestamps = false;

    public static function store($origen, $destino)
    {
        $inform = Archivos::create(
            array(
                'origen'   => $origen,
                'destino'  => $destino
            )
        );
        return $inform;
    }

    
    public static function edit($id, $direccion)
    {
        $archivos = Archivos::findOrFail($id);
        $archivos->direccion    = $direccion;
        $archivos->save();
        return $archivos;
    }

    
}
 

 $archivo = Archivos::store('origen','destino');
  echo "$archivo";

$connection = new AMQPConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();


$channel->queue_declare('hello', false, false, false, false);

echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";

$callback = function($msg) {
  echo " [x] Received ", $msg->body, "\n";
  exec("string");

 //aki convierto ydespues update

};

$channel->basic_consume('hello', '', false, true, false, false, $callback);

while(count($channel->callbacks)) {
    $channel->wait();
}

$channel->close();
$connection->close();