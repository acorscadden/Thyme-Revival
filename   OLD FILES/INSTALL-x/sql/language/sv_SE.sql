
-- POST INSTALLATION UPDATES

-- DEFAULT CALENDAR -- options = Strict Event Security
update _db_pref_Calendars set title = 'F�rvald kalender', description = 'F�rvald kalender f�r webbplatsen' where id = 1;


-- DEFAULT EVENT TYPE
update _db_pref_EventTypes set name = 'M�te' where id = 1 and calendar = 1;
update _db_pref_EventTypes set name = 'F�delsedag' where id = 2 and calendar = 1;
update _db_pref_EventTypes set name = 'Ring' where id = 4 and calendar = 1;
update _db_pref_EventTypes set name = 'Helgdag' where id = 8 and calendar = 1;
update _db_pref_EventTypes set name = 'Intervju' where id = 16 and calendar = 1;
update _db_pref_EventTypes set name = 'Konferens' where id = 32 and calendar = 1;
update _db_pref_EventTypes set name = 'Internetevenemang' where id = 64 and calendar = 1;
update _db_pref_EventTypes set name = 'Annat' where id = 128 and calendar = 1;
update _db_pref_EventTypes set name = 'P�minnelse' where id = 256 and calendar = 1;
update _db_pref_EventTypes set name = 'Resa' where id = 512 and calendar = 1;
update _db_pref_EventTypes set name = 'Semester' where id = 1024 and calendar = 1;


