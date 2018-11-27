<?php

@session_start();

class Movies
{
	
	function __construct()
	{
		# code...
	}

	function guest_recommendations()
	{
		include 'connectDB.php';
		include('clickstreamapi.php');

		$click = new ClickStreamAPI('session');
		$guest_id = $click->get_id();
		$_SESSION['guestid'] = $guest_id;
		/*print "<pre>";
		echo $guest_id;
		print "</pre>";*/

		$_SESSION['guestrecommendations']='NA';

		$url = "https://deep-rec.com/api/recommend";
		$fields = array(
			"user_id" => $guest_id,
		  	"K" => 12,
		  	"account_api_key" => "abdRDXE4I6XhRvKbg4S29DR2di97RNOC",
		  	"account_id" => "1"
		);

		$postdata = json_encode($fields);

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
		$toprec = $response['recommend']; # RECOMMENDED MOVIE ID ARRANGED IN DESCENDING ORDER OF MOVIE RATING
		/*print "<pre>";
		echo print_r($toprec);
		print "</pre>";*/
	
		$movieIDs = array_keys($toprec);
		// echo implode(",", $movieIDs) . "<br/><br>";

		$recommendation = $this->get_movies($conn, $movieIDs); # GET OTHER ATTRIBUTES OF THE TOP-K movies
		$ratings = $this->get_ratings($conn);
		// print "<pre>";
		// print_r($recommendation);
		// print "</pre>";

		$topk = array();
		foreach($recommendation as $rec)
		{
			$mid = $rec['movieid'];
			$rate = array_key_exists($mid, $ratings) ? $ratings[$mid] : 0;
			$topk[$mid] = array($rec['rtitle'], $rec['yearreleased'], $toprec[$mid], str_replace("|", ", ", $rec['genres']), $rate);
		}
		// print_r($topk); echo "<br/><br>";

		# RE-ARRANGE THE TOP-K MOVIE IN THE ORDER OF MOVIE RATING
		$movies = array();
		foreach(array_keys($toprec) as $key)
		{
			if (array_key_exists($key, $topk))
				$movies["$key"] = $topk["$key"];
		}
		
		return $movies;
		// $_SESSION['guestrecommendations'] = $movies;
	}

	function get_top_recommended()
	{
		include 'connectDB.php';

		$_SESSION['toprecommended']='NA';

		$url = "https://deep-rec.com/api/recommend";
		$fields = array(
		  "user_id" => $_SESSION['userid'],
		  "K" => 12,
		  "account_api_key" => "abdRDXE4I6XhRvKbg4S29DR2di97RNOC",
		  "account_id" => "1"
		);

		$postdata = json_encode($fields);

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
		$toprec = $response['recommend']; # RECOMMENDED MOVIE ID ARRANGED IN DESCENDING ORDER OF MOVIE RATING
		/*print "<pre>";
		print_r($toprec);
		print "</pre>";*/
	
		$movieIDs = array_keys($toprec);
		// echo implode(",", $movieIDs) . "<br/><br>";

		$recommendation = $this->get_movies($conn, $movieIDs); # GET OTHER ATTRIBUTES OF THE TOP-K movies
		$ratings = $this->get_ratings($conn);
		// print "<pre>";
		// print_r($recommendation);
		// print "</pre>";

		$topk = array();
		foreach($recommendation as $rec)
		{
			$mid = $rec['movieid'];
			$rate = array_key_exists($mid, $ratings) ? $ratings[$mid] : 0;
			$topk[$mid] = array($rec['rtitle'], $rec['yearreleased'], $toprec[$mid], str_replace("|", ", ", $rec['genres']), $rate);
		}
		/*print "<pre>";
		print_r($topk);
		print "</pre>";*/

		# RE-ARRANGE THE TOP-K MOVIE IN THE ORDER OF MOVIE RATING
		$movies = array();
		foreach(array_keys($toprec) as $key)
		{
			if (array_key_exists($key, $topk))
				$movies["$key"] = $topk["$key"];
		}
		
		return $movies;
		// $_SESSION['toprecommended'] = $movies;
	}

	function get_top_viewed()
	{
		include 'connectDB.php';

		$_SESSION['topviewed']='NA'; # I refuse to use session because any update in database will not reflect in the session result display.

		$sql = "SELECT ratings.movieid AS movieid, rtitle, yearreleased, COUNT(rating) AS rcount, AVG(rating) AS average FROM ratings INNER JOIN movies ON ratings.movieid=movies.movieid GROUP BY movieid ORDER BY rcount DESC, average DESC, yearreleased DESC, title ASC LIMIT 12";

		$result = $conn->query($sql);

		if($result->num_rows > 0)
		{
			$topviewed = [];
			while ($row = $result->fetch_assoc()) {
				$topviewed[] = $row;
			}
			$_SESSION['topviewed'] = $topviewed;
		}
	}

	function get_top_rated()
	{
		include 'connectDB.php';
		$_SESSION['toprated']='NA'; # I refuse to use session because any update in database will not reflect in the session result display.

		$sql = "SELECT ratings.movieid AS movieid, rtitle, yearreleased, COUNT(rating) AS rcount, AVG(rating) as average FROM ratings INNER JOIN movies ON ratings.movieid=movies.movieid GROUP BY movieid ORDER BY average DESC, rcount DESC, yearreleased DESC, title ASC LIMIT 12";

		$result = $conn->query($sql);

		if($result->num_rows > 0)
		{
			$toprated = [];
			while ($row = $result->fetch_assoc()) {
				$toprated[] = $row;
			}
			$_SESSION['toprated'] = $toprated;
		}	
	}

	function get_top_recent()
	{
		include 'connectDB.php';
		$_SESSION['toprecent']='NA'; # I refuse to use session because any update in database will not reflect in the session result display.

		$sql = "SELECT ratings.movieid AS movieid, rtitle, yearreleased, COUNT(rating) AS rcount, AVG(rating) as average FROM ratings INNER JOIN movies ON ratings.movieid=movies.movieid GROUP BY movieid ORDER BY yearreleased DESC, average DESC, rcount DESC, title ASC LIMIT 12";

		$result = $conn->query($sql);

		if($result->num_rows > 0)
		{
			$toprecent = [];
			while ($row = $result->fetch_assoc()) {
				$toprecent[] = $row;
			}
			$_SESSION['toprecent'] = $toprecent;
		}	
	}

	function get_related_recommendations($movieIDs, $userid)
	{
		include 'connectDB.php';

		$catIDs = $this->get_categories($conn, $movieIDs);
		$intCartID = [];
		foreach(explode(',', $catIDs) as $id)
			$intCartID[] = (int)$id;

		$_SESSION['guestrecommendations']='NA';

		$url = "https://deep-rec.com/api/recommend";
		$fields = array(
			"user_id" => $userid,
			"K" => 11,
			"account_api_key" => "abdRDXE4I6XhRvKbg4S29DR2di97RNOC",
			"account_id" => "1",
			"category" => $intCartID
		);

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
		$toprec = $response['recommend']; # RECOMMENDED MOVIE ID ARRANGED IN DESCENDING ORDER OF MOVIE RATING
		/*print "<pre>";
		echo print_r($toprec);
		print "</pre>";*/
	
		$movieIDs = array_keys($toprec);
		// echo implode(",", $movieIDs) . "<br/><br>";

		$recommendation = $this->get_movies($conn, $movieIDs); # GET OTHER ATTRIBUTES OF THE TOP-K movies
		/*print "<pre>";
		print_r($recommendation);
		print "</pre>";*/

		$topk = array();
		foreach($recommendation as $rec)
		{
			$mid = $rec['movieid'];
			// $rating = round($this->get_average_rating($mid), 2);
			$topk[$mid] = array($rec['rtitle'], $rec['yearreleased'], $toprec[$mid], $rec['genres'], $rec['rating'], $rec['count']);
		}
		// print_r($topk); echo "<br/><br>";

		# RE-ARRANGE THE TOP-K MOVIE IN THE ORDER OF MOVIE RATING
		$movies = array();
		foreach(array_keys($toprec) as $key)
		{
			if (array_key_exists($key, $topk))
				$movies["$key"] = $topk["$key"];
		}
		
		return $movies;
		// $_SESSION['guestrecommendations'] = $movies;
	}

	function get_movies($conn, $movieIDs)
	{
		$comma_separated_IDs = implode(",", $movieIDs);

		$sql = "SELECT movies.movieid as movieid, rtitle, yearreleased, genres, COUNT(rating) as count, AVG(rating) as rating FROM movies LEFT JOIN ratings ON movies.movieid=ratings.movieid WHERE movies.movieid IN ($comma_separated_IDs) GROUP BY movieid";
		$result = $conn->query($sql);

		if($result->num_rows > 0)
		{
			$recommendation = [];
			while ($row = $result->fetch_assoc()) {
				$recommendation[] = $row;
			}

			/*print($comma_separated_IDs);
			print "<pre>";
			print_r($recommendation);
			print "</pre>";*/
		
			return $recommendation;
		}
		else
			return 0;
	}

	function get_ratings($conn)
	{
		// $sql = "SELECT movieid, rating FROM ratings WHERE userid = ". $_SESSION['userid'];
		$sql = "SELECT movieid, AVG(rating) as rating FROM ratings GROUP BY movieid";
		$result = $conn->query($sql);

		if($result->num_rows > 0)
		{
			$ratings = [];
			while ($row = $result->fetch_assoc()) {
				$ratings[$row['movieid']] = $row['rating'];
			}

			/*print "<pre>";
			print_r($ratings);
			print "</pre>";*/
		
			return $ratings;
		}
		else
			return 0;
	}

	function get_average_rating($mid)
	{
		include 'connectDB.php';

		$sql = "SELECT AVG(rating) AS rating FROM ratings WHERE movieid = $mid";

		// USED FOR SELECT(COUNT) AS total....
		$result = mysqli_query($conn, $sql);
		$data=mysqli_fetch_assoc($result);
		return $data['rating'];
	}

	function get_details($movieid)
	{
		include 'connectDB.php';

		if (isset($_SESSION['accesstag']) AND $_SESSION['accesstag'] == 'OK') {
			$userid = $_SESSION['userid'];
			$sql = "SELECT rating FROM ratings WHERE movieid=$movieid AND userid=$userid ORDER BY rid DESC LIMIT 1";
			$result = mysqli_query($conn, $sql);

			if(mysqli_num_rows($result)!=0)
			{
				$data=mysqli_fetch_assoc($result);
				$rating = $data['rating'];
				$_SESSION['last_rating'] = $rating;

				$userid = $_SESSION['userid'];
				$_SESSION['numberofrating'] = count_rating($conn, $movieid, $userid);

				/*print "<pre>";
				print($rating);
				print "</pre>";*/
			}
			else
			{
				$_SESSION['last_rating'] = 'NA';
				$_SESSION['numberofrating'] = 0;
			}

		}
		

		$sql = "SELECT movies.movieid as movieid, rtitle, yearreleased, genres, AVG(ratings.rating) as rating, description, director, country, language FROM movies JOIN ratings ON movies.movieid=ratings.movieid JOIN movies_info ON movies.movieid=movies_info.movieid WHERE movies.movieid = $movieid";

		$result = $conn->query($sql);

		if($result->num_rows > 0)
		{
			while ($row = $result->fetch_assoc()) {
				return $row;
			}
		}
		else
			return 0;


	}

	function get_categories($conn, $movieid)
	{
		$sql = "SELECT categories FROM movies WHERE movieid = $movieid LIMIT 1";
		$result = $conn->query($sql);

		if($result->num_rows > 0)
		{
			while ($row = $result->fetch_assoc()) {
				return $row['categories'];
			}
		}
		else
			return 0;
	}

	function get_listof_genre()
	{
		include 'connectDB.php';

		$sql = "SELECT genres FROM movies";

		$result = $conn->query($sql);

		$all_genres = array();
		if($result->num_rows > 0)
		{
			while ($row = $result->fetch_assoc()) {
				$genres = explode("|", $row['genres']);

				foreach ($genres as $g) {
					if(!in_array($g, $all_genres))
						$all_genres[] = $g;
				}
			}
		}	

		sort($all_genres);
		// print "<pre>";
		// echo print_r($all_genres);
		// print "</pre>";

		return $all_genres;
	}

	function get_genre($start_from, $limit)
	{
		include 'connectDB.php';

		$key = $_GET['ref']; #Default is action

		if(strpos($key, "Children") !== false)
			$key = "Children";

		$sql = "SELECT movies.movieid as movieid, rtitle, yearreleased, AVG(rating) AS rating FROM movies JOIN ratings ON movies.movieid=ratings.movieid WHERE genres LIKE '%$key%' GROUP BY movieid ORDER BY rating DESC LIMIT $start_from, $limit";

		$result = $conn->query($sql);

		$records = [];
		if($result->num_rows > 0)
		{
			while ($row = $result->fetch_assoc()) {
				$records[] = $row;
			}
		}	

		/*print "<pre>";
		echo $key;
		print "</pre>";*/

		return $records;
	}

	function count_genre()
	{
		include 'connectDB.php';
		$_SESSION['total_records']=0;

		$key = $_GET['ref']; #Default is action

		if(strpos($key, "Children") !== false)
			$key = "Children";

		$_SESSION['ref'] = $_GET['ref']; #Default is action

		$sql = "SELECT COUNT(movieid) as total FROM movies WHERE genres LIKE '%$key%'";  
		$result=mysqli_query($conn, $sql);
		$data=mysqli_fetch_assoc($result);

		$total_records = $data['total'];
		$_SESSION['total_records'] = $total_records;

		return $total_records;
	}

	function count_rating($conn, $movieid, $userid) {
		
		$sql = "SELECT COUNT(rating) as total FROM ratings WHERE movieid=$movieid AND userid=$userid";  
		$result=mysqli_query($conn, $sql);
		$data=mysqli_fetch_assoc($result);

		if (mysqli_num_rows($data)!=0)
		{
			$total_records = $data['total'];

			return $total_records;
		}
		else
			return 0;
	}

	function count_fetch_movies()
	{
		include 'connectDB.php';

		if(!isset($_GET['ref']))
		{
			$sql = "SELECT movies.movieid AS movieid, AVG(rating) as total FROM movies INNER JOIN ratings ON movies.movieid=ratings.movieid GROUP BY movieid";
			
		}
		else if(isset($_GET['ref']) AND $_GET['ref'] == 'digit')
		{
			$sql = "SELECT movies.movieid AS movieid, AVG(rating) as total FROM movies INNER JOIN ratings ON movies.movieid=ratings.movieid WHERE rtitle LIKE '0%' OR rtitle LIKE '1%' OR rtitle LIKE '2%'  OR rtitle LIKE '3%'  OR rtitle LIKE '4%' OR rtitle LIKE '5%'  OR rtitle LIKE '6%' OR rtitle LIKE '7%' OR rtitle LIKE '8%' OR rtitle LIKE '9%' GROUP BY movieid";
		}
		else
		{
			$startwith = $_GET['ref'];
			$sql = "SELECT movies.movieid AS movieid, AVG(rating) as total FROM movies INNER JOIN ratings ON movies.movieid=ratings.movieid WHERE rtitle LIKE '$startwith%' GROUP BY movieid";
		}

		$result = $conn->query($sql);

		$movies = [];
		if($result->num_rows > 0)
		{
			while ($row = $result->fetch_assoc()) {
				$movies[] = $row;
			}
		}

		return count($movies);


		/* // USED FOR SELECT(COUNT) AS total....
		$result = mysqli_query($conn, $sql);
		$data=mysqli_fetch_assoc($result);
		return $data['total'];*/
	}

	function fetch_movies($start_from, $limit)
	{
		include 'connectDB.php';

		if(!isset($_GET['ref']))
		{
			$sql = "SELECT movies.movieid AS movieid, rtitle, yearreleased, genres, AVG(ratings.rating) AS average, director, country, language FROM movies INNER JOIN ratings ON movies.movieid=ratings.movieid INNER JOIN movies_info ON movies.movieid=movies_info.movieid GROUP BY movieid ORDER BY rtitle ASC, average DESC, yearreleased DESC LIMIT $start_from, $limit";
		}
		else if(isset($_GET['ref']) AND $_GET['ref'] == 'digit')
		{
			$sql = "SELECT movies.movieid AS movieid, rtitle, yearreleased, genres, AVG(ratings.rating) AS average, director, country, language FROM movies INNER JOIN ratings ON movies.movieid=ratings.movieid INNER JOIN movies_info ON movies.movieid=movies_info.movieid WHERE rtitle LIKE '0%' OR rtitle LIKE '1%' OR rtitle LIKE '2%'  OR rtitle LIKE '3%'  OR rtitle LIKE '4%' OR rtitle LIKE '5%'  OR rtitle LIKE '6%' OR rtitle LIKE '7%' OR rtitle LIKE '8%' OR rtitle LIKE '9%' GROUP BY movieid ORDER BY rtitle ASC, average DESC, yearreleased DESC LIMIT $start_from, $limit";
		}
		else
		{
			$startwith = $_GET['ref'];
			$sql = "SELECT movies.movieid AS movieid, rtitle, yearreleased, genres, AVG(ratings.rating) AS average, director, country, language FROM movies INNER JOIN ratings ON movies.movieid=ratings.movieid INNER JOIN movies_info ON movies.movieid=movies_info.movieid WHERE rtitle LIKE '$startwith%' GROUP BY movieid ORDER BY rtitle ASC, average DESC, yearreleased DESC LIMIT $start_from, $limit";
		}

		

		$result = $conn->query($sql);

		if($result->num_rows > 0)
		{
			$movies = [];
			while ($row = $result->fetch_assoc()) {
				$movies[] = $row;
			}

			/*print "<pre>";
			echo print_r($movies);
			print "</pre>";*/

			return $movies;
		}
	}

	function count_search($keyword)
	{
		include 'connectDB.php';

		$sql = "SELECT movies.movieid as movieid, rtitle, yearreleased, AVG(rating) AS rating FROM movies JOIN ratings ON movies.movieid=ratings.movieid WHERE title LIKE '%$keyword%' GROUP BY movieid ORDER BY rating DESC";

		$result = $conn->query($sql);

		$movies = [];
		if($result->num_rows > 0)
		{
			while ($row = $result->fetch_assoc()) {
				$movies[] = $row;
			}
		}

		return count($movies);


		/* // USED FOR SELECT(COUNT) AS total....
		$result = mysqli_query($conn, $sql);
		$data=mysqli_fetch_assoc($result);
		return $data['total'];*/
	}

	function search($keyword, $start_from, $limit)
	{
		include 'connectDB.php';

		$sql = "SELECT movies.movieid as movieid, rtitle, yearreleased, AVG(rating) AS rating FROM movies JOIN ratings ON movies.movieid=ratings.movieid WHERE rtitle LIKE '%$keyword%' GROUP BY movieid ORDER BY rating DESC, rtitle ASC LIMIT $start_from, $limit";

		$result = $conn->query($sql);

		$records = [];
		if($result->num_rows > 0)
		{
			while ($row = $result->fetch_assoc()) {
				$records[] = $row;
			}
		}

		 $_SESSION['total_search_records'] = count($records);

		/*print "<pre>";
		echo print_r($records);
		print "</pre>";*/

		return $records;
	}
}

?>