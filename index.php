<?php 
	session_start(); 
	ini_set('default_charset', 'utf-8');

	require_once ('class/movies.php');
	// include_once('class/imdb.class.php');

	$movies = new Movies();

	$toprecommended = $movies->guest_recommendations();

	if(isset($_SESSION['accesstag']) AND $_SESSION['accesstag'] == 'OK')
		$toprecommended = $movies->get_top_recommended();

	/*print "<pre>";
	print_r($toprecommended);
	print "</pre>";*/

	if(!isset($_SESSION['topviewed']) OR $_SESSION['topviewed'] == 'NA')
		$topviewed = $movies->get_top_viewed();

	if(!isset($_SESSION['toprated']) OR $_SESSION['toprated'] == 'NA')
		$toprated = $movies->get_top_rated();

	if(!isset($_SESSION['toprecent']) OR $_SESSION['toprecent'] == 'NA')
		$toprecent = $movies->get_top_recent();

	// LOAD ALL THE MOVIE IMAGES
	$files = array_diff(scandir('imdb_scaled_images/'), array('.', '..'));

	$_SESSION['cur_page'] = 'index';
?>

<!--
author: W3layouts
author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta http-equiv="Content-Type" content="text/html" charset=utf-8" />
		<?php header('Content-type: text/html; charset=utf-8'); ?>
		<style type="text/css">
			.blank {
				width:175px; height:258px; background-image: url('images/blank.png'); background-repeat: no-repeat; background-size: cover; color: #FFF; text-align: center; padding:50% 5px 0 5px; font-size: 22px;
		</style>
		<title> ONE MOVIES | Home </title>
		<link rel="shortcut icon" type="image/png" href="imagescreated/favicon.png">
		<!-- for-mobile-apps -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="One Movies Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
		Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
				function hideURLbar(){ window.scrollTo(0,1); } </script>
		<!-- //for-mobile-apps -->
		<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
		<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
		<link rel="stylesheet" href="css/contactstyle.css" type="text/css" media="all" />
		<link rel="stylesheet" href="css/faqstyle.css" type="text/css" media="all" />
		<link href="css/single.css" rel='stylesheet' type='text/css' />
		<link href="css/medile.css" rel='stylesheet' type='text/css' />
		<!-- banner-slider -->
		<link href="css/jquery.slidey.min.css" rel="stylesheet">
		<!-- //banner-slider -->
		<!-- pop-up -->
		<link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
		<!-- //pop-up -->
		<!-- font-awesome icons -->
		<link rel="stylesheet" href="css/font-awesome.min.css" />
		<!-- //font-awesome icons -->
		<!-- js -->
		<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
		<!-- //js -->
		<!-- banner-bottom-plugin -->
		<link href="css/owl.carousel.css" rel="stylesheet" type="text/css" media="all">
		<script src="js/owl.carousel.js"></script>
		<script>
			$(document).ready(function() { 
				$("#owl-demo").owlCarousel({
			 
				  autoPlay: 3000, //Set AutoPlay to 3 seconds
			 
				  items : 5,
				  itemsDesktop : [640,4],
				  itemsDesktopSmall : [414,3]
			 
				});
			 
			}); 
		</script> 
		<!-- //banner-bottom-plugin -->
		<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700italic,700,400italic,300italic,300' rel='stylesheet' type='text/css'>
		<!-- start-smoth-scrolling -->
		<script type="text/javascript" src="js/move-top.js"></script>
		<script type="text/javascript" src="js/easing.js"></script>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
				});
			});
		</script>
		<!-- start-smoth-scrolling -->
	</head>
	
	<body>
		<?php 
			// DEBUG CODES
			if(isset($_GET['debug']) AND $_GET['debug']==1)
			{
				echo "<br/>";
				print("<pre>");

				echo "Type of visitor: ";
				if(isset($_SESSION['accesstag']) AND $_SESSION['accesstag'] == 'OK') echo "Registered user"; else echo "Guest";
				echo "<br/>";

				if(isset($_SESSION['accesstag']) AND $_SESSION['accesstag'] == 'OK') echo "User ID: " . $_SESSION['userid']; else echo "Guest ID: " . $_SESSION['guestid'];
				echo "<br/>";

				echo "SQL: <br/>";
				$sql = "Recommended - SELECT movieid, rtitle, yearreleased, genres FROM movies WHERE movieid IN (comma_separated_moviesIDs_from_API') <br/>";
				$sql .= "Top_viewed - SELECT ratings.movieid AS movieid, rtitle, yearreleased, COUNT(rating) AS rcount, AVG(rating) AS average FROM ratings INNER JOIN movies ON ratings.movieid=movies.movieid GROUP BY movieid ORDER BY rcount DESC, average DESC, yearreleased DESC, title ASC LIMIT 12 <br/>";
				$sql .= "Top_rated - SELECT ratings.movieid AS movieid, rtitle, yearreleased, COUNT(rating) AS rcount, AVG(rating) as average FROM ratings INNER JOIN movies ON ratings.movieid=movies.movieid GROUP BY movieid ORDER BY average DESC, rcount DESC, yearreleased DESC, title ASC LIMIT 12 <br/>";
				$sql .= "Top_Recent - SELECT ratings.movieid AS movieid, rtitle, yearreleased, COUNT(rating) AS rcount, AVG(rating) as average FROM ratings INNER JOIN movies ON ratings.movieid=movies.movieid GROUP BY movieid ORDER BY yearreleased DESC, average DESC, rcount DESC, title ASC LIMIT 12";

				echo "$sql <br/>";

				print("</pre>");
			}
		?>
		<!-- header -->
		<?php include 'global/header_dependencies.php'; ?>
		<!-- //header -->
		<!-- bootstrap-pop-up -->

		<?php include 'global/login_pop_dependencies.php'; ?>

		<script>
			$('.toggle').click(function(){
			  // Switches the Icon
			  $(this).children('i').toggleClass('fa-pencil');
			  // Switches the forms  
			  $('.form').animate({
				height: "toggle",
				'padding-top': 'toggle',
				'padding-bottom': 'toggle',
				opacity: "toggle"
			  }, "slow");
			});
		</script>
		<!-- //bootstrap-pop-up -->
		<!-- nav -->
		<?php include 'global/menu_dependencies.php'; ?>
		<!-- //nav -->
		<!-- banner -->
		<div id="slidey" style="display:none;">
			<ul>
				<li><img src="images/5.jpg" alt=" "><p class='title'>Tarzan</p><p class='description'> Tarzan, having acclimated to life in London, is called back to his former home in the jungle to investigate the activities at a mining encampment.</p></li>
				<li><img src="images/2.jpg" alt=" "><p class='title'>Maximum Ride</p><p class='description'>Six children, genetically cross-bred with avian DNA, take flight around the country to discover their origins. Along the way, their mysterious past is ...</p></li>
				<li><img src="images/3.jpg" alt=" "><p class='title'>Independence</p><p class='description'>The fate of humanity hangs in the balance as the U.S. President and citizens decide if these aliens are to be trusted ...or feared.</p></li>
				<li><img src="images/4.jpg" alt=" "><p class='title'>Central Intelligence</p><p class='description'>Bullied as a teen for being overweight, Bob Stone (Dwayne Johnson) shows up to his high school reunion looking fit and muscular. Claiming to be on a top-secret ...</p></li>
				<li><img src="images/6.jpg" alt=" "><p class='title'>Ice Age</p><p class='description'>In the film's epilogue, Scrat keeps struggling to control the alien ship until it crashes on Mars, destroying all life on the planet.</p></li>
				<li><img src="images/7.jpg" alt=" "><p class='title'>X - Man</p><p class='description'>In 1977, paranormal investigators Ed (Patrick Wilson) and Lorraine Warren come out of a self-imposed sabbatical to travel to Enfield, a borough in north ...</p></li>
			</ul>   	
	    </div>
	    <script src="js/jquery.slidey.js"></script>
	    <script src="js/jquery.dotdotdot.min.js"></script>
	   	<script type="text/javascript">
			$("#slidey").slidey({
				interval: 8000,
				listCount: 5,
				autoplay: false,
				showList: true
			});
			$(".slidey-list-description").dotdotdot();
		</script>
		<!-- //banner -->

		<div class="general_social_icons">
			<nav class="social">
				<ul>
					<li class="w3_twitter"><a href="#">Twitter <i class="fa fa-twitter"></i></a></li>
					<li class="w3_facebook"><a href="#">Facebook <i class="fa fa-facebook"></i></a></li>
					<li class="w3_dribbble"><a href="#">Dribbble <i class="fa fa-dribbble"></i></a></li>
					<li class="w3_g_plus"><a href="#">Google+ <i class="fa fa-google-plus"></i></a></li>				  
				</ul>
		  </nav>
		</div>
		<!-- general -->
		<div class="general">

			<h4 class="latest-text w3_latest_text">Recommended Movies</h4>

			<div class="container">
				<div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
					<ul id="myTab" class="nav nav-tabs" role="tablist">
						
						<?php // if (isset($_SESSION['accesstag']) AND $_SESSION['accesstag'] == 'OK') { ?>
						<li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Recommendations</a></li>
						<?php // } ?>

						<li role="presentation"><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Top viewed</a></li>
						<li role="presentation"><a href="#rating" id="rating-tab" role="tab" data-toggle="tab" aria-controls="rating" aria-expanded="true">Top Rated</a></li>
						<li role="presentation"><a href="#imdb" role="tab" id="imdb-tab" data-toggle="tab" aria-controls="imdb" aria-expanded="false">Recently Added</a></li>
					</ul>
					<div id="myTabContent" class="tab-content">
						
						<div role="tabpanel" class="tab-pane fade active in" id="home" aria-labelledby="home-tab">
							<div class="w3_agile_featured_movies">

								<?php
									$i = 1; # for selecting image for cover
									/*print "<pre>";
									print_r($toprecommended);
									print "</pre>";*/
									foreach (array_keys($toprecommended) as $key) {
										//$_SESSION['key'] = $key;
										$movie = $toprecommended[$key];
										$rating = $movie[4];

										if ($rating == 0 OR $rating =="") 
											$rating = 3;
										
										$needle = "imdb_scaled_images/" . $key . "_imdb.png";
										// $imgfile = in_array($needle, $files)?$needle:'noimage_imdb.png';
										$imgfile = file_exists($needle) ? $needle : "imagescreated/$key.png";
								?>

								<div class="col-md-2 w3l-movie-gride-agile">
									<?php $url = "single.php?ref=" . $key; ?>
									<a href="<?php echo $url; ?>" class="hvr-shutter-out-horizontal">
										<!-- width:175px; height:258px; -->
										<img style="" src="<?php echo $imgfile; ?>" title="<?php echo $movie[0]; ?>" class="img-responsive" alt=" " />
									</a>
									<div class="mid-1 agileits_w3layouts_mid_1_home">
										<div class="w3l-movie-text" style="min-height: 37px;">
											<!-- <h6><a href="<?php // echo $url; ?>"><?php // echo mb_strimwidth($movie[0], 0, 20, ' ...'); ?></a></h6>	 -->
											<h6><a href="<?php echo $url; ?>"><?php echo $movie[0]; ?></a></h6>	
										</div>
										<!-- <div class="mid-2 agile_mid_2_home"> -->
										<div class="mid-2">
											<p><?php echo $movie[1]; ?></p>
											
											<div class="block-stars">

												<?php include('rating.php'); ?>
												<?php // include('global/stars.php') ?>

											</div>
											<div class="clearfix"></div>
										</div>
									</div>
									<!-- <div class="ribben">
										<p>NEW</p>
									</div> -->
								</div>
								<?php $i++; } ?>
								<div class="clearfix"> </div>
							</div>
						</div>

						<div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
							<?php
								if(isset($_SESSION['topviewed']) AND $_SESSION['topviewed'] != 'NA') {
									$topviewed = $_SESSION['topviewed'];
									$i = 1; # for selecting image for cover
									foreach ($topviewed as $movie) {
										$key = $movie['movieid'];
										$rating = $movie['average'];

										if ($rating == 0 OR $rating =="") 
											$rating = 3;

										/*$needle = $key . "_imdb.png";
										$imgfile = in_array($needle, $files)?$needle:'noimage_imdb.png';*/

										$needle = "imdb_scaled_images/" . $key . "_imdb.png";
										$imgfile = file_exists($needle) ? $needle : "imagescreated/$key.png";
							?>
							<div class="col-md-2 w3l-movie-gride-agile">
								<?php $url = "single.php?ref=" . $movie['movieid']; ?>
								<a href="<?php echo $url; ?>" class="hvr-shutter-out-horizontal">
									<!-- width:175px; height:258px; -->
									<img style="" src="<?php echo $imgfile; ?>" title="<?php echo $movie['rtitle']; ?>" class="img-responsive" alt=" " />
									<!-- <div class="blank"> <?php // echo $movie['rtitle'] ?> </div> -->
									<!-- <div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div> -->
								</a>
								<div class="mid-1 agileits_w3layouts_mid_1_home">
									<div class="w3l-movie-text"  style="min-height: 37px;">
										<h6><a href="<?php echo $url; ?>"><?php echo $movie['rtitle']; ?></a></h6>							
									</div>
									<div class="mid-2"> <!-- agile_mid_2_home -->
										<p><?php echo $movie['yearreleased']; ?></p>
										<!-- <div style="float:right; margin-top: 3px; margin-left: 5px; color:#fd8b2d; font-size: 14px">
											<span style="font-weight: 900"><?php // echo round($rating, 2); ?></span><span style="font-weight: lighter;">/5</span>
										</div> -->
										
										<div class="block-stars">

											<?php include('rating.php') ?>
											<?php // include('global/stars.php') ?>

										</div>
										<div class="clearfix"></div>
									</div>
								</div>
								<!-- <div class="ribben">
									<p>NEW</p>
								</div> -->
							</div>

							<?php $i++; } } ?>

							<div class="clearfix"> </div>
						</div>

						<div role="tabpanel" class="tab-pane fade" id="rating" aria-labelledby="rating-tab">
							<?php
								if(isset($_SESSION['toprated']) AND $_SESSION['toprated'] != 'NA') {
									$toprated = $_SESSION['toprated'];
									$i = 1; # for selecting image for cover
									foreach ($toprated as $movie) {
										$key = $movie['movieid'];
										$rating = $movie['average'];

										if ($rating == 0 OR $rating =="") 
											$rating = 3;

										/*$needle = $key . "_imdb.png";
										$imgfile = in_array($needle, $files)?$needle:'noimage_imdb.png';*/

										$needle = "imdb_scaled_images/" . $key . "_imdb.png";
										$imgfile = file_exists($needle) ? $needle : "imagescreated/$key.png";
							?>
							<div class="col-md-2 w3l-movie-gride-agile">
								<?php $url = "single.php?ref=" . $movie['movieid']; ?>
								<a href="<?php echo $url; ?>" class="hvr-shutter-out-horizontal">
									<!-- width:175px; height:258px; -->
									<img style="" src="<?php echo $imgfile; ?>" title="<?php echo $movie['rtitle']; ?>" class="img-responsive" alt=" " />
									<!-- <div class="blank"> <?php // echo $movie['rtitle'] ?> </div> -->
									<!-- <div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div> -->
								</a>
								<div class="mid-1 agileits_w3layouts_mid_1_home">
									<div class="w3l-movie-text"  style="min-height: 37px;">
										<h6><a href="<?php echo $url; ?>"><?php echo $movie['rtitle']; ?></a></h6>							
									</div>
									<div class="mid-2">
										<p><?php echo $movie['yearreleased']; ?></p>
										<!-- <div style="float:right; margin-top: 3px; margin-left: 5px; color:#fd8b2d; font-size: 14px">
											<span style="font-weight: 900"><?php // echo round($rating, 2); ?></span><span style="font-weight: lighter;">/5</span>
										</div> -->
										
										<div class="block-stars">

											<?php include('rating.php') ?>
											<?php // include('global/stars.php') ?>

										</div>
										<div class="clearfix"></div>
									</div>
								</div>
								<!-- <div class="ribben">
									<p>NEW</p>
								</div> -->
							</div>

							<?php $i++; } } ?>
							<div class="clearfix"> </div>
						</div>

						<div role="tabpanel" class="tab-pane fade" id="imdb" aria-labelledby="imdb-tab">

							<?php
								if(isset($_SESSION['toprecent']) AND $_SESSION['toprecent'] != 'NA') {
									$toprecent = $_SESSION['toprecent'];
									$i = 1; # for selecting image for cover
									foreach ($toprecent as $movie) {
										$key = $movie['movieid'];
										$rating = $movie['average'];

										if ($rating == 0 OR $rating =="") 
											$rating = 3;

										/*$needle = $key . "_imdb.png";
										$imgfile = in_array($needle, $files)?$needle:'noimage_imdb.png';*/

										$needle = "imdb_scaled_images/" . $key . "_imdb.png";
										$imgfile = file_exists($needle) ? $needle : "imagescreated/$key.png";
							?>
							<div class="col-md-2 w3l-movie-gride-agile">
								<?php $url = "single.php?ref=" . $movie['movieid']; ?>
								<a href="<?php echo $url; ?>" class="hvr-shutter-out-horizontal">
									<!-- width:175px; height:258px; -->
									<img style="" src="<?php echo $imgfile; ?>" title="<?php echo $movie['rtitle']; ?>" class="img-responsive" alt=" " />
									<!-- <div class="blank"> <?php //echo $movie['rtitle'] ?> </div> -->
									<!-- <div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div> -->
								</a>
								<div class="mid-1 agileits_w3layouts_mid_1_home">
									<div class="w3l-movie-text"  style="min-height: 37px;">
										
										<h6><a href="<?php echo $url; ?>"><?php echo $movie['rtitle']; ?></a></h6>							
									</div>
									<div class="mid-2">
										<p><?php echo $movie['yearreleased']; ?></p>
										<!-- <div style="float:right; margin-top: 3px; margin-left: 5px; color:#fd8b2d; font-size: 14px">
											<span style="font-weight: 900"><?php // echo round($rating, 2); ?></span><span style="font-weight: lighter;">/5</span>
										</div> -->
										
										<div class="block-stars">

											<?php include('rating.php') ?>
											<?php // include('global/stars.php') ?>

										</div>
										<div class="clearfix"></div>
									</div>
								</div>
								<!-- <div class="ribben">
									<p>NEW</p>
								</div> -->
							</div>
							
							<?php $i++; } } ?>
							<div class="clearfix"> </div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- //general -->
		<!-- Latest-tv-series -->
		
		<!-- pop-up-box -->  
		<script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
		<!--//pop-up-box -->
		<!-- <div id="small-dialog" class="mfp-hide">
			<iframe src="https://player.vimeo.com/video/164819130?title=0&byline=0"></iframe>
		</div>
		<div id="small-dialog1" class="mfp-hide">
			<iframe src="https://player.vimeo.com/video/148284736"></iframe>
		</div>
		<div id="small-dialog2" class="mfp-hide">
			<iframe src="https://player.vimeo.com/video/165197924?color=ffffff&title=0&byline=0&portrait=0"></iframe>
		</div> -->
		<script>
			$(document).ready(function() {
			$('.w3_play_icon,.w3_play_icon1,.w3_play_icon2').magnificPopup({
				type: 'inline',
				fixedContentPos: false,
				fixedBgPos: true,
				overflowY: 'auto',
				closeBtnInside: true,
				preloader: false,
				midClick: true,
				removalDelay: 300,
				mainClass: 'my-mfp-zoom-in'
			});
																			
			});
		</script>
		<!-- //Latest-tv-series -->
		<!-- footer -->
		<?php include 'global/footer_dependencies.php'; ?>
		<!-- //footer -->
		<!-- Bootstrap Core JavaScript -->
		<script src="js/bootstrap.min.js"></script>
		<script>
			$(document).ready(function(){
			    $(".dropdown").hover(            
			        function() {
			            $('.dropdown-menu', this).stop( true, true ).slideDown("fast");
			            $(this).toggleClass('open');
			        },
			        function() {
			            $('.dropdown-menu', this).stop( true, true ).slideUp("fast");
			            $(this).toggleClass('open');   
			        }
			    );

			    // $('li#index').addClass('active')
			    // $('li#genres').removeClass('active')
			    // $('li#list').removeClass('active')
			});
		</script>
		<!-- //Bootstrap Core JavaScript -->
		<!-- here stars scrolling icon -->
		<script type="text/javascript">
			$(document).ready(function() {
				/*
					var defaults = {
					containerID: 'toTop', // fading element id
					containerHoverID: 'toTopHover', // fading element hover id
					scrollSpeed: 1200,
					easingType: 'linear' 
					};
				*/
									
				$().UItoTop({ easingType: 'easeOutQuart' });
									
				});
		</script>
		<!-- //here ends scrolling icon -->
	</body>
</html>