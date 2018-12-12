<?php
include("include/session.php");
?>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"/>
        <title>Lukiškių kalėjimas</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
            <?php include("include/header.php")?>
            <?php
            //Jei vartotojas prisijungęs ir jis yra pulto valdytojas
            if ($session->logged_in && $session->isPultoValdytojas()) {
                  header('Location: Valdiklis.php');
                ?>

                <?php
                //Jei vartotojas neprisijungęs, rodoma prisijungimo forma
                //Jei atsiranda klaidų, rodomi pranešimai.
            }

            //Jei vartotojas prisijungęs ir jis yra inventoriaus administratorius
          else if ($session->logged_in && $session->isInventoriausValdytojas()) {
                header('Location: main_invent_vald.php');
                ?>
                <?php
                //Jei vartotojas neprisijungęs, rodoma prisijungimo forma
                //Jei atsiranda klaidų, rodomi pranešimai.
            }

            //Jei vartotojas prisijungęs ir jis yra  administracijos valdytojas
          else if ($session->logged_in && $session->isAdminsitratorius()) {
                header("Location: main_administration.php");
            }
             else {
                echo "<div align=\"center\">";
                if ($form->num_errors > 0) {
                    echo "<font size=\"3\" color=\"#ff0000\">Klaidų: " . $form->num_errors . "</font>";
                }

                include("include/loginForm.php");
            }
            include("include/footer.php");
            ?>
</body>
</html>
