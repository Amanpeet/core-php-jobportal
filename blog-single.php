<?php include('header.php'); //header ?>

<section class="ftco-section-parallax page-title">
  <div class="parallax-img d-flex align-items-center">
    <div class="container">
      <div class="text-center heading-section heading-section-white mt-5">
        <h2>Blog Post</h2>
      </div>
    </div>
  </div>
</section>

<!-- section -->
<section class="site-section py-5 bg-light">
  <div class="container">

    <?php
    if( isset($_REQUEST['post']) && !empty($_REQUEST['post']) ){
      $bid = $_REQUEST['post'];
      //Simple select query
      $blog_sql = "SELECT * FROM blog WHERE `bid` = '$bid' ";
      $blog_query = mysqli_query($conn, $blog_sql);
      $post = mysqli_fetch_assoc($blog_query);

      if( !empty($post) ){ ?>

        <div class="heading-section text-center my-5">
          <h2 class=""><?php echo $post['blog_title']; ?></h2>
          <h6 class=" text-muted mt-4"><?php echo $post['dated']; ?></h6>
        </div>
        <div class="big-para limited pb-5"><?php echo $post['blog_content']; ?></div>

      <?php } else { ?>

        <div class="heading-section text-center my-5">
          <h2 class="">Post not Found!</h2>
          <div class="lead">No post found on giver address, please check your url or search above.</div>
        </div>

      <?php } ?>

    <?php } else { ?>

      <div class="heading-section text-center my-5">
        <h2 class="">Post not Found!</h2>
        <div class="lead">No post found on giver address, please check your url or search above.</div>
      </div>

    <?php } ?>

  </div>
</section>


<?php include('footer.php'); //footer ?>
