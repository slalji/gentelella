<?php 
/* Database connection start */
$servername = "localhost";
$username = "root";
$password = "roots";
$dbname = "selcom_dashboard";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */

$month = date('m');
  
$sql="SELECT utility_code, format(sum(amount),0) amnt, format(count(amount),0) cnt FROM `transactions` WHERE type = 'DEBIT' && MONTH(fulltimestamp)= '".$month."' GROUP BY utility_code order by sum(amount) desc LIMIT 6";
$result=mysqli_query($conn, $sql) or die(mysqli_error($conn).' '.$sql);
$data = array();
while( $rows=mysqli_fetch_assoc($result) ) {  // preparing an array
    $data[] =$rows;
}

echo json_encode($data);
?>
