document.addEventListener('DOMContentLoaded', function(event) {
    console.log('Halloween Countdown function loaded');
    countdownToNextHalloween();
});

function countdownToNextHalloween() {
    let today = new Date();
    let month = today.getMonth() + 1;
    if (month === 10 && today.getDate() === 31) {
        document.getElementById('halloweenCd').innerHTML = 'Happy Halloween!';
        return 0;
    }

    let nextHalloween;
    if (month < 10) {
        nextHalloween = new Date(today.getFullYear(), 9, 31);
    } else {
        nextHalloween = new Date(today.getFullYear() + 1, 9, 31);
    }

    let timeUntil = nextHalloween-today;
    let daysUntil = Math.floor(timeUntil/86400000);
    timeUntil -= daysUntil*86400000;
    let hoursUntil = Math.floor(timeUntil/3600000);
    timeUntil -= hoursUntil*3600000;
    let minUntil = Math.floor(timeUntil/60000);
    timeUntil -= minUntil*60000;
    let secUntil = Math.floor(timeUntil/1000);

    document.getElementById('halloweenCd').innerHTML = `${daysUntil} days ${hoursUntil} hours ${minUntil} minutes ${secUntil} seconds`;
    setTimeout(countdownToNextHalloween, 1000);
}