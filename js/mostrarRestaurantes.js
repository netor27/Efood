$(function(){
    $(".btnBorrarRestaurante").click(function(){        
        var $id = $(this).attr("id");
        $("#modalDialogBorrarRestaurante").html("¿Estás seguro que deseas borrar el restaurante?");
        $("#modalDialogBorrarRestaurante").dialog({
            autoOpen: true,
            height: "auto",
            width: 300,
            modal: true,
            resizable:false,
            buttons: {
                Aceptar: function() {
                    redirect("restaurantes.php?a=borrar&i="+$id);
                    $( this ).dialog( "close" );
                },
                Cancelar: function(){
                    $( this ).dialog( "close" );
                }
            }
        });
    });
});