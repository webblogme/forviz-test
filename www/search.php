<?php

	header("Content-Type: application/json");
	//header("Content-Type: text/html");

	require 'vendor/autoload.php';

	// Using Medoo namespace
	use Medoo\Medoo;

	$databaseName = 'test';
	$tableName    = 'properties';

	// Initialize
	$database = new Medoo([
			'database_type' => 'mysql',
			'database_name' => $databaseName,
			'server'        => 'localhost',
			'username'      => 'root',
			'password'      => 'root'
	]);

	//GET FROM URL
	$uniq_id       = isset($_GET['uniq_id']) ? $_GET['uniq_id']            :'';
	$property_type = isset($_GET['property_type']) ? $_GET['property_type']:'';
	$city          = isset($_GET['city']) ? $_GET['city']                  :'';
	$amenities     = isset($_GET['amenities']) ? $_GET['amenities']        :'';
	$room_price    = isset($_GET['room_price']) ? $_GET['room_price']      : '';

	//PREPARE QUERYSTRING
	$lookingFor=array();

	if ($uniq_id      != '') { $lookingFor[] = array('uniq_id'       => $uniq_id); }
	if ($property_type!= '') { $lookingFor[] = array('property_type' => $property_type); }
	if ($city         != '') { $lookingFor[] = array('city'          => $city); }
	if ($amenities    != '') { $lookingFor[] = array('amenities'     => $amenities); }
	if ($room_price   != '') { $lookingFor[] = array('room_price[<>]'    => explode('-', $room_price)); }

	//MERGING QUERYSTRING
	$queryString = array();
	foreach($lookingFor as $item) {
		$queryString = array_merge($queryString, $item);
	}

	//FIELD LOOKIN
	$fields = array(
		'property_id(project_id)',
		'room_price(price)',
		//'area',
		'latitude',
		'longitude',
		'property_id(customer_id)',
		'query_time_stamp(created_at)',
		'crawl_date(updated_at)',
	);

	//$fields='*';

	//IF NO ANY QUERYSTRING THEN SHOW ALL
	if (count($lookingFor)==0) {

		$datas = $database->select($tableName, $fields);

	} else { //OTHERWISE DO SEARCH BY QUESYSTRING

		//print("<pre>"); print_r($lookingFor); print("</pre>");
		$datas=$database->select($tableName, $fields, $queryString);

	}

	//echo $database->last();

	if (count($datas)==0) {

		echo json_encode('Sorry, there is no result');

	} else {

		//print("<pre>"); print_r($datas); print("</pre>");
		echo json_encode($datas);

	}


?>