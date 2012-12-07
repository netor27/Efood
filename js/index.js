$(function(){
    $('#slider1').bxSlider({
        //infiniteLoop: false,
        displaySlideQty: 9,
        moveSlideQty: 1,
        onAfterSlide: function(currentSlideNumber, totalSlideQty, currentSlideHtmlObject){
            var realIndex = (currentSlideNumber + 5) % totalSlideQty;
            $(".imagen_slider_div").each(function(index) {
                if(realIndex == index){
                    id = $(this).attr("id");
                    var texto = $("#antojo_nombre_"+id).attr("value");
                    //console.log("index = " + index + " , id = " + id + " , texto = " + texto);
                    $("#sliderText").html(texto); 
                }                
            });            
        }   
    });
    
    $(".checkbox_vacio").each(function(){
        $(this).attr("disabled",true); 
    });
    
    $(".checkbox_antojo_container").click(function(){
        var id;
        id = $(this).attr("id");
        var check;
        check = $(".checkbox_"+id);
        if ($(check).hasClass("checkbox_antojo")){
            $(check).removeClass("checkbox_antojo");
            $(check).addClass("checkbox_antojo_clear");            
            $("#antojo"+id).attr("disabled", true);
        } else {
            $(check).removeClass("checkbox_antojo_clear");
            $(check).addClass("checkbox_antojo");
            $("#antojo"+id).attr("disabled", false);
        }
    });
    
    $(".checkbox_preferencia_clear,.checkbox_preferencia").click(function(){
        var id;
        id = $(this).attr("id");
        if ($(this).hasClass("checkbox_preferencia")){
            $(this).removeClass("checkbox_preferencia");
            $(this).addClass("checkbox_preferencia_clear");            
            $("#preferencia_"+id).attr("disabled", true);
        } else {
            $(this).removeClass("checkbox_preferencia_clear");
            $(this).addClass("checkbox_preferencia");
            $("#preferencia_"+id).attr("disabled", false);
        }
    });   
    
    $(".checkbox_default_clear").each(function(){
        if ($(this).hasClass("checkbox_preferencia")){
            $(this).removeClass("checkbox_preferencia");
            $(this).addClass("checkbox_preferencia_clear");            
            $("#preferencia_"+id).attr("disabled", true);
        }
        if ($(this).hasClass("checkbox_antojo")){
            $(this).removeClass("checkbox_antojo");
            $(this).addClass("checkbox_antojo_clear");            
            $("#antojo"+id).attr("disabled", true);
        } 
    });
    $("#colonias").click(function(){
        $(this).val("");
    });
    
    $(window).scroll(function () { 
        var $top = $(this).scrollTop();
        if($top > 1106 ){
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