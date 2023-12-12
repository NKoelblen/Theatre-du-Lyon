/* Used in /inc/shorcode/sc_single_spectacle_summary.php to display links to elements with id in single spectacles  */

jQuery(document).ready(function($) {

    console.log('summary');

    let elements = [];

    /* Get elements with id and append links to those elements in the summary */
    $("article.spectacle *:not(.swiper-wrapper)").each(function () {
        if (this.id) {
            elements.push("#" + this.id);
            $('div.astc_spectacle-summary').append('<p><a class="astc_spectacle-summary-link" href="#' + this.id + '">' + this.innerText + '</a></p>');
        }
    });

    /* Get elements positions to change the current link */
    $.each( elements, function( key, value ) {

        $(window).scroll(function () {
            var position = window.scrollY;

            $(value).each(function() {

                var window_bottom = $(window).height();
                var target = $(this).offset().top;
                var scroll_target = target - window_bottom / 3 * 2;
                $(value).addClass('astc_scroll-margin-top');
                var navLinks = $('div.astc_spectacle-summary p a');
                
                if (position >= scroll_target) {
                    navLinks.removeClass('astc_current');
                    $('div.astc_spectacle-summary p a[href="' + value + '"]').addClass('astc_current');
                }

            });

        });

    });

});