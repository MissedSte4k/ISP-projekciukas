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
  <title>Durų valdymas</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="css/style.css" rel="stylesheet" type="text/css"/>
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <meta http-equiv="refresh" content="50" />

</head>
<body>

<div class="jumbotron text-center" style="padding-top: 12px; padding-bottom: 12px;" >
  <h1>Durų valdymas</h1>
  <?php include("include/pultoValdymasMeniu.php");?>
<div class="container">
  <div class="row">
    <div class="col-sm-4"  
		 <?php
	$dbc=mysqli_connect('localhost','simpas2', 'ahX5Waiwiec8ango','simpas2');
	if(!$dbc){die ("Negaliu prisijungti prie MySQL:" .mysqli_error($dbc)); }

	$sql = "SELECT * FROM Blokai";
    $result = mysqli_query($dbc, $sql);  
	$cnt = 0;   
	while($row = mysqli_fetch_assoc($result))
 {
	 $cnt++;
	 if($cnt == 1)
	 {
		if($row['Signalizacija'] == 0)
		{
			echo"style=\"background-color: white;\"";
		}
		else
		{
			echo"style=\"background-color: yellow;\"";
		}
	 }
 }
?>
		 >
      <h3 style="background-color: blue; margin-bottom: 0px; color: white">Blokas Alpha</h3>
		<div class="row">
	 <div class="col-sm-6">
		 <input type="button" class="btn btn-light btn-lg btn-block" onclick="BlokasA(this)" name="AA" id="AA" value="Atidaryti A" /><br/>
	</div>
	<div class="col-sm-6">
		 <input type="button" class="btn btn-light btn-lg btn-block" onclick="BlokasU(this)" name="AU" id="AU" value="Uždaryti A" /><br/>
	</div>
		<div class="col-sm-12">
		 <input type="button" class="btn btn-light btn-lg btn-block" onclick="Signalizacija(this)" name="Asig" id="Asig" value="Signalizacija" /><br/>
	</div>
			</div>
		<div class="row">
	<div class="col-sm-4">
		 <input type="button" class="btn btn-light btn-lg btn-block" onclick="AukstasA(this)" name="A1ati" id="A1ati" value="Atidaryti 1" /><br/>
	</div>
		<div class="col-sm-4">
		 <input type="button" class="btn btn-light btn-lg btn-block" onclick="AukstasA(this)" name="A2ati" id="A2ati" value="Atidaryti 2" /><br/>
	</div>
		<div class="col-sm-4">
		 <input type="button" class="btn btn-light btn-lg btn-block" onclick="AukstasA(this)" name="A3ati" id="A3ati" value="Atidaryti 3" /><br/>
	</div>
			</div>
		<div class="row">
	<div class="col-sm-4">
		 <input type="button" class="btn btn-light btn-lg btn-block" onclick="AukstasU(this)" name="A1uzd" id="A1uzd" value="Uždaryti 1" /><br/>
	</div>
		<div class="col-sm-4">
		 <input type="button" class="btn btn-light btn-lg btn-block" onclick="AukstasU(this)" name="A2uzd" id="A2uzd" value="Uždaryti 2" /><br/>
	</div>
		<div class="col-sm-4">
		 <input type="button" class="btn btn-light btn-lg btn-block" onclick="AukstasU(this)" name="A3uzd" id="A3uzd" value="Uždaryti 3" /><br/>
	</div>
			</div>
	<div class="col-sm-2">
	  <?php
	
	$sql = "SELECT * FROM Vartai";
    $result = mysqli_query($dbc, $sql);  
$cnt = 0;
while($row = mysqli_fetch_assoc($result))
 {
	 $te = $row['fk_Blokas'];
	 if($te == '0')
	 {
	if($row['Atidaryti'] == 1)
	{
		$tmp2 = strval($row['Kodas']);
		$tmp = $row['fk_Aukstas'] . $row['Vardas'];
		echo"<input style=\"background-color: green;\" type=\"button\" class=\"btn btn-light btn-sm\" onclick=\"myFunction(this)\" name=$tmp2 id=$tmp2 value=$tmp /><br/>";
	}
	 else
	 {
		 $tmp2 = strval($row['Kodas']);
		$tmp = $row['fk_Aukstas'] . $row['Vardas'];
		echo"<input style=\"background-color: red;\" type=\"button\" class=\"btn btn-light btn-sm\" onclick=\"myFunction(this)\" name=$tmp2 id=$tmp2 value=$tmp /><br/>";
	 }
	 $cnt = $cnt + 1;
	 if($cnt == 10)
	 {
		$cnt = 0;
		echo"</div>";
		echo"<div class=\"col-sm-2\">"; 
	 }
	 }
 }
      ?>
    </div>
		</div>
		
    <div class="col-sm-4" 
		 <?php


	$sql = "SELECT * FROM Blokai";
    $result = mysqli_query($dbc, $sql);  
	$cnt = 0;   
	while($row = mysqli_fetch_assoc($result))
 {
	 $cnt++;
	 if($cnt == 2)
	 {
		if($row['Signalizacija'] == 0)
		{
			echo"style=\"background-color: white;\"";
		}
		else
		{
			echo"style=\"background-color: yellow ;\"";
		}
	 }
 }
?>
		 >
      <h3 style="background-color: blue; margin-bottom: 0px; color: white">Blokas Bravo</h3>
	<div class="row">
	 <div class="col-sm-6">
		 <input type="button" class="btn btn-light btn-lg btn-block" onclick="BlokasA(this)" name="Ba" id="BA" value="Atidaryti B" /><br/>
	</div>
	<div class="col-sm-6">
		 <input type="button" class="btn btn-light btn-lg btn-block" onclick="BlokasU(this)" name="BU" id="BU" value="Uždaryti B" /><br/>
	</div>
		<div class="col-sm-12">
		 <input type="button" class="btn btn-light btn-lg btn-block" onclick="Signalizacija(this)" name="Bsig" id="Bsig" value="Signalizacija" /><br/>
	</div>
			</div>
		<div class="row">
	<div class="col-sm-4">
		 <input type="button" class="btn btn-light btn-lg btn-block" onclick="AukstasA(this)" name="B1ati" id="B1ati" value="Atidaryti 1" /><br/>
	</div>
		<div class="col-sm-4">
		 <input type="button" class="btn btn-light btn-lg btn-block" onclick="AukstasA(this)" name="B2ati" id="B2ati" value="Atidaryti 2" /><br/>
	</div>
		<div class="col-sm-4">
		 <input type="button" class="btn btn-light btn-lg btn-block" onclick="AukstasA(this)" name="B3ati" id="B3ati" value="Atidaryti 3" /><br/>
	</div>
			</div>
		<div class="row">
	<div class="col-sm-4">
		 <input type="button" class="btn btn-light btn-lg btn-block" onclick="AukstasU(this)" name="B1uzd" id="B1uzd" value="Uždaryti 1" /><br/>
	</div>
		<div class="col-sm-4">
		 <input type="button" class="btn btn-light btn-lg btn-block" onclick="AukstasU(this)" name="B2uzd" id="B2uzd" value="Uždaryti 2" /><br/>
	</div>
		<div class="col-sm-4">
		 <input type="button" class="btn btn-light btn-lg btn-block" onclick="AukstasU(this)" name="B3uzd" id="B3uzd" value="Uždaryti 3" /><br/>
	</div>
			</div>
	<div class="col-sm-2">
	  <?php

	$sql = "SELECT * FROM Vartai";
    $result = mysqli_query($dbc, $sql);  
$cnt = 0;
while($row = mysqli_fetch_assoc($result))
 {
	 $te = $row['fk_Blokas'];
	 if($te == 1)
	 {
	if($row['Atidaryti'] == 1)
	{
		$tmp2 = strval($row['Kodas']);
		$tmp = $row['fk_Aukstas']-3 . $row['Vardas'];
		echo"<input style=\"background-color: green;\" type=\"button\" class=\"btn btn-light btn-sm\" onclick=\"myFunction(this)\" name=$tmp2 id=$tmp2 value=$tmp /><br/>";
	}
	 else
	 {
		 $tmp2 = strval($row['Kodas']);
		$tmp = $row['fk_Aukstas']-3 . $row['Vardas'];
		echo"<input style=\"background-color: red;\" type=\"button\" class=\"btn btn-light btn-sm\" onclick=\"myFunction(this)\" name=$tmp2 id=$tmp2 value=$tmp /><br/>";
	 }
	 $cnt = $cnt + 1;
	 if($cnt == 10)
	 {
		$cnt = 0;
		echo"</div>";
		echo"<div class=\"col-sm-2\">"; 
	 }
	 }
 }
      ?>
    </div>
	
  </div>
	  <div class="col-sm-4" <?php
	
	$sql = "SELECT * FROM Blokai";
    $result = mysqli_query($dbc, $sql);  
	$cnt = 0;   
	while($row = mysqli_fetch_assoc($result))
 {
	 $cnt++;
	 if($cnt == 3)
	 {
		if($row['Signalizacija'] == 0)
		{
			echo"style=\"background-color: white;\"";
		}
		else
		{
			echo"style=\"background-color: yellow;\"";
		}
	 }
 }
?>
		 >
      <h3 style="background-color: blue; margin-bottom: 0px; color: white">Blokas Charlie</h3>
		<div class="row">
	 <div class="col-sm-6">
		 <input type="button" class="btn btn-light btn-lg btn-block" onclick="BlokasA(this)" name="CA" id="CA" value="Atidaryti C" /><br/>
	</div>
	<div class="col-sm-6">
		 <input type="button" class="btn btn-light btn-lg btn-block" onclick="BlokasU(this)" name="CU" id="CU" value="Uždaryti C" /><br/>
	</div>
		<div class="col-sm-12">
		 <input type="button" class="btn btn-light btn-lg btn-block" onclick="Signalizacija(this)" name="Csig" id="Csig" value="Signalizacija" /><br/>
	</div>
			</div>
		<div class="row">
	<div class="col-sm-4">
		 <input type="button" class="btn btn-light btn-lg btn-block" onclick="AukstasA(this)" name="C1ati" id="C1ati" value="Atidaryti 1" /><br/>
	</div>
		<div class="col-sm-4">
		 <input type="button" class="btn btn-light btn-lg btn-block" onclick="AukstasA(this)" name="C2ati" id="C2ati" value="Atidaryti 2" /><br/>
	</div>
		<div class="col-sm-4">
		 <input type="button" class="btn btn-light btn-lg btn-block" onclick="AukstasA(this)" name="C3ati" id="C3ati" value="Atidaryti 3" /><br/>
	</div>
			</div>
		<div class="row">
	<div class="col-sm-4">
		 <input type="button" class="btn btn-light btn-lg btn-block" onclick="AukstasU(this)" name="C1uzd" id="C1uzd" value="Uždaryti 1" /><br/>
	</div>
		<div class="col-sm-4">
		 <input type="button" class="btn btn-light btn-lg btn-block" onclick="AukstasU(this)" name="C2uzd" id="C2uzd" value="Uždaryti 2" /><br/>
	</div>
		<div class="col-sm-4">
		 <input type="button" class="btn btn-light btn-lg btn-block" onclick="AukstasU(this)" name="C3uzd" id="C3uzd" value="Uždaryti 3" /><br/>
	</div>
			</div>
	<div class="col-sm-2">
	  <?php

	$sql = "SELECT * FROM Vartai";
    $result = mysqli_query($dbc, $sql);  
$cnt = 0;
while($row = mysqli_fetch_assoc($result))
 {
	 $te = $row['fk_Blokas'];
	 if($te == 2)
	 {
	if($row['Atidaryti'] == 1)
	{
		$tmp2 = strval($row['Kodas']);
		$tmp = $row['fk_Aukstas']-6 . $row['Vardas'];
		echo"<input style=\"background-color: green;\" type=\"button\" class=\"btn btn-light btn-sm\" onclick=\"myFunction(this)\" name=$tmp2 id=$tmp2 value=$tmp /><br/>";
	}
	 else
	 {
		 $tmp2 = strval($row['Kodas']);
		$tmp = $row['fk_Aukstas']-6 . $row['Vardas'];
		echo"<input style=\"background-color: red;\" type=\"button\" class=\"btn btn-light btn-sm\" onclick=\"myFunction(this)\" name=$tmp2 id=$tmp2 value=$tmp /><br/>";
	 }
	 $cnt = $cnt + 1;
	 if($cnt == 10)
	 {
		$cnt = 0;
		echo"</div>";
		echo"<div class=\"col-sm-2\">"; 
	 }
	 }
 }
      ?>
    </div>
		</div>
</div>
	</div>
<script>

	function myFunction (button) {
    var x = button.id;
	$.ajax({
        url: 'mygtukai.php',
        type: 'POST',
        data: {param2 : x},
        success: function(data) {
            console.log(data); // Inspect this in your console
        }
    });
		location.reload();
    }
	
	function BlokasA (button) {
    var x = button.id;
	$.ajax({
        url: 'blokasA.php',
        type: 'POST',
        data: {param2 : x},
        success: function(data) {
            console.log(data); // Inspect this in your console
        }
    });
		location.reload();
    }
	function BlokasU (button) {
    var x = button.id;
	$.ajax({
        url: 'blokasU.php',
        type: 'POST',
        data: {param2 : x},
        success: function(data) {
            console.log(data); // Inspect this in your console
        }
    });
		location.reload();
    }
	
	function Signalizacija (button) {
    var x = button.id;
	$.ajax({
        url: 'signalizacija.php',
        type: 'POST',
        data: {param2 : x},
        success: function(data) {
            console.log(data); // Inspect this in your console
        }
    });
		location.reload();
    }
	function AukstasA (button) {
    var x = button.id;
	$.ajax({
        url: 'aukstasA.php',
        type: 'POST',
        data: {param2 : x},
        success: function(data) {
            console.log(data); // Inspect this in your console
        }
    });
		location.reload();
    }
	function AukstasU (button) {
    var x = button.id;
	$.ajax({
        url: 'aukstasU.php',
        type: 'POST',
        data: {param2 : x},
        success: function(data) {
            console.log(data); // Inspect this in your console
        }
    });
		location.reload();
    }

	/*$( "#atsijungti" ).click(logout() {
  alert( "Handler for .click() called." );
});*/
	
 
	
</script>
	
</body>
</html>
<?php
    //Jei vartotojas neprisijungęs, užkraunamas pradinis puslapis
} else {
    header("Location: index.php");
}
?>