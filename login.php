<?php
include('include/fg-softcheck.php'); // Include Login Script
if($loggedin) {
  header('Location: dashboard.php');
}
?>
<?php include('header.php'); //header ?>

<section class="ftco-section-parallax page-title">
  <div class="parallax-img d-flex align-items-center">
    <div class="container">
      <div class="text-center heading-section heading-section-white mt-5">
        <h2>Login / Register</h2>
      </div>
    </div>
  </div>
</section>

<!-- section -->
<section class="site-section py-5 login-bg">
  <div class="container">
    <div class="row">
      <div class="col-md-5 mr-md-auto">
        <div class="py-5">
          <h3 class="mb-3"> <strong>Login</strong> </h3>

          <form id="login_form" method="post" action="include/fg-usergetin.php">
            <div class="form-group">
              <label for="username">Username / Email</label>
              <input class="form-control" name="user_email" id="user_email" type="text" placeholder="username or email" required>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input class="form-control" name="user_password" id="user_password" type="password" placeholder="password" required>
            </div>
            <div class="form-group">
              <a href="forgot-password.php">Forgot Username/Password?</a>
            </div>
            <div class="form-group">
              <input class="btn btn-primary btn-block" type='submit' name='loginhit' value='Login' />
            </div>
          </form>
          <div class="text-center">
            <div class="error text-danger pt-3">
              <?php
              if(isset($_GET['error'])){
                echo '<h5 class="text-danger">'.$_GET['error'].'</h5>';
              }
              ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-5 ml-md-auto">

        <div class="py-5">
          <h3 class="mb-3 text-white"> Not <strong>Registered?</strong> </h3>

          <div class="form-group mt-4">
            <label for="" class="text-white">Apply on Jobs, Find Employers</label>
            <a class="d-block btn btn-trans btn-lg" href="register.php?type=user"> <i class="fa fa-user"></i> Register as <strong>User</strong></a>
          </div>
          <div class="form-group mt-5">
            <label for="" class="text-white">Post new Jobs, Find Candidates</label>
            <a class="d-block btn btn-trans btn-lg" href="register.php?type=employer"> <i class="fa fa-user-tie"></i> Register as <strong>Employer</strong></a>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>


<?php include('footer.php'); //footer ?>
