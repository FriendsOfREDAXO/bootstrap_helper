$(document).on('rex:ready', function (event, container) {

    // Externe Links in neuem Fenster
    $('div.bsh_addon_documentation-content').find('a[href^="http"]').each(function(){
        if ($(this).html() != '') {
            $html = $(this).html() + ' <sup><i class="fa fa-external-link"></i></sup>';
            $(this).html($html).attr('target','_blank');
        }
    });
}); // end rex:ready
