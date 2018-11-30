<?php
if (isset($form) && isset($session) && $session->logged_in) {
?>
  <form method="post" action="remove_item.php" name="new_item_form">
    <div class="new-item-group">
      <label>Kodas</label>
      <input type="text" name="kodas">
    </div>
    <div class="new-item-group">
      <button type="submit" name="redaguoti" class="btn">Šalinti!</button>
    </div>
  </form>
<?php } ?>
