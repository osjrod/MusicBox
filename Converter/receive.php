<?php
include 'Archivo.php'; 
require_once __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPConnection;

// Create the Books model 
class Archivo extends Illuminate\Database\Eloquent\Model {

	protected $table      = 'archivos';
    protected $fillable   = array('origen','destino','direccion');
    protected $guarded    = array('id');
    public    $timestamps = false;

    
    public static function edit($id, $direccion)
    {
        $archivos = Archivo::findOrFail($id);
        $archivos->direccion    = $direccion;
        $archivos->save();
        return $archivos;
    }
}

$connection = new AMQPConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();
$channel->queue_declare('hello', false, false, false, false);
echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";
$callback = function($msg) {
  echo " [x] Received ", $msg->body, "\n";
  $fila = json_decode($msg->body,true);
  foreach ($fila as $key => $value){
    if($key == "origen")
        $origen = $value;
    if($key == "destino")
        $destino = $value;
    if($key == "id")
        $id = $value;
  }
  	$nombreArchivo = basename($origen); 
  	$nombreSinExtension = end(array_reverse(explode(".", $nombreArchivo)));
  	$nuevoDestino = "/home/liliala/ArchivosMusicBox/Convertidos/$nombreSinExtension.$destino"
    exec("./ffmpeg -i $origen $nuevoDestino");
    Archivo::edit($id,"$nuevoDestino");
};

$channel->basic_consume('hello', '', false, true, false, false, $callback);

while(count($channel->callbacks)) {
    $channel->wait();
}

$channel->close();
$connection->close();