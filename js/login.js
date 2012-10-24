$(function(){
    $( "#modalDialogLogin" ).dialog({
        autoOpen: false,
        height: 500,
        width: 400,
        modal: true
    });
        
    $("#entrarBtn").click(function(){
        $( "#modalDialogLogin" ).dialog("open");
        //evento para cerrar el dialogo al dar click afuera
        $(".ui-widget-overlay").on("click", function(){
            $("#modalDialogLogin").dialog("close");
        });
    });
});

