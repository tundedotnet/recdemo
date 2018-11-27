<?php
	if (!isset($_SESSION))
		session_start();

	// LOAD ALL THE MOVIE IMAGES
	$files = array_diff(scandir('imdb_scaled_images/'), array('.', '..'));

	require_once ('./class/movies.php');

	$limit = 24;
	$ref = $_GET['ref'];

	if (isset($_GET["pgn"]) AND $_GET['pgn'] != 0)
		$page  = $_GET["pgn"];
	else
		$page=1;

	$start_from = ($page-1) * $limit;

	$movie = new Movies();
	$result = $movie->get_genre($start_from, $limit);


	if (isset($_SESSION['ref']) AND $_SESSION['ref'] == $_GET['ref'] AND isset($_SESSION['total_records'])) {

		$total_records = $_SESSION['total_records'];
	}
	else
	{
		$total_records = $movie->count_genre();
	}

	$total_pages = ceil($total_records / $limit);

	$_SESSION['cur_page'] = 'genres';

	if (isset($_GET['debug'])) {
		$_SESSION['debug'] = 1;
	}
	else {
		unset($_SESSION['debug']);
	}
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
			width:182px; height:268px; background-image: url('images/blank.png'); background-repeat: no-repeat; background-size: cover; color: #FFF; text-align: center; padding:50% 5px 0 5px; font-size: 22px;
	</style>
	<title> ONE MOVIES | Genre </title>
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
<!-- font-awesome icons -->
<link rel="stylesheet" href="css/font-awesome.min.css" />
<!-- //font-awesome icons -->
<!-- news-css -->
<link rel="stylesheet" href="news-css/news.css" type="text/css" media="all" />
<!-- //news-css -->
<!-- list-css -->
<link rel="stylesheet" href="list-css/list.css" type="text/css" media="all" />
<!-- //list-css -->
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
		/*$("#owl-demo").owlCarousel({
	 
		  autoPlay: 3000, //Set AutoPlay to 3 seconds
	 
		  items : 5,
		  itemsDesktop : [640,5],
		  itemsDesktopSmall : [414,4]
	 
		});*/
	 
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
			$sql = "   SELECT movies.movieid as movieid, rtitle, yearreleased, AVG(rating) AS rating FROM movies JOIN ratings ON movies.movieid=ratings.movieid WHERE genres LIKE '%key%' GROUP BY movieid ORDER BY rating DESC LIMIT 'start_from', 'limit'";

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
<!-- /w3l-medile-movies-grids -->
	<div class="general-agileits-w3l">
		<div class="w3l-medile-movies-grids">

			<!-- /movie-browse-agile -->
			
			<div class="movie-browse-agile">
				     <!--/browse-agile-w3ls -->
				<div class="browse-agile-w3ls general-w3ls">
							<div class="tittle-head">
								<h4 class="latest-text"><?php echo $_GET['ref']; ?> Movies </h4>
								<div class="container">
									<div class="agileits-single-top">
										<ol class="breadcrumb">
										  <li><a href="index.php">Home</a></li>
										  <li class="active">Genres</li>
										</ol>
									</div>
								</div>
							</div>
					<div class="container">
						<input type="hidden" id="ref" value="<?php echo $_GET['ref']; ?>">
						<div class="browse-inner" id="browse-inner">

							<?php
								if(count($result) > 0) {
									foreach ($result as $row) {

										/*$needle = $row['movieid'] . "_imdb.png";
										$imgfile = in_array($needle, $files)?$needle:'noimage_imdb.png';*/

										$key = $row['movieid'];
										$needle = "imdb_scaled_images/" . $key . "_imdb.png";
										$imgfile = file_exists($needle) ? $needle : "imagescreated/$key.png";
							?>

							<div class="col-md-2 w3l-movie-gride-agile">
								<a href="single.php?ref=<?php echo $row['movieid']; ?>" class="hvr-shutter-out-horizontal">
									<!-- width:182px; height:268px; -->
									<img style="" src="<?php echo $imgfile; ?>" title="<?php echo $row['rtitle'] ?>" class="img-responsive" alt=" " />
									<!-- <div class="blank"> <?php // echo $row['rtitle'] ?> </div> -->
							    	<!-- <div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div> -->
								</a>
								<div class="mid-1">
									<div class="w3l-movie-text"  style="min-height: 37px;">
										<h6><a href="single.php?ref=<?php echo $row['movieid']; ?>"><?php echo $row['rtitle']; ?></a></h6>							
									</div>
									<div class="mid-2">
										<p><?php echo $row['yearreleased']; ?></p>
										<div class="block-stars">
											<?php $rating = $row['rating']; 
												if ($rating == 0 OR $rating =="") 
													$rating = 3;
											?>
											<?php include('rating.php'); ?>
										</div>
										<div class="clearfix"></div>
									</div>	
								</div>
						 	    <!-- <div class="ribben two">
									<p>NEW</p>
								</div> -->	
							</div>

							<?php } } ?>

							<div class="clearfix"> </div>
						</div>
					</div>
				</div>
				
				<!-- PAGINATION LINKS -->
		
				<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
			    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js"></script> -->
			    <script src="jquery.twbsPagination.js" type="text/javascript"></script>
				<div class="blog-pagenat-wthree">
					<ul  class="pagination" id="pagination">
						<!-- <li><a class="frist" href="#">Prev</a></li>
						<li><a href="#">1</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">4</a></li>
						<li><a href="#">5</a></li>
						<li><a class="last" href="#">Next</a></li> -->
					</ul>
				</div>
				<!-- <script data-main="scripts/main.js" src="https://requirejs.org/docs/release/2.3.5/minified/require.js"></script> -->
				<script type="text/javascript">

				    $(function () {
				        window.pagObj = $('#pagination').twbsPagination({
				            totalPages: <?php echo $total_pages; ?>,
				            visiblePages: 5,
				            onPageClick: function (event, page) {
				                // console.info(page + ' (from options)');
				            }
				        }).on('page', function (event, page) {
				        	event.preventDefault();

				        	var ref = document.getElementById('ref').value

				        	var queryData = 'ref=' + ref + '&page=' + page;
				        	// alert(queryData);

				        	/*var json_files =  document.getElementById('json_files').value;
				    		console.log(json_files);
				    		console.log(json_files[3]);*/

				        	$.ajax({

								type: 'POST',
					            url: 'get_genre.php',
					            data: queryData,
							    
							    success: function(data){
					            	// alert(data);
					            	if (data != 0){			

					            		response = $.parseJSON(data);

					            		$("div#browse-inner").empty();
						                $.each(response, function (i, item) {

						                	var imgname = item.movieid + "_imdb.png";
						                	var newItem = "<div class='col-md-2 w3l-movie-gride-agile'> <a href='single.php?ref=" + item.movieid + "' class='hvr-shutter-out-horizontal'> <img style='' src='imdb_scaled_images/" + imgname + "' title='" + item.rtitle +"' class='img-responsive' alt=' ' /> </a> <div class='mid-1'> <div class='w3l-movie-text'  style='min-height: 37px;'> <h6><a href='single.php?ref=" + item.movieid + "'>" + item.rtitle + "</a></h6> </div> <div class='mid-2'> <p>" + item.yearreleased + "</p> <div class='block-stars'>" + rate(item.rating) + "</div> <div class='clearfix'></div> </div>	</div> </div>";

						                	// console.log(newItem)

						                	$('div#browse-inner').append(newItem);

						                });
						            }
						            $('html, body').animate({scrollTop: 100}, 800);
						            return false;
					            }

							});

				        });
				    });

				    function rate(score) {
				    	if (score > 4.5) { // >= 4.5 ?>
							return "<ul class='w3l-ratings'> <li><i class='fa fa-star' aria-hidden='true'></i></li> <li><i class='fa fa-star' aria-hidden='true'></i></li> <li><i class='fa fa-star' aria-hidden='true'></i></li> <li><i class='fa fa-star' aria-hidden='true'></i></li> <li><i class='fa fa-star-half-o' aria-hidden='true'></i></li> <li><span style='margin-left: 2px; color:#fd8b2d; font-weight: 900'>" + parseFloat(score).toFixed(2) + "</span><span style='font-weight: lighter; color:#fd8b2d;'>/5</span></li> </ul>";
						}
						else if (score <= 4.5 && score >= 4) { // 4 -4.5 ?>
							return "<ul class='w3l-ratings'> <li><i class='fa fa-star' aria-hidden='true'></i></li> <li><i class='fa fa-star' aria-hidden='true'></i></li> <li><i class='fa fa-star' aria-hidden='true'></i></li> <li><i class='fa fa-star' aria-hidden='true'></i></li> <li><i class='fa fa-star-o' aria-hidden='true'></i></li> <li><span style='margin-left: 2px; color:#fd8b2d; font-weight: 900'>" + parseFloat(score).toFixed(2) + "</span><span style='font-weight: lighter; color:#fd8b2d;'>/5</span></li> </ul>";
						}
						else if (score < 4 && score >= 3.5) { // 3.5 -4 ?>
							return "<ul class='w3l-ratings'> <li><i class='fa fa-star' aria-hidden='true'></i></li> <li><i class='fa fa-star' aria-hidden='true'></i></li> <li><i class='fa fa-star' aria-hidden='true'></i></li> <li><i class='fa fa-star-half-o' aria-hidden='true'></i></li> <li><i class='fa fa-star-o' aria-hidden='true'></i></li> <li><span style='margin-left: 2px; color:#fd8b2d; font-weight: 900'>" + parseFloat(score).toFixed(2) + "</span><span style='font-weight: lighter; color:#fd8b2d;'>/5</span></li> </ul>";
						}
						else if (score < 3.5 && score > 3) { // 3 - 3.5 ?>
							return "<ul class='w3l-ratings'> <li><i class='fa fa-star' aria-hidden='true'></i></li> <li><i class='fa fa-star' aria-hidden='true'></i></li> <li><i class='fa fa-star' aria-hidden='true'></i></li> <li><i class='fa fa-star-o' aria-hidden='true'></i></li> <li><i class='fa fa-star-o' aria-hidden='true'></i></li> <li><span style='margin-left: 2px; color:#fd8b2d; font-weight: 900'>" + parseFloat(score).toFixed(2) + "</span><span style='font-weight: lighter; color:#fd8b2d;'>/5</span></li> </ul>";
						}
						else if (score < 3 && score > 2.5) { // 2.5 - 3 ?>
							return "<ul class='w3l-ratings'> <li><i class='fa fa-star' aria-hidden='true'></i></li> <li><i class='fa fa-star' aria-hidden='true'></i></li> <li><i class='fa fa-star-half-o' aria-hidden='true'></i></li> <li><i class='fa fa-star-o' aria-hidden='true'></i></li> <li><i class='fa fa-star-o' aria-hidden='true'></i></li> <li><span style='margin-left: 2px; color:#fd8b2d; font-weight: 900'>" + parseFloat(score).toFixed(2) + "</span><span style='font-weight: lighter; color:#fd8b2d;'>/5</span></li> </ul>"
						}
						else if (score < 2.5 && score >= 2) { // 2 - 2.5 ?>
							return "<ul class='w3l-ratings'> <li><i class='fa fa-star' aria-hidden='true'></i></li> <li><i class='fa fa-star' aria-hidden='true'></i></li> <li><i class='fa fa-star-o' aria-hidden='true'></i></li> <li><i class='fa fa-star-o' aria-hidden='true'></i></li> <li><i class='fa fa-star-o' aria-hidden='true'></i></li> <li><span style='margin-left: 2px; color:#fd8b2d; font-weight: 900'>" + parseFloat(score).toFixed(2) + "</span><span style='font-weight: lighter; color:#fd8b2d;'>/5</span></li> </ul>";
						}
						else if (score < 2 && score >= 1.5) { // 1.5 - 2 ?>
							return "<ul class='w3l-ratings'> <li><i class='fa fa-star' aria-hidden='true'></i></li> <li><i class='fa fa-star-half-o' aria-hidden='true'></i></li> <li><i class='fa fa-star-o' aria-hidden='true'></i></li> <li><i class='fa fa-star-o' aria-hidden='true'></i></li> <li><i class='fa fa-star-o' aria-hidden='true'></i></li> <li><span style='margin-left: 2px; color:#fd8b2d; font-weight: 900'>" + parseFloat(score).toFixed(2) + "</span><span style='font-weight: lighter; color:#fd8b2d;'>/5</span></li> </ul>";
						}
						else if (score < 1.5 && score >= 1) { // 1 - 1.5 ?>
							return "<ul class='w3l-ratings'> <li><i class='fa fa-star' aria-hidden='true'></i></li> <li><i class='fa fa-star-o' aria-hidden='true'></i></li> <li><i class='fa fa-star-o' aria-hidden='true'></i></li> <li><i class='fa fa-star-o' aria-hidden='true'></i></li> <li><i class='fa fa-star-o' aria-hidden='true'></i></li> <li><span style='margin-left: 2px; color:#fd8b2d; font-weight: 900'>" + parseFloat(score).toFixed(2) + "</span><span style='font-weight: lighter; color:#fd8b2d;'>/5</span></li> </ul>";
						}
						else if (score < 1 && score >= 0.5) { // 0.5 - 1 ?>
							return "<ul class='w3l-ratings'> <li><i class='fa fa-star-half-o' aria-hidden='true'></i></li> <li><i class='fa fa-star-o' aria-hidden='true'></i></li> <li><i class='fa fa-star-o' aria-hidden='true'></i></li> <li><i class='fa fa-star-o' aria-hidden='true'></i></li> <li><i class='fa fa-star-o' aria-hidden='true'></i></li> <li><span style='margin-left: 2px; color:#fd8b2d; font-weight: 900'>" + parseFloat(score).toFixed(2) + "</span><span style='font-weight: lighter; color:#fd8b2d;'>/5</span></li> </ul>";
						}
						else { // 0 - 0.5 ?>
							return "<ul class='w3l-ratings'> <li><i class='fa fa-star-half-o' aria-hidden='true'></i></li> <li><i class='fa fa-star-o' aria-hidden='true'></i></li> <li><i class='fa fa-star-o' aria-hidden='true'></i></li> <li><i class='fa fa-star-o' aria-hidden='true'></i></li> <li><i class='fa fa-star-o' aria-hidden='true'></i></li> <li><span style='margin-left: 2px; color:#fd8b2d; font-weight: 900'>" + parseFloat(score).toFixed(2) + "</span><span style='font-weight: lighter; color:#fd8b2d;'>/5</span></li> </ul>";
						}
				    }
				</script>
				<?php
					// if (isset($_SESSION['total_records']) AND $_SESSION['total_records'] > 0) {

					/*if (isset($_SESSION['ref']) AND $_SESSION['ref'] == $_GET['ref'] AND isset($_SESSION['total_records'])) {

						$total_records = $_SESSION['total_records'];
					}
					else
					{
						$total_records = $movie->count_genre();
					}

					$pagLink = "<div class='blog-pagenat-wthree'> <ul>";  

					// echo "<li><a class='first' href='#''>Prev</a></li>";

					// $limit = 24;
					$total_pages = ceil($total_records / $limit);

					for ($i=1; $i<=$total_pages; $i++) {
						$pagLink .= "<li><a href='genres.php?ref=".$_GET['ref']."&pgn=".$i."'>".$i."</a></li>";  
					}

					// echo "<li><a class='last' href='#''>Next</a></li>";

					echo $pagLink . "<ul> </div>";*/
				?>
		
			</div>
		</div>
	<!-- //w3l-medile-movies-grids -->
	</div>
	<!-- //comedy-w3l-agileits -->
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

    /*$('li#index').removeClass('active')
    $('li#genres').addClass('active')
    $('li#list').removeClass('active')*/
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
								
			/*$().UItoTop({ easingType: 'easeOutQuart' });
								
			});*/
		});
	</script>
<!-- //here ends scrolling icon -->
</body>
</html>