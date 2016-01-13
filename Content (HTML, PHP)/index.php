<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="gameStyle.css" media="screen" />
        <title>gameInterface</title>
    </head>
    <body>
        <div class="centerStyle">
            <div class="insertGameStyle">
                <form action ="insertGame.php" method="GET">
                    <p>
                        <input type ="submit" value ="Add a Game"/>
                    </p> 
                </form>
            </div>
            <div class="showGamesStyle">
                <form action ="showGames.php" method="GET">
                    <p>
                        <input type ="submit" value ="Show Games"/>
                    </p> 
                </form>
            </div>
            <div class="returnGameStyle">
                <form action ="returnGame.php" method="GET">
                    <p>
                        <label>Enter Game Name</label>
                        <input type ='text' name ="searchName" required ="true" title ="Must enter a game name"/>
                    </p>
                    <p>
                        <label>Enter Platform</label>
                        <input type ='text' name ="searchPlatform" required ="true" title ="Must enter a platform"/>
                    </p>
                    <p>
                        <input type ="submit" value ="Search"/>
                    </p> 
                </form>
            </div>
            <div class="insertCover">
                <form action ="insertCover.php" method="POST" enctype="multipart/form-data">
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
        </div>
    </body>
</html>
