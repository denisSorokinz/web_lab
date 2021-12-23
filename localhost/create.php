<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Add hookah</title>
    <?php
      session_start();
      $conn = mysqli_connect('localhost','root','');
      mysqli_select_db($conn, "hookah");
      mysqli_set_charset($conn, "utf8");
    ?>
  </head>
  <body>
    <span>Додати Кальян</span>
    <br />
    <form action="./addhookah.php" method="post">
      <label>Назва моделі</label><br />
        <input type="text" name="model_name" /><br />

      <label>Бренд</label><br />
      <p><select name="brand">
        <option disabled selected hidden>Оберіть бренд</option>
              <?php
              $brands = mysqli_query($conn, 'SELECT Name FROM `brands`');
              while ($val = mysqli_fetch_array($brands)){
                  $oval = $val[0];
                  echo "<option value=\"$oval\">$oval</option>";
              }
              ?>
        </select></p>

      <label for="height">Висота</label><br />
        <input type="text" name="height" /><br />

      <label for="cost">Ціна</label><br />
        <input type="text" name="cost" /><br />

        <label for="diam">Діаметр шахти</label><br />
        <input type="text" name="diam"/><br />

        <label for="link_pict">Посилання на картинку</label><br />
        <input type="text" name="link_pict" /><br />

      <label>З'єднання</label><br />
      <p><select name="conect">
          <option disabled selected hidden>Оберіть з'єднання</option>
              <?php
              $conect = mysqli_query($conn, 'SELECT Name FROM `connect_type`');
              while ($val = mysqli_fetch_array($conect)){
                  $oval = $val[0];
                  echo "<option value=\"$oval\">$oval</option>";
              }
              ?>
        </select></p>
      <label>Матеріал колби</label><br />
        <p><select name="flask"><?php
              $flask = mysqli_query($conn, 'SELECT Name FROM `flask material`');
              while ($val = mysqli_fetch_array($flask)){
                  $oval = $val[0];
                  echo "<option value=\"$oval\">$oval</option>";
              }
              ?>
              </select></p>

      <label>Матеріал шахти</label><br />
        <p><select name="mine">
          <option disabled selected hidden>Оберіть з'єднання</option>
              <?php
              $mine = mysqli_query($conn, 'SELECT Name FROM `mine material`');
              while ($val = mysqli_fetch_array($mine)){
                  $oval = $val[0];
                  echo "<option value=\"$oval\">$oval</option>";
              }
              ?>
        </select></p>
      <button type="submit">Submit</button><br /><br />

      <a href="deletehookah.php"><span>Видалити Кальян</span></a>
    <br />
      <br><a href="./"><p>Назад</p></a>
    </form>
    </body>
</html>