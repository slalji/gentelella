<?php 

/* Database connection start */

$servername = "localhost";

$username = "likejagg_salma";

$password = "xrep8HDqUTuJUbEe";

$dbname = "likejagg_SALMA";




$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());



/* Database connection end */

$cols ='';

$values = '';

$start = date("Y-m-d", strtotime($_REQUEST['emp_start']));

$end = date("Y-m-d", strtotime($_REQUEST['emp_end']));



if(isset($_REQUEST['fullname'])){

    foreach ($_REQUEST as $key => $val){

        $cols .=$key  . ", ";

        if($key == 'emp_start')

            $values .= "'".$start . "', ";

        else if($key == 'emp_end')

            $values .= "'".$end . "', ";

        else

            $values .= "'".$val . "', ";

    }

       

	$fullname = ($_REQUEST['fullname']);

	$status = "0";

    $created = date("Y-m-d", strtotime("now"));

   

  

    $sql="INSERT INTO employees(".$cols."created_at)  VALUES (".$values." '$created')";

   //print_r($sql);



    $result=mysqli_query($conn, $sql) or die(mysqli_error($conn).' '.$sql);

    

        //$rows = mysqli_fetch($result);

//echo ( $json_response = json_encode($rows));

if ($result){

    echo true;

    $to      = 'salma@wisecrack.ca';

$subject = 'Employee Added, '.$_REQUEST['fullname'];

$message = 'New Employee Added by ' . $_REQUEST['employed_by'] . ' and was approved by '.$_REQUEST['approved_by'];

$headers = 'From: web@swachen.com' . "\r\n" .

    'Reply-To: nobody@example.com' . "\r\n" .

    'X-Mailer: PHP/' . phpversion();



mail($to, $subject, $message, $headers);

}





	}

?>