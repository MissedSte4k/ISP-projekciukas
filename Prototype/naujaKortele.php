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

class RandDotOrg
{
// Constants
const VER = '1.1.0';
const BASE_URL = 'http://www.random.org/';

// Declarations
private $use_curl; // True if curl is found, false to use get_file_contents
private $curl_ch; // curl channel
private $user_agent; // HTTP User-Agent string. Only used by curl.

public function __construct($user_agent='')
{
// Check for Curl support
$this->uses_curl = function_exists('curl_init');

$this->user_agent = 'phpRandDotOrg ' . self::VER . ' : ' . $user_agent;
if ($this->uses_curl)
{
$this->curl_ch = curl_init(); // Open the cURL channel
}
}

public function __destruct()
{
if ($this->uses_curl)
{
curl_close($this->curl_ch); // Close the cURL channel
}
}

public function get_integers($num=1, $min=0, $max=10, $base=10)
{
// Sanity Checking
if ($num<1)
throw new Exception('num must be at least 1.');
if ($max<=$min)
throw new Exception('max must be greater than min.');
if ( !($base==2 || $base==8 | $base==10 | $base==16) )
throw new Exception('Base must be 2, 8, 10, or 16.');

$params = array( 'num' => $num,
'min' => $min,
'max' => $max,
'base' => $base,
);
$int = $this->make_request('integer', $params);
return $int;
}

public function get_sequence($min=1, $max=10)
{
// Sanity Checking
if ($max<=$min)
throw new Exception('max must be greater than min.');

$params = array( 'min' => $min,
'max' => $max,
);
$seq = $this->make_request('sequence', $params);

return $seq;
}

public function get_strings($num=1, $len=10, $digits=TRUE, $upperalpha=TRUE,
$loweralpha=TRUE, $unique=TRUE)
{
// Sanity Checking
if ($num<1)
throw new Exception('num must be at least 1.');
if ($len<1 || $len>20)
throw new Exception('len must be from 1 and 20.');
if ( !($digits || $upperalpha || $loweralpha) )
throw new Exception('At least one character group must be true.');
$params = array( 'num' => $num,
'len' => $len,
'digits' => ($digits) ? 'on' : 'off',
'upperalpha' => ($upperalpha) ? 'on' : 'off',
'loweralpha' => ($loweralpha) ? 'on' : 'off',
'unique' => ($unique) ? 'on' : 'off' 
);
$str = $this->make_request('string', $params);

return $str;
}

public function quota($ip=NULL)
{
$params = array();
if ($ip)
$params['ip'] = $ip;

$quota = $this->make_request('quota', $params);

return $quota;
}

// Returns a string with the global parameters
private static function global_params()
{
return "col=1&format=plain&rnd=new";
}
// Integer Generator integers
// Sequence Generator sequences
// String Generator strings
// Quota Checker quota
private function make_request($type, $params)
{
//echo "TYPE: $type\n";
//echo "PARAMS:";
//print_r($params);

$url = self::BASE_URL;
switch ($type)
{
case 'integer':
$url .= 'integers/';
break;
case 'sequence':
$url .= 'sequences/';
break;
case 'string':
$url .= 'strings/';
break;
case 'quota':
$url .= 'quota/';
break;
}
$url .= "?";
if(!empty($params))
$url .= self::query_string($params);
$url .= "&" . self::global_params();

if ($this->uses_curl)
{
curl_setopt($this->curl_ch, CURLOPT_URL, $url);
curl_setopt($this->curl_ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($this->curl_ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($this->curl_ch, CURLOPT_USERAGENT, $this->user_agent);
//curl_setopt($this->curl_ch, CURLOPT_TIMEOUT, $timeout);
$raw_data = trim(curl_exec($this->curl_ch));
}
else
{
$raw_data = trim(file_get_contents($url));
}

//echo "\n\nRAW DATA: $raw_data\n\n";

return $this->parse_result($raw_data);
}

// Parses the raw data received by the cURL request
// and handles errors as necessary
private function parse_result($raw_data)
{
// Check to see if 'Error:' exists in the returned data,
// indicating an error.\
if ( strpos($raw_data, 'Error:') !== FALSE )
{
$error = substr($raw_data, 7); // Remove the 'Error: ' from the beginning.
throw new Exception('RandDotOrg Error: '.$error);
}
$raw_data = rtrim($raw_data); // Remove newline from end
$parsed_data = explode("\n", $raw_data); // Separate the data by newline.

return $parsed_data;
}

// Form an HTTP query string from a simple array
// Ex: $a = array('name'=>'joe' , 'weight'=>162 , 'height'=>5.7 )
// ==> 'name=joe&weight=162&height=5.7'
private static function query_string($array)
{
$string = '';
foreach($array as $k=>$v)
{
if (!is_array($v))
$string .= $k . '=' . $v . '&';
}

// Remove last &
$string = substr($string, 0, -1);
return $string;
}
}
	$tr = new RandDotOrg;

	print_r(RandDotOrg::VER);
	
	$ar = $tr->get_integers(5, 1000000, 9999999, 10);
	
	
	$dbc=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
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