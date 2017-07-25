var HelperFunctions = class {
    static isMobile(navigator) {
        var str = navigator.appVersion.toString();
        str = str.toLowerCase();
        if (str.includes("Android".toLowerCase())) return true;
        if (str.includes("ios".toLowerCase())) return true;
        return false;
    };
};

function Window_Resize() {
    if ($(window).width() <= 970) {
        $('#calender').width($(window).width() - 5);
        $('.calender-element').width($('#calender').width() - 20);
    } else {
        $('#calender').width($(window).width() - 5);
        $('.calender-element').width($('#calender').width() / 7 - 20);
    }
}

/*****************************************
RUN AND SET ADJUSTMENTS
*****************************************/

if (HelperFunctions.isMobile(navigator)) {
    $('#calender').width(400);
    $('.calender-element').width(350);
}

$(window).resize(Window_Resize);

function printMounthCarosel(document, date) {
    document.write("<div>");
        document.write("<div id=\"month-view\">");
        var newCalender = new Calender(document, new Date());
        newCalender.printMonth(new Date());
        document.write("</div>");
        document.write("<div class=\"btn previous\" id=\"caroselprevious\">Previous</div>"); 
        document.write("<div class=\"btn next\" id=\"carosel-next\">Next</div>"); 
        document.write("</div>");
        $('#caroselprevious').click(function () {alert('CLICKED');});
}