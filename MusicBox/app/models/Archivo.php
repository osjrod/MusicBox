<?php

class Archivo extends Eloquent {

	protected $table      = 'archivos';
    protected $fillable   = array('origen','destino','direccion');
    protected $guarded    = array('id');
    public    $timestamps = false;

    public static function store($origen, $destino)
    {
        $archivo = Archivo::create(
            array(
                'origen'   => $origen,
                'destino'  => $destino
            )
        );
        return $archivo;
    }

    public static function show($id)
    {
        $archivos = Archivo::findOrFail($id);
        return $archivos;
    }

}