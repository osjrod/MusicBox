<?php
include 'database.php'; 
require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPConnection;
/*
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
*/