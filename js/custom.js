$(document).ready(function () {
  console.log("custom scripts initilized.");

  // preloader
  var loader = function () {
    setTimeout(function () {
      if ($('#ftco-loader').length > 0) {
        $('#ftco-loader').removeClass('show');
      }
    }, 1);
  };
  loader();

  //datepicker
  $('.datepicker').datepicker({
    dateFormat: 'dd-mm-yy',
    changeMonth: true,
    changeYear: true,
    // minDate: 0,
  });

  //owl carousel for 1 items
  $('.owl-carousel.owl-solo').owlCarousel({
    loop: true,
    autoplay: true,
    autoplayTimeout: 5000,
    margin: 15,
    responsiveClass: true,
    responsive: {
      0: { items: 1, nav: true },
      576: { items: 1, nav: true },
      768: { items: 1, nav: true },
      992: { items: 1, nav: true },
      1200: { items: 1, nav: true }
    }
  });

  //owl carousel for 2 items
  $('.owl-carousel.owl-duo').owlCarousel({
    loop: true,
    autoplay: true,
    autoplayTimeout: 5000,
    margin: 15,
    responsiveClass: true,
    responsive: {
      0: { items: 1, nav: false },
      576: { items: 1, nav: false },
      768: { items: 2, nav: false },
      992: { items: 2, nav: false },
      1200: { items: 2, nav: false }
    }
  });

  //owl carousel for 3 items
  $('.owl-carousel.owl-trio').owlCarousel({
    loop: true,
    autoplay: true,
    autoplayTimeout: 5000,
    margin: 15,
    responsiveClass: true,
    responsive: {
      0: { items: 1, nav: false },
      576: { items: 1, nav: false },
      768: { items: 2, nav: false },
      992: { items: 3, nav: false },
      1200: { items: 3, nav: false }
    }
  });

  //owl carousel for 4 items
  $('.owl-carousel.owl-quad').owlCarousel({
    loop: true,
    autoplay: true,
    autoplayTimeout: 5000,
    margin: 15,
    responsiveClass: true,
    responsive: {
      0: { items: 1, nav: false },
      576: { items: 1, nav: false },
      768: { items: 2, nav: false },
      992: { items: 3, nav: false },
      1200: { items: 4, nav: false }
    }
  });

  //owl carousel for 5 items
  $('.owl-carousel.owl-penta').owlCarousel({
    loop: true,
    autoplay: true,
    autoplayTimeout: 4000,
    margin: 15,
    responsiveClass: true,
    responsive: {
      0: { items: 1, nav: false },
      576: { items: 2, nav: false },
      768: { items: 3, nav: false },
      992: { items: 4, nav: false },
      1200: { items: 5, nav: false }
    }
  });

  //smooth scroll to links
  $('a.inner-link').click(function () {
    var target = $(this.hash);
    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
    if (target.length) {
      $('html, body').animate({
        scrollTop: target.offset().top
      }, 1000);
      return false;
    }
  });

  // fullheight of device
  var fullHeight = function () {
    $('.js-fullheight').css('height', $(window).height());
    $(window).resize(function () {
      $('.js-fullheight').css('height', $(window).height());
    });
  };
  fullHeight();

  // nav dropdown
  $('nav .dropdown').hover(function () {
    var $this = $(this);
    // 	 timer;
    // clearTimeout(timer);
    $this.addClass('show');
    $this.find('> a').attr('aria-expanded', true);
    // $this.find('.dropdown-menu').addClass('animated-fast fadeInUp show');
    $this.find('.dropdown-menu').addClass('show');
  }, function () {
    var $this = $(this);
    // timer;
    // timer = setTimeout(function(){
    $this.removeClass('show');
    $this.find('> a').attr('aria-expanded', false);
    // $this.find('.dropdown-menu').removeClass('animated-fast fadeInUp show');
    $this.find('.dropdown-menu').removeClass('show');
    // }, 100);
  });


  // topbar after scroll
  var scrollWindow = function () {
    $(window).scroll(function () {
      var $w = $(this),
        st = $w.scrollTop(),
        navbar = $('.ftco_navbar'),
        sd = $('.js-scroll-wrap');
      if (st > 150) {
        if (!navbar.hasClass('scrolled')) {
          navbar.addClass('scrolled');
        }
      }
      if (st < 150) {
        if (navbar.hasClass('scrolled')) {
          navbar.removeClass('scrolled sleep');
        }
      }
      if (st > 350) {
        if (!navbar.hasClass('awake')) {
          navbar.addClass('awake');
        }

        if (sd.length > 0) {
          sd.addClass('sleep');
        }
      }
      if (st < 350) {
        if (navbar.hasClass('awake')) {
          navbar.removeClass('awake');
          navbar.addClass('sleep');
        }
        if (sd.length > 0) {
          sd.removeClass('sleep');
        }
      }
    });
  };
  scrollWindow();

});

