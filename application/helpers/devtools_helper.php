<?php
function printr($data, $return = true) {
	
	$style  = "background-color: DarkGray; ";
	$style .= "color: Cornsilk; ";
	$style .= "padding: 10px; 5px; 10px; 5px; ";
	$style .= "width: 90%; ";
	$style .= "margin-left: auto; ";
	$style .= "margin-right: auto; ";
	$style .= "border-radius: 9px; ";
	
	$final_string = '<pre style="'.$style.'">'.nl2br(print_r($data, $return)).'</pre>';
	
	if($return === true) {
		return $final_string;
	}
	else {
		echo $final_string;
	}
}