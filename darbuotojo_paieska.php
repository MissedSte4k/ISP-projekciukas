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

    $submitedSutartPradz = $_POST['sutarties_pradzia'];
    $submitedSutartPab = $_POST['sutarties_pabaiga'];
    $submitedPareig = $_POST['pareigos'];
    $submitedPamaina = $_POST['pamaina'];



    if(strlen($submitedSutartPradz)==0 && strlen($submitedSutartPab)==0 && strlen($submitedPareig)==0 &&
        strlen($submitedPamaina)==0)
    {
      $q ="SELECT * FROM daiktas";

      /* Display table contents */
      echo "<table align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\">\n";
      echo "<tr><td><b>tabelio_nr</b></td><td><b>Telefono numeris</b></td><td><b>Adresas</b></td><td><b>Sutarties pradžia</b></td><td><b>Sutarties pabaiga</b></td><td><b>Pareigos</b></td><td><b>Pamaina</b></td><td><b>Asmens kodas</b></td></tr>\n";
      $result = $database->query($q);
      $num_rows = mysqli_num_rows($result);
      for ($i = 0; $i < $num_rows; $i++){

        $DarbuotojoID = mysqli_result($result, $i, "tabelio_nr");
        $DarbuotojoNumeris = mysqli_result($result, $i, "telefono_numeris");
        $DarbuotojoGyvVieta = mysqli_result($result, $i, "gyvenamoji_vieta");
        $DarbuotojoSutartPradz = mysqli_result($result, $i, "sutarties_pradzia");
        $DarbuotojoSutartPab = mysqli_result($result, $i, "sutarties_pabaiga");
        $DarbuotojoPareig = mysqli_result($result, $i, "pareigos");
        $Pamaina = mysqli_result($result, $i, "fk_Pamainapamainos_id");;
        $AsmensKodas= mysqli_result($result, $i, "fk_Asmuoasmens_kodas");

        /*  $itemID = mysqli_result($result, $i, "Kodas");
          $itemName = mysqli_result($result, $i, "Pavadinimas");
          $itemDate = mysqli_result($result, $i, "Gavimo_data");
          $itemType = mysqli_result($result, $i, "Tipas");
          $itemStatus = mysqli_result($result, $i, "Bukle");
          $itemPrice = mysqli_result($result, $i, "Kaina");
          $itemColor = mysqli_result($result, $i, "Spalva");
          $itemStorageID = mysqli_result($result, $i, "fk_PatalpaId");
          $q2 ="SELECT patalpa.Pavadinimas FROM patalpa WHERE patalpa.Id=$itemStorageID";
          $result2 = $database->query($q2);
          $itemStorage = mysqli_result($result2, '0', "Pavadinimas");*/
          echo "<tr><td>$DarbuotojoID</td><td>$DarbuotojoNumeris</td><td>$DarbuotojoGyvVieta</td><td>$DarbuotojoSutartPradz</td><td>$DarbuotojoSutartPab</td><td>$DarbuotojoPareig €</td><td>$Pamaina</td><td>$AsmensKodas</td></tr>\n";
     }
      echo "</table><br>\n";
    }
    else{
    /*if(strlen($subitemPrice)>0)
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
      $filteredSearch = "$filteredSearch"."darbuotojas.Tipas="."'$subitemType'";
    }

    else if(strlen($subitemType) > 0)
    {
      $filteredSearch = "$filteredSearch". "darbuotojas.Tipas="."'$subitemType'". " AND ";
    }

    if(strlen($subitemStatus) > 0 && strlen($subitemDate)==0 && strlen($subitemPrice)==0 &&
        strlen($subitemColor)==0 && strlen($subitemSotrage)==0)
    {
      $filteredSearch = "$filteredSearch"."darbuotojas.Bukle="."'$subitemStatus'";
    }

    else if(strlen($subitemStatus)>0)
    {
      $filteredSearch = "$filteredSearch". "darbuotojas.Bukle="."'$subitemStatus'". " AND ";
    }

*/
  /*  if(strlen($subitemDate) > 0 && strlen($subitemPrice)==0 &&
        strlen($subitemColor)==0 && strlen($subitemSotrage)==0)
    {
      $filteredSearch = "$filteredSearch"."darbuotojas.sutarties_pradzia="."'$subitemDate'";
    }

    else */if(strlen($submitedSutartPradz) > 0)
    {
      $filteredSearch = "$filteredSearch". "darbuotojas.sutarties_pradzia="."'$submitedSutartPradz'". " AND ";
    }

    if(strlen($submitedSutartPab) > 0)
    {
      $filteredSearch = "$filteredSearch". "darbuotojas.sutarties_pabaiga="."'$submitedSutartPab'". " AND ";
    }

    /*if(strlen($subitemPrice) > 0 && sizeof($priceArray)>1 && strlen($subitemColor)==0
      && strlen($subitemSotrage)==0)
    {
      $filteredSearch = "$filteredSearch"."darbuotojas.Kaina>="."$price1". " AND ";
      $filteredSearch = "$filteredSearch"."darbuotojas.Kaina<="."$price2";

    }

    else if(strlen($subitemPrice) > 0 && sizeof($priceArray)>1)
    {
      $filteredSearch = "$filteredSearch"."darbuotojas.Kaina>="."$price1". " AND ";
      $filteredSearch = "$filteredSearch"."darbuotojas.Kaina<="."$price2". " AND ";

    }

    if(strlen($subitemPrice) > 0 && sizeof($priceArray)==1 && strlen($subitemColor)==0
      && strlen($subitemSotrage)==0)
    {
      $filteredSearch = "$filteredSearch"."darbuotojas.Kaina"."$price1";
    }

    else if(strlen($subitemPrice) > 0 && sizeof($priceArray)==1)
    {
      $filteredSearch = "$filteredSearch"."darbuotojas.Kaina"."$price1". " AND ";
    }*/

  /*  if(strlen($subitemColor) > 0  && strlen($subitemSotrage)==0)
    {
      $filteredSearch = "$filteredSearch"."darbuotojas.Spalva="."'$subitemColor'";
    }

    else */if
    (strlen($submitedPareig) > 0)
    {
      $filteredSearch = "$filteredSearch". "darbuotojas.pareigos="."$submitedPareig";
    }

    if(strlen($submitedPamaina)>0)
    {
      $filteredSearch = "$filteredSearch"."darbuotojas.fk_Pamainapamainos_id="."$submitedPamaina";
    }

    $q ="SELECT * FROM darbuotojas WHERE "."$filteredSearch";

    /* Display table contents */
    echo "<table align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\">\n";
    echo "<tr><td><b>tabelio_nr</b></td><td><b>Telefono numeris</b></td><td><b>Adresas</b></td><td><b>Sutarties pradžia</b></td><td><b>Sutarties pabaiga</b></td><td><b>Pareigos</b></td><td><b>Pamaina</b></td><td><b>Asmens kodas</b></td></tr>\n";
    $result = $database->query($q);
    $num_rows = mysqli_num_rows($result);
    for ($i = 0; $i < $num_rows; $i++){
      $DarbuotojoID = mysqli_result($result, $i, "tabelio_nr");
      $DarbuotojoNumeris = mysqli_result($result, $i, "telefono_numeris");
      $DarbuotojoGyvVieta = mysqli_result($result, $i, "gyvenamoji_vieta");
      $DarbuotojoSutartPradz = mysqli_result($result, $i, "sutarties_pradzia");
      $DarbuotojoSutartPab = mysqli_result($result, $i, "sutarties_pabaiga");
      $DarbuotojoPareig = mysqli_result($result, $i, "pareigos");
      $Pamaina = mysqli_result($result, $i, "fk_Pamainapamainos_id");;
      $AsmensKodas= mysqli_result($result, $i, "fk_Asmuoasmens_kodas");

      /*  $itemID = mysqli_result($result, $i, "Kodas");
        $itemName = mysqli_result($result, $i, "Pavadinimas");
        $itemDate = mysqli_result($result, $i, "Gavimo_data");
        $itemType = mysqli_result($result, $i, "Tipas");
        $itemStatus = mysqli_result($result, $i, "Bukle");
        $itemPrice = mysqli_result($result, $i, "Kaina");
        $itemColor = mysqli_result($result, $i, "Spalva");
        $itemStorageID = mysqli_result($result, $i, "fk_PatalpaId");
        $q2 ="SELECT patalpa.Pavadinimas FROM patalpa WHERE patalpa.Id=$itemStorageID";
        $result2 = $database->query($q2);
        $itemStorage = mysqli_result($result2, '0', "Pavadinimas");*/
        echo "<tr><td>$DarbuotojoID</td><td>$DarbuotojoNumeris</td><td>$DarbuotojoGyvVieta</td><td>$DarbuotojoSutartPradz</td><td>$DarbuotojoSutartPab</td><td>$DarbuotojoPareig</td><td>$Pamaina</td><td>$AsmensKodas</td></tr>\n";
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
        <link href="css/styleadmin.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
          <header id='main_header'>
            <div class="container">
              <h1>Administraciojos valdymas</h1>
            </div>
          </header>
                    <?php include("include/administrationMeniu.php");
                    include("administration/darbuotojo_paieskos_forma.php");

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
