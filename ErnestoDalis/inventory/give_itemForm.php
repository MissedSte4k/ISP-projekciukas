<?php
if (isset($form) && isset($session) && $session->logged_in) {

  function getWorkers()
  {
    global $database;
    $q = "SELECT darbuotojas.tabelio_nr as tabelio_nr, asmuo.Vardas as vardas, asmuo.Pavarde as pavarde "
            . "FROM darbuotojas, asmuo WHERE darbuotojas.fk_Asmuoasmens_kodas = asmuo.asmens_kodas";
    $result = $database->query($q);
    $num_rows = mysqli_num_rows($result);
    for ($i = 0; $i < $num_rows; $i++)
        {
          $workerID = mysqli_result($result, $i, "tabelio_nr");
          $workerName = mysqli_result($result, $i, "vardas");
          $workerNickName = mysqli_result($result, $i, "pavarde");
          echo"<option value=\"$workerID\">$workerName $workerNickName</option>";
       }
  }

  function getItems()
  {
    global $database;
    $q = "SELECT daiktas.Kodas, daiktas.Pavadinimas "
            . "FROM daiktas";
    $result = $database->query($q);
    $num_rows = mysqli_num_rows($result);
    for ($i = 0; $i < $num_rows; $i++)
        {
         $itemID = mysqli_result($result, $i, "Kodas");
         $itemName = mysqli_result($result, $i, "Pavadinimas");
         echo"<option value=\"$itemID\">$itemName-$itemID</option>";
       }
  }
?>
  <div class="header_new_item">
    <h2>Daikto išdavimo forma</h2>
  </div>
  <form method="post" action="inventory_process.php" name="new_item_form">
    <?php echo $sucs->msg("msg"); ?>
    <div class="new-item-group">
      <label>Išdavimo nr.</label>
      <input type="number" min="1" max= "1000000" name="registracijos_nr"/>
    </div>
    <?php echo $form->error("registracijos_nr");?>
    <div class="new-item-group">
      <label>Darbuotojas</label>
      <select type="text" name="darbuotojas">
        <option value="">------------------------</option>
        <?php getWorkers(); ?>
      </select>
    <?php echo $form->error("darbuotojas");?>
    </div>
    <div class="new-item-group">
      <label>Daiktas</label>
      <select type="text" name="kodas">
        <option value="">------------------------</option>
        <?php getItems(); ?>
      </select>
    <?php echo $form->error("kodas");?>
  </div>
    <div class="new-item-group">
      <label>Išdavimo d.</label>
      <input type="date" name="isdavimo_d"/>
    </div>
    <?php echo $form->error("isdavimo_d");?>
    <div class="new-item-group">
      <label>Pridavimo d.</label>
      <input type="date" name="pridavimo_d"/>
    </div>
    <div class="new-item-group">
      <input type="hidden" name="subgiveitem" value="1"/>
      <button type="submit" name="isduoti" class="btn">Išduoti!</button>
    </div>
  </form>
<?php  }?>
