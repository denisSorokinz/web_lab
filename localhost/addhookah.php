<?php



$model_name = $_POST['model_name'];
$brand = $_POST['brand'];
$height = $_POST['height'];
$cost = $_POST['cost'];
$diam = $_POST['diam'];
$link_pict = $_POST['link_pict'];
$conect = $_POST['conect'];
$flask = $_POST['flask'];
$mine = $_POST['mine'];

$conn = mysqli_connect('localhost','root','');
mysqli_select_db($conn, "hookah");
mysqli_set_charset($conn, "utf8");




  
  $result = mysqli_query($conn, "select id from brands where name='$brand'");
  $row1 = mysqli_fetch_assoc($result);
  $brand_id = $row1['id'];

  $result = mysqli_query($conn, "select id from connect_type where name='$conect'");
  $row2 = mysqli_fetch_assoc($result);
  $conect_id = $row2['id'];


  $result = mysqli_query($conn, "select id from `mine material` where name='$mine'");
  $row3 = mysqli_fetch_assoc($result);
  $mine_id = $row3['id'];

  $result = mysqli_query($conn, "select id from `flask material` where name='$flask'");
  $row4 = mysqli_fetch_assoc($result);
  $flask_id = $row4['id'];


  
  if (mysqli_query($conn, "insert into hookahs (`ID`, `Назва моделі`, `Висота`, `Ціна`, `Доп плюшки`, `Діаметр шахти`, `ID типу зєднання`, `ID матеріалу шахти`, `ID матеріалу колби`, `ID бренду`, `linc_pict`) values (null, '$model_name', '$height', $cost, '', $diam, $conect_id, $mine_id, $flask_id, $brand_id, '$link_pict')")){
    echo"<h1>Успішно добавлено<h1><br><a href=\"create.php\"><p>Назад</p></a>";
  } else {
    echo mysqli_error($conn);
  }

?>