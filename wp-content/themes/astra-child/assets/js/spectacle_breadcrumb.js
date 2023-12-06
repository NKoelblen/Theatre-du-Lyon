jQuery(document).ready(function($) {
    let elements = [];
             
    $("article.spectacle *:not(.swiper-wrapper)").each(function () {
        if (this.id) {
            elements.push("#" + this.id);
            $('div.spectacle-breadcrumb').append('<p><a class="spectacle-breadcrumb-link" href="#' + this.id + '">' + this.innerText + '</a></p>');
        }
    });
    $.each( elements, function( key, value ) {
        $(window).scroll(function () {
            var position = window.scrollY;
            $(value).each(function() {
                var window_bottom = $(window).height();
                var target = $(this).offset().top;
                $(value).addClass('scroll-margin-top');
                var navLinks = $('div.spectacle-breadcrumb p a');
                var scroll_target = target - window_bottom / 3 * 2;
                if (position >= scroll_target) {
                    navLinks.removeClass('spectacle-breadcrumb-current');
                    $('div.spectacle-breadcrumb p a[href="' + value + '"]').addClass('spectacle-breadcrumb-current');
                }
            });
        });
    });
});