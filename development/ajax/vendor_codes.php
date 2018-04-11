<?php
/* Database connection start */
$servername = "localhost";
$username = "root";
$password = "roots";
$dbname = "selcom_dashboard";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */


$sql = "SELECT DISTINCT vendor FROM `transactions` WHERE 1";
  
$sql.= " ORDER BY vendor ";
$data = array();
$result=mysqli_query($conn, $sql) or die(mysqli_error($conn).' '.$sql);
$html = '';
	
	while( $rows=mysqli_fetch_assoc($result) ) {  // preparing an array
		if (isset($rows['vendor']) && $rows['vendor'] == '\N')
        $html .= "<option value='NA'>NA</option>";
        if (isset($rows['vendor']) && !is_numeric($rows['vendor'][0]))
		$html .= "<option value='".$rows['vendor']."'>".$rows['vendor']."</option>";
        
			

			
	}

echo ($html);

?>
