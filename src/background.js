/*
Add this code to your site for the effect to work
<div id="bgContainer" class="bgContainer">
    <canvas id="bgCanvas">
        error: your browser does not support the canvas element
    </canvas>
</div>
*/

var bgColor1 = '#2b2b2b'
var bgColor2 = '#1a1a1a'

document.addEventListener('DOMContentLoaded', function(event) {
    console.log('Background animation loaded');
    var canvas = document.getElementById('bgCanvas');
    if (!canvas.getContext) {
        canvas.innerHTML('error: context failed to load');
        return;
    }
    // Fun colors '#e67e00' '#9c4900' #7a2c02
    animateBackground(0.0,1.0,bgColor1,bgColor2);
});

function animateBackground(x,y,c1,c2) {
    var canvas = document.getElementById('bgCanvas');
    canvas.width=window.innerWidth;
    canvas.height=window.innerHeight;
    var ctx = canvas.getContext('2d');
    if (x > 0.00) {
        x = (x-0.0025).toFixed(4);
    }
    else if (y < 0.01) {
        ctx.fillStyle = c2;
        ctx.fillRect(0, 0, window.innerWidth, window.innerHeight);
        c = c1;
        c1 = c2;
        c2 = c;
        x = 1.0;
        y = 1.0;
    } else {
        y = (y - 0.0025).toFixed(4);
    }
    var grad = ctx.createLinearGradient(0,0,0, window.innerHeight);
    // console.log(`x: ${x} y: ${y} c1: ${c1} c2: ${c2}`);
    grad.addColorStop(x, c1);
    grad.addColorStop(y, c2);
    ctx.fillStyle = grad;
    ctx.fillRect(0, 0, window.innerWidth, window.innerHeight);
    setTimeout(animateBackground,10,x,y,c1,c2);
}