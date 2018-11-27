<?php
	@session_start();
	
	// LOAD ALL THE MOVIE IMAGES
	// $files = array_diff(scandir('imdb_scaled_images/'), array('.', '..'));

	require_once ('class/movies.php');

	$movies = new Movies();
	
	if(isset($_GET['ref']))
		$ref = $_GET['ref'];
	else
	{
		$ref = 'all';
	}

	$page = 1;

	$limit = 20;
	$start_from = ($page-1) * $limit;
	$total_records = $movies->count_fetch_movies();
	$total_pages = ceil($total_records / $limit);

	$fetchedmovies = $movies->fetch_movies($start_from, $limit);

	$_SESSION['cur_page'] = 'list';
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
			width:47px; height:71px; background-image: url('images/blank.png'); background-repeat: no-repeat; background-size: cover; color: #FFF; text-align: center;
		}
	</style>
	<title> ONE MOVIES | List </title>
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
<link rel="stylesheet" href="css/faqstyle.css" type="text/css" media="all" />
<link href="css/medile.css" rel='stylesheet' type='text/css' />
<link href="css/single.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/contactstyle.css" type="text/css" media="all" />
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
<!-- tables -->
<link rel="stylesheet" type="text/css" href="list-css/table-style.css" />
<link rel="stylesheet" type="text/css" href="list-css/basictable.css" />
<script type="text/javascript" src="list-js/jquery.basictable.min.js"></script>
 <script type="text/javascript">
    /*$(document).ready(function() {
      $('#table').basictable();

      $('#table-breakpoint').basictable({
        breakpoint: 768
      });
	   $('#table-breakpoint1').basictable({
        breakpoint: 768
      });
	  $('#table-breakpoint2').basictable({
        breakpoint: 768
      });
	  $('#table-breakpoint3').basictable({
        breakpoint: 768
      });
	  $('#table-breakpoint4').basictable({
        breakpoint: 768
      });
	  $('#table-breakpoint5').basictable({
        breakpoint: 768
      });
	  $('#table-breakpoint6').basictable({
        breakpoint: 768
      });
	  $('#table-breakpoint7').basictable({
        breakpoint: 768
      });
	  $('#table-breakpoint8').basictable({
        breakpoint: 768
      });
	  $('#table-breakpoint9').basictable({
        breakpoint: 768
      });
	  $('#table-breakpoint10').basictable({
        breakpoint: 768
      });
	  $('#table-breakpoint11').basictable({
        breakpoint: 768
      });
	  $('#table-breakpoint12').basictable({
        breakpoint: 768
      });
	  $('#table-breakpoint13').basictable({
        breakpoint: 768
      });
	  $('#table-breakpoint14').basictable({
        breakpoint: 768
      });
	  $('#table-breakpoint15').basictable({
        breakpoint: 768
      });
	  $('#table-breakpoint16').basictable({
        breakpoint: 768
      });
	  $('#table-breakpoint17').basictable({
        breakpoint: 768
      });
	  $('#table-breakpoint18').basictable({
        breakpoint: 768
      });
	  $('#table-breakpoint19').basictable({
        breakpoint: 768
      });
	  $('#table-breakpoint20').basictable({
        breakpoint: 768
      });
	  $('#table-breakpoint21').basictable({
        breakpoint: 768
      });
	  $('#table-breakpoint22').basictable({
        breakpoint: 768
      });
	  $('#table-breakpoint23').basictable({
        breakpoint: 768
      });
	  $('#table-breakpoint24').basictable({
        breakpoint: 768
      });
	  $('#table-breakpoint25').basictable({
        breakpoint: 768
      });
	  $('#table-breakpoint26').basictable({
        breakpoint: 768
      });
    });*/
  </script>
<!-- //tables -->
</head>

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
		$sql = "ALL - SELECT movies.movieid AS movieid, rtitle, yearreleased, genres, AVG(ratings.rating) AS average, director, country, language FROM movies INNER JOIN ratings ON movies.movieid=ratings.movieid INNER JOIN movies_info ON movies.movieid=movies_info.movieid GROUP BY movieid ORDER BY average DESC, yearreleased DESC, rtitle ASC LIMIT 'start_from', 'limit' <br/>";
		$sql .= "# - SELECT movies.movieid AS movieid, rtitle, yearreleased, genres, AVG(ratings.rating) AS average, director, country, language FROM movies INNER JOIN ratings ON movies.movieid=ratings.movieid INNER JOIN movies_info ON movies.movieid=movies_info.movieid WHERE rtitle LIKE '0%' OR rtitle LIKE '1%' OR rtitle LIKE '2%'  OR rtitle LIKE '3%'  OR rtitle LIKE '4%' OR rtitle LIKE '5%'  OR rtitle LIKE '6%' OR rtitle LIKE '7%' OR rtitle LIKE '8%' OR rtitle LIKE '9%' GROUP BY movieid ORDER BY average DESC, yearreleased DESC, rtitle ASC LIMIT 'start_from', 'limit' <br/>";
		$sql .= "Others - SELECT movies.movieid AS movieid, rtitle, yearreleased, genres, AVG(ratings.rating) AS average, director, country, language FROM movies INNER JOIN ratings ON movies.movieid=ratings.movieid INNER JOIN movies_info ON movies.movieid=movies_info.movieid WHERE rtitle LIKE 'startwith%' GROUP BY movieid ORDER BY average DESC, yearreleased DESC, rtitle ASC LIMIT 'start_from', 'limit'";

		echo "$sql <br/>";

		print("</pre>");
	}
?>
	
<body>
<!-- header -->
	<?php include('global/header_dependencies.php'); ?>
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
<!-- faq-banner -->
	<div class="faq">
		<h4 class="latest-text w3_faq_latest_text w3_latest_text">Movies List</h4>
			<div class="container">
				<div class="agileits-news-top">
					<ol class="breadcrumb">
					  <li><a href="index.html">Home</a></li>
					  <li class="active">List</li>
					</ol>
				</div>
				<div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
						<ul id="myTab" class="nav nav-tabs" role="tablist">
							<!-- <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">0 - 9</a></li> -->
							<li role="presentation" <?php if(!isset($_GET['ref'])) echo "class='active'"; ?> ><a style="font-weight: bold" href="list.php?" aria-controls="a">ALL</a></li>

							<li role="presentation" <?php if(isset($_GET['ref']) AND $_GET['ref'] == 'digit') echo "class='active'"; ?> ><a style="font-weight: bold"  href="list.php?ref=digit" aria-controls="a">#</a></li>

							<li role="presentation"  <?php if(isset($_GET['ref']) AND $_GET['ref'] == 'a') echo "class='active'"; ?> ><a style="font-weight: bold"  href="list.php?ref=a" aria-controls="a">A</a></li>

							<li role="presentation" <?php if(isset($_GET['ref']) AND $_GET['ref'] == 'b') echo "class='active'"; ?> ><a style="font-weight: bold"  href="list.php?ref=b" aria-controls="b">B</a></li>

							<li role="presentation" <?php if(isset($_GET['ref']) AND $_GET['ref'] == 'c') echo "class='active'"; ?> ><a style="font-weight: bold"  href="list.php?ref=c" aria-controls="c">C</a></li>

							<li role="presentation" <?php if(isset($_GET['ref']) AND $_GET['ref'] == 'd') echo "class='active'"; ?> ><a style="font-weight: bold"  href="list.php?ref=d" aria-controls="d">D</a></li>

							<li role="presentation" <?php if(isset($_GET['ref']) AND $_GET['ref'] == 'e') echo "class='active'"; ?> ><a style="font-weight: bold"  href="list.php?ref=e" aria-controls="e">E</a></li>

							<li role="presentation" <?php if(isset($_GET['ref']) AND $_GET['ref'] == 'f') echo "class='active'"; ?> ><a style="font-weight: bold"  href="list.php?ref=f" aria-controls="f">F</a></li>

							<li role="presentation" <?php if(isset($_GET['ref']) AND $_GET['ref'] == 'g') echo "class='active'"; ?> ><a style="font-weight: bold"  href="list.php?ref=g" aria-controls="g">G</a></li>

							<li role="presentation" <?php if(isset($_GET['ref']) AND $_GET['ref'] == 'h') echo "class='active'"; ?> ><a style="font-weight: bold"  href="list.php?ref=h" aria-controls="h">H</a></li>

							<li role="presentation" <?php if(isset($_GET['ref']) AND $_GET['ref'] == 'i') echo "class='active'"; ?> ><a style="font-weight: bold"  href="list.php?ref=i" aria-controls="i">I</a></li>

							<li role="presentation" <?php if(isset($_GET['ref']) AND $_GET['ref'] == 'j') echo "class='active'"; ?> ><a style="font-weight: bold"  href="list.php?ref=j" aria-controls="j">J</a></li>

							<li role="presentation" <?php if(isset($_GET['ref']) AND $_GET['ref'] == 'k') echo "class='active'"; ?> ><a style="font-weight: bold"  href="list.php?ref=k" aria-controls="k">K</a></li>

							<li role="presentation" <?php if(isset($_GET['ref']) AND $_GET['ref'] == 'l') echo "class='active'"; ?> ><a style="font-weight: bold"  href="list.php?ref=l" aria-controls="l">L</a></li>

							<li role="presentation" <?php if(isset($_GET['ref']) AND $_GET['ref'] == 'm') echo "class='active'"; ?> ><a style="font-weight: bold"  href="list.php?ref=m" aria-controls="m">M</a></li>

							<li role="presentation" <?php if(isset($_GET['ref']) AND $_GET['ref'] == 'n') echo "class='active'"; ?> ><a style="font-weight: bold"  href="list.php?ref=n" aria-controls="n">N</a></li>

							<li role="presentation" <?php if(isset($_GET['ref']) AND $_GET['ref'] == 'o') echo "class='active'"; ?> ><a style="font-weight: bold"  href="list.php?ref=o" aria-controls="o">O</a></li>

							<li role="presentation" <?php if(isset($_GET['ref']) AND $_GET['ref'] == 'p') echo "class='active'"; ?> ><a style="font-weight: bold"  href="list.php?ref=p" aria-controls="p">P</a></li>

							<li role="presentation" <?php if(isset($_GET['ref']) AND $_GET['ref'] == 'q') echo "class='active'"; ?> ><a style="font-weight: bold"  href="list.php?ref=q" aria-controls="q">Q</a></li>

							<li role="presentation" <?php if(isset($_GET['ref']) AND $_GET['ref'] == 'r') echo "class='active'"; ?> ><a style="font-weight: bold"  href="list.php?ref=r" aria-controls="r">R</a></li>

							<li role="presentation" <?php if(isset($_GET['ref']) AND $_GET['ref'] == 's') echo "class='active'"; ?> ><a style="font-weight: bold"  href="list.php?ref=s" aria-controls="s">S</a></li>

							<li role="presentation" <?php if(isset($_GET['ref']) AND $_GET['ref'] == 't') echo "class='active'"; ?> ><a style="font-weight: bold"  href="list.php?ref=t" aria-controls="t">T</a></li>

							<li role="presentation" <?php if(isset($_GET['ref']) AND $_GET['ref'] == 'u') echo "class='active'"; ?> ><a style="font-weight: bold"  href="list.php?ref=u" aria-controls="u">U</a></li>

							<li role="presentation" <?php if(isset($_GET['ref']) AND $_GET['ref'] == 'v') echo "class='active'"; ?> ><a style="font-weight: bold"  href="list.php?ref=v" aria-controls="v">V</a></li>

							<li role="presentation" <?php if(isset($_GET['ref']) AND $_GET['ref'] == 'w') echo "class='active'"; ?> ><a style="font-weight: bold"  href="list.php?ref=w" aria-controls="w">W</a></li>

							<li role="presentation" <?php if(isset($_GET['ref']) AND $_GET['ref'] == 'x') echo "class='active'"; ?> ><a style="font-weight: bold"  href="list.php?ref=x" aria-controls="x">X</a></li>

							<li role="presentation" <?php if(isset($_GET['ref']) AND $_GET['ref'] == 'y') echo "class='active'"; ?> ><a style="font-weight: bold"  href="list.php?ref=y" aria-controls="y">Y</a></li>

							<li role="presentation" <?php if(isset($_GET['ref']) AND $_GET['ref'] == 'z') echo "class='active'"; ?> ><a style="font-weight: bold"  href="list.php?ref=z" aria-controls="z">Z</a></li>
						</ul>
						
						<div id="myTabContent" class="tab-content">
							<div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
								<div class="agile-news-table">
									<div class="w3ls-news-result">
										<h4>Searched Results : <span><?php echo $total_records; ?></span></h4>
									</div>
									<table id="table-breakpoint">
										<thead>
										  <tr>
											<th>No.</th>
											<th>Movie Name</th>
											<th>Genre</th>
											<th>Director</th>
											<th>Language</th>
											<th>Country</th>
											<th>Year of Release</th>
											<!-- <th>Status</th> -->
											<!-- <th>Country</th> -->
											<th width="150px">Rating</th>
										  </tr>
										</thead>
										<tbody id="itemsbody">
											<?php

												$i = 1; # for selecting image for cover
												foreach ($fetchedmovies as $movie) {

													/*$needle = $movie['movieid'] . "_imdb.png";
													$imgfile = in_array($needle, $files)?$needle:'noimage_imdb.png';*/

													$key = $movie['movieid'];
													$needle = "imdb_scaled_images/" . $key . "_imdb.png";
													$imgfile = file_exists($needle) ? $needle : "imagescreated/$key.png";
											?>
										  <tr>
											<td><?php echo $i; ?></td>
											<?php $url = "single.php?ref=" . $movie['movieid']; ?>
											<td class="w3-list-img"> <a href="<?php echo $url; ?>">
												<!-- width:47px; height:102px; -->
												<img style="" src="<?php echo $imgfile; ?>" alt="" />
												<!-- <div class="blank"> <?php // echo $movie['rtitle'] ?> </div> -->
												<span><?php echo $movie['rtitle']; ?></span> </a>
											</td>
											<td><?php echo str_replace('|', ' | ', $movie['genres']); ?></td>
											<td><?php echo $movie['director']; ?></td>
											<td><?php echo $movie['language']; ?></td>
											<td><?php echo $movie['country']; ?></td>
											<td><?php echo $movie['yearreleased']; ?></td>
											<!-- <td class="w3-list-info"><a href="<?php // echo $url; ?>">United Kingdom</a></td> -->
											<?php 
												$rating = round($movie['average'], 2); 
												if ($rating == 0 OR $rating =="") 
													$rating = 3;
											?>
											<td><?php include('rating.php'); ?></td>
										  </tr>

										  	<?php $i++; } ?>

										</tbody>
									</table>
								</div>
							</div>
						</div>
				</div>

				<input type="hidden" id="ref" value="<?php echo $ref; ?>">
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
				        	// alert(page);

				        	var ref = document.getElementById('ref').value

				        	var queryData = 'ref=' + ref + '&page=' + page;

				        	var start_from = (page-1) * 20;
				        	// alert(start_from)
				        	// alert(queryData);
				        	// console.log(queryData);
				        	// console.log(start_from);

				        	$.ajax({

								type: 'POST',
					            url: 'get_list.php',
					            data: queryData,
							    
							    success: function(data){
					            	// alert(data);
					            	// console.log(data);
					            	if (data != 0){			

					            		response = $.parseJSON(data);

					            		$("tbody#itemsbody").empty();

					            		// console.log(start_from);
					            		start_from++;
					            		
						                $.each(response, function (i, item) {

						                	var imgname = item.movieid + "_imdb.png";

						                	var newItem = "<tr> <td>" + start_from + "</td> <td class='w3-list-img'><a href='single.php?ref=" + item.movieid + "'><img style='' src='imdb_scaled_images/" + imgname + "' alt='' /><span>" + item.rtitle + "</span></a></td> <td>" + item.genres + "</td> <td>" + item.director + "</td> <td>" + item.language + "</td> <td>" + item.country + "</td> <td>" + item.yearreleased + "</td> <td>" + rate(item.average) + "</td> </tr>";

						                	// console.log(newItem)

						                	$('table#table-breakpoint').append(newItem);
						                	start_from++;

						                });
						            }
						            $('html, body').animate({scrollTop: 100}, 800);
						            return false;
					            }

							});
				        	
				            // console.info(page + ' (from event listening)');
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
			</div>
	</div>
<!-- //faq-banner -->
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
								
			/*$().UItoTop({ easingType: 'easeOutQuart' });
								
			});*/
		});
	</script>
<!-- //here ends scrolling icon -->
</body>
</html>