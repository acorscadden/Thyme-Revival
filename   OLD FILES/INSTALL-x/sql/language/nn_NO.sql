
-- POST INSTALLATION UPDATES



-- DEFAULT CALENDAR -- options = Strict Event Security
update _db_pref_Calendars set title = 'Standard kalender', description = 'Standard site kalender' where id = 1;


-- DEFAULT EVENT TYPE
update _db_pref_EventTypes set name = 'Avtale' where id = 1 and calendar = 1;
update _db_pref_EventTypes set name = 'Fødselsdag' where id = 2 and calendar = 1;
update _db_pref_EventTypes set name = 'Samtale' where id = 4 and calendar = 1;
update _db_pref_EventTypes set name = 'Helligdag' where id = 8 and calendar = 1;
update _db_pref_EventTypes set name = 'Intervju' where id = 16 and calendar = 1;
update _db_pref_EventTypes set name = 'Møte' where id = 32 and calendar = 1;
update _db_pref_EventTypes set name = 'Internettarr' where id = 64 and calendar = 1;
update _db_pref_EventTypes set name = 'Annet' where id = 128 and calendar = 1;
update _db_pref_EventTypes set name = 'Påminnelse' where id = 256 and calendar = 1;
update _db_pref_EventTypes set name = 'Reise' where id = 512 and calendar = 1;
update _db_pref_EventTypes set name = 'Ferie' where id = 1024 and calendar = 1;


