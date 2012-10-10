$(function(){
    $('#slider1').bxSlider({
        //infiniteLoop: false,
        displaySlideQty: 9,
        moveSlideQty: 1
    });
    
    $(".checkbox_antojo_container").hover(
        function(){
            var id;
            id = $(this).attr("id");
            var texto = $("#antojo_nombre_"+id).attr("value");
            $("#sliderText").html(texto);        
        }, 
        function(){
            $("#sliderText").html("");
        });
    $(".checkbox_antojo_container").click(function(){
        var id;
        id = $(this).attr("id");
        var check;
        check = $("#checkbox_"+id);
        if ($(check).hasClass("checkbox_antojo")){
            $(check).removeClass("checkbox_antojo");
            $(check).addClass("checkbox_antojo_clear");            
            $("#antojo"+id).attr("value", -1);
        } else {
            $(check).removeClass("checkbox_antojo_clear");
            $(check).addClass("checkbox_antojo");
            $("#antojo"+id).attr("value", id);
        }
    });
    
    $(".checkbox_preferencia_clear,.checkbox_preferencia").click(function(){
        var id;
        id = $(this).attr("id");
        if ($(this).hasClass("checkbox_preferencia")){
            $(this).removeClass("checkbox_preferencia");
            $(this).addClass("checkbox_preferencia_clear");            
            $("#preferencia_"+id).attr("value", -1);
        } else {
            $(this).removeClass("checkbox_preferencia_clear");
            $(this).addClass("checkbox_preferencia");
            $("#preferencia_"+id).attr("value", 1);
        }
    });   
    
    $(".checkbox_default_clear").each(function(){
        if ($(this).hasClass("checkbox_preferencia")){
            $(this).removeClass("checkbox_preferencia");
            $(this).addClass("checkbox_preferencia_clear");            
            $("#preferencia_"+id).attr("value", -1);
        }
        if ($(this).hasClass("checkbox_antojo")){
            $(this).removeClass("checkbox_antojo");
            $(this).addClass("checkbox_antojo_clear");            
            $("#antojo"+id).attr("value", -1);
        } 
    });
});