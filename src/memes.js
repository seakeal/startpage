document.addEventListener('DOMContentLoaded', function(event) {
    console.log('Meme client loaded');
    document.getElementById('Memes-link').onclick = () => {
        getMemes();
        return false; // Prevents the link from opening
    };
});

function getMemes() {
    console.log('Loading memes...');
}