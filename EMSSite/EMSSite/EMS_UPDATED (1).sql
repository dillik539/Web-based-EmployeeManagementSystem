/* Please be advised that you have to run all this script together. If you delete rows from some of the table, 
and try to rerun the insert statement in it, the following tables' insert statement may throw some errors.In any
such situation, reruning the script will resolve the insertion errors (these errors are most likely foreign key issues).
*/

-- drops the database if it is already there.
DROP DATABASE IF EXISTS EMS_UPDATED; 

CREATE DATABASE EMS_UPDATED;

USE EMS_UPDATED;

CREATE TABLE Personal_Identifying_Info (
  PII_ID INT UNSIGNED AUTO_INCREMENT,
  FirstName VARCHAR(20),
  LastName VARCHAR(30),
  Middle_Initial CHAR(1),
  DateOfBirth DATE,
  SSN VARCHAR(11),
  Address VARCHAR(60),
  PhoneNo VARCHAR(10),
  Email VARCHAR(80),
  PRIMARY KEY (PII_ID)
);

-- Inserts multiple rows into the table using a single INSERT INTO statement. Note that the PII_ID is auto asigned and auto increment.
-- If a row is inserted, then deleted, and inserted again, the new PII_ID will start from 2 instead of 1.
INSERT INTO Personal_Identifying_Info (FirstName, LastName, Middle_Initial, DateOfBirth, SSN, Address, PhoneNo, Email)
values ('John', 'Miller', '', '1986-02-22', '540-09-7654', '123 main street', '1234567890', 'john@gmail.com'), 
('Kadrie', 'Haxiu', '', '1990-03-21', '540-02-7154', '123 Second street', '1345678921', 'kadrie@gmail.com'),
('Todd', 'Johnson', '', '1976-04-10', '510-19-7634', '13 Third street', '1245679381', 'todd@gmail.com'),
('Noah', 'Kettle', '', '1979-10-12', '140-01-7854', '23 Circle street', '1234789562', 'noah@gmail.com'),
('Ted', 'Cruz', '', '1959-07-24', '500-13-7650', '1234 Texas street', '1234117893', 'ted@gmail.com'),
('Amy', 'Klobuchar', '', '1990-01-20', '570-03-7054', '198 Minnesota Avenue', '1236567894', 'amy@gmail.com'),
('Jessica', 'Jam', '', '1988-07-31', '540-09-1654', '1002 Iowa street', '1234566891', 'jessica@gmail.com'),
('Cindy', 'Kaus', '', '1992-05-18', '520-09-9456', '345 St.Paul street', '1245007895', 'cindy@gmail.com'),
('Robinson', 'Sympathy', '', '1983-12-22', '510-99-7650', '1233 Minneapolis street', '1134061893', 'robinson@gmail.com'),
('Ronald', 'Regan', '', '1988-05-30', '570-06-7614', '123 Washington street', '1200067898', 'ronald@gmail.com');

-- creates table Employee. Here userID is auto assigned and auto increment. PII_ID is unique so that no same individual
-- can be treated as two seperate employee.
CREATE TABLE Employee (
  userID INT UNSIGNED AUTO_INCREMENT,
  PII_ID INT UNSIGNED UNIQUE,
  PRIMARY KEY (userID),
  FOREIGN KEY (PII_ID) REFERENCES Personal_Identifying_Info(PII_ID) ON DELETE CASCADE ON UPDATE CASCADE
);

-- inserts multiple rows into the table. Note that only PII_ID is required here.
INSERT INTO Employee (PII_ID) values 
(1), 
(2);

-- creates SiteAdmin table.
CREATE TABLE SiteAdmin (
  userID INT UNSIGNED AUTO_INCREMENT,
  PII_ID INT UNSIGNED UNIQUE,
  PRIMARY KEY (userID),
  FOREIGN KEY (PII_ID) REFERENCES Personal_Identifying_Info(PII_ID) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Inserts multiple rows into the table.
INSERT INTO SiteAdmin (PII_ID) values 
(3), 
(4);

-- creates HR table
CREATE TABLE HR (
  userID INT UNSIGNED AUTO_INCREMENT,
  PII_ID INT UNSIGNED UNIQUE,
  PRIMARY KEY (userID),
  FOREIGN KEY (PII_ID) REFERENCES Personal_Identifying_Info(PII_ID) ON DELETE CASCADE ON UPDATE CASCADE
);

-- inserts multiple rows into the table
INSERT INTO HR (PII_ID) values 
(5), 
(6);

-- creates Manager table
CREATE TABLE Manager (
  userID INT UNSIGNED AUTO_INCREMENT,
  PII_ID INT UNSIGNED UNIQUE,
  PRIMARY KEY (userID),
  FOREIGN KEY (PII_ID) REFERENCES Personal_Identifying_Info(PII_ID) ON DELETE CASCADE ON UPDATE CASCADE
);

-- inserts multiple rows into the table
INSERT INTO Manager (PII_ID) values 
(7), 
(8);

-- creates SiteMaintenance table
CREATE TABLE SiteMaintenance (
  MaintenanceID INT UNSIGNED AUTO_INCREMENT,
  SiteName VARCHAR(100),
  UserID INT UNSIGNED,
  SecurityUpdates VARCHAR(1000),
  Patches VARCHAR(1000),
  ConnectionMaintenance VARCHAR(1000),
  PRIMARY KEY (MaintenanceID),
  FOREIGN KEY (UserID) REFERENCES SiteAdmin(userID) ON DELETE CASCADE ON UPDATE CASCADE
);

-- inserts multiple rows into the table. Note that UserID in this table is the individual who maintains the site, in this case it is SiteAdmin's userID.
INSERT INTO SiteMaintenance (SiteName, UserID, SecurityUpdates, Patches, ConnectionMaintenance) values 
('Site1', 1, 'Applied update 1', 'Applied two patches, 1 and 2', ''),
('Site2', 1, 'Applied update 2', 'Applied two patches, 1 and 2', ''),
('Site1', 2, 'Applied update 2', 'Applied two patches, 3 and 4', ''),
('Site1', 2, 'Applied update 1', 'Applied two patches, 1 and 2', '');

-- creates table Login
CREATE TABLE Login (
  LoginID INT UNSIGNED AUTO_INCREMENT,
  CreatorID INT UNSIGNED,
  PII_ID INT UNSIGNED UNIQUE,
  UserName VARCHAR(20) UNIQUE,
  Password VARCHAR(40) UNIQUE,
  Role VARCHAR(20),
  PRIMARY KEY (LoginID),
  FOREIGN KEY (CreatorID) REFERENCES SiteAdmin(userID) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (PII_ID) REFERENCES Personal_Identifying_Info(PII_ID) ON DELETE CASCADE ON UPDATE CASCADE
);

-- inserts multiple rows into the table. Note that CreatorID is the individual who creates login info for others. Here creatorId is the SiteAdmin's userID.
INSERT INTO Login (CreatorID, PII_ID, UserName, Password, Role) values
(1, 1, 'john.miller', '123', 'Employee'),
(1, 2, 'kadrie.haxiu', '321', 'Employee'),
(2, 3, 'todd.johnson', '213', 'SiteAdmin'),
(2, 4, 'noah.kettle', '312', 'SiteAdmin'),
(1, 5, 'ted.cruz', '132', 'HR'),
(1, 6, 'amy.klobuchar', '231', 'HR'),
(2, 7, 'jessica.jam', '345', 'Manager'),
(1, 8, 'cindy.kaus', '354', 'Manager');

-- creates table Company
CREATE TABLE Company (
  ID INT UNSIGNED AUTO_INCREMENT,
  UserID INT UNSIGNED,
  CompanyName VARCHAR(100) UNIQUE,
  PhoneNo VARCHAR(13) UNIQUE,
  PRIMARY KEY (ID),
  FOREIGN KEY (UserID) REFERENCES SiteAdmin(userID) ON DELETE CASCADE ON UPDATE CASCADE
);

-- inserts multiple rows into the table. Note that the userID is the individual who maintains company's info. Here, it is SiteAdmin.
INSERT INTO Company (UserID, CompanyName, PhoneNo) values 
(1, 'Company1', '123456789'),
(1, 'Company2', '23456785'),
(2, 'Company3','345216574');

-- creates table Paystub. Note that for simplicity, not all information required to create paystub is included in this table.
-- creatorId is the individual who creates the paystub info: here, it is HR. PII_ID is the individual whose paystub's info is contained in the table.
CREATE TABLE Paystub (
  ID INT UNSIGNED AUTO_INCREMENT,
  CreatorID INT UNSIGNED,
  PII_ID INT UNSIGNED UNIQUE,
  PayPeriod VARCHAR(100),
  PayDate DATE,
  PRIMARY KEY (ID),
  FOREIGN KEY (CreatorID) REFERENCES HR(userID) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (PII_ID) REFERENCES Personal_Identifying_Info(PII_ID) ON DELETE CASCADE ON UPDATE CASCADE
);

-- inserts multiple rows into the table.
INSERT INTO Paystub (CreatorID, PII_ID, PayPeriod, PayDate) values
(1, 1,'04/20/2022 - 05/05/2022', '2022-05-10'),
(1, 2, '04/20/2022 - 05/05/2022', '2022-05-10');

-- creates FeedBack table
CREATE TABLE FeedBack (
  ID INT UNSIGNED AUTO_INCREMENT,
  ProviderID INT UNSIGNED,
  FeedBack VARCHAR(500),
  Reply VARCHAR(100),
  PRIMARY KEY (ID),
  FOREIGN KEY (ProviderID) REFERENCES Personal_Identifying_Info(PII_ID) ON DELETE CASCADE ON UPDATE CASCADE 
);

-- inserts multiple rows into the table.
INSERT INTO FeedBack (ProviderID, FeedBack, Reply) values 
(1, 'Need improvements in production area', ''), 
(2, 'Good on environmental issues', ''); 

-- creates table Schedule. Note that the UserID here is the individual whose schedule is being stored in this table. 
CREATE TABLE Schedule (
  ID INT UNSIGNED AUTO_INCREMENT,
  UserID INT UNSIGNED UNIQUE,
  SchedulerID INT UNSIGNED,
  WorkDays VARCHAR(9) NOT NULL,
  Shift VARCHAR(3) NOT NULL,
  StartTime Time NOT NULL,
  EndTime Time NOT NULL,
  PRIMARY KEY (ID),
  FOREIGN KEY (UserID) REFERENCES Employee(userID) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (SchedulerID) REFERENCES Manager(userID) ON DELETE CASCADE ON UPDATE CASCADE
);

-- inserts multiple rows into the table.
INSERT INTO Schedule (UserID, SchedulerID, WorkDays, Shift, StartTime, EndTime) values
(1, 1, 'M - F', '1st', '8:30:00', '5:00:00'),
(2, 1, 'M - F', '1st', '8:30:00', '5:00:00');

-- creates TimeOffRequest table. Note that PII_ID is the individual whose information is stored in this table. 
CREATE TABLE TimeOffRequest (
  ID INT UNSIGNED AUTO_INCREMENT,
  PII_ID INT UNSIGNED,
  DaysRequested VARCHAR(40),
  RequestReason VARCHAR(100),
  PRIMARY KEY (ID),
  UNIQUE KEY (PII_ID, DaysRequested),
  FOREIGN KEY (PII_ID) REFERENCES Personal_Identifying_Info(PII_ID) ON DELETE CASCADE ON UPDATE CASCADE
);

-- inserts multiple rows into the table.
INSERT INTO TimeOffRequest (PII_ID, DaysRequested, RequestReason) values 
(1, 'M, T, F', 'Holiday'),
(2, 'M-F', 'Holiday'),
(3, 'M, TH', "Doctor's Appointment");

-- creates table WorkedHours. Note that the PII_ID is the individaul's id whose workedHours info is stored in the table.
CREATE TABLE WorkedHours (
  ID INT UNSIGNED AUTO_INCREMENT,
  PII_ID INT UNSIGNED UNIQUE,
  RegularHours DOUBLE,
  OverTimeHours double,
  PRIMARY KEY (ID),
  FOREIGN KEY (PII_ID) REFERENCES Personal_Identifying_Info(PII_ID) ON DELETE CASCADE ON UPDATE CASCADE
);

-- inserts multiple rows into the table.
INSERT INTO WorkedHours (PII_ID, RegularHours, OverTimeHours) values 
(1, 40, 0),
(2, 40, 0), 
(3, 40, 4), 
(4, 40, 2), 
(5, 30, 0);

-- creates PaiedTimeOff table. Note that the PII_ID is the individual's id whose paid time off info is stored in this table.
CREATE TABLE PaidTimeOff (
  ID INT UNSIGNED AUTO_INCREMENT,
  PII_ID INT UNSIGNED UNIQUE,
  HoursAvailable DOUBLE,
  HoursUsed DOUBLE,
  PRIMARY KEY (ID) ,
  FOREIGN KEY (PII_ID) REFERENCES Personal_Identifying_Info(PII_ID) ON DELETE CASCADE ON UPDATE CASCADE 
);

-- inserts multiple rows into the table.
INSERT INTO PaidTimeOff (PII_ID, HoursAvailable, HoursUsed) values
(1, 2, 4), 
(2, 3, 3), 
(3, 3, 1), 
(4, 0, 4),
(5, 1, 1);




