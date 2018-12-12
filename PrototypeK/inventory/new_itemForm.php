<?php
if (isset($form) && isset($session) && $session->logged_in) {
?>
<div class="header_new_item">
    <h2>Naujo daikto registravimo forma</h2>
  </div>

  <form method="post" action="new_item.php" name="new_item_form">
    <div class="new-item-group">
      <label>Pavadinimas</label>
      <input type="text" name="pavadinimas">
    </div>
    <div class="new-item-group">
      <label>Tipas</label>
      <input type="text" name="tipas">
    </div>
    <div class="new-item-group">
      <label>Būklė</label>
      <input type="text" name="bukle">
    </div>
    <div class="new-item-group">
      <label>Gavimo data</label>
      <input type="datetime-local" name="gavimo_data">
    </div>
    <div class="new-item-group">
      <label>Kaina</label>
      <input type="number" min="0.00" max="1000000.00" step="0.01" name="kaina">
    </div>
    <div class="new-item-group">
      <label>Spalva</label>
      <input type="text" name="spalva">
    </div>
    <div class="new-item-group">
      <label>Patalpa</label>
      <input type="text" name="patalpa">
    </div>
    <div class="new-item-group">
      <button type="submit" name="prideti" class="btn">Pridėti!</button>
    </div>
  </form>
<?php } ?>
