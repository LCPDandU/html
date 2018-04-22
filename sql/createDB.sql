drop table CalendarEvent;
drop table Notification;

create table CalendarEvent (
	ID int unsigned not null primary key auto_increment,
    Title varchar(128),
    Category enum ('LCPD', 'LCFD', 'AnimalControl', 'Public'),
    EventDate date,
    EventStartTime time,
    EventStartTimeAMPM enum ('AM', 'PM'),
    Location varchar(128),
    Description varchar(2048),
    Media1 varchar(128),
    Media2 varchar(128),
    Media3 varchar(128)
);

create table Notification (
	ID int unsigned not null primary key auto_increment,
    Title varchar(128),
    Description varchar(4096),
    PostDate date,
    PostTime time,
    PostTimeAMPM enum ('AM', 'PM')
);

create table User (
	ID int unsigned not null primary key auto_increment,
	LoginID varchar(32),
    Password varchar(256),
    Name varchar(128),
    AccountStatus enum ('Pending', 'Standard', 'Admin'),
		Token varchar(128)
);
