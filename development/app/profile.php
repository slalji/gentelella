<!--<div class="page-header">

</div> /.page-header -->
<?php
//var_dump($_SESSION);
include("../config.php");
include("../class/user.php");
$usr = new Users();
$user_info = $usr->getUserInfo($_SESSION['token']);
$expiry_date = $user_info['expiry_date'];//$usr->getExpiryDate($_SESSION['token']);
$email = $user_info['email'];//$usr->getEmail($_SESSION['token']);
$fullname = $user_info['fullname'];//$usr->getFullname($_SESSION['token']);
$lastlogin = $user_info['lastlogin'];//$usr->getLastlogin($_SESSION['token']);
$joined = $user_info['joined'];
$interval = $user_info['expiry_interval'];
$_SESSION['fullname']=$fullname;

?>


<!-- Main  for a primary marketing message or call to action -->

	<div xclass="container" class="col-md-11">
		<div class="row" style="text-align: center">
		<div class="profile-user-info profile-user-info-striped">
			<div class="alert alert-info message">Personal Profile
				<h1 ><i class="fa fa-user"></i> <span class="fullname"><?php echo $fullname ?></span></h1>
				<div style="display: none">DEBUG:
					token <?php echo $_SESSION['token'];?>
				</div>
				<form id="name-form"><?php
					echo '<input type="text" name=fullname id=fullname value="'. $fullname. '">
										 <input type="hidden" readonly id="email2" name="email2" value="'. $email.'">
					<input type="submit" value="Update" name="update" id="update" class="btn btn-info"></i>';?>
				</form>
			</div>
		</div>
	</div>
	</div>


<div xclass="container" class="col-md-11">
	<!-- Example row of columns -->
	<div class="row">
		<div class="col-md-8">

			<div class="profile-user-info profile-user-info-striped">
				<div class="profile-info-row">
					<div class="profile-info-name"><i class="fa fa-send "></i> Email </div>

					<div class="profile-info-value">
						<span class="editable" id="username"><?php echo $email;?></span>
					</div>
				</div>
				<div class="profile-info-row">
					<div class="profile-info-name"><i class="fa fa-calendar green"></i> Last Login </div>

					<div class="profile-info-value">
						<span class="green" id="signup" ><?php echo $lastlogin?></span>
					</div>
				</div>

				<!--<div class="profile-info-row">
					<div class="profile-info-name"> <i class="fa fa-calendar orange2"></i> Expiry </div>

					<div class="profile-info-value">
						<span class="editable" id="signup"><span id="expiry"><?php echo $interval?> </span>Days, Date: <span class="badge badge-warning" id="expiry_date"><?php echo $expiry_date;?></span></span>
					</div>
				</div>
				-->
				<div class="profile-info-row">
					<div class="profile-info-name"><i class="fa fa-calendar "></i> Joined </div>

					<div class="profile-info-value">
						<span class="editable" id="signup"><?php echo $joined?></span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">

			<div class="profile-user-info profile-user-info-striped">

				<div class="widget-box widget-color-orange " id="messages">
					<div class="widget-header widget-header-small">
						<h5 xclass="widget-title smaller orange">Messages</h5>
					</div>

					<div class="widget-body">
						<div class="widget-main">

							<!--<span class="expire"> Your password has expired! Please change it today</span>
							--><span class="success"></span><span class="error"></span>
						</div>
					</div>
				</div>
			</div>		</div>

	</div>
<div class="row"><p></p></div>
		<!-- Example row of columns -->
		<div class="row">
			<div xclass="col-md-12">
				<div class="profile-user-info profile-user-info-striped">
					<div class="alert alert-success">Change Password Form</div>
					<div>

						<form id="theForm" method="post" >
							<div class="profile-user-info profile-user-info-striped">

								<div class="profile-info-row">
									<div class="profile-info-name"> Current Password </div>


									<div class="profile-info-value">
										<input type="hidden" readonly name="email" id="email" value="<?php echo $email?>"></span>
										<span class="editable" ><input type="password" name="temppass" id="temppass">

									</div>
								</div>
								<div class="profile-info-row">
									<div class="profile-info-name"> New Password </div>

									<div class="profile-info-value">
										<span class="editable"><input type="password" name="newpass" id="newpass"></span>
									</div>
								</div>
								<div class="profile-info-row">
									<div class="profile-info-name"> Confirm Password </div>

									<div class="profile-info-value">
										<span class="editable"><input type="password" name="confirmpass" id="confirmpass"></span>
									</div>
								</div>
								<div class="profile-info-row">
									<div class="confirm"> </div>

									<div class="profile-info-value">
										<span class="editable" id="signup"><input type="submit" name="submit" id="submit" class="btn btn-info">
										</span>
									</div>
								</div>
							</div>
					</div></form>
				</div>

			</div>
		</div>
</div>



	<script>

		$(document).ready(function() {
			
			$('input').focus(function () {
				//$('.success').hide();
				//$('.errors').hide();
			});

				$("#submit").click(function () {
					//$('.success').hide();
					//$('.errors').hide();

					var email = $('#email').val();
					var temp = $('#temppass').val();
					var pass = $('#newpass').val();
					var conpass = $('#confirmpass').val();


					//$('body').addClass('loading');
					$.ajax({
						type: "POST",
						url: "../ajax/updatePassword.php", //Relative or absolute path to response.php file
						data: {'email':email, temppass:temp, newpass:pass, confirmpass:conpass},
						success: function (msg) {
							//alert(msg);

							if (msg == 'db updated') {
								$('.error').hide();
								$('.success').show();
								$('.success').html('<br><span class="badge badge-success">Password changed</span>');
								$('#temppass').val('');$('#newpass').val('');$('#confirmpass').val('');
							}
							else {
								$('.error').show();
								$('.error').html('<br><span class="badge badge-danger">' + msg + '</span>');
								//alert('error '+JSON.stringify(msg));
							}
						},
						error: function (msg) {
							alert('error'.JSON.stringify(msg));
						}
					});
					return false;
				});
			$("#update").click(function () {

				$('.success').hide();
				$('.errors').hide();
				var fullname = $('#fullname').val();
				var email2 = $('#email2').val();


				//$('body').addClass('loading');
				$.ajax({
					type: "POST",
					url: "../ajax/updateFullname.php", //Relative or absolute path to response.php file
					data: {'fullname':fullname, email:email2},
					success: function (msg) {
						//alert(msg);

						if (msg !='0') {
							$('.error').hide();
							$('.success').show();
							$('.success').html('<br><span class="badge badge-success">Full name changed</span>');
							$('#fullname').val(fullname);
							$('.fullname').html(fullname);

						}
						else {
							$('.error').show();
							$('.error').html('<br><span class="badge badge-danger">Error: Name was not updated!</span>');
							//alert('error '+JSON.stringify(msg));
						}
					},
					error: function (msg) {
						alert('error'.JSON.stringify(msg));
					}
				});
				return false;
			});
			});
	</script>


