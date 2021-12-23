<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>SaintStore</title>
        <link rel="stylesheet" type="text/css" href="index.css">

        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://jqueryui.com/resources/demos/style.css">

        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>



        <?php
        session_start();
        $conn = mysqli_connect('localhost','root','',"hookah")
                or die('Fatal error');
        $_SESSION['conn'] = $conn;
        mysqli_set_charset($conn, "utf8");

        $brands = mysqli_query($conn, 'SELECT Name FROM `brands`');
        $sql = "SELECT `hookahs`.`Назва моделі`, `hookahs`.`Висота`, `hookahs`.`Ціна`, `hookahs`.`Доп плюшки`, `hookahs`.`Діаметр шахти`, `hookahs`.`linc_pict`, `brands`.`Name` AS `name_b`, `connect_type`.`Name` AS `name_c`, `flask material`.`Name` AS `name_f`, `mine material`.`Name` AS `name_m`\n" . "FROM `hookahs` \n" . " LEFT JOIN `brands` ON `hookahs`.`ID бренду` = `brands`.`ID` \n"
            . " LEFT JOIN `connect_type` ON `hookahs`.`ID типу зєднання` = `connect_type`.`ID` \n"
            . " LEFT JOIN `flask material` ON `hookahs`.`ID матеріалу колби` = `flask material`.`ID` \n"
            . " LEFT JOIN `mine material` ON `hookahs`.`ID матеріалу шахти` = `mine material`.`ID`";

        if (isset($_GET['brand'])){
            $idbrand = mysqli_query($conn, 'SELECT ID FROM `brands` WHERE `Name` LIKE \'' . $_GET['brand'] . '\'');
            $sql = $sql . " WHERE `ID бренду` = " . mysqli_fetch_array($idbrand)['ID'];
            }
        if (isset($_GET['costs'])) {
                $list = explode(' ', $_GET['costs']);
                $c1 = trim($list[0], '₴'); 
                $c2 = trim($list[2], '₴');
                if (isset($_GET['brand'])){
                $sql = $sql . ' AND `Ціна` BETWEEN ' . $c1 . ' AND ' . $c2;
                } else {
                    $sql = $sql .' WHERE `Ціна` BETWEEN ' . $c1 . ' AND ' . $c2;
                }
            }

        if(isset($_POST['logg']) and isset($_POST['parr']))
        ?>



    </head>
    <body>
        <div class="main">
            <div class="menu">
                <ul id="level1"> 
                </ul>
            </div>
                <div class="welcome">
                    <h1 class="welcometext">Welcome to the club, buddy</h1>
                </div>
                
                <div class="content">
                    <div class="filtre">
                        <form id="form" action="index.php" method="get">
                        <div class="range">
                            <p>
                            <label for="amount"><h2 style="margin-left: 5px;">Price range:</h2></label>
                            <input type="text" id="amount" name="costs" form="form" readonly style="border:0; color:#f6931f; font-weight:bold;">
                            </p>
                            <div id="slider-range"></div>
                        </div>
                        <div class="param">
                            <p><select name="brand">
                                <option disabled selected hidden>Оберіть бренд</option>
                                <?php
                                while ($val = mysqli_fetch_array($brands)){
                                    $oval = $val[0];
                                    echo "<option value=\"$oval\">$oval</option>";
                                }
                                ?>
                            </select></p>
                            <p><input type="submit" value="Приняти"></p>     
                        </div>
                         </form> 
                    </div> 
                    <div class=items>
                        <?php 
                            $result = mysqli_query($conn, $sql);
                            $n = 0;
                            echo "<div class=\"rows\">";
                            while ($row = mysqli_fetch_array($result)) {
                                $n++;
                                $name = $row['Назва моделі'];
                                $height = $row['Висота'];
                                $cost = $row['Ціна'];
                                $add = $row['Доп плюшки'];
                                $diam = $row['Діаметр шахти'];
                                $link = $row['linc_pict'];
                                $name_b = $row['name_b'];
                                $name_c = $row['name_c'];
                                $name_f = $row['name_f'];
                                $name_m = $row['name_m'];
                                echo "<div class=\"item\">
                                        <div class=\"itemtext\">
                                            <p><b>Назва моделі</b>: $name<br>
                                            <b>Бренд</b>: $name_b<br>
                                            <b>Висота</b>: $height<br>
                                            <b>Ціна</b>: $cost грн <br>
                                            <b>Зєднання</b>: $name_c<br>
                                            <b>Матеріал колби</b>: $name_f<br>
                                            <b>Матеріал шахти</b>: $name_m<br>
                                            <b>Доп плюшки</b>: $add<br>
                                            <b>Діаметр шахти</b>: $diam </p> </div>
                                        <img class = \"imgitem\" src=\"$link\">
                                    </div>";
                                if ($n % 4 == 0) {
                                    echo '</div>';
                                    echo "<div class=\"rows\">";
                                }
                            }
                        ?>
                    </div>
                </div> 
        </div>
        <div class="inpf" id="main">
            <form action="index.php" method="post">
                <label for="logg">Login</label><br />
                    <input type="text" name="logg" /><br />

                <label for="parr">Parrol</label><br />
                    <input type="text" name="parr" /><br />
            </form>
        </div>

        <script type="text/javascript">
            
        
        $('[data-text]').on('keyup', function(){
            $(this).attr('data-text', $(this).text());
        });


        $( function() {
            $( "#slider-range" ).slider({
                range: true,
                min: 0,
                max: 15000,
                values: [ 0, 15000 ],
                slide: function( event, ui ) {
                    $( "#amount" ).val( "₴" + ui.values[ 0 ] + " - ₴" + ui.values[ 1 ] );
                }
            });
            $( "#amount" ).val( "₴" + $( "#slider-range" ).slider( "values", 0 ) +
                " - ₴" + $( "#slider-range" ).slider( "values", 1 ) );
        } );


        function showL2() {
           nodeDiss = document.querySelectorAll('.diss');
           nodeDiss.forEach(dissElem => {
            if (dissElem.classList.contains('active')){
                console.log(dissElem);
                dissElem.classList.remove('active');
                dissElem.style.display = 'none';
            } else {
                dissElem.classList.add('active')
                dissElem.style.display = 'block';
            }   
           });
        }

        
        xmlContent = '';
        let menu = document.getElementById('level1');
        fetch('bd.xml').then((response)=>{
            response.text().then((xml)=>{
                xmlContent = xml;
                var parserXML = new DOMParser();
                let xmlDOM = parserXML.parseFromString(xmlContent,"text/xml");
                let levels = xmlDOM.querySelectorAll('level');

                levels.forEach(levelsXmlNode =>{
                    if (levelsXmlNode.getAttribute('number') == 1){
                        var itemNode = levelsXmlNode.querySelectorAll('item');
                        itemNode.forEach(items =>{
                            let item = document.createElement('li');
                            item.setAttribute('class', 'l1_it');
                            item.setAttribute('id', items.children[0].innerHTML);
                            

                            
                            item.innerText = items.children[1].innerHTML;
                            menu.appendChild(item);
                        }); 
                    } else {
                        var itemNode = levelsXmlNode.querySelectorAll('item');
                        let l2div = document.createElement('div');
                        l2div.classList.add('l2_menu', 'diss');


                        let level2 = document.createElement('ul');
                        l2div.appendChild(level2);

                        let div_menu = document.getElementsByClassName('menu')[0];
                        div_menu.appendChild(l2div);

                        itemNode.forEach(items2 => {
                            let father = document.getElementById(items2.children[2].innerHTML);
                                            
                            if (father){
                            let item2 = document.createElement('li');
                            item2.classList.add('l2_it', 'diss');
                            item2.innerText = items2.children[1].innerHTML;
                            let link = document.createElement('a');
                            link.href = items2.children[3].innerHTML;

                            console.log(items2.children[3].innerHTML); 
                            father.addEventListener("click", showL2);
                            level2.appendChild(link);
                            link.appendChild(item2);
                            }
                        });
                    }
                });
            });  
        });
        
        </script>
    </body>
</html>