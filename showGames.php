<?php
	SESSION_START();
	INCLUDE_ONCE 'php/sql_cls.php';
	$ADMIN = FALSE;
	IF (ISSET($_SESSION["User"])){
		$sql = new sql_cls;
		IF($sql->getUserPrivilage($_SESSION["User"]) == "ADMIN")
			$ADMIN = TRUE;
	}
	$result = $sql->query("Call selectGame()");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/gameStyle.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="css/gameSearch.css" media="screen" />
        <title>Game List</title>
		
    </head>
    <body>
		<div class='pageHeader'>
			Game Library
		</div>
		<div id='navBar'>
			<div id='btnContainer'>
				<div class='menuBtn'><a href='index.php' class='menuSel'>Home</a></div>
				<div class='menuBtn'><a href='returnGame.php' class='menuSel'>Search Games</a></div>
				<?php
					IF($ADMIN){
						ECHO "<div class='menuBtn'><a href='insertGame.php' class='menuSel'>Add Game</a></div>";
						ECHO "<div class='menuBtn'><a href='' class='menuSel'>Edit Game</a></div>";
					}
				?>	
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
			<h2> List of Games </h2>
			<?php
				echo "<table class='showTable' style + 'border:1px solid black'>";
            
				echo "<tr><th colspan = 2>Games</th></tr>";
				echo "<tr class='headings'>
						<th class='search_header'>Game Name <span>&#708;</span></th>
						<th class='search_header'>Console <span>&#708;</span></th>
					</tr><span>";
				if($result->num_rows == 0){
					echo "<tr><td>No GAMES FOUND IN DATABASE</td></tr>";
					
				}else{
					while($row = mysqli_fetch_assoc($result))
					{
						echo "<tr class='feild_find'>";               
						echo "<td class='game_name'>";
						echo $row['gameName'];
						echo "</td>";
						echo "<td class='game_platform'>";
						echo $row['consolePcName'];
						echo "</td>";
						echo "</tr>";
					}
				}
				echo "</span></table>";
			?>
		</div>
    </body>
	<footer>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
		<script src="js/results.js"></script>
	</footer>
</html>
