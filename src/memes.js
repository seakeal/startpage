// document.addEventListener('DOMContentLoaded', function(event) {
//     console.log('Meme client loaded');
//     document.getElementById('Memes-link').onclick = () => {
//         getMemes();
//         return false; // Prevents the link from opening
//     };
// });

// function getMemes() {
//     console.log('Loading memes...');
// }

var tagCount = 1;
function addTagBox() {
    if (tagCount < 10) {
        let newTag = document.createElement('input');
        newTag.type = 'text';
        newTag.name = `newTag${tagCount}`;
        document.getElementById('tagList').appendChild(newTag);
        tagCount++;
    } else {
        console.log('Max allowed tags reached');    
    }
    if (tagCount === 10) {
        document.getElementById('addTagBox').remove();
    }
}