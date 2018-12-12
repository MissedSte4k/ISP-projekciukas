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
  <h2>Darbuotojo registraciojos forma</h2>
</div>
<form method="POST"  action="administration_processes.php" method="darbuotojo_paieskos_forma">

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
    <label>Telefono numeris: </label>
    <input type="text" placeholder="Įveskite telefono numerį" name="darbuotojo_telefono_numeris">
  </div>
  <div class="lauku_forma">
    <label>Adresas:</label>
    <input type="text" placeholder="Įveskite darbuotojo adresą" name="darbuotojo_gyvenamoji_vieta">
  </div>
  <div class="lauku_forma">
    <label>Darbo sutarties pradžia:</label>
    <input type="date" name="sutarties_pradzia">
  </div>
  <div class="lauku_forma">
    <label>Darbo sutarties pabaiga:</label>
    <input type="date" name="sutarties_pabaiga">
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
          <label>Preigos </label>
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
