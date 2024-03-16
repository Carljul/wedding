$(document).ready(function() {

    $('#button-click').on('click', function() {
        $(this).addClass('clicked');
        setTimeout(() => {
            $(this).addClass('bounce');
            $('.animated-mail').addClass('clicked');
            $('.top-fold').addClass('clicked');
            $('.letter').addClass('clicked');
        }, 300)
    });
});