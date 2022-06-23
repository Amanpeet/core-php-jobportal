<?php include('header.php'); //header ?>

<section class="ftco-section-parallax page-title">
  <div class="parallax-img d-flex align-items-center">
    <div class="container">
      <div class="text-center heading-section heading-section-white mt-5">
        <h2>Contact</h2>
      </div>
    </div>
  </div>
</section>

<!-- section -->
<section class="site-section my-5 py-5">
  <div class="container">

    <!-- <div class="heading-section text-center my-5">
      <h2 class=""><span>Get in</span> Touch!</h2>
    </div> -->

    <div class="row mb-5">
      <div class="col-md-6">
        <div class="">
          <h3 class="mb-3"> <strong>Write</strong> to us </h3>
          <form class="contact_form" action="" method="post">
            <input name="sub" type="hidden" class="form-control" value="subject">
            <div class="form-group">
              <input name="name" type="text" class="form-control" placeholder="Full Name">
            </div>
            <div class="form-group">
              <input name="email" type="email" class="form-control" placeholder="example@mail.com">
            </div>
            <div class="form-group">
              <textarea name="msg" class="form-control" placeholder="Type your message" rows="3"></textarea>
              <small class="form-text text-muted">We'll never share your information with anyone.</small>
            </div>
            <input id="send" name="submit" class="btn btn-color px-5" type="submit" value="Send">
          </form>
        </div>
      </div>
      <div class="col-md-5 ml-auto">
        <div class="">
          <h3 class="mb-3 mt-4 pt-1"> <strong>Reach</strong> us </h3>
          <div class="contact-address">
            <h6><i class="fa fa-globe"></i> Address </h6>
            <p class="pl-4"> Chandigarh, INDIA </p>

            <h6><i class="fa fa-phone"></i> Call us</h6>
            <p class="pl-4">
              <a href="tel:+1234567890"><strong>+1-1234567890 </strong></a> <br>
              <a href="tel:+1234567890"><strong>+1-1234567890 </strong></a> <br>
            </p>

            <h6><i class="fa fa-envelope"></i> Email us</h6>
            <p class="pl-4">
              <a href="mailto:info@rojgarway.com"><strong>info@rojgarway.com</strong></a> <br>
              <a href="mailto:mail@rojgarway.com"><strong>mail@rojgarway.com</strong></a> <br>
            </p>
          </div>

        </div>
      </div>
    </div>

    <!-- map -->
    <div class="map pt-5 my-5">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d429157.54675741366!2d-117.389166995983!3d32.824240427869604!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80d9530fad921e4b%3A0xd3a21fdfd15df79!2sSan+Diego%2C+CA%2C+USA!5e0!3m2!1sen!2sin!4v1566389617772!5m2!1sen!2sin" frameborder="0" style="border:none; width:100%; height:400px;" allowfullscreen></iframe>
    </div>

  </div>
</section>


<?php include('footer.php'); //footer ?>
