<?php include('inc/header.php'); ?>

<!-- check if user role is allowed -->
<?php
if( (!$admin) ){
  echo "<h4>Access not allowed.</h4>";
  exit;
}
?>

<?php
/* IF DELETE MEMBER */
if( isset($_REQUEST['del']) ) {
  $id = $_REQUEST['del'];
  ?>
    <div class="p-2 border-bottom">
      <h3> <strong>Delete Item</strong> </h3>
      <p>Confirm deletion of Specific Item.</p>
    </div>
    <div class="form-box p-2">
      <form id="id_card_form" name="id_card_form" action="" method="post">
        <?php
          $select = "SELECT * FROM admins WHERE uid = '$id' AND username != 'admin' "; //save admin
          $que = mysqli_query($conn, $select);
          $fet = mysqli_fetch_array($que);
        ?>
        <h5>Do you really want to delete id: <strong><?php echo $fet['uid']; ?> (Name: <?php echo $fet['username']; ?>) </strong>from database? </h5>
        <p> Note: This action cannot be undone. </p>
        <div class="text-left">
          <input type="submit" class="btn btn-primary" name="deletemon" value="Delete">
          <a class="btn btn-dark" href="admins.php">Cancel</a>
          <br><br>
        </div>
      </form>
    </div>

    <div id="response" class="h5 pt-3 text-danger">
      <?php
      if(isset($_POST['deletemon'])){
        $delete = "DELETE FROM admins WHERE uid = '$id' AND username != 'admin' ";
        $quer = mysqli_query($conn, $delete);
        if($quer){
          userlog('admin_delete', "Deleted admin with id: $id"); //record keeping
          echo "<strong>SUCCESS: Admin Deleted. Redirecting back...";
          echo '<script>window.location="admins.php";</script>';
        } else{
          echo "<strong>ERROR: Admin not deleted. Please try again later.</strong>";
        }
      }
      ?>
    </div>
    <?php

/* IF ADD MEMBER */
} elseif( isset($_REQUEST['add']) ) {
  $id = $_REQUEST['add'];
  ?>
  <div class="p-2 border-bottom">
    <h3> <strong>Add Admin</strong> / Editor </h3>
    <p>Write Details and Hit <strong>Add Admin</strong> on bottom. Username can't be changed later.</p>
  </div>

  <!-- Operation updatemon -->
  <div id="response" class="h5 pt-3 text-danger">
    <?php
    if(isset($_POST['addmon'])) {

      // Required field names
      $required_fields = array(
        'username',
        'password',
        'role',
      );

      // Loop over fields, check if unset or empty
      $error = false;
      foreach($required_fields as $field) {
        if ( !isset( $_POST[$field] ) || empty( $_POST[$field] ) ) {
          $error = true;
          echo "<strong> ERROR: Required fields Empty or Invalid. </strong>".$_POST[$field];
        } else {
          $trim_val = mysqli_real_escape_string($conn, $_POST[$field]);
          if ( trim($trim_val) == '' ){
            $error = true;
            echo "<strong> ERROR: Required fields cant be just spaces. </strong>";
          }
        }
      }
      if( !$error ){

        // get values
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $phone    = mysqli_real_escape_string($conn, $_POST['phone']);
        $email    = mysqli_real_escape_string($conn, $_POST['email']);
        $role     = mysqli_real_escape_string($conn, $_POST['role']);

        //get old values
        $ex_sql = "SELECT username FROM admins WHERE username = '$username' UNION ALL SELECT username FROM admins WHERE username = '$username'";
        $ex_query = mysqli_query($conn, $ex_sql);
        $ex_row   = mysqli_fetch_array($ex_query);
        if( mysqli_num_rows($ex_query) > 0 ){
          echo "<strong>ERROR: Username already Exists. Please try again.</strong>";
        } elseif( !preg_match('/^[a-z0-9]{4,20}$/', $username) ){ //validate username
          echo "<strong>ERROR: Username seems invalid. Please try again.</strong>";
        } else {

          // add to db
          $insert_sql = "INSERT INTO admins(`username`, `password`, `phone`, `email`, `role`) VALUES( '$username', MD5('$password'), '$phone', '$email', '$role' ) ";
          $quer = mysqli_query($conn, $insert_sql);
          $last = mysqli_insert_id($conn);
          if($quer){
            userlog('admin_add', "Added new admin with id: $last"); //record keeping
            echo "<strong>SUCCESS: New Admin Added Successfully.</strong>";
            echo '<script>window.location="admins-single.php?view='.$last.'&added=1";</script>';
          } else {
            echo "<strong>ERROR: New Admin not Added. Please try again later.</strong>";
          }
        }
      }
    }
    ?>
  </div>

  <!-- add form -->
  <div class="form-box p-2">
    <form id="id_card_form" name="id_card_form" action="" method="post" enctype="multipart/form-data">
      <div class="py-2">
        <small> Username and password are required fields, Select User Role. </small>
      </div>
      <table class="table table-bordered table-responsive-md">
        <tbody>
          <tr>
            <td style="width: 20%;"> Username </td>
            <td style="width: 60%;">
              <input type="text" class="form-control" name="username" required>
            </td>
            <td style="width: 20%;">
            </td>
          </tr>
          <tr>
            <td> Password </td>
            <td>
              <input type="text" class="form-control" name="password" required>
            </td>
          </tr>
          <tr>
            <td> Phone </td>
            <td>
              <input type="tel" class="form-control" name="phone">
            </td>
          </tr>
          <tr>
            <td> Email </td>
            <td>
              <input type="email" class="form-control" name="email">
            </td>
          </tr>
          <tr>
            <td> Role </td>
            <td>
              <select name="role" class="form-control" required>
                <option value="editor">Editor</option>
                <option value="admin">Admin</option>
              </select>
            </td>
          </tr>
        </tbody>
      </table>

      <div class="my-4">
        <input type="submit" class="btn btn-primary" name="addmon" value="ADD ADMIN">
        <a href="admins.php" class="btn btn-dark">Cancel</a> <br><br>
      </div>

    </form>
  </div>
  <?php

/* IF UPDATE MEMBER */
} elseif( isset($_REQUEST['edit']) ) {
  $id = $_REQUEST['edit'];
  ?>
  <div class="p-2 border-bottom">
    <h3> <strong>Edit Admin</strong> </h3>
    <p>Edit Details and Hit <strong>UPDATE</strong> on bottom. Some fields can't be changed.</p>
  </div>

  <!-- Operation updatemon -->
  <div id="response" class="h5 pt-3 text-danger">
    <?php
    if(isset($_POST['updatemon'])) {

      $error = false;
      //get old values
      $ex_sql   = "SELECT * FROM admins WHERE `uid` = '$id' AND username != 'admin' ";
      $ex_query = mysqli_query($conn, $ex_sql);
      $ex_row   = mysqli_fetch_array($ex_query);
      $password = $ex_row['password'];
      $phone    = $ex_row['phone'];
      $email    = $ex_row['email'];
      $role     = $ex_row['role'];

      if( isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['password2']) && !empty($_POST['password2']) ) {
        $pass1 = mysqli_real_escape_string($conn, $_POST['password']);
        $pass2 = mysqli_real_escape_string($conn, $_POST['password2']);
        if( $pass1 != $pass2 ){
          echo "<strong>ERROR: Passwords doesnt match, Not Updated. </strong>";
        } else {
          $password = mysqli_real_escape_string($conn, $_POST['password']);
          // $password1 = mysqli_real_escape_string($conn, $_POST['password2']); //not needed
        }
      }

      if( isset($_POST['phone']) && !empty($_POST['phone']) ) {
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
      }

      if( isset($_POST['email']) && !empty($_POST['email']) ) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
      }

      if( isset($_POST['role']) && !empty($_POST['role']) ) {
        $role = mysqli_real_escape_string($conn, $_POST['role']);
      }

      if( !$error ){
        // update products to db
        $update = "UPDATE admins SET `password` = MD5('$password'), `phone` = '$phone', `email` = '$email', `role` = '$role' WHERE `uid` = '$id' ";
        $quer = mysqli_query($conn, $update);
        if($quer){
          echo "<strong class='text-success'> Admin Details Updated.</strong>";
          userlog('admin_edit', "Edited admin info with id: $id"); //record keeping
          // echo '<script>window.location="admins-single.php?view='.$id.'&updated=1";</script>';
          // echo '<script>window.location="#response";</script>';
        } else {
          echo "<strong>ERROR: Admin not Updated. Please try again later.</strong>";
        }
      }

    }
    ?>
  </div>

  <!-- update form -->
  <div class="form-box p-2">
    <form id="id_card_form" name="id_card_form" action="" method="post" enctype="multipart/form-data">
      <?php
        $select = "SELECT * FROM admins WHERE uid = '$id' AND username != 'admin'";
        $que = mysqli_query($conn, $select);
        $fet = mysqli_fetch_array($que);
        $datef = date('d M, Y', strtotime($fet['dated']));
      ?>
      <div class="py-3">
        <small> Added on <?php echo $datef; ?> </small>
      </div>
      <table class="table table-bordered table-responsive-md">
        <tbody>
          <tr>
            <td style="width: 20%;"> Username </td>
            <td style="width: 60%;">
              <input type="text" class="form-control" name="username" disabled value="<?php echo $fet['username']; ?>">
            </td>
            <td style="width: 20%;">
            </td>
          </tr>
          <tr>
            <td> New Password </td>
            <td>
              <input type="text" class="form-control" name="password" placeholder="new password">
            </td>
          </tr>
          <tr>
            <td> Confirm Password </td>
            <td>
              <input type="text" class="form-control" name="password2" placeholder="confirm password">
            </td>
          </tr>
          <tr>
            <td> Phone </td>
            <td>
              <input type="tel" class="form-control" name="phone" value="<?php echo $fet['phone']; ?>">
            </td>
          </tr>
          <tr>
            <td> Email </td>
            <td>
              <input type="email" class="form-control" name="email" value="<?php echo $fet['email']; ?>">
            </td>
          </tr>
          <tr>
            <td> Role </td>
            <td>
              <select name="role" class="form-control">
                <option value="">Select New Role</option>
                <option value="editor">Editor</option>
                <option value="admin">Admin</option>
              </select>
              <small>Current role: <strong><?php echo $fet['role']; ?></strong></small>
            </td>
          </tr>
        </tbody>
      </table>

      <div class="my-4">
        <input type="submit" class="btn btn-primary" name="updatemon" value="UPDATE ADMIN">
        <a href="admins.php" class="btn btn-dark">Cancel</a> <br><br>
      </div>

    </form>
  </div>
  <?php

/* IF VIEW MEMBER */
} elseif( isset($_REQUEST['view']) ) {
  $id = $_REQUEST['view'];
  ?>
      <!-- SHOW ALL ITEMS HERE -->
      <div class="p-2 border-bottom">
        <h3> <strong>View Admin</strong> </h3>
        <p>Viewing individual Item details. Click <strong>Edit</strong> on right to modify details.</p>
      </div>

      <!-- response for updatemon -->
      <div class="pt-2 pl-2 h4">
        <?php
        if( isset($_REQUEST['updated']) ) {
          echo "<strong>SUCCESS: User Details Updated Successfully.</strong>";
        } elseif( isset($_REQUEST['added']) ) {
          echo "<strong>SUCCESS: New User Added Successfully.</strong>";
        }
        ?>
      </div>

      <div class="p-2">
        <?php
        $select = "SELECT * FROM admins WHERE `uid` = '$id' AND username != 'admin' ";
        $quer = mysqli_query($conn, $select);
        while($fetch = mysqli_fetch_array($quer)){
          $datef = date('d M, Y', strtotime($fetch['dated']));
          $user_name = $fetch['username'];
          ?>
          <div class="pb-3">
            <small> Added on <?php echo $datef; ?> </small><br>
            <a class="btn btn-primary" href="admins-single.php?edit=<?php echo $fetch['uid']; ?>">Edit this</a>
            <a class="btn btn-danger" href="admins-single.php?del=<?php echo $fetch['uid']; ?>">Delete</a>
          </div>

          <div class="row">
            <div class="col-md-8">
              <table class="table table-bordered table-responsive-md">
                <tbody>
                  <tr>
                    <td style="width: 30%;"> Username </td>
                    <td style="width: 70%;">
                      <strong><?php echo $fetch['username']; ?></strong>
                    </td>
                  </tr>
                  <tr>
                    <td> Full Name </td>
                    <td> <strong><?php echo $fetch['fullname']; ?></strong> </td>
                  </tr>
                  <tr>
                    <td> Phone </td>
                    <td> <strong><?php echo $fetch['phone']; ?></strong> </td>
                  </tr>
                  <tr>
                    <td> Email </td>
                    <td> <strong><?php echo $fetch['email']; ?></strong> </td>
                  </tr>
                  <tr>
                    <td> Address </td>
                    <td> <strong><?php echo $fetch['address']; ?></strong> </td>
                  </tr>
                  <tr>
                    <td> Added </td>
                    <td> <strong><?php echo $datef; ?></strong> </td>
                  </tr>
                  <tr>
                    <td> Status </td>
                    <td> <strong><?php echo $fetch['status']; ?></strong> </td>
                  </tr>

                </tbody>
              </table>
            </div>
            <div class="col-md-4">
              <table class="table table-bordered table-responsive-md">
                <tbody>
                  <tr>
                    <td style="width: 50%;"> <strong>Activity</strong> </td>
                    <td style="width: 50%;"> <strong>Count</strong> </td>
                  </tr>
                  <?php
                  $activity_sql = "SELECT COUNT(*) as `count`, `action_term` FROM userlog WHERE `user_name` = '$user_name' GROUP BY action_term ";
                  $activity_res = mysqli_query($conn, $activity_sql);
                  while($activity_row = mysqli_fetch_array($activity_res)){
                    $datef = date('d M, Y', strtotime($fetch['dated']));
                    ?>
                    <tr>
                      <td> <?php echo $activity_row['action_term']; ?> </td>
                      <td> <?php echo $activity_row['count']; ?> </td>
                    </tr>
                    <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>

          <?php
        }
        ?>
      </div>
  <?php

/* ELSE SHOW ERROR */
} else {
  ?>
  <div class="p-3 border-bottom">
    <h3> <strong>Data not found</strong> </h3>
    <p>No Data found via given id. Please go back and try again.</p>
  </div>
  <?php
} //if else end
?>

<!-- include header -->
<?php include('inc/footer.php'); ?>