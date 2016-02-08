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
				<div class='menuBtn'><a href='insertGame.php' class='menuSel'>Add Game</a></div>
				<div class='menuBtn'><a href='showGames.php' class='menuSel'>Show Games</a></div>
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
			<h2> Search Results </h2>
			<?php
			
				if (isset($_GET["searchName"]) && isset($_GET["searchPlatform"]))
				{
					
					$host = "localhost";
					$user = "root";
					$password = "";
					$database = "GameLibrary";
					$connection = mysqli_connect($host, $user, $password, $database) or die("Cannot Connect");
				
					$gameName = $_GET["searchName"];
					$platForm = $_GET["searchPlatform"];
					
					$titles = "Date Released:  *Plaform:  *Edition:  ";
				   
					$result = mysqli_prepare($connection, "SELECT returnGame(?, ?)");
					mysqli_stmt_bind_param($result, 'ss', $gameName, $platForm);
					mysqli_stmt_execute($result);// or die("Query For Game Failed");
					mysqli_stmt_bind_result($result, $finalResult);
					
					while (mysqli_stmt_fetch($result))
					{   
						$titleResult = explode("*", $titles);
						$result2 = explode(":", $finalResult);
							
						echo "<div class='returnResult'>";
						  
							for ($ctr = 0; $ctr < 3; $ctr++)
							{  
								if (isset($result2[$ctr]))
								{
									echo "<p class='returnP'>";
									echo ($result2[$ctr] == "Game Doesn't Exist" ? "Error: " : $titleResult[$ctr]).$result2[$ctr];
									echo "</p>";
								}
							}
					}
					
					mysqli_stmt_close($result);
					
					$imageResult = mysqli_prepare($connection, "SELECT l.content FROM gameCover l INNER JOIN gameName p ON l.gameId = p.gameId WHERE p.gameName = ?");
					mysqli_stmt_bind_param($imageResult, 's', $gameName);
					mysqli_stmt_execute($imageResult) or die("Query For Image Failed");
					mysqli_stmt_bind_result($imageResult, $picture);

					while (mysqli_stmt_fetch($imageResult))       
					{
						
						echo '<img height = "200" width = "250" src="data:image;base64,'.$picture.'">';
						
					}
					echo "</div>";
					mysqli_stmt_close($imageResult);
					mysqli_close($connection);
				}
				else
				{
					echo "Search Field Is Empty";
				}
			?>
		</div>
    </body>
</html>

