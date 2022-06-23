<?php include('inc/header.php'); ?>

<!-- user profile -->
<?php
if( isset($_REQUEST['user']) ) {
  $find_user = $_REQUEST['user'];
  ?>
      <!-- SHOW ALL ITEMS HERE -->
      <div class="p-2 border-bottom">
        <h3> <strong>User Profile </strong> </h3>
        <p>Viewing individual Profile of user account.</p>
      </div>

      <div class="p-2">
        <?php
        $select = "SELECT * FROM admins WHERE username='$find_user' UNION SELECT * FROM users WHERE username='$find_user' LIMIT 1 ";
        $quer = mysqli_query($conn, $select);
        while($fetch = mysqli_fetch_array($quer)){
          $datef = date('d M, Y', strtotime($fetch['dated']));
          ?>
          <table class="table table-bordered table-striped table-responsive-md">
            <tbody>
              <tr>
                <td style="width: 30%;"> Username </td>
                <td style="width: 70%;">
                  <strong><?php echo $fetch['username']; ?></strong>
                </td>
              </tr>
              <tr>
                <td> Role </td>
                <td> <strong><?php echo $fetch['role']; ?></strong> </td>
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
                <td> Joined </td>
                <td> <strong><?php echo $datef; ?></strong> </td>
              </tr>
            </tbody>
          </table>
          <?php
        }
        ?>
      </div>
  <?php


} else { /* ELSE SHOW ERROR */
  ?>
  <div class="p-3 border-bottom">
    <h3> <strong>No user found!</strong> </h3>
    <p>No Data found via given id. Please go back and try again.</p>
  </div>
  <?php
} //if else end
?>

<!-- include header -->
<?php include('inc/footer.php'); ?>