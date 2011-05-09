
-- POST INSTALLATION UPDATES

-- DEFAULT CALENDAR -- options = Strict Event Security
update _db_pref_Calendars set title = 'Standard Kalender', description = 'Standard website kalender' where id = 1;


-- DEFAULT EVENT TYPE
update _db_pref_EventTypes set name = 'Aftale tid' where id = 1 and calendar = 1;          update _db_pref_EventTypes set name = 'Fødselsdag' where id = 2 and calendar = 1;
update _db_pref_EventTypes set name = 'Ring' where id = 4 and calendar = 1;
update _db_pref_EventTypes set name = 'Helligdag' where id = 8 and calendar = 1;
update _db_pref_EventTypes set name = 'Interview' where id = 16 and calendar = 1;
update _db_pref_EventTypes set name = 'Møde' where id = 32 and calendar = 1;
update _db_pref_EventTypes set name = 'Net begivenhed' where id = 64 and calendar = 1;
update _db_pref_EventTypes set name = 'Andet' where id = 128 and calendar = 1;
update _db_pref_EventTypes set name = 'Påmindelse' where id = 256 and calendar = 1;
update _db_pref_EventTypes set name = 'Rejse' where id = 512 and calendar = 1;
update _db_pref_EventTypes set name = 'Ferie' where id = 1024 and calendar = 1;

