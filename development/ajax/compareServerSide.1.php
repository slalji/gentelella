<?php
/* Database connection start */
$servername = "localhost";
$username = "root";
$password = "roots";
$dbname = "selcom_dashboard";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;
$utility_code = '';
/*if (isset($requestData['utility_code']))
	$utility_code = $requestData['utility_code'];
//	print_r($requestData);
*/
$sql='';
$where = '';

//$sql = "SELECT MINUTE(fulltimestamp) mins, utility_code, sum(amount) amnt, count(amount) cnt from transactions where type='DEBIT' &&  MINUTE(fulltimestamp)=59  group by utility_code ";
	// initial of 10 rows
//$where = " where type='DEBIT'" ;

//$query2=mysqli_query($conn, $sql) or die(mysqli_error($conn).' '.$sql);
$totalData=0;$totalFiltered=0;$data=array();;
//$totalFiltered = mysqli_num_rows($query2); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
//$totalFiltered = ($totalData);


if( !empty($requestData['columns'][0]['search']['value']) ){ 

	$where = " WHERE type = 'DEBIT' ";
	$sql = "SELECT DAY(fulltimestamp) dayOfMonth, utility_code, format(sum(amount),0) amnt, format(count(amount),0) cnt from transactions ";

	//$where.=" AND (";
	$exp = explode('&',$requestData['columns'][0]['search']['value']);
	
	//$temp = explode(':',$exp[0]);
	//print_r($exp);
	/*if ($temp[0] == 'month' && $temp[1] !=''){
		print_r($temp);
		$range = explode('|',$temp[1]);		
		$start = trim($range[0]); //name
		$end = trim($range[1]); //name
		$where.=" AND fulltimestamp >= '".$start."' AND fulltimestamp < ('" .$end. "' + INTERVAL 1 DAY) ";
 
	}*/
	//where type='DEBIT' && utility_code=".$utility_code." group by utility_code
	array_splice($exp, 0, 1);
	 
	foreach ($exp as $e){
		$arr = explode(':', $e);
		$key = trim($arr[0]);
		$val = trim($arr[1]);
		
		if ($key == 'utility_code' && $val !='')
			$where.=" AND ".$key." = '" . $val ."'" ;
		 
		else if ($key == 'month' && $val !='')
			$where.=" AND MONTH(fulltimestamp) ='$val'";
	
	}
	
	$where.=" group by  DAY(fulltimestamp) ";
	
   

   $sql .= $where;
 
   $query2=mysqli_query($conn, $sql) or die(mysqli_error($conn).' '.$sql);
   $totalData = mysqli_num_rows($query2); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
   $totalFiltered = ($totalData);


	$sql.= " ORDER BY  DAY(fulltimestamp)   ".$requestData['order'][0]['dir']."";
	//Before adding limit find num_rows

	$sql.= "  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($conn, $sql) or die(mysqli_error($conn).' '.$sql);

	$rows = array();
	$data = array();
	while( $rows=mysqli_fetch_assoc($query) ) {  // preparing an array
		$nestedData=array();
	foreach($rows as $row)

		$nestedData[] = str_replace ('"','',$row);
		$data[] = $nestedData;
	}
 
}


$json_data = array(
"query" => $sql,
"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
"recordsTotal"    => intval( $totalData ),  // total number of records
"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
"data"            => $data,
//"cols" 			  => {"Date" =>"Date", "Amount" =>"Total"},   // total data array
);

/*
if (isset( $download) && $download == 'yes'){
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=data.csv');
//$output = fopen('php://output', 'w');

$output = fopen('data.csv', 'w');
foreach ($data as $d)
	//fputcsv($output, $d);
	echo $d;
}
else
  
 //else
 */
 echo json_encode($json_data);  // send data as json format

?>
