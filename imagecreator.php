<!-- <div class="blank"> <?php //echo $movie[0] ?> </div> -->

<?php
$output = "images/created.jpg";

$image = imagecreate(182, 195) or die("Cannot Initialize new GD image stream");
$background = imagecolorallocate($image, 0, 0, 0);
$foreground = imagecolorallocate($image, 255, 255, 255);

imagejpeg($image);



// // Load And Create Image From Source
// $our_image = imagecreatefromjpeg('images/blank.png');

// // Allocate A Color For The Text Enter RGB Value
// $white_color = @imagecolorallocate($our_image, 255, 255, 255);

// // Set Path to Font File
// //$font_path = 'arial.ttf'; //'font/larabiefont.TTF';

// // Set the enviroment variable for GD
// // putenv('GDFONTPATH=' . realpath('.'));

// // Name the font to be used (note the lack of the .ttf extension)
// $font_path = 'DIGITALDREAM.ttf';

// // Set Text to Be Printed On Image
// $text = $movie[0];

// $size=20;
// $angle=0;
// $left=125;
// $top=200;
	
// // Print Text On Image
// imagettftext($our_image, $size,$angle,$left,$top, $white_color, $font_path, $text);

// Send Image to Browser
//imagejpeg($our_image);
?>