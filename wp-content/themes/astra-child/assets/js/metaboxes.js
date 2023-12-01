jQuery(document).ready(function($) {
    console.log('metaboxes')
    jQuery(document).on('click', '.remove-item', function() {
        jQuery(this).parents('tr.sub-row').remove();
    });
    jQuery(document).on('click', '.add-item', function() {
        var p_this = jQuery(this);
        var row_no = parseFloat(jQuery('.item-table tr.sub-row').length);
        var row_html = jQuery('.item-table .hide-tr').html().replace(/rand_no/g, row_no).replace(/hide_/g, '');
        jQuery('.item-table tbody').append('<tr class="sub-row">' + row_html + '</tr>');
    });
});