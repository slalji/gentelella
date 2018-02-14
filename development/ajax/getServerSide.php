<?php
/* Database connection start */
$servername = "localhost";
$username = "root";
$password = "roots";
$dbname = "selcom_nbc";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;
//print_r(($_REQUEST));
$cols = explode(',',$_REQUEST['cols']);
$columns = array();
$section = $_REQUEST['section'];
$where = '';
$orderby='';

foreach($cols as $col){
	$columns[]=$col;
}

// getting total number records without any search
$sql = " ";

if ($section == 'transactions')
	$sql="SELECT " . $_REQUEST['cols'] . ' from transactions ';

$query=mysqli_query($conn, $sql) or die(mysqli_error($conn).' '.$sql);
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "";

if ($section == 'transactions'){
	$where = ' 1 ';
	$sql="SELECT ". $_REQUEST['cols']  . " from transactions ";

}
	

//because field names are different in sql statement, you need to explode else search will not work
$exp=explode('SELECT',$sql);
$exp2 = explode('from', $exp[1]);
$q_cols = explode(',', $exp2[0]);
//print_r($requestData);

$where = " where " . $where;
if( !empty($requestData['columns'][0]['search']['value']) ){ 
    $range = explode('|', $requestData['columns'][0]['search']['value']); 
    $start = trim($range[0]); //name
    $end = trim($range[1]); //name
    $where.=" AND fulltimestamp >= '".$start."' AND fulltimestamp <= ('" .$end. "' + INTERVAL 1 DAY) ";
}
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$where.=" AND (".$q_cols[0]." LIKE '".$requestData['search']['value']."%' ";
	foreach($q_cols as $col)
		$where .= "OR ". $col . " LIKE '" . $requestData['search']['value']."%' ";

	$where.="  )";
}
//print_r($where);

$query=mysqli_query($conn, $sql) or die(mysqli_error($conn).' '.$sql);
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.= $where . " ORDER BY ". $q_cols[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */
$query=mysqli_query($conn, $sql) or die(mysqli_error($conn).' '.$sql);
$rows = array();
$data = array();
while( $rows=mysqli_fetch_assoc($query) ) {  // preparing an array
	$nestedData=array();
foreach($rows as $row)
	/*if ( $row == null)
		$nestedData[] = '';
	else
        */
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
