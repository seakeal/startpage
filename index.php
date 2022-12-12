<?php



?>

<head>
<meta charset="utf-8" />
    <meta name="description" content="A startpage designed to fit my aesthetic and be friendly for evening use. This version is for my work computer at IU." />
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no" />
    <link rel="manifest" href="%PUBLIC_URL%/manifest.json" />
    <link href="https://fonts.iu.edu/style.css?family=BentonSans:regular,bold|BentonSansCond:regular|GeorgiaPro:regular" media="screen" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="icon" type="image/x-icon" href="img/favicon.ico" />
    <title>Start Page</title>
    <script type="text/javascript" src="src/clock.js"></script>
    <script type="text/javascript" src="src/rss.js"></script>
    <!-- <script type="text/javascript" src="src/background.js"></script> -->
</head>
<body>
    <div id="bgContainer" class="bgContainer">
        <img src="img/iu_seal.png" alt="IU seal not found" id="watermark">
        <!-- <canvas id="bgCanvas">
            error: your browser does not support the canvas element
        </canvas> -->
    </div>
    <div id="mainContainer" class="mainContainer">
        <div class="time" id="time">
            error: clock function broken
        </div>
        <!-- <div class="content" id="leftBar" style="width:89px; height:299px;"><img class="penguin" id="left-penguin" src="img/iu.png" alt="penguin not found"></div> -->
        <div class="content" id="mainBar">
            <div class="welcomeMsg" id="welcomeMsg">
                <p>Welcome Nic</p>
            </div>
            <div class="bookmarks" id="bookmarks">
                <ul class="bookmarksList" id="bm1" >
                    <li><a href="https://uisapp2.iu.edu/jira-prd/secure/Dashboard.jspa?selectPageId=54021" class="clink" target="_blank">JIRA</a></li>
                    <li><a href="https://one.iu.edu/" class="clink" target="_blank">One.IU</a></li>
                    <li><a href="https://github.com/seakeal" class="clink" target="_blank">GitHub</a></li>
                    <li><a href="https://www.google.com/maps/" class="clink" target="_blank">Maps</a></li>
                </ul>
                <ul class="bookmarksList" id="bm2">
                    <li><a href="https://vaa.iu.edu/application/SIS/index.php" class="clink" target="_blank">VAA Launch Pad</a></li>
                    <li><a href="https://vaa.iu.edu/peoplesoft/serverlist.php" class="clink" target="_blank">PS Servers</a></li>
                    <li><a href="https://es-prod-doc.uits.indiana.edu/dav/sisself/sisedocs/SISJavaLauncher.html" class="clink" target="_blank">Java Launcher</a></li>
                    <li><a href="https://iudcops-fireform.eas.iu.edu/online/form/authen/jcrlite" class="clink" target="_blank">PRD Paperwork</a></li>
                </ul>
                <ul class="bookmarksList" id="bm3">
                    <li><a href="https://uisapp2.iu.edu/confluence-prd/display/ESS/Enterprise+Student+Systems+Home" class="clink" target="_blank">Confluence</a></li>
                    <li><a href="https://uisapp2.iu.edu/confluence-prd/pages/viewpage.action?spaceKey=BRTE&title=Commands" class="clink" target="_blank">BRTE Docs</a></li>
                    <li><a href="https://kb.iu.edu/" class="clink" target="_blank">Knowledge Base</a></li>
                    <li><a href="https://docs.oracle.com/cd/F52213_01/pt859pbr3/eng/pt/index.html" class="clink" target="_blank">PeopleBooks</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div id="rssContainer" class="rssContainer">
        <!-- JavaScript updates this section  -->
    </div>
</body>
</html>