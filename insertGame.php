<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/gameStyle.css" media="screen" />
        <title>insertGame</title>
    </head>
    <body>
        <div class="insertGamePage">
            <form action ="PHP/insertScript.php" method="GET">
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
                </p>
                <p>
                    <input type ="submit" value ="Add"/>
                </p> 
            </form>
            <form action ="index.php" method="GET">
                <p>
                    <input type ="submit" value ="Home"/>
                </p> 
            </form>
        </div>
    </body>
</html>

