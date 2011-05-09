
-- POST INSTALLATION UPDATES

-- DEFAULT CALENDAR -- options = Strict Event Security
update _db_pref_Calendars set title = 'Default Calendar', description = 'Default Site Calendar' where id = 1;


-- DEFAULT EVENT TYPE
update _db_pref_EventTypes set name = 'Appointment' where id = 1 and calendar = 1;
update _db_pref_EventTypes set name = 'Birthday' where id = 2 and calendar = 1;
update _db_pref_EventTypes set name = 'Call' where id = 4 and calendar = 1;
update _db_pref_EventTypes set name = 'Holiday' where id = 8 and calendar = 1;
update _db_pref_EventTypes set name = 'Interview' where id = 16 and calendar = 1;
update _db_pref_EventTypes set name = 'Meeting' where id = 32 and calendar = 1;
update _db_pref_EventTypes set name = 'Net Event' where id = 64 and calendar = 1;
update _db_pref_EventTypes set name = 'Other' where id = 128 and calendar = 1;
update _db_pref_EventTypes set name = 'Reminder' where id = 256 and calendar = 1;
update _db_pref_EventTypes set name = 'Travel' where id = 512 and calendar = 1;
update _db_pref_EventTypes set name = 'Vacation' where id = 1024 and calendar = 1;

