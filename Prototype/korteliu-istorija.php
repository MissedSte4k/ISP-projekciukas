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
  <h1>Veiklos istorija</h1>
	<?php include("include/pultoValdymasMeniu.php");?>
<table class="table">
  <thead>
    <tr>
	  <th scope="col">Data</th>
      <th scope="col">Kortelė</th>
      <th scope="col">Asmuo</th>
	  <th scope="col">Kreipiamasi</th>
	  <th scope="col">Vartai</th>
	  <th scope="col">Sėkminga</th>
    </tr>
  </thead>
  <tbody>
    <?php

$dbc=mysqli_connect('localhost','simpas2', 'ahX5Waiwiec8ango','simpas2');
if(!$dbc){die ("Negaliu prisijungti prie MySQL:" .mysqli_error($dbc)); }
$sql = "SELECT * FROM KortelesVartai";
    $result = mysqli_query($dbc, $sql);  
	  
while($row = mysqli_fetch_assoc($result))
 {
	echo"<tr> <th scope=\"col\">$row[Kada]</th>";
	echo"<th scope=\"col\">$row[fk_Kortele]</th>";
	 $sql2 = "SELECT * FROM Korteles
	 WHERE ID = $row[fk_Kortele]";
    $result2 = mysqli_query($dbc, $sql2); 
	 $row2 = mysqli_fetch_assoc($result2);
		 
	 $sql3 = "SELECT * FROM Darbuotojas WHERE tabelio_nr = $row2[fk_Darbuotojastabelio_nr]";
    $result3 = mysqli_query($dbc, $sql3);  
	 $row3 = mysqli_fetch_assoc($result3);
	 $sql4 = "SELECT * FROM Asmuo WHERE asmens_kodas = $row3[fk_Asmuoasmens_kodas]";
	 $result4 = mysqli_query($dbc, $sql4);  
	 $row4 = mysqli_fetch_assoc($result4);
	 echo"<th scope=\"col\">$row4[vardas] $row4[pavarde]</th>";
	 
	 if($row['Kreipimasis'] == 0){
		 echo"<th scope=\"col\">Atidaryti</th>";
	 }else{
		 echo"<th scope=\"col\">Uždaryti</th>";
	 }
	echo"<th scope=\"col\">$row[fk_Vartai]</th>";
	 if($row['Uzklausa_sekminga'] == 0){
		 echo"<th scope=\"col\">Ne</th>";
	 }else{
		 echo"<th scope=\"col\">Taip</th></tr>";
	 }
	 
 }

?>
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