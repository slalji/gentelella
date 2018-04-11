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

	

	if (isset($_POST['username'])) $username = stripslashes(strip_tags($_POST['username']));
	if (isset($_POST['temppass'])) $temp = $_POST['temppass'];
	if (isset($_POST['password'])) $password = $_POST['password'];
	if (isset($_POST['conpassword'])) $confirm = $_POST['conpassword'];

	$usr = new Users();
  $usr->storeFormValues($_POST);

  $error = ($usr->checkNewPassword($_POST));
  $check = $usr->checkusername();
    if (!$check)
      $error[] = 'Invalid Username Address ';

    if(!$error){
      $result = $usr->addNewPassword();
      //die(print_r($result));
        if($result)
          header('location:login2.php?err=2');
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

    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
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
          <div class="tooltip">
            <span class="tooltiptext"><i class="fa fa-info-circle"></i> Strong password: 8 characters long, with one lower and uppercase, number and special character</span>
        </div>
            <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
              <h1>New User Login Form</h1>
              <div>
                <input type="text" class="form-control" name="username" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" class="form-control" name="temppass" placeholder="Temporary Password" required="" />
              </div>
              <div>
                <input type="password" class="form-control" name="password" placeholder="Password" required="" />
              </div>
              <div>
                <input type="password" class="form-control" name="confirmpass" placeholder="Confirm Password" required="" />
              </div>
              <div>
                <!--<a class="btn btn-default submit" href="login_exe.php">Log in</a>-->
                <input type=submit class="btn btn-default" name=submit value="Update">
                <a class="reset_pass" href="forgotten.php">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <!--<p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>
                
                <p class="change_link">credits to Wisecrack
                  <a href="#"  > ©2018 All Rights Reserved. wisecrack.ca </a>
                </p>
        -->
                <div class="clearfix"></div>
                <br />

                
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
