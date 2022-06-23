<?php include('include/fg-logincheck.php'); //header ?>
<?php include('header.php'); //header ?>



<section class="ftco-section-parallax page-title">
  <div class="parallax-img d-flex align-items-center">
    <div class="container">
      <div class="text-center heading-section heading-section-white mt-5">
        <h2>User Profile</h2>
      </div>
    </div>
  </div>
</section>

<!-- section -->
<section class="site-section py-5 bg-light">
  <div class="container">

    <div class="row">
      <div class="col-lg-10 mx-auto mb-3 px-0">
        <!-- <a class="btn btn-color" href="profile-edit.php"> <i class="fa fa-edit"></i> Edit Profile</a> -->
        <!-- <a id="genpdfbtn" class="btn btn-dark float-right" href="#"> <i class="fa fa-download"></i> Download as Resume</a> -->
      </div>
      <div class="col-lg-10 mx-auto p-0">

        <?php
          $get_user = "";
          $get_role = "";
          if(isset($_REQUEST['user']) && !empty($_REQUEST['user'])) {
            $get_user = $_REQUEST['user'];

            /* get the userdata */
            $select = "SELECT * FROM userdata WHERE `username` = '$get_user' LIMIT 1";
            $quer = mysqli_query($conn, $select);
            if( mysqli_num_rows($quer) > 0 ){
              while($user = mysqli_fetch_array($quer)) {
                $get_user = $user['username'];
                $get_role = $user['form_type'];
              }
            } else {
              echo '<h4 class="mt-5"><strong>No User found!</strong></h4>';
              echo '<p> It seems like no user data is available on given parameters. Check the username and URL. </p>';
            }
          } else {
            $get_user = $login_user;
            $get_role = $login_role;
          }
        ?>

        <?php if( !empty($get_user) && !empty($get_role) ) { ?>

          <div class="p-3 border bg-white">
            <?php
            $select = "SELECT * FROM userdata WHERE `username` = '$get_user' LIMIT 1";
            $quer = mysqli_query($conn, $select);
            while($fetch = mysqli_fetch_array($quer)){
              $datef = date('d M, Y', strtotime($fetch['dated']));
              ?>
              <!-- SHOW ALL ITEMS HERE -->
              <div class="row border-bottomx">
                <div class="col-8">
                  <div class="pt-5">
                    <h3> <strong><?php echo $fetch['fullname'];; ?></strong> </h3>
                    <p>Viewing individual Profile of user account.</p>
                  </div>
                </div>
                <div class="col-4 text-right pb-3">
                    <img class="img-thumbnail profile-pic" src="uploads/<?php echo $fetch['file_profile_pic']; ?>" alt="">
                </div>
              </div>
              <table class="table table-borderlessx table-responsive-md table-righted">
                <tbody>
                  <tr>
                    <td style="width: 20%;"> Name </td>
                    <td style="width: 80%;">
                      <strong><?php echo $fetch['fullname']; ?></strong>
                    </td>
                  </tr>
                  <tr>
                    <td> Email </td>
                    <td> <strong><?php echo $fetch['email']; ?></strong> </td>
                  </tr>
                  <tr>
                    <td> Phone </td>
                    <td>
                      <strong><?php echo $fetch['phone']; ?></strong> <br>
                      <strong><?php echo $fetch['phone2']; ?></strong>
                    </td>
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
                    <td> State </td>
                    <td> <strong><?php echo $fetch['state']; ?></strong> </td>
                  </tr>
                  <tr>
                    <td> City </td>
                    <td> <strong><?php echo $fetch['city']; ?></strong> </td>
                  </tr>
                  <tr>
                    <td> Pincode </td>
                    <td> <strong><?php echo $fetch['pincode']; ?></strong> </td>
                  </tr>
                  <tr>
                    <td> DOB </td>
                    <td> <strong><?php echo $fetch['dob']; ?></strong> </td>
                  </tr>
                  <tr>
                    <td> Gender </td>
                    <td> <strong><?php echo $fetch['gender']; ?></strong> </td>
                  </tr>
                  <tr>
                    <td> Skills </td>
                    <td> <strong><?php echo $fetch['skills']; ?></strong> </td>
                  </tr>
                  <tr>
                    <td> Education</td>
                    <td>
                      <div>
                        <?php $edu1 = unserialize($fetch['education1']); // echo $fetch['education1']; ?>
                        <?php if( !empty($edu1) ){ ?>
                        <div class="row">
                          <div class="col"><span class="text-muted">Course:</span> <?php echo $edu1['edu_course_1']; ?></div>
                          <div class="col"><span class="text-muted">Institute:</span> <?php echo $edu1['edu_institute_1']; ?></div>
                          <div class="col"><span class="text-muted">Year:</span> <?php echo $edu1['edu_year_1']; ?></div>
                        </div>
                        <?php } ?>
                      </div>
                      <div>
                        <?php $edu2 = unserialize($fetch['education2']); // echo $fetch['education2']; ?>
                        <?php if( !empty($edu2) ){ ?>
                        <div class="row">
                          <div class="col"><span class="text-muted">Course:</span> <?php echo $edu2['edu_course_2']; ?></div>
                          <div class="col"><span class="text-muted">Institute:</span> <?php echo $edu2['edu_institute_2']; ?></div>
                          <div class="col"><span class="text-muted">Year:</span> <?php echo $edu2['edu_year_2']; ?></div>
                        </div>
                        <?php } ?>
                      </div>
                      <div>
                        <?php $edu3 = unserialize($fetch['education3']); // echo $fetch['education3']; ?>
                        <?php if( !empty($edu3) ){ ?>
                          <div class="row">
                            <div class="col"><span class="text-muted">Course:</span> <?php echo $edu3['edu_course_3']; ?></div>
                            <div class="col"><span class="text-muted">Institute:</span> <?php echo $edu3['edu_institute_3']; ?></div>
                            <div class="col"><span class="text-muted">Year:</span> <?php echo $edu3['edu_year_3']; ?></div>
                          </div>
                        <?php } ?>
                      </div>
                      <div>
                        <?php $edu4 = unserialize($fetch['education4']); // echo $fetch['education4']; ?>
                        <?php if( !empty($edu4) ){ ?>
                          <div class="row">
                            <div class="col"><span class="text-muted">Course:</span> <?php echo $edu4['edu_course_4']; ?></div>
                            <div class="col"><span class="text-muted">Institute:</span> <?php echo $edu4['edu_institute_4']; ?></div>
                            <div class="col"><span class="text-muted">Year:</span> <?php echo $edu4['edu_year_4']; ?></div>
                          </div>
                        <?php } ?>
                      </div>
                    </td>
                  </tr>

                  <tr>
                    <td> Experience 1 </td>
                    <td>
                      <div>
                        <?php $exp1 = unserialize($fetch['experience1']); // echo $fetch['experience1']; ?>
                        <?php if( !empty($exp1) ){ ?>
                          <div class="row">
                            <div class="col"><span class="text-muted">Title:</span> <?php echo $exp1['exp_title_1']; ?></div>
                            <div class="col"><span class="text-muted">Company:</span> <?php echo $exp1['exp_company_1']; ?></div>
                            <div class="col"><span class="text-muted">Years:</span> <?php echo $exp1['exp_years_1']; ?></div>
                          </div>
                        <?php } ?>
                      </div>
                      <div>
                        <?php $exp2 = unserialize($fetch['experience2']); // echo $fetch['experience2']; ?>
                        <?php if( !empty($exp2) ){ ?>
                          <div class="row">
                            <div class="col"><span class="text-muted">Title:</span> <?php echo $exp2['exp_title_2']; ?></div>
                            <div class="col"><span class="text-muted">Company:</span> <?php echo $exp2['exp_company_2']; ?></div>
                            <div class="col"><span class="text-muted">Years:</span> <?php echo $exp2['exp_years_2']; ?></div>
                          </div>
                        <?php } ?>
                      </div>
                      <div>
                        <?php $exp3 = unserialize($fetch['experience3']); // echo $fetch['experience3']; ?>
                        <?php if( !empty($exp3) ){ ?>
                          <div class="row">
                            <div class="col"><span class="text-muted">Title:</span> <?php echo $exp3['exp_title_3']; ?></div>
                            <div class="col"><span class="text-muted">Company:</span> <?php echo $exp3['exp_company_3']; ?></div>
                            <div class="col"><span class="text-muted">Years:</span> <?php echo $exp3['exp_years_3']; ?></div>
                          </div>
                        <?php } ?>
                      </div>
                      <div>
                        <?php $exp4 = unserialize($fetch['experience4']); // echo $fetch['experience4']; ?>
                        <?php if( !empty($exp4) ){ ?>
                          <div class="row">
                            <div class="col"><span class="text-muted">Title:</span> <?php echo $exp4['exp_title_4']; ?></div>
                            <div class="col"><span class="text-muted">Company:</span> <?php echo $exp4['exp_company_4']; ?></div>
                            <div class="col"><span class="text-muted">Years:</span> <?php echo $exp4['exp_years_4']; ?></div>
                          </div>
                        <?php } ?>
                      </div>

                    </td>
                  </tr>
                  <tr>
                    <td> Linkedin </td>
                    <td> <a href="<?php echo $fetch['linkedin']; ?>" target="_blank"><?php echo $fetch['linkedin']; ?></a> </td>
                  </tr>

                </tbody>
              </table>
              <?php
            }
            ?>
          </div>

        <?php } ?>

      </div>
    </div>
  </div>
</section>

<?php include('footer.php'); //footer ?>
