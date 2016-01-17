<?php
	SESSION_START();
	INCLUDE_ONCE 'php/sql_cls.php';
	$ADMIN = FALSE;
	IF (ISSET($_SESSION["User"])){
		$sql = new sql_cls;
		IF($sql->getUserPrivilage($_SESSION["User"]) == "ADMIN")
			$ADMIN = TRUE;
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/gameStyle.css" media="screen" />
        <title>gameInterface</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
		<script src="js/profile.js"></script>
    </head>
    <body>
		<div class='pageHeader'>
			Game Library
			
			<div class='login'>
				<?php
				
					ECHO "<a class='login_txt' href='login.php'>";
					IF (!ISSET($_SESSION["User"]))
						ECHO "Log In";
					ELSE
						ECHO "Log Off";
					ECHO "</a>";
					
				?>
			</div>
			<?php
				ECHO "<span class='userProfile'>";
				IF (ISSET($_SESSION["User"])){
					$name = $sql->getUserName($_SESSION["User"]);
					ECHO "<span><a class='menuBarLink' href='profile.php'> Hello ".$name["FirstName"]." ".$name["LastName"]." </a></span>";
				}
				ECHO "</span>";
			?>
			
		</div>
		<div id='navBar'>
			<div id='btnContainer'>
				
				<div class='menuBtn'><a href='showGames.php' class='menuSel'>Show Games</a></div>
				<div class='menuBtn'><a href='returnGame.php' class='menuSel'>Search Games</a></div>
				<?php
					IF($ADMIN){
						ECHO "<div class='menuBtn'><a href='insertGame.php' class='menuSel'>Add Game</a></div>";
						ECHO "<div class='menuBtn'><a href='' class='menuSel'>Edit Game</a></div>";
					}
				?>	
				
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
			<h2>Profile</h2>
			<div>
				<?php
					$columns  = 
						array ( 
							"First Name" 		=> "firstName",
							"Last Name" 		=> "lastName" ,
						);
						
					$i = 0;
					$colomn_str = "";
					foreach( $columns AS $keys => $val){
						if($i != 0)
							$colomn_str .= " ,".$val." AS '".$keys."' ";
						else
							$colomn_str .= $val." AS '".$keys."' ";
						$i++;
					}
						
					
					$data = mysqli_fetch_assoc($sql->query("
						SELECT ".$colomn_str."
						FROM users
						WHERE userID = ".$_SESSION["User"]."
					"));
					
					foreach($data AS $key => $val){
						echo "<div class='column_line'><span class='value_lbl'>".$key.":</span><span class='value_val'><span>".$val."</span><input type='checkbox'  class='editVal'/></span></div><br/>";
					}
					
				?>
			</div>
		</div>
		
    </body>
</html>
