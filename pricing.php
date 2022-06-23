<?php include('header.php'); //header ?>
<?php include("include/prices.php"); //prices ?>

<section class="ftco-section-parallax page-title">
  <div class="parallax-img d-flex align-items-center">
    <div class="container">
      <div class="text-center heading-section heading-section-white mt-5">
        <h2>Pricing</h2>
      </div>
    </div>
  </div>
</section>

<!-- section -->
<section class="site-section py-5 bg-light">
  <div class="container">

    <!-- <div class="heading-section text-center my-5">
      <h2 class=""><span>For</span> Pricing</h2>
    </div> -->

    <div class="row">
      <div class="col-md-10 mx-auto mb-4">

        <div class="heading-section text-center my-5">
          <h2 class=""><span>For</span> Job Seekers</h2>
          <p class="lead limited">Quickly build an effective pricing table for your potential customers with this Bootstrap example. It's built with default Bootstrap components and utilities with little customization.</p>
        </div>
        <div class="pricing-box">

          <div class="row mb-3 text-center">
            <div class="col-lg-4">
              <div class="card mb-4 shadow-sm">
                <div class="card-header">
                  <h4 class="my-0 font-weight-normal">Free</h4>
                </div>
                <div class="card-body">
                  <h2 class="card-title pricing-card-title">₹ <strong>0</strong> </h2>
                  <h5 class="card-title text-muted">for ever</h5>
                  <ul class="list-unstyled mt-3 mb-4">
                    <li>Register on website</li>
                    <li>Make your profile</li>
                    <li>Download Resume</li>
                    <li>Limited Account</li>
                  </ul>
                  <a href="register.php?type=user" class="btn btn-dark btn-block">Register Now</a>
                </div>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="card mb-4 shadow-sm">
                <div class="card-header">
                  <h4 class="my-0 font-weight-normal">Starter</h4>
                </div>
                <div class="card-body">
                  <h2 class="card-title pricing-card-title">₹ <strong><?php echo searchAmount('user_starter'); ?></strong> </h2>
                  <h5 class="card-title text-muted">for 3 months</h5>
                  <ul class="list-unstyled mt-3 mb-4">
                    <li>View job Listings</li>
                    <li>Apply for Jobs</li>
                    <li>Download Resume</li>
                    <li>Service Support</li>
                  </ul>
                  <a href="payment.php?pay=user_starter" class="btn btn-primary btn-block pay-btn">Get started</a>
                </div>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="card mb-4 shadow-sm">
                <div class="card-header">
                  <h4 class="my-0 font-weight-normal">Professional</h4>
                </div>
                <div class="card-body">
                  <h2 class="card-title pricing-card-title">₹ <strong><?php echo searchAmount('user_medium'); ?></strong> </h2>
                  <h5 class="card-title text-muted">for 12 months</h5>
                  <ul class="list-unstyled mt-3 mb-4">
                    <li>View job Listings</li>
                    <li>Apply for Jobs</li>
                    <li>Download Resume</li>
                    <li>Service Support</li>
                  </ul>
                  <a href="#" class="btn btn-secondary btn-block">Coming soon</a>
                </div>
              </div>
            </div>
          </div>

        </div>

        <div class="heading-section text-center my-5 pt-5 border-top">
          <h2 class=""><span>For</span> Employers</h2>
          <p class="lead limited">Quickly build an effective pricing table for your potential customers with this Bootstrap example. It’s built with default Bootstrap components and utilities with little customization.</p>
        </div>
        <div class="pricing-box">
          <div class="row mb-3 text-center">
            <div class="col-lg-4">
              <div class="card mb-4 shadow-sm">
                <div class="card-header">
                  <h4 class="my-0 font-weight-normal">Free</h4>
                </div>
                <div class="card-body">
                  <h2 class="card-title pricing-card-title">₹ <strong>0</strong> </h2>
                  <h5 class="card-title text-muted">for ever</h5>
                  <ul class="list-unstyled mt-3 mb-4">
                    <li>Register on website</li>
                    <li>Make your profile</li>
                    <li>Download Resume</li>
                    <li>Limited Account</li>
                  </ul>
                  <a href="register.php?type=user" class="btn btn-dark btn-block">Register Now</a>
                </div>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="card mb-4 shadow-sm">
                <div class="card-header">
                  <h4 class="my-0 font-weight-normal">Starter</h4>
                </div>
                <div class="card-body">
                  <h2 class="card-title pricing-card-title">₹ <strong><?php echo searchAmount('employer_starter'); ?></strong> </h2>
                  <h5 class="card-title text-muted">for 3 months</h5>
                  <ul class="list-unstyled mt-3 mb-4">
                    <li>View User Listings</li>
                    <li>Post new Jobs</li>
                    <li>Download Resumes</li>
                    <li>Service Support</li>
                  </ul>
                  <a href="payment.php?pay=employer_starter" class="btn btn-primary btn-block pay-btn">Get started</a>
                </div>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="card mb-4 shadow-sm">
                <div class="card-header">
                  <h4 class="my-0 font-weight-normal">Business</h4>
                </div>
                <div class="card-body">
                  <h2 class="card-title pricing-card-title">₹ <strong><?php echo searchAmount('employer_medium'); ?></strong> </h2>
                  <h5 class="card-title text-muted">for 12 months</h5>
                  <ul class="list-unstyled mt-3 mb-4">
                    <li>View User Listings</li>
                    <li>Post new Jobs</li>
                    <li>Download Resumes</li>
                    <li>Service Support</li>
                  </ul>
                  <a href="#" class="btn btn-secondary btn-block">Coming soon</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="">
          <p><strong>DISCLAIMER:</strong> Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto animi cupiditate error laudantium provident inventore nam facere blanditiis aliquam non necessitatibus eos cumque at quas alias, tempora nisi atque officiis. Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>
        </div>

      </div>
    </div>

  </div>
</section>

<?php include('footer.php'); //footer ?>
