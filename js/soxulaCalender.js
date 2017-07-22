var Calender = class {
    constructor(doc,dateToHighlight) {
        Calender.document = doc;
        Calender.SelectedDay = dateToHighlight;
    };
    printDay(date, entry = []) {

        entry.push("Stuff");
        entry.push("I");
        entry.push("Like");


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
            document.write("\" id=\"cal-name-element-day-" + tempDate.getDate() + "\">");
            document.write("<div><time datetime=\"" + tempDate.getFullYear() + "-" + tempDate.getDate() + "\">" + CalenderFunctions.getDayOfWeekString(tempDate.getDay()) + " " + (tempDate.getDate()) + "</time></div>");
            document.write("<ul>");                
            entry.forEach(function (value) {
                document.write("<li>" + value + "</li>");
            });
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
        Calender.document.write("<div style=\"float:left;\">" + CalenderFunctions.getMonthString(date.getMonth()) + "</div><div>" + date.getFullYear() + "</div>");
        date.setDate(1);
        do {
            this.printWeek(date);
            
        }while(date.getMonth() == placeHolderMonth)
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

function printgarbage() {
    var str = "";
    for (i = 0; i < 500; i++) {
        str += "lk;jalk;djflk;adjsflkjsadklfja;lkdjfl;kdsa";
    }
    return str;
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

