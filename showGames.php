<?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "GameLibrary";
    $connection = mysqli_connect($host, $user, $password, $database) or die("Cannot Connect");
    
    $query = "Call selectGame()";
    $result = mysqli_query($connection, $query) or die("Query For Table Failed");
?>
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
			<h2> List of Games </h2>
			<?php
				echo "<table class='showTable' style + 'border:1px solid black'>";
            
				echo "<th colspan = 2>Games</th>";
				if($result->num_rows == 0){
					echo "<tr><td>No GAMES FOUND IN DATABASE</td></tr>";
					
				}else{
					while($row = mysqli_fetch_assoc($result))
					{
						echo "<tr>";               
						echo "<td>";
						echo $row['gameName'];
						echo "</td>";
						echo "<td>";
						echo $row['consolePcName'];
						echo "</td>";
						echo "</tr>";
					}
				}
				echo "</table>";
			?>
		</div>
    </body>
</html>
<?PHP
    mysqli_close($connection);
?>
