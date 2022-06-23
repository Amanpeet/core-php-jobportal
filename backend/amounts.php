<!-- include header -->
<?php include('inc/header.php'); ?>

<!-- page title -->
<div class="p-3 border-bottom">
  <h3> <strong>Payments Table</strong> </h3>
  <p>All the payment values on website are listed below. Click <strong>Update</strong> to edit.</p>
</div>

<!-- content & forms -->
<div class="p-2">

  <!-- data -->
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th style="width:50px;">#</th>
        <th>Payment Title</th>
        <th>Amount (USD)</th>
        <th>Uupdated</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $select = "SELECT * FROM amounts ORDER BY aid ASC";
      $quer = mysqli_query($conn, $select);
      while($fetch = mysqli_fetch_array($quer)){ ?>
        <tr>
          <td><?php echo $fetch['aid']; ?></td>
          <td><?php echo $fetch['amt_title']; ?></td>
          <td> <strong> &#8377; <?php echo $fetch['amount']; ?> </strong> </td>
          <td><?php echo date('d M, Y', strtotime($fetch['updated'])); ?></td>
          <td>
            <a href="amounts-single.php?edit=<?php echo $fetch['aid']; ?>">Update</a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

</div>

<!-- include header -->
<?php include('inc/footer.php'); ?>