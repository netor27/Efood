$(function(){
    $("#checkAll").click(function(){
        $(".checkboxHorario").attr('checked', $('#checkAll').is(':checked'));  
    });
});
