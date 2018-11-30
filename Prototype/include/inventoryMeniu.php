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
      ."<li><a href=\"" . $path . "new_item.php\">Naujas daiktas</a></li>"
      ."<li><a href=\"" . $path . "edit_item.php\">Redaguoti daiktą</a></li>"
      ."<li><a href=\"" . $path . "remove_item.php\">Pašalinti daiktą</a></li>"
      ."<li><a href=\"" . $path . "give_item.php\">Daikto išdavimas</a></li>"
      ."<li><a href=\"" . $path . "search_item.php\">Daikto paieška</a></li>"
      ."</ul>
      </nav>";
}
else {
  header("Location: index.php");
}
?>
