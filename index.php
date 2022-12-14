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
    <!-- <link rel="icon" type="image/x-icon" href="img/favicon.ico" /> -->
    <title>Start Page</title>
    <script type="text/javascript" src="src/clock.js"></script>
    <script type="text/javascript" src="src/halloweenCountdown.js"></script>
    <!-- <script type="text/javascript" src="src/rss.js"></script> -->
    <!-- <script type="text/javascript" src="src/background.js"></script> -->
</head>
<body>
    <!-- <div class="bgContainer" id="bgContainer"> -->
        <!-- <canvas id="bgCanvas">
            error: your browser does not support the canvas element
        </canvas> -->
    <!-- </div> -->
    <div class="container" id="mainContainer">
        <div class="time" id="clock">
            error: clock function broken
        </div>
        <div class="bookmarks" id="bookmarks">
            <table class="bookmarksTable" id="bookmarksTable">
                <tr>
                    <td>
                        <a href="https://www.wikipedia.org/" class="clink" target="_blank"><img class="clinkImg" id="clinkImgWikipedia" src="img/Wikipedia's_W_p.svg" alt="Wikipedia logo not found"></a>
                    </td>
                    <td>
                        <a href="https://10fastfingers.com/" class="clink" target="_blank"><img class="clinkImg" id="clinkImg10FastFingers" src="img/10fastfingers_p.png" alt="10FastFingers logo not found"></a>
                    </td>
                    <td>
                        <a href="https://www.gmail.com/" class="clink" target="_blank"><img class="clinkImg" id="clinkImgGmail" src="img/Gmail_icon_(2020)_p.svg" alt="Gmail logo not found"></a>            
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="https://smile.amazon.com/" class="clink" target="_blank"><img class="clinkImg" id="clinkImgAmazon" src="img/Amazon_icon_p.svg" alt="Amazon logo not found"></a>
                    </td>
                    <td>
                        <a href="https://www.netflix.com/" class="clink" target="_blank"><img class="clinkImg" id="clinkImgNetflix" src="img/Netflix_2015_N_logo_p.svg" alt="Netflix logo not found"></a>
                    </td>
                    <td>
                        <a href="https://www.disneyplus.com/" class="clink" target="_blank"><img class="clinkImg" id="clinkImgDisney+" src="img/Disney+_logo_p.svg" alt="Disney+ logo not found"></a>
                    </td>
                </tr> 
            </table>           
        </div>
        <div class="time" id="halloweenCd">
            error: halloween countdown function broken
        </div>
    </div>
    <!-- <div class="container" id="countdownContainer">

    </div> -->
    <!-- <div class="welcomeMsg" id="welcomeMsg">
                <p>Welcome Randy</p>
            </div> -->
    <!-- <div class="time" id="moonPhase">
        <?php include("api/moonPhases.php"); ?>
    </div> -->  
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