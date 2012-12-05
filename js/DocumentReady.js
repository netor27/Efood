$(function(){
    $("#modalDialogRecomendarRestaurante").dialog({
        autoOpen: false,
        height: "auto",
        width: 500,
        modal: true,
        resizable:false 
    });
                
    $(".btnRecomendar").click(function(){
        $("#modalDialogRecomendarRestaurante").dialog("open");
        $(".ui-widget-overlay").on("click", function(){
            $("#modalDialogRecomendarRestaurante").dialog("close");
        });
    });
    
    
});