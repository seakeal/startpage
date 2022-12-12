document.addEventListener('DOMContentLoaded', function(event) {
    console.log('RSS function loaded');
    updateRSS();
});

function updateRSS() {
    document.getElementById('rssContainer').innerHTML='<p>Loading RSS feeds...</p>';
    fetch('api/rss.php')
    .then((response) => response.json())
    .then((feed) => console.log(feed));
}
