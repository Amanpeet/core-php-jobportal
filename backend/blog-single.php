<!-- include header -->
<?php include('inc/header.php'); ?>

<?php
/* IF DELETE ITEM */
if(isset($_REQUEST['del'])) {
  $id = $_REQUEST['del'];
  ?>
    <div class="p-2 border-bottom">
      <h3> <strong>Delete Item</strong> </h3>
      <p>Confirm deletion of Specific Item.</p>
    </div>
    <div class="form-box p-2">
      <form id="id_card_form" name="id_card_form" action="" method="post">
        <?php
          $select = "SELECT * FROM blog WHERE bid = '$id'";
          $que = mysqli_query($conn, $select);
          $fet = mysqli_fetch_array($que);
        ?>
        <h5>Do you really want to delete post <strong><?php echo $fet['bid']; ?> (Title: <?php echo $fet['blog_title']; ?>) </strong>from database? </h5>
        <h6 class="text-danger"> Note: This action cannot be undone. </h6>
        <div class="text-left my-4">
          <input type="submit" class="btn btn-danger" name="deletemon" value="Delete">
          <a class="btn btn-dark" href="blog.php">Cancel</a>
        </div>
      </form>
    </div>

    <div id="response" class="h4">
      <?php
      if(isset($_POST['deletemon'])){
        $delete = "DELETE FROM blog WHERE bid = '$id' ";
        $quer = mysqli_query($conn, $delete);
        if($quer){
          echo "<strong>SUCCESS: Post Deleted. Redirecting back...";
          echo '<script>window.location="blog.php";</script>';
        } else{
          echo "<strong>ERROR: Post not deleted. Please try again later.</strong>";
        }
      }
      ?>
    </div>
    <?php

/* IF UPDATE ITEM */
} else if(isset($_REQUEST['edit'])) {
  $id = $_REQUEST['edit'];
  ?>
    <div class="p-2 border-bottom">
      <h3> <strong>Update Blog Post</strong> </h3>
      <p>Update Blog, Replace Image, Edit Title and Content and hit <strong>UPDATE</strong> button.</p>
    </div>

    <!-- Operation updatemon -->
    <div id="response" class="h5">

      <!-- response for updatemon -->
      <div class="pt-2 pl-2 h4">
        <?php if( isset($_REQUEST['updated']) ) { ?>
          <strong class='text-success'>SUCCESS: Post Updated Successfully.</strong>
        <?php } ?>
      </div>

      <?php
      if(isset($_POST['updatemon'])) {

        //required
        $blog_title   = mysqli_real_escape_string($conn, $_POST['blog_title']);
        $blog_content = mysqli_real_escape_string($conn, $_POST['blog_content']);
        $blog_date    = mysqli_real_escape_string($conn, $_POST['blog_date']);

        $accepted_img = array("jpeg", "jpg", "png", "JPEG", "JPG", "PNG");
        $uniqd = round(microtime(true));

        //grab existing files
        $select = "SELECT * FROM blog WHERE bid = '$id'";
        $que = mysqli_query($conn, $select);
        $fet = mysqli_fetch_array($que);
        $blog_image = $fet['blog_image'];

        //file1
        // $blog_image = '';
        $fileserr1 = false;
        if( empty($_FILES['blog_image']) ){
          // $blog_image = '';
          $fileserr1 = false;
        } elseif( ($_FILES['blog_image']['size'] == 0) ){
          // $blog_image = '';
          $fileserr1 = false;
        } else if( $_FILES['blog_image']['size'] > (1*1024*1024) ) { //1MB
          $fileserr1 = true;
        } else {
          $temp = explode(".", $_FILES["blog_image"]["name"]);
          $ext  = end($temp);
          if( in_array($ext, $accepted_img ) == false ){
            $fileserr1 = true;
          } else {
            $newfilename_new = 'blog_' . $uniqd . '.' . end($temp);
            $newfilename = (!empty($blog_image)) ? $blog_image : $newfilename_new; //make new name if not found
            $imagetmp    = trim($_FILES['blog_image']['tmp_name']);
            $path        = "../uploads/".$newfilename;
            move_uploaded_file($imagetmp, $path);
            $blog_image = $newfilename;
            $fileserr1 = false;
          }
        }

        if( empty($blog_title) || $fileserr1 ){
          echo "<strong class='text-danger'>ERROR: Required fields or Image is Empty or Invalid. Please try again.</strong>";
          // exit;
        } else {

          // update products to db
          $update = "UPDATE blog SET blog_title='$blog_title', blog_image='$blog_image', blog_content='$blog_content', blog_date='$blog_date' WHERE bid = '$id' ";
          $quer = mysqli_query($conn, $update);
          if($quer){
            echo "<strong class='text-success'>SUCCESS: Post Updated Successfully.</strong>";
            echo '<script>window.location="blog-single.php?edit='.$id.'&updated=1";</script>';
            // echo '<script>window.location="#response";</script>';
          } else {
            echo "<strong>ERROR: Post not Updated. Please try again later.</strong>";
          }

        }
      }
      ?>
    </div>

    <!-- update form -->
    <div class="form-box p-2">
      <form id="id_card_form" name="id_card_form" action="" method="post" enctype="multipart/form-data">
        <?php
          $select = "SELECT * FROM blog WHERE bid = '$id'";
          $que = mysqli_query($conn, $select);
          $fet = mysqli_fetch_array($que);
          $datef = date('d M, Y', strtotime($fet['dated']));
        ?>
        <div class="py-3">
          <small> Created on <?php echo $datef; ?> </small>
        </div>
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td style="width: 200px;"> # </td>
              <td>
                <input type="text" class="form-control" name="bid" value="<?php echo $fet['bid']; ?>" disabled required>
              </td>
            </tr>
            <tr>
              <td> Post Title </td>
              <td>
                <input type="text" class="form-control" name="blog_title" value="<?php echo $fet['blog_title']; ?>"  required>
              </td>
            </tr>
            <tr>
              <td> Post Image </td>
              <td>
                <input type="file" class="form-control-file" name="blog_image" accept="image/*" />
                <small class="text-muted">Uploading new file will replace old file, Max 1MB. <?php echo (!empty($fet['blog_image'])) ? ' <a href="../uploads/'.$fet["blog_image"].'" target="_blank" /> View Current File </a> ' : ''; ?> </small>
              </td>
            </tr>
            <tr>
              <td> Post Content </td>
              <td>
                <textarea class="form-control" name="blog_content" style="height:320px;" required><?php echo $fet['blog_content']; ?></textarea>
                <small>*Paste as html with links</small>
              </td>
            </tr>
            <tr>
              <td> Post Date </td>
              <td>
                <input type="text" class="form-control" name="blog_date" value="<?php echo $fet['blog_date']; ?>">
              </td>
            </tr>
          </tbody>
        </table>

        <div class="my-4">
          <input type="submit" class="btn btn-primary" name="updatemon" value="UPDATE">
          <a href="blog.php" class="btn btn-dark">Back</a> <br><br>
        </div>

      </form>
    </div>
  <?php

/* ELSE SHOW ITEM */
} else if(isset($_REQUEST['view'])) {
  $id = $_REQUEST['view'];
  //not needed

/* ELSE ADD ITEM */
} else if(isset($_REQUEST['add'])) {
  $id = $_REQUEST['add'];
  //not needed
  ?>
    <div class="p-2 border-bottom">
      <h3> <strong>ADD Post</strong> </h3>
      <p>Add new item, Enter Title and Content and hit <strong>UPDATE</strong> button.</p>
    </div>

    <!-- Operation updatemon -->
    <div id="response" class="h5">

      <!-- response for updatemon -->
      <div class="pt-2 pl-2 h4">
        <?php if( isset($_REQUEST['added']) ) { ?>
          <strong class='text-success'>SUCCESS: Post Added Successfully.</strong>
        <?php } ?>
      </div>

      <?php
      if(isset($_POST['addnew'])) {

        //required
        $blog_title   = mysqli_real_escape_string($conn, $_POST['blog_title']);
        $blog_content = mysqli_real_escape_string($conn, $_POST['blog_content']);
        $blog_date    = mysqli_real_escape_string($conn, $_POST['blog_date']);

        $accepted_img = array("jpeg", "jpg", "png", "JPEG", "JPG", "PNG");
        $uniqd = round(microtime(true));

        //file1
        $blog_image = '';
        $fileserr1 = false;
        if( empty($_FILES['blog_image']) ){
          $blog_image = '';
          $fileserr1 = false;
        } elseif( ($_FILES['blog_image']['size'] == 0) ){
          $blog_image = '';
          $fileserr1 = false;
        } else if( $_FILES['blog_image']['size'] > (1*1024*1024) ) { //1MB
          $fileserr1 = true;
        } else {
          $temp = explode(".", $_FILES["blog_image"]["name"]);
          $ext  = end($temp);
          if( in_array($ext, $accepted_img ) == false ){
            $fileserr1 = true;
          } else {
            $newfilename = 'blog_'. $uniqd . '.' . end($temp);
            $imagetmp    = trim($_FILES['blog_image']['tmp_name']);
            $path        = "../uploads/".$newfilename;
            move_uploaded_file($imagetmp, $path);
            $blog_image = $newfilename;
            $fileserr1 = false;
          }
        }

        if( empty($blog_title) || $fileserr1 ){
          echo "<strong class='text-danger'>ERROR: Required fields or Image is Empty or Invalid. Please try again.</strong>";
          // exit;
        } else {

          // update products to db
          $update = "INSERT INTO blog (blog_title, blog_image, blog_content, blog_date) VALUES ('$blog_title', '$blog_image','$blog_content', '$blog_date') ";
          $quer = mysqli_query($conn, $update);
          $last_id = mysqli_insert_id ( $conn );
          if($quer){
            echo "<strong class='text-success'>SUCCESS: Post added successfully.</strong>";
            echo '<script>window.location="blog-single.php?edit='.$last_id.'&added=1";</script>';
            // echo '<script>window.location="#response";</script>';
          } else {
            echo "<strong>ERROR: Post not added. Please try again later.</strong>";
          }

        }
      }
      ?>
    </div>

    <!-- update form -->
    <div class="form-box p-2">
      <form id="id_card_form" name="id_card_form" action="" method="post" enctype="multipart/form-data">
        <?php
          $select = "SELECT * FROM blog WHERE bid = '$id'";
          $que = mysqli_query($conn, $select);
          $fet = mysqli_fetch_array($que);
          $datef = date('d M, Y', strtotime($fet['dated']));
        ?>
        <div class="py-3">
          <small> Created on <?php echo $datef; ?> </small>
        </div>
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td style="width:200px"> Post Title </td>
              <td>
                <input type="text" class="form-control" name="blog_title" placeholder="main title" required>
              </td>
            </tr>
            <tr>
              <td> Post Image </td>
              <td>
                <input type="file" class="form-control-file" name="blog_image" accept="image/*" />
                <small class="text-muted">Max size allowed 1MB </small>
              </td>
            </tr>
            <tr>
              <td> Post Content </td>
              <td>
                <textarea class="form-control" name="blog_content" style="height:320px;" required></textarea>
                <small>*Paste as html with links</small>
              </td>
            </tr>
            <tr>
              <td> Post Date </td>
              <td>
                <input type="text" class="form-control" name="blog_date" placeholder="dd/mm/yyyy">
              </td>
            </tr>
          </tbody>
        </table>

        <div class="my-4">
          <input type="submit" class="btn btn-primary" name="addnew" value="CREATE POST">
          <a href="blog.php" class="btn btn-dark">Back</a> <br><br>
        </div>

      </form>
    </div>
  <?php

/* ELSE SHOW ERROR */
} else {
  ?>
  <div class="p-3 border-bottom">
    <h3> <strong>Post not found</strong> </h3>
    <p>No Post found via given id. Please go back and try again.</p>
  </div>
  <?php

} //if else end
?>

<!-- include header -->
<?php include('inc/footer.php'); ?>