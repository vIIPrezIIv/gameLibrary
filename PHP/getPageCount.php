<?php
		
	INCLUDE_ONCE 'sql_cls.php';
	$sql = new sql_cls;
	
	$where = array();
	$w = "";
	FOREACH($_POST["Search_restrictions"] AS $key => $val){
		IF($key == "Platform")
			IF($val != "NA")
				ARRAY_PUSH($where, " b.consolePcName = '".$val."' ");
	}
	IF(!EMPTY($where)){
		$w = "WHERE ";
		FOREACH($where AS $val)
			$w.=$val;
	}
	
	$result = $sql->query(
	"
		SELECT count(l.gameName) AS 'Game Count'
		FROM gameName l
		INNER JOIN consolePc b
		ON l.gameId = b.gameId
		$w
	");

	IF($result != NULL && $result->num_rows > 0)
		WHILE($row = mysqli_fetch_assoc($result))
			ECHO ceil(intval($row["Game Count"]) / 10 );
?>