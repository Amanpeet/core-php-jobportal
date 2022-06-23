<!-- the sidebar -->

<div class="sidebar-widget single-slidebar">
  <h4>Jobs by Location</h4>
  <ul class="cat-list">
    <li>
      <a class="justify-content-between d-flex" href="#">
        <p>New York</p><span>37</span>
      </a>
    </li>
    <li>
      <a class="justify-content-between d-flex" href="#">
        <p>Park Montana</p><span>57</span>
      </a>
    </li>
    <li>
      <a class="justify-content-between d-flex" href="#">
        <p>Atlanta</p><span>33</span>
      </a>
    </li>
    <li>
      <a class="justify-content-between d-flex" href="#">
        <p>Arizona</p><span>36</span>
      </a>
    </li>

  </ul>
</div>

<div class="sidebar-widget single-slidebar">
  <h4>Jobs by Category</h4>
  <ul class="cat-list">
    <li>
      <a class="justify-content-between d-flex" href="#">
        <p>Technology</p><span>37</span>
      </a>
    </li>
    <li>
      <a class="justify-content-between d-flex" href="#">
        <p>Media & News</p><span>57</span>
      </a>
    </li>
    <li>
      <a class="justify-content-between d-flex" href="#">
        <p>Goverment</p><span>33</span>
      </a>
    </li>
    <li>
      <a class="justify-content-between d-flex" href="#">
        <p>Medical</p><span>36</span>
      </a>
    </li>
  </ul>
</div>

<div class="sidebar-widget single-slidebar">
  <h4>From Blog</h4>
  <div class="blog-list">
    <?php
    //Simple select query
    $items_per_page = 3;
    $blog_sql = "SELECT * FROM blog ORDER BY bid DESC LIMIT $items_per_page ";
    $blog_query = mysqli_query($conn, $blog_sql);
    while($post = mysqli_fetch_array($blog_query)) { ?>
      <div class="card blog-card bg-dark mb-4" style="background-image: url(uploads/<?php echo $post['blog_image']; ?>);">
        <a class="d-block" href="blog-single.php?post=<?php echo $post['bid']; ?>">
          <div class="card-body">
            <h5 class="card-title text-white"><strong><?php echo $post['blog_title']; ?></strong></h5>
            <div class="card-text text-white">
              <?php echo strip_tags( substr( $post['blog_content'], 0, 50 ) ) . '...'; ?>
            </div>
            <!-- <a class="btn btn-dark btn-sm mt-3" href="blog-single.php?post=<?php echo $post['bid']; ?>">Read More</a> -->
          </div>
        </a>
      </div>
    <?php } ?>

    <!-- <div class="single-blog " style="background:#000 url(img/blog1.jpg);">
      <a href="single.html">
        <h4>Home Audio Recording <br> For Everyone</h4>
      </a>
      <div class="meta justify-content-between d-flex">
        <p> 02 Hours ago </p>
      </div>
    </div> -->

  </div>
</div>

<div class="sidebar-widget single-slidebar">
  <h4>Testimonials</h4>
  <div class="owl-carousel owl-solo testimonials">
    <div class="item">
      <div class="testimonial-item">
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quasi dolore odit, numquam aperiam quidem tempora sit culpa debitis nisi unde recusandae repellat aut incidunt! Odio veniam saepe sapiente praesentium reprehenderit.</p>
        <h6 class="text-right"><strong>- Jack Connor</strong></h6>
      </div>
    </div>
    <div class="item">
      <div class="testimonial-item">
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quasi dolore odit, numquam aperiam quidem tempora sit culpa debitis nisi unde recusandae repellat aut incidunt! Odio veniam saepe sapiente praesentium reprehenderit.</p>
        <h6 class="text-right"><strong>- Arnold Schwnager</strong></h6>
      </div>
    </div>
    <div class="item">
      <div class="testimonial-item">
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quasi dolore odit, numquam aperiam quidem tempora sit culpa debitis nisi unde recusandae repellat aut incidunt! Odio veniam saepe sapiente praesentium reprehenderit.</p>
        <h6 class="text-right"><strong>- Tom Pitts</strong></h6>
      </div>
    </div>
    <div class="item">
      <div class="testimonial-item">
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quasi dolore odit, numquam aperiam quidem tempora sit culpa debitis nisi unde recusandae repellat aut incidunt! Odio veniam saepe sapiente praesentium reprehenderit.</p>
        <h6 class="text-right"><strong>- Sandeep Ambani</strong></h6>
      </div>
    </div>
  </div>
</div>
