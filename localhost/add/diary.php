<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>*
  <script>
    $(document).ready(function() {
      $("#but").click(function() {
        alert('test');
        $("#res").load('get.php?date=#datepickerR');
      });
    });

    $(function() {
      $("#datepicker").datepicker();
    });
    $(function() {
      $("#datepickerR").datepicker();
    });
    $(document).ready(function() {
      $("form").submit(function(event) {
        var formData = {
          theme: $("#theme").val(),
          description: $("#description").val(),
          datepicker: $("#datepicker").val(),
        };
        // function getValues(){
        //         var vals1 = document.getElementsById('theme');
        //         var vals2 = document.getElementsById('description');
        //         var vals3 = document.getElementsById('datepicker');
        //         var values = new Array(3);
        //         values.push(vals1,vals2,vals3);
        //         console.log(values);
        //         return values;
        //     }
        $(document).ready(function() {
          $.get("diary.php", {
            date: $("input[name='datepickerR']").val()
          }, async function(data) {
            location.reload();
          })
        });
        $.ajax({
          type: "POST",
          url: "process.php",
          data: formData,
          dataType: "json",
          encode: true,
        }).done(function(data) {
          console.log(data);
        });

        event.preventDefault();
      });
    });
  </script>
</head>

<body>
  <p>Diary</p>
  <form action="process.php" method="post" name="1">
    <p>Theme</p>
    <p><input type="text" name="theme" id="theme"></p>
    <p>Description</p>
    <p><input type="text" name="description" id="description"></p>
    <p>Date</p>
    <p><input type="text" id="datepicker" name="datepicker"></p>
    <button type="submit">Submit</button>
  </form>
  <!-- <form action="get.php" method="get">
        <p>Enter date</p>
        <p><input type="text" id="datepickerR" name="datepickerR"></p>
        <button type="button" id="but">Submit</button>
        <div id="res"></div>
    </form> -->


  <!-- <form method="get">
            <p>Enter date</p>
            <p><input type="text" id="datepickerR" name="datepickerR"></p>
            <p><input type="text" name="theme1" id="theme1"></p>
            <input type="submit" value="Отправить" name="send"/>
        </form> -->

  <div id="list"></div>
  <script>
    document.addEventListener("DOMContentLoaded", async () => {
      const list = document.querySelector("#list");

      const r = await fetch("data1.json");
      const data = await r.json();

      if (data.length == 0) return;

      data.forEach((item) => {
        const {
          theme,
          description,
          datepicker
        } = item[0];
        const listItem = document.createElement("li");
        listItem.innerHTML = `Тема: ${theme} <br /> Вмiст: ${description} <br /> Дата: ${datepicker}`

        list.appendChild(listItem)
      })
    })
  </script>

</body>

</html>