$(document).ready(function () {
    Window_Resize();
    var date = new Date();
    var today = date.getDate();
    var thisMonth = date.getMonth();
    var element = "#cal-name-element-month-" + thisMonth + "-day-" + today;
    alert(element);
    var scrollPostion = $(element).position().top;
    $(this).scrollTop(scrollPostion);
});