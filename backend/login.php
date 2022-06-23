<?php
include('inc/loginator.php'); // Include Login Script
if ((isset($_SESSION['username']) != '')) {
  header('Location: dashboard.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="amanz">

  <title>Custom Admin Template</title>
  <link rel="shortcut icon" type="image/png" href="img/favicon.png">

  <!-- core CSS-->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/fontawesome.all.min.css" rel="stylesheet" type="text/css">
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto">
      <div class="card-header">
        <img class="w-50" src="img/logo.png" alt="">
        <h5><strong>ADMIN PANEL</strong></h5>
      </div>
      <div class="card-body">
        <form method="post" action="">
          <div class="form-group">
            <label for="username">Username</label>
            <input class="form-control" name="username" id="username" type="text" placeholder="username" required>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" name="password" id="password" type="password" placeholder="password" required>
          </div>
          <input class="btn btn-primary btn-block" type='submit' name='submit' value='Login' />
        </form>
        <div class="text-center">
          <div class="error text-danger pt-3"><strong><?php echo $error; ?></strong></div>
        </div>
      </div>
    </div>
  </div>

  <!-- core JavaScript-->
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/jquery.easing.min.js"></script>
  <script src="js/custom-admin.js"></script>

  <script>
    $(document).ready(function() {
      console.log("footer jquery initilized.");

    });
  </script>
</body>
</html>