
-- POST INSTALLATION UPDATES

-- DEFAULT CALENDAR -- options = Strict Event Security
update _db_pref_Calendars set title = 'Standaardkalender', description = 'Standaard Sitekalender' where id = 1;


-- DEFAULT EVENT TYPE
update _db_pref_EventTypes set name = 'Afspraak' where id = 1 and calendar = 1;
update _db_pref_EventTypes set name = 'Verjaardag' where id = 2 and calendar = 1;
update _db_pref_EventTypes set name = 'Bellen' where id = 4 and calendar = 1;
update _db_pref_EventTypes set name = 'Feestdag' where id = 8 and calendar = 1;
update _db_pref_EventTypes set name = 'Interview' where id = 16 and calendar = 1;
update _db_pref_EventTypes set name = 'Vergadering' where id = 32 and calendar = 1;
update _db_pref_EventTypes set name = 'Net-evenement' where id = 64 and calendar = 1;
update _db_pref_EventTypes set name = 'Divers' where id = 128 and calendar = 1;
update _db_pref_EventTypes set name = 'Herinnering' where id = 256 and calendar = 1;
update _db_pref_EventTypes set name = 'Reis' where id = 512 and calendar = 1;
update _db_pref_EventTypes set name = 'Vakantie' where id = 1024 and calendar = 1;



