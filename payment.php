<?php //include('include/fg-logincheck.php'); //header ?>
<?php include('header.php'); //header ?>
<?php include("include/prices.php"); //prices ?>

<section class="ftco-section-parallax page-title">
  <div class="parallax-img d-flex align-items-center">
    <div class="container">
      <div class="text-center heading-section heading-section-white mt-5">
        <h2>Payment</h2>
      </div>
    </div>
  </div>
</section>

<!-- section -->
<section class="site-section py-5 bg-light">
  <div class="container">

    <div class="row">
      <div class="col-md-10 mx-auto mb-4">

        <!-- for users -->
        <div class="heading-section text-center my-5">
          <h3 class="">For <strong>Job Seekers</strong></h3>
          <p class="limited">Quickly build an effective pricing table for your potential customers with this Bootstrap example. It’s built with default Bootstrap components and utilities with little customization.</p>
          <p>For Benefits and More Details <a href="pricing.php"><strong>Visit Pricing Page</strong></a></p>
        </div>
        <div class="pricing-box">
          <table class="table border text-center bg-white">
            <thead>
              <tr>
                <th>Plan</th>
                <th>Validity</th>
                <th>Amount</th>
                <th>Pay</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td> User Starter </td>
                <td> 90 Days </td>
                <td> <strong>₹ <?php echo searchAmount('user_starter'); ?></strong> </td>
                <td> <a href="payment.php?pay=employer_starter" class="pay-btn btn btn-color btn-sm" data-pay="<?php echo searchAmount('user_starter'); ?>">PAY NOW</a> </td>
              </tr>
              <tr>
                <td> User Professional </td>
                <td> 90 Days </td>
                <td> <strong>₹ <?php echo searchAmount('user_medium'); ?></strong> </td>
                <td> <span class="text-muted">Coming soon</span> </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- for employers -->
        <div class="heading-section text-center my-5 pt-5 border-top">
          <h3 class="">For <strong>Employers</strong></h3>
          <p class="limited">Quickly build an effective pricing table for your potential customers with this Bootstrap example. It’s built with default Bootstrap components and utilities with little customization.</p>
          <p>For Benefits and More Details <a href="pricing.php"><strong>Visit Pricing Page</strong></a></p>
        </div>
        <div class="pricing-box">
          <table class="table border text-center bg-white">
            <thead>
              <tr>
                <th>Plan</th>
                <th>Validity</th>
                <th>Amount</th>
                <th>Pay</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td> Employer Starter </td>
                <td> 90 Days </td>
                <td> <strong>₹ <?php echo searchAmount('employer_starter'); ?></strong> </td>
                <td> <a href="payment.php?pay=employer_starter" class="pay-btn btn btn-color btn-sm" data-pay="<?php echo searchAmount('employer_starter'); ?>">PAY NOW</a> </td>
              </tr>
              <tr>
                <td> Employer Business </td>
                <td> 90 Days </td>
                <td> <strong>₹ <?php echo searchAmount('employer_medium'); ?></strong> </td>
                <td> <span class="text-muted">Coming soon</span> </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="mt-5">
          <p><strong>DISCLAIMER:</strong> Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto animi cupiditate error laudantium provident inventore nam facere blanditiis aliquam non necessitatibus eos cumque at quas alias, tempora nisi atque officiis. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo quod rerum at cupiditate distinctio nisi itaque, illo nobis enim nihil delectus recusandae cum non eum similique quis dolore, totam iste! Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere maiores temporibus, alias adipisci, quibusdam totam laboriosam deleniti sapiente nemo vero libero unde tenetur. Accusantium molestias officia est nostrum asperiores debitis. Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur harum dolor atque molestias corporis, enim voluptates suscipit eum natus velit facilis veniam possimus sequi dicta distinctio dolores. Fugit, vel soluta. </p>
        </div>

      </div>
    </div>

  </div>
</section>


<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script type="text/javascript">
  // pay now button
  $('.pay-btn').on( 'click', function(e){
    e.preventDefault();

    // get values
    let amt = $(this).attr('data-pay');
    let final_amt = amt + "00";

    // set options
    let options = {
      key: 'rzp_test_6o5G2DvKDd7ag8', // your API key DEMO
      amount: final_amt, // 1000 = 1000 paise, equals to ₹10
      currency: "INR", // Default is INR.
      name: "Rojgarway",
      description: "Payment for Rojgarway Plans",
      handler: function (response){
        alert(response.razorpay_payment_id);

        // response data
        console.log(response.razorpay_payment_id);
        console.log(response.razorpay_order_id);
        console.log(response.razorpay_signature);
        // console.log(response.error.description);

        // save response
        $.ajax({
          type: "POST",
          url: "inc/payment-response.php",
          data: {
            payment_id: user_id,
            order_id: iddss,
            signature: id
          },
          async: false,
          success: function (data) {
            alert('success' + data);
            // window.location.href = "payment-done.php?response=success";
          },
          error: function (error) {
            alert('ajax failed' + error);
          }
        });

      },
    };

    // initialize window
    var razer = new Razorpay(options);
    razer.open();
  });

</script>

<?php include('footer.php'); //footer ?>
