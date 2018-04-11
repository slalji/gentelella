<?php
/* Database connection start */
$servername = "localhost";
$username = "root";
$password = "roots";
$dbname = "selcom_dashboard";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */


$sql = "SELECT DISTINCT utility_code FROM `transactions` WHERE utility_code LIKE '%IN' OR utility_code LIKE '%OUT'";
  
$sql.= " ORDER BY utility_code ";
$data = array();
$result=mysqli_query($conn, $sql) or die(mysqli_error($conn).' '.$sql);
$html = '';
$data = array();
	
    while( $rows=mysqli_fetch_assoc($result) ) {  // preparing an array
        if (strstr( $rows['utility_code'], 'IN'))
		    $temp = str_replace('IN', '',$rows['utility_code']);
			
		else
			$temp = $temp = str_replace('OUT', '',$rows['utility_code']);
		$data[$temp]= "<option value='".$temp."'>".$temp."</option>";
	}


foreach ($data as $d)
    $html .= $d;

echo $html;

?>
