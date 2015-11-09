<?php
if (isset($_POST['user_name']))
{
	session_start();
	$_SESSION['name']=$_POST['user_name'];
	header("location: questions.php");
}
?>
<html>
<body>
	<form action="" method="post">
		<label for="user_name">Username</label><br/>
		<input type="text" name="user_name" size="40"/><br/>
		<label for="pwd">Password</label><br/>
		<input type="password" name="pwd"/><br/>
		<input type="submit" value="Log in" />
	</form>
	<a href="questions.php">View Survey Questions</a>
</body>
</html>
