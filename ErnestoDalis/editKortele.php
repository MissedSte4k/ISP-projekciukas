
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
  <h1>Redaguoti kortele</h1>
	<?php include("include/pultoValdymasMeniu.php");?>
<form action="editKorteleAction.php" method="post">
  <div class="form-group col-lg-6">
   	<select class="row" name="savininkas" style="margin: 15px">
  	<option >Būsimas kortelės savininkas</option>
		
		<?php
		



   $a = intval($_COOKIE["item"]);


		
		echo "<script>
console.log($a);
</script>";
		
		
$dbc=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if(!$dbc){die ("Negaliu prisijungti prie MySQL:" .mysqli_error($dbc)); }
		
$sql = 	"SELECT *
FROM Korteles WHERE ID = $a";	
	$result = mysqli_query($dbc, $sql);
$row2 = mysqli_fetch_assoc($result)	;	
	
$sql = "SELECT *
FROM Asmuo t1
INNER JOIN Darbuotojas t2 ON t2.fk_Asmuoasmens_kodas = t1.asmens_kodas;";
    $result = mysqli_query($dbc, $sql);  
while($row = mysqli_fetch_assoc($result))
 {
	 if($row[tabelio_nr] == $row2[fk_Darbuotojastabelio_nr]){
	 echo"<option selected value=\" $row[tabelio_nr]\">$row[vardas] $row[pavarde]</option>";
	 }
	 else 
		 echo"<option value=\" $row[tabelio_nr]\">$row[vardas] $row[pavarde]</option>";
 }

?>
</select>
	  <div class="row" style="margin: 15px">
  <label for="date-input" class="col-form-label text-center" >Išdavimo data</label>
	  </div>
  <div class="row" style="margin: 15px">
    <input class="mx-auto"; name="galioja_nuo" type="date" value="2018-11-30" readonly>
  </div>
	  
  <div class="row" style="margin: 15px">
  <label for="date-input" class="col-form-label text-center" >Galios iki</label>
	  </div>
  <div class="row" style="margin: 15px">
    <input class="mx-auto"; name="galioja_iki" type="date" value="2018-11-30">
  </div>

	  
	  
	  <select class="custom-select custom-select-lg" name="lygis" style="margin: 15px">
  	<option selected>Kortelės saugumo lygis</option>
		<?php  
		  
		  $i = 1;
while($i < 6)
 {
	 if($i == $row2[Lygis]){
	 echo"<option selected value=$i>$i</option>";
	 }
	 else 
		 echo"<option value=$i>$i</option>";
	 $i++;
 }
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