<?php
include("include/session.php");

function mysqli_result($res, $row, $field=0) {
    $res->data_seek($row);
    $datarow = $res->fetch_array();
    return $datarow[$field];
}

if ($session->logged_in) {
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
                    include("inventory/edit_itemForm.php");
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
