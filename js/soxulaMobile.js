if (HelperFunctions.isMobile(navigator)) {
    $('#calender').width(400);
    $('.calender-element').width(350);
}

$(window).resize(function () {
    if ($(window).width() <= 970) {
        $('#calender').width($(window).width()-5);
        $('.calender-element').width($('#calender').width()-20);
    } else {
        $('#calender').width($(window).width() - 5);
        $('.calender-element').width($('#calender').width()/7-20);
    }
});