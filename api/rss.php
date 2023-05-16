<?php

// Glocal Constants
$DATEFORMAT = 'Y m d h i s';
$ICON_DIR = 'img/rss/';

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
    global $DATEFORMAT, $ICON_DIR;
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
    $image = $ICON_DIR.'starsector.png';
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
    global $DATEFORMAT, $ICON_DIR;
    // Namespaces
    $rss->registerXPathNamespace('dc','http://purl.org/dc/elements/1.1/'); // Gets article author (not working)

    // Implemented to find only first article
    $article = $rss->channel->item[0];

    $author = $rss->xpath('//dc:creator')[0];
    $date = DateTimeImmutable::createFromFormat('D, d M Y H:i:s', substr($article->pubDate,0,25))->format($DATEFORMAT);
    $desc = $article->description;
    $image = $ICON_DIR.'ultiworld.png';
    $link = $article->link;
    $site = $rss->channel->link;
    $source = 'Ultiworld';
    $title = $article->title;

    $feed = array();
    buildReturnArray($feed, $author, $date, $desc, $image, $link, $site, $source, $title);

    return $feed;
}

function rssYouTube($rss, $name) : array {
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
    global $DATEFORMAT, $ICON_DIR;

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
    // $image = $rss->xpath('//media:thumbnail')[$i]['url'];
    $image = $ICON_DIR.$name.'.png';
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
    // TODO: Pull RSS sources from the database
    $rssFeeds = array(
        'bill-wurtz' => array(
            'source' => 'YouTube',
            'url'    => 'https://www.youtube.com/feeds/videos.xml?channel_id=UCq6aw03lNILzV96UvEAASfQ',
        ),
        'CGP-Grey' => array(
            'source' => 'YouTube',
            'url'    => 'https://www.youtube.com/feeds/videos.xml?channel_id=UC2C_jShtL725hvbm1arSV9w',
        ),
        'FUNKe' => array(
            'source' => 'YouTube',
            'url'    => 'https://www.youtube.com/feeds/videos.xml?channel_id=UCd-qVRcjoK9zjtDs_LRxSmw',
        ),
        'hyper' => array(
            'source' => 'YouTube',
            'url'    => 'https://www.youtube.com/feeds/videos.xml?channel_id=UCSezUnbvCLYBXuUlPcXU_QQ',
        ),
        'Jacob-Geller' => array(
            'source' => 'YouTube',
            'url'    => 'https://www.youtube.com/feeds/videos.xml?channel_id=UCeTfBygNb1TahcNpZyELO8g',
        ),
        'LazyPurple' => array(
            'source' => 'YouTube',
            'url'    => 'https://www.youtube.com/feeds/videos.xml?channel_id=UCdfj8hli-xBL93bfQvce88A',
        ),
        'Maple' => array(
            'source' => 'YouTube',
            'url'    => 'https://www.youtube.com/feeds/videos.xml?channel_id=UCcc1uP_6GbarYjoHcMMpBBQ',
        ),
        'Rhystic-Studies' => array(
            'source' => 'YouTube',
            'url'    => 'https://www.youtube.com/feeds/videos.xml?channel_id=UC8e0Sg8TmRRFJytjEGhmVTg',
        ),
        'Seer' => array(
            'source' => 'YouTube',
            'url'    => 'https://www.youtube.com/feeds/videos.xml?channel_id=UCKbthQFolJxlUIYOa9bsKXg',
        ),
        'Sir-Swag' => array(
            'source' => 'YouTube',
            'url'    => 'https://www.youtube.com/feeds/videos.xml?channel_id=UCJy232tY_LUd1NuBgsSNUEA',
        ),
        'Sir-Swag-Academy' => array(
            'source' => 'YouTube',
            'url'    => 'https://www.youtube.com/feeds/videos.xml?channel_id=UCN6lBBO-sn2mRyjWRCz0Qtg',
        ),
        'Sirky' => array(
            'source' => 'YouTube',
            'url'    => 'https://www.youtube.com/feeds/videos.xml?channel_id=UCNsnWOqvrEAPHDcNOY_jw7A',
        ),
        'SsethTzeentach' => array(
            'source' => 'YouTube',
            'url'    => 'https://www.youtube.com/feeds/videos.xml?channel_id=UCD6VugMZKRhSyzWEWA9W2fg',
        ),
        'Starsector' => array(
            'source' => 'Starsector',
            'url'    => 'https://fractalsoftworks.com/feed/',
        ),
        'Spyfall' => array(
            'source' => 'YouTube',
            'url'    => 'https://www.youtube.com/feeds/videos.xml?channel_id=UC2VARtDSExy9pY4WvTJKo1g',
        ),
        'teamfortress' => array(
            'source' => 'YouTube',
            'url'    => 'https://www.youtube.com/feeds/videos.xml?channel_id=UC5BTcArAnit9p5W7etFsPsA',
        ),
        'Terry-Cavanagh' => array(
            'source' => 'YouTube',
            'url'    => 'https://www.youtube.com/feeds/videos.xml?channel_id=UCniC5xZ_MedWwSDV9bPCxvg',
        ),
        'Ultiworld' => array(
            'source' => 'Ultiworld',
            'url'    => 'https://ultiworld.com/feed/'
        ),
        'Uncle-Dane' => array(
            'source' => 'YouTube',
            'url'    => 'https://www.youtube.com/feeds/videos.xml?channel_id=UCu0PSyLD5p_J5osLk5UD0pw',
        ),
        'vewn' => array(
            'source' => 'YouTube',
            'url'    => 'https://www.youtube.com/feeds/videos.xml?channel_id=UCd0zIZlbgvEifm_hd3FwlBQ',
        ),

        // TODO: Add TF2 website RSS feed
        // TODO: Add Terry Cavanagh's blog RSS feed
        // TODO: Add Worthikids YouTube RSS feed

        // Template
        // 'name' => array(
        //     'source' => '',
        //     'url'    => '',
        // ),

    );
    $feed = array();
    foreach($rssFeeds as $name => $details) {
        $source = $details['source'];
        $url    = $details['url'];

        $rss = new SimpleXMLElement(getRss($url));
        switch ($source) {
            case 'Starsector':
                $feed = array_merge($feed, rssStarsector($rss));
                break;
            case 'YouTube':
                $feed = array_merge($feed, rssYouTube($rss, $name));
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