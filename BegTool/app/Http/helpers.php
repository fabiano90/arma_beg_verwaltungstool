<?php

function cleverLink($route, $text) {
	if( Request::path() == $route ) {
		$active = "class = 'active'";
	}
	else {
		$active = '';
	}
	 
	return '<li ' . $active . '>' . link_to($route, $text) . '</li>';
}

function  showMessageAndErrors($text='', $errors=array()) {
	$a = explode('|', $text);
	$html = '';
    if (count($a) == 2)
    {
  		$html .= '<span class="text-'.$a[0].'"><strong>'.$a[1].'</strong></span>';
    }
    if (count($errors) > 0)
    {
    	$html .= '<ul class="form-error">';
    	foreach($errors as $error)
    	{
           $html .= '<li><strong>'.$error.'</strong></li>';
     	}
     	$html .= '</ul>';
    }

    if (trim($html) != '')
    {
    	$html .= '<br/><br/>';
    }
    
    return $html;
    
}


function niceDate($name, $value = null, $options = array()) {
  return '<div class="input-group date datetimepicker"  data-date-format="YYYY-MM-DD">
                    <input name="'.$name.'" type="text" class="form-control" value="'.$value.'" />
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>';
}