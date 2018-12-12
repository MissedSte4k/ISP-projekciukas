<?php
if (isset($form) && isset($session) && $session->logged_in) {
  function getPamaina(){
    global $database;
    $q = "SELECT * "
            . "FROM pamaina";
    $result = $database->query($q);
    $num_rows = mysqli_num_rows($result);
    for ($i = 0; $i < $num_rows; $i++)
        {
         $pamainosID = mysqli_result($result, $i, "pamainos_id");
         $pamainosName = mysqli_result($result, $i, "pavadinimas");
         echo"<option value=\"$pamainosID\">$pamainosID</option>";
       }
     }

     function getDatesPr(){
       global $database;
       $q = "SELECT darbuotojas.sutarties_pradzia "
               . "FROM darbuotojas GROUP BY darbuotojas.sutarties_pradzia DESC";
       $result = $database->query($q);
       $num_rows = mysqli_num_rows($result);

       for ($i = 0; $i < $num_rows; $i++)
           {
            $date = mysqli_result($result, $i, "sutarties_pradzia");
            echo"<option value=\"$date\">$date</option>";
          }
        }

        function getDatesPb(){
          global $database;
          $q = "SELECT darbuotojas.sutarties_pabaiga "
                  . "FROM darbuotojas GROUP BY darbuotojas.sutarties_pabaiga DESC";
          $result = $database->query($q);
          $num_rows = mysqli_num_rows($result);

          for ($i = 0; $i < $num_rows; $i++)
              {
               $date = mysqli_result($result, $i, "sutarties_pabaiga");
               echo"<option value=\"$date\">$date</option>";
             }
           }
?>


<div class="formos_header">
  <h2>Darbuotojo paieškos forma</h2>
</div>
<form method="POST"  action="darbuotojo_paieska.php" method="darbuotojo_paieskos_forma">

  <div class="lauku_forma">
    <label>Darbo sutarties pradžia:</label>
    <select type="text" name="sutarties_pradzia" text-align="right">
      <option value="">------------------------</option>
      <?php getDatesPr(); ?>
    </select>
    <?php echo $form->error("sutarties_pradzia");?>
  </div>
  <div style="line-height:6px;">
      <br>
  </div>


  <div class="lauku_forma">
    <label>Darbo sutarties pabaiga:</label>
    <select type="text" name="sutarties_pabaiga" text-align="right">
      <option value="">------------------------</option>
      <?php getDatesPb(); ?>
    </select>
    <?php echo $form->error("sutarties_pabaiga");?>
  </div>
  <div style="line-height:6px;">
      <br>
  </div>
  <div class="lauku_forma">
    <label>Pamaina:</label>
    <select type="text" name="pamaina" text-align="right">
      <option value="">------------------------</option>
      <?php getPamaina(); ?>
    </select>
    <?php echo $form->error("pamaina");?>
  </div>
  <div style="line-height:6px;">
      <br>
  </div>
        <div class="lauku_forma">
          <label>Preigos: </label>
          <select type="text" name="pareigos" text-align="right">
        <option value="">------------------------</option>
        <option value="1">Pareiga A</option>
        <option value="2">Pareiga B</option>
        <option value="3">Pareiga C</option>
        <option value="4">Pareiga D</option>
        <option value="5">Pareiga E</option>
      </select>
      <?php echo $form->error("pareigos");?>
        </div>
        <div style="line-height:6px;">
            <br>
        </div>
        <div class="lauku_forma">
        <input type="hidden" name="ieskoti_darbuotojo" value="1"/>
      <button type="submit" name="prideti" class="registerbtn">Registruoti</button>
    </div>
</form>
<?php
}
?>
