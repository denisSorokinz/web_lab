<?php

$db_host = "localhost";
$db_user = "root";
$db_password = "";

$mysqli = new mysqli($db_host, $db_user, $db_password);
$mysqli->select_db("web_lab7");

// Get All Films
$result = $mysqli->query("select (name) from films");
while ($row = mysqli_fetch_array($result)) {
  $r = $row['name'] . '<br />';
  echo $r;
}
