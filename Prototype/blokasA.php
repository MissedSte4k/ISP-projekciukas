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
	$a = (string)$_POST['param2'];

	$dbc=mysqli_connect('localhost','simpas2', 'ahX5Waiwiec8ango','simpas2');
	if(!$dbc){die ("Negaliu prisijungti prie MySQL:" .mysqli_error($dbc)); }
	$sql = "SELECT * FROM Blokai WHERE Pavadinimas=\"$a[0]\";";


    $result = mysqli_query($dbc, $sql);  
	$row = mysqli_fetch_assoc($result);
 	
	$sql = "SELECT * FROM Aukstai WHERE fk_Blokas = $row[Kodas];";
	$result = mysqli_query($dbc, $sql);  
	while($row = mysqli_fetch_assoc($result)){
		$sql = "UPDATE Vartai
SET Atidaryti='1'
WHERE fk_Aukstas=$row[Kodas];";
		if(mysqli_query($dbc, $sql)){
    echo "Records were updated successfully.";
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($dbc);
}	
	}

	
echo "<script>
console.log($row[Kodas]);
location.reload();
</script>";

?>
<?php
    //Jei vartotojas neprisijungęs, užkraunamas pradinis puslapis
} else {
    header("Location: index.php");
}
?>