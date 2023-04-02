<?php
	include 'server2.php';
	echo $_SESSION['question'];
	echo '<br>'.$_SESSION['answer'];
?>

<form action="getAnsScience.php" method = "POST">
	ANS : <input type="text" name="answerscience">
</form>

