jQuery(document).ready(function ($) {

    let windowEl = $(window);
    let body = $('body');

    // Slick the Slider Block slider.
    $('.slider').slick({
        // autoplay: true,
        autoplaySpeed: 5000,
        pauseOnHover: true,
        adaptiveHeight: true,
    });

    // Site scrolled
    windowEl.on('scroll', function () {
        if (body.scrollTop() > 10) {
            body.addClass('scrolled');
        } else {
            body.removeClass('scrolled');
        }
    });

    $('button.navbar-toggler').on('click', function () {
        if ($(this).attr('aria-expanded') == 'true') {
            body.addClass('mobile-menu-open');
        } else {
            body.removeClass('mobile-menu-open');
        }
    });

    // Header - Submenus
    $.each($('.menu-primary-menu-container .menu-item-has-children'), function () {
        $(this).addClass('dropdown');
    });
    $.each($('.menu-primary-menu-container .menu-item-has-children > a'), function () {
        $(this).addClass('dropdown-toggle').attr('data-bs-toggle', 'dropdown').attr('aria-expanded', 'false');
    });
    $.each($('.menu-primary-menu-container .sub-menu'), function () {
        $(this).addClass('dropdown-menu');
    });
    $.each($('.menu-primary-menu-container .menu-item'), function () {
        $(this).addClass('dropdown-item');
    });

    // Remove sidebar
    $('#sidebar').remove();

    // Video block - stop videos on modal close
    $.each($('.video-block .modal'), function () {
        let modalElement = $('#' + $(this).attr('id'));
        let videoModalBody = $(modalElement).find('.modal-body');
        let videoIframeHTML = $(modalElement).find('.modal-body').html();

        $(modalElement).on('hide.bs.modal', function () {
            $(videoModalBody).html(' ');
            $(videoModalBody).html(videoIframeHTML);
        });
    });
});