<div class="login col-md-12 " >
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
          <?php
            if (isset ($_GET['err']) && $_GET['err'] == 1){
            echo '<span class="error" style="color:red"> *'."Error username or password, Try again ! "."</span>";
            }
          ?>
            <form id="signup-form" method="post" action="login_exe.php">
              <h1>Login Form</h1>
              <div>
                <input id=email name=email type="text" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input name="password" id="password" type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
              <input type="submit" value="Login" class="btn btn-success submit"/>
              </div>

              <div class="clearfix"></div>

            </form>
          </section>
        </div>

        
      </div>
    </div>
</div>