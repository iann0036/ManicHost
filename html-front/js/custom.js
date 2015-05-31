(function($) {
    "use strict";

    // ______________ RESPONSIVE MENU
    $(document).ready(function() {

        $('#navigation').superfish({
            delay: 300,
            animation: {
                opacity: 'show',
                height: 'show'
            },
            speed: 'fast',
            dropShadows: false
        });

        $(function() {
            $('#navigation').slicknav({
                closedSymbol: "&#8594;",
                openedSymbol: "&#8595;"
            });
        });

    });



    // ______________ ANIMATE EFFECTS
    var wow = new WOW({
        boxClass: 'wow',
        animateClass: 'animated',
        offset: 0,
        mobile: false
    });
    wow.init();


})(jQuery);
