document.addEventListener('DOMContentLoaded', function(event) {
    console.log('RSS function loaded');
    updateRSS();
});

function updateRSS() {
    document.getElementById('rssContainer').innerHTML='<p>Loading RSS feeds...</p>';
    fetch('api/rss.php')
    .then((response) => response.json())
    .then((feed) => {
        console.log(feed);
        var feedList = [];
        document.getElementById('rssContainer').innerHTML='<p>RSS feeds loaded</p>';
        feed.forEach(element => {
            let source  = element.source;
            let title   = element.title;
            let link    = element.link;
        });
    })
}
