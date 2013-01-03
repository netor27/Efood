$(function(){
    $(".btnBorrarPlatillo").click(function(){        
        var $id = $(this).attr("id");
        $("#modalDialogBorrarPlatillo").html("¿Estás seguro que deseas borrar el platillo?");
        $("#modalDialogBorrarPlatillo").dialog({
            autoOpen: true,
            height: "auto",
            width: 300,
            modal: true,
            resizable:false,
            buttons: {
                Aceptar: function() {
                    redirect("platillos.php?a=borrar&i="+$id);
                    $( this ).dialog( "close" );
                },
                Cancelar: function(){
                    $( this ).dialog( "close" );
                }
            }
        });
    });
});