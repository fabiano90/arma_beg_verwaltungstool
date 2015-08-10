$(function() {
    console.log( "ready!" );
    var i = 1;
    $('#addSubItem').click(function () {    	
    	if(i == 1){
    		$('input#topic'+(i-1)).parent().after('<label for="topic'+i+'">Unterpunkte </label><div class="input-group"><span class="input-group-addon">'+i+'.</span><input id="topic'+i+'" class="form-control" type="text" value="" name="subitem'+i+'" placeholder="Unterpunkt"></input></div>');	
    	}
    	else{
    		$('input#topic'+(i-1)).parent().after('<div class="input-group"><span class="input-group-addon">'+i+'.</span><input id="topic'+i+'" class="form-control" type="text" value="" name="subitem'+i+'" placeholder="Unterpunkt"></input></div>');	
    	}  
	    i++;	    
	});
    $('#submitButton').click(function () {    	
		$('form').attr('action', $('form').attr('action') + '/' + i);
	});
});

