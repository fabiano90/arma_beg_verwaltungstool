$(function() {
    //console.log( "ready!" );


    $('#searchButton1').click(function () {  
        toggleOnButtonClicked(1);
    });
    $('#searchButton2').click(function () {  
        toggleOnButtonClicked(2);
    });
    $('#searchButton3').click(function () {  
        toggleOnButtonClicked(3); 
    });
    $('#searchButton4').click(function () {  
        toggleOnButtonClicked(4); 
    });            
    $('#searchButton5').click(function () {  
        toggleOnButtonClicked(5);
    });
    $('#searchButton6').click(function () {  
        toggleOnButtonClicked(6);
    });    

    $('input.radiosong1').click(function () {  
        $(this).parents('.table-responsive').siblings('#song1').text('Lied 1: ' + $(this).attr('songname'));
        $('#tableSong1').collapse('hide');
        $('#searchButton1').html('<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>');   
    });

    $('input.radiosong2').click(function () {  
        $(this).parents('.table-responsive').siblings('#song2').text('Lied 2: ' + $(this).attr('songname'));
        $('#tableSong2').collapse('hide');
        $('#searchButton2').html('<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>');   
    });

    $('input.radiosong3').click(function () {  
        $(this).parents('.table-responsive').siblings('#song3').text('Lied 3: ' + $(this).attr('songname'));
        $('#tableSong3').collapse('hide');
        $('#searchButton3').html('<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>');   
    });

    $('input.radiosong4').click(function () {  
        $(this).parents('.table-responsive').siblings('#song4').text('Lied 4: ' + $(this).attr('songname'));
        $('#tableSong4').collapse('hide');
        $('#searchButton4').html('<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>');   
    });

    $('input.radiosong5').click(function () {  
        $(this).parents('.table-responsive').siblings('#song5').text('Lied 5: ' + $(this).attr('songname'));
        $('#tableSong5').collapse('hide');
        $('#searchButton5').html('<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>');   
    });

    $('input.radiosong6').click(function () {  
        $(this).parents('.table-responsive').siblings('#song6').text('Lied 6: ' + $(this).attr('songname'));
        $('#tableSong6').collapse('hide');
        $('#searchButton6').html('<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>');   
    });



    function toggleOnButtonClicked(id){
        if($('#searchButton'+id).attr('aria-expanded') == "true"){
            $('#searchButton'+id).html('<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>');   
        }
        else{
            $('#searchButton'+id).html('<span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span>');   
        }
    }
});

function collapseOnInput(id){
    $('#tableSong'+id).collapse('show');
    $('#searchButton'+id).html('<span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span>');
}
$(document).on('keyup', 'input#song1', function() {
    collapseOnInput(1);
});
$(document).on('keyup', 'input#song2', function() {
    collapseOnInput(2);
});
$(document).on('keyup', 'input#song3', function() {
    collapseOnInput(3);
});
$(document).on('keyup', 'input#song4', function() {
    collapseOnInput(4);
});
$(document).on('keyup', 'input#song5', function() {
    collapseOnInput(5);
});
$(document).on('keyup', 'input#song6', function() {
    collapseOnInput(6); 
});
