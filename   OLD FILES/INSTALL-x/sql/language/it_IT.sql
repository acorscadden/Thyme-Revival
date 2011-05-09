
-- POST INSTALLATION UPDATES

-- DEFAULT CALENDAR -- options = Strict Event Security
update _db_pref_Calendars set title = 'Calendario di default', description = 'Sito del calendario di default' where id = 1;


-- DEFAULT EVENT TYPE
update _db_pref_EventTypes set name = 'Appuntamento' where id = 1 and calendar = 1;
update _db_pref_EventTypes set name = 'Compleanno' where id = 2 and calendar = 1;
update _db_pref_EventTypes set name = 'Chiamata' where id = 4 and calendar = 1;
update _db_pref_EventTypes set name = 'Personale' where id = 8 and calendar = 1;
update _db_pref_EventTypes set name = 'Colloquio' where id = 16 and calendar = 1;
update _db_pref_EventTypes set name = 'Riunione' where id = 32 and calendar = 1;
update _db_pref_EventTypes set name = 'Appuntamento sul web' where id = 64 and calendar = 1;
update _db_pref_EventTypes set name = 'Altro' where id = 128 and calendar = 1;
update _db_pref_EventTypes set name = 'Promemoria' where id = 256 and calendar = 1;
update _db_pref_EventTypes set name = 'Viaggio' where id = 512 and calendar = 1;
update _db_pref_EventTypes set name = 'Vacanze' where id = 1024 and calendar = 1;


