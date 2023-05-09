<?php

// Glocal Constants
$DATEFORMAT = 'Y m d h i s';

// ##############################################
// ## Utility functions
// ##############################################

// Consistent format for the RSS arrays returned to the main feed
function buildReturnArray(&$array, $author, $date, $desc, $image, $link, $site, $source, $title) {   
    // Convert to strings or output be XML objects
    $array[] = array(
        'author'    => (string) $author,
        'date'      => (string) $date,
        'desc'      => (string) $desc,
        'image'     => (string) $image,
        'link'      => (string) $link,
        'site'      => (string) $site,
        'source'    => (string) $source,
        'title'     => (string) $title,
    );
}

// Callback to sort feed by date
function dateSort($a, $b) : int {
    if ($a["date"] == $b["date"])
        return 0;
    return $a["date"] > $b["date"] ? -1 : 1;
}

// Builds an <a> tag string cleanly - not currently being used
// function htmlLink($link, $text="", $class="", $id="") : string {
//     $htmlString = '<a ';

//     if ($class <> "")
//         $htmlString .= 'class="'.$class.'" ';
//     if ($id <> "")
//         $htmlString .= 'id="'.$id.'" ';
//     $htmlString .= 'href="'.$link.'" target="_blank">'.$text.'</a>';
    
//     return $htmlString;
// }

// ##############################################
// ## RSS Functions
// ##############################################

// cURL to get RSS feed from source
function getRss($feed) : string {
    $ch = curl_init($feed);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $rssOut = curl_exec($ch);
    if(curl_error($ch))
        $rssOut = curl_error($ch);
    curl_close($ch);
    return $rssOut;
}

function rssStarsector($rss) : array {
    // Globals
    global $DATEFORMAT;
    $source = "Starsector";
    $link = "https://fractalsoftworks.com/";
    $dateLength = 16;

    // Namespaces
    $rss->registerXPathNamespace('dc','http://purl.org/dc/elements/1.1/'); // Gets article author (not working)

    $feed = array();

    // for($i = 0; $i < 3; $i++) { // Uncomment for multiple articles
    $i = 0;
    // Each article is an item in the channel
    $article = $rss->channel->item[$i]; // Uncomment for multiple articles

    $author = 'Alexander Mosolov';
    $date = DateTimeImmutable::createFromFormat('D, d M Y H:i:s', substr($article->pubDate,0,25))->format($DATEFORMAT);
    $desc = substr($article->description,0,-10).'&#8230;'; // Replaces ellipses
    $image = 'img/rss/starsector-domain.webp';
    $link = $article->link;
    $site = 'https://fractalsoftworks.com/';
    $source = 'Starsector';
    $title = $article->title;

    buildReturnArray($feed, $author, $date, $desc, $image, $link, $site, $source, $title);
    // } // Uncomment for multiple articles

    return $feed;
   
}

function rssUltiworld($rss) : array {
    // Globals
    global $DATEFORMAT;
    // Namespaces
    $rss->registerXPathNamespace('dc','http://purl.org/dc/elements/1.1/'); // Gets article author (not working)

    // Implemented to find only first article
    $article = $rss->channel->item[0];

    $author = $rss->xpath('//dc:creator')[0];
    $date = DateTimeImmutable::createFromFormat('D, d M Y H:i:s', substr($article->pubDate,0,25))->format($DATEFORMAT);
    $desc = $article->description;
    $image = $rss->channel->image->url;
    $link = $article->link;
    $site = $rss->channel->link;
    $source = 'Ultiworld';
    $title = $article->title;

    $feed = array();
    buildReturnArray($feed, $author, $date, $desc, $image, $link, $site, $source, $title);

    return $feed;
}

function rssYouTube($rss) : array {
    // **** Code to find YouTube creator ID ****
    // **** Inspect YT channel page and paste into JS console ****
    /*
    for (var arrScripts = document.getElementsByTagName('script'), i = 0; i < arrScripts.length; i++) {
        if (arrScripts[i].textContent.indexOf('externalId') != -1) {
            var channelId = arrScripts[i].textContent.match(/\"externalId\"\s*\:\s*\"(.*?)\"/)[1];
            var channelRss = 'https://www.youtube.com/feeds/videos.xml?channel_id=' + channelId;
            var channelTitle = document.title.match(/\(?\d*\)?\s?(.*?)\s\-\sYouTube/)[1];
            console.log('The rss feed of the channel \'' + channelTitle + '\' is:\n' + channelRss);
            break;
        }
    }
    */

    // Globals
    global $DATEFORMAT;

    // Namespaces
    /* Needs to be registered to access namespace data in RSS feeds.
    In this case, the description and thumbnail cannot be accessed
    without the 'media' namespace. Why? Idk. The 'yt' namespace
    is used for things like the video or user ID. (not using rn) */ 
    $rss->registerXPathNamespace('media', 'http://search.yahoo.com/mrss/');
    //$rss->registerXPathNamespace('yt', 'http://www.youtube.com/xml/schemas/2015');

    // Cast as string or becomes SimpleXML object
    $feed = array();

    // for($i = 0; $i < 3; $i++) { // Uncomment for multiple videos
    $i = 0;
    // Each video is an entry
    $entry  = $rss->entry[$i];

    
    /* Namespaces used here. When using xpath, it gets every
    instance of the element in the namespace. This means we don't
    have to link it to the entry, but instead can simply use the
    for-loop counter to get the matching content. */
    $author = $entry->author->name;
    $date = DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s',substr($entry->published,0,19))->format($DATEFORMAT);
    $desc =  $rss->xpath('//media:description')[$i];
    $image = $rss->xpath('//media:thumbnail')[$i]['url'];
    $link = $entry->link['href'];
    $site = 'https://www.youtube.com/';
    $source = 'YouTube';
    $title = $entry->title;

    buildReturnArray($feed, $author, $date, $desc, $image, $link, $site, $source, $title);
    // }// Uncomment for multiple videos

    return $feed;
}

// ##############################################
// ## Main Function
// ##############################################
function rss() {
    // Add RSS feeds here w/source name & url
    // TODO: Pull these from the database
    $rssFeeds = array(
        'Starsector' => array(
            'source' => 'Starsector',
            'url'    => 'https://fractalsoftworks.com/feed/',
        ),
        //"Lofi Girl"     => "https://www.youtube.com/feeds/videos.xml?channel_id=UCSJ4gkVC6NrvII8umztf0Ow",
        'Spyfall' => array(
            'source' => 'YouTube',
            'url'    => 'https://www.youtube.com/feeds/videos.xml?channel_id=UC2VARtDSExy9pY4WvTJKo1g',
        ),
        'Ultiworld' => array(
            'source' => 'Ultiworld',
            'url'    => 'https://ultiworld.com/feed/'
        ),
    );
    $feed = array();
    foreach($rssFeeds as $title => $details) {
        $source = $details['source'];
        $url    = $details['url'];

        $rss = new SimpleXMLElement(getRss($url));
        switch ($source) {
            case 'Starsector':
                $feed = array_merge($feed, rssStarsector($rss));
                break;
            case 'YouTube':
                $feed = array_merge($feed, rssYouTube($rss));
                break;
            case 'Ultiworld':
                $feed = array_merge($feed, rssUltiworld($rss));
                break;
            default:    // TODO: Mess with this → create an issue or something
                break;
                // function buildReturnArray(&$array, $author, $date, $desc, $image, $link, $site, $source, $title)
                // $feed = array_merge($feed,
                //     array(
                //         'author'    => (string) 'Seakeal',
                //         'date'      => (string) $date,
                //         'desc'      => (string) $desc,
                //         'image'     => (string) $image,
                //         'link'      => (string) $link,
                //         'site'      => (string) $site,
                //         'source'    => (string) $source,
                //         'title'     => (string) $title,
                //     )
                // );
                //$feed[$from] = array("date"=>new DateTimeImmutable('1/1/1900'), "htmlString"=>"Create a case for ".$feed);
        }
    }
    
    /* This puts everything in date-order (desc) so that the
    front-end does not have to sort the data. */
    usort($feed, "dateSort");
    // Output
    /* JSON format:
        {
            author: Author of content,
            date: Date content was published,
            desc: Content description,
            image: Thumbnail for content,
            link: Link to content,
            site: Link to site,
            source: Content source page,
            title: Title of content,
        }
    */
    echo json_encode($feed);
}

// #*#*#* Entry point *#*#*#
rss();

// TODO: Run each feed in parallel and sort the completed array

?>