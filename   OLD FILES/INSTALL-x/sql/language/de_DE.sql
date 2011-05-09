
-- POST INSTALLATION UPDATES

-- DEFAULT CALENDAR -- options = Strict Event Security
update _db_pref_Calendars set title = 'Standard Kalender', description = 'Standort Standard Kalender' where id = 1;


-- DEFAULT EVENT TYPE
update _db_pref_EventTypes set name = 'Verabredung' where id = 1 and calendar = 1;
update _db_pref_EventTypes set name = 'Geburtstag' where id = 2 and calendar = 1;
update _db_pref_EventTypes set name = 'Anruf' where id = 4 and calendar = 1;
update _db_pref_EventTypes set name = 'Urlaub' where id = 8 and calendar = 1;
update _db_pref_EventTypes set name = 'Gespräch' where id = 16 and calendar = 1;
update _db_pref_EventTypes set name = 'Besprechung' where id = 32 and calendar = 1;
update _db_pref_EventTypes set name = 'Netz Ereignis' where id = 64 and calendar = 1;
update _db_pref_EventTypes set name = 'Diverses' where id = 128 and calendar = 1;
update _db_pref_EventTypes set name = 'Erinnerung' where id = 256 and calendar = 1;
update _db_pref_EventTypes set name = 'Reise' where id = 512 and calendar = 1;
update _db_pref_EventTypes set name = 'Urlaub' where id = 1024 and calendar = 1;


