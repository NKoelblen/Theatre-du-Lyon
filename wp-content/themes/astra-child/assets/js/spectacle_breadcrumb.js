jQuery(document).ready(function($) {
    let elements = [];
             
    $("article.spectacle *:not(.swiper-wrapper)").each(function () {
        if (this.id) {
            elements.push("#" + this.id);
            jQuery('table.spectacle-breadcrumb tbody tr').append('<td><a class="spectacle-breadcrumb-link" href="#' + this.id + '">' + this.innerText + '</a></td>');
        }
    });
    $.each( elements, function( key, value ) {
        $(window).scroll(function () {
            var position = window.scrollY;
            $(value).each(function() {
                var window_bottom = $(window).height();
                var target = $(this).offset().top;
                var id = $(this).attr('id');
                var navLinks = $('table.spectacle-breadcrumb tr td a');
                if (position >= target - window_bottom) {
                    navLinks.removeClass('spectacle-breadcrumb-current');
                    $('table.spectacle-breadcrumb tr td a[href="#' + id + '"]').addClass('spectacle-breadcrumb-current');
                }
            });
        });
    });
});