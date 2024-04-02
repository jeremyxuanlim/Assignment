CREATE TABLE users(
    AdminID varchar(200),
    UserFirstName varchar(200),
    UserLastName varchar(200),
    Email varchar(200),
    Password varchar(200)
);

CREATE TABLE events (
  ID INT NOT NULL AUTO_INCREMENT,
  Title VARCHAR(255),
  Date DATE,
  Time_Start TIME,
  TIME_End TIME,
  Venue VARCHAR(255),
  Description TEXT,
  Capacity INT,
  PRIMARY KEY (ID)
);

CREATE TABLE tickets (
  TicketID INT NOT NULL AUTO_INCREMENT,
  EventID INT,
  StudentID varchar(255),
  PurchaseTime DATETIME,
  FOREIGN KEY (StudentID) REFERENCES users(StudentID),
  FOREIGN KEY (EventID) REFERENCES events(ID)
)