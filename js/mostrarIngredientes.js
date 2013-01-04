$(function(){
    $(".btnBorrarIngrediente").click(function(){        
        var $id = $(this).attr("id");
        $("#modalDialogBorrarIngredientes").html("¿Estás seguro que deseas borrar este ingrediente?");
        $("#modalDialogBorrarIngredientes").dialog({
            autoOpen: true,
            height: "auto",
            width: 300,
            modal: true,
            resizable:false,
            buttons: {
                Aceptar: function() {
                    redirect("ingredientes.php?a=borrar&i="+$id);
                    $( this ).dialog( "close" );
                },
                Cancelar: function(){
                    $( this ).dialog( "close" );
                }
            }
        });
    });
});