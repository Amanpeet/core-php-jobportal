<!-- include header -->
<?php include('inc/header.php'); ?>

<?php
/* IF DELETE MEMBER */
if(isset($_REQUEST['del'])) {
  $id = $_REQUEST['del'];
  //not needed

/* IF UPDATE MEMBER */
} else if(isset($_REQUEST['edit'])) {
  $id = $_REQUEST['edit'];
  ?>
  <div class="p-2 border-bottom">
    <h3> <strong>Update Payment</strong> </h3>
    <p>Update Payment Amount, Enter new amount and hit <strong>UPDATE</strong> button. Title can't be changed.</p>
  </div>

  <!-- Operation updatemon -->
  <div id="response" class="h5">

    <!-- response for updatemon -->
    <div class="pt-2 pl-2 h4">
      <?php if( isset($_REQUEST['updated']) ) { ?>
        <strong class='text-success'>SUCCESS: Payment Details Updated Successfully.</strong>
      <?php } ?>
    </div>

    <?php
    if(isset($_POST['updatemon'])) {

      //required
      // $amt_title  = mysqli_real_escape_string($conn, $_POST['amt_title']);
      $amount = mysqli_real_escape_string($conn, $_POST['amount']);
      $amt_notes  = mysqli_real_escape_string($conn, $_POST['amt_notes']);

      if( empty($amount) ){
        echo "<strong class='text-danger'>ERROR: Required fields Empty or Invalid. Please try again.</strong>";
        // exit;
      } else {

        // update products to db
        $update = "UPDATE amounts SET amount='$amount', amt_notes='$amt_notes' WHERE aid = '$id' ";
        $quer = mysqli_query($conn, $update);
        if($quer){
          echo "<strong>SUCCESS: Payment Details Updated Successfully.</strong>";
          echo '<script>window.location="amounts.php?updated=1";</script>';
          // echo '<script>window.location="amounts-single.php?edit='.$id.'&updated=1";</script>';
        } else {
          echo "<strong class='text-danger'>ERROR: Payment Details not Updated. Please try again later.</strong>";
        }

      }
    }
    ?>
  </div>

  <!-- update form -->
  <div class="form-box p-2">
    <form id="id_card_form" name="id_card_form" action="" method="post" enctype="multipart/form-data">
      <?php
        $select = "SELECT * FROM amounts WHERE aid = '$id'";
        $que = mysqli_query($conn, $select);
        $fet = mysqli_fetch_array($que);
        $datef = date('d M, Y', strtotime($fet['updated']));
      ?>
      <div class="py-3">
        <small> Previously updated on <?php echo $datef; ?> </small>
      </div>
      <table class="table table-bordered">
        <tbody>
          <tr>
            <td style="width: 20%;"> Payment Title </td>
            <td style="width: 60%;">
              <input type="text" class="form-control" name="amt_title" required value="<?php echo $fet['amt_title']; ?>" id="amt_title" disabled>
            </td>
            <td style="width: 20%;">
            </td>
          </tr>
          <tr>
            <td> Payment Amount (USD) </td>
            <td>
            <input type="text" class="form-control" name="amount" required value="<?php echo $fet['amount']; ?>" id="amount" required>
            </td>
          </tr>
          <tr>
            <td> Extra Notes </td>
            <td>
              <textarea class="form-control" name="amt_notes" id="amt_notes"><?php echo $fet['amt_notes']; ?></textarea>
            </td>
          </tr>
        </tbody>
      </table>

      <div class="my-4">
        <input type="submit" class="btn btn-primary" name="updatemon" value="UPDATE">
        <a href="amounts.php" class="btn btn-dark">Back</a> <br><br>
      </div>

    </form>
  </div>
  <?php

/* ELSE SHOW MEMBER */
} else if(isset($_REQUEST['view'])) {
  $id = $_REQUEST['view'];
  //not needed

/* ELSE SHOW ERROR */
} else {
  ?>
  <div class="p-3 border-bottom">
    <h3> <strong>Payment not found</strong> </h3>
    <p>No Payment found via given id. Please go back and try again.</p>
  </div>
  <?php

} //if else end
?>

<!-- include header -->
<?php include('inc/footer.php'); ?>