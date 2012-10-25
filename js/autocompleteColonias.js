$(function() {
    $( "#colonias" ).autocomplete({
        source: "colonias.php?a=coloniasJSON",
        minLength: 1,
        select: function( event, ui ) {
            var index = ui.item.id;
            $('#idColonia').val(index);
        }
    });
    $( "#colonias" ).click(function(){
       $(this).val("");
    });
});
        
