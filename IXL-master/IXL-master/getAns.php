<?php
	include 'server2.php';
	echo "<center><h3>".$_SESSION['question']."</h3></center>";
?>

<form action="getAns.php" method = "POST">
	<center>ANS : <input type="text" name="answer"></center>
</form>

