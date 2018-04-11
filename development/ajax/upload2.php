<?php
/* Database connection start */
$servername = "localhost";
$username = "root";
$password = "roots";
$dbname = "selcom_dashboard";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());


$fileName="C:/wamp64/tmp/2018-03-21_SMPOS_LEDGER (1).csv";
$handle = fopen($fileName,"r"); 
// $result=mysqli_query($conn, $query ) or die(mysqli_error($conn).' '.$sql);
 $i=0;
 try{
    while (($data = fgetcsv($handle, 10, " ")) !== FALSE) {
       
        //$temp = str_replace('\N', '"NULL"',$data);
       // $temp = str_replace('" "', '", "',$temp);
        die (print_r($data));
        if($i>0){
            $import="INSERT into transactions(
                fulltimestamp,
            vendor,
            type,
            transid,
            reference,
            utility_code,
            utility_reference,
            amount,
            discounted)values('".$data[0]."')";//);,'".$data[1]."','".$data[2]."','".$data[3]."','".$data[4]."','".$data[5]."','".$data[6]."','".$data[7]."','".$data[8]."')";
            $result=mysqli_query($conn, $import) or die(mysqli_error($conn).' '.$import);
        }
        $i=1;
        }
        
       
        echo "Transactions uploaded";
 }
 catch(Exception $e){
    echo $e.message().$import;
 }

?>