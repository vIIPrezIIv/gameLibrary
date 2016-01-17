<?php

	CLASS sql_cls{
		
		PROTECTED $host = "localhost";
		PROTECTED $userName = "root";
		PROTECTED $password = "";
		PROTECTED $database = "GameLibrary";
		PROTECTED $conn;
		
		PRIVATE FUNCTION connect(){
			$this->conn = MYSQLI_CONNECT($this->host, $this->userName, $this->password, $this->database) OR DIE("Cannot Connect");
		}
		
		PRIVATE FUNCTION disconnect(){
			MYSQLI_CLOSE($this->conn);
		}
		
		FUNCTION UPDATE( $tbl , $feild , $value , $where){
			$query = 
			"UPDATE ".$tbl." SET ".$feild." = '".$value."' WHERE ".$where;
			$this->query($query);
		}
		
		FUNCTION query( $query ){
			$this->connect();
			$result = MYSQLI_QUERY($this->conn, $query) ;//or die("Query For Table Failed");
			$this->disconnect();
			RETURN $result;
		}
		
		FUNCTION getUserName( $id ){
			$data = mysqli_fetch_assoc($this->query( "SELECT firstName , lastName FROM users WHERE userID = ".$id ));
			RETURN ARRAY( "FirstName" => $data["firstName"] , "LastName" => $data["lastName"]);
		}
		
		FUNCTION getUserPrivilage( $id ){
			$data = mysqli_fetch_assoc($this->query( "SELECT permission FROM users WHERE userID = ".$id ));
			return $data["permission"];
		}
		
		FUNCTION loginCheck( $userName , $password){
			$results = $this->query("
				SELECT 	userID
					FROM 	
						users
				WHERE 
					userName = '".$userName."' 
						OR email = '".$userName."'
					AND 
						password = '".$this->encrypt($password)."'
			");
			
			RETURN ARRAY( "Access" => BOOLVAL($results->num_rows) , "Info" => mysqli_fetch_assoc($results)["userID"]);
		}
		PROTECTED FUNCTION encrypt( $text){
			$cryptKey  = 'rTGsEReERsADqqW';
			$qEncoded = BASE64_ENCODE( MCRYPT_ENCRYPT( MCRYPT_RIJNDAEL_256, MD5( $cryptKey ), $text, MCRYPT_MODE_CBC, MD5( MD5( $cryptKey ) ) ) );
			RETURN( $qEncoded );
		}
	}
?>