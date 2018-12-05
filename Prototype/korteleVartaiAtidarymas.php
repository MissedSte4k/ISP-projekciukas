<?php
include("include/session.php");

function mysqli_result($res, $row, $field=3) {
    $res->data_seek($row);
    $datarow = $res->fetch_array();
    return $datarow[$field];
}

if ($session->logged_in) {
    ?>
<?php

//priskirt a reiksme korteles ID
$a = 67375990;
//priskirt v reiksme vartu ID
$v = 243;

	
$dbc=mysqli_connect('localhost','simpas2', 'ahX5Waiwiec8ango','simpas2');
if(!$dbc){die ("Negaliu prisijungti prie MySQL:" .mysqli_error($dbc)); }

$sql = "SELECT * FROM Vartai WHERE Kodas = $v;";
$result = mysqli_query($dbc, $sql);  
$row = mysqli_fetch_assoc($result);

$sql2 = "SELECT * FROM Korteles WHERE ID = $a;";
$result2 = mysqli_query($dbc, $sql2);  
$row2 = mysqli_fetch_assoc($result2);
$ati = 0;

if($row2['Lygis'] >= $row['Lygis'])
{
	if($row['Atidaryti'] == 0)
	{
		$ati = 1;
	$sql = "UPDATE Vartai
SET Atidaryti='1'
WHERE Kodas=$v;";
		if(mysqli_query($dbc, $sql)){
    echo "Records were updated successfully.";
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($dbc);
}
		
	}
	else
	{
	$sql = "UPDATE Vartai
SET Atidaryti='0'
WHERE Kodas=$v;";
		
		if(mysqli_query($dbc, $sql)){
    echo "Records were updated successfully.";
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($dbc);
}
		
	}
		$now = date("Y-m-d H:i:s");
		$sql = "INSERT INTO `KortelesVartai` (`Uzklausa_sekminga`, `Kreipimasis`, `fk_Vartai`, `fk_Kortele`, `id`, `Kada`) 
		VALUES (1, $ati, $v, $a, NULL, '$now' );";
		if(mysqli_query($dbc, $sql)){
    echo "Records were updated successfully.";
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($dbc);
}
	
	
	
}else{
	
	if($row['Atidaryti'] == 0)
	{
		$ati = 1;
	}
	$now = date("Y-m-d H:i:s");
	$sql = "INSERT INTO `KortelesVartai` (`Uzklausa_sekminga`, `Kreipimasis`, `fk_Vartai`, `fk_Kortele`, `id`, `Kada`) 
		VALUES (0, $ati, $v, $a, NULL, '$now' );";
		if(mysqli_query($dbc, $sql)){
    echo "Records were updated successfully.";
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($dbc);
}
	
	
}



?>
<?php
    //Jei vartotojas neprisijungęs, užkraunamas pradinis puslapis
} else {
    header("Location: index.php");
}
?>