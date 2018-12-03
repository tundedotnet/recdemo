<?php
function loadpng($imgname,$title)
{
	//load image from file
    $im = imagecreatefrompng($imgname);

    //assign color
    $black = imagecolorallocate($im, 0, 0, 0);
    $white  = imagecolorallocate($im, 255, 255, 255);

    //set all black color in image to transparent
    imagecolortransparent($im, $black);

    //genrate random color
    $random_color = imagecolorallocate($im, rand(1,128), rand(1,128), rand(1,128));

    $font_size = 30;
    // $font_size = 45; // For details image
    $font_path = __DIR__ . '/arial.ttf';

	$word = $title;
    $word = wordwrap($word,15, "|");
    $word = explode("|",$word);

    $angle = 0;

    $width = imagesx($im);
	$height = imagesy($im);

	imagefilledrectangle($im, 0, 70, $width, $height, $random_color);

	$height = $height - (count($word)-1)*$font_size*0.7;

	foreach ($word as $k => $v) {
		$bbox = imagettfbbox($font_size, $angle, $font_path, $v );

		$font_width = $bbox[4] / 2;
		$font_height = $bbox[5] / 2;

		$x  = $width / 2 - $font_width;
		$y  = $height / 2 - $font_height;
		$y = $y + $k*$font_size*1.3;

		imagettftext($im, $font_size, $angle, $x, $y, $white, $font_path, $v);	
	}
	return $im;
}

function createimage()
{
	header('Content-Type: image/png');

	include 'class/connectDB.php';

	$sql = "SELECT movieid, rtitle FROM movies";
	$result = $conn->query($sql);

	if($result->num_rows > 0)
	{
		while ($row = $result->fetch_assoc()) {

			$title = $row['rtitle']; // isset($_GET['title'])?$_GET['title']:'Moive Title demo testing 123123';

			$img = loadpng('blankscaled.png',$title);
			// $img = loadpng('details.png',$title);

			imagepng($img, 'imagescreated/'. $row['movieid'] . '_imdb.png');
			// imagepng($img, 'imagescreated/'. $row['movieid'] . 'det.png');

			imagedestroy($img);
		}
	}

	echo "ALL DONE. MOVIES' IMAGES CREATED";
}


/*$image =  imagecreatefrompng("blank.png");
$imageScaled = imagescale($image, 300, 442);
// Save the image as 'simpletext.jpg'


imagepng($imageScaled, "blankscaled.png", 9);
// Free up memory*/

// createimage();

?>