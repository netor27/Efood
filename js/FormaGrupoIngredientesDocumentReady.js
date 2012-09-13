$(document).ready(function(){
    llenarIngredienteDropdown();
    
    $('#grupoIngrediente').change(function(e) {                    
        llenarIngredienteDropdown();
    });
});

function llenarIngredienteDropdown(){
    var ing = $('#ing').val();
    $.get("grupoIngredientes.php?a=getIngredientesJSON&i="+$('#grupoIngrediente').val(),
        function(data){
            $('#ingrediente').empty();
            var i;
            for(i = 0; i < data.length; i++){
                if(data[i].idIngrediente == ing)
                    $('#ingrediente').append("<option value='" + data[i].idIngrediente + "' selected >"+data[i].nombre+"</option>");
                else
                    $('#ingrediente').append("<option value='" + data[i].idIngrediente + "' >"+data[i].nombre+"</option>");
            }
        }, "json");
}