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

	$dbc=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	if(!$dbc){die ("Negaliu prisijungti prie MySQL:" .mysqli_error($dbc)); }
	$sql = "SELECT * FROM Aukstai WHERE Pavadinimas=\"$a[0]$a[1]\";";
	 $result = mysqli_query($dbc, $sql);  
	$row = mysqli_fetch_assoc($result);

echo "<script>
console.log($sql);
</script>";

    
		$sql = "UPDATE Vartai
SET Atidaryti='0'
WHERE fk_Aukstas=$row[Kodas];";
		if(mysqli_query($dbc, $sql)){
    echo "Records were updated successfully.";
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($dbc);
}	

	
echo "<script>
console.log($row[Kodas]);
</script>";

?>
<?php
    //Jei vartotojas neprisijungęs, užkraunamas pradinis puslapis
} else {
    header("Location: index.php");
}
?>