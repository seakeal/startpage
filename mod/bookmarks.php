<?php

class Bookmarks {
    // Properties
    public $scripts = array(
        //'src/rss.js',
    );

    private $iconPath = 'img/bookmark_icons'; // No trailing slash
    private $bookmarks = array(
        'GitHub'    => array(
            'Link'  => 'https://github.com/seakeal',
            'Icon'  => "GitHub.svg",
        ),
        // 'League'    => array(
        //     'Link'  => 'https://docs.google.com/spreadsheets/d/1LZ1Ei7oE2Wggxtu5299ftUHgQdg1J6st1ImZrHeyEXk/edit#gid=718441427',
        //     'Icon'  => "Stats.svg",
        // ),
        'Mail'      => array(
            'Link'  => 'https://mail.google.com/mail/u/0',
            'Icon'  => "Mailbox.svg",
        ),
        'Spotify'   => array(
            'Link'  => 'https://open.spotify.com/',
            'Icon'  => "Spotify.svg",
        ),
        'YouTube'   => array(
            'Link'  => 'https://www.youtube.com/feed/subscriptions',
            'Icon'  => "YouTube-Button.svg",
        ),
        // 'RSS'       => array(
        //     'Link'  => '#',
        //     'Icon'  => "RSS-Flat.svg",
        // ),
        // 'Memes'     => array(
        //     'Link'  => '#',
        //     'Icon'  => "pepe2.png",
        // ),
        'GroupMe'   => array(
            'Link'  => 'https://groupme.com/en-US/',
            'Icon'  => "GroupMe.svg",
        ),
        'Slack'      => array(
            'Link'  => 'https://slack.com/',
            'Icon'  => "Slack.svg",
        ),
        'ChatGPT'      => array(
            'Link'  => 'https://chat.openai.com/',
            'Icon'  => "OpenAI.svg",
        ),
        // Template
        // 'Name'      => array(
        //     'Link'  => '',
        //     'Icon'  => "",
        // ),
    );

    // Methods
    function buildHtml() {
        echo "<div id=\"bookmarks\" class=\"bookmarks\">".
            $this->buildBookmarks($this->bookmarks).
            "</div>";
    }

    private function buildBookmarks($bookmarks) {
        $htmlString = '';
        foreach($this->bookmarks as $page => $details) {
        $htmlString .= '<div class="bookmarkItem">'
            ."<a href=\"{$details['Link']}\" class=\"bookmark\" target=\"_blank\" id=\"{$page}-link\"><img src=\"$this->iconPath/{$details['Icon']}\"></a>"
            .'</div>';
        }
        return $htmlString;
    }

    
}

?>
