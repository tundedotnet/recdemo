<?php
@session_start();

	include 'class/connectDB.php';

	extract($_POST);

	$movieid = $ref;
	$userid = $_SESSION['userid'];

	/*print($userid);
	echo "<br>";*/

	$date = new DateTime();
	$timestamp = $date->getTimestamp();
	// echo $timestamp; exit();

	if (isset($_SESSION['accesstag']) AND $_SESSION['accesstag'] == 'OK') {
		$sql = "SELECT rid FROM ratings WHERE movieid=$movieid AND userid=$userid ORDER BY rid DESC LIMIT 1";
		$result = mysqli_query($conn, $sql);

		if(mysqli_num_rows($result)!=0)
		{
			$data=mysqli_fetch_assoc($result);
			$rid = $data['rid'];

			$sql = "UPDATE ratings SET rating=$star, timestamp=$timestamp WHERE rid=$rid";

			// echo "update";
		}
		else 
			$sql = "INSERT INTO ratings (userid, movieid, rating, timestamp) VALUES ($userid, $movieid, $star, $timestamp)"; //echo "add-update";
	}
	else
	{
		$sql = "INSERT INTO ratings (userid, movieid, rating, timestamp) VALUES ($userid, $movieid, $star, $timestamp)"; // echo "update";
	}

	// $sql = "INSERT INTO ratings (userid, movieid, rating, timestamp) VALUES ($userid, $movieid, $star, $timestamp)";
	// echo $sql; exit();

	$result = mysqli_query($conn, $sql)  or die(mysqli_error($conn)); 
	echo $result;

	// exit();

	/*if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: Record not inserted";
	}
	exit();*/

	// SAVE RATING THROUGH API CALL
	$url = "https://deep-rec.com/api/rating";
	$ratings = array(
		"user_id" => $userid,
		"item_id" => $movieid,
		"score" => (int)$star,
	);

	$fields = array(
	  "ratings" => [$ratings],
	  "account_api_key" => "abdRDXE4I6XhRvKbg4S29DR2di97RNOC",
	  "account_id" => "1"
	);

	/*print "<pre>";
	echo print_r($fields);
	print "</pre>";*/

	$postdata = json_encode($fields);
	/*print "<pre>";
	echo print_r($postdata);
	print "</pre>";*/

	$opts = array('http' =>
	    array(
	        'method'  => 'POST',
	        'header'  => 'Content-type: application/json',
	        'content' => $postdata
	    )
	);

	$context  = stream_context_create($opts);
	$result = file_get_contents($url, false, $context);

	$response = json_decode($result, true);
	
	/*print "<pre>";
	echo print_r($response);
	print "</pre>";*/

	/*header("Location: index.php"); 
	exit;*/

?>