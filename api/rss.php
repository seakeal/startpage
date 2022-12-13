<?php

// Constants
$dateFormat = 'Y m d h i s';

// ##############################################
// ## Utility functions
// ##############################################

// Consistent format for the RSS arrays returned to the main feed
function buildReturnArray(&$array, $source, $title, $link, $date, $html) {
    $array[] = array("source"=>$source, "title"=>$title, "link"=>$link, "date"=>$date, "html"=>$html);
}

// Callback to sort feed by date
function dateSort($a, $b) : int {
    if ($a["date"] == $b["date"])
        return 0;
    return $a["date"] > $b["date"] ? -1 : 1;
}

// Builds an <a> tag string cleanly
function htmlLink($link, $text="", $class="", $id="") : string {
    $htmlString = '<a ';

    if ($class <> "")
        $htmlString .= 'class="'.$class.'" ';
    if ($id <> "")
        $htmlString .= 'id="'.$id.'" ';
    $htmlString .= 'href="'.$link.'" target="_blank">'.$text.'</a>';
    
    return $htmlString;
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
    // Variables
    global $dateFormat;
    $source = "Starsector";
    $link = "https://fractalsoftworks.com/";
    $dateLength = 16;

    $feed = array();

    for($i = 0; $i < 3; $i++) {
        $article = $rss->channel->item[$i];
        $pubDate = DateTimeImmutable::createFromFormat('D, d M Y H:i:s', substr($article->pubDate,0,25))->format($dateFormat);
        $htmlString  = '<div class="rss-starsector" id="starsector'.$i.'">';
        $htmlString .= '<p>'.htmlLink($article->link,$article->title).'</p>';
        $htmlString .= '<p>'.substr($article->description,0,-10).'&#8230;</p>';
        $htmlString .= '</div>';
        buildReturnArray($feed, $source, $source, $link, $pubDate, $htmlString);
    }

    return $feed;
   
}

function rssYouTube($rss) : array {
    // **** Code to find YouTube creator ID (thx Stack Overflow)****
    // **** Inspect YT channel page and paste into JS console ****
    // for (var arrScripts = document.getElementsByTagName('script'), i = 0; i < arrScripts.length; i++) {
    //     if (arrScripts[i].textContent.indexOf('externalId') != -1) {
    //         var channelId = arrScripts[i].textContent.match(/\"externalId\"\s*\:\s*\"(.*?)\"/)[1];
    //         var channelRss = 'https://www.youtube.com/feeds/videos.xml?channel_id=' + channelId;
    //         var channelTitle = document.title.match(/\(?\d*\)?\s?(.*?)\s\-\sYouTube/)[1];
    //         console.log('The rss feed of the channel \'' + channelTitle + '\' is:\n' + channelRss);
    //         break;
    //     }
    // }

    // Variables
    global $dateFormat;
    $source = "YouTube";
    $author = $rss->author;

    // Cast as string or becomes SimpleXML object
    $feed = array();

    // TODO: Fuck with HTML string
    for($i = 0; $i < 3; $i++) {
        $entry  = $rss->entry[$i];
        $pubDate = DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s',substr($entry->published,0,19))->format($dateFormat);
        $htmlString  = '<div class="rss-youtube" id="'.$author->name.$i.'">';
        $htmlString .= '<p>'.htmllink($entry->link["href"],$entry->title).'</p>';
        // $htmlString .= '<p>'.$entry->media["description"].'</p>'; // Limited by YouTube and SimpleXMLElement
        $htmlString .= "</div>";
        buildReturnArray($feed, $source, (string)$author->name, (string)$author->uri, $pubDate, $htmlString);
    }

    return $feed;
}

// ##############################################
// ## Main Function
// ##############################################
function rss() {
    // TODO: Pull this from a config file or DB query
    $rssFeeds = array(
        "HauteLeMode"           => "https://www.youtube.com/feeds/videos.xml?channel_id=UCoEj4uRzynPXEEegNqMnJVw",
        "Mike's Mic"            => "https://www.youtube.com/feeds/videos.xml?channel_id=UCuwUl4_fcRio_valO7_lxjA",
        "Tee Noir"              => "https://www.youtube.com/feeds/videos.xml?channel_id=UCaZ8Nik2OV2r7vZm8Xsi3mQ",
        "Dylan Is In Trouble"   => "https://www.youtube.com/feeds/videos.xml?channel_id=UCF_votze88WRDSEREe9s3aQ",
        "Lorry Hill"            => "https://www.youtube.com/feeds/videos.xml?channel_id=UCnClOuzfbOj3ZcUKs2GahjA",
    );    
    
    $feed = array();
    foreach($rssFeeds as $from => $url) {
        $rss = new SimpleXMLElement(getRss($url));
        $feed = array_merge($feed, rssYouTube($rss));
        // switch ($from) {
        //     case "Starsector":
        //         $feed = array_merge($feed, rssStarsector($rss));
        //         break;
        //     // YouTube channels
        //     case "HauteLeMode":
        //     case "Mike's Mic":
        //         $feed = array_merge($feed, rssYouTube($rss));
        //         break;
        //     default:    // TODO: Mess with this
        //         //$feed[$from] = array("date"=>new DateTimeImmutable('1/1/1900'), "htmlString"=>"Create a case for ".$feed);
        // }
    }
    
    usort($feed, "dateSort");
    // Output
    echo json_encode($feed);
}

// Entry point
rss();

?>