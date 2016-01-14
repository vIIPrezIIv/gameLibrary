<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/gameStyle.css" media="screen" />
        <title>gameInterface</title>
    </head>
    <body>
		<div class='pageHeader'>
			Game Library
		</div>
		<div id='navBar'>
			<div id='btnContainer'>
				<div class='menuBtn'><a href='insertGame.php' class='menuSel'>Add Game</a></div>
				<div class='menuBtn'><a href='showGames.php' class='menuSel'>Show Games</a></div>
				<div class='menuBtn'><a href='returnGame.php' class='menuSel'>Search Games</a></div>
				<div class='menuBtn'><a href='' class='menuSel'>Edit Game</a></div>
				<!--<div class='menuBtn'>Add Game Cover</div>-->
			</div>
		</div>
		
		<div id='leftCol'>
			<div class="returnGameStyle">
				<h2>Search for Game</h2>
				<form action ="returnGame.php" method="GET">
					<label for='gameName'>Enter Game Name</label>
					<input type ='text' name ="searchName" id='gameName' required ="true" title ="Must enter a game name"/><BR/>
					<label for='platformName' >Enter Platform</label>
					<input type ='text' name ="searchPlatform" id='platformName' required ="true" title ="Must enter a platform"/>
					<input type ="submit" class='largeSubmit' value ="Search"/>					
				</form>
			</div>
			<hr>
			<div class='recentlyAdded'>
				<h2>Recently Added</h2>
				<div class='recentlyAdded_rst'></div>
			</div>
		</div>
		<div id='rightCol'>
			<!--
			<div id='newFeed'>
				<h1>Game News</h1>
				<div id='newsContainer'>
				</div>
			</div>
			<div id='featuredGame'>
				<h1>Featured Game</h1>
				<hr>
				<h3 class='gameTitle'>Insert Game Name Here</h3>
				<div class='quickInfo'>
					<div class='imgHolder'>
						
					</div>
				</div>
			</div>
			-->
		</div>
		<!--
		<div class="showGamesStyle">
				
				<form action ="showGames.php" method="GET">
					<p>
						<input type ="submit" value ="Show Games"/>
					</p> 
				</form>
			</div>
		<div class="insertGameStyle">
				<form action ="insertGame.php" method="GET">
					<p>
						<input type ="submit" value ="Add a Game"/>
					</p> 
				</form>
			</div>
		
		
		<div class="insertCover">
			<form action ="PHP/insertCover.php" method="POST" enctype="multipart/form-data">
				<p>
					<label>Game Name</label>
					<input type ='text' name ="gameCoverName" required ="true" title ="Must enter a game name for cover"/>
				</p>
				<p>
					<input type="hidden" name ="MAX_FILE_SIZE" value="2000000">
					<input name="userfile" type ="file"> 
					<input name="upload" type ="submit" value="Upload">
				</p>
			</form>
		</div>
		-->
    </body>
</html>
