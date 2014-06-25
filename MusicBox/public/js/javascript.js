$(document).ready(function() {

    $("#subir").click(function() {
    
        $.ajax({
        url: '/subir',
        type: 'GET'
    })
    .done(function(response) {
        alert(response);
    })
    .fail(function() {
        alert("error"); 
    });
    

    });
    
 
 
});

