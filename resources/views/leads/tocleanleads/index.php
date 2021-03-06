<?php

	include('../../../../config/database.php');

	$csv_filename = 'united_kingdom'.date('Y-m-d').'.csv';

	$query = "SELECT * FROM  tbl_client_phone WHERE LENGTH(phone) = '12' AND phone LIKE '447%' OR phone LIKE '442%' WHEN phone LIKE '447%' THEN type = 'Mobile' WHEN phone LIKE '442%' THEN type = 'Telephone' ORDER BY phone ASC";

	$statement = $pdo_connect->prepare($query);

	$statement->execute();

	$result = $statement->fetchAll();

	$total_row = $statement->rowCount();

	$output = '';

	if($total_row > 0) {
		foreach ($result as $row) {
			$output .= ''.$row["email"].',	'.$row["phone"].',	'.$row["firstname"].',	'.$row["lastname"].'	,	'.'GE,	Germany'.'
			';
		}
	} else {
		$output .= '
			No record(s) to be display.
		';
	}

	$output .= '';

	header("Content-type: text/x-csv");
	header("Content-Disposition: attachment; filename=".$csv_filename."");

	echo $output;