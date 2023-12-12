/* Used for repeatable fields in /inc/metaboxes/mb_generator */

jQuery(document).ready(function($) {
    /* Remove sub-row on click on remove-item button */
    $(document).on('click', '.remove-item', function() {
        $(this).parents('tr.sub-row').remove();
    });
    /* Add sub-row on click on add-item button */
    $(document).on('click', '.add-item', function() {
        var row_no = parseFloat($('.items-table tr.sub-row').length); // Count sub-rows
        var row_html = $('.items-table .hide-tr').html().replace(/rand_no/g, row_no).replace(/hide_/g, ''); // Select references from hiden sub-row, replace the rand number and remove 'hide'
        $('.items-table tbody').append('<tr class="sub-row">' + row_html + '</tr>'); // Add a new sub-row with modified references from the hiden sub-row
    });
});