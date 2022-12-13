document.addEventListener('DOMContentLoaded', function(event) {
    console.log('RSS function loaded');
    updateRSS();
});

function updateRSS() {
    document.getElementById('rssContainer').innerHTML='<p>Loading RSS feeds...</p>';
    fetch('api/rss.php')
    .then((response) => response.json())
    .then((feed) => {
        // console.log(feed);
        let htmlString = '';
        let i = -1;
        feed.forEach(element => {
            i++;
            let source  = element.source;
            let title   = element.title;
            let link    = element.link;
            let rawDate = element.date.split(" ");
            let html    = element.html;

            // Month has to be -1 because it's counting the months 0-11
            let date = new Date(rawDate[0],rawDate[1]-1,rawDate[2],rawDate[3],rawDate[4],rawDate[5])

            let rssElement = `
            <div class="rssElement" id="rss${i}">
                <h3>${title}</h3>
                <p>${date.toLocaleDateString()}</p>
                <div
                    class="rssData"
                    id="rssData${i}"
                    style="font-size: 8px; overflow: hidden;"
                >
                    ${html}
                </div>
            </div>
            `;
            htmlString += rssElement;
        });
        document.getElementById('rssContainer').innerHTML=htmlString;
    })
    .then(() => {
        document.getElementById('rssButton').style.marginLeft='316px';
        document.getElementById('rssButton').innerHTML=rssSVG;
    });
}

function toggleRss() {
    if (document.getElementById('rssContainer').style.visibility == 'hidden') {
        document.getElementById('rssContainer').style.visibility='visible';
        document.getElementById('rssButton').style=rssClose;
        document.getElementById('rssButton').innerHTML='X';
    } else {
        document.getElementById('rssContainer').style.visibility='hidden';
        document.getElementById('rssButton').style='margin-left:316px';
        document.getElementById('rssButton').innerHTML=rssSVG;
    }
}

var rssClose = `
    margin-left:584px;
    width: 26px;
    height: 26px;
    font-size: 20px;
    font-weight: bold;
    color: rgba(153, 0, 0, 1);
    background-color: rgba(238, 237, 235, 1);
    border: 6px ridge rgba(238, 237, 235, 1);
    /* border-radius: 15%; */
`
var rssSVG = `
<svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="32px" height="32px" id="RSSicon" viewBox="0 0 256 256">
    <defs>
    </defs>
    <rect width="256" height="256" rx="55" ry="55" x="0" y="0" fill="#EEEDEB"/>
    <circle cx="68" cy="189" r="24" fill="#990000"/>
    <path d="M160 213h-34a82 82 0 0 0 -82 -82v-34a116 116 0 0 1 116 116z" fill="#990000"/>
    <path d="M184 213A140 140 0 0 0 44 73 V 38a175 175 0 0 1 175 175z" fill="#990000"/>
</svg>
`

var rssSVGog = `
<svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="32px" height="32px" id="RSSicon" viewBox="0 0 256 256">
    <defs>
    <linearGradient x1="0.085" y1="0.085" x2="0.915" y2="0.915" id="RSSg">
    <stop offset="0.0" stop-color="#e32d2d"/><stop offset="0.1071" stop-color="#ea3131"/>
    <stop offset="0.3503" stop-color="#f63737"/><stop offset="0.5" stop-color="#fb3a3a"/>
    <stop offset="0.7016" stop-color="#ea3131"/><stop offset="0.8866" stop-color="#de2b2b"/>
    <stop offset="1.0" stop-color="#d92929"/>
    </linearGradient>
    </defs>
    <rect width="256" height="256" rx="55" ry="55" x="0" y="0" fill="#cc1515"/>
    <rect width="246" height="246" rx="50" ry="50" x="5" y="5" fill="#f45252"/>
    <rect width="236" height="236" rx="47" ry="47" x="10" y="10" fill="url(#RSSg)"/>
    <circle cx="68" cy="189" r="24" fill="#FFF"/>
    <path d="M160 213h-34a82 82 0 0 0 -82 -82v-34a116 116 0 0 1 116 116z" fill="#FFF"/>
    <path d="M184 213A140 140 0 0 0 44 73 V 38a175 175 0 0 1 175 175z" fill="#FFF"/>
</svg>
`
