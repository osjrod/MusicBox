<?php

class Archivo extends Eloquent {

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
}