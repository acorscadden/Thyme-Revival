
-- POST INSTALLATION UPDATES

-- DEFAULT CALENDAR -- options = Strict Event Security
update _db_pref_Calendars set title = 'Calendrier par défaut', description = 'Site du calendrier par défaut' where id = 1;


-- DEFAULT EVENT TYPE
update _db_pref_EventTypes set name = 'Rendez-vous' where id = 1 and calendar = 1;
update _db_pref_EventTypes set name = 'Anniversaire' where id = 2 and calendar = 1;
update _db_pref_EventTypes set name = 'Appels' where id = 4 and calendar = 1;
update _db_pref_EventTypes set name = 'Jour férié(Congé)' where id = 8 and calendar = 1;
update _db_pref_EventTypes set name = 'Entretien' where id = 16 and calendar = 1;
update _db_pref_EventTypes set name = 'Réunion' where id = 32 and calendar = 1;
update _db_pref_EventTypes set name = 'Événements sur le Net' where id = 64 and calendar = 1;
update _db_pref_EventTypes set name = 'Autres' where id = 128 and calendar = 1;
update _db_pref_EventTypes set name = 'Rappels' where id = 256 and calendar = 1;
update _db_pref_EventTypes set name = 'Voyage' where id = 512 and calendar = 1;
update _db_pref_EventTypes set name = 'Vacances' where id = 1024 and calendar = 1;


