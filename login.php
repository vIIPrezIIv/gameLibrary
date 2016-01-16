<?php

	SESSION_START();
	INCLUDE_ONCE 'php/sql_cls.php';

	
	$error = FALSE;
	IF( ARRAY_KEY_EXISTS('User', $_SESSION) ){
		UNSET($_SESSION["User"]);
		HEADER( "location: index.php" );
	}ELSE IF( ARRAY_KEY_EXISTS( "userName", $_POST ) && ARRAY_KEY_EXISTS( "password" , $_POST )){
		$sql_Check = new sql_cls;
		$check = $sql_Check->loginCheck($_POST["userName"] , $_POST["password"]);
		IF($check["Access"]){
			$_SESSION["User"] = $check["Info"];
			HEADER( "location: index.php" );
		}ELSE{
			$error = TRUE;
		}		
	}
	
?>
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
		<div id="login_Container">
			<h3>Log In</h3>
			<form method="post" action="login.php">
				<p>
					<label for='userName'>User Name or Email</label><input type='text' value='<?php IF(array_key_exists('userName', $_POST)) ECHO $_POST["userName"]; ELSE ECHO "";?>' name='userName' id='userName'/><br/>
					<?php
						if(array_key_exists('userName', $_POST) && $_POST["userName"] == "")
							ECHO "<span class='error'>User Name or Email is Required</span>";
					?>
				</p>
				<p>
					<label for='password'>Password</label><input type='password' value='<?php IF(array_key_exists('password', $_POST)) ECHO $_POST["password"]; ELSE ECHO "";?>' name='password' id='password'/><br />
					<?php
						if(array_key_exists("password", $_POST) && $_POST['password'] == "")
							ECHO "<span class='error'>Password is Required</span>";
					?>
				</p>
				<input type='submit' name='login' class='largeSubmit' value='Log In'/>
				<?php
					IF($error)
						ECHO "<span class='error'><br/><br/>ERROR LOGGING <br/> Please make sure that email/UserName and Password is correct </span>";
				?>
			</form>
		</div>
		
    </body>
</html>
