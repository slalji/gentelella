<?php

include("config.php");

include("class/user.php");

$fullname='';

$email='';


if (isset($_POST['username']))

	$username = $_POST['username'];

  

	if( (isset( $_POST['submit'] ) && $_POST['submit'] == 'Register') ) {

		$usr = new Users();

        $usr->storeFormValues( $_POST );
        //die(print_r($_POST));
       
		/**

		 * Generated auto password. User changes password on first login

		 * check for email, make sure its not in use.

		 */

		$message=array();

		$message[] = $usr->checkusername();
			
//print_r($messages);
			if ($message[0]=='') {
				

				$result = $usr->register();

				$my_password = $usr->getPassword();

				//print_r($my_password);
				//$usr->sendemail($my_password, $_POST['email']);
				

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
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Registration</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
       
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
          <div class="separator">
               <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>
                
                <!--<p class="change_link">credits to Wisecrack
                  <a href="#"  > ©2018 All Rights Reserved. wisecrack.ca </a>
                </p>
        -->
                <div class="clearfix"></div>
                <br />

                
              </div>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
          <br><strong >Note: password will automatically be generated. User must change their password at first login !</strong></p>

                <p><span style="color:red">

                <?php

                if (isset($message)){

                foreach($message as $msg)	

                echo  $msg;

                }

                ?>

                </span></p>
            <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" id="fullname" required autofocus name="fullname" placeholder="Fullname"  />
              </div>
              <div>
                <input type="text" class="form-control" name="username" placeholder="Username" required  />
              </div>
              <div>
                <input type="email" class="form-control" name="email" placeholder="Email" required  />
              </div>
              <!--<div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
            -->
              <div>
                <input type=submit name=submit class="btn btn-default" value="Register">
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="login2.php" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <!--<div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
                -->
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
