<!DOCTYPE html>
<html>
    <head>

<?php

$conn = mysqli_connect('localhost','root','');
mysqli_select_db($conn, "hookah");
mysqli_set_charset($conn, "utf8");

if(isset($_POST['name'])){
	$name = $_POST['name'];
	if(mysqli_query($conn, "delete from hookahs where `Назва моделі`='$name'")){
		echo "Видалено успішно";
	}
}



?>

</head>
<body>
	<form action="./deletehookah.php" method="post">
	<p><select name="name">
        <option disabled selected hidden>Оберіть бренд</option>
              <?php
              $name = mysqli_query($conn, 'SELECT `Назва моделі` FROM hookahs');
              while ($val = mysqli_fetch_array($name)){
                  $oval = $val[0];
                  echo "<option value=\"$oval\">$oval</option>";
              }
              ?>
        </select></p>
         <button type="submit">Submit</button><br />
         <br><a href="./"><p>На головну</p></a>
    </form>
</body>