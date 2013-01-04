$(function(){
    $(".btnBorrarGrupoIngredientes").click(function(){        
        var $id = $(this).attr("id");
        $("#modalDialogBorrarGrupoIngredientes").html("¿Estás seguro que deseas borrar este grupo?");
        $("#modalDialogBorrarGrupoIngredientes").dialog({
            autoOpen: true,
            height: "auto",
            width: 300,
            modal: true,
            resizable:false,
            buttons: {
                Aceptar: function() {
                    redirect("grupoIngredientes.php?a=borrar&i="+$id);
                    $( this ).dialog( "close" );
                },
                Cancelar: function(){
                    $( this ).dialog( "close" );
                }
            }
        });
    });
});