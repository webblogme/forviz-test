<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Localhost</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<meta name="robots" content="noindex,nofollow" />
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="assets/css/css.bs3.en.css" />
	</head>

	<body>

	<div class="container">
		<div class="row">
			<div class="col-xs-12 mb-50">

				<h2>TEST A: CSS</h2>

				<div class="coffee">

					<div class="holder"></div>
					<!-- /.holder -->
					<div class="cup"></div>
					<!-- /.cup -->
					<div class="plate"></div>
					<!-- /.plate -->

				</div>


			</div>

			<div class="col-xs-12 mb-50">

				<h2>TEST B: Manipulate data</h2>

				<?php

				include	'functions.php';

				$datas=curlData('http://uinames.com/api/?ext&amount=25');
				$rowcount= count($datas);

				//CREATE BLANK ARRAY CONTAINER
				$weekdayContainer=array();

				//LOOP THROUGH 7 DAYS OF WEEK
				for ($weekdayNumber=1; $weekdayNumber < 8 ; $weekdayNumber++) {

					for ($i=0; $i < $rowcount ; $i++) {

						//ARRANGE THEM TO ORDER
						if (whatDateNumberic($datas[$i]['birthday']['raw'])==$weekdayNumber) {

							$weekdayContainer[$weekdayNumber][]=$datas[$i];

						}

					}

				}

				$weekdayContainer[5]='';

				?>

				<table class="table table-condensed table-bordered birthdayoneach">
					<thead>
						<tr>
							<?php

							//WRITE OUT MON - SUN
							$days = array_map(function ($day) {
								return strtoupper(date_create('Sunday')->modify("+$day day")->format('D'));},
								range(0, 6)
							);

							foreach ($days as $key => $value) { echo '<th>'.$value.'</th>'; }

							?>
						</tr>
					</thead>
					<tbody>
						<tr>
							<?php

							for ($weekdayNumber=1; $weekdayNumber < 8 ; $weekdayNumber++) {

								echo '<td><ul>';

								if($weekdayContainer[$weekdayNumber]!='') { //SHOW OUT IMAGE WITH NAME

									foreach ($weekdayContainer[$weekdayNumber] as $info) {

										echo '<li>';
										echo showImage('',$info['photo'],$info['name'],'','');
										echo $info['name'];
										echo '</li>';

									}

								} else { echo 'No one born in this day';}

								echo '</ul></td>';
							}

							?>
						</tr>
					</tbody>
				</table>


				<h2>TEST C: Search things</h2>

				<form id="form1" action="search.php" method="get" class="form-horizontal">
				<fieldset>

				<!-- Form Name -->
				<legend class="mb-20">NOTE: Search result will return by JSON</legend>

				<!-- Multiple Checkboxes -->
				<div class="form-group">
					<label class="col-md-3 control-label" for="xxx"></label>
					<div class="col-md-6">
						<div class="checkbox"><label for="Uniqid-0"><input type="checkbox" name="uniq_id" id="Uniqid-0" value="032d715cabef6d4633e753de416929a8">Uniq Id = 032d715cabef6d4633e753de416929a8</label></div>

						<div class="checkbox"><label for="Uniqid-1"><input type="checkbox" name="property_type" id="Uniqid-1" value="Hotel">is Hotel</label></div>

						<div class="checkbox"><label for="Uniqid-2"><input type="checkbox" name="city" id="Uniqid-2" value="Kanpur">in Kanpur</label></div>

						<div class="checkbox"><label for="Uniqid-3"><input type="checkbox" name="amenities" id="Uniqid-3" value="Parking">has Parking</label></div>

						<div class="checkbox"><label for="Uniqid-4"><input type="checkbox" name="room_price" id="Uniqid-4" value="1000-2000">price 1000-2000</label></div>

						<!-- <div class="checkbox"><label for="Uniqid-5"><input type="checkbox" name="uniq_id" id="Uniqid-5" value="1"></label> -->

					</div>
				</div>

				<!-- Button -->
				<div class="form-group">
					<label class="col-md-3 control-label" for="submit"></label>
					<div class="col-md-4">
						<button id="submit" class="btn btn-primary btn-lg" style="width:300px;">Submit</button>
					</div>
				</div>

				</fieldset>
				</form>
				<!-- /.form-horizontal -->


				<?php //print("<pre>"); print_r($datas); print("</pre>"); ?>

			</div>
			<!-- /.col-xs-12 -->


		</div>
	</div>

	</body>
	</html>