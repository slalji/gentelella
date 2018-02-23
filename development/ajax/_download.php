<?php
/* Database connection start */
$servername = "localhost";
$username = "root";
$password = "roots";
$dbname = "selcom_nbc";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */


// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');
//get fieldnames for headers
$sql = "SELECT transactions.id, fulltimestamp, terminal, members.fullname, members.ip_address, utility_type, amount,utility_reference, msisdn, reference, transid, result, message from transactions join members on members.id = transactions.id LIMIT 1";
//$result=mysqli_query($conn, $sql) or die(mysqli_error($conn).' '.$sql);
 $field_arr= array();
 $data_arr= array();
//print_r(mysqli_fetch_field($result));
//print_r($field_arr);
// output the column headings
//fputcsv($output, $field_arr);

// fetch the data
$result=mysqli_query($conn, $sql) or die(mysqli_error($conn).' '.$sql);
while($q = mysqli_fetch_assoc($result))
    {
        foreach ($q as $key => $value)
        {
            if($value != NULL)
            {
				//fputcsv($output, $key);
				$field_arr[]=$key;
			}
			else
			$field_arr[]='';
        }
	}
	//fputcsv($output, $field_arr);
	//print_r( $field_arr);
	$result=mysqli_query($conn, $sql) or die(mysqli_error($conn).' '.$sql);
	while( $rows=mysqli_fetch_assoc($result) ) {
    
		foreach($rows as $value)
			//fputcsv($output, $value);
		$data_arr[]=$value;
				 
			
	}
	fputcsv($output, $field_arr);
	fputcsv($output, $data_arr);
	//print_r( $data_arr);

?>
