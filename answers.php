<?php
	
	include 'database.php';
	session_start();
	if(!isset($_SESSION['name']))
	{
		//TODO: authenticate session
		header("location: index.php");
	}
	
	$db = Database::getInstance();
	if(!$db)
	{
		die('Could not instantiate db');
	}
	
	$selected = mysql_select_db("ihpdemo",$db->getConnection())
	or die("Could not select ihpdemo");
	$questionId;
	
	if(isset($_POST['submit']))
	{
		$questionId = $_POST['qid'];
		mysql_query("INSERT INTO answer (answer, questionid) VALUES ('".$_POST['answer']."','".$questionId."')");
		//TODO: check success
		
		$question = "";
		$questions= mysql_query("SELECT question FROM question WHERE id='".$questionId."'");
		while($question = mysql_fetch_array($questions))
		{
			echo "<h1>".$question['question']."</h1>";
		}
	}else 
	{
		//NEW QUESTION
		$success=mysql_query("INSERT INTO QUESTION (question, userid, public) VALUES ('".$_POST['question']."', 1, 1)");
		$questionId=mysql_insert_id();
	}
	
	
	$answers=mysql_query("SELECT * FROM answer WHERE questionid='".$questionId."'");
	//echo "SELECT * FROM answer WHERE questionid='".$questionId."'";
	
	
?>
<html>
	<body>
		<h1><?php echo $_POST['question']; ?></h1>
		<form action="" method="POST">
			<label for="answer">Enter answer here:</label><br/>
			<input type="text" name="answer" size="100"/><br/>
			<input type="hidden" name="qid" value="<?php echo $questionId?>"/>
			<input type="submit" value="Submit Answer" name="submit"/>
		</form>
 		<table>
			<?php
				while($answer = mysql_fetch_array($answers))
				{
					echo "<tr><td>".$answer['answer']."</td></tr>";
				}
			?>	
		</table>
	</body>
</html>
