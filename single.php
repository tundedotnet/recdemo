<?php
	session_start();

	// LOAD ALL THE MOVIE IMAGES
	$files = array_diff(scandir('imdb_scaled_images/'), array('.', '..'));

	require_once ('class/movies.php');
	require_once ('class/clickstreamapi.php');

	if(isset($_SESSION['accesstag']) AND $_SESSION['accesstag'] == 'OK')
	{
		// echo "LOGGED IN";
		$click = new ClickStreamAPI('session', $_SESSION['userid']);
		$userid = $_SESSION['userid'];
	}
	else
	{
		// echo "NOT LOGGED IN";
		$click = new ClickStreamAPI('session');
		$userid = $click->get_id();
	}

	$click->log("browse", $_GET["ref"]);


	$movies = new Movies();
	$key = $_GET['ref'];
	
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
	<style type="text/css">
		.blank {
			width:101px; height:148px; background-image: url('images/blanknext.png'); background-repeat: no-repeat; background-size: cover; color: #FFF; text-align: center; padding:40% 5px 0 5px; font-size: 18px;
		}
		.detail {
			width:754px; height:286px; background-image: url('images/blankdetail.png'); background-repeat: no-repeat; background-size: cover; color: #FFF; text-align: center; padding:10% 5px 0 5px; font-size: 50px;
		}
	</style>
	<title> ONE MOVIES | Movies Details</title>
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
<link href="css/medile.css" rel='stylesheet' type='text/css' />
<link href="css/single.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/contactstyle.css" type="text/css" media="all" />
<link rel="stylesheet" href="css/faqstyle.css" type="text/css" media="all" />
<!-- news-css -->
<link rel="stylesheet" href="news-css/news.css" type="text/css" media="all" />
<!-- //news-css -->
<!-- list-css -->
<link rel="stylesheet" href="list-css/list.css" type="text/css" media="all" />
<!-- //list-css -->
<!-- font-awesome icons -->
<link rel="stylesheet" href="css/font-awesome.min.css" />
<!-- //font-awesome icons -->
<!-- js -->
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<!-- //js -->
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
<link href="css/owl.carousel.css" rel="stylesheet" type="text/css" media="all">
<script src="js/owl.carousel.js"></script>
<script>
	$(document).ready(function() { 
		$("#owl-demo").owlCarousel({
	 
		  autoPlay: 3000, //Set AutoPlay to 3 seconds
	 
		  items : 5,
		  itemsDesktop : [640,5],
		  itemsDesktopSmall : [414,4]
	 
		});
	 
	}); 
</script> 
<script src="js/simplePlayer.js"></script>
<script>
	$("document").ready(function() {
		$("#video").simplePlayer();
	});
</script>

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
			$sql = "SELECT movies.movieid as movieid, rtitle, yearreleased, genres, AVG(ratings.rating) as rating, description, director, country, language FROM movies JOIN ratings ON movies.movieid=ratings.movieid JOIN movies_info ON movies.movieid=movies_info.movieid WHERE movies.movieid = 'movieid'";

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
<!-- single -->
<div class="single-page-agile-main">
	<div class="container">
		<!-- /w3l-medile-movies-grids -->
		<div class="agileits-single-top">
			<ol class="breadcrumb">
			  <li><a href="index.html">Home</a></li>
			  <li class="active">Single</li>
			</ol>
		</div>

		<?php
			$movie = $movies->get_details($key);

			/*$needle = $key . "_imdb.png";
			$imgfile = in_array($needle, $files)?$needle:'noimage_imdb.png';*/

			$needle = "imdb_scaled_images/" . $key . "_imdb.png";
			$imgfile = file_exists($needle) ? $needle : "imagescreated/$key.png";

		?>
		<div class="single-page-agile-info">
			<!-- /movie-browse-agile -->
			<div class="show-top-grids-w3lagile">
				<div class="col-sm-8 single-left">
					<div class="song">
						<div class="song-info">
							<!-- <h3><?php // echo $movie['rtitle'] . ' (' . $movie['yearreleased'] . ')';  ?></h3> -->	
						</div>
						<div class="video-grid-single-page-agileits">
							<!--  -->
							<div style="min-width: 95%;"> 

								<img style="width:40%; height:442px; margin-right: 20px; float: left;" src="<?php echo $imgfile; ?>" alt="" /> 

								<div style="width:48%; height:442px; float:left; text-align:justify; font-size:1.2em; position:relative;">

									<h3 style="color: #974908;"><?php echo $movie['rtitle'];  ?></h3> <br/>

									<p style="margin-bottom: 10px;">
										<span style="font-weight: bold;"> Genres: </span>
										<?php echo str_replace('|', ' | ', $movie['genres']); ?>
									</p>

									<p style="margin-bottom: 10px;">
										<!-- <span style="font-weight: bold;">Average Rating: </span> -->
										<?php
											if ($movie['rating'] == 0 OR $movie['rating'] =="") 
												$rating = 3;
											else $rating = $movie['rating'];
										?>
										<?php include('rating.php'); ?>
										<!-- <?php // echo round($movie['rating'], 2); ?> -->
									</p>

									<p style="margin-bottom: 10px; padding-top:10px;">
										<?php if ($movie['description'] != 'n/A') echo $movie['description']; ?>
									</p>

									
									<br/>
									
									<p style="margin-bottom: 10px;">
										<span style="font-weight: bold;">Director: </span>
										<?php if ($movie['director']!='' AND $movie['director']!='n/A') echo $movie['director']; else echo 'N/A'; ?>
									</p>

									<p style="margin-bottom: 10px;">
										<span style="font-weight: bold;">Country: </span>
										<?php if ($movie['country']!='' AND $movie['country']!='n/A') echo $movie['country']; else echo 'N/A'; ?>
									</p>

									<p style="margin-bottom: 10px;">
										<span style="font-weight: bold;">Language: </span>
										<?php if ($movie['language']!='' AND $movie['language']!='n/A') echo $movie['language']; else echo 'N/A'; ?>
									</p>

									<p style="margin-bottom: 10px;">
										<span style="font-weight: bold;">Year of Released: </span>
										<?php if ($movie['yearreleased']!='' AND $movie['yearreleased']!='n/A') echo $movie['yearreleased']; else echo 'N/A'; ?>
									</p>

									<br/>

								</div>

								<div class="clearfix"></div>

								<?php if (isset($_SESSION['accesstag']) AND $_SESSION['accesstag'] == 'OK') { ?>
									<div style="width:100%; font-weight: bold; margin-top:5px; padding: 5px; background-color: #f5f5f5; text-align:right; bottom:0; position:relative; ">
										<!-- <p style="font-weight: bold; float: left">RATE THIS MOVIE: &nbsp &nbsp </p>

										<p style="font-weight: bold; float: left">
											<ul style="margin-top: -2px; " class="w3l-ratings"> -->

										<?php if (isset($_SESSION['last_rating']) AND $_SESSION['last_rating'] != 'NA') { $rating = $_SESSION['last_rating']; ?>

										YOUR RATING: &nbsp
										<div style="font-weight: bold; float: right;">
											<?php include('single_rating.php'); ?>
										</div>

										<?php } else { ?>
										
										RATE THIS MOVIE: &nbsp
										<div style="font-weight: bold; float: right;">

											<ul style="margin-top: -2px;" class="w3l-ratings">

												<li>
													<a class="star" data-value="<?php echo $key; ?>" href="#">
														<i id="<?php echo $key; ?>" class="fa fa-star-o" data-value='1' aria-hidden="true"></i>
													</a>
												</li>
												<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star-o" data-value='2' aria-hidden="true"></i></a></li>
												<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star-o" data-value='3' aria-hidden="true"></i></a></li>
												<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star-o" data-value='4' aria-hidden="true"></i></a></li>
												<li><a class="star" data-value="<?php echo $key; ?>" href="#"><i id="<?php echo $key; ?>" class="fa fa-star-o" data-value='5' aria-hidden="true"></i></a></li>

											</ul>
										</div>

										<?php } ?>

									</div>
									<?php } ?>

							</div>

							<div class="clearfix"></div>
						</div> 


						
						
					</div>

					<script>
						$(document).ready(function () {

					        $('a.star i').on('click', function (e) {

					        	var me = $(this);
					        	e.preventDefault();

					        	if ( me.data('requestRunning') ) {
							        return;
							    }

							    me.data('requestRunning', true);

					        	var onStarID = e.target.id; // The star ID (i.e., movieid) currently selected
					    		// alert(onStarID); return;

					        	var onStar = parseInt($(this).data('value'), 10); // The star score currently selected
					    		// alert(onStar);  return;

					    		// var stars =  $('a.star li').parent().children('li.star');
					    		// console.log($(this).parent().parent().parent().children());
					    		var stars = $(this).parent().parent().parent().children();
					    		// alert(stars.length);  return;
					    
							    for (i = 0; i < stars.length; i++) {
							      $(stars[i]).children().children().removeClass('fa-star').addClass('fa-star-o');
							    }

							    for (i = 0; i < onStar; i++) {
							      $(stars[i]).children().children().removeClass('fa-star-o').addClass('fa-star');
							    }

					        	//grab all query data
								var queryData = 'ref=' + onStarID + '&star=' + onStar;
								// console.log(queryData);  return;

								$.ajax({

									type: 'POST',
						            url: 'rate.php',
						            data: queryData,
								    
								    success: function(response){
						            	console.log(response);
						            	if (response == 1){			
							                // window.location.href = "";
							                // DO NOTHING
							            }
						            },
						            complete: function() {
							            me.data('requestRunning', false);
							        }

								});
					        	
					        });

					        // THIS FIX THE PROBLEM OF EXECUTING THE CLICK ACTION OF $('a#star') ELEMENT MULTIPLE TIMES
					  //       $(element).off().on('click', function() {
							//     // function body
							// });
						});

						

						function queryConvert(queryStr){

					      queryArr = queryStr.replace('?','').split('&'),
					      queryParams = [];

					    for (var q = 0, qArrLength = queryArr.length; q < qArrLength; q++) {
					        var qArr = queryArr[q].split('=');
					        queryParams[qArr[0]] = qArr[1];
					    }

					    return queryParams;
					}

					</script>
				
					
					<div class="song-grid-right">
						<div class="share">
							<h5>Share this</h5>
							<div class="single-agile-shar-buttons">
								<ul>
									<li>
										<div class="fb-like" data-href="https://www.facebook.com/w3layouts" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="false"></div>
										<script>(function(d, s, id) {
										  var js, fjs = d.getElementsByTagName(s)[0];
										  if (d.getElementById(id)) return;
										  js = d.createElement(s); js.id = id;
										  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.7";
										  fjs.parentNode.insertBefore(js, fjs);
										}(document, 'script', 'facebook-jssdk'));</script>
									</li>
									<li>
										<div class="fb-share-button" data-href="https://www.facebook.com/w3layouts" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fwww.facebook.com%2Fw3layouts&amp;src=sdkpreparse">Share</a></div>
									</li>
									<li class="news-twitter">
										<a href="https://twitter.com/w3layouts" class="twitter-follow-button" data-show-count="false">Follow @w3layouts</a><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
									</li>
									<li>
										<a href="https://twitter.com/intent/tweet?screen_name=w3layouts" class="twitter-mention-button" data-show-count="false">Tweet to @w3layouts</a><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
									</li>
									<li>
										<!-- Place this tag where you want the +1 button to render. -->
										<div class="g-plusone" data-size="medium"></div>

										<!-- Place this tag after the last +1 button tag. -->
										<script type="text/javascript">
										  (function() {
											var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
											po.src = 'https://apis.google.com/js/platform.js';
											var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
										  })();
										</script>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="clearfix"> </div>

					<div class="all-comments">
						<div class="all-comments-info">
							<a href="#">Comments</a>
							<div class="agile-info-wthree-box">
								<form>
									<?php if (!isset($_SESSION['accesstag']) OR $_SESSION['accesstag'] != 'OK') { ?>
									<input type="text" placeholder="Name" required="">			           					   
									<input type="text" placeholder="Email" required="">
									<input type="text" placeholder="Phone" required="">
								<?php } ?>
									<textarea placeholder="Message" required=""></textarea>
									<input type="submit" value="SEND">
									<div class="clearfix"> </div>
								</form>
							</div>
						</div>
						<div class="media-grids">
							<div class="media">
								<h5>TOM BROWN</h5>
								<div class="media-left">
									<a href="#">
										<img src="images/user.jpg" title="One movies" alt=" " />
									</a>
								</div>
								<div class="media-body">
									<p>Maecenas ultricies rhoncus tincidunt maecenas imperdiet ipsum id ex pretium hendrerit maecenas imperdiet ipsum id ex pretium hendrerit</p>
									<span>View all posts by :<a href="#"> Admin </a></span>
								</div>
							</div>
							<div class="media">
								<h5>MARK JOHNSON</h5>
								<div class="media-left">
									<a href="#">
									<img src="images/user.jpg" title="One movies" alt=" " />
									</a>
								</div>
								<div class="media-body">
									<p>Maecenas ultricies rhoncus tincidunt maecenas imperdiet ipsum id ex pretium hendrerit maecenas imperdiet ipsum id ex pretium hendrerit</p>
									<span>View all posts by :<a href="#"> Admin </a></span>
								</div>
							</div>
							<div class="media">
								<h5>STEVEN SMITH</h5>
								<div class="media-left">
									<a href="#">
									<img src="images/user.jpg" title="One movies" alt=" " />
									</a>
								</div>
								<div class="media-body">
									<p>Maecenas ultricies rhoncus tincidunt maecenas imperdiet ipsum id ex pretium hendrerit maecenas imperdiet ipsum id ex pretium hendrerit</p>
									<span>View all posts by :<a href="#"> Admin </a></span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 single-right">
					<h3>Related Movie Recommendations</h3>
					<div class="single-grid-right">

						<?php
							$toprecommended = $movies->get_related_recommendations($_GET['ref'], $userid);

							$i = 1; # for selecting image for cover
							if(is_array($toprecommended)) {
								foreach (array_keys($toprecommended) as $key) {
									$movie = $toprecommended[$key];

									if ($key != $_GET['ref']) {

									/*$needle = $key . "_imdb.png";
									$imgfile = in_array($needle, $files)?$needle:'noimage_imdb.png';*/

									$needle = "imdb_scaled_images/" . $key . "_imdb.png";
									// $imgfile = in_array($needle, $files)?$needle:'noimage_imdb.png';
									$imgfile = file_exists($needle) ? $needle : "imagescreated/$key.png";

									$rating = $movie[4];
									if ($rating == 0 OR $rating =="") 
											$rating = 3;
						?>
						<div class="single-right-grids">
							<div class="col-md-4 single-right-grid-left">
								<!-- width:101px; height:148px; -->
								<a href="single.php?ref=<?php echo $key; ?>"><img style="" src="<?php echo $imgfile; ?>" alt="" /></a>
							</div>
							<div class="col-md-8 single-right-grid-right">
								<a href="single.php?ref=<?php echo $key; ?>" class="title"><?php echo $movie[0]; ?></a>
								<p class="author"><a href="#" class="author"><?php echo $movie[1]; ?></a></p>
								<p class="views"><?php echo str_replace("|", " | ", $movie[3]); ?></p>
								<p class="author"><a href="#" class="author">
									<?php if ($movie[5] > 1) echo $movie[5] . ' users'; else echo '1 user'; ?> rated this movie</a>
								</p>
								<p class="author"><a href="#" class="author"><?php include('rating.php'); ?></a></p>
							</div>
							<div class="clearfix"> </div>
						</div>

						<?php } } } ?>

					</div>
				</div>
						
				<div class="clearfix"> </div>
			</div>
			<!-- //movie-browse-agile -->				 
		</div>
				<!-- //w3l-latest-movies-grids -->
	</div>	
</div>
	<!-- //w3l-medile-movies-grids -->
	
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