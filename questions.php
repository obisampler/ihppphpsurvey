<?php
	session_start();
	if(!isset($_SESSION['name']))
	{
		//TODO: authenticate session
		header("location: index.php");		
	}
	$name= $_SESSION['name'];
	
	$conn = mysql_connect(':/tmp/mysql.sock','root', '', 'ihpdemo');
	
	if (!$conn) {
		//TODO: Do not publicly log db errors
		die('Could not connect: ' . mysql_error());
	}
	
	$selected = mysql_select_db("ihpdemo",$conn)
	or die("Could not select ihpdemo");
	
	//TODO: filter in only public survey questions
	//TODO: answers are arrays
?>
<html>
	<title>
		Survey Questions
	</title>
	<body>
		<h1>Hello <?php echo $name ?></h1>
		<hr/>
		
		<br/>
		<!--  textarea name="question" form="addQuestion" rows="4" cols="50">
			Enter New Question here...
		</textarea-->
		<form id="addQuestion" action="answers.php" method="post">
			<label for="question">Enter new question:</label><br/>
			<input type="text" name="question" size="200"/><br/>
			<!-- label for="answer">Enter an answer</label><br/>
			<input type="text" name="answer" size="100"><br/-->
			<input type="submit" value="Add Question"/>
		</form>
		<hr/>
		<h2>SURVEY QUESTIONS</h2>
		<table border="1" style="border: 1px black solid;">
			<tr style="padding:0px">
				<th>
				Survey Question
				</th>
				<th>
				Possible Answers
				</th>
				<th>
				Public
				</th>
			</tr>
			<?php
			
				$userQuestions = mysql_query("SELECT * FROM Question WHERE userid='1' AND public=0");
				$qna = array();
				
				while($question = mysql_fetch_array($userQuestions))
				{
					echo "<tr><td>".$question['question']."</td><td>";
					
					$answers = mysql_query("SELECT * FROM answer WHERE questionid='".$question['id']."'");
					while($answer = mysql_fetch_array($answers))
					{
						echo $answer['answer']."<br/>";
					}
					echo "</td></tr>";
				}
			?>
		</table>
		<h3><a href="logout.php">Click here to logout</a></h3>
	</body>

</html>