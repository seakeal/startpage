let cursorX     = 0;
let cursorY     = 0;
let step        = 1;
let ghostActive = false;

// ************************************
// Init on page load
// - Set listener to track cursor
// - Set listener for gravestone to activate ghost
// ************************************
document.addEventListener('DOMContentLoaded', () => {
    document.addEventListener('mousemove', (cursor) => {
        informGhost(cursor);
    });

    let gravestone = document.getElementById('gravestone');
    gravestone.addEventListener('click',toggleGhost);
    
    moveGhost();
});

function toggleGhost() {
    console.log(`Ghost activated - step = ${step}`);
    
    let ghost       = document.getElementById('ghost');
    let gravestone  = document.getElementById('gravestone');

    ghost.style.left        = gravestone.getBoundingClientRect().left + 'px';
    ghost.style.top         = gravestone.getBoundingClientRect().top + 'px';
    ghostActive = !ghostActive;
    step = !ghostActive ? step+3 : step;
    step = step > 16 ? 1 : step;
    ghost.style.visibility  = ghostActive ? 'visible' : 'hidden';
}

function informGhost(cursor) {
    cursorX = cursor.pageX;
    cursorY = cursor.pageY;
}

function moveGhost() {

    let ghost = document.getElementById('ghost');
    let xMax = document.body.getBoundingClientRect().width - ghost.getBoundingClientRect().width;
    let yMax = document.body.getBoundingClientRect().height - ghost.getBoundingClientRect().height;

    let ghostX = ghost.getBoundingClientRect().left;
    let ghostY = ghost.getBoundingClientRect().top;
    
    let dX = cursorX-ghostX;
    let dY = cursorY-ghostY;
    
    if (Math.sqrt(Math.pow(dX,2)+Math.pow(dY,2)) > 10) {
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
