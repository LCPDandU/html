insert into CalendarEvent values
	(null, 'Start of Calendar', 'LCPD', '2018-02-27', '4:21:00', 'PM', '1780 E University Ave, Las Cruces, NM 88003', 'This is just the beginning...', null, null, null);

insert into CalendarEvent values (null, 'event2', 'LCPd', '2018-03-01', '1:09', 'PM', '1780 E University Ave, Las Cruces, NM 88003', 'testing time inputs...', null, null, null);
    
select * from CalendarEvent;

insert into Notification values
	(null, 'Start of Notifications', 'You have received the first notification!', '2018-02-27', '16:25:00', 'PM');
    
select * from Notification;

insert into User values
	(null, 'admin1', 'reallygoodpassword', 'Admin McAdminDude', 'Admin'),
    (null, 'user1', 'goodpassword', 'User Guy', 'Standard'),
    (null, 'user2', 'password', 'User Guy II', 'Pending');
    
select * from User;