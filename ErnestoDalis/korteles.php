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
  <link href="css/style.css" rel="stylesheet" type="text/css"/>

</head>
<body>

<div class="jumbotron text-center" style="padding-top: 12px; padding-bottom: 12px;" >
  <h1>Kortelės</h1>
  <?php include("include/pultoValdymasMeniu.php");?>
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Lygis</th>
	  <th scope="col">Išdavimo data</th>
	  <th scope="col">Galiojimo data</th>
      <th scope="col">Priklauso</th>
	  <th scope="col">Redaguoti</th>
    </tr>
  </thead>
  <tbody>
    <?php

$dbc=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if(!$dbc){die ("Negaliu prisijungti prie MySQL:" .mysqli_error($dbc)); }
$sql = "SELECT * FROM Korteles";
    $result = mysqli_query($dbc, $sql);  
while($row = mysqli_fetch_assoc($result))
 {
	echo"<tr> <th scope=\"col\">$row[ID]</th>";
	echo"<th scope=\"col\">$row[Lygis]</th>";
	echo"<th scope=\"col\">$row[Isdavimo_data]</th>";
	echo"<th scope=\"col\">$row[Galiojimo_data]</th>";
	$sql = "SELECT * FROM Darbuotojas WHERE tabelio_nr = $row[fk_Darbuotojastabelio_nr]";
	 $result2 = mysqli_query($dbc, $sql);
	 $row2 = mysqli_fetch_assoc($result2);
	$sql = "SELECT * FROM Asmuo WHERE asmens_kodas = $row2[fk_Asmuoasmens_kodas]";
	$result3 = mysqli_query($dbc, $sql);
	 $row3 = mysqli_fetch_assoc($result3); 
	echo"<th scope=\"col\">$row3[vardas] $row3[pavarde]</th>";
	echo"<th scope=\"col\ type=\"button\" class=\"btn btn-light btn-sm\" onclick=\"edit(this)\" id=$row[ID]\">Redaguoti</th></tr>";
	 
 }
?>
	  
	  <script>

	function edit (button) {
    var x = button.id;
	var expires;
		var days = 1;
  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    expires = "; expires=" + date.toGMTString();
  } else {
   expires = "";
  }
  document.cookie = escape("item") + "=" + escape(x) + expires + "; path=/";
		
		document.location.href='editKortele.php';
	
console.log(x);

    }
	  </script>
  </tbody>
</table>
    
</body>
</html>
<?php
    //Jei vartotojas neprisijungęs, užkraunamas pradinis puslapis
} else {
    header("Location: index.php");
}
?>