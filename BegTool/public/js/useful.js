$(document).ready(function() {
	$('.datetimepicker').datetimepicker({
		language : 'de',
		pickTime : false,
		format : 'yyyy-mm-DD'
	});
	//$('.footable').footable();
    $('.footable').stickySort();
  /*  $('.header').scrollToFixed();

    $('thead').scrollToFixed({
        marginTop: 50,
        zIndex: 999,

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

