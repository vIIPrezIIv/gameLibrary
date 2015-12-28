<?php
  
    if (isset($_POST['upload']) && $_FILES['userfile']['size'] > 0 && isset($_POST['gameCoverName']))
    {
        $host = "localhost";
        $user = "root";
        $password = "";
        $database = "GameLibrary";
        $connection = mysqli_connect($host, $user, $password, $database) or die("Cannot Connect");
        
        $gameCoverName = $_POST['gameCoverName'];
        $insert = mysqli_prepare($connection, "INSERT INTO gameCover VALUES (?, (SELECT gameId FROM gameName WHERE gameName = ?), ?, ?, ?, ?)");
    
        mysqli_stmt_bind_param($insert, 'isssis', $id, $gameCoverName, $fileName, $fileType, $fileSize, $tmpName);
        
        $id = NULL;
        $tmpName = addslashes($_FILES['userfile']['tmp_name']);
        $fileName = addslashes($_FILES['userfile']['name']);
        $tmpName = file_get_contents($tmpName);
        $tmpName = base64_encode($tmpName);
        $fileSize = $_FILES['userfile']['size'];
        $fileType = $_FILES['userfile']['type'];
      
        mysqli_stmt_execute($insert) or die("Image Insert Failed");
        mysqli_stmt_close($insert);
        mysqli_close($connection);
    }
    
    header ("Location: index.php");
?>
