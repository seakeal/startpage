<?php

function buildBookmarks($bookmarks) {
    $htmlString = '';
    foreach($bookmarks as $page => $details) {
    $htmlString .= '<div class="bookmarkItem">'
        ."<a href=\"{$details['Link']}\" class=\"bookmark\" target=\"_blank\" id=\"{$page}-link\"><img src=\"{$details['Icon']}\"></a>"
        .'</div>';
    }
    return $htmlString;
}

// TODO: Consider removing buildFlexBookmarks from code
function buildFlexBookmarks($bookmarks) {
    $htmlString = '';
    foreach($bookmarks as $page => $details) {
        $htmlString .= "<a href=\"{$details['Link']}\" class=\"bookmark\" target=\"_blank\" id=\"{$page}-link\"><img src=\"{$details['Icon']}\"></a>";
    }
    return $htmlString;
}

// Begin
$iconPath = 'img/color_icons';

$bookmarks = array(
    'GitHub'    => array(
        'Link'  => 'https://github.com/seakeal',
        'Icon'  => "{$iconPath}/GitHub.svg",
    ),
    // 'League'    => array(
    //     'Link'  => 'https://docs.google.com/spreadsheets/d/1LZ1Ei7oE2Wggxtu5299ftUHgQdg1J6st1ImZrHeyEXk/edit#gid=718441427',
    //     'Icon'  => "{$iconPath}/Stats.svg",
    // ),
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
    // 'Memes'     => array(
    //     'Link'  => '#',
    //     'Icon'  => "{$iconPath}/pepe2.png",
    // ),
    'GroupMe'   => array(
        'Link'  => 'https://groupme.com/en-US/',
        'Icon'  => "{$iconPath}/GroupMe.svg",
    ),
    'Slack'      => array(
        'Link'  => 'https://slack.com/',
        'Icon'  => "{$iconPath}/Slack.svg",
    ),
    'ChatGPT'      => array(
        'Link'  => 'https://chat.openai.com/',
        'Icon'  => "{$iconPath}/OpenAI.svg",
    ),
    // Template
    // 'Name'      => array(
    //     'Link'  => '',
    //     'Icon'  => "{$iconPath}/",
    // ),
);

echo "<div id=\"bookmarks\" class=\"bookmarks\">".
    buildBookmarks($bookmarks).
"</div>"

?>