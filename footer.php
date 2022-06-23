
    <!-- footer -->
    <footer id="footer" class="site-footer ftco-footer ftco-bg-dark ftco-section">
      <div class="container">
        <div class="text-center mb-5">
          <a class="navbar-brand" href="index.php"><img src="img/logo-wht.png" alt="Rojgar Way"></a>
        </div>
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">About</h2>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
              <ul class="ftco-footer-social list-unstyled float-md-left float-left mt-3">
                <li class=""><a href="#"><i class="fab fa-twitter"></i></a></li>
                <li class=""><a href="#"><i class="fab fa-facebook"></i></a></li>
                <li class=""><a href="#"><i class="fab fa-instagram"></i></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Browse</h2>
              <ul class="list-unstyled">
                <li><a href="about.php" class="d-block">About us</a></li>
                <li><a href="activities.php" class="d-block">Activities</a></li>
                <li><a href="pricing.php" class="d-block">Pricing</a></li>
                <li><a href="testimonials.php" class="d-block">Testimonials</a></li>
                <li><a href="blog.php" class="d-block">Blog</a></li>
                <li><a href="contact.php" class="d-block">Contact</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-4">
              <h2 class="ftco-heading-2">Users/Employers</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="d-block">How it works</a></li>
                <li><a href="#" class="d-block">Register</a></li>
                <li><a href="#" class="d-block">Post Your Skills</a></li>
                <li><a href="#" class="d-block">Job Search</a></li>
                <li><a href="#" class="d-block">Employer Search</a></li>
                <li><a href="privacy-policy.php" class="d-block">Privacy Policy</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Reach us</h2>
              <div class="block-23 mb-3">
                <ul>
                  <li><i class="fa fa-map-marker-alt"></i> <span class="text">#999 Fake Address, Chandigarh, INDIA (160055). </span></li>
                  <li><i class="fa fa-phone"></i> <a href="#"><span class="text">+1234567890</span></a></li>
                  <li><i class="fa fa-envelope"></i> <a href="#"><span class="text">info@rojgarway.com</span></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">
            <p> Copyright &copy; 2019 All rights reserved. Designed by <a href="http://intiger.com" target="_blank">Intiger Web</a>  </p>
          </div>
        </div>
      </div>
    </footer>

  </div><!-- #site -->

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen">
    <svg class="circular" width="48px" height="48px">
      <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
      <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#00afef" />
    </svg>
  </div>

  <!-- jQuery -->
  <!-- <script src="js/jquery.min.js"></script> -->
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/jquery-ui.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.fancybox.min.js" async></script>
  <script src="js/fontawesome.all.min.js" async></script>

  <!-- chosen select -->
  <script src="js/chosen.jquery.min.js"></script>
  <link rel="stylesheet" href="css/chosen.min.css">

  <!-- resume to pdf -->
  <script src="js/jspdf.min.js"></script>
  <script src="js/html2canvas.min.js"></script>

  <script src="js/custom.js"></script>
  <script>
    $(document).ready(function () {
      console.log("footer jquery initilized.");

      $(".chosen-select").chosen();

      $('#genpdfbtn').on( 'click', function(){
        savepdf();
        console.log('pdf generated');
      });

    });

    function savepdf() {
      var imgwidth = $('#profilepdf').width();
      var imgheight = $('#profilepdf').height();
      var divider = imgwidth / 202;
      var newheight = imgheight / divider;

      var filename  = 'myProfile.pdf';
      html2canvas(document.querySelector('#profilepdf')).then(canvas => {
        let pdf = new jsPDF('p', 'mm', 'a4');
        pdf.addImage(canvas.toDataURL('image/png'), 'PNG', 3, 3, 202, newheight );
        pdf.save(filename);
      });

    }
  </script>

  <!-- tidio chat script -->
  <script src="//code.tidio.co/hjoo5jnynooryvdeto7pyeg1yht0mdxu.js"></script>

</body>
</html>