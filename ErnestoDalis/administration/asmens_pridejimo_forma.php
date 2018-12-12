<?php
if (isset($form) && isset($session) && $session->logged_in) {
  function getStorages(){
    global $database;
    $q = "SELECT * "
            . "FROM asmuo";
    $result = $database->query($q);
    $num_rows = mysqli_num_rows($result);
    for ($i = 0; $i < $num_rows; $i++)
        {
         $storageID = mysqli_result($result, $i, "Id");
         $storageName = mysqli_result($result, $i, "vardas");
         echo"<option value=\"$storageID\">$storageName</option>";
       }
     }
?>
<div class="formos_header">
  <h2>Asmens pridejimo forma</h2>
</div>
      <form method="POST"  action="administration_processes.php" method="asmens_pridejimo_forma">
        <div class="lauku_forma">
          <label>Asmens kodas:</label>
          <input type="text" placeholder="Įveskite asmens kodą" name="asmens_kodas">
        </div>
        <div class="lauku_forma">
          <label>Vardas:</label>
          <input type="text" placeholder="Įveskite vardą" name="vardas" >
        </div>
        <div class="lauku_forma">
          <label>Pavardė:</label>
          <input type="text" placeholder="Įveskite pavardę" name="pavarde">
        </div>
        <div class="lauku_forma">
        <input type="hidden" name="prideti_asmeni" value="1"/>
      <button type="submit" name="prideti" class="registerbtn">Registruoti</button>
    </div>
      </form>
      <?php
      }
      ?>
