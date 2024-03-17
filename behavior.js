$(document).ready(function() {

    $('#button-click').on('click', function() {
        $(this).addClass('clicked');
        setTimeout(() => {
            $(this).addClass('bounce');
            $('.animated-mail').addClass('clicked');
            $('.top-fold').addClass('clicked');
            $('.letter').addClass('clicked');
            // $('.flying-to-left').css('display', 'flex')
        }, 300)
        setTimeout(() => {
            $('.wrapper').hide('slow', function () {
                $('body').css('background-color', '#50C878')
                $('.container').css('display', 'flex');
            });
        //     $('.flying-to-left').addClass('clicked')
        },1300)
    });


    $('.play-icon').on('click', function () {
        let radio = $('input[type="radio"]:checked').val();
        let newId = parseInt(radio) + 1
        if (newId == 4) {
            $(this).hide();
            $('.upper-part').addClass('last-part')
        }
        if (newId != 5) {
            $('#item-'+(newId)).attr('checked', true);
        }
        $('body').toggleClass('blue');
    });
});