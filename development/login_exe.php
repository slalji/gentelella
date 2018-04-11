<?php
session_start();
$_SESSION = array();
//$_SESSION='false';



/*
 * If register, validate input, create and save new user to database and allow login
 * Else show error messages and allow them to make corrections and try again
 * Use JQuery Ajax call to allow distinict username by check database
 * Inviation code ensure only those that got email with that secrete password can register
 */
	include("config.php");
    include("class/user.php");
  // 

    if( isset( $_POST['username']) && isset($_POST['password']) ) {

	$usr = new Users;
    $usr->storeFormValues( $_POST );  
  
    $data = $usr->userLogin();
    
        if ($data == false){
            header('location:login2.php?err=1');
        }
       

        $token = uniqid();
       
        if (!isset($data['firsttime'])) {
            //
            header('location:login2.php?err=1');
        }
        else if ($data['firsttime'] == 'true') {
           // var_dump('First Time! ' . $data);
           /* $_SESSION["authenticated"] = 'true';
            $_SESSION["fullname"] = $data['fullname'];
            $_SESSION["joined"] = $data['joined'];
            $_SESSION["email"] = $data['email'];
            $_SESSION["firsttime"] = $data['firsttime'];
           if (isset($data['interval']) && $data['interval'] > 0)
                $_SESSION["interval"] = $data['expiry'];
            $_SESSION["token"] = $token;
            //session_destroy();
            */header('location:new2.php');
        }
        else if ($data['firsttime'] == 'false'){

            $_SESSION["authenticated"] = 'true';
            $_SESSION["fullname"] = $data['fullname'];
            $_SESSION['token']=$token;
            $_SESSION['firsttime']='false';
            $_SESSION["joined"] = $data['joined'];
            /*if (isset($data['interval']) && $data['interval'] > 0)
                $_SESSION["interval"] = $data['expiry'];
            $expiry_date = $usr->getExpiryDate($token);
            */
            $usr->updateToken($token); 
            //die(print_r($expiry_date));
            
                header('location:index.php?page=transactions');}
    }
    else 
    var_dump($_POST); 
    //header('location:login2.php?err=1');
    
    
        
       
        
     
?>
 