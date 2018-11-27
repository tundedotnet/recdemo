<?php if ($rating > 4.5) { // >= 4.5 ?>
	<?php //echo $rating; ?>
<ul class="w3l-ratings">
    <li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star" data-value='1' aria-hidden="true"></i></a></li>
	<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star" data-value='2' aria-hidden="true"></i></a></li>
	<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star" data-value='3' aria-hidden="true"></i></a></li>
	<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star" data-value='4' aria-hidden="true"></i></a></li>
	<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star" data-value='5' aria-hidden="true"></i></a></li>
</ul>
<?php } elseif ($rating <= 4.5 AND $rating >= 4) { // 4 -4.5 ?>
	<ul class="w3l-ratings">
    <li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star" data-value='1' aria-hidden="true"></i></a></li>
	<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star" data-value='2' aria-hidden="true"></i></a></li>
	<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star" data-value='3' aria-hidden="true"></i></a></li>
	<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star" data-value='4' aria-hidden="true"></i></a></li>
	<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star-o" data-value='5' aria-hidden="true"></i></a></li>
</ul>
<?php } elseif ($rating < 4 AND $rating >= 3.5) { // 3.5 -4 ?>
	<ul class="w3l-ratings">
    <li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star" data-value='1' aria-hidden="true"></i></a></li>
	<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star" data-value='2' aria-hidden="true"></i></a></li>
	<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star" data-value='3' aria-hidden="true"></i></a></li>
	<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star-half-o" data-value='4' aria-hidden="true"></i></a></li>
	<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star-o" data-value='5' aria-hidden="true"></i></a></li>
</ul>
<?php } elseif ($rating < 3.5 AND $rating >= 3) { // 3 - 3.5 ?>
	<ul class="w3l-ratings">
    <li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star" data-value='1' aria-hidden="true"></i></a></li>
	<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star" data-value='2' aria-hidden="true"></i></a></li>
	<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star" data-value='3' aria-hidden="true"></i></a></li>
	<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star-o" data-value='4' aria-hidden="true"></i></a></li>
	<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star-o" data-value='5' aria-hidden="true"></i></a></li>
</ul>
<?php } elseif ($rating < 3 AND $rating >= 2.5) { // 2.5 - 3 ?>
	<ul class="w3l-ratings">
    <li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star" data-value='1' aria-hidden="true"></i></a></li>
	<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star" data-value='2' aria-hidden="true"></i></a></li>
	<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star-half-o" data-value='3' aria-hidden="true"></i></a></li>
	<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star-o" data-value='4' aria-hidden="true"></i></a></li>
	<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star-o" data-value='5' aria-hidden="true"></i></a></li>
</ul>
<?php } elseif ($rating < 2.5 AND $rating >= 2) { // 2 - 2.5 ?>
	<ul class="w3l-ratings">
    <li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star" data-value='1' aria-hidden="true"></i></a></li>
	<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star" data-value='2' aria-hidden="true"></i></a></li>
	<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star-o" data-value='3' aria-hidden="true"></i></a></li>
	<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star-o" data-value='4' aria-hidden="true"></i></a></li>
	<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star-o" data-value='5' aria-hidden="true"></i></a></li>
</ul>
<?php } elseif ($rating < 2 AND $rating >= 1.5) { // 1.5 - 2 ?>
	<ul class="w3l-ratings">
    <li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star" data-value='1' aria-hidden="true"></i></a></li>
	<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star-half-o" data-value='2' aria-hidden="true"></i></a></li>
	<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star-o" data-value='3' aria-hidden="true"></i></a></li>
	<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star-o" data-value='4' aria-hidden="true"></i></a></li>
	<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star-o" data-value='5' aria-hidden="true"></i></a></li>
</ul>
<?php } elseif ($rating < 1.5 AND $rating >= 1) { // 1 - 1.5 ?>
	<ul class="w3l-ratings">
    <li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star" data-value='1' aria-hidden="true"></i></a></li>
	<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star-o" data-value='2' aria-hidden="true"></i></a></li>
	<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star-o" data-value='3' aria-hidden="true"></i></a></li>
	<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star-o" data-value='4' aria-hidden="true"></i></a></li>
	<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star-o" data-value='5' aria-hidden="true"></i></a></li>
</ul>
<?php } elseif ($rating < 1 AND $rating >= 0.5) { // 0.5 - 1 ?>
	<ul class="w3l-ratings">
    <li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star-half-o" data-value='1' aria-hidden="true"></i></a></li>
	<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star-o" data-value='2' aria-hidden="true"></i></a></li>
	<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star-o" data-value='3' aria-hidden="true"></i></a></li>
	<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star-o" data-value='4' aria-hidden="true"></i></a></li>
	<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star-o" data-value='5' aria-hidden="true"></i></a></li>
</ul>
<?php } else { // 0 - 0.5 ?>
	<ul class="w3l-ratings">
    <li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star-half-o" data-value='1' aria-hidden="true"></i></a></li>
	<!-- <li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star-o" data-value='2' aria-hidden="true"></i></a></li> -->
	<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star-o" data-value='2' aria-hidden="true"></i></a></li>
	<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star-o" data-value='3' aria-hidden="true"></i></a></li>
	<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star-o" data-value='4' aria-hidden="true"></i></a></li>
	<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star-o" data-value='5' aria-hidden="true"></i></a></li>
</ul>
<?php } ?>


