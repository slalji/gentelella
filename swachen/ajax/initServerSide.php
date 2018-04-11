<?php
include 'config.php';

// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;
$section = $_REQUEST['section'];
$where = '';
$max = 11;
$download='no';
if (isset($_REQUEST['download']))
	$download = $_REQUEST['download'];

$sql = "SELECT id, created_at, fullname, phone from employees";
	// initial of 10 rows
$where = " where members.id < ".$max ;
$totalData = 10;
$totalFiltered = $totalData;

if( !empty($requestData['columns'][0]['search']['value']) ){ 
//print_r($requestData);
	$where = ' WHERE 1' ;
	$sql = "SELECT id, created_at, fullname,phone from employees ";

	//$where.=" AND (";
	$exp = explode('&',$requestData['columns'][0]['search']['value']);
	
	$temp = explode(':',$exp[0]);
	
	if ($temp[0] == 'created_at' && $temp[1] !=''){
		
		$range = explode('|',$temp[1]);		
		$start = trim($range[0]); //name
		$end = trim($range[1]); //name
		$where.=" AND created_at >= '".$start."' AND created_at < ('" .$end. "' + INTERVAL 1 DAY) ";
 
	}
	
	//$where.="  )";
	
   //print_r($where);

   $sql .= $where;
   //print_r($sql);
   $query2=mysqli_query($conn, $sql) or die(mysqli_error($conn).' '.$sql);
   $totalData = mysqli_num_rows($query2); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
   $totalFiltered = ($totalData);
}




$sql.= " ORDER BY created_at   ".$requestData['order'][0]['dir']."";
//Before adding limit find num_rows

$sql.= "  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
$query=mysqli_query($conn, $sql) or die(mysqli_error($conn).' '.$sql);

$rows = array();
$data = array();
while( $rows=mysqli_fetch_assoc($query) ) {  // preparing an array
	$nestedData=array();
foreach($rows as $row)

	$nestedData[] = $row;
	$data[] = $nestedData;
}



$json_data = array(
"query" => $sql,
"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
"recordsTotal"    => intval( $totalData ),  // total number of records
"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
"data"            => $data   // total data array
);


 echo json_encode($json_data);  // send data as json format

?>
