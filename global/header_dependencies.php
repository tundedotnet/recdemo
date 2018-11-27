
<div class="header">
		<div class="container">
			<div class="w3layouts_logo">
				<a href="index.php"><h1>One<span>Movies</span></h1></a>
			</div>
			<div class="w3_search">
				<form action="search.php" method="post">
					<input type="text" name="searchtext" placeholder="Search" required="">
					<input type="submit" value="Go">
				</form>
			</div>
			<div class="w3l_sign_in_register">
				<ul>
					<!-- <li><i class="fa fa-phone" aria-hidden="true"></i> (+000) 123 345 653</li> -->
					
					<?php if (!isset($_SESSION['accesstag']) OR $_SESSION['accesstag'] == 'DENY') { ?>

					<li><a href="#" data-toggle="modal" data-target="#myModal">Login</a></li>

					<?php } else { ?>

					<li>
						<center>Hi, <?php echo $_SESSION['userid']; ?></center>
						<a href="logout.php">Logout</a>
					</li>

					<?php } ?>

				</ul>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>