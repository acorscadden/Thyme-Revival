
-- POST INSTALLATION UPDATES

-- DEFAULT CALENDAR -- options = Strict Event Security
update _db_pref_Calendars set title = 'Förvald kalender', description = 'Förvald kalender för webbplatsen' where id = 1;


-- DEFAULT EVENT TYPE
update _db_pref_EventTypes set name = 'Möte' where id = 1 and calendar = 1;
update _db_pref_EventTypes set name = 'Födelsedag' where id = 2 and calendar = 1;
update _db_pref_EventTypes set name = 'Ring' where id = 4 and calendar = 1;
update _db_pref_EventTypes set name = 'Helgdag' where id = 8 and calendar = 1;
update _db_pref_EventTypes set name = 'Intervju' where id = 16 and calendar = 1;
update _db_pref_EventTypes set name = 'Konferens' where id = 32 and calendar = 1;
update _db_pref_EventTypes set name = 'Internetevenemang' where id = 64 and calendar = 1;
update _db_pref_EventTypes set name = 'Annat' where id = 128 and calendar = 1;
update _db_pref_EventTypes set name = 'Påminnelse' where id = 256 and calendar = 1;
update _db_pref_EventTypes set name = 'Resa' where id = 512 and calendar = 1;
update _db_pref_EventTypes set name = 'Semester' where id = 1024 and calendar = 1;


