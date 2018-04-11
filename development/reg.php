<?php

include("config.php");

include("class/user.php");

$fullname='';

$email='';

if (isset($_POST['fullname']))

	$fullname = $_POST['fullname'];



if (isset($_POST['email']))

	$email = $_POST['email'];


	if( ($_SERVER['REQUEST_METHOD'] == 'POST' && isset( $_POST['register'] ) ) ) {

		$usr = new Users();

		$usr->storeFormValues( $_POST );

		/**

		 * Generated auto password. User changes password on first login

		 * check for email, make sure its not in use.

		 */

		$message=array();

		$message[] = $usr->checkemail();
			

			if ($message[0]=='') {
				

				$result = $usr->register();

				$my_password = $usr->getPassword();

				//print_r($my_password);
				$usr->sendemail($my_password, $_POST['email']);
				

				if ($my_password) {


					$message[]= '<br><span class="message success" style="color:#1cb495; opacity: 1">Registration successful,' .

						' Thank you</span><br>Your Password is: ' .

						' <code> ' . $my_password . '</code> <br>' .

						'<span style="color:red">COPY and email it to the user :</span> <a href"mailto:' . $_POST['email'] . '">' . $_POST['email'] . '</a>';

					//header("Refresh: 10; location:index.php");

				}else{

					$message[]= $result;

				}

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

		<title>Registration</title>

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

				<h1></h1>Admin

				<p>Register New Admin User</p>



			</header>

		<p> Already a user?  <a href="index.php">Login</a>

		<br><strong >Note: password will automatically be generated. User must change their password at first login !</strong></p>

		<p><span style="color:red">

<?php

if (isset($message)){

foreach($message as $msg)	

	echo  $msg;

}

?>

	</span></p>

		<!-- Signup Form -->

			<form id="signup-form" method="post" action="<?php $_SERVER['PHP_SELF']?>">

				<input type="text" id="fullname" required autofocus name="fullname" placeholder="Fullname" value="<?php echo $fullname ?>" />



				<br><input type="email" required name="email" id="email" placeholder="Email Address" value="<?php echo $email?>" />

				<select name="interval" required="required" >

					<option value=0>Expiry Interval</option>

					<option value=-1>None</option>

					<option value=30>30 Days</option>

					<option value=90>90 Days</option>

					<option value=180>180 Days</option>

					<option value=270>270 Days</option>

					<option value=365>365 Days</option>

				<br><input type="submit" value="Register" name="register" />

			</form>





		<!-- Scripts -->

			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->

			<script src="assets/js/main.js"></script>



	</body>

	



<style>

	option  {



		background-color: rgba(9, 8, 9, 0.75) !important;



	}

	select{

		width: 20% !important;

		-webkit-appearance: normal !important;

		-ms-appearance:  normal !important;

		-moz-appearance:  normal !important;

		-webkit-appearance:normal !important;

		appearance:  normal !important;

	}

	.message{

		color:red;

	}



</style>

</html>