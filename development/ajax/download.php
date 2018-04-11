<?php
/* Database connection start */
$servername = "localhost";
$username = "root";
$password = "roots";
$dbname = "selcom_dashboard";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */
$where="";

if (isset($_REQUEST['fulltimestamp']))
	$fulltimestamp = $_REQUEST['fulltimestamp']; 
	 
	$utility_code = $_REQUEST['utility_code'];
	//print_r($_REQUEST);
	$sql = "SELECT WEEK(fulltimestamp,1) wk, (fulltimestamp) DayOfMonth, type, utility_code, sum(amount) amnt, count(amount) cnt FROM `transactions` WHERE type like '%DEBIT%' and utility_code like '%".$utility_code."%' group by DAY(fulltimestamp)";
	//print_r($sql);
if (isset($fulltimestamp)){
$range = explode('|',$fulltimestamp);		
	$start = trim($range[0]); //name
	$end = trim($range[1]); //name
	$where.=" AND fulltimestamp >= '".$start."' AND fulltimestamp < ('" .$end. "' + INTERVAL 1 DAY) ";
}

/*else if (isset($utility_code))
	$where.=" AND utility_code like '%" . $utility_code ."%'" ;

   $sql .= $where;
  */ //print_r($sql);
 
   
//$sql.= " group by mins ORDER BY fulltimestamp   desc";

$result=mysqli_query($conn, $sql) or die(mysqli_error($conn).' '.$sql);
//$rows=mysqli_fetch_assoc($query);

$finfo = mysqli_fetch_fields($result);//_fetch_assoc($result);

$headers = array();
foreach ($finfo as $val) {
    $headers[] = $val->name;
}
 
$fp = fopen('php://output', 'w');
if ($fp && $result) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="data.csv"');
    header('Pragma: no-cache');
    header('Expires: 0');
	fputcsv($fp, $headers);
	 
	//print_r($rows);
	
	while( $rows=mysqli_fetch_assoc($result) ) {  // preparing an array
		fputcsv($fp, $rows);
	}
}
 

?>
