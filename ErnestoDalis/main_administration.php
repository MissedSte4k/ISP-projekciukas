<?php
include("include/session.php");
?>
<!DOCTYPE html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"/>
        <title>Lukiškių kalėjimas</title>
        <link href="css/styleadmin.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
      <header id='main_header'>
        <div class="container">
          <h1>Administracijos valdymas</h1>
        </div>
      </header>
                <?php include("include/administrationMeniu.php");

                ?>
                <div style="text-align: center;color:green">
                    <br><br><br><br><br><br><br><br>
                    <h1>Sveiki, atvykę į Lukiškių kalėjimo informacinę sistemą.</h1>
                </div><br>
              <?php  include("include/footer.php");?>
</body>
</html>
