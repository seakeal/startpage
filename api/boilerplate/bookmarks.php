<?php

function buildBookmarks($bookmarks) {
    $htmlString = '';
    foreach($bookmarks as $page => $link) {
        $htmlString .= "<li><a href=\"{$link}\" class=\"bookmark\" target=\"_blank\">{$page}</a></li>";
    }
    return $htmlString;
}

$bookmarks = array(
    'GitHub'    => 'https://github.com/seakeal',
    'League'    => 'https://docs.google.com/spreadsheets/d/1LZ1Ei7oE2Wggxtu5299ftUHgQdg1J6st1ImZrHeyEXk/edit#gid=718441427',
    'Mail'      => 'https://mail.google.com/mail/u/0',
    'Spotify'   => 'https://open.spotify.com/',
    'YouTube'   => 'https://www.youtube.com/feed/subscriptions',
);

echo "<div id=\"bookmarks\" class=\"bookmarks\">
    <ul class=\"bookmarksList\">".
    buildBookmarks($bookmarks).
    "</ul>
</div>"

?>