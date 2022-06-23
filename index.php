<?php include('header.php'); //header ?>

<!-- section -->
<div class="hero-wrap js-fullheight">
  <div class="underlay">
    <img class="rellax" data-rellax-speed="-8" data-rellax-percentage="0.5" src="img/hero-bg.jpg" />
  </div>
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start">
      <div class="col-xl-10  mb-5 pb-5">
        <p class="mb-4 mt-5 pt-5">We have over <span class="number">8400</span> job offers you deserve!</p>
        <h1 class="mb-5">Your Dream <br><span>Job is Waiting</span></h1>

        <div class="ftco-search">
          <div class="row">
            <div class="col-md-12 nav-link-wrap">
              <div class="nav nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active mr-md-1" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">Find a Job</a>
                <!-- <a class="nav-link" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2" role="tab" aria-controls="v-pills-2" aria-selected="false">Find a Candidate</a> -->
              </div>
            </div>
            <div class="col-md-12 tab-wrap">
              <div class="tab-content p-4" id="v-pills-tabContent">

                <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-nextgen-tab">
                  <form id="job-search-form" class="search-job" action="jobs.php" method="post">
                    <div class="row">
                      <div class="col-md">
                        <div class="form-group">
                          <div class="form-field">
                            <div class="icon"> <i class="fa fa-briefcase"></i> </div>
                            <input name="s_term" type="text" class="form-control high" placeholder="search jobs">
                          </div>
                        </div>
                      </div>
                      <div class="col-md">
                        <div class="form-group">
                          <div class="form-field">
                            <div class="select-wrap">
                              <div class="icon"> <i class="fa fa-caret-down"></i> </div>
                              <select class="chosen-select form-control high" name="s_category" data-placeholder="Select Category">
                                <option value="">All Categories</option>
                                <option value="designing">Designing</option>
                                <option value="developing">Developing</option>
                                <option value="hardware">Hardware</option>
                                <option value="government">Government</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md">
                        <div class="form-group">
                          <div class="form-field">
                            <div class="icon"> <i class="fa fa-map-marker"></i> </div>
                            <select class="chosen-select form-control high" name="s_location" data-placeholder="Select Category">
                              <option value="">All Locations</option>
                              <option value="chandigarh">Chandigarh</option>
                              <option value="mohali">Mohali</option>
                              <option value="delhi">Delhi</option>
                              <option value="gurugram">Gurugram</option>
                              <option value="noida">Noida</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md">
                        <div class="form-group">
                          <div class="form-field">
                            <input type="submit" name="filtered" value="Search" class="form-control high btn btn-primary">
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>

                <div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-performance-tab">
                  <form action="#" class="search-job">
                    <div class="row">
                      <div class="col-md">
                        <div class="form-group">
                          <div class="form-field">
                            <div class="icon"> <i class="fa fa-user"></i> </div>
                            <input type="text" class="form-control high" placeholder="eg. Adam Scott">
                          </div>
                        </div>
                      </div>
                      <div class="col-md">
                        <div class="form-group">
                          <div class="form-field">
                            <div class="select-wrap">
                              <div class="icon"><i class="fa fa-caret-down"></i></div>
                              <select name="" id="" class="form-control high">
                                <option value="">Category</option>
                                <option value="">Full Time</option>
                                <option value="">Part Time</option>
                                <option value="">Freelance</option>
                                <option value="">Internship</option>
                                <option value="">Temporary</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md">
                        <div class="form-group">
                          <div class="form-field">
                            <div class="icon"> <i class="fa fa-map-marker"></i> </div>
                            <input type="text" class="form-control high" placeholder="Location">
                          </div>
                        </div>
                      </div>
                      <div class="col-md">
                        <div class="form-group">
                          <div class="form-field">
                            <input type="submit" value="Search" class="form-control high btn btn-primary">
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- section -->
<section class="site-section">
  <div class="container">

    <div class="row mt-5">
      <div class="col-md-11 mx-auto text-center">
        <p class="big-para pt-5">We live in a country that has millions of unemployed youth, and this is not just because of lack of opportunities, but because of unawareness of the job opportunity. Millions of worthy people go unnoticed and millions of employers had to suffer because of lack of suitable candidates.</p>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 mx-auto text-center mb-5 heading-section">
        <h2 class="mt-5"> <span>Jobs</span> Categories</h2>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-6 col-md-4 col-lg-3 mb-3" data-aos="fade-up" data-aos-delay="100">
        <a href="#" class="h-100 feature-item">
          <span class="d-block icon mb-3 text-primary"><i class="fa fa-calculator"></i></span>
          <h2>Accounting / Finanace</h2>
          <span class="counting">10,391</span>
        </a>
      </div>
      <div class="col-sm-6 col-md-4 col-lg-3 mb-3" data-aos="fade-up" data-aos-delay="200">
        <a href="#" class="h-100 feature-item">
          <span class="d-block icon mb-3 text-primary"><i class="fa fa-briefcase"></i></span>
          <h2>Automotive Jobs</h2>
          <span class="counting">192</span>
        </a>
      </div>
      <div class="col-sm-6 col-md-4 col-lg-3 mb-3" data-aos="fade-up" data-aos-delay="300">
        <a href="#" class="h-100 feature-item">
          <span class="d-block icon mb-3 text-primary"><i class="fa fa-briefcase"></i></span>
          <h2>Construction / Facilities</h2>
          <span class="counting">1,021</span>
        </a>
      </div>
      <div class="col-sm-6 col-md-4 col-lg-3 mb-3" data-aos="fade-up" data-aos-delay="400">
        <a href="#" class="h-100 feature-item">
          <span class="d-block icon mb-3 text-primary"><i class="fa fa-briefcase"></i></span>
          <h2>Telecommunications</h2>
          <span class="counting">1,219</span>
        </a>
      </div>
      <div class="col-sm-6 col-md-4 col-lg-3 mb-3" data-aos="fade-up" data-aos-delay="500">
        <a href="#" class="h-100 feature-item">
          <span class="d-block icon mb-3 text-primary"><i class="fa fa-briefcase"></i></span>
          <h2>Healthcare</h2>
          <span class="counting">482</span>
        </a>
      </div>
      <div class="col-sm-6 col-md-4 col-lg-3 mb-3" data-aos="fade-up" data-aos-delay="600">
        <a href="#" class="h-100 feature-item">
          <span class="d-block icon mb-3 text-primary"><i class="fa fa-briefcase"></i></span>
          <h2>Design, Art &amp; Multimedia</h2>
          <span class="counting">5,409</span>
        </a>
      </div>
      <div class="col-sm-6 col-md-4 col-lg-3 mb-3" data-aos="fade-up" data-aos-delay="700">
        <a href="#" class="h-100 feature-item">
          <span class="d-block icon mb-3 text-primary"><i class="fa fa-briefcase"></i></span>
          <h2>Transportation &amp; Logistics</h2>
          <span class="counting">291</span>
        </a>
      </div>
      <div class="col-sm-6 col-md-4 col-lg-3 mb-3" data-aos="fade-up" data-aos-delay="800">
        <a href="#" class="h-100 feature-item">
          <span class="d-block icon mb-3 text-primary"><i class="fa fa-briefcase"></i></span>
          <h2>Restaurant / Food Service</h2>
          <span class="counting">329</span>
        </a>
      </div>
    </div>

  </div>
</section>

<!-- section -->
<section class="ftco-section bg-lightx mt-5 pt-5 pb-2">
  <div class="container">
    <div class="row justify-content-center pb-3">
      <div class="col-md-7 heading-section text-center ">
        <!-- <span class="subheading">Recently Added Jobs</span> -->
        <h2 class="mb-4"><span>Recent</span> Jobs</h2>
      </div>
    </div>
  </div>
</section>

<!-- section -->
<section class="post-area section-gap">
  <div class="container">
    <div class="row justify-content-center d-flex">
      <div class="col-lg-8 post-list">
        <ul class="cat-list">
          <li><a href="#">Recent</a></li>
          <li><a href="#">Full Time</a></li>
          <li><a href="#">Intern</a></li>
          <li><a href="#">part Time</a></li>
        </ul>
        <div class="job-posts">

          <?php
          //Simple select query
          $items_per_page = 6;
          $job_sql = "SELECT * FROM jobs WHERE `status` = 'active' ORDER BY jid DESC LIMIT $items_per_page ";
          $job_query = mysqli_query($conn, $job_sql);
          while($job = mysqli_fetch_array($job_query)) { ?>

            <div class="card bg-light mb-4">
              <div class="card-body">
                <!-- <h6 class="card-subtitle text-muted mb-2"><small><?php //echo date('d M, Y', strtotime($job['dated'])); ?></small></h6> -->
                <h6 class="card-subtitle text-muted mb-2 text-uppercase"><small><?php echo $job['job_category']; ?></small></h6>
                <h5 class="card-title"><strong><?php echo $job['job_title']; ?></strong></h5>
                <div class="card-text">
                  <p> <?php echo strip_tags( substr( $job['job_description'], 0, 200 ) ) . '...'; ?> </p>
                  <div class="row">
                    <div class="col"> <strong>Salary:</strong> <?php echo $job['job_salary']; ?> </div>
                    <div class="col"> <strong>Experience:</strong> <?php echo $job['job_experience_req']; ?> </div>
                    <div class="col"> <strong>Location:</strong> <?php echo $job['job_location']; ?> </div>
                  </div>
                </div>
                <a class="btn btn-color btn-sm mt-3" href="jobs-detail.php?job=<?php echo $job['jid']; ?>">View Details</a>
              </div>
            </div>

          <?php } ?>

          <!-- <div class="single-post d-flex flex-row">
            <div class="thumb">
              <img src="img/default.jpg" alt="">
              <ul class="tags">
                <li>
                  <a href="#">Art</a>
                </li>
                <li>
                  <a href="#">Media</a>
                </li>
                <li>
                  <a href="#">Design</a>
                </li>
              </ul>
            </div>
            <div class="details">
              <div class="title d-flex flex-row justify-content-between">
                <div class="titles">
                  <a href="single.html">
                    <h4>Creative Art Designer</h4>
                  </a>
                  <h6>Premium Labels Limited</h6>
                </div>
                <ul class="btns">
                  <li><a href="#">Apply</a></li>
                </ul>
              </div>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod temporinc ididunt ut dolore magna aliqua.
              </p>
              <h5>Job Nature: Full time</h5>
              <p class="address"> 56/8, Panthapath Dhanmondi Dhaka</p>
              <p class="address"> 15k - 25k</p>
            </div>
          </div> -->

        </div>
        <div class="text-center my-5">
          <a href="jobs.php" class="btn btn-color">View More</a>
        </div>
      </div>

      <div class="col-lg-4 sidebar">
        <?php include('sidebar.php'); //sidebar ?>
      </div>

    </div>
  </div>
</section>

<!-- section -->
<section class="site-section bg-gray pb-5">
  <div class="container">

    <div class="row">
      <div class="col-md-6 mx-auto text-center mb-5 heading-section">
        <h2 class="mt-5"> <span>Our</span> Clients</h2>
      </div>
    </div>

    <div class="text-center mb-5">
      <div class="owl-carousel owl-penta clients">
        <div class="item">
          <div class="client-item">
            <img src="img/default.jpg" alt="">
          </div>
        </div>
        <div class="item">
          <div class="client-item">
            <img src="img/default.jpg" alt="">
          </div>
        </div>
        <div class="item">
          <div class="client-item">
            <img src="img/default.jpg" alt="">
          </div>
        </div>
        <div class="item">
          <div class="client-item">
            <img src="img/default.jpg" alt="">
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- section -->
<section class="ftco-section-parallax">
  <div class="parallax-img d-flex align-items-center">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="col-md-7 text-center heading-section heading-section-white ">
          <h2>Subscribe to our Newsletter</h2>
          <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in</p>
          <div class="row d-flex justify-content-center mt-4 mb-4">
            <div class="col-md-8">
              <form action="#" class="subscribe-form">
                <div class="form-group d-flex">
                  <input type="text" class="form-control high" placeholder="Enter email address">
                  <input type="submit" value="Subscribe" class="submit px-3">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- home scripts -->
<script src="js/rellax.min.js"></script>
<script>
  $(document).ready(function () {
    console.log("home jquery initilized.");

    //start rellax
    var rellax = new Rellax('.rellax');

    // refresh on resize
    window.onresize = function (event) {
      rellax.refresh();
      console.log('rellax refreshed');
    };

    //destroy on phones
    if (getMobileOS()) {
      rellax.destroy();
      console.log('rellax destroyed');
    }

    //check if phones
    function getMobileOS() {
      var userAgent = navigator.userAgent || navigator.vendor || window.opera;
      // console.log('user agent: ' + userAgent);
      if (/windows phone/i.test(userAgent)) {
        return true;
      }
      if (/android/i.test(userAgent)) {
        return true;
      }
      if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
        return true;
      }
      return false;
    }

  });
</script>

<?php include('footer.php'); //footer ?>
