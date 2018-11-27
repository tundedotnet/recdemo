<?php
@session_start();

	include 'class/connectDB.php';

	extract($_POST);

	$limit = 20;

	$start_from = ($page-1) * $limit;
	// echo $start_from; exit();

	if($ref == 'all')
	{
		// echo "all"; exit();
		$sql = "SELECT movies.movieid AS movieid, rtitle, yearreleased, genres, AVG(ratings.rating) AS average, director, country, language FROM movies INNER JOIN ratings ON movies.movieid=ratings.movieid INNER JOIN movies_info ON movies.movieid=movies_info.movieid GROUP BY movieid ORDER BY rtitle ASC, average DESC, yearreleased DESC LIMIT $start_from, $limit";
	}
	else if($ref == 'digit')
	{
		// echo "digit"; exit();
		$sql = "SELECT movies.movieid AS movieid, rtitle, yearreleased, genres, AVG(ratings.rating) AS average, director, country, language FROM movies INNER JOIN ratings ON movies.movieid=ratings.movieid INNER JOIN movies_info ON movies.movieid=movies_info.movieid WHERE rtitle LIKE '0%' OR rtitle LIKE '1%' OR rtitle LIKE '2%'  OR rtitle LIKE '3%'  OR rtitle LIKE '4%' OR rtitle LIKE '5%'  OR rtitle LIKE '6%' OR rtitle LIKE '7%' OR rtitle LIKE '8%' OR rtitle LIKE '9%' GROUP BY movieid ORDER BY rtitle ASC, average DESC, yearreleased DESC LIMIT $start_from, $limit";
	}
	else
	{
		// echo "alpha"; exit();
		$startwith = $ref;
		$sql = "SELECT movies.movieid AS movieid, rtitle, yearreleased, genres, AVG(ratings.rating) AS average, director, country, language FROM movies INNER JOIN ratings ON movies.movieid=ratings.movieid INNER JOIN movies_info ON movies.movieid=movies_info.movieid WHERE rtitle LIKE '$startwith%' GROUP BY movieid ORDER BY rtitle ASC, average DESC, yearreleased DESC LIMIT $start_from, $limit";
	}

	

	$result = $conn->query($sql);

	if($result->num_rows > 0)
	{
		$movies = [];
		while ($row = $result->fetch_assoc()) {
			$movies[] = $row;
		}

		$returnjson = json_encode($movies);
		echo $returnjson;
	}
	else
		echo 0;
	
	exit();

?>