DROP DATABASE IF EXISTS GameLibrary;
CREATE DATABASE GameLibrary;
USE GameLibrary;

CREATE TABLE users (
	userID INT PRIMARY KEY AUTO_INCREMENT,
	userName VARCHAR(25) UNIQUE,
	firstName VARCHAR(20),
	lastName VARCHAR(20),
	email VARCHAR(320),
	permission ENUM("ADMIN", "USER", "BANNED"),
	password VARCHAR(40)
);

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



INSERT INTO users VALUES ( '\N' , 'Weirdtopia' , 'Graham' , 'Berry' , 'grahamstaveleyberry@gmail.com' , 'ADMIN' , 'NNf4jkdEuqqtZPkR+1gS42teUCTScqJ7zgnIU30St+U=')
						 ,( '\N' , 'vIIPrezIIv' , 'Real' , 'Ortelli' , 'realortelli@gmail.com' , 'ADMIN' , 'NNf4jkdEuqqtZPkR+1gS42teUCTScqJ7zgnIU30St+U=');
	


    
