$(document).ready(function() {
	$('.datetimepicker').datetimepicker({
		language : 'de',
		pickTime : false,
		format : 'yyyy-mm-DD'
	});
	$('.footable').footable();


		$('.header').scrollToFixed();
        $('.header').bind('fixed.ScrollToFixed', function() {   $(this).find( "h2" ).addClass( 'navbar-brand' ) });
        $('.header').bind('unfixed.ScrollToFixed', function() { $(this).find( "h2" ).removeClass( 'navbar-brand' ) });

        /*$('.footer').scrollToFixed( {
            bottom: 0,
            limit: $('.footer').offset().top,
            preFixed: function() { $(this).css('color', 'blue'); },
            postFixed: function() { $(this).css('color', ''); },
        });

        // Order matters here because we are dependent on the state of the footer above for
        // our limit.  The footer must be set first; otherwise, we will not be in the right
        // position on a window refresh, if the limit is supposed to be invoked.
        $('#summary').scrollToFixed({
            marginTop: $('.header').outerHeight(true) + 10,
            limit: function() {
                var limit = $('.footer').offset().top -                     
        $('#summary').outerHeight(true) - 10;
                return limit;
            },
            minWidth: 1000,
            zIndex: 999,
            fixed: function() {  },
            dontCheckForPositionFixedSupport: true
        });

        $('#summary').bind('unfixed.ScrollToFixed', function() {
            if (window.console) console.log('summary preUnfixed');
        });
        $('#summary').bind('unfixed.ScrollToFixed', function() {
            if (window.console) console.log('summary unfixed');
            $(this).css('color', '');
            $('.header').trigger('unfixed.ScrollToFixed');
        });
        $('#summary').bind('fixed.ScrollToFixed', function() {
            if (window.console) console.log('summary fixed');
            $(this).css('color', 'red');
            $('.header').trigger('fixed.ScrollToFixed');
        });*/
	

	
});
$(document).on('keyup', 'input#firstname', function() {
	var onlinename = $(this).val() + " " + $('input#lastname').val();
	console.log (onlinename);
	$('input#onlinename').val(onlinename);
	
});

$(document).on('keyup', 'input#lastname', function() {
	var onlinename = $('input#firstname').val() + " " + $(this).val();
	console.log (onlinename);
	$('input#onlinename').val(onlinename);
	
});

$(document).on('blur', 'input#firstname', function() {
	var onlinename = $(this).val() + " " + $('input#lastname').val();
	console.log (onlinename);
	$('input#onlinename').val(onlinename);
	
});

$(document).on('blur', 'input#lastname', function() {
	var onlinename = $('input#firstname').val() + " " + $(this).val();
	console.log (onlinename);
	$('input#onlinename').val(onlinename);
	
});

