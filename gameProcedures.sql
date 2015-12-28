USE GameLibrary;

DROP PROCEDURE IF EXISTS insertGame;
DROP PROCEDURE IF EXISTS selectGame;
DROP FUNCTION IF EXISTS returnGame;

DELIMITER //

CREATE PROCEDURE insertGame(gameNameInsert VARCHAR(45), yearMade DATE, consolePcName VARCHAR(25), edition VARCHAR(20))
BEGIN

DECLARE sqlError TINYINT DEFAULT FALSE;
DECLARE validDate DATE DEFAULT '1970-01-01';
DECLARE gameNameResult INT;

DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
	SET sqlError = TRUE;

START TRANSACTION;

IF (validDate < yearMade) THEN

	IF (edition = 'Collectors Edition' || edition = 'Special Edition' || edition = 'Deluxe Edition' || edition = 'Standard Edition') THEN

		INSERT INTO gameName VALUES (NULL, gameNameInsert, yearMade, CURDATE());

		SET gameNameResult = (SELECT gameId FROM gameName WHERE gameName = gameNameInsert);

		INSERT INTO consolePc VALUES (NULL, gameNameResult, consolePcName);

		INSERT INTO special VALUES (NULL, gameNameResult, edition);
        
	ELSE
		SET sqlError = TRUE;
        	SELECT "Edition Is Not Valid";
	END IF;

ELSE
	SET sqlError = TRUE;
	SELECT "Date Is Not Valid (1970-01-01)";
END IF;

IF sqlError = FALSE THEN
	COMMIT;
    	SELECT "Success";
ELSE
	ROLLBACK;
    	SELECT "Failed";
END IF;

END//

CREATE PROCEDURE selectGame()
BEGIN

SELECT l.gameName, b.consolePcName
FROM gameName l
INNER JOIN consolePc b
ON l.gameId = b.gameId
ORDER BY l.gameName ASC;

END//

CREATE FUNCTION returnGame(gameNameInsert VARCHAR(45))
RETURNS VARCHAR(65)
BEGIN

DECLARE errorMsg VARCHAR(65) DEFAULT "Game Doesn't Exist";
DECLARE successMsg VARCHAR(65) DEFAULT (SELECT CONCAT(l.releaseYear, ":", b.consolePcName, ":", c.edition)
					FROM gameName l 
					INNER JOIN consolePc b 
					ON l.gameId = b.gameId 
					INNER JOIN special c 
					ON l.gameId = c.gameId
					WHERE l.gameName = gameNameInsert);
DECLARE result INT;

SET result = (SELECT gameId FROM gameName WHERE gameName = gameNameInsert);

IF (result IS NULL) THEN
    RETURN errorMsg;
ELSE
    RETURN successMsg;
END IF;

END//

DELIMITER ;


