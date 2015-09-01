$(function() {
    //console.log( "ready!" );
    var i = 1;     

    //für jedes gespeicherte <li>data</li>-Element vorgefülltes Inputfeld erzeugen
    $('#getSubitem').children().each(function(){
        if(i == 1){
            $('input#topic'+(i-1)).parent().after(newInput(true, $(this).text()));
        }
        else{
            $('input#topic'+(i-1)).parent().after(newInput(false, $(this).text()));
        }
        i++;
        //alert(newInput(true, $(this).text()));
        //alert($(this).text());        
    });

    //Inputfeld für neuen Unterpunkt erzeugen
    $('#addSubItem').click(function () {        
        if(i == 1){
            $('input#topic'+(i-1)).parent().after(newInput(true));
        }
        else{
            $('input#topic'+(i-1)).parent().after(newInput());
        }  
        i++;         
    });

    //SermonController für Postfunction 2. Parameter (Anzahl der Unterpunkte) übergeben
    //public/sermons/editsermon/434/5   bzw. ...editsermon/id/count
    $('#submitButton').click(function () {      
        $('form').attr('action', $('form').attr('action') + '/' + i);
    });

    // newInput: label, input mit Nummerierung auf linker Seite
         /* <label for="topic'+i+'">Unterpunkte </label>
            <div class="input-group">
                <span class="input-group-addon">'+i+'.</span>
                <input value="'+topicData+'></input>
            </div>';                                            */
    function newInput(label = false, topicData = '') {  
        if(label == true){
            return '<label for="topic'+i+'">Unterpunkte </label><div class="input-group"><span class="input-group-addon">'+i+'.</span><input id="topic'+i+'" class="form-control" type="text" value="'+topicData+'" name="subitem'+i+'" placeholder="Unterpunkt"></input></div>';
        }
        else{
            return '<div class="input-group"><span class="input-group-addon">'+i+'.</span><input id="topic'+i+'" class="form-control" type="text" value="'+topicData+'" name="subitem'+i+'" placeholder="Unterpunkt"></input></div>';
        }
    }
});

