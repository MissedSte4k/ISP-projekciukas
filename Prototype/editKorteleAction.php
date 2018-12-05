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

    
	echo "<script>
console.log($ar[0]);
</script>";

$a = intval($_COOKIE["item"]);
$dbc=mysqli_connect('localhost','simpas2', 'ahX5Waiwiec8ango','simpas2');
if(!$dbc){die ("Negaliu prisijungti prie MySQL:" .mysqli_error($dbc)); }
$time2 = strtotime($_POST['galioja_iki']);

if ($time2) {
$end = date('Y-m-d', $time2);
}
else
	echo 'Invalid Date: ' . $_POST['dateFrom'];

$sql="UPDATE Korteles
SET Galiojimo_data = '$end', Lygis= '$_POST[lygis]', fk_Darbuotojastabelio_nr= $_POST[savininkas]
WHERE ID = $a;";

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
	<meta http-equiv="refresh" content="0; url=editKortele.php" />
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