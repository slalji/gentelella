<?php
/* Database connection start */
$servername = "localhost";
$username = "root";
$password = "roots";
$dbname = "selcom_nbc";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */


if (isset($_REQUEST['fulltimestamp']))
	$fulltimestamp = $_REQUEST['fulltimestamp'];

else if (isset($_REQUEST['transid']))
	$transid = $_REQUEST['transid'];
else if (isset($_REQUEST['util_ref']))
	$util_ref = $_REQUEST['util_ref'];
else if (isset($_REQUEST['result']))
	$result = $_REQUEST['result'];

$where = ' WHERE transactions.id = members.id' ;
$sql = "SELECT transactions.id, fulltimestamp, terminal, members.fullname, members.ip_address, utility_type, amount,utility_reference, msisdn, reference, transid, result, message from transactions join members on members.id = transactions.id  ";
if (isset($fulltimestamp)){
$range = explode('|',$fulltimestamp);		
	$start = trim($range[0]); //name
	$end = trim($range[1]); //name
	$where.=" AND fulltimestamp >= '".$start."' AND fulltimestamp < ('" .$end. "' + INTERVAL 1 DAY) ";
}

else if (isset($transid))
	$where.=" AND (transid like '%" . $transid ."%' or reference like '%".$transid."%') ";		
else if (isset($util_ref))
	$where.=" AND utility_reference like '%" . $util_ref ."%'" ;
else if (isset($result))
	$where.=" AND result like '%" . $result ."%'" ;

   $sql .= $where;
   //print_r($sql);
 
   
$sql.= " ORDER BY fulltimestamp   desc";

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
