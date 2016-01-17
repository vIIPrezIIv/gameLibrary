<?php

    if (isset($_GET["gameName"]) && isset($_GET["platform"]))
    {
        $host = "localhost";
        $user = "root";
        $password = "";
        $database = "GameLibrary";
        $connection = mysqli_connect($host, $user, $password, $database) or die("Cannot Connect");
        
        $gameName = $_GET["gameName"];
        $platform = $_GET["platform"];
        
        $result = mysqli_prepare($connection, "CALL removeGame (?, ?)");
        mysqli_stmt_bind_param($result, 'ss', $gameName, $platform);
        
        mysqli_stmt_execute($result) or die("Insert Query Failed");
        mysqli_stmt_close($result);
        
        mysqli_close($connection);
    }
    else
    {
        echo "Not All Fields Where Filled";
    }
    
    header ("Location: removePage.php");
?>

