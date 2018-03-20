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
    Media1 longblob, -- longblob type allows for file of 4294967295 bytes ~ 4294 MB ~ 4 GB
    Media2 longblob,
    Media3 longblob
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
    Password varchar(32),
    Name varchar(128),
    AccountStatus enum ('Pending', 'Standard', 'Admin')
);