<!--<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="gameStyle.css" media="screen" />
        <title>insertGame</title>
    </head>
    <body>
        <div class="insertGamePage">
            <form action ="insertScript.php" method="POST" enctype="multipart/form-data">
                <p>
                    <label>Game Name</label>
                    <input type ='text' name ="gameName" required ="true" title ="Must enter a game name"/>
                </p>
                <p>
                    <label>Release Date (2001-01-01)</label>
                    <input type ='text' name ="releaseDate" required ="true" title ="Must enter a valid date: (2001-01-01)" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])"/>
                </p>
                <p>
                    <label>Platform (Xbox 360, PS3, etc...)</label>
                    <input type ='text' name ="platform" required ="true" title ="Must enter a platform"/>
                </p>
                <p>
                    <label>Edition (Special Edition, Collectors Edition, Deluxe Edition, Standard Edition)</label>
                    <input type ='text' name ="edition" required ="true" title ="Must enter a proper edition"/>
                </p>-->
                <!--<p>
                    <label>Game Name</label>
                    <input type ='text' name ="gameCoverName" required ="true" title ="Must enter a game name for cover"/>
                </p>-->
                <!--<p>
                    <input type="hidden" name ="MAX_FILE_SIZE" value="2000000">
                    <input name="userfile" type ="file"> 
                    <input name="upload" type ="submit" value="Add">
                </p>-->       
                <!--<p>
                    <input type ="submit" value ="Add"/>
                </p>-->
            <!--</form>
            <form action ="index.php" method="GET">
                <p>
                    <input type ="submit" value ="Home"/>
                </p> 
            </form>
        </div>
    </body>
</html>-->
            
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/gameStyle.css" media="screen" />
        <title>insertGame</title>
    </head>
    <body>
		<div class='pageHeader'>
			Game Library
		</div>
		<div id='navBar'>
			<div id='btnContainer'>
				<div class='menuBtn'><a href='index.php' class='menuSel'>Home</a></div>
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
			<div class="insertGamePage">
				<h2> Adding Game to Database </h2>
				<form action ="PHP/insertScript.php" method="POST" enctype="multipart/form-data">
					<p>
						<label>Game Name</label>
						<input type ='text' name ="gameName" required ="true" title ="Must enter a game name"/>
					</p>
					<p>
						<label>Release Date (2001-01-01)</label>
						<input type ='text' name ="releaseDate" required ="true" title ="Must enter a valid date: (2001-01-01)" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])"/>
					</p>
					<p>
						<label>Platform (Xbox 360, PS3, etc...)</label>
						<input type ='text' name ="platform" required ="true" title ="Must enter a platform"/>
					</p>
					<p>
						<label>Edition* </label>
						<input type ='text' name ="edition" required ="true" title ="Must enter a proper edition"/>
					</p>
                                        <p>
                                                <input type="hidden" name ="MAX_FILE_SIZE" value="2000000">
                                                <input name="userfile" type ="file"> 
                                                <!--<input name="upload" type ="submit" value="Add">-->
                                        </p>
					<p>
						<input type ="submit" name="upload" class="largeSubmit" value ="Add"/>
					</p>
					<code>* (Special Edition, Collectors Edition, Deluxe Edition, Standard Edition)</code>
				</form>
			</div>
		</div>
    </body>
</html>



