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
	$sql = "SELECT * FROM Vartai WHERE Kodas=$a;";
    $result = mysqli_query($dbc, $sql);  
	$row = mysqli_fetch_assoc($result);
 	
	if($row['Atidaryti'] == 0)
	{
	$sql = "UPDATE Vartai
SET Atidaryti='1'
WHERE Kodas=$a;";
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
WHERE Kodas=$a;";
		
		if(mysqli_query($dbc, $sql)){
    echo "Records were updated successfully.";
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($dbc);
}
		
	}

echo "<script>
console.log($a);
</script>";

?>
<?php
    //Jei vartotojas neprisijungęs, užkraunamas pradinis puslapis
} else {
    header("Location: index.php");
}
?>