<?php include('header.php'); //header ?>

<section class="ftco-section-parallax page-title">
  <div class="parallax-img d-flex align-items-center">
    <div class="container">
      <div class="text-center heading-section heading-section-white mt-5">
        <h2>Blog</h2>
      </div>
    </div>
  </div>
</section>

<!-- section -->
<section class="site-section py-5 bg-light">
  <div class="container">

    <div class="heading-section text-center my-5">
      <h2 class=""><span>Recent</span> Posts</h2>
    </div>

    <div class="row">
      <div class="col-md-10 mx-auto mb-4">

        <?php
        //pagination part 1
        $items_per_page = 10;
        if (isset($_GET["pagex"])) {
          $pagex = $_GET["pagex"];
        } else {
          $pagex = 1;
        }
        $start_from = ($pagex - 1) * $items_per_page;

        //Simple select query
        $blog_sql = "SELECT * FROM blog ORDER BY bid DESC LIMIT $items_per_page OFFSET $start_from";
        $blog_query = mysqli_query($conn, $blog_sql);
        while($blog_row = mysqli_fetch_array($blog_query)) {
          $post_img = (!empty($blog_row['blog_image'])) ? $blog_row['blog_image'] : 'default.jpg';
          ?>

          <div class="card bg-white mb-4">
            <div class="row no-gutters">
              <div class="col-md-4">
                <img class="card-img cover-img" src="uploads/<?php echo $post_img; ?>" alt="">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h6 class="card-subtitle text-muted mb-2"><small><?php echo $blog_row['blog_date']; ?></small></h6>
                  <h5 class="card-title"><strong><?php echo $blog_row['blog_title']; ?></strong></h5>
                  <div class="card-text">
                    <?php echo strip_tags( substr( $blog_row['blog_content'], 0, 180 ) ) . '...'; ?>
                  </div>
                  <a class="btn btn-color btn-sm mt-3" href="blog-single.php?post=<?php echo $blog_row['bid']; ?>">Read More</a>
                </div>
              </div>
            </div>
          </div>

        <?php } ?>

        <!-- pagination 2 -->
        <?php echo "<p class='mt-5 text-center'><strong> Page: ".$pagex. "</strong> </p>"; ?>
        <nav aria-label="Page navigation">
          <ul class="pagination justify-content-center w-100">
            <?php
              //pagination part 2
              $sql = "SELECT COUNT(bid) AS countx FROM blog";
              $stmt          = mysqli_query($conn, $sql);
              $lastid_data   = mysqli_fetch_array($stmt);
              $total_records = $lastid_data['countx'] ;
              $total_pages   = ceil($total_records / $items_per_page);
              //for first page
              $new_data = array("pagex" => "1");
              $full_data = array_merge($_GET, $new_data);
              $url = http_build_query($full_data);
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
            ?>
          </ul>
        </nav>

      </div>
    </div>

  </div>
</section>


<?php include('footer.php'); //footer ?>
