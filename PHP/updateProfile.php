<?php

	SESSION_START();
	INCLUDE_ONCE 'sql_cls.php';
	
	$profile_feilds = array(
		"firstName" => "First Name:",
		"lastName"=> "Last Name:"
	);
	
	$sql = new sql_cls;
	$sql->update( "users" , array_search( $_POST["name"] , $profile_feilds) , $_POST["value"] , "userID = ".$_SESSION["User"] ) ;
	

?>
