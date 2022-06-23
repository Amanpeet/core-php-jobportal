<?php include('inc/header.php'); ?>

<!-- page title -->
<div class="p-3 border-bottom">
  <h3> <strong>View/Edit Jobs</strong> </h3>
  <p>Click on <strong>View</strong> to view or edit the employer.</p>
  <a class="btn btn-primary" href="jobs-single.php?add=1">+ Add New Job</a>
</div>

<!-- content & forms -->
<div class="p-2">
  <!-- pagination 1 -->
  <?php
    //pagination part 1
    $items_per_page = 20;
    if (isset($_GET["pagex"])) {
      $pagex = $_GET["pagex"];
    } else {
      $pagex = 1;
    }
    echo "<p><strong> Page: ".$pagex. "</strong> </p>";
    $start_from = ($pagex - 1) * $items_per_page;
  ?>

  <!-- data -->
  <table class="table table-striped table-bordered table-responsive-md">
    <thead>
      <tr>
        <th>Job Title</th>
        <th>Category</th>
        <th>Posted</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $select = "SELECT * FROM jobs ORDER BY `jid` DESC LIMIT $items_per_page OFFSET $start_from";
      $quer = mysqli_query($conn, $select);
      while($fetch = mysqli_fetch_array($quer)){ ?>
        <tr>
          <td><?php echo $fetch['job_title']; ?></td>
          <td><?php echo $fetch['job_category']; ?></td>
          <td><?php echo date('d M, Y', strtotime($fetch['dated'])); ?></td>
          <td><?php echo $fetch['status']; ?></td>
          <td>
            <a class="btn btn-dark btn-sm" href="jobs-single.php?view=<?php echo $fetch['jid']; ?>">View</a>
            <?php if($admin || $editor){ ?>
              <a class="btn btn-primary btn-sm" href="jobs-single.php?edit=<?php echo $fetch['jid']; ?>">Edit</a>
              <a class="btn btn-danger btn-sm" href="jobs-single.php?del=<?php echo $fetch['jid']; ?>">Delete</a>
            <?php } ?>
          </td>
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
        $sql = "SELECT COUNT(jid) AS countx FROM `jobs` ";
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