<?php
if (isset($form) && isset($session) && $session->logged_in) {
  function getItemsCodes()
  {
    global $database;
    $q = "SELECT daiktas.Kodas "
            . "FROM daiktas";
    $result = $database->query($q);
    $num_rows = mysqli_num_rows($result);
    for ($i = 0; $i < $num_rows; $i++)
        {
         $itemID = mysqli_result($result, $i, "Kodas");
         echo"<option value=\"$itemID\">$itemID</option>";
       }
  }
?>
<div class="header_new_item">
    <h2>Daikto šalinimas</h2>
  </div>
  <form method="POST" action="inventory_process.php" name="new_item_form">
    <div class="new-item-group">
      <label>Kodas</label>
      <select type="text" name="kodas">
        <option value="">------------------------</option>
        <?php getItemsCodes();?>
      </select>
    <?php echo $form->error("kodas");?>
    </div>
    <div class="new-item-group">
      <input type="hidden" name="subremoveitem" value="1"/>
      <button type="submit" name="redaguoti" class="btn">Šalinti!</button>
    </div>
  </form>
<?php } ?>
