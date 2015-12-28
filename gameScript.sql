DROP DATABASE IF EXISTS GameLibrary;
CREATE DATABASE GameLibrary;
USE GameLibrary;

CREATE TABLE gameName (
	gameId INT PRIMARY KEY AUTO_INCREMENT,
    gameName VARCHAR(45),
    releaseYear DATE,
    dateAdded DATE
);

CREATE TABLE consolePc (
	consolePcId INT PRIMARY KEY AUTO_INCREMENT,
    gameId INT,
    consolePcName VARCHAR(25),
		FOREIGN KEY (gameId)
			REFERENCES gameName(gameId)
);

CREATE TABLE special (
	specId INT PRIMARY KEY AUTO_INCREMENT,
    gameId INT,
    edition ENUM("Collectors Edition", "Special Edition", "Deluxe Edition", "Standard Edition"),
		FOREIGN KEY (gameId)
			REFERENCES gameName(gameId)
);

CREATE TABLE gameCover (
	gameCoverId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    gameId INT NOT NULL,
	name VARCHAR(30) NOT NULL,
    type VARCHAR(30) NOT NULL,
	size INT NOT NULL,
	content LONGBLOB NOT NULL,
		FOREIGN KEY (gameId)
			REFERENCES gameName(gameId)
);


	


    