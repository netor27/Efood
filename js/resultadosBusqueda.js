$(document).ready(function(){	
    $('select.select').each(function(){
        var title = $(this).attr('title');
        if( $('option:selected', this).val() != ''  ) title = $('option:selected',this).text();
        $(this)
        .css({
            'z-index':10,
            'opacity':0,
            '-khtml-appearance':'none'
        })
        .after('<span class="select">' + title + '</span>')
        .change(function(){
            val = $('option:selected',this).text();
            $(this).next().text(val);
        })
    });
});