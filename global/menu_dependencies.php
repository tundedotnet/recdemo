<?php
	require_once ('./class/movies.php');

	$movie = new Movies();

	$all_genres = $movie->get_listof_genre();
	$page = $_SESSION['cur_page'];
?>
<div class="movies_nav">
		<div class="container">
			<nav class="navbar navbar-default">
				<div class="navbar-header navbar-left">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
					<nav>
						<ul class="nav navbar-nav">
							<li id="index" class="<?php if($page == 'index') echo 'active'; ?>"><a href="index.php<?php if(isset($_SESSION['debug'])) echo '?debug=1'; ?>">Home</a></li>
							<li id="genres" class="dropdown <?php if($page == 'genres') echo 'active'; ?>">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Genres <b class="caret"></b></a>
								<ul class="dropdown-menu multi-column columns-3">
									<li>
									<div class="col-sm-6">
										<ul class="multi-column-dropdown">
											<?php for ($i=0; $i < (count($all_genres)/2); $i++) { ?>
											<li><a href="genres.php?ref=<?php echo $all_genres[$i] ?><?php if(isset($_SESSION['debug'])) echo '&debug=1'; ?>"><?php echo $all_genres[$i] ?></a></li>
											<?php } ?>
											<!-- <li><a href="genres.php?ref=Action">Action</a></li>
											<li><a href="genres.php?ref=Biography">Biography</a></li>
											<li><a href="genres.php?ref=Crime">Crime</a></li>
											<li><a href="genres.php?ref=Family">Family</a></li>
											<li><a href="genres.php?ref=Horror">Horror</a></li>
											<li><a href="genres.php?ref=Romance">Romance</a></li>
											<li><a href="genres.php?ref=Sports">Sports</a></li>
											<li><a href="genres.php?ref=War">War</a></li> -->
										</ul>
									</div>
									<div class="col-sm-6">
										<ul class="multi-column-dropdown">
											<?php for ($i=(count($all_genres)/2); $i < count($all_genres); $i++) { ?>
											<li><a href="genres.php?ref=<?php echo $all_genres[$i] ?><?php if(isset($_SESSION['debug'])) echo '&debug=1'; ?>"><?php echo $all_genres[$i] ?></a></li>
											<?php } ?>
											<!-- <li><a href="genres.php?ref=Adventure">Adventure</a></li>
											<li><a href="genres.php?ref=Comedy">Comedy</a></li>
											<li><a href="genres.php?ref=Documentary">Documentary</a></li>
											<li><a href="genres.php?ref=Fantasy">Fantasy</a></li>
											<li><a href="genres.php?ref=Thriller">Thriller</a></li> -->
										</ul>
									</div>
									<!-- <div class="col-sm-4">
										<ul class="multi-column-dropdown">
											<li><a href="genres.php?ref=Animation">Animation</a></li>
											<li><a href="genres.php?ref=Costume">Costume</a></li>
											<li><a href="genres.php?ref=Drama">Drama</a></li>
											<li><a href="genres.php?ref=History">History</a></li>
											<li><a href="genres.php?ref=Musical">Musical</a></li>
											<li><a href="genres.php?ref=Psychological">Psychological</a></li>
										</ul>
									</div> -->
									<div class="clearfix"></div>
									</li>
								</ul>
							</li>
							<li id="list" class="<?php if($page == 'list') echo 'active'; ?>"><a href="list.php<?php if(isset($_SESSION['debug'])) echo '?debug=1'; ?>">A - z list</a></li>
							<li id="contact" class="<?php if($page == 'contact') echo 'active'; ?>"><a href="contact.php<?php if(isset($_SESSION['debug'])) echo '?debug=1'; ?>">Contact Us</a></li>
						</ul>
					</nav>
				</div>
			</nav>	
		</div>
	</div>