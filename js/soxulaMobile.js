if (HelperFunctions.isMobile(navigator)) {
    $('#calender').width(400);
    $('.calender-element').width(350);
}

function Window_Resize() {
    if ($(window).width() <= 970) {
        $('#calender').width($(window).width() - 5);
        $('.calender-element').width($('#calender').width() - 20);
    } else {
        $('#calender').width($(window).width() - 5);
        $('.calender-element').width($('#calender').width() / 7 - 20);
    }
}

$(window).resize(Window_Resize);