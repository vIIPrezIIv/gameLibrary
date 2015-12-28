<?php
    
    if (isset($_GET["gameName"]) && isset($_GET["releaseDate"]) && isset($_GET["platform"]) && isset($_GET["edition"]))
    {
        $host = "localhost";
        $user = "root";
        $password = "";
        $database = "GameLibrary";
        $connection = mysqli_connect($host, $user, $password, $database) or die("Cannot Connect");
        
        $gameName = $_GET["gameName"];
        $releaseDate = $_GET["releaseDate"];
        $platform = $_GET["platform"];
        $edition = $_GET["edition"];
        
        $result = mysqli_prepare($connection, "CALL insertGame (?, ?, ?, ?)");
        mysqli_stmt_bind_param($result, 'ssss', $gameName, $releaseDate, $platform, $edition);
        
        mysqli_stmt_execute($result) or die("Insert Query Failed");
        
    }
    else
    {
        echo "Not All Fields Where Filled";
    }
    
    mysqli_close($connection);
    
    header ("Location: insertGame.php");
?>

