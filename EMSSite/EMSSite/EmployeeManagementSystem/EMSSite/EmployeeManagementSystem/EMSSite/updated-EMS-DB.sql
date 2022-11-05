Create database ems;

use ems;

/* Creates Employee table */

CREATE TABLE Employee(
UserID int UNSIGNED AUTO_INCREMENT not null Primary key,
UPN VARCHAR(20) unique not null,
FirstName VARCHAR (20)not null,
LastName VARCHAR(20) not null,
UserName VARCHAR(20) not null,
Password VARCHAR(20) unique not null,
Email varchar(30),
Role VARCHAR(20) not null,
Address VARCHAR(100),
PhoneNumber VARCHAR(20),
Reporting VARCHAR(50)not null
);


/* Inserts data into Employee Table */
insert into Employee values(1,'001','Sapana','Kunwar','kunwar1','123','sapana@gmail.com','Employee',
'12938 jewell','5151716','Dilli');
insert into Employee values(2,'002','John','Miller','jmiller','234','johnmiller@gmail.com','Employee',
'12938 North Main Street','5151716','Maamoun');
insert into Employee values(3,'003','Kadrie','Haxiu','khaxiu','312','kadriehaxiu@gmail.com','Employee',
'57 Main street','23212345','Iiman');


/* Creates Personal_Identifiying_Information Table */
CREATE TABLE Personal_Identifying_Information(
PII_ID int UNSIGNED AUTO_INCREMENT primary key,
FirstName varchar(20) not null,
LastName varchar(20) not null,
Middel_initial varchar(20),
Address varchar(50),
WorkEmail varchar(50),
PersonalEmail varchar(20),
SocialSecurityNumber varchar(20) unique,
FOREIGN KEY (PII_ID) REFERENCES Employee(UserID) ON DELETE CASCADE ON UPDATE CASCADE
);

/* inserts data into personal identifying information */
insert into Personal_Identifying_Information values(1,'Sapana','Kunwar','K','','','','276-876');
insert into Personal_Identifying_Information values(2,'Maamoun','Slayhi','','','','','276-890');
insert into Personal_Identifying_Information values(3,'Iiman','Abdi','','','','','234-876');


/* Creates Time_Off_Request table */
CREATE TABLE Time_Off_Request(
Request_ID int UNSIGNED AUTO_INCREMENT primary key ,
PaidTimeOffRequest float,
UnPaidTimeOffRequest float,
FOREIGN KEY (Request_ID) REFERENCES Employee(UserID) ON DELETE CASCADE ON UPDATE CASCADE
);


/* Inserts data into Time_Off_Request table */
insert into Time_Off_Request values(1,2.5,5);
insert into Time_Off_Request values(2,3,3);
insert into Time_Off_Request values(3,2.5,1);



/* Creates Paystubs table*/
CREATE TABLE PayStubs(
ID int UNSIGNED AUTO_INCREMENT primary key, 
Download varbinary(1000),
ApprovePayStub varchar(20),
UploadPayStubs varbinary(1000),
FOREIGN KEY (ID) REFERENCES Employee(UserID) ON DELETE CASCADE ON UPDATE CASCADE
);


/* insert data into Paystubs table */
insert into PayStubs values(1,'','','');
insert into PayStubs values(2,'','','');
insert into PayStubs values(3,'','','');



/* Creates Manager table */
CREATE TABLE Manager (
UserID int UNSIGNED AUTO_INCREMENT not null Primary key,
UPN varchar(20) unique,
FirstName VARCHAR (20)not null,
LastName VARCHAR(20) not null,
UserName VARCHAR(20) not null,
Password VARCHAR(20) unique not null,
Email varchar(30),
Role VARCHAR(20) not null,
ManagerName varchar(20) not null,
Address VARCHAR(20),
PhoneNumber VARCHAR(20),
Reporting VARCHAR(50) not null
);

/* Inserts datat into Manager Table */
insert into Manager values(1111,'MG01','Iiman','Abdi','Abdi122','3534','','Manager','Maamoun','Minnesota','','Brian');
insert into Manager values(1112,'MG02','Maamoun','Slayhi','mslayhi','3451','','Manager','John','Minnesota','','Brian');
insert into Manager values(1113,'MG03','Todd','Miller','tmiller','5432','','Manager','Cindy','Minnesota','','James');


/* creates table Hours */
/* Manager_ID, Employee_ID are added field which are not in our class diagram */
CREATE TABLE Hours(
Hour_ID int UNSIGNED AUTO_INCREMENT primary key,
Manager_ID int UNSIGNED not null,
Employee_ID int UNSIGNED unique not null,
Schedule float ,
TotalPayPeriodHours float,
SetHours float default 40,
CONSTRAINT FK_Employee_HR FOREIGN KEY (Employee_ID) REFERENCES Employee(UserID) ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT FK_Manager_Hr FOREIGN KEY (Manager_ID) REFERENCES MANAGER(UserID) ON DELETE CASCADE ON UPDATE CASCADE
);

/* Inserts data into Hours table */
insert into Hours values(0001,1111,1,38.5,80,default);
insert into Hours values(0002,1112,2,34.5,78,default);
insert into Hours values(0003,1113,3,38.5,80,default);


/* Creates Company table */
/* Company_Name is new field not in class diagram */
CREATE TABLE Company(
Comapany_ID int UNSIGNED AUTO_INCREMENT primary key,
Company_Name varchar(20),
Edit varchar(50)
);

/* Inserts data into Company table */
insert into Company values(5555,'Management Company','');

/* Creates FeedBack table */
CREATE TABLE FeedBack(
FeedBack_ID int UNSIGNED AUTO_INCREMENT primary key,
FeedBack varchar(2000) NOT NULL,
ReplyToFeedBack varchar(1000)
);

/* Inserts data into FeedBack table */
insert into FeedBack values(6666,'Comapnay is Great ','Thank you for your comment');
insert into FeedBack values(6667,'Poor communication practice ','Thank you for your comment. We will work on it to fix.');


/* Creates HR table */
CREATE TABLE HR(
UserID int UNSIGNED AUTO_INCREMENT Primary key,
Paystubs_ID int UNSIGNED not null,
Comp_ID int UNSIGNED not null,
Feedback_Id int UNSIGNED not null,
UPN VARCHAR(20) unique not null,
FirstName VARCHAR (20)not null,
LastName VARCHAR(20) not null,
UserName VARCHAR(20) not null,
Password VARCHAR(20) unique not null,
Email varchar(30),
Role VARCHAR(20) not null,
CONSTRAINT FK_HR_Paystubs FOREIGN KEY (Paystubs_ID) REFERENCES Paystubs(ID) ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT FK_HR_Company FOREIGN KEY (Comp_ID) REFERENCES Company(Comapany_ID) ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT FK_HR_feedback FOREIGN KEY (Feedback_Id) REFERENCES Feedback(FeedBack_ID) ON DELETE CASCADE ON UPDATE CASCADE
);


/* Inserts data into HR table */
insert into HR values(999,1,5555,6666,'HR0011','John','Smith','John123','Smith56472','','HR');
insert into HR values(1000,2,5555,6667,'HR0012','Jackie','Chan','jchan12','j123','','HR');
insert into HR values(1001,3,5555,6666,'HR0013','Jimmy','Carter','jcarter','jc123','','HR');



/* Creates Site_Admin table */
CREATE TABLE Site_Admin(
UserID int UNSIGNED AUTO_INCREMENT not null Primary key,
Employee_ID int UNSIGNED not null,
Manager_ID int UNSIGNED not null,
HR_ID int UNSIGNED not null,
UPN VARCHAR(20) unique not null,
FirstName VARCHAR (20)not null,
LastName VARCHAR(20) not null,
UserName VARCHAR(20) not null,
Password VARCHAR(20) unique not null,
Email varchar(30),
Role VARCHAR(20) not null,
CONSTRAINT FK_SiteAdmin_Employee FOREIGN KEY (Employee_ID) REFERENCES Employee(UserID) ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT FK_SiteAdmin_Manager FOREIGN KEY (Manager_ID) REFERENCES MANAGER(UserID) ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT FK_SiteAdmin_HR FOREIGN KEY (HR_ID) REFERENCES HR(UserID) ON DELETE CASCADE ON UPDATE CASCADE
);


/* Inserts data into Site_Admin table */
insert into Site_Admin values(8880,1,1111,999,'SD111','Jason','Vang','Jason321','vang8976','','Site Admin');
insert into Site_Admin values(8881,2,1112,1000,'SD112','Jessica','Johnson','Jjson321','j5467','','Site Admin');
insert into Site_Admin values(8882,3,1113,1001,'SD113','Ashley','Karn','akorn','a4532','','Site Admin');

/* Creates TimeRequest table */
/* AccessAllRequest field refactored to Requested_Time */

CREATE TABLE TimeRequest(
Request_ID int UNSIGNED AUTO_INCREMENT primary key,
Emp_Id int UNSIGNED not null,
Mgr_Id int UNSIGNED not null,
Requested_Time int,
CONSTRAINT FK_TimeRequest_Emp FOREIGN KEY (Emp_Id) REFERENCES Employee(UserID) ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT FK_TimeRequest_Manager FOREIGN KEY (Mgr_Id) REFERENCES Manager(UserID) ON DELETE CASCADE ON UPDATE CASCADE
 );

/* Inserts data into TimeRequest table */
 insert into TimeRequest values(2121,1,1111,8);
 insert into TimeRequest values(2122,2,1112,8);
 insert into TimeRequest values(2123,3,1113,8);


/* Creates ManageSite table */
CREATE TABLE  Manage_Site(
Site_ID int UNSIGNED AUTO_INCREMENT primary key,
Site_Admin_ID int UNSIGNED not null,
SecurityUpdates varchar(50),
AppliedPatches varchar(50),
ConnectionMaintance varchar(50),
FOREIGN KEY (Site_Admin_ID) REFERENCES Site_Admin(UserID) ON DELETE CASCADE ON UPDATE CASCADE
);

/* Inserts data into Manage_Site table */
insert into Manage_Site values (2000,8880,'Software Updated','','');
insert into Manage_Site values (2001,8881,'Software Updated','','');
insert into Manage_Site values (2002,8882,'Software Updated','','');


