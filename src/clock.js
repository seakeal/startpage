const DAYS = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
const MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

var prevWeekday;
var prevMonth;
var prevNumday;
var prevYear;
var prevHours;
var prevMinutes;
var prevSeconds;


document.addEventListener('DOMContentLoaded', function(event) {
    console.log('Clock function loaded');
    var clock = document.getElementById('clock');
    updateClock();
});

function updateClock() {
    let t = new Date();
    
    let weekday = DAYS[t.getDay()];
    let month = MONTHS[t.getMonth()];
    let numday = ('0'+t.getDate()).slice(-2);
    let year = t.getFullYear();
    let hours = ('0'+t.getHours()).slice(-2);
    let minutes = ('0'+t.getMinutes()).slice(-2);
    let seconds = ('0'+t.getSeconds()).slice(-2);


    let dateString = `<div id="clockDate" class="clockDate">
        <span id="clockWeekday" class="clockDate">${weekday}</span>
        <span id="clockMonth" class="clockDate">${month}</span>
        <span id="clockNumday" class="clockDate">${numday}</span>
        <span id="clockYear" class="clockDate">${year}</span>
    </div>
    <div id="clockTime" class="clockTime">
        <span id="clockHrs" class="clockTime">${hours}</span>
        <span class="clockColon">:</span>
        <span id="clockMins" class="clockTime">${minutes}</span>
        <span class="clockColon">:</span>
        <span id="clockSecs" class="clockTime">${seconds}</span>
    </div>`;

    clock.innerHTML = dateString;

    if (seconds !== prevSeconds) {
        document.getElementById('clockSecs').classList.add('colorFade');
    }

    prevWeekday = weekday;
    prevMonth = month;
    prevNumday = numday;
    prevYear = year;
    prevHours = hours;
    prevMinutes = minutes;
    prevSeconds = seconds;

    setTimeout(updateClock, 999);
}
