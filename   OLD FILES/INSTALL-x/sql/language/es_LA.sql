
-- POST INSTALLATION UPDATES

-- DEFAULT CALENDAR -- options = Strict Event Security
update _db_pref_Calendars set title = 'Calendario pre establecido', description = 'Sitio web pre establecido del calendario' where id = 1;


-- DEFAULT EVENT TYPE
update _db_pref_EventTypes set name = 'Cita' where id = 1 and calendar = 1;
update _db_pref_EventTypes set name = 'Cumpleaños' where id = 2 and calendar = 1;
update _db_pref_EventTypes set name = 'Llamada' where id = 4 and calendar = 1;
update _db_pref_EventTypes set name = 'Feriado/Día de Fiesta' where id = 8 and calendar = 1;
update _db_pref_EventTypes set name = 'Entrevista' where id = 16 and calendar = 1;
update _db_pref_EventTypes set name = 'Reunión' where id = 32 and calendar = 1;
update _db_pref_EventTypes set name = 'Evento por internet' where id = 64 and calendar = 1;
update _db_pref_EventTypes set name = 'Otro' where id = 128 and calendar = 1;
update _db_pref_EventTypes set name = 'Recordatorio' where id = 256 and calendar = 1;
update _db_pref_EventTypes set name = 'Viaje' where id = 512 and calendar = 1;
update _db_pref_EventTypes set name = 'Vacación' where id = 1024 and calendar = 1;


