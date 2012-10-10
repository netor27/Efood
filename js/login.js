$(function(){
    $( "#modalDialogLogin" ).dialog({
            autoOpen: false,
            height: 500,
            width: 400,
            modal: true,
            close: function() {
                
            }
        });
        
        $("#entrarBtn").click(function(){
            $( "#modalDialogLogin" ).dialog("open");
        });
});

