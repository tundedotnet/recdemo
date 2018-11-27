<?php
	// header('Content-type: image/jpeg');

	// echo "Welcome here";
	
	// include 'class/connectDB.php';

	// $sql = "SELECT rtitle FROM movies";
	// $result = $conn->query($sql);

	// if($result->num_rows > 0)
	// {
	// 	while ($row = $result->fetch_assoc()) {
			

	// 		// Load And Create Image From Source
	// 		$our_image = imagecreatefromjpeg('imagescreated/blank.png');

	// 		// Allocate A Color For The Text Enter RGB Value
	// 		$white_color = imagecolorallocate($our_image, 255, 255, 255);

	// 		// Set Path to Font File
	// 		//$font_path = 'arial.ttf'; //'font/larabiefont.TTF';

	// 		// Set the enviroment variable for GD
	// 		//putenv('GDFONTPATH=' . realpath('.'));

	// 		// Name the font to be used (note the lack of the .ttf extension)
	// 		$font_path = 'fonts/glyphicons-halflings-regular.ttf';

	// 		// Set Text to Be Printed On Image
	// 		$text = $row['rtitle'];

	// 		$size=20;
	// 		$angle=0;
	// 		$left=125;
	// 		$top=200;
				
	// 		// Print Text On Image
	// 		imagettftext($our_image, $size,$angle,$left,$top, $white_color, $font_path, $text);

	// 		// Send Image to Browser
	// 		imagejpeg($our_image);

	// 	}
	// }
	// else
	// 	return 0;

		/**
	 * PHP GD
	 * create a simple image with GD library
	 * 
	 */
	//setting the image header in order to proper display the image
	// header("Content-Type: image/png");
	// //try to create an image
	// $im = @imagecreate(182, 195)
	//     or die("Cannot Initialize new GD image stream");
	// //set the background color of the image
	// $background_color = imagecolorallocate($im, 0, 0, 0);
	// //set the color for the text
	// $text_color = imagecolorallocate($im, 255, 255, 255);

	// $font_ttf        = dirname(__FILE__) . '\fonts\glyphicons-halflings-regular.ttf';
	// $text = "I'm a pretty picture";
	// $arrText=explode("\n",wordwrap($text,15,"\n"));

	// $y = 50;
	// foreach($arrText as $arr)
	// {
	//   	//add the string to the image
	// 	imagestring($im, 5, 3, $y,  $arr, $text_color);
	//   	$y=$y+15;
	 
	// }

	// // imagestring(image, font, x, y, string, color)

	
	// //outputs the image as png
	// imagepng($im, 'imagescreated/text.png');

	// //frees any memory associated with the image 
	// imagedestroy($im);

	//Set the Content Type
  	header('Content-type: image/jpeg');

   	include 'class/connectDB.php';

	$sql = "SELECT movieid, rtitle FROM movies";
	$result = $conn->query($sql);

	if($result->num_rows > 0)
	{
		while ($row = $result->fetch_assoc()) {

			// Create Image From Existing File
			$jpg_image =  @imagecreate(182, 268) or die("Cannot Initialize new GD image stream"); // imagecreatefromjpeg('imagescreated/blank.png');
			$background_color = imagecolorallocate($jpg_image, 105, 105, 105);

			// Allocate A Color For The Text
			$white = imagecolorallocate($jpg_image, 255, 255, 255);

			// Set Path to Font File
			// $font_path = 'fonts\glyphicons-halflings-regular.ttf';
			$font_path = __DIR__ . '/fonts/VeraSerif-Bold.ttf';

			// Set Text to Be Printed On Image
			$text = $row['rtitle']; // "This is a sunset! and my name is Tunde";
			  
			$arrText=explode("\n",wordwrap($text, 15,"\n"));

			$y = 120;
			foreach($arrText as $arr)
			{
			  	//add the string to the image
				imagettftext($jpg_image, 15, 0, 15, $y, $white, $font_path, $arr);
				$y=$y+25;
				 
			}

			// Print Text On Image
			// imagettftext(image, size, angle, x, y, color, fontfile, text)
			  

			// Send Image to Browser
			imagejpeg($jpg_image, 'imagescreated/'. $row['movieid'] . '.jpg');

			// Clear Memory
			imagedestroy($jpg_image);
		}
	}

	echo "ALL IMAGES CREATED";
?>