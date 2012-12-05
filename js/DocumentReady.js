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
    
    $(window).scroll(function () { 
        var $top = $(this).scrollTop();
        console.log($top);
        if($top > 1131 ){
            $(".contenedorLikes").addClass("contenedorLikesFijoAbajo"); 
            $(".contenedorLikes").removeClass("contenedorLikesEnMovimiento");                       
            $(".contenedorLikes").removeClass("span10");                        
        }else if($top > 587){
            $(".contenedorLikes").addClass("contenedorLikesEnMovimiento");
            $(".contenedorLikes").removeClass("contenedorLikesFijoAbajo"); 
            $(".contenedorLikes").removeClass("span10");
        }else{
            $(".contenedorLikes").removeClass("contenedorLikesEnMovimiento");
            $(".contenedorLikes").removeClass("contenedorLikesFijoAbajo"); 
            $(".contenedorLikes").addClass("span10");
        }
    });
});