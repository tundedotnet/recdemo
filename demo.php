<?php


	include_once 'class/imdb.class.php';


	function create_imdb_image($sn, $title, $mid)
	{
		$oIMDB = new IMDB($title);
		if ($oIMDB->isReady)
		{
		    // echo '<p><a href="' . $oIMDB->getUrl() . '">' . $oIMDB->getTitle() . '</a> got rated ' . $oIMDB->getPoster() . '.</p>';

		    $image = imagecreatefrompng($oIMDB->getPoster());

		    $filaname = "imdb_images/" . $mid . "_imdb.png";

			imagepng($image, $filaname);
			imagedestroy($image);

			// echo $sn . "</br>";
		} 
		else {
		    echo '<p>Movie not found!</p>';
		}
	}

	function create_imdb_expanded_image($mid, $postal)
	{
		// $postal = "https://m.media-amazon.com/images/M/MV5BODQ0NDhjYWItYTMxZi00NTk2LWIzNDEtOWZiYWYxZjc2MTgxXkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_UY1200_CR90,0,630,1200_AL_.jpg";

		$file_parts = pathinfo($postal);

		if ($file_parts['extension'] == 'jpg')
		{
			// echo $postal . '<br/>';

			$lastIndex = strripos($postal, '630,');
			// echo $lastIndex . '<br/>';

			$substr = substr($postal, 0, $lastIndex);

			$newpostal = $substr . '813,1200_AL_.jpg';

			// echo $newpostal . '<br/>';

			$image = imagecreatefromjpeg($newpostal);

		    $filaname = "imdb_images/" . $mid . "_imdb.png";
		    // $filaname = "imdb_images/text" . "_imdb.png";

			imagepng($image, $filaname);
			imagedestroy($image);
		}
	}

	function get_imdb_image_info($title, $mid)
	{
		include 'class/connectDB.php';
		
		$oIMDB = new IMDB($title);
		if ($oIMDB->isReady)
		{
		    $url =mysqli_real_escape_string($conn, $oIMDB->getUrl());
    		$imdbtitle =mysqli_real_escape_string($conn, $oIMDB->getTitle());
	    	$postal =mysqli_real_escape_string($conn, $oIMDB->getPoster());
	    	$country =mysqli_real_escape_string($conn, $oIMDB->getCountry());
	    	$desc =mysqli_real_escape_string($conn, $oIMDB->getDescription());
	    	$director =mysqli_real_escape_string($conn, $oIMDB->getDirector());
	    	$genre =mysqli_real_escape_string($conn, $oIMDB->getGenre());
	    	$gross =mysqli_real_escape_string($conn, $oIMDB->getGross());
	    	$lang =mysqli_real_escape_string($conn, $oIMDB->getLanguage());
	    	$location =mysqli_real_escape_string($conn, $oIMDB->getLocation());
	    	$rating =mysqli_real_escape_string($conn, $oIMDB->getRating());
	    	$isreleased =mysqli_real_escape_string($conn, $oIMDB->isReleased());
	    	$ReleaseDate =mysqli_real_escape_string($conn, $oIMDB->getReleaseDate());
	    	$season =mysqli_real_escape_string($conn, $oIMDB->getSeasons());
	    	$UserReview =mysqli_real_escape_string($conn, $oIMDB->getUserReview());
	    	$Writer =mysqli_real_escape_string($conn, $oIMDB->getWriter());
		} 
		else {
		    $url = 'Movie not found!';
    		$imdbtitle = 'Movie not found!';
	    	$postal = 'Movie not found!';
	    	$country = 'Movie not found!';
	    	$desc = 'Movie not found!';
	    	$director = 'Movie not found!';
	    	$genre = 'Movie not found!';
	    	$gross = 'Movie not found!';
	    	$lang = 'Movie not found!';
	    	$location = 'Movie not found!';
	    	$rating = 'Movie not found!';
	    	$isreleased = 'Movie not found!';
	    	$ReleaseDate = 'Movie not found!';
	    	$season = 'Movie not found!';
	    	$UserReview = 'Movie not found!';
	    	$Writer = 'Movie not found!';
		}

		$sql = "INSERT INTO movies_info VALUES ($mid, '$title', '$url', '$imdbtitle', '$postal', '$country', '$desc', '$director', '$genre', '$gross', '$lang', '$location', '$rating', '$isreleased', '$ReleaseDate', '$season', '$UserReview', '$Writer'); ";

		mysqli_query($conn, $sql);

		// print($sql) . " :: HERE<br>";
		// echo $sql; exit();		
	}

	function createscaledimage($filename)
	{
		$image =  imagecreatefrompng("imdb_images/$filename");
		$imageScaled = imagescale($image, 300);
		// Save the image as 'simpletext.jpg'


		imagepng($imageScaled, "imdb_scaled_images/$filename", 9);
		// Free up memory
		imagedestroy($imageScaled);
	}

	function createscaled_detailsimage($filename)
	{
		$image =  imagecreatefrompng("imdb_images/$filename");
		$imageScaled = imagescale($image, 500, 192);
		// Save the image as 'simpletext.jpg'


		imagepng($imageScaled, "imdb_scaled_detimages/$filename", 9);
		// Free up memory
		imagedestroy($imageScaled);
	}


	function createimage()
	{
		include 'class/connectDB.php';

		$sql = "SELECT movieid, rtitle FROM movies";
		$result = $conn->query($sql);

		if($result->num_rows > 0)
		{
			$i = 1;
			while ($row = $result->fetch_assoc()) {

				$title = $row['rtitle'];
				$mid = $row['movieid'];

				create_imdb_image($i, $title, $mid);
				$i++;
			}
		}

		echo "ALL DONE. MOVIES' IMAGES CREATED";
	}

	function createexpandedimage()
	{
		include 'class/connectDB.php';

		$sql = "SELECT movieid, postal FROM movies_info";
		$result = $conn->query($sql);

		if($result->num_rows > 0)
		{
		
			while ($row = $result->fetch_assoc()) {

				$postal = $row['postal'];
				$mid = $row['movieid'];

				create_imdb_expanded_image($mid, $postal);
				
			}
		}

		echo "ALL DONE. MOVIES' IMAGES CREATED";
	}

	function createimageinformation()
	{
		include 'class/connectDB.php';

		$sql = "SELECT movieid, rtitle FROM movies";
		$result = $conn->query($sql);

		$sql = "";
		if($result->num_rows > 0)
		{
			$i = 1;
			
			while ($row = $result->fetch_assoc()) {

				$title = $row['rtitle'];
				$mid = $row['movieid'];

				$getquery = get_imdb_image_info($title, $mid);
				
				/*echo "$i <br>";
				if ($i==5)
					break;

				$i++;*/

				// $sql .= $getquery;
		
			}
		}

		/*print($sql) . '<br>';
		if (mysqli_multi_query($conn, $sql))
			echo "insert successful";
		else
			echo "failed! " . mysqli_error($conn);;

		mysqli_close($conn);*/

		echo "ALL DONE. MOVIES' IMAGES CREATED";
	}

	function createotherimages()
	{
		include 'class/connectDB.php';

		$sql = "SELECT movieid, rtitle FROM movies";
		$result = $conn->query($sql);

		if($result->num_rows > 0)
		{
			$i = 1;

			$files = array_diff(scandir('imdb_images/move/'), array('.', '..'));
			// echo count($files); exit(); return;

			while ($row = $result->fetch_assoc()) {

				$title = $row['rtitle'];
				$mid = $row['movieid'];

				$needle = $mid . "_imdb.png";
				if(!in_array($needle, $files))
				{
					create_imdb_image($i, $title, $mid);
					$i++;
				}
				
			}
		}

		echo "ALL DONE. MOVIES' IMAGES CREATED";
	}


	function scaleimage()
	{
		
		$files = array_diff(scandir('imdb_images/'), array('.', '..'));
		
		foreach ($files as $key => $value) {
			if($value != 'new')
				createscaledimage($value);
		}

		echo "DONE";

	}

	// VERY BAD IMAGE
	function scaleimage_for_details()
	{
		include 'class/connectDB.php';

		$sql = "SELECT movieid, rtitle FROM movies";
		$result = $conn->query($sql);

		if($result->num_rows > 0)
		{
			$i = 1;

			$files = array_diff(scandir('imdb_images/'), array('.', '..'));
			
			foreach ($files as $key => $value) {
				if($value != 'new')
					createscaled_detailsimage($value);
			}

		}
		// createscaledimage("1_imdb.png");
		// createscaledimage("5_imdb.png");

		echo "DONE";

	}


// createimageinformation();

/*echo "<br><br>";
$oIMDB = new IMDB("Star Wars: Episode VI - Return");
if ($oIMDB->isReady)
{
    echo '<pre>';

    	echo 'URL - <a href="' . $oIMDB->getUrl() . '">' . $oIMDB->getUrl() . "</a> <br/>";
    	echo 'Title - ' . $oIMDB->getTitle() . "<br/>";
    	echo 'Postal - ' . $oIMDB->getPoster() . "<br/>";
    	echo 'Country - ' . $oIMDB->getCountry() . "<br/>";
    	echo 'Description - ' . $oIMDB->getDescription() . "<br/>";
    	echo 'Director - ' . $oIMDB->getDirector() . "<br/>";
    	echo 'Genre - ' . $oIMDB->getGenre() . "<br/>";
    	echo 'Gross - ' . $oIMDB->getGross() . "<br/>";
    	echo 'Lanugage - ' . $oIMDB->getLanguage() . "<br/>";
    	echo 'Location - ' . $oIMDB->getLocation() . "<br/>";
    	echo 'Rating - ' . $oIMDB->getRating() . "<br/>";
    	echo 'isReleased? - ' . $oIMDB->isReleased() . "<br/>";
    	echo 'ReleaseDate - ' . $oIMDB->getReleaseDate() . "<br/>";
    	echo 'Seasons - ' . $oIMDB->getSeasons() . "<br/>";
    	echo 'UserReview - ' . $oIMDB->getUserReview() . "<br/>";
    	echo 'Writer - ' . $oIMDB->getWriter() . "<br/>";

    echo "</pre>";

} 
else {
    echo '<p>Movie not found!</p>';
}*/


// createexpandedimage();


// createotherimages();
// scaleimage();
// scaleimage_for_details(); // VERY BAD IMAGE

?>
