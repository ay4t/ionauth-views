(function ($) {
    "use strict";

    /*-------------------------------------
	Create General AJAX Form
	-------------------------------------*/
    window.addEventListener('load', function () {

        $('form[data-remote]').submit(function(event) {
            event.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var buttonVal = $('form[data-remote] button[type=submit]').html();
            var button = $('form[data-remote] button[type=submit]');

            button.html('<i class="fa fa-spinner fa-spin"></i> loading....');
            button.prop('disabled', true);

            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(),
                dataType: "json"
            })
            .done(function( response ) {
                
                    /** do update CSRF */
                    $('input[name='+csrf_token_name+']').val( response.new_csrf );

                    /** create a toast message notifications */
                    $.toast({
                        text: response.message,
                        heading: response.heading,
                        icon: response.type,
                        showHideTransition: 'slide',

                        beforeShow: function () {
                        },

                        afterShown: function () {
                        },

                        beforeHide: function () {
                        },

                        afterHidden: function () {
                            if( response.success_url ){
                                location.href = response.success_url
                            }
                        }
                    })
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                button.html( buttonVal );
                button.prop('disabled', false);
            });
        });

    });

    /*-------------------------------------
	Background image
	-------------------------------------*/
    $("[data-bg-image]").each(function () {
        var img = $(this).data("bg-image");
        $(this).css({
            backgroundImage: "url(" + img + ")"
        });
    });

    /*-------------------------------------
    After Load All Content Add a Class
    -------------------------------------*/
    window.onload = addNewClass();

    function addNewClass() {
        $('.fxt-template-animation').imagesLoaded().done(function (instance) {
            $('.fxt-template-animation').addClass('loaded');
        });
    }

    /*-------------------------------------
    Toggle Class
    -------------------------------------*/
    $(".toggle-password").on('click', function () {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });

    /*-------------------------------------
    Youtube Video
    -------------------------------------*/
    if ($.fn.YTPlayer !== undefined && $("#fxtVideo").length) { 
        $("#fxtVideo").YTPlayer({useOnMobile:true});
    }

    /*-------------------------------------
    Vegas Slider
    -------------------------------------*/
    if ($.fn.vegas !== undefined && $("#vegas-slide").length) {
        var target_slider = $("#vegas-slide"),
            vegas_options = target_slider.data('vegas-options');
        if (typeof vegas_options === "object") {
            target_slider.vegas(vegas_options);
        }
    }

    /*-------------------------------------
    OTP Form (Focusing on next input)
    -------------------------------------*/
    $("#otp-form .otp-input").keyup(function () {
        if (this.value.length == this.maxLength) {
            $(this).next('.otp-input').focus();
        }
    });

})(jQuery);