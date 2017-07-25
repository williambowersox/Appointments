var Calender = class {
    constructor(doc,dateToHighlight) {
        Calender.document = doc;
        Calender.SelectedDay = dateToHighlight;
        Calender.largestElement = 0;
    };
    printDay(date) {

        if (!date) return "No param passed to printDay(date)";
        let tempDate = new Date();
        tempDate = date;
        let today = new Date();
        var str = "";
        var document = Calender.document;

        if (tempDate < 1) {
            return "Invalid date received: Calender.printDay()";
        }
            document.write("<div class=\"calender-element ");
            if (tempDate.getDate() == today.getDate() &&
                tempDate.getFullYear() == today.getFullYear() &&
                tempDate.getMonth() == today.getMonth()) {
                document.write(" today");
            }
            var elementID = "cal-name-element-month-"+tempDate.getMonth()+"-day-" + tempDate.getDate();
            document.write("\" id=\"" + elementID + "\">");
            document.write("<div><h2 class=\"cal-date-header\"><time datetime=\"" + tempDate.getFullYear() + "-" + tempDate.getDate() + "\">" + CalenderFunctions.getDayOfWeekString(tempDate.getDay()) + " " + (tempDate.getDate()) + "</time></h2></div>");
            document.write("<ul >");    
            var lastTime = "";
            var date;
            Appointments.forEach(function (value) {
                date = new Date(value.Appointment.Date);
                if (date.getMonth() == tempDate.getMonth() &&
                    date.getDate() == tempDate.getDate()) {
                    var time = date.toLocaleTimeString('en-US', {hour: '2-digit', minute: '2-digit'});
                    document.write("<li class=\"event-list\">");
                    /**************
                    TEMP FUNCTION UNTIL DATABASE IS MADE FOR THIS
                    **************/
                    if (value.Appointment.Invitee == 2) value.Appointment.Invitee = "JRR";
                    if (value.Appointment.Invitee == 3) value.Appointment.Invitee = "NORIS";
                    document.write(value.Appointment.Invitee + ":" + time + "</li>");
                    lastTime = date.toLocaleTimeString();
                }
            });
            if (date.toLocaleTimeString() == lastTime && tempDate.getMonth() == date.getMonth()) {
                $("<aside class=\"warning\">WARNING: You may have double booked.</aside>").prependTo('#' + elementID);/*document.write("<aside class=\"warning\">WARNING: You may have double booked.</aside>");*/
            }

            document.write("</ul>");
            document.write("</div > ");

    };
    printWeek(date) {
        var dayOfWeek = date.getDay();
        date.setDate(date.getDate() - dayOfWeek);
        Calender.document.write("<div class=\"calender-row\" >");
        for (var i = 0; i < DateEnums.DaysInWeek; i++) {
            this.printDay(date);
            date.setDate(date.getDate() + 1);
        }
        Calender.document.write("</div>");
    };
    printMonth(date) {
        var placeHolderMonth = date.getMonth();
        Calender.document.write("<div class=\"calender-month-container\">");
        Calender.document.write("<header class=\"calender-month-header\"><h1>" + CalenderFunctions.getMonthString(date.getMonth()) + " " + date.getFullYear() + "</h1></header>");
        date.setDate(1);
        do {
            this.printWeek(date);
        } while (date.getMonth() == placeHolderMonth)
        Calender.document.write("</div>");
    };
    printYear(date) {
        date.setMonth(0); date.setDate(1);
        for (var i = 0; i < DateEnums.MonthsInYear; i++) {
            this.printMonth(date);
        }
    }; 
};



var DateEnums = {
    DaysInWeek: 7,
    MonthsInYear: 12
}
var CalenderFunctions = class {
    static getDayOfWeekString(int) {
        int++;
        switch (int) {
            case 1:
                return "Sunday";
            case 2:
                return "Monday";
            case 3:
                return "Tuesday";
            case 4:
                return "Wednesday";
            case 5:
                return "Thursday";
            case 6:
                return "Friday";
            case 7:
                return "Saturday";
        }
    };
    static getMonthString(int) {
        int++; /*Because of the Date class is a one off value*/
        switch (int) {
            case 1:
                return "January";
            case 2:
                return "Febuary";
            case 3:
                return "March";
            case 4:
                return "April";
            case 5:
                return "May";
            case 6:
                return "June";
            case 7:
                return "July";
            case 8:
                return "August";
            case 9:
                return "September";
            case 10:
                return "October";
            case 11:
                return "November";
            case 12:
                return "December";
        }
    };
};

