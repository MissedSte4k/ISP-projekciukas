<?php
if (isset($form) && isset($session) && $session->logged_in) {
  function getTabelioNr()
  {
    global $database;
    $q = "SELECT darbuotojas.tabelio_nr "
            . "FROM darbuotojas";
    $result = $database->query($q);
    $num_rows = mysqli_num_rows($result);
    for ($i = 0; $i < $num_rows; $i++)
        {
         $itemID = mysqli_result($result, $i, "tabelio_nr");
         echo"<option value=\"$itemID\">$itemID</option>";
       }
  }
?>
<div class="formos_header">
  <h2>Prisijungimo išdavimo forma</h2>
</div>
      <form method="POST"  action="administration_processes.php" method="prisijungimo_isdavimo_forma">
        <div class="lauku_forma">
          <label>Tabelis:</label>
          <select type="text" name="fk_Darbuotojastabelio_nr" text-align="right">
            <option value="">------------------------</option>
            <?php getTabelioNr(); ?>
          </select>
          <?php echo $form->error("fk_Darbuotojastabelio_nr");?>
        </div>
        <div style="line-height:6px;">
            <br>
        </div>
        </div>
        <div class="lauku_forma">
          <label>Prisijungimo vardas:</label>
          <input type="text" placeholder="Įveskite prisijungimo vardą" name="username">
        </div>
        <div class="lauku_forma">
          <label>Slaptažodis:</label>
          <input type="text" placeholder="Įveskite slaptažodį" name="password">
        </div>
        <div class="lauku_forma">
          <label>El. paštas: </label>
          <input type="text" placeholder="Įveskite elektroninio pašto adresą" name="email">
        </div>

        <div class="lauku_forma">
          <label>Preigos: </label>
          <select type="text" name="level" text-align="right">
        <option value="">------------------------</option>
        <option value="1">Administracijos valdymas</option>
        <option value="2">Inventoriaus valdymas</option>
        <option value="3">Centrinio Pulto valdymas</option>

        </select>
        <?php echo $form->error("level");?>
        </div>
        <div style="line-height:6px;">
            <br>
        </div>

        <div class="lauku_forma">
        <input type="hidden" name="isduoti_prisijungima" value="1"/>
      <button type="submit" name="prideti" class="registerbtn">Registruoti</button>
    </div>
      </form>
<?php } ?>
