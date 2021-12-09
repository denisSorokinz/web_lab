<?php

$db_host = "localhost";
$db_user = "root";
$db_password = "";

$film = $_POST['film'];
$genre = $_POST['genre'];
$actors = $_POST['actors'];
$director_first = $_POST['director_first'];
$director_last = $_POST['director_last'];

$mysqli = new mysqli($db_host, $db_user, $db_password);
$mysqli->select_db("web_lab7");

// Add Actors
$actors_arr = explode(",", $actors);
$actors_ids = array();
foreach ($actors_arr as $actor_name) {
  $mysqli->query("INSERT INTO actors VALUES (NULL, '$actor_name')");

  // Find actor_id by name
  $result = $mysqli->query("select id from actors where actor_name='$actor_name'");
  $row = mysqli_fetch_assoc($result);
  $actor_id = $row['id'];

  array_push($actors_ids, $actor_id);
}

// Add Genre
$mysqli->query("INSERT INTO genres VALUES (NULL, '$genre')");

// Add Director
$mysqli->query("INSERT INTO directors VALUES (NULL, '$director_first', '$director_last')");

// Find genre_id by name
$result = $mysqli->query("select id from genres where genre_name='$genre'");
$row = mysqli_fetch_assoc($result);
$genre_id =  $row['id'];

// Find director_id by name
$result = $mysqli->query("select id from directors where name_first='$director_first'");
$row = mysqli_fetch_assoc($result);
$director_id = $row['id'];

// Add Film
$mysqli->query("insert into films values (NULL, '$genre_id', '$director_id', '$film')");

// Find film_id by name
$result = $mysqli->query("select id from films where name='$film'");
$row = mysqli_fetch_assoc($result);
$film_id = $row['id'];

// Add Actors & Films
foreach ($actors_ids as $actor_id) {
  $mysqli->query("insert into actors_films values (NULL, '$actor_id', '$film_id')");
}

// echo 'success';
