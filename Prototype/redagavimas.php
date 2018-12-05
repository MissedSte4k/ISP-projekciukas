<?php
include("include/session.php");

function mysqli_result($res, $row, $field=3) {
    $res->data_seek($row);
    $datarow = $res->fetch_array();
    return $datarow[$field];
}

if ($session->logged_in) {
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Kortelės</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</head>
<body>

<div class="jumbotron text-center" style="padding-top: 12px; padding-bottom: 12px;" >
  <h1>Nauja kortelė</h1>
  <?php include("include/pultoValdymasMeniu.php");?>
<form>
  <div class="form-group col-lg-6">
   	<select class="row" style="margin: 15px">
  	<option selected>Būsimas kortelės savininkas</option>
		<?php

$dbc=mysqli_connect('localhost','simpas2', 'ahX5Waiwiec8ango','simpas2');
if(!$dbc){die ("Negaliu prisijungti prie MySQL:" .mysqli_error($dbc)); }


?>
</select>
  <div class="row" style="margin: 15px">
  <label for="date-input" class="col-form-label text-center" >Galios iki</label>
	  </div>
  <div class="row" style="margin: 15px">
    <input class="mx-auto"; type="date" value="2018-10-29" id="galioja iki">
  </div>

	  
	  
	  <select class="custom-select custom-select-lg" style="margin: 15px">
  	<option selected>Kortelės saugumo lygis</option>
	<option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
	<option value="4">4</option>
    <option value="5">5</option>
		<?php

$dbc=mysqli_connect('localhost','simpas2', 'ahX5Waiwiec8ango','simpas2');
if(!$dbc){die ("Negaliu prisijungti prie MySQL:" .mysqli_error($dbc)); }


?>
</select>
	 <div class="row" style="margin: 15px">	  
  <button type="submit" class="btn btn-primary col">Submit</button>
	</div>
	  </div>
</form> 
	  


  
	
  
</body>
</html>
<?php
    //Jei vartotojas neprisijungęs, užkraunamas pradinis puslapis
} else {
    header("Location: index.php");
}
?>