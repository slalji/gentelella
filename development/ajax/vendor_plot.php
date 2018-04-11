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


$one = $requestData['vendor'][0] ;
$two = $requestData['vendor'][1] ;
$month = $requestData['month'];
 

$sql = "SELECT DAY(fulltimestamp) onDay, type, vendor, sum(amount) amnt, count(amount) cnt FROM `transactions` WHERE type = 'DEBIT' and vendor = '".$one."' and MONTH(fulltimestamp) = ".$month." group by DAY(fulltimestamp)";
$query=mysqli_query($conn, $sql) or die(mysqli_error($conn).' '.$sql);
//print_r($sql);
	$rows = array();
	$data_one = array();	 
	 
	while( $rows=mysqli_fetch_assoc($query) ) {  // preparing an array
		
            $data_one[] = array ($rows['onDay'], $rows['amnt']);
		
    }
$sql2 = "SELECT DAY(fulltimestamp) onDay, type, vendor, sum(amount) amnt, count(amount) cnt FROM `transactions` WHERE type = 'DEBIT' and vendor = '".$two."' and MONTH(fulltimestamp) = ".$month." group by DAY(fulltimestamp)";
$query2=mysqli_query($conn, $sql2) or die(mysqli_error($conn).' '.$sql2);
//print_r($sql);
    $rows = array();
    $data_two = array();	 
        
    while( $rows=mysqli_fetch_assoc($query2) ) {  // preparing an array
        
            $data_two[] = array ($rows['onDay'], $rows['amnt']);
        
    }	    	
		
    $json = array();
    $arr = array();
        $arr['label']=$one;
        $arr['data']=$data_one;
    $json['vendor']=$arr;
        $arr['label']=$two;
        $arr['data']=$data_two;
    $json['compare']=$arr;
    echo  json_encode($json);
 //echo $data;

?>
