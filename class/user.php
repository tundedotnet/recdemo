<?php
@session_start();

/**
 * 
 */

// include('connectDB.php');

class User
{
	 
	function __construct()
	{
		
	}

	function login($username, $password)
	{
		include 'connectDB.php';

		$_SESSION['accesstag']='DENY';

		$sql = "SELECT * FROM users WHERE userid = $username";
		$result = $conn->query($sql);

		if (is_object($result) AND $result->num_rows > 0 AND $password == 'password')
		{
			// session_regenerate_id();

		    $_SESSION['accesstag']='OK'; # accesstag session variable is initialised as OK to guarantee access to other operations
			$_SESSION['userid'] = $username;
			$_SESSION['savetag']=0;

			return 1;
		 
		}
		else
		{
		    $_SESSION['savetag']=0;
			return 0;
		}

		$conn->close();
	}
}

?>