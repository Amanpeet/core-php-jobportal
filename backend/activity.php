<?php include('inc/header.php'); ?>

<!-- page title -->
<div class="p-3 border-bottom">
  <h3> <strong>Activity Log</strong> </h3>
  <p>Listing the activity of generated events on site <strong>sorted by date</strong>.</p>
</div>

<!-- content & forms -->
<div class="p-2">
  <!-- pagination 1 -->
  <?php
    //pagination part 1
    $items_per_page = 50;
    if (isset($_GET["pagex"])) {
      $pagex = $_GET["pagex"];
    } else {
      $pagex = 1;
    }
    // echo "<p><strong> Page: ".$pagex. "</strong> </p>";
    $start_from = ($pagex - 1) * $items_per_page;
  ?>

  <!-- data -->
  <div class="bulky mb-2">
    <form id="search_form" name="search_form" action="" method="get">
      <div class="form-row">
        <div class="form-group col pt-2">
          <?php echo "<strong> Page: ".$pagex. "</strong>"; ?>
          <?php
          if( isset($_REQUEST['search']) && !empty($_REQUEST['search']) ) {
            echo " Showing results for: <strong>".$_REQUEST['search']. "</strong>";
          }
          ?>
        </div>
        <div class="form-group col-3 ml-auto">
          <div class="input-group mb-3">
            <input class="form-control" type="text" name="search" id="search" placeholder="username">
            <div class="input-group-append">
              <button class="btn btn-dark" type="submit">Search</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>

  <!-- data -->
  <table class="table table-striped table-bordered table-responsive-md">
    <thead>
      <tr>
        <th style="width:15%">Username</th>
        <th style="width:15%">Role</th>
        <th style="width:15%">Action</th>
        <th style="width:35%">Details</th>
        <th style="width:20%">Date</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $select = "SELECT * FROM userlog ORDER BY `dated` DESC LIMIT $items_per_page OFFSET $start_from";
      if( isset($_REQUEST['search']) && !empty($_REQUEST['search']) ) {
        $user_name = $_REQUEST['search'];
        $select = "SELECT * FROM userlog WHERE `user_name` = '$user_name' ORDER BY `dated` DESC LIMIT $items_per_page OFFSET $start_from";
      }

      $quer = mysqli_query($conn, $select);
      while($fetch = mysqli_fetch_array($quer)){ ?>
        <tr>
          <td>
            <a href="user-profile.php?user=<?php echo $fetch['user_name']; ?>"><?php echo $fetch['user_name']; ?></a>
          </td>
          <td><?php echo $fetch['user_role']; ?></td>
          <td><?php echo $fetch['action_term']; ?></td>
          <td><?php echo $fetch['action_details']; ?></td>
          <td><?php echo date('d-M-Y H:i:s', strtotime($fetch['dated'])); ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

  <!-- pagination 2 -->
  <?php echo "<p><strong> Page: ".$pagex. "</strong> </p>"; ?>
  <nav aria-label="Page navigation example">
    <ul class="pagination">
      <?php
        //pagination part 2
        $sql = "SELECT COUNT(uid) AS countx FROM userlog";
        if( isset($_REQUEST['search']) && !empty($_REQUEST['search']) ) {
          $user_name = $_REQUEST['search'];
          $sql = "SELECT COUNT(uid) AS countx FROM userlog WHERE `user_name` = '$user_name'";
        }
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

<!-- include header -->
<?php include('inc/footer.php'); ?>