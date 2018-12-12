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
    global $session, $database, $form;
    $subitemType = $_POST['tipas'];
    $subitemStatus = $_POST['bukle'];
    $subitemDate = $_POST['gavimo_data'];
    $subitemPrice = $_POST['kaina'];
    $subitemColor =  $_POST['spalva'];
    $subitemSotrage = $_POST['patalpa'];

    $priceArray;
    $price1;
    $price2=0;

    if(strlen($subitemType)==0 && strlen($subitemStatus)==0 && strlen($subitemDate)==0 &&
        strlen($subitemPrice)==0 && strlen($subitemColor)==0 && strlen($subitemSotrage)==0)
    {
      $q ="SELECT * FROM daiktas";

      /* Display table contents */
      echo "<table align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\">\n";
      echo "<tr><td><b>Kodas</b></td><td><b>Pavadinimas</b></td><td><b>Gavimo data</b></td><td><b>Tipas</b></td><td><b>Būklė</b></td><td><b>Kaina</b></td><td><b>Spalva</b></td><td><b>Patalpa</b></td></tr>\n";
      $result = $database->query($q);
      $num_rows = mysqli_num_rows($result);
      for ($i = 0; $i < $num_rows; $i++){
          $itemID = mysqli_result($result, $i, "Kodas");
          $itemName = mysqli_result($result, $i, "Pavadinimas");
          $itemDate = mysqli_result($result, $i, "Gavimo_data");
          $itemType = mysqli_result($result, $i, "Tipas");
          $itemStatus = mysqli_result($result, $i, "Bukle");
          $itemPrice = mysqli_result($result, $i, "Kaina");
          $itemColor = mysqli_result($result, $i, "Spalva");
          $itemStorageID = mysqli_result($result, $i, "fk_PatalpaId");
          $q2 ="SELECT patalpa.Pavadinimas FROM patalpa WHERE patalpa.Id=$itemStorageID";
          $result2 = $database->query($q2);
          $itemStorage = mysqli_result($result2, '0', "Pavadinimas");
          echo "<tr><td>$itemID</td><td>$itemName</td><td>$itemDate</td><td>$itemType</td><td>$itemStatus</td><td>$itemPrice €</td><td>$itemColor</td><td>$itemStorage</td></tr>\n";
      }
      echo "</table><br>\n";
    }
    else{
    if(strlen($subitemPrice)>0)
    {
    $priceArray = explode("-", $subitemPrice);
    $price1 = $priceArray[0];
    if(sizeof($priceArray)>1)
    {
    $price2 = $priceArray[1];
    }
    }

    $filteredSearch="";

    if(strlen($subitemType) > 0 && strlen($subitemStatus)==0 &&
        strlen($subitemDate)==0 && strlen($subitemPrice)==0 && strlen($subitemColor)==0 &&
        strlen($subitemSotrage)==0)
    {
      $filteredSearch = "$filteredSearch"."daiktas.Tipas="."'$subitemType'";
    }

    else if(strlen($subitemType) > 0)
    {
      $filteredSearch = "$filteredSearch". "daiktas.Tipas="."'$subitemType'". " AND ";
    }

    if(strlen($subitemStatus) > 0 && strlen($subitemDate)==0 && strlen($subitemPrice)==0 &&
        strlen($subitemColor)==0 && strlen($subitemSotrage)==0)
    {
      $filteredSearch = "$filteredSearch"."daiktas.Bukle="."'$subitemStatus'";
    }

    else if(strlen($subitemStatus)>0)
    {
      $filteredSearch = "$filteredSearch". "daiktas.Bukle="."'$subitemStatus'". " AND ";
    }


    if(strlen($subitemDate) > 0 && strlen($subitemPrice)==0 &&
        strlen($subitemColor)==0 && strlen($subitemSotrage)==0)
    {
      $filteredSearch = "$filteredSearch"."daiktas.Gavimo_data="."'$subitemDate'";
    }

    else if(strlen($subitemDate) > 0)
    {
      $filteredSearch = "$filteredSearch". "daiktas.Gavimo_data="."'$subitemDate'". " AND ";
    }

    if(strlen($subitemPrice) > 0 && sizeof($priceArray)>1 && strlen($subitemColor)==0
      && strlen($subitemSotrage)==0)
    {
      $filteredSearch = "$filteredSearch"."daiktas.Kaina>="."$price1". " AND ";
      $filteredSearch = "$filteredSearch"."daiktas.Kaina<="."$price2";

    }

    else if(strlen($subitemPrice) > 0 && sizeof($priceArray)>1)
    {
      $filteredSearch = "$filteredSearch"."daiktas.Kaina>="."$price1". " AND ";
      $filteredSearch = "$filteredSearch"."daiktas.Kaina<="."$price2". " AND ";

    }

    if(strlen($subitemPrice) > 0 && sizeof($priceArray)==1 && strlen($subitemColor)==0
      && strlen($subitemSotrage)==0)
    {
      $filteredSearch = "$filteredSearch"."daiktas.Kaina"."$price1";
    }

    else if(strlen($subitemPrice) > 0 && sizeof($priceArray)==1)
    {
      $filteredSearch = "$filteredSearch"."daiktas.Kaina"."$price1". " AND ";
    }

    if(strlen($subitemColor) > 0  && strlen($subitemSotrage)==0)
    {
      $filteredSearch = "$filteredSearch"."daiktas.Spalva="."'$subitemColor'";
    }

    else if(strlen($subitemColor) > 0)
    {
      $filteredSearch = "$filteredSearch". "daiktas.Spalva="."'$subitemColor'". " AND ";
    }

    if(strlen($subitemSotrage)>0)
    {
      $filteredSearch = "$filteredSearch"."daiktas.fk_PatalpaId="."$subitemSotrage";
    }

    $q ="SELECT * FROM daiktas WHERE "."$filteredSearch";

    /* Display table contents */
    echo "<table align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\">\n";
    echo "<tr><td><b>Kodas</b></td><td><b>Pavadinimas</b></td><td><b>Gavimo data</b></td><td><b>Tipas</b></td><td><b>Būklė</b></td><td><b>Kaina</b></td><td><b>Spalva</b></td><td><b>Patalpa</b></td></tr>\n";
    $result = $database->query($q);
    $num_rows = mysqli_num_rows($result);
    for ($i = 0; $i < $num_rows; $i++){
        $itemID = mysqli_result($result, $i, "Kodas");
        $itemName = mysqli_result($result, $i, "Pavadinimas");
        $itemDate = mysqli_result($result, $i, "Gavimo_data");
        $itemType = mysqli_result($result, $i, "Tipas");
        $itemStatus = mysqli_result($result, $i, "Bukle");
        $itemPrice = mysqli_result($result, $i, "Kaina");
        $itemColor = mysqli_result($result, $i, "Spalva");
        $itemStorageID = mysqli_result($result, $i, "fk_PatalpaId");
        $q2 ="SELECT patalpa.Pavadinimas FROM patalpa WHERE patalpa.Id=$itemStorageID";
        $result2 = $database->query($q2);
        $itemStorage = mysqli_result($result2, '0', "Pavadinimas");
        echo "<tr><td>$itemID</td><td>$itemName</td><td>$itemDate</td><td>$itemType</td><td>$itemStatus</td><td>$itemPrice €</td><td>$itemColor</td><td>$itemStorage</td></tr>\n";
    }
    echo "</table><br>\n";
  }
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
