<?php
		include('./class/user.php');
		// require_once ('./class/movies.php');

		if ($_SERVER["REQUEST_METHOD"] == "POST")
		{

			$username = htmlspecialchars(stripslashes(trim($_POST["Username"])));
			$password = htmlspecialchars(stripslashes(trim($_POST["Password"])));
			$user = new User();
			$result = $user->login($username, $password);

			if ($result == 1)
			{
				/*header("Location: index.php"); 
    			exit;*/

    			echo 1;
			}
			else
				echo 0;
		}

	?>