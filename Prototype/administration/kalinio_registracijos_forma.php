<?php
if (isset($form) && isset($session) && $session->logged_in) {
  function getKamera(){
    global $database;
    $q = "SELECT * "
            . "FROM kameros";
    $result = $database->query($q);
    $num_rows = mysqli_num_rows($result);
    for ($i = 0; $i < $num_rows; $i++)
        {
         $kamerosID = mysqli_result($result, $i, "Kodas");

         echo"<option value=\"$kamerosID\">$kamerosID</option>";
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
  <h2>Kalinio registraciojos forma</h2>
</div>
      <form method="POST"  action="administration_processes.php" method="kalinio_registracijos_forma">

        <div class="lauku_forma">
          <label>Kalėjimo priežastis:</label>
          <input type="text" placeholder="Įveskite priežastį" name="kalejimo_priezastis">
        </div>
        <div class="lauku_forma">
          <label>Kalėjimo pradžia:</label>
          <input type="date" name="kalejimo_pradzios_laikotarpis">
        </div>
        <div class="lauku_forma">
          <label>Numatoma paleidimo data:</label>
          <input type="date" name="numatoma_paleidimo_data">
        </div>
        <div class="lauku_forma">
          <label>Kamera:</label>
          <select type="text" name="fk_KameraKodas" text-align="right">
            <option value="">------------------------</option>
            <?php getKamera(); ?>
          </select>
          <?php echo $form->error("fk_KameraKodas");?>
        </div>
        <div style="line-height:6px;">
            <br>
        </div>
        <div class="lauku_forma">
          <label>Asmuo:</label>
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
        <input type="hidden" name="prideti_kalini" value="1"/>
      <button type="submit" name="prideti" class="registerbtn">Registruoti</button>
    </div>
</form>
<?php } ?>
