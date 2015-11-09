<?php
	if(isset($_SESSION['name']))
	{
		unset($_SESSION['name']);
		//TODO: clear session
	}
	echo '<h1>logout successful</h1>'
?>