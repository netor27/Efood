$(function(){
    $(".btnBorrarUsuario").click(function(){
        var $id = $(this).attr("id");
        $("#modalDialogBorrarUsuario").html("¿Estás seguro que deseas borrar el usuario?");
        $("#modalDialogBorrarUsuario").dialog({
            autoOpen: true,
            height: "auto",
            width: 300,
            modal: true,
            resizable:false,
            buttons: {
                Aceptar: function() {
                    //alert("url= " + "usuarios.php?a=baja&i="+$id);
                    redirect("usuarios.php?a=baja&i="+$id);
                    $( this ).dialog( "close" );
                },
                Cancelar: function(){
                    $( this ).dialog( "close" );
                }
            }
        });
    });
});