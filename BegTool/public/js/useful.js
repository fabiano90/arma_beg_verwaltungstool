$(document).ready(function() {
	$('.datetimepicker').datetimepicker({
		language : 'de',
		pickTime : false,
		format : 'yyyy-mm-DD'
	});
	$('table').stickySort();
    $('.footable').footable().bind('footable_filtering', function (e) {
      var selected = $('.filter-status').find(':selected').text();
      if (selected && selected.length > 0) {
        e.filter += (e.filter && e.filter.length > 0) ? ' ' + selected : selected;
        e.clear = !e.filter;
      }
    });

    $('.clear-filter').click(function (e) {
      e.preventDefault();
      $('.filter-status').val('');
      $('table.demo').trigger('footable_clear_filter');
    });

    $('.filter-status').change(function (e) {
      e.preventDefault();
      $('table.demo').trigger('footable_filter', {filter: $('#filter').val()});
    });

    $('.filter-api').click(function (e) {

      e.preventDefault();

      //get the footable filter object
      var footableFilter = $('table').data('footable-filter');
      $('.filter-api').parent().attr('class', '')
 	 $(this).parent().attr('class','active');
 	 
      footableFilter.filter($(this).attr('value'));

    });


        
	

	
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

