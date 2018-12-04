    <div class="header2">
    <h2>Prisijunkite prie IS</h2>
    </div>
  <form method="POST" action="process.php" name="login_form">
    <div class="input-group">
      <label>Prisijungimas</label>
      <input type="text" name="user" value="<?php echo $form->value("user"); ?>"/><br>
            <?php echo $form->error("user"); ?>
    </div>
    <div class="input-group">
      <label>Slaptažodis</label>
      <input type="password" name="pass" value="<?php echo $form->value("pass"); ?>"/><br>
      <?php echo $form->error("pass"); ?>
    </div>
    <div class="input-group">
      <button type="submit" name="login" class="btn">Prisijungti</button>
    </div>
    <input type="hidden" name="sublogin" value="1"/>
</form>
