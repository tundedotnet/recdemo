<?php if ($rating > 4.5) { // >= 4.5 ?>
	<?php //echo $rating; ?>
<ul class="w3l-ratings">
    <li><i class="fa fa-star" aria-hidden="true"></i></li>
	<li><i class="fa fa-star" aria-hidden="true"></i></li>
	<li><i class="fa fa-star" aria-hidden="true"></i></li>
	<li><i class="fa fa-star" aria-hidden="true"></i></li>
	<li><i class="fa fa-star" aria-hidden="true"></i></li>
	<li>
		<span style="margin-left: 2px; color:#fd8b2d; font-weight: 900"><?php echo round($rating, 2); ?></span><span style="font-weight: lighter; color:#fd8b2d;">/5</span>
	</li>
</ul>
<?php } elseif ($rating <= 4.5 AND $rating >= 4) { // 4 -4.5 ?>
	<ul class="w3l-ratings">
    <li><i class="fa fa-star" aria-hidden="true"></i></li>
	<li><i class="fa fa-star" aria-hidden="true"></i></li>
	<li><i class="fa fa-star" aria-hidden="true"></i></li>
	<li><i class="fa fa-star" aria-hidden="true"></i></li>
	<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
	<li>
		<span style="margin-left: 2px; color:#fd8b2d; font-weight: 900"><?php echo round($rating, 2); ?></span><span style="font-weight: lighter; color:#fd8b2d;">/5</span>
	</li>
</ul>
<?php } elseif ($rating < 4 AND $rating >= 3.5) { // 3.5 -4 ?>
	<ul class="w3l-ratings">
    <li><i class="fa fa-star" aria-hidden="true"></i></li>
	<li><i class="fa fa-star" aria-hidden="true"></i></li>
	<li><i class="fa fa-star" aria-hidden="true"></i></li>
	<li><i class="fa fa-star-half-o" aria-hidden="true"></i></li>
	<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
	<li>
		<span style="margin-left: 2px; color:#fd8b2d; font-weight: 900"><?php echo round($rating, 2); ?></span><span style="font-weight: lighter; color:#fd8b2d;">/5</span>
	</li>
</ul>
<?php } elseif ($rating < 3.5 AND $rating >= 3) { // 3 - 3.5 ?>
	<ul class="w3l-ratings">
    <li><i class="fa fa-star" aria-hidden="true"></i></li>
	<li><i class="fa fa-star" aria-hidden="true"></i></li>
	<li><i class="fa fa-star" aria-hidden="true"></i></li>
	<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
	<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
	<li>
		<span style="margin-left: 2px; color:#fd8b2d; font-weight: 900"><?php echo round($rating, 2); ?></span><span style="font-weight: lighter; color:#fd8b2d;">/5</span>
	</li>
</ul>
<?php } elseif ($rating < 3 AND $rating >= 2.5) { // 2.5 - 3 ?>
	<ul class="w3l-ratings">
    <li><i class="fa fa-star" aria-hidden="true"></i></li>
	<li><i class="fa fa-star" aria-hidden="true"></i></li>
	<li><i class="fa fa-star-half-o" aria-hidden="true"></i></li>
	<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
	<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
	<li>
		<span style="margin-left: 2px; color:#fd8b2d; font-weight: 900"><?php echo round($rating, 2); ?></span><span style="font-weight: lighter; color:#fd8b2d;">/5</span>
	</li>
</ul>
<?php } elseif ($rating < 2.5 AND $rating >= 2) { // 2 - 2.5 ?>
	<ul class="w3l-ratings">
    <li><i class="fa fa-star" aria-hidden="true"></i></li>
	<li><i class="fa fa-star" aria-hidden="true"></i></li>
	<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
	<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
	<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
	<li>
		<span style="margin-left: 2px; color:#fd8b2d; font-weight: 900"><?php echo round($rating, 2); ?></span><span style="font-weight: lighter; color:#fd8b2d;">/5</span>
	</li>
</ul>
<?php } elseif ($rating < 2 AND $rating >= 1.5) { // 1.5 - 2 ?>
	<ul class="w3l-ratings">
    <li><i class="fa fa-star" aria-hidden="true"></i></li>
	<li><i class="fa fa-star-half-o" aria-hidden="true"></i></li>
	<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
	<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
	<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
	<li>
		<span style="margin-left: 2px; color:#fd8b2d; font-weight: 900"><?php echo round($rating, 2); ?></span><span style="font-weight: lighter; color:#fd8b2d;">/5</span>
	</li>
</ul>
<?php } elseif ($rating < 1.5 AND $rating >= 1) { // 1 - 1.5 ?>
	<ul class="w3l-ratings">
    <li><i class="fa fa-star" aria-hidden="true"></i></li>
	<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
	<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
	<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
	<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
	<li>
		<span style="margin-left: 2px; color:#fd8b2d; font-weight: 900"><?php echo round($rating, 2); ?></span><span style="font-weight: lighter; color:#fd8b2d;">/5</span>
	</li>
</ul>
<?php } elseif ($rating < 1 AND $rating >= 0.5) { // 0.5 - 1 ?>
	<ul class="w3l-ratings">
    <li><i class="fa fa-star-half-o" aria-hidden="true"></i></li>
	<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
	<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
	<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
	<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
	<li>
		<span style="margin-left: 2px; color:#fd8b2d; font-weight: 900"><?php echo round($rating, 2); ?></span><span style="font-weight: lighter; color:#fd8b2d;">/5</span>
	</li>
</ul>
<?php } else { // 0 - 0.5 ?>
	<ul class="w3l-ratings">
    <li><i class="fa fa-star-half-o" aria-hidden="true"></i></li>
	<!-- <li><i class="fa fa-star-o" aria-hidden="true"></i></li> -->
	<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
	<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
	<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
	<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
	<li>
		<span style="margin-left: 2px; color:#fd8b2d; font-weight: 900"><?php echo round($rating, 2); ?></span><span style="font-weight: lighter; color:#fd8b2d;">/5</span>
	</li>
</ul>
<?php } ?>


