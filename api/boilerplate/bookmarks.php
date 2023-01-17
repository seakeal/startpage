<?php

function buildBookmarks($bookmarks) {
    $htmlString = '<ul class="bookmarksList">';
    foreach($bookmarks as $page => $link) {
        $htmlString .= "<li><a href=\"{$link}\" class=\"bookmark\" target=\"_blank\" id=\"{$page}-link\">{$page}</a></li>";
    }
    return $htmlString.'</ul>';
}

function buildIconBookmarks($bookmarks) {
    $htmlString = '<ul class="bookmarksList">';
    foreach($bookmarks as $page => $details) {
        $htmlString .= "<li><a href=\"{$details['Link']}\" class=\"bookmark\" target=\"_blank\" id=\"{$page}-link\"><img src=\"{$details['Icon']}\"></a></li>";
    }
    return $htmlString.'</ul>';
}

function buildFlexBookmarks($bookmarks) {
    $htmlString = '';
    foreach($bookmarks as $page => $details) {
        $htmlString .= "<a href=\"{$details['Link']}\" class=\"bookmark\" target=\"_blank\" id=\"{$page}-link\"><img src=\"{$details['Icon']}\"></a>";
    }
    return $htmlString;
}

$iconPath = 'img/color_icons';

$bookmarks = array(
    'GitHub'    => array(
        'Link'  => 'https://github.com/seakeal',
        'Icon'  => "{$iconPath}/GitHub.svg",
    ),
    'League'    => array(
        'Link'  => 'https://docs.google.com/spreadsheets/d/1LZ1Ei7oE2Wggxtu5299ftUHgQdg1J6st1ImZrHeyEXk/edit#gid=718441427',
        'Icon'  => "{$iconPath}/Stats.svg",
    ),
    'Mail'      => array(
        'Link'  => 'https://mail.google.com/mail/u/0',
        'Icon'  => "{$iconPath}/Mailbox.svg",
    ),
    'Spotify'   => array(
        'Link'  => 'https://open.spotify.com/',
        'Icon'  => "{$iconPath}/Spotify.svg",
    ),
    'YouTube'   => array(
        'Link'  => 'https://www.youtube.com/feed/subscriptions',
        'Icon'  => "{$iconPath}/YouTube-Button.svg",
    ),
    'RSS'       => array(
        'Link'  => '#',
        'Icon'  => "{$iconPath}/RSS-Flat.svg",
    ),
    'Memes'     => array(
        'Link'  => '#',
        'Icon'  => "{$iconPath}/pepe2.png",
    ),
);

echo "<div id=\"bookmarks\" class=\"bookmarks\">".
    // buildBookmarks($bookmarks).
    buildFlexBookmarks($bookmarks).
"</div>"

?>