<?php

#######################
#
### NEW TRANSLATIONS
#
#######################


##################################
#
## SITE VIEWS
#
# in Admin -> Calendars
##################################
define("_GLOBAL_VIEWS_", "Общие просмотры");

define("_ALLOW_EVERYONE_VIEW_", "Разрешить всем смотреть календари в этом просмотре независимо от их списка участников");

define("_HIDE_VIEW_FROM_GUESTS_", "Спрятать этот просмотр от незарегистрированых участников");

define("_REQUEST_NOTIFY_OWNER_", "Сообщать администратору календаря про входящие запросы");

define("_ALL_CALENDARS_", "Просмотр всех календарей");

#################################
#
### INSTALLER 
#
#################################

# some of these will not be used until 2.0
define("_INSTALLER_", "Установщик");
define("_PACKAGE_", "Пакет");
define("_INSTALL_", "Установить");
define("_INVALID_PACKAGE_", "Файл, который Вы загрузили, не является коректным пакетом Thyme.");
define("_INSTALLED_MODULES_", "Установленные модули");
define("_UNINSTALL_", "Снять");
define("_LOCAL_FILE_","Локальный файл");
define("_UPDATES_", "Обновления");
define("_AVAILABLE_UPDATES_", "Доступные обновления");
define("_CHECK_FOR_UPDATES_", "Проверить обновления");
define("_LAST_CHECKED_ON_", "В последний раз проверялось"); # e.g. last checked on 1/2/2007
define("_FILE_", "Файл");
define("_WRITABLE_", "Можна записывать");
define("_REFRESH_", "Обновить");
define("_INVALID_DOWNLOAD_", "Некоректная загрузка. Не могу обновить файл.");
define("_UNABLE_TO_BACKUP_", "Не могу сделать архивацию текущего файла.");
define("_UPDATES_AVAIL_", "Доступно %s обновлений"); # %s will be replaced w/# of updates available

############################
#
### NEW USER DEFINITIONS
#
###########################
define("_REGISTERED_USERS_", "Зарегистрированные пользователи");
define("_PUBLIC_", "Для всех");
define("_PUBLIC_ACCESS_", "Доступ для всех");

#############################
#
### MULTIPLE REMINDERS
#
#############################
define("_BEFORE_EVENT_MULTI_", "до этого события");
define("_USER_CAN_NOT_VIEW_", "%s не имеет права на просмотр этого календаря.");
define("_ALLOW_CONFIGURE_REMINDERS_", "Разрешить %s настройку напоминаний про события для всех пользователей.");
define("_CALENDAR_ADMINS_", "Администраторы календаря");
define("_EVENT_OWNER_", "Собственники календаря");
define("_SITE_ADMINS_", "Администраторы сайта");
define("_NO_ONE_", "Никто");

###############################
#
## CONFIGURABLE JOB INTERVALS
#
###############################

define("_REMIND_AT_LEAST_", "По крайней мере");
define("_SCHEDULED_TASK_", "Запланированная задача");
define("_NO_SCHEDULED_TASK_", "Запланированное задание Thyme не настроено на запуск");
define("_SCHEDULED_TASK_CONFIGURED_", "Запланированное задание Thyme настроено на запуск каждые");
define("_PHP_CLI_", "Местонахождение PHP CLI");

###################################
#
### CUSTOMIZE SITE
#
###################################
define("_CUSTOMIZE_SITE_", "Настройка сайта");
define("_SITE_NAME_", "Название сайта");
define("_SITE_THEME_", "Тема");
define("_SITE_THEME_DESC_", "Если установить None, тогда пользователи смогут сами выбирать свою тему");

# use exact HTML tags, they will be displayed correctly
# when printed
define("_SITE_HEADER_", "Заголовок сайта");
define("_SITE_HEADER_DESC_", "После тэга <body>");

define("_SITE_FOOTER_", "Нижний колонтитул сайта");
define("_SITE_FOOTER_DESC_", "Перед тэгом </body>");

define("_SITE_HEAD_", "В верхнем колонтитуле сайта");
define("_SITE_HEAD_DESC_", "Между тэгами <head> <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"></head>."); 

####################################
#
### LICENSE KEY
#
####################################
define("_ENTER_LICENSE_KEY_", "Введите лицензионный ключ");
define("_LICENSE_KEY_", "Лицензионный ключ");
define("_LICENSE_KEY_ACCEPTED_", "Лицензионный ключ действителен");
define("_INVALID_LICENSE_KEY_", "Введенный лицензионный ключ не подходит для этого сайта");

####################################
#
### EVENT REQUEST DESCRIPTION
#
####################################
define("_REQUEST_MODE_VIEW_ONLY_", "Участники з правом просмотра могут подавать запросы на размещение информации про события. Обычные пользователи могут подавать запросы напрямую.");
define("_REQUEST_MODE_NORMAL_", "Участники з правом просмотра могут только просматривать календарь. Обычные пользователи могут подавать запросы на размещение события.");


#####################################
#
### TELL A FRIEND FOR GUEST E-MAILS
#
######################################
define("_TELL_A_FRIEND_", "Сообщить другу");

define("_YOUR_NAME_", "Ваше имя");
define("_YOUR_EMAIL_", "Ваш адрес эл. почты");

define("_YOUR_FRIENDS_NAME_","Имя Вашего друга");
define("_YOUR_FRIENDS_EMAIL_","Адрес эл. почты друга");

define("_EMAIL_EVENT_DISPLAYED_","Событие будет показано под Вашим сообщением.");

define("_ALLOW_GUEST_USERS_EMAIL_", "Разрешить незарегистрированным пользователям отправлять события через эл. почту.");

define("_DISABLE_SITE_ADDR_BOOK_", "Запретить доступ к адресной книге не администраторам сайта");

define("_EMAIL_TO_MULTIPLE_", "Введите адреса через запятую.");

# MISC
########
define("_HELP_", "Помощь");
define("_WARNING_DIR_NOT_WRITABLE_", "Внимание: нет прав записи в папку %s.");
define("_WARNING_FILE_NOT_WRITABLE_", "Внимание: нет прав записи в файл %s.");
define("_DOWNLOAD_", "Загрузить");
define("_HIDE_QUICK_ADD_", "Спрятать блок быстрого добавления события");
define("_FORCE_DEFAULT_OPTS_", "Установить настройки по умолчанию для всех пользователей. Установите в Администратор - Настройки по умолчанию.");
define("_NO_GUEST_TIMEZONE_", "Не разрешать незарегистрированным пользователям изменять часовой пояс.");
define("_NUMBER_SYMBOL_", '#');
define("_DISABLE_WYSIWYG_EDITOR_", "Отключить редактор WYSIWYG для приметок.");
define("_SHOW_CALENDAR_NAMES_", "Показывать названия календарей когда в настройка пользователя установлено Отображение названий категорий событий.");
define("_MISC_", "Остальное");
define("_THEME_POPUPS_", "Установить тему для попапов событий.");

define("_PUBLIIC_", "Для всех");
define("_REGISTERED_USERS_", "Зарегистрированные пользователи");

define("_NEW_", "Новый");

define("_CATEGORY_EDIT_DESC_", "Чтобы отредактировать категорию, нажмите на её заголовок");

define("_ARE_YOU_SURE_DELETE_", "Вы уверены, что хотите удалить %s?");

########## END NEW TRANSLATIONS #################

#
# With this set to 1, Nov 2nd 2004 would look
# like 2/11/2004 where applicable. With it
# set to 0, it would look like 11/2/2004.
#
# all date selects are also affected bu this
# as they will be day-month-year
#
###########################################
define("_CAL_EURO_DATE_", 1);

define("_CHARSET_", "UTF-8");

define("_LANG_NAME_", "Russian (RU)");


################################
# EDIT / VIEW / POST CALENDARS
################################
define("_CALENDARS_", "Календари");
define("_OWNER_", "Организатор");
define("_ARE_YOU_SURE_DELETE_CALENDAR_", "Вы уверены, что хотите удалить календарь?");

define("_COLOR_BY_", "Раскрасить события");
define("_BY_OWNER_", "Организатор события");
define("_BY_CATEGORY_", "По категории");
define("_BY_CALENDAR_", "По календарю");

define("_MODE_", "Режим");

define("_ALLOW_MULTI_CATS_", "Разрешить несколько категория для событий");

define("_REMEMBER_LOCATIONS_", "Запоминать места");

define("_STRICT_EVENT_SECURITY_", "Строгий уровень безопасности");
define("_STRICT_EVENT_SECURITY_DESC_", "Только организатор события или администраторы календаря могут изменять либо удалять текущие события.");

define("_REMOTE_ACCESS_", "Удалённый доступ");
define("_REMOTE_ACCESS_DESC_", "Удалённый доступ позволяет пользователям подписываться на этот календарь с помощью таких программ как Mozilla Sunbird, Windates, или Apple iCal. Таким образом календарь можна будет читать с помощью RSS программ (RssReader, Shrook..),
	на сайтах контент-провайдеров (Yahoo!, MSN..) либо с помощью систем управления контентом (PHP-Nuke, Mambo..).");

define("_ENABLE_REMOTE_ACCESS_UPD_", "Разрешить удалённое обновление. Авторизованные пользователи смогут добавлять события в календарь с помощью дополнительных программ.");

define("_REMOTE_ACCESS_DESC_USERS_", "Если гостевой пользователь не является участником данного календаря, пользователь должен будет ввести своё имя и пароль, чтобы получить доступ. Доступ будет предоставлен либо не предоставлен в зависимости от прав доступа.");

define("_SYNDICATION_", "Синдикация");

define("_EDIT_EVENT_TYPES_", "Редактировать категории");

define("_EVENT_TYPES_", "Категории");

define("_EVENT_TYPES_DESC_", "

       Оставить все невыбранные для поиска по всем категориям - ??? Leave all unselected to use all categories.<BR><BR>");

define("_MULTI_SELECT_WIN_","
       Окна: Чтобы отменить выбор пункта или выбрать несколько<br>неодновременных пунктов, нажмите и удерживайте<br>ctrl.  ");

define("_REALLY_DELETE_EVENT_TYPE_", "В самом деле удалить категорию?"); # question
define("_DELETE_ALL_IN_CATEGORY_", "удалить все события в данной категории.");

define("_VIEWS_NO_ACTION_", "Данное действие невозможно осуществить. Пожалуйста, выберите календарь.");

define("_VIEW_INVALID_CAL_", "Текущий просмотр содержит календарь, участником которого вы не являетесь. События из данного календаря не будут отображаться.");

define("_DESCRIPTION_", "Описание");
define("_DETAILS_", "детали");
define("_PUBLISH_", "опубликовать");
define("_PUBLISH_DESC_", "Опубликовать этот календарь на удалённом сервере или сервисе. Например 
<a class='". _CAL_CSS_BODY_ ." ". _CAL_CSS_ULINE_."' target=_blank
href='http://icalx.com'>iCal Exchange</a>");
define("_SERVER_RESPONSE_", "Ответ сервера");



######################
# EMAIL EVENT
######################
define("_EMAIL_EVENT_", "E-Mail");
define("_EMAIL_TO_", "Кому");
define("_SEND_EMAIL_", "Отправить");
define("_SUBJECT_", "Тема");
define("_MESSAGE_", "Сообщение");
# e.g. The event has been sent to abcdefg@alphabet.com
define("_EMAIL_SENT_TO_", "Данное событие отправлено ");
define("_EMAIL_NO_ADDR_WARNING_", "Внимание: вы не указали адрес своей электронной почты в Настройках контактной информации. Ваш адрес электронной почты будет таким ". @constant("_CAL_MAIL_FROM_"));

######################
# EMAIL SETTINGS
######################
define("_MAIL_PROG_PHP_", "Почтовая функция PHP");
define("_MAIL_PROG_CMD_", "локальный почтовик (sendmail, qmail, etc..)");
define("_MAIL_PROG_SERVER_", "Сервер SMTP");

define("_MAIL_PROGRAM_", "Отсылать почту с помощью");

define("_MAIL_FROM_EMAIL_", "Адрес эл. почты");

define("_MAIL_PATH_", "путь к локальному почтовику");
define("_MAIL_AUTH_", "Аутентификация SMTP");

define("_MAIL_AUTH_USER_", "Имя пользователя SMTP");
define("_MAIL_AUTH_PASS_", "Пароль SMTP");

define("_MAIL_SERVER_", "Сервер SMTP");
define("_MAIL_SERVER_PORT_", "Порт");

##########################
# ATTACHMENT SETTINGS
##########################
define("_ALLOW_ATTACHMENTS_", "Разрешить вложение файлов");
define("_ATTACHMENTS_PATH_", "Путь к файлам");

#############################
# GROUPS AND USERS
#############################
define("_USERS_", "Пользователи");
define("_GROUPS_", "Группы");
define("_EVERYONE_", "Все");
define("_SUPER_USER_", "Суперпользователь");

define("_MEMBERS_", "Участники");
define("_MEMBERS_OF_", "Участники группы");

define("_NAME_", "Имя");
define("_EMAIL_", "Эл. почта");

define("_ACCESS_LVL_", "Уровень доступа");
define("_ROLE_", "Роль");
define("_READ_ONLY_", "Только просмотр");
define("_NORMAL_","Нормальный");

define("_ARE_YOU_SURE_DELETE_GROUP_", "Вы увернены что хотите удалить эту группу?");
define("_GROUPS_SAVE_ATLEAST_1_MEMBER_", "В группе должен быть по крайней мере 1 участник. Список участников не сохранен");

# displayed as form field must begin with a character. E.g.
# Username must begin with a character.
define("_MUST_BEGIN_WITH_CHAR_", "должно начинаться с символа.");

######################
# REMINDERS
######################
define("_REMINDERS_", "Напоминания");
define("_BEFORE_EVENT_","перед этим событием, at");

define("_WILL_OCCUR_IN_", "Начнется через"); # event x will occur in 30 minutes



###########################
# EVEVNT REQUESTS
############################
define("_REQUEST_", "Запрос события");
define("_REQUESTS_", "Запрос событий");
define("_REQUEST_ACCEPTED_", "Ваш запрос события был принят.");
define("_REQUEST_REJECTED_", "Ваш запрос события был отклонён.");

define("_NOTIFY_REQUESTOR_", "Сообщить тому, кто запрашивал");
define("_REQUEST_HAS_NOTIFY_", "Запрашивающий запросил подтверждение.");
define("_REQUESTS_NO_PENDING_", "Нет ожидающих запросов.");
define("_REQUEST_NOTIFY_EMAIL_", "собщить мне про ожидающие запросы по адресу");
define("_REQUEST_MSG_PRE_", "Сообщение, которое увидят пользователи перед отправкой запроса.");
define("_REQUEST_MSG_POST_", "Сообщение, которое увидят пользователи после отправки запроса.");
define("_REQUEST_NOTES_", "Дополнительная информация по запросу");
define("_REQUEST_NOTIFY_STATUS_", "Сообщить мне о статусе этого запроса по адресу");

define("_CONTACT_", "Контакт");

# You have a pending event request on calendar: CALENDAR TITLE
define("_PENDING_REQUEST_", "Вас ожидает запрос на событие в этом календаре:");


#################
# DATE  ITEMS
#################
define("_CALENDAR_", "Календарь");

define("_MONTH_", "Месяц");
define("_MONTHS_", "Месяцы");

define("_DAY_","День");
define("_DAYS_", "Дни");

define("_YEAR_", "Год");
define("_YEARS_", "Годы");

define("_WEEK_", "Неделя");

# abreviated week
define("_WEEK_ABBR_", "Неделя");

define("_WEEKS_", "Недели");

define("_HOUR_", "Час");
define("_HR_", "ч");
define("_HOURS_", "часы");
define("_HRS_", "чс");

define("_MINS_", "мн");
define("_MINUTES_", "минуты");

define("_DATE_", "Дата");
define("_TIME_", "Время");

define("_AM_", "до обеда");
define("_AM_SHORT_", "до");
define("_PM_", "после обеда");
define("_PM_SHORT_", "по");

# VIEWS
define("_TODAY_", "Сегодня");
define("_THIS_WEEK_", "На этой неделе");
define("_THIS_MONTH_", "В этом месяце");

##################
# MISC 
##################
define("_EVENT_", "Событие");
define("_EVENTS_", "События");
define("_VIEW_", "Просмотр");

# VIEW AS A NOUN
define("_VIEW_NOUN_", "Просмотр");

define("_PRINTABLE_VIEW_", "Просмотр для печати");

define("_ALLDAY_", "Весь день");

define("_CAL_CALL_FOR_TIMES_", "Чтобы узнать время, свяжитесь с нами");
define("_CAL_CALL_FOR_TIMES_MIN_", "(*)");

define("_TYPE_","Тип");
define("_EVENT_TYPE_", "Категория");

define("_WIDTH_", "Ширина");

define("_COLORS_", "Цвета");

# list seperator. Note space after comma
define("_LIST_SEP_",", ");

###########################
# ADMIN PAGE 
###########################
define("_GLOBAL_SETTINGS_", "Настройки сайта");
define("_EDIT_DEFAULT_OPTS_", "Параметры по умолчанию");
define("_PASS_MUST_MATCH_", "Вы ввели разные пароли");
define("_EMPTY_PASSWORD_", "Пароль не задан \"\"!");
define("_ARE_YOU_SURE_DELETE_USER_", "Вы уверены, что хотите удалить этого пользователя?");
define("_DELETE_USERS_EVENTS_", "Удалить все события, которые добавил этот пользователь.");
define("_CALENDARS_OWNED_", "Этот пользователь управляет такими календарями");
define("_AUDIT_USERS_", "Аудит пользователей");
define("_AUDIT_USERS_DESC_", "В базе данных Thyme есть пользователи, но нет соотвествующей записи в текущем модуле аутентификации.<br>Все значения записи установлены на uid отсутствующего пользователя.");

define("_CALENDAR_PUBLISHER_", "Издатель Календаря");
define("_CAL_USER_GUEST_", "Пользовательский доступ");
define("_CAL_PUBLISH_GUEST_DISABLED_", "Издатель Календаря не будет работать если пользовательский доступ не разрешен. Пожалуйста, разрешите доступ этому пользователя в секции Пользователи.");


####################################
# GENERAL ACTIONS AND RESPONSES
####################################
define("_ADD_", "Добавить");
define("_NEW_EVENT_", "Новое событие");
define("_REMOVE_", "Удалить");
define("_UPDATE_", "Обновить");
define("_NEXT_", "След.");
define("_PREV_", "Пред.");
define("_DELETE_", "Удалить");
define("_SAVE_", "Сохранить");
define("_TEST_", "Тест");
define("_UPDATE_NOW_", "Обновить сейчас");
define("_SAVE_ADD_", "Сохранить и добавить новое");
define("_CANCEL_", "Отказать");
define("_BROWSE_", "просмотреть");
define("_NONE_", "Ничего");
define("_RESET_", "Обнулить");
define("_CLEAR_ALL_", "Очистить все");
define("_CHECK_ALL_", "Выбрать все");
define("_EDIT_", "Редактировать");
define("_CLOSE_", "Закрыть");
define("_SHOW_", "Показать");
define("_HIDE_", "Скрыть");
define("_ENABLE_", "Включить");
define("_DISABLE_", "Выключить");
define("_MOVE_", "Перенести");
define("_UP_", "Вверх");
define("_DOWN_", "Вних");
define("_ENABLED_", "Включенный");
define("_CONFIGURE_", "Конфигурация");
define("_ACCEPT_", "Принять");
define("_REJECT_", "Отказать");
define("_OK_", "OK");
define("_FAILED_", "НЕ УДАЛОСЬ");
define("_CHANGE_", "Изменить");
define("_SORT_BY_", "Сортировать по");
define("_SEARCH_", "Искать");
define("_FORCE_", "Принудительно");
define("_AUTODETECT_", "Автоопределение");
define("_RESET_PASS_", "Изменить пароль");
define("_NEW_PASS_", "Новый парооль");
define("_RETYPE_", "Повтор ввода");
define("_UPDATED_", "Обновлено");
define("_SUBMITTED_", "Отправлено");
define("_LOGIN_", "Войти");
define("_USERNAME_", "Имя пользователя");
define("_PASSWORD_", "Пароль");
define("_LOGOUT_", "Выйти");
define("_OPTIONS_", "Параметры");
define("_ADMIN_", "Админка");
define("_BAD_PASS_", "Неправильное имя пользователя или паролоь.");
define("_YES_", "Да");
define("_NO_", "Нет");
define("_VALUE_", "Значение");
define("_CUSTOM_", "Специальное");
define("_DEFAULT_", "По умолчанию");

######################
# ATTACHMENTS
######################
define("_ATTACHMENTS_", "Вложения");
define("_ATTACH_DETACH_", "Отсоединить");
define("_ATTACH_DELETE_", "Удалить");
define("_ATTACHMENT_TOO_BIG_", "Размер вложения слишком большой.");
define("_DOWNLOAD_ZIP_", "Загрузить Zip");
define("_UPDATE_ATTACHMENTS_", "Обновить вложения");

define("_BYTES_", "b");
define("_KBYTES_", "КБ");
define("_MBYTES_", "МБ");


#################
# EVENT LIST VIEW 
#################
define("_ALL_", "Все");
define("_UPCOMING_", "Наступающие");
define("_PAST_", "Прошедшие");

define("_SHOWING_", "показываю");
define("_OF_", "из");
define("_FIRST_", "Первая");
define("_LAST_", "Последняя");
define("_SHOW_TYPE_", "Категории");

define("_LIST_SIZE_", "Размер списка");

define("_ARE_NO_EVENTS_", "Событий нет.");

define("_EVENTS_CONTAINING_", "События, в которых найдено"); # used in event search

define("_ARE_YOU_SURE_DELETE_EVENTS_", "Вы уверены, что хотите удалить эти события?");
define("_DELETE_REPEATING_WARNING_", "
   Вы решили удалить одно либо более повторяющихся событий.<br>
   Все записи данного события (прошедшие и наступающие) будут удалены! ");

define("_UNCHECK_NO_DELETE_", "Уберите отметку возле событий, которые вы не хотите удалять:");
define("_DELETE_CHECKED_", "Удалить отмеченные");

define("_RETURN_", "Назад");
define("_ERROR_", "Ошибка!");

######################
# EVENT EDIT/ADD/VIEW
######################
define("_GENERAL_", "Общие");

define("_ORGANIZER_", "Организатор");

define("_URL_", "Адрес сайта");

define("_REPEATING_", "Повторяющееся");

define("_LOCATION_", "Где");

define("_APPLY_TO_", "Применить изменения к");
define("_ALL_DATES_", "всем датам");
define("_THIS_DATE_", "только к этой дате");

define("_RESET_INSTANCE_", "Возвратить параметры этого события к начальному варианту");

define("_MAP_", "Карта");

define("_STARTED_", "Началось");

# e.g. Overrides event Weekly Meeting on 2004-2-34
define("_OVERRIDE_EVNT_ON_", "Аннулирует событие %s в день %s");

# e.g. Warning: the event Event Title has an invalid repeating rule
define("_INVALID_RRULE_", "Внимание: для этого события %s установлено неправильное правило повторения.");

define("_MAX_CHARS_", "макс. кол-во знаков");
define("_EVENT_INFO_", "Информация про событие");
define("_TITLE_", "Заголовок");
define("_NOTES_", "Примечание");

define("_CHECK_FOR_CONFLICTS_", "проверка на пересечения");

define("_THIS_EVENT_ALLDAY_", "Это событие на <b>весь день</b>.");
define("_STARTS_AT_", "Начало в");
define("_DURATION_", "Длительность");

define("_FLAG_", "Знак");
define("_FLAG_THIS_", "Обозначить это событие");
define("_IS_FLAGGED_", "это событие обозначено");

# e.g. 10 days ago
define("_AGO_", "тому назад");

define("_REPEATING_NO_", "Это событие не повторяется.");
define("_REPEATING_REPEAT_", "Повторяется");
define("_REPEATING_SELECTED_", "в определенные дни");
define("_REPEATING_EVERY1_", "каждый");

define("_REPEAT_ON_", "Повторяется каждый");
define("_REPEAT_ON1_", "первый");
define("_REPEAT_ON2_", "второй");
define("_REPEAT_ON3_", "третий");
define("_REPEAT_ON4_", "четвертый");
define("_REPEAT_ON5_", "пятый");
define("_REPEAT_ONL_", "последний");
define("_REPEAT_ON_OF_", "месяца, каждый");

define("_SIMPLE_", "Упрощенно");
define("_ADVANCED_","Расширенно");

define("_YEARLY_", "Ежегодно");
define("_MONTHLY_", "Ежемесячно");
define("_WEEKLY_", "Еженедельно");
define("_DAILY_", "Ежедневно");
define("_EASTER_", "Пасха");
define("_EASTER_YEARLY_", "Ежегодная Пасха");

define("_MONTH_DAYS_", "месяц дней");
define("_FROM_LAST_", "с последнего");

define("_WEEKDAYS_", "Рабочих дней");

define("_YEARLY_NOTES_", "По умолчанию месяц и день берутся из даты начала, если ничего другого не задано.");


define("_SPECIFIC_OCCURRENCES_", "В определенные дни");

define("_STARTING_ON_", "начало в");

define("_BEFORE_", "До");
define("_AFTER_", "После");

define("_EXCLUDE_DATES_", "Исключить даты");

define("_CONFIRM_EVNT_RPT_CHANGE_", "Вы изменяете правило повторения или даты этого события.\n
Все исключения, связанные с этим событием, будут потеряны. Вы уверены, что хотите продолжить?\n");


define("_END_DATE_", "Дата окончания");
define("_END_DATE_NO_", "Без даты окончания");
define("_END_DATE_UNTIL_", "До");
define("_END_DATE_AFTER_", "Закончить после");
define("_OCCURRENCES_", "в определенные");

define("_ADDRESS_", "Адрес");
define("_ADDRESS_1_", "Улица");
define("_ADDRESS_2_", "Город, индекс");

define("_PHONE_", "Телефон");
define("_ICON_", "Знак");

#####################
# MODULES
#####################
define("_NAVBAR_", "Меню навигации");
define("_MODULE_", "Модуль");
define("_MODULES_", "Модули");
define("_TODAY_LINK_", "Ссылка сегодня");
define("_MINI_CAL_", "Мини календарь");
define("_CALENDAR_LINKS_", "Ссылки календаря");
define("_IMAGE_BROWSER_", "Навигатор картинок");
define("_QUICK_ADD_EVNT_", "Быстрое добавление события");
define("_GOTO_DATE_", "Перейти к событию");
define("_SEARCH_EVENTS_", "Искать события");
define("_EVENT_FILTER_", "Категория");
define("_COLOR_LEGEND_", "Надпись");

##################
# SYNC 
##################

define("_SYNC_", "Синхронизация");
define("_IMPORT_", "Импортировать");
define("_EXPORT_", "Экспортировать");
define("_IMPORT_FROM_", "Импортировать из");
define("_EXPORT_TO_", "Экспортировать в");
define("_SYNC_DUPLICATES_", "Если будут дубликаты");
define("_IGNORE_DUPLICATES_", "Игорировать дубликаты");
define("_OVERWRITE_EXISTING_EVENT_", "Перезаписать текущее событие");
define("_CREATE_NEW_EVENT_", "Создать новое событие");
define("_IMPORT_AS_", "Импортировать в категорию");
define("_EVENTS_IMPORTED_", "События проимпортированы");
define("_SYNC_IMPORT_ERROR_", "Произошла ошибка при обработке файла, который вы хотели импортировать.");
define("_HTML_", "HTML");
define("_PLAINTEXT_", "Обычный текст");
define("_ICAL_", "iCalendar (.ics)");
define("_QUIRKS_MODE_", "Режим Quirks");
define("_PERMISSION_DENIED_", "В доступе отказано: вы не являетесь собственником этого события или вы не администратор этого календаря.");
define("_FULL_SYNC_", "Синхронизировать все");
define("_FULL_SYNC_DESC_", "Удалить события, которые есть в Thyme, но отсутствуют в импортируемом файле.");

#########################
# CSS AND STYLE
#########################
define("_COLOR_", "Цвет");

define("_STYLE_", "Стиль");

define("_PREVIEW_", "Предварительный просмотр");
define("_SAMPLE_", "Проба");

define("_BACKGROUND_COLOR_", "Цвен фона");
define("_FONT_COLOR_", "Цвет шрифта");
define("_FONT_SIZE_", "Размер шрифта");

define("_FONT_STYLE_", "Стиль шрифта");
define("_BOLD_", "bold");
define("_ITALICS_", "italics");
define("_UNDERLINE_", "подчёркивание");

define("_FONT_FAMILY_", "Семья шрифтов");
define("_FONT_FAMILY_DESC_", "Например, Tahoma, 'Sans Serif', Arial");

define("_UNDERLINE_LINKS_", "Подчёркивать ссылки");
define("_NEVER_", "Никогда");
define("_ALWAYS_", "Всегда");
define("_HOVER_", "При наведении мышки");
define("_BORDER_COLOR_", "Цвет обводки");
define("_TIME_FONT_COLOR_", "Цвет времени");
define("_TITLE_FONT_COLOR_", "Цвет заголовка");
define("_TITLE_FONT_STYLE_", "Стиль шрифта заголовка");

#########################
# CALENDAR PUBLISHER
#########################
if(@constant("_CAL_DOING_PUBLISHER_")) { # <- leave this line alone

define("_MINI_MONTH_", "Мини месяц");

define("_SET_DATE_CURRENT_", "установить сегодняшнюю дату");
define("_EDITABLE_", "Можна редактировать");
define("_STATIC_", "Статично");
define("_STATIC_DESC_", "в календаре нет ссылок, которые изменяют дату или вид");
define("_HIL_DAY_", "Выделить день");
define("_HIL_WEEK_", "Выделить неделю");

define("_APPLY_CSS_FROM_", "Использовать стиль из");
define("_NO_CSS_", "без CSS");
define("_CSS_EDITOR_", "Редактор стилей");

define("_LANGUAGE_", "Язык");
define("_EURO_DATE_", "Европейский формат даты");
define("_EURO_DATE_DESC_", "Даты будут отображатся в формате дд/мм/гггг");

define("_HEADER_", "Заголовк");
define("_WEEKDAY_HEADER_", "Заголовок дня");

define("_NORMAL_DAYS_", "Обычные дни");
define("_DAYS_NOT_IN_MONTH_", "Дни не в месяце");
define("_HIGHLIGHTED_DAYS_", "Выделенные дни");

define("_NORMAL_EVENTS_", "Обычные события");
define("_FLAGGED_EVENTS_", "Отмеченные события");

define("_SHOW_EVENTS_", "Показать события");


define("_EVENT_LINKS_", "Ссылки на события");

define("_EVENT_LINK_URL_", "Ссылка на сайт");

define("_EVENT_LINK_URL_DESC_", "

        На данную ссылку будет передана строка с 
        <font class='"._CAL_CSS_HIL_."'>eid</font> и <font class='"._CAL_CSS_HIL_."'></font>.<br>

        <b>eid</b> является идентификатором события и <b>запрос</b> есть датой в формате
        <b>ГГГГ-ММ-ДД</b> .<br>Эти параметры записаны в классе <font class='"._CAL_CSS_HIL_."'>%eid</font>
        и <font class='"._CAL_CSS_HIL_."'>%inst</font>.<br><br>

        Например, http://mysite.com/sales/view_sale.php?eid=%eid&instance=%inst may yield:<br>

        http://mysite.com/sales/view_sale.php?<font
		class='"._CAL_CSS_HIL_."'>eid</font>=56&<font
		class='"._CAL_CSS_HIL_."'>instance</font>=2005-10-26<br><br>
 
        За детальной информацией обращайтесь к разделу Reference и/или Tutorial на сайте Thyme. ");


define("_SHOW_HEADER_", "Показать заголовок");
define("_ALIGN_HEADER_TEXT_", "Выровнять заголовок");
define("_CENTER_", "По центру");
define("_HEADER_TEXT_", "Текст заголовка");

define("_HEADER_TEXT_DESC_","

   (Напр., <font class='"._CAL_CSS_HIL_."'>День рождения в %month</font>)<br>
        <font size=1><i>Оставьте незаполненным, чтобы
        использовать заголовок по умолчанию. Другие переменные %weekday, %mday, %mon и %year.</i></font> ");


define("_SHOW_HEADER_LINKS_", "Показывать заголовки ссылок");

define("_NEXT_LINK_", "Ссылка 'След.'");
define("_PREV_LINK_", "Ссылка 'Предыдущий'");

define("_IMG_URL_", "Ссылка на изображение");

define("_HEADER_LINKS_", "Ссылки заголовков");

define("_IMG_URL_DESC_", "
        Это может быть текстом как '<<' или ссылкой на изображение<br>
        (Напр. <font
        class='"._CAL_CSS_HIL_."'>http://www.myserver.com/images/next.gif</font>)<br><font
        size=1><i>Оставьте это поле пустым, чтобы использовать изображение по умолчанию из выбранной темы.</i></font> ");


define("_DAY_VIEW_", "События дня");

define("_MONTH_VIEWS_", "События месяца");

define("_SHOW_WEEKS_DESC_", "Обратите внимание, что в месячном мини календаре не отображаются номера недель");

define("_ROW_HEIGHT_", "Высота строки");
define("_ROW_HEIGHT_DESC_", "По умолчанию '90' для месяца, '0' для мини месяца");

define("_LIMIT_WEEKDAY_NAMES_", "Ограничить названия дней недели до ");
define("_CHARS_", "символов");

define("_EXCLUDE_MONTH_DAYS_", "Исключить дни, отсутствующие в месяце");

define("_MINI_MONTH_DATE_URL_", "Ссылка на месячный мини-календарь");

define("_MINI_MONTH_DATE_URL_DESC_", "
        Ссылка по которой прозойдет переход, если нажать на день в месячном мини-календаре. Произойдет замена следующих строк:<br>

        %d = номер дня<br>
        %m = номер месяца<br>
        %y = номер года<br>

        <br><br>

        Например http://www.myserver.com/page.php?day=%d&month=%m&year=%y<br>
        будет выглядеть таким образом
        <font class='"._CAL_CSS_HIL_."'>http://www.myserver.com/page.php?day=23&month=11&year=2004</font>

        <br>либо вы можете использовать функции JavaScript.<br>

        Например <font class='"._CAL_CSS_HIL_."'>javascript:myFunction(%y,%m,%d)</font><br><br>

        По умолчанию ссылка ведет на текущую страницу, на которой устанавливается:<br>
        д = %d<br>
		м = %m<br>
        г = %y<br>

        Например <font class='"._CAL_CSS_HIL_."'>index.php?d=23&m=11&y=2004</font><br><br>
        За детальной информацией обращайтесь к разделу Reference и/или Tutorial на сайте Thyme.");


define("_GENERATED_CODE_", "Сгенерированный код");

define("_BASE_PATH_DESC_", "основной (base) путь к thyme с последующием слэшем");
define("_BASE_URL_DESC_", "основной урл (url) к thyme с последующим слэшем");

} # </ CALENDAR PUBLISHER SECTION > <- leave this line alone


######################
#
### RSS FEED MODULES
#
#####################
define("_RSS_FEED_MODULES_", "Модули RSS");
define("_RSS_", "Получение обновлений через RSS");
define("_UPDATE_INTERVAL_", "Интервал обновления");
define("_ARE_YOU_SURE_DELETE_RSSMOD_", "Вы уверены, что хотите удалить этот RSS модуль?");
define("_AUTHOR_", "Автор");

# scrolling
define("_SCROLLING_","Прокрутка");
define("_OVERFLOW_", "Превышение");
define("_SCROLLBAR_", "Прокутка");
define("_AUTOSCROLL_", "Автоматическая прокрутка");


# this will keep us from needing to
# have these defined when not looking
# at options
#####################################
if(@constant("_CAL_DOING_OPTS_")) { # <- leave this line alone

######################
# OPTION STRINGS
######################

define("_DEFAULT_VIEW_", "Вид по умолчанию");

define("_DEFAULT_CALENDAR_", "Календарь по умолчанию");

define("_TIME_INTERVALS_", "Временной интервал");

define("_EVNT_SIZE_", "Размер события");
define("_SMALLER_", "Небольшой");
define("_SMALLEST_", "Наименьший");
define("_EVNT_COLLAPSE_", "Свернуть события (Просмотр месяца)");
define("_EVNT_COLLAPSE_DESC_", "Свернуть длинные заголовки событий.");
define("_EVNT_TYPE_NAME_", "Показывать названия категорий");
define("_EVNT_POPUP_", "Поп-ап события");
define("_EVNT_POPUP_DESC_", "Показывать события в новом окне.");
define("_EVNT_NOTES_POPUP_", "Открывать примечания в поп-апе");
define("_EVNT_NOTES_POPUP_DESC_", "Наведите мышку на события, чтобы просмотреть примечания.");

define("_POSITION_", "Место размещения");

define("_SHOW_WEEKS_", "Показывать номера недель");

define("_WEEK_START_", "Неделя начинается в");
define("_WORK_HOURS_", "Рабочие часы");
define("_WORK_HOURS_START_", "начало");
define("_WORK_HOURS_END_", "завершение");

define("_HOUR_FORMAT_", "Часовой формат");
define("_HOUR_FORMAT_12_", "12 часов");
define("_HOUR_FORMAT_24_", "24 часа");

define("_LOCALE_", "Язык");

define("_NAV_BAR_LOC_", "Меню навигации");
define("_RIGHT_", "Справа");
define("_LEFT_", "Слева");

define("_TIMEZONE_", "Часовая зона");
define("_DST_", "Переход на летнее время");
define("_STARTS_", "Начинается");
define("_ENDS_", "Завершается");

define("_IN_", "в");
define("_ON_", "ВКЛ");
define("_OFF_", "ВЫКЛ");

define("_THEME_", "Тема");

##########################
# CONTACT OPTIONS
##########################
define("_CONTACT_OPTS_", "Параметры связи");
define("_PRIMARY_", "Основной");
define("_FORMAT_", "Формат");

##########################
# SUBSCRIPTIONS
##########################
define("_SUBSCRIPTIONS_", "Подписки");
define("_SUBSCRIPTIONS_DESC_", "Подписка на E-mail разсылку обновлений в календаре.");

######################
# NOTIFICATIONS
#####################
define("_NOTIFICATIONS_", "Уведомления");
define("_NOTIFICATIONS_DESC_", "Фильтры уведомления для новых и обновленых событиях.");

define("_TITLE_CONTAINS_", "Заголовок содержит");
# event X has been updated on calendar Y
define("_UPDATED_ON_", "было обновлено в");
# event X has been added to calendar Y
define("_ADDED_TO_", "было добавлено в");

#####################
# DST STRINGS
#####################
define("_DST_OPTS1_", "Африка / Египет");
define("_DST_OPTS2_", "Африка / Намибия");
define("_DST_OPTS3_", "Азия / быв. СССР - большинство стран");
define("_DST_OPTS4_", "Азия / Ирак");
define("_DST_OPTS5_", "Азия / Ливан, Киргизстан");
define("_DST_OPTS6_", "Азия / Сирия");
define("_DST_OPTS7_", "Австралазия / Австралия, Новый Южный Уэльс");
define("_DST_OPTS8_", "Австралазия / Австралия - Тасмания");
define("_DST_OPTS9_", "Австралазия / Новая Зеландия, Чатам");
define("_DST_OPTS10_", "Австралазия / Тонга");
define("_DST_OPTS11_", "Европа / Европейский Союз, Великобритания, Гренландия");
define("_DST_OPTS12_", "Европа / Россия - Украина - Беларусь");
define("_DST_OPTS13_", "Северная Америка / США, Канада, Мексика");
define("_DST_OPTS14_", "Северная Америка / Куба");
define("_DST_OPTS15_", "Южная Америка / Чили");
define("_DST_OPTS16_", "Южная Америка / Парагвай");
define("_DST_OPTS17_", "Южная Америка / Фолклендские о-ва");

####################
# TIMEZONE STRINGS
####################
define("_GMT_PLUS_0.0_","GMT +00:00 Британия, Ирландия, Португалия, Западная Африка");
define("_GMT_PLUS_0.5_","GMT +00:30 ");
define("_GMT_PLUS_1.0_","GMT +01:00 Западная Европа, Центральная Африка");
define("_GMT_PLUS_1.5_","GMT +01:30 ");
define("_GMT_PLUS_2.0_","GMT +02:00 Восточная Европа, Восточная Африка");
define("_GMT_PLUS_2.5_","GMT +02:30 ");
define("_GMT_PLUS_3.0_","GMT +03:00 Европейская часть России, Саудовская Аравия");
define("_GMT_PLUS_3.5_","GMT +03:30 ");
define("_GMT_PLUS_4.0_","GMT +04:00 Иран");
define("_GMT_PLUS_4.5_","GMT +04:30 ");
define("_GMT_PLUS_5.0_","GMT +05:00 Западная Азия, Пакистан");
define("_GMT_PLUS_5.5_","GMT +05:30 Индия");
define("_GMT_PLUS_6.0_","GMT +06:00 Центральная Азия");
define("_GMT_PLUS_6.5_","GMT +06:30 ");
define("_GMT_PLUS_7.0_","GMT +07:00 Бангкок, Ханой, Джакарта");
define("_GMT_PLUS_7.5_","GMT +07:30 ");
define("_GMT_PLUS_8.0_","GMT +08:00 Китай, Сингапур, Тайвань");
define("_GMT_PLUS_8.5_","GMT +08:30 ");
define("_GMT_PLUS_9.0_","GMT +09:00 Корея, Япония");
define("_GMT_PLUS_9.5_","GMT +09:30 Центральная Австралия");
define("_GMT_PLUS_10.0_","GMT +10:00 Восточная Австралия");
define("_GMT_PLUS_10.5_","GMT +10:30 ");
define("_GMT_PLUS_11.0_","GMT +11:00 Центральный Тихий");
define("_GMT_PLUS_11.5_","GMT +11:30 ");
define("_GMT_PLUS_12.0_","GMT +12:00 Фиджи, Новая Зеландия");
define("_GMT_MINUS_12.0_","GMT -12:00 Меридиан смены дат ");
define("_GMT_MINUS_11.5_","GMT -11:30 ");
define("_GMT_MINUS_11.0_","GMT -11:00 Самоа");
define("_GMT_MINUS_10.5_","GMT -10:30 ");
define("_GMT_MINUS_10.0_","GMT -10:00 Гавайи");
define("_GMT_MINUS_9.5_","GMT -09:30 ");
define("_GMT_MINUS_9.0_","GMT -09:00 Аляска");
define("_GMT_MINUS_8.5_","GMT -08:30 ");
define("_GMT_MINUS_8.0_","GMT -08:00 Западное побережье США/Канады");
define("_GMT_MINUS_7.5_","GMT -07:30 ");
   define("_GMT_MINUS_7.0_","GMT -07:00 Горное время США");
   define("_GMT_MINUS_6.5_","GMT -06:30 ");
   define("_GMT_MINUS_6.0_","GMT -06:00 Центральное время США");
   define("_GMT_MINUS_5.5_","GMT -05:30 ");
   define("_GMT_MINUS_5.0_","GMT -05:00 Восточное побережье США/Канады, Колумбия, Перу");
   define("_GMT_MINUS_4.5_","GMT -04:30 ");
   define("_GMT_MINUS_4.0_","GMT -04:00 Боливия, Западная Бразилия, Чили");
   define("_GMT_MINUS_3.5_","GMT -03:30 Ньюфаундленд");
   define("_GMT_MINUS_3.0_","GMT -03:00 Аргентина, Восточная Бразилия, Гренландия");
   define("_GMT_MINUS_2.5_","GMT -02:30 ");
   define("_GMT_MINUS_2.0_","GMT -02:00 Центральная часть Атлантики");
   define("_GMT_MINUS_1.5_","GMT -01:30 ");
   define("_GMT_MINUS_1.0_","GMT -01:00 Азорские острова");
   define("_GMT_MINUS_0.5_","GMT -00:30 ");
   
   }
   
   ##########################
   # ERRORS AND WARNINGS
   ##########################
   define("_WARNING_ATTACH_", "Внимание: Директории для вложенных файлов %s не существует или нет прав на запись в неё.");
   define("_WARNING_RSS_", "Внимание: нет прав на запись в место хранения RSS потоков %s.");
   define("_WARNING_INSTALL_", "Внимание: %s до сих пор присутствует. Пожалуйста, удалите файл.");
   define("_WARNING_LICENSE_", "Внимание: лицензия на Thyme закончится через %s дней.");
   
   
   # date formats
   #
   # see PHP's documentation for
   # 'date' for more format options 
   # some are:
   # j = day of the month
   # n = month number
   # Y = full year number
   #################################
   define("_DATE_INT_FULL_", "n/j/Y");
   define("_DATE_INT_NOYR_", "n/j"); # only used in Week view
   
   
   # alphabet chars
   ####################
   global $_cal_alphabet;
   $_cal_alphabet = array('А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П','Р',
      'С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я');
   
   #####################
   # "AUTOMAGIC" 
   #####################
   # weekdays
   global $_cal_weekdays, $_cal_weekdays_abbr, $_cal_months, $_cal_months_abbr;
   
   $_cal_weekdays or $_cal_weekdays = array(
     "Воскресенье",
     "Понедельник",
     "Вторник",
     "Среда",
     "Четверг",
     "Пятница",
     "Суббота");
   
   $_cal_months or $_cal_months = array(1 => 
     "Январь",
     "Февраль",
     "Март",
     "Апрель",
     "Май",
     "Июнь",
     "Июль",
     "Август",
     "Сентябрь",
     "Октябрь",
     "Ноябрь",
     "Декабрь");
   
   
   
if(function_exists("mb_internal_encoding")) {
   
   mb_internal_encoding("UTF-8");
   
   for($i = 0; $i < 7; $i++)
   {
      $_cal_weekdays_abbr[$i] = mb_substr($_cal_weekdays[$i],0,3);
   }
   
   # months
   for($i = 1; $i < 13; $i++)
   {
      $_cal_months_abbr[$i] = mb_substr($_cal_months[$i],0,3);
   }
   
} else {

   for($i = 0; $i < 7; $i++)
   {
      $_cal_weekdays_abbr[$i] = substr($_cal_weekdays[$i],0,3);
   }
   
   # months
   for($i = 1; $i < 13; $i++)
   {
      $_cal_months_abbr[$i] = substr($_cal_months[$i],0,3);
   }
   
}

?>
