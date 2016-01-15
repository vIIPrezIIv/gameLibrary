<?php
    //Original
    /*if (isset($_GET["gameName"]) && isset($_GET["releaseDate"]) && isset($_GET["platform"]) && isset($_GET["edition"]))
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
    
    header ("Location: insertGame.php");*/
	
	if (isset($_POST["gameName"]) && isset($_POST["releaseDate"]) && isset($_POST["platform"]) && isset($_POST["edition"]) && isset($_POST['upload']) && $_FILES['userfile']['size'] > 0)
    {
        $host = "localhost";
        $user = "root";
        $password = "";
        $database = "GameLibrary";
        $connection = mysqli_connect($host, $user, $password, $database) or die("Cannot Connect");
        
        $gameName = $_POST["gameName"];
        $releaseDate = $_POST["releaseDate"];
        $platform = $_POST["platform"];
        $edition = $_POST["edition"];
        
        $result = mysqli_prepare($connection, "CALL insertGame (?, ?, ?, ?)");
        mysqli_stmt_bind_param($result, 'ssss', $gameName, $releaseDate, $platform, $edition);
        
        mysqli_stmt_execute($result) or die("Insert Query Failed");
        mysqli_stmt_close($result);
        
        $insert = mysqli_prepare($connection, "INSERT INTO gameCover VALUES (?, (SELECT gameId FROM gameName WHERE gameName = ?), ?, ?, ?, ?)");
    
        mysqli_stmt_bind_param($insert, 'isssis', $id, $gameName, $fileName, $fileType, $fileSize, $tmpName);
        
        $id = NULL;
        $tmpName = addslashes($_FILES['userfile']['tmp_name']);
        $fileName = addslashes($_FILES['userfile']['name']);
        $tmpName = file_get_contents($tmpName);
        $tmpName = base64_encode($tmpName);
        $fileSize = $_FILES['userfile']['size'];
        $fileType = $_FILES['userfile']['type'];
        
        mysqli_stmt_execute($insert) or die("Image Insert Failed");
        mysqli_stmt_close($insert);
       
    }
    else
    {
        echo "Not All Fields Where Filled";
    }
    
    mysqli_close($connection);
    
    header ("Location: insertGame.php");
?>

