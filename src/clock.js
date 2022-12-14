document.addEventListener('DOMContentLoaded', function(event) {
    console.log('Clock function loaded');
    updateClock();
});

function updateClock() {
    const DAYS = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    const MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    var t = new Date();
    // var dateString = DAYS[t.getDay()]+' ' +
    //     ('0'+(t.getMonth()+1)).slice(-2)+'.' +
    //     ('0'+t.getDate()).slice(-2)+'.' +
    //     t.getFullYear()+' '+
    //     ('0'+t.getHours()).slice(-2)+':'+
    //     ('0'+t.getMinutes()).slice(-2); +':'+
    //     ('0'+t.getSeconds()).slice(-2);
    var dateString = '<div class="time" id="clockTime">'+
    ('0'+t.getHours()).slice(-2)+':'+
    ('0'+t.getMinutes()).slice(-2)+
    '</div><div class="time" id="clockDate">'+
    DAYS[t.getDay()]+', '+
    MONTHS[t.getMonth()] + ' '+
    ('0'+t.getDate()).slice(-2)+' ' +
    t.getFullYear()+'</div>';
    document.getElementById('clock').innerHTML = dateString;
    setTimeout(updateClock, 1000);
}
