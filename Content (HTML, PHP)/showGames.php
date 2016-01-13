<?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "GameLibrary";
    $connection = mysqli_connect($host, $user, $password, $database) or die("Cannot Connect");
    
    $query = "Call selectGame()";
    $result = mysqli_query($connection, $query) or die("Query For Table Failed");
    
    echo "<table class='showTable' style + 'border:1px solid black'>";
            
    echo "<th colspan = 2>Games</th>";
           
        while($row = mysqli_fetch_assoc($result))
        {
            echo "<tr>";
               
                echo "<td style = 'border:1px solid black'>";
                echo $row['gameName'];
                echo "</td>";
                echo "<td style = 'border:1px solid black'>";
                echo $row['consolePcName'];
                echo "</td>";
               
            echo "</tr>";
        }
        
    echo "</table>";
    
    mysqli_close($connection);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="gameStyle.css" media="screen" />
        <title>insertGame</title>
    </head>
    <body>
         <form action ="index.php" method="GET">
            <p class="showHome">
                <input type ="submit" value ="Home"/>
            </p> 
        </form>
    </body>
</html>
