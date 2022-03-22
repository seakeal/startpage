document.addEventListener('DOMContentLoaded', function(event) {
    console.log('Clock function loaded');
    updateClock();
});

function updateClock() {
    const DAYS = ['SUNDAY', 'MONDAY', 'TUESDAY', 'WEDNESDAY', 'THURSDAY', 'FRIDAY', 'SATURDAY'];
    var t = new Date();
    var dateString = DAYS[t.getDay()]+' ' +
        ('0'+(t.getMonth()+1)).slice(-2)+'.' +
        ('0'+t.getDate()).slice(-2)+'.' +
        t.getFullYear()+' '+
        ('0'+t.getHours()).slice(-2)+':'+
        ('0'+t.getMinutes()).slice(-2)+':'+
        ('0'+t.getSeconds()).slice(-2);
    document.getElementById('time').innerHTML = dateString;
    setTimeout(updateClock, 1000);
}