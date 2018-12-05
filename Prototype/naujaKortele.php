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

	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	include './RandDotOrg.class.php';
	$tr = new RandDotOrg;

	print_r(RandDotOrg::VER);
	
	$ar = $tr->get_integers(1, 10000000, 99999999, 10);
	
    
	echo "<script>
console.log($ar[0]);
</script>";


global $database;
	$dbc=$database;
if(!$dbc){die ("Negaliu prisijungti prie MySQL:" .mysqli_error($dbc)); }
$id=$ar[0];
$time1 = strtotime($_POST['galioja_nuo']);
$time2 = strtotime($_POST['galioja_iki']);
if ($time1) {
$start = date('Y-m-d', $time1 );
}
else 
	echo 'Invalid Date: ' . $_POST['dateFrom'];
if ($time2) {
$end = date('Y-m-d', $time2);
}
else
	echo 'Invalid Date: ' . $_POST['dateFrom'];

$sql="INSERT INTO Korteles (Isdavimo_data, Galiojimo_data, ID, Lygis, fk_Darbuotojastabelio_nr) VALUES 
('$start', 
'$end',
$id,
$_POST[lygis], 
$_POST[savininkas]  );";

if(mysqli_query($dbc, $sql)){
    echo "Records were updated successfully.";
	?>
<meta http-equiv="refresh" content="0; url=korteles.php" />
<?php
	echo "Records were updated successfully.";
	//<meta http-equiv="refresh" content="0; url=korteles.php" />
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($dbc);
	?>
<meta http-equiv="refresh" content="0; url=nauja.php" />
<?php
	echo "ERROR: Could not able to execute $sql. " . mysqli_error($dbc);
	//<meta http-equiv="refresh" content="0; url=nauja.php" />
}	



?>
<?php
    //Jei vartotojas neprisijungęs, užkraunamas pradinis puslapis
} else {
    header("Location: index.php");
}
?>