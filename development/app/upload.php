<?php
include "ajax/config.php";

/* Database connection start */



$servername = "localhost";
$username =  DB_USERNAME;
$password = DB_PASSWORD;

//$password = "xrep8HDqUTuJUbEe";

$dbname = DB_NAME;

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());


$fileName="import.csv";
// $result=mysqli_query($conn, $query ) or die(mysqli_error($conn).' '.$sql);
 $i=0;
 try{
    while (($data = fgetcsv($fileName, 1000, ",")) !== FALSE) {
        if($i>0){
            $import="INSERT into transactions(
                fulltimestamp
            vendor
            type
            transid
            reference
            utility_code
            utility_reference
            amount
            discounted
            COL11
            COL12)values('".$data[0]."','".$data[1]."','".$data[2]."','".$data[3]."','".$data[4]."','".$data[5]."','".$data[6]."','".$data[7]."','".$data[8]."','".$data[9]."','".$data[10]."')";
            mysql_query($import) or die(mysqli_error($conn).' '.$import.$data);
        }
        $i=1;
        }
        echo "Transactions uploaded";
 }
 catch(Exception $e){
    echo $e.message();
 }

?>