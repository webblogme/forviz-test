<?php

function curlData($url) {

	//  Initiate curl
	$ch = curl_init();
	// Disable SSL verification
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	// Will return the response, if false it print the response
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// Set the url
	curl_setopt($ch, CURLOPT_URL,$url);
	// Execute
	$result=curl_exec($ch);
	// Closing
	curl_close($ch);

	return json_decode($result, true);

}

function whatDateNumberic($param) {

	$reformat=gmdate("Y-m-d", $param);
	return date("N", strtotime($reformat));

}

function whatDate($param) {

	$reformat=gmdate("Y-m-d", $param);
	return date("D", strtotime($reformat));

}

function showImage($path,$resource,$text,$css,$style) {

	$stylesheet='';
	$inlineclass='';
	$alttitle='';

	if($css!='') {  $stylesheet=' class="'.$css.'"';}
	if($style!='') {  $inlineclass=' style="'.$style.'"';}
	if($text!='') {  $alttitle=' alt="'.$text.'" title="'.$text.'"';}
	if($resource!='') { $x='<img src="'.$path.$resource.'"'.$alttitle.$stylesheet.$inlineclass.'>'."\r\n"; } else if($resource=='') { $x='<!--<span class="red">no photo!</span>-->';}

	return $x;
}



?>