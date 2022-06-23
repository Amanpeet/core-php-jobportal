<?php include('header.php'); //header ?>

<section class="ftco-section-parallax page-title">
  <div class="parallax-img d-flex align-items-center">
    <div class="container">
      <div class="text-center heading-section heading-section-white mt-5">
        <h2>Jobs</h2>
      </div>
    </div>
  </div>
</section>

<!-- section -->
<section class="site-section py-5 bg-light">
  <div class="container">

    <div class="heading-section text-center my-5">
      <h2 class=""><span>Listing</span> Jobs</h2>
      <p class="lead">Listing latest ten jobs per page. Use the filter on left side to personalize the Listing.</p>
    </div>

    <div class="row mb-4">
      <div class="col-md-3">
      </div>
      <div class="col-md-9">
        <div class="response">
          <?php
            $filter_sql = ''; //for query later
            if( isset($_REQUEST['filtered']) ){

              // get values
              $s_term     = mysqli_real_escape_string($conn, $_POST['s_term']);
              $s_category = mysqli_real_escape_string($conn, $_POST['s_category']);
              $s_location = mysqli_real_escape_string($conn, $_POST['s_location']);

              echo "Searching Jobs ";

              if( !empty($s_term) ){
                // $filter_sql .= " WHERE `status` = 'active' AND job_title LIKE '%$s_term%' OR job_description LIKE '%$s_term%' ";
                $filter_sql .= " AND job_title LIKE '%$s_term%' ";
                echo " <strong>In Title:</strong> $s_term ";
              } else {
                $filter_sql .= " AND job_title LIKE '%%' ";
              }

              if( !empty($s_category) ){
                $filter_sql .= " AND job_category LIKE '%$s_category%' ";
                echo " <strong>Category:</strong> $s_category ";
              }

              if( !empty($s_location) ){
                $filter_sql .= " AND job_location LIKE '%$s_location%' ";
                echo " <strong>Location:</strong> $s_location ";
              }

            }
          ?><br>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-3">
        <div class="jobs-widgets">

          <div class="card p-4">
            <form id="job-search-form" action="" method="post">
              <div class="form-group">
                <h6><small><strong>SEARCH</strong></small></h6>
                <input name="s_term" type="text" class="form-control" placeholder="search jobs">
              </div>
              <div class="form-group">
                <h6><small><strong>CATEGORY</strong></small></h6>
                <select name="s_category" class="form-control form-control-sm">
                  <option value="">All Categories</option>
                  <option value="designing">Designing</option>
                  <option value="developing">Developing</option>
                  <option value="hardware">Hardware</option>
                  <option value="government">Government</option>
                </select>
              </div>
              <div class="form-group">
                <h6><small><strong>LOCATION</strong></small></h6>
                <select name="s_location" class="form-control form-control-sm">
                  <option value="">All Locations</option>
                  <option value="chandigarh">Chandigarh</option>
                  <option value="mohali">Mohali</option>
                  <option value="delhi">Delhi</option>
                  <option value="gurugram">Gurugram</option>
                  <option value="noida">Noida</option>
                </select>
              </div>
              <div class="form-group mb-0">
                <button class="btn btn-primary w-100" type="submit" name="filtered"> <i class="fa fa-search"></i> FILTER JOBS</button>
              </div>
            </form>
          </div>

          <div class="card p-4 mt-4">
            <h6><small><strong>CONTACT US</strong></small></h6>
            <p>
              <i class="fa fa-phone"></i> <a href="tel:+1234567890"> +1-1234567890 </a> <br>
              <i class="fa fa-envelope"></i> <a href="mailto:info@rojgarway.com"> jobs@rojgarway.com </a>
            </p>
          </div>

        </div>
      </div>
      <div class="col-md-9">
        <?php
        //pagination part 1
        $items_per_page = 10;
        if (isset($_GET["pagex"])) {
          $pagex = $_GET["pagex"];
        } else {
          $pagex = 1;
        }
        $start_from = ($pagex - 1) * $items_per_page;

        /* Advanced Query with filters */
        // $job_sql = "SELECT * FROM jobs ORDER BY jid DESC LIMIT $items_per_page OFFSET $start_from";
        $job_sql = "SELECT * FROM jobs WHERE `status` = 'active' ".$filter_sql." LIMIT $items_per_page OFFSET $start_from";

        $job_query = mysqli_query($conn, $job_sql);
        if( mysqli_num_rows($job_query) > 0 ){
          while($job = mysqli_fetch_array($job_query)) {
            ?>
            <div class="card bg-white mb-4">
              <div class="card-body">
                <!-- <h6 class="card-subtitle text-muted mb-2"><small><?php //echo date('d M, Y', strtotime($job['dated'])); ?></small></h6> -->
                <h6 class="card-subtitle text-muted mb-2 text-uppercase"><small><?php echo $job['job_category']; ?></small></h6>
                <h5 class="card-title"><strong><?php echo $job['job_title']; ?></strong></h5>
                <div class="card-text">
                  <p> <?php echo strip_tags( substr( $job['job_description'], 0, 200 ) ) . '...'; ?> </p>
                  <div class="row">
                    <div class="col"> <strong>Salary:</strong> <?php echo $job['job_salary']; ?> </div>
                    <div class="col"> <strong>Experience:</strong> <?php echo $job['job_experience_req']; ?> </div>
                    <div class="col"> <strong>Location:</strong> <?php echo $job['job_location']; ?> </div>
                  </div>
                </div>
                <a class="btn btn-color btn-sm mt-3" href="jobs-detail.php?job=<?php echo $job['jid']; ?>">View Details</a>
              </div>
            </div>
            <?php
          }
        } else {
          ?>
          <h6 class="card-subtitle text-muted mb-2 text-uppercase"><small>NOPE</small></h6>
          <h4 class="card-title"><strong>No jobs found!</strong></h4>
          <div class="card-text">
            <p class="lead"> Try using different combination of filters or contact us if problem persists. </p>
          </div>
          <a class="btn btn-dark btn-sm" href="jobs.php">View Default Listing</a>
          <?php
        }
        ?>

        <!-- pagination 2 -->
        <?php echo "<p class='mt-5 text-center'><strong> Page: ".$pagex. "</strong> </p>"; ?>
        <nav aria-label="Page navigation">
          <ul class="pagination justify-content-center w-100">
            <?php
              //pagination part 2
              $sql = "SELECT COUNT(jid) AS countx FROM jobs WHERE `status` = 'active' ";
              $stmt          = mysqli_query($conn, $sql);
              $lastid_data   = mysqli_fetch_array($stmt);
              $total_records = $lastid_data['countx'] ;
              $total_pages   = ceil($total_records / $items_per_page);
              //for first page
              $new_data = array("pagex" => "1");
              $full_data = array_merge($_GET, $new_data);
              $url = http_build_query($full_data);
              if( $total_pages > 0 ){
                echo '<li class="page-item"><a class="page-link" href="?'.$url.'">First</a></li>';
                //for each page
                if( $total_pages > 10 ){
                  $i = $pagex;
                  $min_pages = $i + 10 ;
                  if( $min_pages >= $total_pages ){
                    $i = $total_pages - 10;
                    $min_pages = $i + 10 ;
                  }
                  for ( $i; $i <= $min_pages; $i++) {
                    $new_data = array( "pagex" => $i );
                    $full_data = array_merge($_GET, $new_data);
                    $url = http_build_query($full_data);
                    if( $pagex == $i ){
                      echo '<li class="page-item active"><a class="page-link" href="?'.$url.'">'.$i.'</a></li>';
                    } else {
                      echo '<li class="page-item"><a class="page-link" href="?'.$url.'">'.$i.'</a></li>';
                    }
                  }
                  //dots to next page
                  if( ! ($min_pages >= $total_pages-10) ){
                    $new_data = array( "pagex" => $min_pages+1 );
                    $full_data = array_merge($_GET, $new_data);
                    $url = http_build_query($full_data);
                    echo "<a href=?$url> ... </a> ";
                  }
                } else {
                  for ( $i=1; $i <= $total_pages; $i++) {
                    $new_data = array( "pagex" => $i );
                    $full_data = array_merge($_GET, $new_data);
                    $url = http_build_query($full_data);
                    if( $pagex == $i ){
                      echo '<li class="page-item active"><a class="page-link" href="?'.$url.'">'.$i.'</a></li>';
                    } else {
                      echo '<li class="page-item"><a class="page-link" href="?'.$url.'">'.$i.'</a></li>';
                    }
                  }
                }
                //last page
                $new_data = array("pagex" => $total_pages);
                $full_data = array_merge($_GET, $new_data);
                $url = http_build_query($full_data);
                echo '<li class="page-item"><a class="page-link" href="?'.$url.'">Last</a></li>';
              }
            ?>
          </ul>
        </nav>

      </div>

    </div>
  </div>
</section>


<?php include('footer.php'); //footer ?>
