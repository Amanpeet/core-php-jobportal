<?php include('header.php'); //header ?>

<section class="ftco-section-parallax page-title">
  <div class="parallax-img d-flex align-items-center">
    <div class="container">
      <div class="text-center heading-section heading-section-white mt-5">
        <h2>Register</h2>
      </div>
    </div>
  </div>
</section>

<!-- query -->
<section class="site-section">
  <div class="container">
    <div class="text-center pt-4">
      <?php include_once("query/register-submit.php"); ?>
    </div>
  </div>
</section>

<!-- section -->
<section class="site-section py-5 bg-light">
  <div class="container">

    <?php if (!isset($_GET['type']) || empty($_GET['type'])) { ?>
      <div class="row py-5">
        <div class="col-md-6 mx-auto text-center">

          <h3 class="mb-3"> Register as </h3>
          <div class="form-group mt-4">
            <label for="" class="">Apply on Jobs, Find Employers</label>
            <a class="d-block btn btn-color btn-lg" href="register.php?type=user"> <i class="fa fa-user"></i> Register as <strong>User</strong></a>
          </div>
          <div class="form-group mt-4">
            <label for="" class="">Post new Jobs, Find Candidates</label>
            <a class="d-block btn btn-color btn-lg" href="register.php?type=employer"> <i class="fa fa-user-tie"></i> Register as <strong>Employer</strong></a>
          </div>

        </div>
      </div>

    <?php } else { ?>
      <?php
        $regtype = $_GET['type'];
        if ($regtype != 'employer' && $regtype != 'user') {
          echo "<h5 class='text-danger'>Unknown parameters as Register type. Please go back home and try again.</h5>";
          exit;
        }
      ?>

      <div class="heading-section text-center my-5">
        <h2 class="mb-4"><span>Register as</span> <strong class="text-capitalize"><?php echo $regtype; ?></strong></h2>
        <p class="big-para">We live in a country that has millions of unemployed youth, and this is not just because of lack of opportunities, but because of unawareness of the job opportunity. Millions of worthy people go unnoticed and millions of employers had to suffer because of lack of suitable candidates.</p>
      </div>

      <div class="row">
        <div class="col-md-10 col-lg-9 mx-auto mb-4">

          <form name="register_form" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="form_type" value="<?php echo $regtype; ?>">

            <div class="bg-gray p-4">
              <h4 class="text-light"><strong>Account</strong></h4>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="username"><strong>Username</strong></label>
                  <input class="form-control" name="username" type="text" required placeholder="username">
                  <small class="text-muted">Choose a unique username of 4-20 characters</small>
                </div>
                <div class="form-group col-md-6">
                  <label for="email">Email</label>
                  <input class="form-control" name="email" type="text" required placeholder="example@mail.com">
                  <small class="text-muted">This email is used as primary email</small>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="password"><strong>Password</strong></label>
                  <input class="form-control" name="password" type="password" required placeholder="password">
                  <small class="text-muted">With a Uppercase, Lowercase & Number.</small>
                </div>
                <div class="form-group col-md-6">
                  <label for="password"><strong>Confirm Password</strong></label>
                  <input class="form-control" name="password2" type="password" required placeholder="confirm password">
                </div>
              </div>
            </div>

            <div class="bg-gray p-4 mt-4">
              <h4 class="text-light"><strong>Personal</strong></h4>
              <div class="form-group">
                <label for="fullname">Full Name</label>
                <input class="form-control" name="fullname" type="text" required placeholder="first & last name">
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="email">Phone</label>
                  <input class="form-control" name="phone" type="text" required placeholder="1234567890">
                </div>
                <div class="form-group col-md-6">
                  <label for="phone">Phone Alternate</label>
                  <input class="form-control" name="phone2" type="text" placeholder="1234567890">
                </div>
              </div>
              <div class="form-group">
                <label for="address">Address</label>
                <input class="form-control" name="address" type="text" required placeholder="full address">
              </div>
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="state">State/UT</label>
                  <input class="form-control" name="state" type="text" required placeholder="state">
                </div>
                <div class="form-group col-md-4">
                  <label for="city">City</label>
                  <input class="form-control" name="city" type="text" required placeholder="city">
                </div>
                <div class="form-group col-md-4">
                  <label for="pincode">Pincode</label>
                  <input class="form-control" name="pincode" type="text" required placeholder="pincode">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="dob">Date of Birth</label>
                  <input class="form-control datepicker" name="dob" type="text" required placeholder="mm/dd/yyyy">
                </div>
                <div class="form-group col-md-6">
                  <label class="form-check-label" for="">Gender</label>
                  <div class="form-check pt-3">
                    <label><input class="form-control-input" name="gender" type="radio" value="male" required> Male </label>
                    <label><input class="form-control-input" name="gender" type="radio" value="female"> Female </label>
                    <label><input class="form-control-input" name="gender" type="radio" value="other"> Other </label>
                  </div>
                </div>
              </div>
            </div>

            <?php if ($regtype == 'employer') { //if employer registers ?>

              <div class="bg-gray p-4 mt-4">
                <h4 class="text-light"><strong>Company</strong></h4>
                <div class="form-group">
                  <label for="com_name">Company Name</label>
                  <input class="form-control" name="com_name" type="text" placeholder="full company name">
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="com_industry">Industry</label>
                    <input class="form-control" name="com_industry" type="text" placeholder="it, software, govt">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="com_location">Number of Employees</label>
                    <input class="form-control" name="com_location" type="text" placeholder="1000">
                  </div>
                </div>
                <div class="form-group">
                  <label for="fullname">Website</label>
                  <input class="form-control" name="com_website" type="text" required placeholder="https://www.example.com">
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="email">Phone</label>
                    <input class="form-control" name="com_phone" type="text" required placeholder="1234567890">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="phone">Email</label>
                    <input class="form-control" name="com_email" type="text" placeholder="mail@company.com">
                  </div>
                </div>
                <div class="form-group">
                  <label for="address">Company Address</label>
                  <input class="form-control" name="com_address" type="text" required placeholder="full address">
                </div>
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="state">State/UT</label>
                    <input class="form-control" name="com_state" type="text" required placeholder="">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="city">City</label>
                    <input class="form-control" name="com_city" type="text" required placeholder="">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="pincode">Pincode</label>
                    <input class="form-control" name="com_pincode" type="text" required placeholder="">
                  </div>
                </div>
              </div>

              <div class="bg-gray p-4 mt-4">
                <h4 class="text-light"><strong>Uploads</strong></h4>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="">Upload Your ID</label>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="file_identification" name="file_identification" accept="image/*, .pdf, .docx, .doc">
                      <label class="custom-file-label" for="file_identification">Choose file (images, pdf, docx)</label>
                    </div>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="">Upload Profile Picture</label>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="file_profile_pic" name="file_profile_pic" accept="image/*">
                      <label class="custom-file-label" for="file_profile_pic">Choose file (jpeg, jpg, png) </label>
                    </div>
                  </div>
                </div>
              </div>

            <?php } else { //if user registers ?>

              <div class="bg-gray p-4 mt-4">
                <h4 class="text-light"><strong>Job</strong></h4>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="job_category">Category</label>
                    <input class="form-control" name="job_category" type="text" placeholder="it, software, govt">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="job_location">Location</label>
                    <input class="form-control" name="job_location" type="text" placeholder="city, state, place">
                  </div>
                </div>
              </div>

              <div class="bg-gray p-4 mt-4">
                <div class="form-row">
                  <div class="form-group col-8">
                    <h4 class="text-light"><strong>Education</strong></h4>
                  </div>
                  <div class="form-group col-4 text-right">
                    <button type="button" class="btn btn-dark btn-sm" title="Add Education" id="edu_add_btn" data-start="1" data-end="4"> <i class="fa fa-plus"></i> </button>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="edu_course">Course</label>
                    <input class="form-control" name="edu_course_1" type="text" placeholder="course name">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="edu_institute">Institute</label>
                    <input class="form-control" name="edu_institute_1" type="text" placeholder="institute">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="edu_year">Year Completed</label>
                    <input class="form-control" name="edu_year_1" type="text" placeholder="yyyy">
                  </div>
                </div>
                <div id="education_add" class="w-100"></div>
                <div id="education_fields" class="hidden" style='display:none;'>
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="edu_course">Course</label>
                      <input class="form-control" name="edu_course" type="text" placeholder="course name">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="edu_institute">Institute</label>
                      <input class="form-control" name="edu_institute" type="text" placeholder="institute">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="edu_year">Year Completed</label>
                      <input class="form-control" name="edu_year" type="text" placeholder="yyyy">
                    </div>
                  </div>
                </div>

              </div>

              <div class="bg-gray p-4 mt-4">
                <div class="form-row">
                  <div class="form-group col-8">
                    <h4 class="text-light"><strong>Experience</strong></h4>
                  </div>
                  <div class="form-group col-4 text-right">
                    <button type="button" class="btn btn-dark btn-sm" title="Add Experience" id="exp_add_btn" data-start="1" data-end="4"> <i class="fa fa-plus"></i> </button>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="edu_course">Title</label>
                    <input class="form-control" name="exp_title_1" type="text" placeholder="job title">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="edu_institute">Company</label>
                    <input class="form-control" name="exp_company_1" type="text" placeholder="company">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="edu_year">Exp Years</label>
                    <input class="form-control" name="exp_years_1" type="text" placeholder="in years">
                  </div>
                </div>
                <div id="experience_add" class="w-100"></div>
                <div id="experience_fields" class="hidden" style='display:none;'>
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="edu_course">Title</label>
                      <input class="form-control" name="exp_title" type="text" placeholder="job title">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="edu_institute">Company</label>
                      <input class="form-control" name="exp_company" type="text" placeholder="company">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="edu_year">Exp Years</label>
                      <input class="form-control" name="exp_years" type="text" placeholder="in years">
                    </div>
                  </div>
                </div>
              </div>

              <div class="bg-gray p-4 mt-4">
                <h4 class="text-light"><strong>Profile</strong></h4>
                <div class="form-group">
                  <label for="skill_name">Skills</label>
                  <input class="form-control" name="skills" type="text" placeholder="photoshop, banking, etc">
                </div>
                <div class="form-group">
                  <label for="skill_name">LinkedIn Profile</label>
                  <input class="form-control" name="linkedin" type="text" placeholder="linkedin profile url">
                </div>
              </div>

              <div class="bg-gray p-4 mt-4">
                <h4 class="text-light"><strong>Uploads</strong></h4>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="">Upload Resume</label>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="file_resume" name="file_resume" accept="image/*, .pdf, .docx, .doc">
                      <label class="custom-file-label" for="file_resume">Choose file (images, pdf, docx)</label>
                    </div>
                    <small>Max Size Allowed: 1MB</small>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="">Upload Profile Picture</label>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="file_profile_pic" name="file_profile_pic" accept="image/*">
                      <label class="custom-file-label" for="file_profile_pic">Choose file (jpeg, jpg, png)</label>
                    </div>
                    <small>Max Size Allowed: 1MB</small>
                  </div>
                </div>
              </div>

            <?php } ?>

            <div class="bg-gray px-4 pt-3 pb-1 mt-4">
              <div class="form-group">
                <label><b>Please Fill Security Code</b></label>
                <div class="row">
                  <div class="col-sm-3">
                    <input class="form-control" id="form_captcha" name="form_captcha" type="tel" placeholder="Input Code" required autocomplete="off">
                  </div>
                  <div class="col-sm-7">
                    <img class="captcha-img" src="include/captcha.php" alt="loading captcha" />
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group text-center pt-4">
              <input class="btn btn-color btn-lg" type='submit' name='register_submit' value='REGISTER' />
            </div>
          </form>

        </div>
      </div>

    <?php } ?>

  </div>
</section>

<script>
  $(function(){

    // add education
    $('#edu_add_btn').click(function(){
      var startval = $(this).attr('data-start');
      var endval = $(this).attr('data-end');
      var newval = parseInt(startval) + 1;
      var maxval = parseInt(endval) + 1;
      var getfields = $('#education_fields').html();
      // $('#education_add').html('');
      var tree = $("<div>" + getfields + "</div>");
      tree.find('input').each(function(i) {
        $(this).attr('name', $(this).attr('name') + '_' + newval);
        // $(this).prop('required', true);
      });
      if( newval < maxval ){
        var newfields = tree.html();
        $('#education_add').append(newfields);
        $(this).attr('data-start', newval);
      }
    });

    // add experience
    $('#exp_add_btn').click(function(){
      var startval = $(this).attr('data-start');
      var endval = $(this).attr('data-end');
      var newval = parseInt(startval) + 1;
      var maxval = parseInt(endval) + 1;
      var getfields = $('#experience_fields').html();
      // $('#education_add').html('');
      var tree = $("<div>" + getfields + "</div>");
      tree.find('input').each(function(i) {
        $(this).attr('name', $(this).attr('name') + '_' + newval);
        // $(this).prop('required', true);
      });
      if( newval < maxval ){
        var newfields = tree.html();
        $('#experience_add').append(newfields);
        $(this).attr('data-start', newval);
      }
    });

  });

</script>

<?php include('footer.php'); //footer ?>
