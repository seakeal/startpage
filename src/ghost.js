var cursorX = 0;
var cursorY = 0;

function activateGhost() {
    console.log('Ghost activated')
    document.addEventListener('mousemove', (cursor) => {
        informGhost(cursor);
    });
    document.getElementById('ghost').style.left = document.getElementById('gravestone').getBoundingClientRect().left + 'px';
    document.getElementById('ghost').style.top = document.getElementById('gravestone').getBoundingClientRect().top + 'px';
    document.getElementById('ghost').style.visibility='visible';

    moveGhost();
}

function moveGhost() {

    let ghost = document.getElementById('ghost');
    let xMax = document.body.getBoundingClientRect().width - ghost.getBoundingClientRect().width;
    let yMax = document.body.getBoundingClientRect().height - ghost.getBoundingClientRect().height;
    let step = 1;

    let ghostX = ghost.getBoundingClientRect().left;
    let ghostY = ghost.getBoundingClientRect().top;
    
    let dX = cursorX-ghostX;
    let dY = cursorY-ghostY;
    
    if (Math.sqrt(Math.pow(dX,2)+Math.pow(dY,2)) > 5) {
        let moveX = dY === 0 ? step : Math.sqrt(Math.pow(step,2)/(1 + (Math.pow(dY,2)/Math.pow(dX,2)))) * (dX/Math.abs(dX));
        let moveY = dX === 0 ? step : Math.sqrt(Math.pow(step,2)/(1 + (Math.pow(dX,2)/Math.pow(dY,2)))) * (dY/Math.abs(dY));

        ghostX += moveX;
        ghostY += moveY;
    
        if (ghostX > xMax) { ghostX = xMax; }
        if (ghostY > yMax) { ghostY = yMax; }
        if (ghostX < 0) { ghostX = 0; }
        if (ghostY < 0) { ghostY = 0; }
    
        ghost.style.left = ghostX + 'px';
        ghost.style.top = ghostY + 'px';
    }    

    setTimeout(moveGhost, 10);
}

function informGhost(cursor) {
    cursorX = cursor.pageX;
    cursorY = cursor.pageY;
}