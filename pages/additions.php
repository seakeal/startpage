<?php

include 'boilerplate/head.php';
$head = new Head(
    'Additions',
    'An easy way to add items to the database'
);



?>

<!DOCTYPE html>
<html>
    <?php $head->buildHtml(); ?>
    <body>
        <div id="mainContainer" class="mainContainer">
            <form action="api/addBookmark.php" id="addBookmarkForm" class="addItemForm">
                <span class="addItemRow">
                    <label for="bookmarkName">New Bookmark Name</label> &nbsp;
                    <input type="text" name="bookmarkName">
                </span>
                <span class="addItemRow">
                    <label for="bookmarkUrl">URL</label> &nbsp;
                    <input type="text" name="bookmarkUrl">
                </span>
                <span class="addItemRow">
                    <label for="bookmarkIcon">Icon</label> &nbsp;
                    <input type="text" name="bookmarkIcon">
                </span>
                <input type="submit" value="Add New Bookmark" class="addItemSubmitBtn">
            </form>
            <form action="api/addRss" id="addRssForm" class="addItemForm">
                <span class="addItemRow">
                    <label for="rssName">New RSS Feed Name</label> &nbsp;
                    <input type="text" name="rssName">
                </span>
                <span class="addItemRow">
                    <label for="rssSource">Source</label> &nbsp;
                    <input type="text" name="rssSource">
                </span>
                <span class="addItemRow">
                    <label for="rssUrl">Feed URL</label> &nbsp;
                    <input type="text" name="rssUrl">
                </span>
                <span class="addItemRow">
                    <label for="rssIcon">Icon</label> &nbsp;
                    <input type="text" name="rssIcon">    
                </span>
                <input type="submit" value="Add New RSS Source" class="addItemSubmitBtn">
            </form>
        </div>
    </body>
</html>