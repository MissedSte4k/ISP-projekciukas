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
	$sql = "SELECT * FROM Blokai WHERE Pavadinimas = \"$a[0]\"";
echo "<script>
console.log($sql);
</script>";
    $result = mysqli_query($dbc, $sql);  
	$row = mysqli_fetch_assoc($result);

	if($row['Signalizacija'] == 0)
	{

	$sql = "UPDATE Blokai
SET Signalizacija=1
WHERE Kodas=$row[Kodas];";
		if(mysqli_query($dbc, $sql)){
    echo "Records were updated successfully.";
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($dbc);
}
	}
	else
	{
	$sql = "UPDATE Blokai
SET Signalizacija=0
WHERE Kodas=$row[Kodas];";
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