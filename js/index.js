$(function(){
    $('#slider1').bxSlider({
        displaySlideQty: 9,
        moveSlideQty: 1
    });
  
    $('#checkbox_antojo');
  
    $(".checkbox_antojo,.checkbox_antojo_clear").click(function(){
        if ($(this).hasClass("checkbox_antojo"))
        {
            $(this).removeClass("checkbox_antojo");
            $(this).addClass("checkbox_antojo_clear");
        }
        else
        {
            $(this).removeClass("checkbox_antojo_clear");
            $(this).addClass("checkbox_antojo");
        }
    });   
});