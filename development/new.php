<?php
include("config.php");
include("class/user.php");
session_start();
//var_dump($_SESSION);
$fullname='';
$email='';
$dbid='';

if (isset($_SESSION['fullname']))
	$fullname = $_SESSION['fullname'];

if(isset($_POST['submit']) && $_POST['submit'] == 'Update') {

	$temp = null;
	$confirm = null;
	$new = null;
	$user = null;
	$email = '';
	$errmsg_arr = array();

	

	if (isset($_REQUEST['email'])) $email = stripslashes(strip_tags($_REQUEST['email']));
	if (isset($_REQUEST['temppass'])) $temp = $_REQUEST['temppass'];
	if (isset($_REQUEST['password'])) $password = $_REQUEST['password'];
	if (isset($_REQUEST['conpassword'])) $confirm = $_REQUEST['conpassword'];

	$usr = new Users();
	$usr->storeFormValues($_REQUEST);
	$check = $usr->checkemail();
	$err = json_encode($check);
	$messages= null;
	$error = ($usr->checkNewPassword($_REQUEST));
	//echo '<div class="message failure" style=opacity:1> ';
	//
	if ($err == 'null')
		 $messages[] = 'Invalid Email Address ';



	foreach ($error as $err)
		 $messages[]  = $err ;
	
	if(!$messages && $usr->addNewPassword() == 'db updated'){
		 echo "Successfully updated";
		header('location:index.php');
		 
		
		

	}


}
?>

<!DOCTYPE HTML>
<!--
	Eventually by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<head>
	<title>Update Password</title>
	<meta charset="utf-8" />
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Expires" content="-1">

	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
	<link rel="stylesheet" href="assets/css/main.css" />


	<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
</head>
<body>

<!-- Header -->
<header id="header">
	<h1><i class="fa fa-tree"></i>Boresha Maisha Admin</h1>
	Update Password for first time use. <span style="color:#1cb495"><?php echo $fullname?> </span>

</header>

 <p>Already a user?  <a href="index.php">Login</a></p>
<div class="tooltip">
	<span class="tooltiptext"><i class="fa fa-info-circle"></i> Strong password: 8 characters long, with one lower and uppercase, number and special character</span>
</div>
<div class="message" id="message">
<?php
if(isset ($messages) && $messages != null){
	echo '<div class="errors" id="errors" style=" ">ERRORS<br>';

	foreach($messages as $m)
		echo '<li> ' . $m;
	echo '</div>';
}
else{
	echo '<div></div>';
	//header('location:index.php');
}

?>
</div>

<p>

<!-- Signup Form -->
<form id="theForm" method="post" action="new.php">

	<input type="email" id="email"  autofocus name="email"  placeholder="Email address" value="<?php echo $email?>" />
	<input type="password" id="temppass"  autofocus name="temppass"  placeholder="Temporary password" value="" />
	<input type="password" id="newpass"  autofocus name="newpass"  placeholder="New Password" value="" class="new" />
	<input type="password" id="confirmpass"  autofocus name="confirmpass"  placeholder="Confirm New Password" value="" />
<!--<br><input type="password" name="password" id="password" placeholder="Password" />
    <br><input type="password" id="conpasswd" size="50" maxlength="50" required name="conpassword" placeholder="Confirm Password" class="confirm"  />
-->

	 <input type="submit" value="Update" name="submit" />


</form>
<style>
	form{
		width: 100% !important;
		display:  inline-flex !important;
	}
	li{
		xline-height: 14px;
		xfont-size: 90%;
		list-style: none;

	}
	.errors{
		color:darkred; padding:5px; line-height: 18px; font-weight: bold; font-size: 18px; opacity: 1;
	}
	/* Tooltip container */
	.tooltip {
		position: relative;
		display: inline-block;
		border-bottom: 1px dotted black; /* If you want dots under the hoverable text */
	}

	/* Tooltip text */
	.tooltip .tooltiptext {
		visibility: hidden;
		/*width: 120px;
		background-color: black;
		color: #fff;
		text-align: center;
		padding: 5px ;
		border-radius: 6px;
		border: solid white 1px;
*/
		/* Position the tooltip text - see examples below! */
		xposition: absolute;
		xz-index: 1;
	}

	/* Show the tooltip text when you mouse over the tooltip container */
	.tooltip:hover .tooltiptext {
		visibility: visible;
	}
	input.new:focus{
		visibility: visible;
	}

</style>





<!-- Scripts -->
<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
<script src="assets/js/main.js"></script>

</body>
<script src="ace/assets/js/jquery-2.1.4.min.js"></script>
<script>

	$(document).ready(function() {
		$("#submit").attr("disabled", "disabled");

		$("input[type=text]").keyup(function() {
			if ($("input[type=submit]").is( ":disabled" ) )
				$("input[type=submit]").removeAttr("disabled");
		});
		$(".new").click(function() {
			$(".tooltiptext").css("visibility", "visible");
		});
		$(".new").focusout(function() {
			$(".tooltiptext").css("visibility", "hidden");
		});

	});
</script>
</html>