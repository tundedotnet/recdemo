<?php
@session_start();

	include 'class/connectDB.php';

	$movieid = $_GET['ref'];
	$star = $_GET['star'];
	$userid = $_SESSION['userid'];

	/*print($userid);
	echo "<br>";*/

	$date = new DateTime();
	$timestamp = $date->getTimestamp();
	// echo $timestamp . '<br/>';

	$sql = "INSERT INTO ratings (userid, movieid, rating, timstamp) VALUES ($userid, $movieid, $star, $timestamp)";
	/*print "<pre>";
	echo $sql;
	print "</pre>";*/

	echo mysqli_query($conn, $sql); 

	/*if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}*/

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
	        'header'  => 'Content-type: application/x-www-form-urlencoded',
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