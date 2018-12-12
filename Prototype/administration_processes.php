<?php

include("include/session.php");

class ManagerProcess
{
  function ManagerProcess(){
  global $session;
  /* Make sure manager is accessing page */
  if (!$session->isAdminsitratorius()) {
      header("Location: index.php");
  }

  if (isset($_POST['prideti_asmeni'])) {
      $this->Prideti_asmeni();
  }

  if (isset($_POST['prideti_darbuotoja'])) {
      $this->Prideti_darbuotoja();
  }

  if (isset($_POST['redaguoti_darbuotoja'])) {
      $this->Redaguoti_darbuotoja();
  }

  if (isset($_POST['prideti_kalini'])) {
      $this->Prideti_kalini();
  }

  if (isset($_POST['redaguoti_kalini'])) {
      $this->Redaguoti_kalini();
  }

  if (isset($_POST['isduoti_prisijungima'])) {
      $this->Prideti_vartotoja();
  }

  if (isset($_POST['prideti_lankytoja'])) {
      $this->Prideti_lankytoja();
  }

    function Prideti_asmeni()
    {
      global $session, $database, $form;
      $AsmensKodas = $_POST['asmens_kodas'];
      $AsmensVardas = $_POST['vardas'];
      $AsmensPavarde = $_POST['pavarde'];

        $q = "INSERT INTO asmuo
               VALUES ('$AsmensKodas', '$AsmensVardas', '$AsmensPavarde')";
        $result = $database->query($q);
        header("Location: " . $session->referrer);
    }


    function Prideti_darbuotoja()
    {
      global $session, $database, $form;
      $DarbuotojoID = $_POST[''];
      $DarbuotojoNumeris = $_POST['darbuotojo_telefono_numeris'];
      $DarbuotojoGyvVieta = $_POST['darbuotojo_gyvenamoji_vieta'];
      $DarbuotojoSutartPradz = $_POST['sutarties_pradzia'];
      $DarbuotojoSutartPab = $_POST['sutarties_pabaiga'];
      $DarbuotojoPareig = $_POST['pareigos'];
      $Pamaina = $_POST['pamaina'];
      $AsmensKodas= $_POST['fk_Asmuoasmens_kodas'];

      $q = "INSERT INTO darbuotojas
             VALUES ('$DarbuotojoID', '$DarbuotojoNumeris', '$DarbuotojoGyvVieta','$DarbuotojoSutartPradz',
               '$DarbuotojoSutartPab','$DarbuotojoPareig','$Pamaina','$AsmensKodas')";
        $result = $database->query($q);
        header("Location: " . $session->referrer);
    }

function Redaguoti_darbuotoja()
{
  global $session, $database, $form;
  $DarbuotojoID = $_POST['tabelio_nr'];
  $DarbuotojoNumeris = $_POST['darbuotojo_telefono_numeris'];
  $DarbuotojoGyvVieta = $_POST['darbuotojo_gyvenamoji_vieta'];
  $DarbuotojoSutartPradz = $_POST['sutarties_pradzia'];
  $DarbuotojoSutartPab = $_POST['sutarties_pabaiga'];
  $DarbuotojoPareig = $_POST['pareigos'];
  $Pamaina = $_POST['pamaina'];
  $AsmensKodas= $_POST['fk_Asmuoasmens_kodas'];

  $q = "UPDATE darbuotojas SET  telefono_numeris = '$DarbuotojoNumeris',
  gyvenamoji_vieta = '$DarbuotojoGyvVieta', sutarties_pradzia = '$DarbuotojoSutartPradz',
  sutarties_pabaiga = '$DarbuotojoSutartPab', pareigos = '$DarbuotojoPareig', fk_Pamainapamainos_id = '$Pamaina',
  fk_Asmuoasmens_kodas = '$AsmensKodas' WHERE tabelio_nr ='$DarbuotojoID'";

    $result = $database->query($q);
    header("Location: " . $session->referrer);
}


    function Prideti_kalini()
    {
      global $session, $database, $form;
      $KalinioID = $_POST[''];
      $KalejimoPriezastis = $_POST['kalejimo_priezastis'];
      $KalejimoPradz = $_POST['kalejimo_pradzios_laikotarpis'];
      $KalejimoPab = $_POST['numatoma_paleidimo_data'];
      $KameraKodas = $_POST['fk_KameraKodas'];
      $AsmensKodas= $_POST['fk_Asmuoasmens_kodas'];

      $q = "INSERT INTO kalinys
               VALUES ('$KalinioID', '$KalejimoPriezastis', '$KalejimoPradz', '$KalejimoPab', '$KameraKodas', '$AsmensKodas')";

        $result = $database->query($q);
        header("Location: " . $session->referrer);
    }

    function Redaguoti_kalini()
    {
      global $session, $database, $form;
      $KalinioID = $_POST['kalinio_id'];
      $KalejimoPriezastis = $_POST['kalejimo_priezastis'];
      $KalejimoPradz = $_POST['kalejimo_pradzios_laikotarpis'];
      $KalejimoPab = $_POST['numatoma_paleidimo_data'];
      $KameraKodas = $_POST['fk_KameraKodas'];
      $AsmensKodas= $_POST['fk_Asmuoasmens_kodas'];

      $q = "UPDATE kalinys SET kalejimo_priezastis = '$KalejimoPriezastis', kalejimo_pradzios_laikotarpis = '$KalejimoPradz', numatoma_paleidimo_data = '$KalejimoPab', fk_KameraKodas = '$KameraKodas', fk_Asmuoasmens_kodas = '$AsmensKodas' WHERE kalinio_id = '$KalinioID'";

        $result = $database->query($q);
        header("Location: " . $session->referrer);
    }

    function Prideti_vartotoja()
    {
      global $session, $database, $form;
      $Vartotojoid = $session->generateRandStr(16);
      $VartotojoUsername = $_POST['username'];
      $VartotojoSlaptazodis = md5($_POST['password']);
      $VartotojoEmail = $_POST['email'];
      $VartotojoLevelis = $_POST['level'];
      $DarbuotojoID = $_POST['fk_Darbuotojastabelio_nr'];

        $q = "INSERT INTO vartotojai
               VALUES ('$Vartotojoid','$VartotojoUsername','$VartotojoSlaptazodis', '$VartotojoEmail', '$VartotojoLevelis', '$DarbuotojoID')";
        $result = $database->query($q);
        header("Location: " . $session->referrer);

    }

    function Prideti_lankytoja()
    {
      global $session, $database, $form;
      $LankytojoId = $_POST[''];
      $LankytojoTelNr = $_POST['lankytojo_telefono_numeris'];
      $LankytojoAdresas = $_POST['lankytojo_gyvenamoji_vieta'];
      $LankymoData = $_POST['lankymo_data'];
      $KalinioId = $_POST['fk_Kalinyskalinio_id'];
      $AsmensKodas = $_POST['fk_Asmuoasmens_kodas'];

        $q = "INSERT INTO lankytojas
               VALUES ('', '$LankytojoTelNr', '$LankytojoAdresas', '$LankymoData', '$KalinioId', '$AsmensKodas')";
        $result = $database->query($q);
        header("Location: " . $session->referrer);
    }

    function mysqli_result($res, $row, $field=0)
    {
      $res->data_seek($row);
      $datarow = $res->fetch_array();
      return $datarow[$field];
    }
}
  /* Initialize process */
  $managerprocces = new ManagerProcess();
?>
