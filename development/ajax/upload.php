<?php
/* Database connection start */
$servername = "localhost";
$username = "root";
$password = "roots";
$dbname = "selcom_dashboard";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
$fileName="C:/wamp64/tmp/2018-03-21_SMPOS_LEDGER (1).csv";

 
$query = <<<eof
LOAD DATA INFILE '$fileName'
 INTO TABLE transactions
 FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"'
 LINES TERMINATED BY '\r\n'
 IGNORE 2 LINES
(@col10, @col11, @col12)
set fulltimestamp = @fulltimestamp;

eof;
 mysqli_query($conn, $query) or die(mysqli_error($conn).' '.$query);
 ?>
 