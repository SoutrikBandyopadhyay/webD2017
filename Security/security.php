<?php

	function sanitize($connection,$string)
	{
		$string = $connection->real_escape_string($string);
		$string = stripslashes($string);
		$string = htmlentities($string);
		return $string;
		// To prevent HTTP and SQL Injection.... Wow some strong words.... 
	}

?>