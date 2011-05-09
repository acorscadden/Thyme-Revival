
-- POST INSTALLATION UPDATES

-- DEFAULT CALENDAR -- options = Strict Event Security
update _db_pref_Calendars set title = 'Calendário padrão', description = 'Calendário padrão do site' where id = 1;


-- DEFAULT EVENT TYPE
update _db_pref_EventTypes set name = 'Compromisso' where id = 1 and calendar = 1;
update _db_pref_EventTypes set name = 'Aniversário' where id = 2 and calendar = 1;
update _db_pref_EventTypes set name = 'chamada' where id = 4 and calendar = 1;
update _db_pref_EventTypes set name = 'Férias' where id = 8 and calendar = 1;
update _db_pref_EventTypes set name = 'Entrevista' where id = 16 and calendar = 1;
update _db_pref_EventTypes set name = 'Reunião' where id = 32 and calendar = 1;
update _db_pref_EventTypes set name = 'Evento em rede' where id = 64 and calendar = 1;
update _db_pref_EventTypes set name = 'Outros' where id = 128 and calendar = 1;
update _db_pref_EventTypes set name = 'Lembrete' where id = 256 and calendar = 1;
update _db_pref_EventTypes set name = 'Viagem' where id = 512 and calendar = 1;
update _db_pref_EventTypes set name = 'Férias' where id = 1024 and calendar = 1;

