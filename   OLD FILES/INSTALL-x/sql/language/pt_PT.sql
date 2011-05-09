
-- POST INSTALLATION UPDATES



-- DEFAULT CALENDAR -- options = Strict Event Security
update _db_pref_Calendars set title = 'Calendário Predefenido', description = 'Site predefenido do calendário' where id = 1;


-- DEFAULT EVENT TYPE
update _db_pref_EventTypes set name = 'Apontamento' where id = 1 and calendar = 1;
update _db_pref_EventTypes set name = 'Aniversário' where id = 2 and calendar = 1;
update _db_pref_EventTypes set name = 'Chamada' where id = 4 and calendar = 1;
update _db_pref_EventTypes set name = 'Feriado' where id = 8 and calendar = 1;
update _db_pref_EventTypes set name = 'Entrevista' where id = 16 and calendar = 1;
update _db_pref_EventTypes set name = 'Reunião' where id = 32 and calendar = 1;
update _db_pref_EventTypes set name = 'Evento Net' where id = 64 and calendar = 1;
update _db_pref_EventTypes set name = 'Outros' where id = 128 and calendar = 1;
update _db_pref_EventTypes set name = 'Lembrete' where id = 256 and calendar = 1;
update _db_pref_EventTypes set name = 'Curso' where id = 512 and calendar = 1;
update _db_pref_EventTypes set name = 'Férias' where id = 1024 and calendar = 1;


