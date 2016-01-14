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
        mysqli_stmt_execute($result) or die("Query For Game Failed");
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
    }
    else
    {
        echo "Search Field Is Empty";
    }
    
    mysqli_stmt_close($imageResult);
    mysqli_close($connection);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/gameStyle.css" media="screen" />
        <title>insertGame</title>
    </head>
    <body>
        <div class="returnHome">
            <form action ="index.php" method="GET">
                <p>
                    <input type ="submit" value ="Home"/>
                </p> 
            </form>
        </div>
    </body>
</html>

