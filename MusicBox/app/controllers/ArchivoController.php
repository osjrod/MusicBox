<?php

require_once( '/home/liliala/git/MusicBox/MusicBox/vendor/autoload.php');

use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;

class ArchivoController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
		$this->layout->nest('content', 'archivo.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$origen   = Input::file('origen');
 		$destino  = Input::get('destino');

 		$subidos = "/home/liliala/ArchivosMusicBox/Subidos";

 		$nombre = $origen->getClientOriginalName();
        
		$informacion = pathinfo($nombre);
		$extension  = $informacion['extension'];

		if(($extension == "ogg")||($extension == "mp3")||($extension == "wav"))
		{
			$subido = $origen->move($subidos, $nombre);
			if($subido) {
				
				$origen = $subidos."/".$nombre;
				$insercion = Archivo::store($origen,$destino);
				$this->enviarColas(json_encode($insercion),$insercion->id);
				return Response::json($insercion->id);
			}
			else {
				return Response::json("error");
			}
		}
		else {
			return Response::json("formato invalido");
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	private function enviarColas($insercion,$id)
	{
		$connection = new AMQPConnection('localhost', 5672, 'guest', 'guest');
		$channel = $connection->channel();
		$channel->queue_declare($id, false, false, false, false);
		$msg = new AMQPMessage($insercion);
		$channel->basic_publish($msg, '', 'hello');
		$channel->close();
		$connection->close();
	}

	public function descargar($id){
     	
		$archivo =Archivo::show($id);
		$link = $archivo->direccion;
		if($link != ""){
        	return Response::download($link);
       	}
		
	}

	public function buscar($id){
		$archivo =Archivo::show($id);
		return Response::json($archivo);
	}


}
