


$("#subir").click(function() {
		alert("hola");
});

$(document).on("click","#subir",function() {
    

	var origen  = $('#origen').get(0).files[0];
	var destino =  "mp3";
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

  	}).fail(function( data , data1) {
		console.log(data);
		console.log(data1);
	});



});

/*
*/


