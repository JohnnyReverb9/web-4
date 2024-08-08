$(document).ready(function() {
    positionFooter();

    $(window).resize(function() {
        positionFooter();
    });

    function positionFooter() {
        var bodyHeight = $('body').height();
        var viewportHeight = $(window).height();

        if (bodyHeight < viewportHeight) {
            $('footer').css({
                'position': 'fixed',
                'bottom': '0',
            });
        } else {
            // $('footer').css({
            //     'position': 'relative',
            //     'bottom': 'auto'
            // });
            $('footer').css({
                'position': 'fixed',
                'bottom': '0',
            });
        }
    }
});
