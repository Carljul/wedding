$(document).ready(function() {
    let current = 1;

    function checkInvitation() {
        if (localStorage.getItem('invitation') != null)
        {
            $('.gold-button').remove();
            $('.emerald-button').remove();
            $('.refresh-button').show();
        }
    }
    checkInvitation()

    // Changing Backgrounds
    function loadimg(){
        if (current >= 18) {
            current = 1;
        }
        $('.circle-image img').animate({ opacity: 1 }, 1500, function(){
             //finished animating, minifade out and fade new back in           
            $('.circle-image img').animate({ opacity: 0.7 }, 100,function(){
                //swap out bg src                
                $('.circle-image img').attr("src", "images/backgrounds/"+current+".png"); 
                //animate fully back in
                $('.circle-image img').animate({ opacity: 1 }, 500,function(){
                    //set timer for next
                    setTimeout(loadimg,2500);
                });
            });
        });
        current++;
    }
    loadimg()


    $('#button-click').on('click', function() {
        $(this).addClass('clicked');
        // Shadow
        setTimeout(() => {
            $('.shadow').addClass('clicked');
        }, 100);
        // Flowing Invitations Open Envelope
        setTimeout(() => {
            $(this).addClass('bounce');
            $('.animated-mail').addClass('clicked');
            $('.top-fold').addClass('clicked');
            $('.letter').addClass('clicked');
        }, 300)

        // Showing Reservation
        setTimeout(() => {
            $('.wrapper').hide('slow', function () {
                $('body').css('background-color', '#50C878')
                $('.container').css('display', 'flex');
            });
        },1300)
    });


    $('.back-icon').on('click', function () {
        let radio = $('input[type="radio"]:checked').val();
        let newId = parseInt(radio) - 1
        if (newId != 0) {
            $('#item-'+(newId)).prop('checked', true);
            $('#wedding-info-1').hide();
            $('#wedding-info-2').hide();
            $('#wedding-info-3').hide();
            $('#wedding-info-4').hide();
            $('#wedding-info-'+newId).show();
        }
        
        if (newId < 4) {
            $('.next-icon').show()
            $('.upper-part').removeClass('last-part')
        }
        
        $('body').toggleClass('blue');
    });
    $('.next-icon').on('click', function () {
        let radio = $('input[type="radio"]:checked').val();
        let newId = parseInt(radio) + 1
        if (newId == 4) {
            $(this).hide();
            $('.upper-part').addClass('last-part')
        }
        if (newId != 5) {
            $('#item-'+(newId)).prop('checked', true);
            $('#wedding-info-1').hide();
            $('#wedding-info-2').hide();
            $('#wedding-info-3').hide();
            $('#wedding-info-4').hide();
            $('#wedding-info-'+newId).show();
        }
        $('body').toggleClass('blue');
    });

    $('#accept-invitation').on('click', function () {
        let id = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: 'accept.php',
            data: { id: id }, 
            contentType: 'application/x-www-form-urlencoded',
            processData: true,
            success: function (data) {
                if (data == 200) {
                    localStorage.setItem('invitation', 1);
                    $('#message-invitation').hide();
                    $('#accept-invitation').hide()
                    $('.gold-button').remove();
                    $('.emerald-button').remove();
                    $('.refresh-button').show();
                    $('.downloads').css('display', 'grid');
                } else {
                    alert('Something went wrong')
                }
            },
            error: function (err) {
                alert('Something went wrong')
            }
        })
    });

    $('#decline-invitation').on('click', function () {
        let id = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: 'decline.php',
            data: { id: id }, 
            contentType: 'application/x-www-form-urlencoded',
            processData: true,
            success: function (data) {
                if (data == 200) {
                    localStorage.setItem('invitation', 0);
                    $('#message-invitation').hide();
                    $('.gold-button').remove();
                    $('.emerald-button').remove();
                    $('.refresh-button').show();
                    $('.downloads').css('display', 'grid');
                } else {
                    alert('Something went wrong')
                }
            },
            error: function (err) {
                alert('Something went wrong')
            }
        })
    });

    $('.refresh-button').on('click', function () {
        location.reload();
    })
});