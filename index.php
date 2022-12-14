<?php



?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
    <meta name="description" content="A startpage designed to fit Randy's aesthetic and be friendly for evening use (maybe). This version is for my lovely girlfriend Randy." />
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no" />
    <link rel="manifest" href="%PUBLIC_URL%/manifest.json" />
    <link href="https://fonts.iu.edu/style.css?family=BentonSans:regular,bold|BentonSansCond:regular|GeorgiaPro:regular" media="screen" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="styles/spooky.css" />
    <link rel="icon" type="image/x-icon" href="img/favicon.ico" />
    <title>Start Page</title>
    <script type="text/javascript" src="src/clock.js"></script>
    <script type="text/javascript" src="src/halloweenCountdown.js"></script>
    <script type="text/javascript" src="src/rss.js"></script>
    <!-- <script type="text/javascript" src="src/background.js"></script> -->
</head>
<body>
    <div id="bgContainer" class="bgContainer">
        <!-- <canvas id="bgCanvas">
            error: your browser does not support the canvas element
        </canvas> -->
    </div>
    <div id="mainContainer" class="mainContainer">
        <div class="time" id="time">
            error: clock function broken
        </div>
        <div class="time" id="halloweenCd">
            error: halloween countdown function broken
        </div>
        <div class="time" id="moonPhase">
            <?php include("api/moonPhases.php"); ?>
        </div>
        <!-- <div class="content" id="leftBar" style="width:89px; height:299px;"><img class="penguin" id="left-penguin" src="img/iu.png" alt="penguin not found"></div> -->
        <div class="content" id="mainBar">
            <div class="welcomeMsg" id="welcomeMsg">
                <p>Welcome Randy</p>
            </div>
            <!-- 
                Wikipedia
                Gmail
                Streaming
                    Netflix
                Amazon
                Typing Website
                YouTube
                    HauteLeMode
                    Mike's Mic
                    Tee Noir
                    Dylan is in Trouble
                    Lorry
             -->
            <div class="bookmarks" id="bookmarks">
                <?php include("api/bookmarks.php"); ?>
            </div>
        </div>
    </div>
    <div id="icons">
        <div id="rssButton" class="iconButtons" onclick="toggleRss()">
            <!-- JavaScript updates this section  -->
        </div>
    </div>
    <div id="rssContainer" class="rssContainer" style="visibility: hidden;">
        <!-- JavaScript updates this section  -->
    </div>
</body>
</html>