# Seakeal's Startpage

This is what my page looks like.
![Image not found](img/example.png)

Wizard drawn by Richey Beckett
TODO LIST:
- api/rss.php
	- Pull these from the database
	- Mess with this → create an issue or something
	- Run each feed in parallel and sort the completed array
	- Upgrade into module
- pages/archive.php
	- Implement a better random query https://mariadb.com/kb/en/data-sampling-techniques-for-efficiently-finding-a-random-row/
	- Uncomment, only commented out for offline testing
	- Implement check for image vs video
	- Get meme ID from URL and add a landing page
- src/background.js
	- This may be a memory leak, try without redeclaring
- src/contentBox.js
	- Think about moving this to style.css
	- Figure out a good way to open and close the box
- src/rss.js
	- Remove
	- Remove
	- Make modal for description
