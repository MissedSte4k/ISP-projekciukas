<?php
//Formuojamas meniu.
if (isset($session) && $session->logged_in) {
    $path = "";
    if (isset($_SESSION['path'])) {
        $path = $_SESSION['path'];
        unset($_SESSION['path']);
    }
    ?>
    <table width=100% border="0" cellspacing="1" cellpadding="3" class="meniu">
        <?php
        echo "Prisijungęs vartotojas: <b>$session->username</b> <br>";
        echo "</td></tr><tr><td>";
        echo "[<a href=\"" . $path . "process.php\">Atsijungti</a>]";
        echo "</td></tr>";
        ?>
    </table>
    <?php  echo "<nav>
      <ul> "
      ."<li><a href=\"" . $path . "asmens_pridejimas.php\">Pridėti asmenį</a></li>"
      ."<li><a href=\"" . $path . "darbuotojo_pridejimas.php\">Registruoti darbuotoją</a></li>"
      ."<li><a href=\"" . $path . "darbuotojo_redagavimas.php\">Redaguoti darbuotoją</a></li>"
      ."<li><a href=\"" . $path . "darbuotojo_paieska.php\">Darbuotojo paieška</a></li>"
      ."<li><a href=\"" . $path . "kalinio_registravimas.php\">Registruoti kalinį</a></li>"
      ."<li><a href=\"" . $path . "kalinio_redagavimas.php\">Redaguoti kalinį</a></li>"
      ."<li><a href=\"" . $path . "lankytojo_registravimas.php\">Registruoti lankytoją</a></li>"
      ."<li><a href=\"" . $path . "vartotojo_sukurimas.php\">Išduoti prisijungimus</a></li>"
      ."</ul>
      </nav>";
}
else {
  header("Location: index.php");
}
?>
