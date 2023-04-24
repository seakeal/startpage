<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="description" content="A startpage designed to fit my aesthetic and be friendly for evening use." />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="manifest" href="%PUBLIC_URL%/manifest.json" />
    <!-- <link rel="stylesheet" type="text/css" href="style.css" /> -->
    <link rel="stylesheet" type="text/css" href="styles/style-grid.css" />
    <title>Seakeal</title>
    <!-- <script type="text/javascript" src="src/clock.js"></script> -->
    <script type="text/javascript" src="src/background.js"></script>
    <script type="text/javascript" src="src/rss.js"></script>
</head>
<body>
    <div id="mainContainer" class="mainContainer">
        <div id="mainBar" class="content">
            <h2>Welcome to the Meme Archive</h2>
            <p>Please refresh for a fresh meme</p>
            <?php 
                // TODO: Implement a better random query https://mariadb.com/kb/en/data-sampling-techniques-for-efficiently-finding-a-random-row/
                include('api/database.php');
                $result = $mysqli->query("SELECT * FROM memes ORDER BY RAND()");
                $obj    = $result->fetch_object();

                $htmlString = "<div class=\"meme\">
                    <img src=\"img/archive/{$obj->filename}\" alt=\"Failed to load meme\">
                    <br>
                    <label>{$obj->meme_name}</label>
                </div>";
                echo $htmlString;
            ?>
        </div>
    </div>
    <div id="bgContainer" class="bgContainer">
        <canvas id="bgCanvas">
            error: your browser does not support the canvas element
        </canvas>
    </div>
</body>
</html>