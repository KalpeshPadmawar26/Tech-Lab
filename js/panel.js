$(document).ready(function () {
    // Sidebar dropdwon
    $(".sidebar-link-dropdown-box-item").click(function () {
        $(this).children(".sidebar-link-dropdown-img").toggleClass("sidebar-link-dropdown-img-active");
        $(this).closest("li.sidebar-link-box").children(".sidebar-link-dropdown-ul").toggleClass("sidebar-link-dropdown-ul-active");
    })

    // Sidebar dropdwon auto active if item is from dropdown
    $(".sidebar-link-box-item-active").closest("li.sidebar-link-box").children(".sidebar-link-dropdown-ul").toggleClass("sidebar-link-dropdown-ul-active");
    
    // sidebar menu button
    $(".sidebar-menu-btn").click(function () {
        $(this).toggleClass("sidebar-menu-btn-active");
        $(".sidebar-sec").toggleClass("sidebar-sec-active");
    })

    // Table more button
    $(".table-more-img").click(function () {
        $(".table-action-more-area").not($(this).closest(".table-action-area").children(".table-action-more-area")).removeClass("table-action-more-area-active");
        $("tr").not($(this).closest("tr")).removeClass("tr-active");
        $(this).closest(".table-action-area").children(".table-action-more-area").toggleClass("table-action-more-area-active");
        $(this).closest("tr").toggleClass("tr-active");
    })

    $("input[name='switch']").change(function () {
        if ($(this).hasClass("student-signin-btn")) {
            $(".sign-in-sec").css('background-image', 'url("./images/student_login_bg.jpg")');
        } else if ($(this).hasClass("admin-signin-btn")) {
            $(".sign-in-sec").css('background-image', 'url("./images/admin_login_bg.jpg")');
        }
    });

    // CloudFlare responsive
    function scaleCaptcha() {
        var reCaptchaWidth = 304;
        var containerWidth = $('.sign-in-form-area').width();
        if (reCaptchaWidth > containerWidth) {
            var captchaScale = containerWidth / reCaptchaWidth;
            $('.cf-turnstile').css({
                'transform': 'scale(' + captchaScale + ')'
            });
        }
    }
    scaleCaptcha();

    // Serach prevent refresh
    $("#search_form").submit(function (e) {
        e.preventDefault();
    });

         var isDragging = false;
          var startScrollLeft;
          var startX;

          $(".table-area").on("mousedown", function(e) {
            isDragging = true;
            startScrollLeft = this.scrollLeft;
            startX = e.clientX;
            e.preventDefault();
          });

          $(document).on("mouseup", function() {
            isDragging = false;
          });

          $(document).on("mousemove", function(e) {
            if (!isDragging) return;
            var currentX = e.clientX;
            var diffX = currentX - startX;
            $(".table-area")[0].scrollLeft = startScrollLeft - diffX;
          });
})



