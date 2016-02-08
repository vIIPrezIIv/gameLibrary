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
		SELECT l.gameName AS 'Game Name', b.consolePcName AS 'Console'
		FROM gameName l
		INNER JOIN consolePc b
		ON l.gameId = b.gameId
		$w
		ORDER BY l.".str_replace( " " , "" , $_POST["Order_By"]["Feild"])." ".$_POST["Order_By"]["Order"]."
		LIMIT ".( INTVAL($_POST["Page_Size"]) * (INTVAL($_POST["Page"]) -1) )." , ".$_POST["Page_Size"].";
		
	");
	
	IF($result != NULL && $result->num_rows > 0)
		WHILE($row = mysqli_fetch_assoc($result))
			ECHO "<tr class='feild_find'>
				<td class='game_name'>
					".$row["Game Name"]."
				</td>
				<td class='game_platform'>
					".$row["Console"]."
				</td>						
			</tr>";
			
?>