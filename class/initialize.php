<?php
	require_once ('movies.php');

	$movies = new Movies();

	if(!isset($_SESSION['toprecommended']) OR $_SESSION['toprecommended'] == 'NA')
		$toprecommended = $movies->guest_recommendations();
	
	if(!isset($_SESSION['topviewed']) OR $_SESSION['topviewed'] == 'NA')
		$topviewed = $movies->get_top_viewed();

	if(!isset($_SESSION['toprated']) OR $_SESSION['toprated'] == 'NA')
		$toprated = $movies->get_top_rated();

	if(!isset($_SESSION['toprecent']) OR $_SESSION['toprecent'] == 'NA')
		$toprecent = $movies->get_top_recent();
?>