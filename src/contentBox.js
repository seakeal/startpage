var contentBox;

document.addEventListener('DOMContentLoaded', function(event) {
    console.log('Content Box loaded');
    contentBox = document.querySelector('#contentBox');
    // TODO: Think about moving this to style.css
    contentBox.style = `
        visibility: hidden;
        width: 600px;
        height: 400px;
        border: 5px ridge #a6363a;
    `;
    document.addEventListener('keydown', (k) => {
        if(k.key === ' ') {
            openContentBox('Hello World');
        }
    });
});

function openContentBox(content) {
    contentBox.style.visibility = 'visible';
    contentBox.innerHTML = content;
    document.body.addEventListener('keydown', (k) => handleEscape(k));
}

function closeContentBox() {
    contentBox.style.visibility = 'hidden';
    contentBox.innerHTML = '';
}

// TODO: Figure out a good way to open and close the box
function handleEscape(k) {
    if (k.key === 'Escape') {
        document.body.removeEventListener('keydown', handleEscape(k));
        closeContentBox();
    }
}