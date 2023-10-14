CREATE DATABASE if NOT exists Tickets;
USE Tickets;
CREATE TABLE Flights
(
    Id INT PRIMARY KEY AUTO_INCREMENT,
    Airport VARCHAR(150) NOT NULL,
    Price INT NOT NULL
);
CREATE TABLE Passengers
(
    Id INT PRIMARY KEY AUTO_INCREMENT,
    FamilyName VARCHAR(150) NOT NULL
);
CREATE TABLE SoldTickets
(
    Id INT PRIMARY KEY AUTO_INCREMENT,
    FlightId INT,
    PassengerId INT,
    FlightDate DATE,
    FOREIGN KEY (FlightId) REFERENCES Flights (Id),
    FOREIGN KEY (PassengerId) REFERENCES Passengers (Id)
);