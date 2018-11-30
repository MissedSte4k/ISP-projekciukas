
  <div class="header_new_item">
    <h2>Daikto išdavimo forma</h2>
  </div>
  <form method="post" action="give_item.php" name="new_item_form">
    <div class="new-item-group">
      <label>Darbuotojas</label>
      <input type="text" name="darbuotojas">
    </div>
    <div class="new-item-group">
      <label>Daiktas</label>
      <input type="text" name="daiktas">
    </div>
    <div class="new-item-group">
      <label>Išdavimo data</label>
      <input type="datetime-local" name="isdavimo_d">
    </div>
    <div class="new-item-group">
      <label>Pridavimo data</label>
      <input type="datetime-local" name="pridavimo_d">
    </div>
    <div class="new-item-group">
      <button type="submit" name="isduoti" class="btn">Išduoti!</button>
    </div>
  </form>
