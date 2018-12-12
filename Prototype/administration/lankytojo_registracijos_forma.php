<?php
if (isset($form) && isset($session) && $session->logged_in) {
  function getKalinioID()
  {
    global $database;
    $q = "SELECT kalinys.kalinio_id "
            . "FROM kalinys";
    $result = $database->query($q);
    $num_rows = mysqli_num_rows($result);
    for ($i = 0; $i < $num_rows; $i++)
        {
         $itemID = mysqli_result($result, $i, "kalinio_id");
         echo"<option value=\"$itemID\">$itemID</option>";
       }
  }

     function getAsmuo(){
       global $database;
       $q = "SELECT * "
               . "FROM asmuo";
       $result = $database->query($q);
       $num_rows = mysqli_num_rows($result);
       for ($i = 0; $i < $num_rows; $i++)
           {
            $asmensID = mysqli_result($result, $i, "asmens_kodas");
            $asmensName = mysqli_result($result, $i, "vardas");
            echo"<option value=\"$asmensID\">$asmensID, $asmensName</option>";
          }
        }
?>

<div class="formos_header">
  <h2>Lankytojo registraciojos forma</h2>
</div>
      <form method="POST"  action="administration_processes.php" method="lankytojo_registracijos_forma">
        <div class="lauku_forma">
          <label>Lankytojas: </label>
          <select type="text" name="fk_Asmuoasmens_kodas" text-align="right">
            <option value="">------------------------</option>
            <?php getAsmuo(); ?>
          </select>
          <?php echo $form->error("fk_Asmuoasmens_kodas");?>
        </div>
        <div style="line-height:6px;">
            <br>
        </div>
        <div class="lauku_forma">
          <label>Telefono numeris: </label>
          <input type="text" placeholder="Įveskite telefono numerį" name="lankytojo_telefono_numeris">
        </div>
        <div class="lauku_forma">
          <label>Adresas:</label>
          <input type="text" placeholder="Įveskite lankytojo adresą" name="lankytojo_gyvenamoji_vieta">
        </div>
        <div class="lauku_forma">
          <label>Lankymo data:</label>
          <input type="date" name="lankymo_data">
        </div>
        <div class="lauku_forma">
          <label>Kalinys:</label>
          <select type="text" name="fk_Kalinyskalinio_id" text-align="right">
            <option value="">------------------------</option>
            <?php getKalinioID(); ?>
          </select>
          <?php echo $form->error("fk_Kalinyskalinio_id");?>
        </div>
        <div style="line-height:6px;">
            <br>
        </div>
        <div class="lauku_forma">
        <input type="hidden" name="prideti_lankytoja" value="1"/>
      <button type="submit" name="prideti" class="registerbtn">Registruoti</button>
    </div>
</form>
<?php } ?>
