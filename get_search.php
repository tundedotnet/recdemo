<?php
@session_start();

	include 'class/connectDB.php';

	extract($_POST);

	$limit = 24;

	$start_from = ($page-1) * $limit;

	$sql = "SELECT movies.movieid as movieid, rtitle, yearreleased, AVG(rating) AS rating FROM movies JOIN ratings ON movies.movieid=ratings.movieid WHERE rtitle LIKE '%$ref%' GROUP BY movieid ORDER BY rating DESC, rtitle ASC LIMIT $start_from, $limit";

	$result = $conn->query($sql);

	if($result->num_rows > 0)
	{
		$records = [];
		while ($row = $result->fetch_assoc()) {
			$records[] = $row;
		}

		$returnjson = json_encode($records);
		echo $returnjson;
	}
	else
		echo 0;
	
	exit();

?>