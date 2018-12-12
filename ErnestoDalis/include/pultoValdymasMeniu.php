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
      ."<li><a href=\"" . $path . "korteles.php\">Kortelės</a></li>"
      ."<li><a href=\"" . $path . "nauja.php\">NaujaKortele</a></li>"
      ."<li><a href=\"" . $path . "korteliu-istorija.php\">Kortelių veiklos istorija</a></li>"
      ."<li><a href=\"" . $path . "Valdiklis.php\">Kalėjimas</a></li>"
      ."<li></li>"
      ."</ul>
      </nav>";
}
else {
  header("Location: index.php");
}
?>