<?php

$db_host = "localhost";
$db_user = "root";
$db_password = "";

$mysqli = new mysqli($db_host, $db_user, $db_password);
$mysqli->select_db("web_lab7");

$film = $_POST['film'];

// Get Film by name
$result = $mysqli->query("select id from films where name='$film'");
$row = mysqli_fetch_assoc($result);
$id =  $row['id'];

echo $id;
