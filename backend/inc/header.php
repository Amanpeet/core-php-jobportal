<?php include("logincheck.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Amanz Galzor">
  <meta name="description" content="Custom Admin template by Amanz Galzor. Visit galzor.com for more information.">

  <title>Custom Admin Template</title>
  <link rel="shortcut icon" type="image/png" href="img/favicon.png?v=3">

  <!-- core CSS-->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/sb-admin.css" rel="stylesheet">
  <link href="css/jquery-ui.min.css" rel="stylesheet">

  <!-- core jquery, else in footer-->
  <script src="js/jquery.min.js"></script>

</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="/"><img src="img/logo-wht.png" alt=""></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">

      <ul class="navbar-nav ml-auto">
        <?php if($admin || $editor){ ?>
          <li class="nav-item pr-5">
            <a class="btn btn-secondary btn-sm mt-1" href="../index.php" target="_blank"> <i class="fa fa-home"></i> Visit Site</a>
          </li>
        <?php } ?>
        <li class="nav-item">
          <a class="nav-link" href="user-profile.php?user=<?php echo $login_user; ?>">  <i class="fa fa-fw fa-user"></i> <?php echo $login_user; ?> </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal"> <i class="fa fa-fw fa-sign-out-alt"></i>Logout</a>
        </li>
      </ul>

      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item">
          <a class="nav-link" href="dashboard.php">
            <i class="fa fa-fw fa-home"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="upload.php">
            <i class="fa fa-fw fa-upload"></i>
            <span class="nav-link-text">Upload</span>
          </a>
        </li> -->
        <!-- <li class="nav-item">
          <a class="nav-link" href="gallery.php">
            <i class="fa fa-fw fa-image"></i>
            <span class="nav-link-text">Gallery</span>
          </a>
        </li> -->
        <!-- <li class="nav-item">
          <a class="nav-link" href="approved.php">
            <i class="fa fa-fw fa-check-square"></i>
            <span class="nav-link-text">Approved</span>
          </a>
        </li> -->

        <?php if( $admin || $editor ){ ?>
          <li class="nav-item">
            <a class="nav-link" href="jobs.php">
              <i class="fa fa-fw fa-thumbtack"></i>
              <span class="nav-link-text">Jobs</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="users.php">
              <i class="fa fa-fw fa-users"></i>
              <span class="nav-link-text">Users</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="employers.php">
              <i class="fa fa-fw fa-user-tie"></i>
              <span class="nav-link-text">Employers</span>
            </a>
          </li>
        <?php } ?>

        <?php if( $admin ){ ?>
          <li class="nav-item">
            <a class="nav-link" href="admins.php">
              <i class="fa fa-fw fa-user-shield"></i>
              <span class="nav-link-text">Admins</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="amounts.php">
              <i class="fa fa-fw fa-money-bill"></i>
              <span class="nav-link-text">Amounts</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="blog.php">
              <i class="fa fa-fw fa-newspaper"></i>
              <span class="nav-link-text">Blog</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="activity.php">
              <i class="fa fa-fw fa-clock"></i>
              <span class="nav-link-text">Activity</span>
            </a>
          </li>
        <?php } ?>
      </ul>

      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>

    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <!-- content goes here -->