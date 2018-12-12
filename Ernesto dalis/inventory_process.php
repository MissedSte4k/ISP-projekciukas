<?php

include("include/session.php");

class ManagerProcess
{
  function ManagerProcess(){
  global $session;
  /* Make sure manager is accessing page */
  if (!$session->isInventoriausValdytojas()) {
      header("Location: index.php");
  }
  /* Manager submitted  */
  if (isset($_POST['subnewitem'])) {
      $this->addItem();
  }

  /* Manager submitted  */
  if (isset($_POST['subedititem'])) {
      $this->editItem();
  }

  /* Manager submitted  */
  if (isset($_POST['subremoveitem'])) {
      $this->removeItem();
  }

  /* Manager submitted  */
  if (isset($_POST['subgiveitem'])) {
      $this->giveItem();
  }

}

    function addItem()
    {
      global $session, $database, $form, $sucs;
      $itemName = $_POST['pavadinimas'];
      $itemType = $_POST['tipas'];
      $itemStatus = $_POST['bukle'];
      $itemDate = $_POST['gavimo_data'];
      $itemPrice = $_POST['kaina'];
      $itemColor =  $_POST['spalva'];
      $itemSotrage = $_POST['patalpa'];
      $errors = $this->checkNewItemInput($itemName, $itemType, $itemStatus, $itemDate, $itemPrice, $itemColor,
                                  $itemSotrage);
      if($errors > 0)
      {

        $_SESSION['value_array'] = $_POST;
        $_SESSION['error_array'] = $form->getErrorArray();
        header("Location: " . $session->referrer);
      }

      else{
        $field="msg";
        $sucs->setMsg($field, "Registracija sėkminga!");
        $_SESSION['msg_array'] = $sucs->getMsgArray();
        $q = "INSERT INTO daiktas
               VALUES ('$itemName', '', '$itemDate', '$itemPrice', '$itemColor',
                      '$itemType', '$itemStatus', '$itemSotrage')";
        $result = $database->query($q);
        header("Location: " . $session->referrer);
      }
    }

    function checkNewItemInput($itemName, $itemType, $itemStatus, $itemDate, $itemPrice, $itemColor, $itemSotrage)
    {
      global $form;
      $field = "pavadinimas";
      if (!$itemName || strlen($itemName = trim($itemName)) == 0) {
        $form->setError($field, "* Neįvestas daikto pavadinimas");
      }
      else
      {
        $itemName  = stripslashes($itemName);
        if (strlen($itemName) < 4) {
            $form->setError($field, "* Daikto pavadinimas turi turėti nemažiau kaip 4 simbolius");
        }
        else if (strlen($itemName) > 20) {
            $form->setError($field, "* Daikto pavadinimas virš 20 simbolių");
        }
      }
      $field = "tipas";
      if (!$itemType || strlen($itemType = trim($itemType)) == 0) {
        $form->setError($field, "* Neįvestas daikto tipas");
      }
      $field = "bukle";
      if (!$itemStatus || strlen($itemStatus = trim($itemStatus)) == 0) {
        $form->setError($field, "* Neįvesta daikto būklė");
      }
      $field = "gavimo_data";
      if (!$itemDate || strlen($itemDate = trim($itemDate)) == 0 || $itemDate =="0000-00-00") {
        $form->setError($field, "* Neįvesta gavimo data");
      }

      $field = "kaina";
      if (!$itemPrice || strlen($itemPrice = trim($itemPrice)) == 0) {
        $form->setError($field, "* Neįvesta daikto kaina");
      }

      $field = "patalpa";
      if (!$itemSotrage || strlen($itemSotrage = trim($itemSotrage)) == 0) {
        $form->setError($field, "* Nepasirinkta patalpa, kurioje bus daiktas");
      }
      return $form->num_errors;
    }

    function editItem()
    {
      global $session, $database, $form, $sucs;
      $itemID = $_POST['kodas'];
      $itemName = $_POST['pavadinimas'];
      $itemType = $_POST['tipas'];
      $itemStatus = $_POST['bukle'];
      $itemDate = $_POST['gavimo_data'];
      $itemPrice = $_POST['kaina'];
      $itemColor =  $_POST['spalva'];
      $itemSotrage = $_POST['patalpa'];
      $errors = $this->checkEditItemInput($itemID, $itemName, $itemType, $itemStatus, $itemDate, $itemPrice, $itemColor,
                                  $itemSotrage);
      if($errors > 0)
      {

        $_SESSION['value_array'] = $_POST;
        $_SESSION['error_array'] = $form->getErrorArray();
        header("Location: " . $session->referrer);
      }

      else{
        $field="msg";
        $sucs->setMsg($field, "Redagavimas atliktas!");
        $_SESSION['msg_array'] = $sucs->getMsgArray();
        $q = "UPDATE daiktas SET Pavadinimas = '$itemName', Gavimo_data='$itemDate',
              Kaina='$itemPrice', Spalva = '$itemColor', Tipas = '$itemType',
              Bukle = '$itemStatus', fk_PatalpaId = '$itemSotrage' WHERE Kodas = '$itemID'";
        $result = $database->query($q);
        header("Location: " . $session->referrer);
      }
    }

    function checkEditItemInput($itemID, $itemName, $itemType, $itemStatus, $itemDate, $itemPrice, $itemColor, $itemSotrage)
    {
      global $form;
      $field = "kodas";
      if (!$itemID || strlen($itemID = trim($itemID)) == 0) {
        $form->setError($field, "* Neįvestas daikto kodas");
      }
      $field = "pavadinimas";
      if (!$itemName || strlen($itemName = trim($itemName)) == 0) {
        $form->setError($field, "* Neįvestas daikto pavadinimas");
      }
      else
      {
        $itemName  = stripslashes($itemName);
        if (strlen($itemName) < 4) {
            $form->setError($field, "* Daikto pavadinimas turi turėti nemažiau kaip 4 simbolius");
        }
        else if (strlen($itemName) > 20) {
            $form->setError($field, "* Daikto pavadinimas virš 20 simbolių");
        }
      }
      $field = "tipas";
      if (!$itemType || strlen($itemType = trim($itemType)) == 0) {
        $form->setError($field, "* Neįvestas daikto tipas");
      }
      $field = "bukle";
      if (!$itemStatus || strlen($itemStatus = trim($itemStatus)) == 0) {
        $form->setError($field, "* Neįvesta daikto būklė");
      }
      $field = "gavimo_data";
      if (!$itemDate || strlen($itemDate = trim($itemDate)) == 0 || $itemDate =="0000-00-00") {
        $form->setError($field, "* Neįvesta gavimo data");
      }

      $field = "kaina";
      if (!$itemPrice || strlen($itemPrice = trim($itemPrice)) == 0) {
        $form->setError($field, "* Neįvesta daikto kaina");
      }

      $field = "patalpa";
      if (!$itemSotrage || strlen($itemSotrage = trim($itemSotrage)) == 0) {
        $form->setError($field, "* Nepasirinkta patalpa, kurioje bus daiktas");
      }
      return $form->num_errors;
    }

    function removeItem()
    {
      global $session, $form, $database, $sucs;
      $itemID = $_POST['kodas'];
      $errors = $this->checkRemoveItemInput($itemID);
      if($errors > 0)
      {

        $_SESSION['value_array'] = $_POST;
        $_SESSION['error_array'] = $form->getErrorArray();
        header("Location: " . $session->referrer);
      }

      else{
        $field="msg";
        $sucs->setMsg($field, "Daiktas pašalintas!");
        $_SESSION['msg_array'] = $sucs->getMsgArray();
        $q = "DELETE FROM daiktas WHERE daiktas.Kodas = '$itemID'";
        $result = $database->query($q);
        header("Location: " . $session->referrer);
      }
    }

    function checkRemoveItemInput($itemID)
    {
      global $form;
      $field = "kodas";
      if (!$itemID || strlen($itemID = trim($itemID)) == 0) {
        $form->setError($field, "* Neįvestas daikto kodas");
      }
      return $form->num_errors;
    }

    function giveItem()
    {
      global $session, $form, $database, $sucs;
      $registrationCode = $_POST['registracijos_nr'];
      //var_dump($registrationCode);
      //die();
      $workerID = $_POST['darbuotojas'];
      $itemID = $_POST['kodas'];
      $givingDate = $_POST['isdavimo_d'];
      $receivingDate = $_POST['pridavimo_d'];
      $errors = $this->checkGivingItemInput($itemID, $registrationCode, $workerID, $givingDate, $receivingDate);
      if($errors > 0)
      {

        $_SESSION['value_array'] = $_POST;
        $_SESSION['error_array'] = $form->getErrorArray();
        header("Location: " . $session->referrer);
      }

      else{
        $field="msg";
        $sucs->setMsg($field, "Daikto išdavimas užregistruotas!");
        $_SESSION['msg_array'] = $sucs->getMsgArray();
        $q = "INSERT INTO registracija
               VALUES ('$registrationCode', '', '$givingDate', '$receivingDate', '$itemID',
                      '$workerID')";
        $result = $database->query($q);
        header("Location: " . $session->referrer);
      }
    }

    function checkGivingItemInput($itemID, $registrationCode, $workerID, $givingDate, $receivingDate)
    {
      global $form, $database;
      $field = "kodas";
      if (!$itemID || strlen($itemID = trim($itemID)) == 0) {
        $form->setError($field, "* Neįvestas daikto kodas");
      }
      $field = "registracijos_nr";
      if (!$registrationCode || strlen($registrationCode = trim($registrationCode)) == 0) {
        $form->setError($field, "* Neįvestas išdavimo kodas");
      }
      $field = "darbuotojas";
        if (!$workerID || strlen($workerID = trim($workerID)) == 0) {
          $form->setError($field, "* Nepasirinktas darbuotojas");
      }

      $field = "isdavimo_d";
        if (!$givingDate || strlen($givingDate = trim($givingDate)) == 0 || $givingDate == "00-00-0000") {
          $form->setError($field, "* Nepasirinkta išdavimo data");
      }

      $q = "SELECT * "
              . "FROM registracija WHERE registracija.Pridavimo_d = '0000-00-00'
                  AND registracija.fk_DaiktasKodas = $itemID";

      $result = $database->query($q);
      $num_rows = mysqli_num_rows($result);
      if($num_rows > 0)
      {
        $field = "kodas";
        $form->setError($field, "* Šis daiktas dar negrąžintas.");
      }

      return $form->num_errors;
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
