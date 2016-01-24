USE GameLibrary;

DROP PROCEDURE IF EXISTS insertGame;
DROP PROCEDURE IF EXISTS selectGame;
DROP FUNCTION IF EXISTS returnGame;
DROP PROCEDURE IF EXISTS removeGame;

DELIMITER //

CREATE PROCEDURE insertGame(gameNameInsert VARCHAR(45), yearMade DATE, consolePcName VARCHAR(25), edition VARCHAR(20))
BEGIN

DECLARE sqlError TINYINT DEFAULT FALSE;
DECLARE validDate DATE DEFAULT '1970-01-01';

DECLARE result INT DEFAULT (SELECT l.gameId 
							FROM gameName l
							INNER JOIN consolePc k
							ON l.gameId = k.gameId
							WHERE l.gameName = gameNameInsert AND k.consolePcName = consolePcName);

DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
	SET sqlError = TRUE;

START TRANSACTION;

IF (result IS NULL) THEN

	IF (validDate < yearMade) THEN

		IF (edition = 'Collectors Edition' || edition = 'Special Edition' || edition = 'Deluxe Edition' || edition = 'Standard Edition') THEN

			INSERT INTO gameName VALUES (NULL, gameNameInsert, yearMade, CURDATE());

			INSERT INTO consolePc VALUES (NULL, LAST_INSERT_ID(), consolePcName);

			INSERT INTO special VALUES (NULL, LAST_INSERT_ID(), edition);
        
		ELSE
			SET sqlError = TRUE;
			SELECT "Edition Is Not Valid";
		END IF;

	ELSE
		SET sqlError = TRUE;
		SELECT "Date Is Not Valid (1970-01-01)";
	END IF;

ELSE
	SET sqlError = TRUE;
    SELECT "Game Is Already Added";
END IF;

IF sqlError = FALSE THEN
	COMMIT;
    SELECT "Success";
ELSE
	ROLLBACK;
    SELECT "Failed";
END IF;

END//

CREATE PROCEDURE selectGame( skip_rows INT(5) , limit_rows INT(5) )
BEGIN

SELECT l.gameName, b.consolePcName
FROM gameName l
INNER JOIN consolePc b
ON l.gameId = b.gameId
ORDER BY l.gameName ASC
LIMIT skip_rows , limit_rows;

END//

CREATE FUNCTION returnGame(gameNameInsert VARCHAR(45), platform VARCHAR(45))
RETURNS VARCHAR(65)
BEGIN

DECLARE errorMsg VARCHAR(65) DEFAULT "Game Doesn't Exist";
DECLARE successMsg VARCHAR(65) DEFAULT (SELECT CONCAT(l.releaseYear, ":", b.consolePcName, ":", c.edition)
										FROM gameName l 
										INNER JOIN consolePc b 
										ON l.gameId = b.gameId 
										INNER JOIN special c 
										ON l.gameId = c.gameId
										WHERE l.gameName = gameNameInsert
                                        AND b.consolePcName = platform);
                                        
DECLARE result INT DEFAULT (SELECT l.gameId 
							FROM gameName l
							INNER JOIN consolePc k
							ON l.gameId = k.gameId
							WHERE l.gameName = gameNameInsert AND k.consolePcName = platform);

IF (result IS NULL) THEN
	
    RETURN errorMsg;
    
ELSE
    
    RETURN successMsg;
    
END IF;

END//

CREATE PROCEDURE removeGame(gameNameRemove VARCHAR(45), platform VARCHAR(45))
BEGIN

DECLARE sqlError TINYINT DEFAULT FALSE;
DECLARE result INT DEFAULT (SELECT l.gameId 
							FROM gameName l
							INNER JOIN consolePc k
							ON l.gameId = k.gameId
							WHERE l.gameName = gameNameRemove AND k.consolePcName = platform);
						
DECLARE coverResult INT DEFAULT (SELECT gameId FROM gameCover WHERE gameId = result);

DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
	SET sqlError = TRUE;
    
START TRANSACTION;

IF (result IS NULL) THEN

	SET sqlError = TRUE;
	SELECT "Game Doesn't Exist";

ELSE
    
    IF (coverResult IS NULL) THEN
		
        SELECT "Game Doesn't Have a Cover";
        
	ELSE
   
		DELETE FROM gameCover WHERE gameId = result;
        
	END IF;
    
	DELETE FROM special WHERE gameId = result;
	DELETE FROM consolePc WHERE gameId = result;
	DELETE FROM gameName WHERE gameId = result;

END IF;

IF sqlError = FALSE THEN
	COMMIT;
    SELECT "Success";
ELSE
	ROLLBACK;
    SELECT "Failed";
END IF;

END //

DELIMITER ;


