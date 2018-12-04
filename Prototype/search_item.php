<?php
include("include/session.php");

function mysqli_result($res, $row, $field=0) {
    $res->data_seek($row);
    $datarow = $res->fetch_array();
    return $datarow[$field];
}
if ($session->logged_in) {

  function showTable()
  {
    /* Display table contents */
    echo "<table align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\">\n";
    echo "<tr><td><b>Kodas</b></td><td><b>Pavadinimas</b></td><td><b>Tipas</b></td><td><b>Būklė</b></td><td><b>Kaina</b></td><td><b>Spalva</b></td><td><b>Patalpa</b></td></tr>\n";
    echo "<tr><td>1222222</td><td>Glock52</td><td>Linaskdsafasf</td><td>Linaskdsafasf</td><td>Linaskdsafasf</td><td>fasdfsdafasdf</td><td>bxcbxcbxcb</td></tr>\n";
    echo "</table><br>\n";
  }
    ?>
    <!DOCTYPE html>
    <div class="container">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"/>
        <title>Lukiškių kalėjimas</title>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
          <header id='main_header'>
            <div class="container">
              <h1>Inventoriaus valdymas</h1>
            </div>
          </header>
                    <?php include("include/inventoryMeniu.php");
                    include("inventory/search_itemForm.php");
                    if($_POST)
                    {
                      showTable();
                    }
                    ?>
                  <?php  include("include/footer.php");?>
    </body>
    </div>
    </html>
    <?php
    //Jei vartotojas neprisijungęs, užkraunamas pradinis puslapis
} else {
    header("Location: index.php");
}
?>
