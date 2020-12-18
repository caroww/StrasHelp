function closeAlert() {
    setTimeout(function () {
      $(".more-ot-alert").fadeOut("fast");
    }, 100);
  }
  function openAlert() {
    $(".more-ot-alert").fadeIn("fast");
    // IE8 animation polyfill
    if ($("html").hasClass("lt-ie9")) {
      var speed = 300;
      var times = 3;
      var loop = setInterval(anim, 300);
      function anim() {
        times--;
        if (times === 0) { clearInterval(loop); }
        $(".more-ot-alert").animate({ left: 450 }, speed ).animate({ left: 440 }, speed );
        //.stop( true, true ).fadeIn();
      }
      anim();
    }
  }
  $(".close-ot-alert").on("click", function () {
    closeAlert()
  });

  $(".open-ot-alert").on("click", function () {
    openAlert();  
  });

  $(document).keydown(function(e) {
    if (e.keyCode == 27) { closeAlert(); }
    if (e.keyCode == 67) { openAlert(); }
  });
