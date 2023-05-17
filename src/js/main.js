;(function ($) {
    $(document).ready(function () {
        // Scroll Top Button
        $(".scrollToTop").on("click", function () {
            $("body,html").animate(
                {
                    scrollTop: 0,
                },
                360
            );
        });
        $(window).on("scroll", function () {
            var scrollBar = $(this).scrollTop();

            if (scrollBar > 200) {
                $(".scrollToTop").fadeIn();
            } else {
                $(".scrollToTop").fadeOut();
            }
        });
    });
}(jQuery));