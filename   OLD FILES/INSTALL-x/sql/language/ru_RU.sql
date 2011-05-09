
-- DEFAULT CALENDAR -- options = Strict Event Security
update _db_pref_Calendars set title = 'Календарь по умолчанию', description = 'Календарь сайта по умолчанию' where id = 1;


-- DEFAULT EVENT TYPES
update _db_pref_EventTypes set name = 'Встреча' where id = 1 and calendar = 1;
update _db_pref_EventTypes set name = 'День рождения' where id = 2 and calendar = 1;
update _db_pref_EventTypes set name = 'Звонок' where id = 4 and calendar = 1;
update _db_pref_EventTypes set name = 'Праздник' where id = 8 and calendar = 1;
update _db_pref_EventTypes set name = 'Интервью' where id = 16 and calendar = 1;
update _db_pref_EventTypes set name = 'Встреча' where id = 32 and calendar = 1;
update _db_pref_EventTypes set name = 'Онлайн событие' where id = 64 and calendar = 1;
update _db_pref_EventTypes set name = 'Другое' where id = 128 and calendar = 1;
update _db_pref_EventTypes set name = 'Напоминание' where id = 256 and calendar = 1;
update _db_pref_EventTypes set name = 'Путешествие' where id = 512 and calendar = 1;
update _db_pref_EventTypes set name = 'Отпуск' where id = 1024 and calendar = 1;


