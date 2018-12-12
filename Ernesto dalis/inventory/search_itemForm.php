<?php
if (isset($form) && isset($session) && $session->logged_in) {
  function getDates(){
    global $database;
    $q = "SELECT daiktas.Gavimo_data "
            . "FROM daiktas GROUP BY daiktas.Gavimo_data DESC";
    $result = $database->query($q);
    $num_rows = mysqli_num_rows($result);

    for ($i = 0; $i < $num_rows; $i++)
        {
         $date = mysqli_result($result, $i, "Gavimo_data");
         echo"<option value=\"$date\">$date</option>";
       }
     }

     function getColors(){
       global $database;
       $q = "SELECT daiktas.Spalva "
               . "FROM daiktas WHERE daiktas.Spalva!='' GROUP BY daiktas.Spalva";
       $result = $database->query($q);
       $num_rows = mysqli_num_rows($result);
       for ($i = 0; $i < $num_rows; $i++)
           {
            $color = mysqli_result($result, $i, "Spalva");
            echo"<option value=\"$color\">$color</option>";
          }
        }

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
    <h2>Daikto paieškos forma</h2>
  </div>
  <form method="POST" action="search_item.php" name="new_item_form">
    <div class="new-item-group">
      <label>Tipas</label>
      <select type="text" name="tipas">
        <option value="">Pasirinkite tipą</option>
        <option value="">Rodyti visus</option>
        <option value="Buitine technika">Buitine technika</option>
        <option value="Ginklai">Ginklai</option>
        <option value="Baldai">Baldai</option>
        <option value="Virtuves irankiai">Virtuves irankiai</option>
        <option value="Stalo irankiai">Stalo irankiai</option>
        <option value="Buities irankiai">Buities irankiai</option>
      </select>
    </div>
    <div class="new-item-group">
      <label>Būklė</label>
      <select name="bukle">
        <option value="">Pasirinkite būklę</option>
        <option value="">Rodyti visas</option>
        <option value="Puiki">Puiki</option>
        <option value="Gera">Gera</option>
        <option value="Patenkinama">Patenkinama</option>
        <option value="Sugadintas(-a)">Sugadintas(-a)</option>
        <option value="Taisytas(-a)">Taisytas(-a)</option>
      </select>
    </div>
    <div class="new-item-group">
      <label>Gavimo d.</label>
      <select name="gavimo_data">
        <option value="">Pasirinkite datą</option>
        <option value="">Rodyti visas</option>
          <?php getDates(); ?>
      </select>
    </div>
    <div class="new-item-group">
      <label>Kaina</label>
      <select name="kaina">
        <option value="">Pasirinkite kainą</option>
        <option value="">Rodyti visas</option>
        <option value="0-10">0-10$</option>
        <option value="10-50">10-50$</option>
        <option value="50-100">50-100$</option>
        <option value=">100">>100$</option>
      </select>
    </div>
    <div class="new-item-group">
      <label>Spalva</label>
      <select name="spalva">
        <option value="">Pasirinkite spalvą</option>
        <option value="">Rodyti visas</option>
        <?php getColors(); ?>
      </select>
    </div>
    <div class="new-item-group">
      <label>Patalpa</label>
      <select name="patalpa">
        <option value="">Pasirinkite patalpą</option>
        <option value="">Rodyti visas</option>
        <?php getStorages(); ?>
      </select>
    </div>
    <br>
    <div class="new-item-group">
      <button type="submit" name="ieskoti" class="btn" onclick='search();'>Ieškoti!</button>
    </div>
    </form>
<?php } ?>
