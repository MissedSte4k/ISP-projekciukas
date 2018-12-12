<?php
if (isset($sucs) && isset($form) && isset($session) && $session->logged_in) {
  function getStorages(){
    global $database;
    $q = "SELECT * "
            . "FROM patalpa";
    $result = $database->query($q);
    $num_rows = mysqli_num_rows($result);
    for ($i = 0; $i < $num_rows; $i++)
        {
         $storageID = mysqli_result($result, $i, "Id");
         $storageName = mysqli_result($result, $i, "Pavadinimas");
         echo"<option value=\"$storageID\">$storageName</option>";
       }
     }
?>
<div class="header_new_item">
    <h2>Naujo daikto registravimo forma</h2>
  </div>
  <form method="POST" action="inventory_process.php" name="new_item_form">
    <?php echo $sucs->msg("msg"); ?>
    <div class="new-item-group">
      <label>Pavadinimas</label>
      <input type="text" name="pavadinimas" value="<?php echo $form->value("pavadinimas"); ?>"/>
        <?php echo $form->error("pavadinimas");?>
    </div>
    <div class="new-item-group">
      <label>Tipas</label>
      <select type="text" name="tipas" text-align="right">
        <option value="">------------------------</option>
        <option value="Buitine technika">Buitinė technika</option>
        <option value="Ginklai">Ginklai</option>
        <option value="Baldai">Baldai</option>
        <option value="Virtuves irankiai">Virtuvės įrankiai</option>
        <option value="Stalo irankiai">Stalo įrankiai</option>
        <option value="Buities irankiai">Buities įrankiai</option>
      </select>
      <?php echo $form->error("tipas");?>
    </div>
    <div class="new-item-group">
      <label>Būklė</label>
      <select type="text" name="bukle" text-align="right">
        <option value="">------------------------</option>
        <option value="Puiki">Puiki</option>
        <option value="Gera">Gera</option>
        <option value="Patenkinama">Patenkinama</option>
        <option value="Sugadintas(-a)">Sugadintas(-a)</option>
        <option value="Taisytas(-a)">Taisytas(-a)</option>
      </select>
      <?php echo $form->error("bukle");?>
    </div>
    <div class="new-item-group">
      <label>Gavimo data</label>
      <input type="date" name="gavimo_data" value="<?php echo $form->value("gavimo_data");?>"/>
      <?php echo $form->error("gavimo_data");?>
    </div>
    <div class="new-item-group">
      <label>Kaina</label>
      <input type="number" min="0.00" max="1000000.00" step="0.01" name="kaina"/>
      <?php echo $form->error("kaina");?>
    </div>
    <div class="new-item-group">
      <label>Spalva</label>
      <input type="text" name="spalva" value="<?php echo $form->value("spalva"); ?>"/>
      <?php echo $form->error("spalva");?>
    </div>
    <div class="new-item-group">
      <label>Patalpa</label>
      <select type="text" name="patalpa" text-align="right">
      <option value="">------------------------</option>
      <?php getStorages(); ?>
      </select>
      <?php echo $form->error("patalpa");?>
    </div>
    <div class="new-item-group">
      <input type="hidden" name="subnewitem" value="1"/>
      <button type="submit" name="prideti" class="btn">Pridėti!</button>
    </div>
  </form>
<?php
}
?>
