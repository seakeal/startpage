var countRSS = 0;

document.addEventListener('DOMContentLoaded', function(event) {
    console.log('RSS function loaded');
    document.getElementById('RSS-link').onclick = () => {
        getRSS();
        return false; // Prevents the link from opening
    };
});

function buildRSSBox(jsonRSS) {
    let author      = jsonRSS.author;
    let desc        = jsonRSS.desc;
    let image       = jsonRSS.image;
    let link        = jsonRSS.link;
    // let site        = jsonRSS.site; unused → icon maybe???
    let source      = jsonRSS.source;
    let title       = jsonRSS.title;
    
    // Date formatting
    let dateArr = jsonRSS.date.split(' ');
    let date = `${MONTHS[parseInt(dateArr[1])]} ${dateArr[2]} ${dateArr[0]} ${dateArr[3]}:${dateArr[4]}`;
    
    let rssBox = `
        <div id="${source}${countRSS}" class="rssBox">
            <img class="rssImg" src="${image}" alt="Image not available">    
            <a class="rssTitle" href="${link}" target="_blank"><h1>${title}</h1></a>
            <div class="rssDateAuthor">
                <p class="rssAuthor">${author}</p>
                <p class="rssDate">${date}</p>
            </div>
            <!-- <p class="rssDesc" onclick="showDesc()">${desc}</p> -->
        </div>
        `;
    document.getElementById('rssFeed').style.border="#a6363a 2px solid";
    return rssBox;
}

async function getRSS() {
    console.log('Getting RSS feed...');
    // contentBoxOn(); TODO: Add JS for displaying the content box
    document.getElementById('contentBox').innerHTML='<p>Loading RSS feed...</p>';
    fetch('api/rss.php')
    .then((response) => response.json())
    .then((feed) => {
        console.log(feed); // TODO: Remove
        let htmlString = '';
        feed.forEach(e => {
            countRSS++;
            htmlString += buildRSSBox(e);
        });
        document.getElementById('rssFeed').innerHTML = htmlString;
    });
}

async function loadMoreRss() {
    console.log('Loading more RSS ');
    fetch(`api/moreRss.php?count=${countRSS}`)
    .then((response) => response.json())
    .then((feed) => {
        console.log(feed); // TODO: Remove
        let htmlString = document.getElementById('contentBox').innerHTML;
        feed.array.forEach(e => {
            countRSS++;
            htmlString += buildRSSBox(e);
        });
        document.getElementById('contentBox').innerHTML = htmlString;
    })
}

function showDesc() {
    alert('Where is the description modal?');
    // TODO: Make modal for description
}

// #### EVERYTHING BELOW THIS LINE IS DEPRECATED ####

var rssClose = `
    margin-left:584px;
    /* width: 26px;
    height: 26px;
    font-size: 20px;
    font-weight: bold;
    color: rgba(153, 0, 0, 1);
    background-color: rgba(238, 237, 235, 1);
    border: 6px ridge rgba(238, 237, 235, 1);
    border-radius: 15%; */
`;

var rssSvg = `
<svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="32px" height="32px" id="RSSicon" viewBox="0 0 256 256">
    <defs>
    </defs>
    <rect width="256" height="256" rx="55" ry="55" x="0" y="0" fill="#EEEDEB"/>
    <circle cx="68" cy="189" r="24" fill="#990000"/>
    <path d="M160 213h-34a82 82 0 0 0 -82 -82v-34a116 116 0 0 1 116 116z" fill="#990000"/>
    <path d="M184 213A140 140 0 0 0 44 73 V 38a175 175 0 0 1 175 175z" fill="#990000"/>
</svg>
`;

var rssSvgActive = `
<svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="32px" height="32px" id="RSSicon" viewBox="0 0 256 256">
    <defs>
    </defs>
    <rect width="256" height="256" rx="55" ry="55" x="0" y="0" fill="#990000"/>
    <circle cx="68" cy="189" r="24" fill="#EEEDEB"/>
    <path d="M160 213h-34a82 82 0 0 0 -82 -82v-34a116 116 0 0 1 116 116z" fill="#EEEDEB"/>
    <path d="M184 213A140 140 0 0 0 44 73 V 38a175 175 0 0 1 175 175z" fill="#EEEDEB"/>
</svg>
`;

var rssSvgOriginal = `
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
`;

