<?php
	include 'server2.php';
?>

<form action = "select_category_and_grade.php" method = "POST">
    <div align = "center" class="input-group">
      <label>Category</label>
      <input type="text" name="student_selects_category">
    </div>

    <div align = "center" class="input-group">
      <label>Grade</label>
      <input type="text" name="student_selects_grade">
    </div>

    <div align = "center" class = "input-group">
        <button type="submit" class="btn"
        name = "select_button">SELECT</button>
    </div>
</form>