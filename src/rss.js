var countRSS = 0;

document.addEventListener('DOMContentLoaded', function(event) {
    console.log('RSS function loaded');
    // The following is to update the RSS feed when clicking a
    // // button. I removed the button for now.
    // document.getElementById('RSS-link').onclick = () => {
    //     getRSS();
    //     return false; // Prevents the link from opening
    // };
    getRSS();
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
    // let date = `${MONTHS[parseInt(dateArr[1])]} ${dateArr[2]} ${dateArr[0]} ${dateArr[3]}:${dateArr[4]}`;
    let date = `${MONTHS[parseInt(dateArr[1])-1]} ${dateArr[2]} ${dateArr[0]}`;
    
    let rssBox = `
        <div id="${source}${countRSS}" class="rssBox">
            <img class="rssImg" src="${image}" alt="Image not available">    
            <a class="rssTitle" href="${link}" target="_blank"><h1>${title}</h1></a>
            <!-- <div class="rssDateAuthor"> -->
                <p class="rssAuthor">${source}&nbsp;-&nbsp;${author}</p>
                <p class="rssDate">${date}</p>
                <!-- </div> -->
            <!-- <p class="rssDesc" onclick="showDesc()">${desc}</p> -->
        </div>
        `;
    document.getElementById('rssFeed').style.border="#ed5000 2px solid";
    return rssBox;
}

async function getRSS() {
    console.log('Getting RSS feed...');
    document.getElementById('rssFeed').innerHTML='<p>Loading RSS feed...</p>';
    fetch('api/rss.php')
    .then((response) => response.json())
    .then((feed) => {
        console.log(feed); // TODO: Comment out console log
        let htmlString = '';
        feed.forEach(e => {
            countRSS++;
            htmlString += buildRSSBox(e);
        });
        document.getElementById('rssFeed').innerHTML = htmlString;
    });
}

function showDesc() {
    alert('Where is the description modal?');
    // TODO: Make modal for description
}