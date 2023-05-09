<?php 
    // TODO: Implement a better random query https://mariadb.com/kb/en/data-sampling-techniques-for-efficiently-finding-a-random-row/
    // TODO: Uncomment, only commented out for offline testing
    // include('api/database.php');
    // $result = $mysqli->query("SELECT * FROM memes ORDER BY RAND()");
    // $obj    = $result->fetch_object();

    // TODO: Implement check for image vs video
    // TODO: Get meme ID from URL and add a landing page

    // Test

    class testImg {
        public $filename;
        public $meme_name;
    }
    $obj = new testImg();
    $obj->filename = "starsector-domain.webp";
    $obj->meme_name = "Test";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        foreach($_POST as $key => $value) {
            // Sanitize input

            // Insert into tags table
            // $sql = "IF NOT EXISTS (
            //     SELECT ID FROM tags t
            //     WHERE t.tagName=$value
            // )
            // BEGIN 
            //     INSERT INTO tags ($id, $value, 1)
            // END";
            // $result = $mysqli->query($sql);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="description" content="A startpage designed to fit my aesthetic and be friendly for evening use." />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="manifest" href="%PUBLIC_URL%/manifest.json" />
    <!-- <link rel="stylesheet" type="text/css" href="style.css" /> -->
    <link rel="stylesheet" type="text/css" href="../styles/simple.css" />
    <title>Archive</title>
    <script type="text/javascript" src="../src/memes.js"></script>
    <!-- <script type="text/javascript" src="src/clock.js"></script> -->
    <!-- <script type="text/javascript" src="src/background.js"></script> -->
    <!-- <script type="text/javascript" src="src/rss.js"></script> -->
</head>
<body>
    <div id="mainContainer" class="mainContainer">
        <div id="memeContainer" class="memeArchive">
            <div id="memeNav" class="memeNav">
                <div id="prev" class="memeNavBtn">←</div>
                <div id="rand" class="memeNavBtn">?</div>
                <div id="next" class="memeNavBtn">→</div>
            </div>
            <h1><?php echo $obj->meme_name; ?></h1>
            <img src="../img/rss/<?php echo $obj->filename; ?>" alt="Image not found" name="memeImage" id="memeImage">
        </div>
        <button id="addTagBox" onclick="addTagBox()">+ Add Tag</button>
        <form action="http://localhost/upgrade-to-server/pages/archive.php" method="post" id="memeAddTags">
            <div id="tagList">
                <input type="text" name="newTag0" id="newTag0" class="memeTag">
            </div>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>