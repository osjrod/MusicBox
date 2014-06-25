


$(document).on("click","#subir",function() {

	var origen  = $('#origen').get(0).files[0];
	var destino =  $('#formato').val();
	var formData   = new FormData();
	formData.append('origen' ,origen);
	formData.append('destino',destino);

    $.ajax({
  	type: "POST",
  	url: "/",
  		data: formData,
  		cache: false,
	    contentType: false,
	    processData: false,
	}).done(function( data ) {
	    alert( "Data Saved: " +data );
	    descargas.push(data);

  	}).fail(function( data , error) {
		console.log(data);
		console.log(error);
	});



});

var descargas = new Array();

window.setInterval(function(){
  	if(descargas.length>0) {
		
		for(var i =0 ; i< descargas.length;i++) {
			var id = descargas[i];
			$.ajax({
			    url: 'http://localhost:8000/buscar/'+id,
			    type: 'GET'
			    
			}).done(function (data) { 

				if(data.direccion !== null){
					
					var nombre = data.origen.split(/(\\|\/)/g).pop();

					$("#descargas").append("<br><a target='_blank' href='/link/"+id+"'   >"+nombre+"</a>");
					descargas.splice(descargas.indexOf(id),1);
				}
				
			}).fail(function(data,error) {
		    	console.log(data);
		    	console.log(error);
		  	});
		}

  	}

}, 3000);

/*
*/


