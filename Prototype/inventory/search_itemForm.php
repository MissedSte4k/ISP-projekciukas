<?php
if (isset($form) && isset($session) && $session->logged_in) {

?>
  <div class="header_new_item">
    <h2>Daikto paieškos forma</h2>
  </div>

  <form method="POST" action="search_item.php" name="new_item_form">
    <div class="new-item-group">
      <label>Tipas</label>
      <select type="text" name="tipas">
        <option value="">Pasirinkite tipą</option>
        <option value="">Rodyti visus</option>
      </select>
    </div>
    <div class="new-item-group">
      <label>Būklė</label>
      <select data-filter="bukle">
        <option value="">Pasirinkite būklę</option>
        <option value="">Rodyti visas</option>
      </select>
    </div>
    <div class="new-item-group">
      <label>Gavimo d.</label>
      <select data-filter="gavimo_data">
        <option value="">Pasirinkite datą</option>
        <option value="">Rodyti visas</option>
      </select>
    </div>
    <div class="new-item-group">
      <label>Kaina</label>
      <select data-filter="kaina">
        <option value="">Pasirinkite kainą</option>
        <option value="">Rodyti visas</option>
      </select>
    </div>
    <div class="new-item-group">
      <label>Spalva</label>
      <select data-filter="spalva">
        <option value="">Pasirinkite spalvą</option>
        <option value="">Rodyti visas</option>
      </select>
    </div>
    <div class="new-item-group">
      <label>Patalpa</label>
      <select data-filter="patalpa">
        <option value="">Pasirinkite patalpą</option>
        <option value="">Rodyti visas</option>
      </select>
    </div>
    <br>
    <div class="new-item-group">
      <button type="submit" name="ieskoti" class="btn" onclick='search();'>Ieškoti!</button>
    </div>
    </form>
<?php } ?>
