<?php

// Constants
//$dateFormat = 'D, d M Y';
$dateFormat = 'M d, Y';

function getRss($feed) : string {
    $ch = curl_init($feed);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $rssOut = curl_exec($ch);
    if(curl_error($ch)) {
        $rssOut = curl_error($ch);
    }
    curl_close($ch);
    
    return $rssOut;
}

function htmlLink($link, $text="", $class="", $id="") {
    $htmlString = '<a ';

    if ($class <> "")
        $htmlString .= 'class="'.$class.'" ';
    if ($id <> "")
        $htmlString .= 'id="'.$id.'" ';
    $htmlString .= 'href="'.$link.'">'.$text.'</a>';
    
    return $htmlString;
}

function rssStarsector($rss) {
    // Variables
    global $dateFormat;
    $dateLength = 16;

    $feed = array("source"=>"Starsector", "title"=>"Starsector", "link"=>"https://fractalsoftworks.com/", "feed"=>array());

    for($i = 0; $i < 3; $i++) {
        $article = $rss->channel->item[$i];
        $pubDate = DateTimeImmutable::createFromFormat('D, d M Y', substr($article->pubDate, 0, $dateLength))->format($dateFormat);
        $htmlString  = '<div class="rss-starsector" id="starsector'.$i.'">';
        $htmlString .= '<b><p>'.htmlLink($article->link,$article->title).'</p></b>';
        $htmlString .= '<p>'.substr($article->description,0,-10).'&#8230;</p>';
        $htmlString .= '</div>';
        array_push($feed["feed"], array("date"=>$pubDate, "html"=>$htmlString));
    }

    return $feed;
   
}

function rssYouTube($rss) {
    // **** Code to find YouTube creator ID ****
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
    $author = $rss->author;

    // Cast as string or becomes SimpleXML object
    $feed = array("source"=>"YouTube", "title"=>(string)$author->name, "link"=>(string)$author->uri, "feed"=>array());

    for($i = 0; $i < 3; $i++) {
        $entry  = $rss->entry[$i];
        $pubDate = DateTimeImmutable::createFromFormat('Y-m-d',substr($entry->published,0,10))->format($dateFormat);
        $htmlString  = '<div class="rss-youtube" id="'.$author->name.$i.'">';
        $htmlString .= '<b><p>'.htmllink($entry->link["href"],$entry->title).'</p></b>';
        // $htmlString .= '<p>'.$entry->media["description"].'</p>';
        $htmlString .= "</div>";
        array_push($feed["feed"], array("date"=>$pubDate, "html"=>$htmlString));
    }

    return $feed;
}

function rss() {
    $rssFeeds = array(
        "Starsector"    => "https://fractalsoftworks.com/feed/",
        //"Lofi Girl"     => "https://www.youtube.com/feeds/videos.xml?channel_id=UCSJ4gkVC6NrvII8umztf0Ow",
        "Spyfall"       => "https://www.youtube.com/feeds/videos.xml?channel_id=UC2VARtDSExy9pY4WvTJKo1g",
    );
    $feed = array();
    foreach($rssFeeds as $from => $url) {
        $rss = new SimpleXMLElement(getRss($url));
        switch ($from) {
            case "Starsector":
                array_push($feed, rssStarsector($rss));
                break;
            // YouTube channels
            case "Lofi Girl":
            case "Spyfall":
                array_push($feed, rssYouTube($rss));
                break;
            default:
                $feed[$from] = array("date"=>new DateTimeImmutable('1/1/1900'), "htmlString"=>"Create a case for ".$feed);
        }
    }
    
    //var_dump($feed);
    echo json_encode($feed);
}

// Entry point
rss();

?>