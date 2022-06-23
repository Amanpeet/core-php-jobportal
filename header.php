<?php include("include/fg-softcheck.php"); ?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="author" content="Amanz">
  <meta name="description" content="">

  <!-- title -->
  <title> Job Portal </title>
  <link rel="icon" type="image/png" href="img/favicon.png?v=2" />

  <!-- CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/jquery.fancybox.min.css">
  <link rel="stylesheet" href="css/jquery-ui.min.css">
  <link rel="stylesheet" href="css/custom.css">

  <!-- Scripts -->
  <script src="js/jquery.min.js"></script>

</head>

<body>
  <div id="site" class="site">

    <!-- header -->
    <header id="masthead" class="site-header">
      <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.php"><img src="img/logo-wht.png" alt="Rojgar Way"></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation"> <span class="oi oi-menu"></span> Menu </button>

          <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
              <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
              <li class="nav-item"><a href="jobs.php" class="nav-link">Jobs</a></li>
              <li class="nav-item"><a href="activities.php" class="nav-link">Activities</a></li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"> More </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="pricing.php">Pricing</a>
                  <a class="dropdown-item" href="testimonials.php">Testimonials</a>
                  <a class="dropdown-item" href="blog.php">Blog</a>
                </div>
              </li>
              <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
              <?php if($loggedin): ?>
                <li class="nav-item cta mx-md-2"><a href="dashboard.php" class="nav-link"> Dashboard</a></li>
                <li class="nav-item cta cta-colored"><a href="include/fg-logout.php" class="nav-link"> Logout</a></li>
              <?php else: ?>
                <li class="nav-item cta mx-md-2"><a href="login.php" class="nav-link">Post a Job</a></li>
                <li class="nav-item cta cta-colored"><a href="login.php" class="nav-link">Want a Job</a></li>
              <?php endif; ?>
            </ul>
          </div>

        </div>
      </nav>
    </header>
