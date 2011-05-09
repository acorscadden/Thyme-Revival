<?php


#
# With this set to 1, Nov 2nd 2004 would look
# like 2/11/2004 where applicable. With it
# set to 0, it would look like 11/2/2004.
#
# all date selects are also affected bu this
# as they will be day-month-year
#
# German Translation by Ralf Kuehnbaum-Grashorn, <ralf@kuehnbaum.de> 
# 1.st complete translation  11-2005
# Update Version 1.3         11-04-2006
#
###########################################
define("_CAL_EURO_DATE_", 1);

define("_CHARSET_", "iso-8859-1");

define("_LANG_NAME_", "German (DE)");

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
define("_GLOBAL_VIEWS_", "Übersicht");

define("_ALLOW_EVERYONE_VIEW_", "Erlaube Jedem alle Kalender in dieser Ansicht zu sehen, unabhängig von Ihren Mitgliederberechtigungen");

define("_HIDE_VIEW_FROM_GUESTS_", "Diese Ansicht vor Gast-Benutzern verbergen.");

define("_REQUEST_NOTIFY_OWNER_", "Benachrichtige Kalender-Eigentümer über ausstehende Ereigniswünsche");

define("_ALL_CALENDARS_", "Alle Kalender");

#################################
#
### INSTALLER 
#
#################################

# some of these will not be used until 2.0
define("_INSTALLER_", "Installer");
define("_PACKAGE_", "Packet");
define("_INSTALL_", "Installiere");
define("_INVALID_PACKAGE_", "Die hochgeladene Datei ist kein gültiges Thyme-Paket.");
define("_INSTALLED_MODULES_", "Installierte Module");
define("_UNINSTALL_", "Entfernen");
define("_LOCAL_FILE_","Lokale Datei");
define("_UPDATES_", "Updates");
define("_AVAILABLE_UPDATES_", "Verfügbare Updates");
define("_CHECK_FOR_UPDATES_", "Suche nach Updates");
define("_LAST_CHECKED_ON_", "Zuletzt überprüft am"); # e.g. last checked on 1/2/2007
define("_FILE_", "Datei");
define("_WRITABLE_", "Beschreibbar");
define("_REFRESH_", "Aktualisieren");
define("_INVALID_DOWNLOAD_", "Ungültiger Download. Update der Datei unmöglich.");
define("_UNABLE_TO_BACKUP_", "Sicherungskopie der aktuellen Datei nicht durchführbar.");
define("_UPDATES_AVAIL_", "%s Updates verfügbar"); # %s will be replaced w/# of updates available

############################
#
### NEW USER DEFINITIONS
#
###########################
define("_REGISTERED_USERS_", "Registrierte Benutzer");
define("_PUBLIC_", "Öffentlich");
define("_PUBLIC_ACCESS_", "Öffentlicher Zugang");

#############################
#
### MULTIPLE REMINDERS
#
#############################
define("_BEFORE_EVENT_MULTI_", "vor diesem Ereignis");
define("_USER_CAN_NOT_VIEW_", "%s hat keine Bereichtigung diesen Kalender zu betrachten.");
define("_ALLOW_CONFIGURE_REMINDERS_", "Erlaube %s Ereigniserinnerungen für alle Benutzer einzurichten.");
define("_CALENDAR_ADMINS_", "Kalender Administratoren");
define("_EVENT_OWNER_", "Ereigniseigentümer");
define("_SITE_ADMINS_", "Site Administratoren");
define("_NO_ONE_", "Niemand");

###############################
#
## CONFIGURABLE JOB INTERVALS
#
###############################

define("_REMIND_AT_LEAST_", "Mindestens");
define("_SCHEDULED_TASK_", "Geplante Aufgaben");
define("_NO_SCHEDULED_TASK_", "Thyme wurde nicht für die automatische Ausführung der geplanten Aufgaben konfiguriert");
define("_SCHEDULED_TASK_CONFIGURED_", "Intervall für die geplanten Aufgaben");
define("_PHP_CLI_", "Pfad zur PHP CLI");

###################################
#
### CUSTOMIZE SITE
#
###################################
define("_CUSTOMIZE_SITE_", "Site Anpassung");
define("_SITE_NAME_", "Name der Site");
define("_SITE_THEME_", "Site Motiv");
define("_SITE_THEME_DESC_", "Auswahl von <strong>Kein</strong> erlaubt es Benutzern eigene Motive zu wählen.");

# use exact HTML tags, they will be displayed correctly
# when printed
define("_SITE_HEADER_", "Site Header-Bereich");
define("_SITE_HEADER_DESC_", "Nach dem <body>-Tag");

define("_SITE_FOOTER_", "Site Fußbereich");
define("_SITE_FOOTER_DESC_", "Vor dem </body>-Tag");

define("_SITE_HEAD_", "Site Kopf");
define("_SITE_HEAD_DESC_", "Zwischen den <head>- und </head>-Tags.");


####################################
#
### LICENSE KEY
#
####################################
define("_ENTER_LICENSE_KEY_", "Geben Sie den Lizenzschlüssel ein");
define("_LICENSE_KEY_", "Lizenzschlüssel");
define("_LICENSE_KEY_ACCEPTED_", "Der Lizenzschlüssel wurde akzeptiert");
define("_INVALID_LICENSE_KEY_", "Der von Ihnen eingegebene Lizenzschlüssel ist <strong>ungültig</strong> für diese Site bzw. diesen Domainnamen.");

####################################
#
### EVENT REQUEST DESCRIPTION
#
####################################
define("_REQUEST_MODE_VIEW_ONLY_", "Mitglieder mit \"Nur Ansehen\"-Berechtigung dürfen Ereignis-Anfragen stellen. Normale Benutzer tragen Ereignisse direkt ein.");

define("_REQUEST_MODE_NORMAL_", "Mitglieder mit \"Nur Ansehen\"-Berechtigung dürfen den Kalender nur einsehen. Normale Benutzer dürfen Ereignisse eintragen.");

#####################################
#
### TELL A FRIEND FOR GUEST E-MAILS
#
######################################
define("_TELL_A_FRIEND_", "Einem Freund empfehlen");

define("_YOUR_NAME_", "Ihr Name");
define("_YOUR_EMAIL_", "Ihre E-mail Adresse");

define("_YOUR_FRIENDS_NAME_","Name Ihres Freundes");
define("_YOUR_FRIENDS_EMAIL_","E-mail Adresse Ihres Freundes");

define("_EMAIL_EVENT_DISPLAYED_","Das Ereignis wird unterhalb Ihrer Nachricht angezeigt werden.");

define("_ALLOW_GUEST_USERS_EMAIL_", "Erlaube Gastbenutzern Ereignisse per E-Mail zu versenden.");

define("_DISABLE_SITE_ADDR_BOOK_", "Deaktiviere das Adressbuch für Nicht-Admninistratoren.");

define("_EMAIL_TO_MULTIPLE_", "Trennen Sie mehrere Adressen mit Kommatas.");

# MISC
########
define("_HELP_", "Hilfe");
define("_WARNING_DIR_NOT_WRITABLE_", "Warnung: Das Verzeichnis %s ist nicht beschreibbar.");
define("_WARNING_FILE_NOT_WRITABLE_", "Warnung: Die Datei %s ist nicht beschreibbar.");
define("_DOWNLOAD_", "Download");
define("_HIDE_QUICK_ADD_", "Verberge die Schnelleingabe für Ereignisse");
define("_FORCE_DEFAULT_OPTS_", "Erzwinge Standardoptionen für alle Benutzer. Setze diese im Bereich Admin - Voreinstellungen bearbeiten.");
define("_NO_GUEST_TIMEZONE_", "Erlaube Gastbenutzern nicht, die Zeitzone zu ändern.");
define("_NUMBER_SYMBOL_", '#');
define("_DISABLE_WYSIWYG_EDITOR_", "Deaktiviere WYSIWYG-Editor für Ereignis-Notizen.");
define("_SHOW_CALENDAR_NAMES_", "Zeige Kalendernamen wenn \"Zeige Eventkategorien\" in den Benutzer-Optionen aktiviert ist.");
define("_MISC_", "Diverse");
define("_THEME_POPUPS_", "Weise Motiv Ereignisnotizen-PopUps zu.");

define("_PUBLIIC_", "Öffentlich");
define("_REGISTERED_USERS_", "Registrierte Benutzer");

define("_NEW_", "Neu");

define("_CATEGORY_EDIT_DESC_", "Klicke auf den Titel um eine Kategorie zu bearbeiten");

define("_ARE_YOU_SURE_DELETE_", "Sind Sie sicher, daß Sie %s löschen wollen?");

define("_LIST_SEP_", ", ");

########## END NEW TRANSLATIONS #################


################################
# EDIT / VIEW / POST CALENDARS
################################
define("_CALENDARS_", "Kalender");
define("_OWNER_", "Eigentümer");
define("_ARE_YOU_SURE_DELETE_CALENDAR_", "Sind Sie sicher, daß Sie diesen Kalender löschen wollen?");

define("_COLOR_BY_", "Färbe Ereignisse in");
define("_BY_OWNER_", "Ereigniseigentümer");
define("_BY_CATEGORY_", "Ereignis Kategorie");
define("_BY_CALENDAR_", "Kalender");

define("_MODE_", "Modus");

define("_ALLOW_MULTI_CATS_", "Erlaube mehrere Kategorien für Ereignisse");

define("_REMEMBER_LOCATIONS_", "An Orte erinnern");

define("_STRICT_EVENT_SECURITY_", "Strenge Ereignis Sicherheit");
define("_STRICT_EVENT_SECURITY_DESC_", "Nur Ereigniseigentümer oder Kalenderadministratoren dürfen Ereignisse modifizieren oder löschen.");

define("_REMOTE_ACCESS_", "Fernzugriff");
define("_REMOTE_ACCESS_DESC_", "Der Fernzugriff erlaubt es Benutzern mittels einer Anwendung, 
	wie z.B. Mozilla Sunbird, Windates, oder Apple iCal diesen Kalender zu abonnieren. Hiermit 
	wird auch RSS Syndication zur Benutzung mit RSS Readern (RssReader, Shrook..), durch 
	Content-Anbieter (Yahoo!, MSN..) und mittels Content Management Systemen (PHP-Nuke, Mambo..) aktiviert.");

define("_ENABLE_REMOTE_ACCESS_UPD_", "Aktiviere Aktualisierung (Veröffentlichung) durch autorisierte Benutzer 
mithilfe einer entsprechenden Anwendung (Sunbird, Windates, oder Apple iCal).");

define("_REMOTE_ACCESS_DESC_USERS_", "Wenn der <i>Gast</i>-Benutzer nicht Mitglied dieses Kalenders ist, 
	benötigen Personen, die diesen Kalender nutzen wollen einen Benutzernamen und Kennwort.
	Nach der Authentifizierung wird gemäß den Mitgliedseinstellungen Zugang gewährt oder verweigert.");

define("_SYNDICATION_", "Syndication");

define("_EDIT_EVENT_TYPES_", "Kategorien bearbeiten");

define("_EVENT_TYPES_", "Kategorien");

define("_EVENT_TYPES_DESC_", "Um alle Kategorien zu nutzen, keine Auswahl treffen.<BR><BR>");

define("_MULTI_SELECT_WIN_","
       Windows: Um eine Position zu deselektieren oder mehrere, nicht übereinstimmende Positionen auszuwählen<br>
       drücken Sie zeitgleich die CTRL (STRG)-Taste.");

define("_REALLY_DELETE_EVENT_TYPE_", "Kategorie wirklich löschen?"); # question
define("_DELETE_ALL_IN_CATEGORY_", "lösche alle Ereignisse in dieser Kategorie.");

define("_VIEWS_NO_ACTION_", "Diese Aktion kann nicht in einer Kombinierten Ansicht ausgeführt werden. 
        Bitte wählen Sie dazu den entsprechenden Kalender aus.");

define("_VIEW_INVALID_CAL_", "Die aktuelle Kombinierte Ansicht enthält einen Kalender zu dem Sie keinen Zugriff haben. 
Ereignisse dieses Kalenders werden nicht angezeigt.");

define("_DESCRIPTION_", "Beschreibung");
define("_DETAILS_", "Details");
define("_PUBLISH_", "Publizieren");
define("_PUBLISH_DESC_", "Veröffentlichen Sie diesen Kalender auf einer Website oder einem Kalenderdienst, wie z.B. 
<a class='". _CAL_CSS_BODY_ ." ". _CAL_CSS_ULINE_."' target=_blank
href='http://icalx.com'>iCal Exchange</a>");
define("_SERVER_RESPONSE_", "Rückmeldung des Servers");



######################
# EMAIL EVENT
######################
define("_EMAIL_EVENT_", "E-Mail");
define("_EMAIL_TO_", "An");
define("_SEND_EMAIL_", "Sende");
define("_SUBJECT_", "Betreff");
define("_MESSAGE_", "Nachricht");
# e.g. The event has been sent to abcdefg@alphabet.com
define("_EMAIL_SENT_TO_", "Das Ereignis wurde gesendet an ");
define("_EMAIL_NO_ADDR_WARNING_", "Warnung: Sie haben bisher keine Absender E-Mail Adresse unter Kontakt Optionen definiert.
Daher wird die E-Mail folgenden Absender tragen: ". @constant("_CAL_MAIL_FROM_"));

######################
# EMAIL SETTINGS
######################
define("_MAIL_PROG_PHP_", "PHP's Mail Funktion");
define("_MAIL_PROG_CMD_", "Lokaler mailer (sendmail, qmail, etc..)");
define("_MAIL_PROG_SERVER_", "SMTP Server");

define("_MAIL_PROGRAM_", "Sende Mail mittels");

define("_MAIL_FROM_EMAIL_", "E-mail Adresse");

define("_MAIL_PATH_", "Pfad zum lokalen mailer");
define("_MAIL_AUTH_", "SMTP Authentifizierung");

define("_MAIL_AUTH_USER_", "SMTP Benutzername");
define("_MAIL_AUTH_PASS_", "SMTP Kennwort");

define("_MAIL_SERVER_", "SMTP Server");
define("_MAIL_SERVER_PORT_", "Server Port");

##########################
# ATTACHMENT SETTINGS
##########################
define("_ALLOW_ATTACHMENTS_", "Erlaube Dateianhänge");
define("_ATTACHMENTS_PATH_", "Pfad für Dateianhänge");

#############################
# GROUPS AND USERS
#############################
define("_USERS_", "Benutzer");
define("_GROUPS_", "Gruppen");
define("_EVERYONE_", "Jeder");
define("_SUPER_USER_", "Superuser");

define("_MEMBERS_", "Mitglieder");
define("_MEMBERS_OF_", "Mitglieder von");

define("_NAME_", "Name");
define("_EMAIL_", "E-Mail");

define("_ACCESS_LVL_", "Zugriffsberechtigung");
define("_ROLE_", "Rolle");
define("_READ_ONLY_", "Nur Betrachten");
define("_NORMAL_","Normal");

define("_ARE_YOU_SURE_DELETE_GROUP_", "Wollen Sie diese Gruppe wirklich löschen?");
define("_GROUPS_SAVE_ATLEAST_1_MEMBER_", "Gruppen müssen mindestens 1 Mitglied haben. 
Die Mitgliederliste wurde nicht gespeichert.");

# displayed as form field must begin with a character. E.g.
# Username must begin with a character.
define("_MUST_BEGIN_WITH_CHAR_", "muss mit einem Buchstaben beginnen.");

######################
# REMINDERS
######################
define("_REMINDERS_", "Erinnerungen");
define("_BEFORE_EVENT_","vor diesem Ereignis, um");

define("_WILL_OCCUR_IN_", "Wird auftreten in"); # event x will occur in 30 minutes



###########################
# EVEVNT REQUESTS
############################
define("_REQUEST_", "Ereigniswunsch");
define("_REQUESTS_", "Ereigniswünsche");
define("_REQUEST_ACCEPTED_", "Ihr Ereigniswunsch wurde akzeptiert.");
define("_REQUEST_REJECTED_", "Ihr Ereigniswunsch wurde abgelehnt.");

define("_NOTIFY_REQUESTOR_", "Benachrichtige Autor des Ereigniswunsches.");
define("_REQUEST_HAS_NOTIFY_", "Der Autor des Ereigniswunsches bittet um Benachrichtigung.");
define("_REQUESTS_NO_PENDING_", "Es gibt zur Zeit keine Ereigniswünsche.");
define("_REQUEST_NOTIFY_EMAIL_", "Benachrichtige mich über anstehende Ereigniswünsche wenn");
define("_REQUEST_MSG_PRE_", "Nachricht an Benutzer <b>vor</b> dem Absenden des Ereigniswunsches.");
define("_REQUEST_MSG_POST_", "Nachricht an Benutzer <b>nach</b> dem Absenden des Ereigniswunsches.");
define("_REQUEST_NOTES_", "Zusätzliche Notizen");
define("_REQUEST_NOTIFY_STATUS_", "Melde mir den Status des Ereigniswunsches, wenn");

define("_CONTACT_", "Kontakt");

# You have a pending event request on calendar: CALENDAR TITLE
define("_PENDING_REQUEST_", "Sie haben einen anstehenden Ereigniswunsch im Kalender:");


#################
# DATE  ITEMS
#################
define("_CALENDAR_", "Kalender");

define("_MONTH_", "Monat");
define("_MONTHS_", "Monat(e)");

define("_DAY_","Tag");
define("_DAYS_", "Tag(e)");

define("_YEAR_", "Jahr");
define("_YEARS_", "Jahr(e)");

define("_WEEK_", "Woche");
define("_WEEKS_", "Woche(n)");

# abreviated week
define("_WEEK_ABBR_", "KW");

define("_HOUR_", "Stunde");
define("_HR_", "h");
define("_HOURS_", "Stunden");
define("_HRS_", "h");

define("_MINS_", "min");
define("_MINUTES_", "Minuten");

define("_DATE_", "Datum");
define("_TIME_", "Zeit");

define("_AM_", "am");
define("_AM_SHORT_", "a");
define("_PM_", "pm");
define("_PM_SHORT_", "pm");

# VIEWS
define("_TODAY_", "Heute");
define("_THIS_WEEK_", "Diese Woche");
define("_THIS_MONTH_", "Dieser Monat");

##################
# MISC 
##################
define("_EVENT_", "Ereignis");
define("_EVENTS_", "Ereignisse");
define("_VIEW_", "Kombinierte Ansicht");

# VIEW AS A NOUN
define("_VIEW_NOUN_", "Kombinierte Ansicht");

define("_PRINTABLE_VIEW_", "Druckbare Ansicht");

define("_ALLDAY_", "Ganztags");

define("_CAL_CALL_FOR_TIMES_", "Anzahl Kontaktversuche");
define("_CAL_CALL_FOR_TIMES_MIN_", "(*)");

define("_TYPE_","Art");
define("_EVENT_TYPE_", "Kategorie");

define("_WIDTH_", "Breite");

define("_COLORS_", "Farben");


###########################
# ADMIN PAGE 
###########################
define("_GLOBAL_SETTINGS_", "Lokale Einstellungen");
define("_EDIT_DEFAULT_OPTS_", "Voreinstellungen bearbeiten");
define("_PASS_MUST_MATCH_", "Die eingegebenen Kennwörter stimmen nicht überein.");
define("_EMPTY_PASSWORD_", "Das Kennwort darf nicht  \"\" lauten!");
define("_ARE_YOU_SURE_DELETE_USER_", "Wollen Sie wirklich diesen Benutzer löschen?");
define("_DELETE_USERS_EVENTS_", "Lösche alle Ereignisse dieses Benutzers.");
define("_CALENDARS_OWNED_", "Kalender dieses Benutzers");
define("_AUDIT_USERS_", "Überprüfe Benutzer");
define("_AUDIT_USERS_DESC_", "Es wurden Benutzer in Thyme's Datenbank gefunden, 
aber kein entsprechender Eintrag im aktiven Authentifizierungsmodul.<br>
Alle Benutzerdaten wurden auf die Benutzerkennung des fehlenden Benutzers gesetzt.");

define("_CALENDAR_PUBLISHER_", "Kalender Veröffentlichung");
define("_CAL_USER_GUEST_", "Gastzugang");
define("_CAL_PUBLISH_GUEST_DISABLED_", "Die Veröffentlich des Kalenders wird nicht vorgenommen, wenn der Gastzugang deaktiviert wurde.  
Bitte aktivieren Sie den Gastzugang im Bereich Benutzereinstellungen.");


####################################
# GENERAL ACTIONS AND RESPONSES
####################################
define("_ADD_", "Hinzufügen");
define("_NEW_EVENT_", "Neues Ereignis");
define("_REMOVE_", "Entfernen");
define("_UPDATE_", "Aktualisieren");
define("_NEXT_", "Weiter");
define("_PREV_", "Zurück");
define("_DELETE_", "Löschen");
define("_SAVE_", "Speichern");
define("_TEST_", "Testen");
define("_UPDATE_NOW_", "Jetzt aktualisieren");
define("_SAVE_ADD_", "Speichern und hinzufügen");
define("_CANCEL_", "Abbrechen");
define("_BROWSE_", "Blättern");
define("_NONE_", "Kein");
define("_RESET_", "Zurücksetzen");
define("_CLEAR_ALL_", "Markierungen löschen");
define("_CHECK_ALL_", "Alle markieren");
define("_EDIT_", "Bearbeiten");
define("_CLOSE_", "Schließen");
define("_SHOW_", "Zeige");
define("_HIDE_", "Ausblenden");
define("_ENABLE_", "Aktivieren");
define("_DISABLE_", "Deaktivieren");
define("_MOVE_", "Bewegen");
define("_UP_", "Aufwärts");
define("_DOWN_", "Abwärts");
define("_ENABLED_", "Aktiv");
define("_CONFIGURE_", "Konfigurieren");
define("_ACCEPT_", "Übernehmen");
define("_REJECT_", "Verwerfen");
define("_OK_", "OK");
define("_FAILED_", "FEHLGESCHLAGEN");
define("_CHANGE_", "Wechseln");
define("_SORT_BY_", "Sortieren nach");
define("_SEARCH_", "Suche");
define("_FORCE_", "Erzwingen");
define("_AUTODETECT_", "Automatische Erkennung");
define("_RESET_PASS_", "Kennwort ändern");
define("_NEW_PASS_", "Neues Kennwort");
define("_RETYPE_", "Neu eingeben");
define("_UPDATED_", "aktualisiert");
define("_SUBMITTED_", "Übertragen");
define("_LOGIN_", "Anmelden");
define("_USERNAME_", "Benutzername");
define("_PASSWORD_", "Kennwort");
define("_LOGOUT_", "Abmelden");
define("_OPTIONS_", "Optionen");
define("_ADMIN_", "Admin");
define("_BAD_PASS_", "Falscher Benutzername oder Kennwort.");
define("_YES_", "Ja");
define("_NO_", "Nein");
define("_VALUE_", "Wert");
define("_CUSTOM_", "Benutzerspezifisch");
define("_DEFAULT_", "Vorgabe");

######################
# ATTACHMENTS
######################
define("_ATTACHMENTS_", "Anhänge");
define("_ATTACH_DETACH_", "Lösen");
define("_ATTACH_DELETE_", "Löschen");
define("_ATTACHMENT_TOO_BIG_", "Der Anhang ist grösser als die max. erlaubte Größe.");
define("_DOWNLOAD_ZIP_", "Lade als Zip-Archiv");
define("_UPDATE_ATTACHMENTS_", "Anhänge aktualisieren");

define("_BYTES_", "b");
define("_KBYTES_", "KB");
define("_MBYTES_", "MB");


#################
# EVENT LIST VIEW 
#################
define("_ALL_", "Alle");
define("_UPCOMING_", "Anstehende");
define("_PAST_", "Vergangene");

define("_SHOWING_", "zeige");
define("_OF_", "von");
define("_FIRST_", "Beginn");
define("_LAST_", "Ende");
define("_SHOW_TYPE_", "Kategorie");

define("_LIST_SIZE_", "Listengrösse");

define("_ARE_NO_EVENTS_", "Keine Ereignisse vorhanden.");

define("_EVENTS_CONTAINING_", "Suche nach"); # used in event search

define("_ARE_YOU_SURE_DELETE_EVENTS_", "Wollen Sie diese Ereignisse wirklich löschen?");
define("_DELETE_REPEATING_WARNING_", "
	Sie haben sich entschieden ein oder mehrere wiederholende Ereignisse zu löschen<br>
	Alle Vorkommnisse (vergangene und zukünftige) dieser Ereignisse werden gelöscht werden! ");

define("_UNCHECK_NO_DELETE_", "Entfernen Sie Markierung für alle Ereignisse, die Sie nicht löschen möchten:");
define("_DELETE_CHECKED_", "Lösche markierte Ereignisse");

define("_RETURN_", "Zurückkehren");
define("_ERROR_", "Fehler!");

######################
# EVENT EDIT/ADD/VIEW
######################
define("_GENERAL_", "Allgemein");

define("_ORGANIZER_", "Organizer");

define("_URL_", "URL");

define("_REPEATING_", "Wiederholung");

define("_LOCATION_", "Ort");

define("_APPLY_TO_", "Vollziehe Änderungen an");
define("_ALL_DATES_", "allen Daten");
define("_THIS_DATE_", "diesem Datum ausschließlich");

define("_RESET_INSTANCE_", "Rücksetzen auf Originalzustand");

define("_MAP_", "Karte");

define("_STARTED_", "Gestartet");

# e.g. Overrides event Weekly Meeting on 2004-2-34
define("_OVERRIDE_EVNT_ON_", "Hebt Ereignis %s am %s auf");

# e.g. Warning: the event Event Title has an invalid repeating rule
define("_INVALID_RRULE_", "Warnung: Das Ereignis %s hat eine eine ungültige Wiederholungsregel.");

define("_MAX_CHARS_", "max. Anzahl Zeichen");
define("_EVENT_INFO_", "Ereignis Informationen");
define("_TITLE_", "Titel");
define("_NOTES_", "Notizen");

define("_CHECK_FOR_CONFLICTS_", "Auf Konflikte prüfen");

define("_THIS_EVENT_ALLDAY_", "Dies ist ein <b>ganztägiges</b> Ereignis.");
define("_STARTS_AT_", "Beginnt um");
define("_DURATION_", "Dauer");

define("_FLAG_", "Markieren");
define("_FLAG_THIS_", "Markiere dieses Ereignis");
define("_IS_FLAGGED_", "Dieses Ereignis ist markiert");

# e.g. 10 days ago
define("_AGO_", "her");

define("_REPEATING_NO_", "Dieses Ereignis wird nicht wiederholt.");
define("_REPEATING_REPEAT_", "Wiederhole");
define("_REPEATING_SELECTED_", "ausgewählte Tage");
define("_REPEATING_EVERY1_", "");

define("_REPEAT_ON_", "Wiederhole an jedem");
define("_REPEAT_ON1_", "ersten");
define("_REPEAT_ON2_", "zweiten");
define("_REPEAT_ON3_", "dritten");
define("_REPEAT_ON4_", "vierten");
define("_REPEAT_ON5_", "fünften");
define("_REPEAT_ONL_", "letzten");
define("_REPEAT_ON_OF_", "des Monats, für");

define("_SIMPLE_", "Einfach");
define("_ADVANCED_","Erweitert");

define("_YEARLY_", "jährlich");
define("_MONTHLY_", "monatlich");
define("_WEEKLY_", "wöchentlich");
define("_DAILY_", "täglich");
define("_EASTER_", "Ostern");
define("_EASTER_YEARLY_", "Ostern jährlich");

define("_MONTH_DAYS_", "Monatstag(e)");
define("_FROM_LAST_", "vom letzten");

define("_WEEKDAYS_", "Wochentag(e)");

define("_YEARLY_NOTES_", "Monat und Tag werden dem Startdatum entnommen, wenn hier nicht anders definiert.");


define("_SPECIFIC_OCCURRENCES_", "Spezielle Vorkommen");

define("_STARTING_ON_", "beginnt am");

define("_BEFORE_", "Vor");
define("_AFTER_", "Nach");

define("_EXCLUDE_DATES_", "Ausgeschlossene Daten");

 define("_CONFIRM_EVNT_RPT_CHANGE_", "Sie sind im Begriff die Wiederholungsregeln \nbzw. Daten dieses Ereignisses zu ändern.
 Alle Ausnahmen, die mit diesem Ereignis verbunden sind, gehen verloren! Sind Sie sicher?\n");


define("_END_DATE_", "Enddatum");
define("_END_DATE_NO_", "Kein Enddatum");
define("_END_DATE_UNTIL_", "bis");
define("_END_DATE_AFTER_", "Endet nach");
define("_OCCURRENCES_", "Vorkommen");

define("_ADDRESS_", "Anschrift");
define("_ADDRESS_1_", "Strasse");
define("_ADDRESS_2_", "Stadt, PLZ");

define("_PHONE_", "Telefon");
define("_ICON_", "Icon");

#####################
# MODULES
#####################
define("_NAVBAR_", "Navigationsleiste");
define("_MODULE_", "Modul");
define("_MODULES_", "Module");
define("_TODAY_LINK_", "Heute");
define("_MINI_CAL_", "Minikalender");
define("_CALENDAR_LINKS_", "Kalender Links");
define("_IMAGE_BROWSER_", "Bild Browser");
define("_QUICK_ADD_EVNT_", "Express Ereigniseingabe");
define("_GOTO_DATE_", "Gehe zu Datum");
define("_SEARCH_EVENTS_", "Ereignisse suchen");
define("_EVENT_FILTER_", "Kategorie");
define("_COLOR_LEGEND_", "Legende");

##################
# SYNC 
##################

define("_SYNC_", "Synchronisierung");
define("_IMPORT_", "Import");
define("_EXPORT_", "Export");
define("_IMPORT_FROM_", "Importieren von");
define("_EXPORT_TO_", "Exportieren nach");
define("_SYNC_DUPLICATES_", "Wenn Duplikate gefunden werden");
define("_IGNORE_DUPLICATES_", "Ignoriere Duplikate");
define("_OVERWRITE_EXISTING_EVENT_", "Überschreibe existierendes Ereignis");
define("_CREATE_NEW_EVENT_", "Erzeuge neues Ereignis");
define("_IMPORT_AS_", "Importieren in Kategorie");
define("_EVENTS_IMPORTED_", "Importierte Ereignisse");
define("_SYNC_IMPORT_ERROR_", "Fehler: Es trat ein Fehler beim Einlesen der Importdatei auf.");
define("_HTML_", "HTML");
define("_PLAINTEXT_", "Klartext");
define("_ICAL_", "iCal Format (.ics)");
define("_QUIRKS_MODE_", "Spezialmodus");
define("_PERMISSION_DENIED_", "Zugriff verweigert: sie sind nicht der Eigentümer dieses Ereignisses oder der Administrator dieses Kalenders.");
define("_FULL_SYNC_", "Vollständige Synchronisierung");
define("_FULL_SYNC_DESC_", "Lösche Ereignisse die in Thyme existieren aber nicht in der Importdatei gefunden wurden.");

#########################
# CSS AND STYLE
#########################
define("_COLOR_", "Farbe");

define("_STYLE_", "Style");

define("_PREVIEW_", "Vorschau");
define("_SAMPLE_", "Beispiel");

define("_BACKGROUND_COLOR_", "Hintergrundfarbe");
define("_FONT_COLOR_", "Zeichenfarbe");
define("_FONT_SIZE_", "Zeichengröße");

define("_FONT_STYLE_", "Zeichenstil");
define("_BOLD_", "fett");
define("_ITALICS_", "kursiv");
define("_UNDERLINE_", "unterstrichen");

define("_FONT_FAMILY_", "Zeichensatzfamilie");
define("_FONT_FAMILY_DESC_", "z.B. Tahoma, 'Sans Serif', Arial");

define("_UNDERLINE_LINKS_", "Unterstreiche Links");
define("_NEVER_", "Niemals");
define("_ALWAYS_", "Immer");
define("_HOVER_", "Hover");
define("_BORDER_COLOR_", "Rahmenfarbe");
define("_TIME_FONT_COLOR_", "Zeit Zeichenfarbe");
define("_TITLE_FONT_COLOR_", "Titel Zeichenfarbe");
define("_TITLE_FONT_STYLE_", "Title Zeichenstil");

#########################
# CALENDAR PUBLISHER
#########################
if(@constant("_CAL_DOING_PUBLISHER_")) { # <- leave this line alone

define("_MINI_MONTH_", "Mini Monat");

define("_SET_DATE_CURRENT_", "setze auf heutiges Datum");
define("_EDITABLE_", "Editierbar");
define("_STATIC_", "Statisch");
define("_STATIC_DESC_", "Der Kalender enthält keine Links um Datum oder Ansicht zu wechseln.");
define("_HIL_DAY_", "Tag hervorheben");
define("_HIL_WEEK_", "Woche hervorheben");

define("_APPLY_CSS_FROM_", "Weise Style zu aus:");
define("_NO_CSS_", "kein CSS");
define("_CSS_EDITOR_", "Style Editor");

define("_LANGUAGE_", "Sprache");
define("_EURO_DATE_", "Datum Europäisches Format");
define("_EURO_DATE_DESC_", "Daten werde mit Datumsformat dd/mm/yyyy angezeigt, wo zutreffend.");

define("_HEADER_", "Kopfbereich");
define("_WEEKDAY_HEADER_", "Kopfbereich Wochentage");

define("_NORMAL_DAYS_", "Normale Tage");
define("_DAYS_NOT_IN_MONTH_", "Tage ausserhalb des Monats");
define("_HIGHLIGHTED_DAYS_", "Hervorgehobene Tage");

define("_NORMAL_EVENTS_", "Normale Ereignisse");
define("_FLAGGED_EVENTS_", "Markierte Ereignisse");

define("_SHOW_EVENTS_", "Zeige Ereignisse");


define("_EVENT_LINKS_", "Ereignis Links");

define("_EVENT_LINK_URL_", "Ereignis Link URL");

define("_EVENT_LINK_URL_DESC_", "

        An diese URL werden die Parameter 
        <font class='"._CAL_CSS_HIL_."'>eid</font> und <font class='"._CAL_CSS_HIL_."'>instance</font> angehängt.<br>

        <b>eid</b> ist die ID des Ereignisses und <b>instance</b> ist das Datum im Format 
        <b>YYYY-MM-DD</b>.<br>Diese werden <font class='"._CAL_CSS_HIL_."'>%eid</font>
        und <font class='"._CAL_CSS_HIL_."'>%inst</font> notiert.<br><br>

        Beispiel: http://mysite.com/sales/view_sale.php?eid=%eid&instance=%inst entspicht z.B.:<br>

        http://mysite.com/sales/view_sale.php?<font
		class='"._CAL_CSS_HIL_."'>eid</font>=56&<font
		class='"._CAL_CSS_HIL_."'>instance</font>=2005-10-26<br><br>
 
        Beachten Sie dazu die Referenzdokumentation und /oder das Tutorial auf der Thyme Website.
        ");


define("_SHOW_HEADER_", "Zeige Kopfbereich");
define("_ALIGN_HEADER_TEXT_", "Text im Kopfbereich ausrichten.");
define("_CENTER_", "Mitte");
define("_HEADER_TEXT_", "Text im Kopfbereich");

define("_HEADER_TEXT_DESC_","

   (Beispiel: <font class='"._CAL_CSS_HIL_."'>Geburtstage im %month</font>)<br>
        <font size=1><i>Keine Eingabe zeigt die Standardtexte im Kopfbereich.
        <br />Weitere Variablen sind %weekday, %mday, %mon und %year.</i></font> ");


define("_SHOW_HEADER_LINKS_", "Zeige Kopfbereich Links");

define("_NEXT_LINK_", "'Nächster' link");
define("_PREV_LINK_", "'Vorheriger' link");

define("_IMG_URL_", "Bild URL");

define("_HEADER_LINKS_", "Kopfbereich Links");

define("_IMG_URL_DESC_", "
        Dies kann Text, wie etwa '<<' oder eine URL zu einem Bild sein<br>
        (z.B. <font
        class='"._CAL_CSS_HIL_."'>http://www.myserver.com/images/next.gif</font>)<br><font
        size=1><i>Keine Eingabe um das entsprechende Bild aus dem ausgewälten Motiv zu nutzen.</i></font> ");


define("_DAY_VIEW_", "Tagesansicht");

define("_MONTH_VIEWS_", "Monatsansicht");

define("_SHOW_WEEKS_DESC_", "Der Mini Monats Kalender zeigt niemals Wochennummern an.");

define("_ROW_HEIGHT_", "Zeilenhöhe");
define("_ROW_HEIGHT_DESC_", "Voreingestellt ist '90' für einen  Monat, '0' for a mini month");

define("_LIMIT_WEEKDAY_NAMES_", "Begrenze Tagesnamen auf ");
define("_CHARS_", "Zeichen");

define("_EXCLUDE_MONTH_DAYS_", "Tage ausserhalb des Monats ausschließen");

define("_MINI_MONTH_DATE_URL_", "URL des Monats aus Mini Monat");

define("_MINI_MONTH_DATE_URL_DESC_", "
		Dies ist die Basis URL für die Tages Links im Mini Monats Kalender.
		Dieses ersetzt folgende Zeichenketten:<br>

        %d = Tag im Monat (numerisch)<br>
        %m = Monatsnummer<br>
        %y = Jahreszahl<br>

        <br><br>

        Beispiel: http://www.myserver.com/page.php?day=%d&month=%m&year=%y<br>
        enstspricht 
        <font class='"._CAL_CSS_HIL_."'>http://www.myserver.com/page.php?day=23&month=11&year=2004</font>

        <br>Sie können aber auch eine Javascript-Funktion nutzen.<br>

        Beispiel: <font class='"._CAL_CSS_HIL_."'>javascript:myFunction(%y,%m,%d)</font><br><br>

        Standardmäßig wird auf die aktuelle Seite mit folgenden Parametern verwiesen:<br>
        m = %m<br>
        d = %d<br>
        y = %y<br>

        Beispiel: <font class='"._CAL_CSS_HIL_."'>index.php?d=23&m=11&y=2004</font><br><br>
        Beachten Sie dazu die Referenzdokumentation und /oder das Tutorial auf der Thyme Website.
        ");


define("_GENERATED_CODE_", "Generierter Code");

define("_BASE_PATH_DESC_", "Pfad zu Thyme mit abschließendem slash (/)");
define("_BASE_URL_DESC_", "Basis url von Thyme mit abschließendem slash (/)");

} # </ CALENDAR PUBLISHER SECTION > <- leave this line alone


######################
#
### RSS FEED MODULES
#
#####################
define("_RSS_FEED_MODULES_", "RSS Feed Modul");
define("_RSS_", "RSS Feeds");
define("_UPDATE_INTERVAL_", "Update-Intervall");
define("_ARE_YOU_SURE_DELETE_RSSMOD_", "Möchten Sie wirklich dieses RSS Modul löschen?");
define("_AUTHOR_", "Autor");

# scrolling
define("_SCROLLING_","Rollen");
define("_OVERFLOW_", "Überlauf");
define("_SCROLLBAR_", "Bildlaufleiste");
define("_AUTOSCROLL_", "Automatisches Rollen");


# this will keep us from needing to
# have these defined when not looking
# at options
#####################################
if(@constant("_CAL_DOING_OPTS_")) { # <- leave this line alone

######################
# OPTION STRINGS
######################

define("_DEFAULT_VIEW_", "Standardansicht");

define("_DEFAULT_CALENDAR_", "Standardkalender");

define("_TIME_INTERVALS_", "Zeitintervall");

define("_EVNT_SIZE_", "Anzahl Zeilen Ereignisanzeige");
define("_SMALLER_", "Kleiner");
define("_SMALLEST_", "Kleinste");
define("_EVNT_COLLAPSE_", "Ereignisse zusammenklappen <br />(Monats Ansicht)");
define("_EVNT_COLLAPSE_DESC_", "Lange Ereignistitel zusammenfassen.");
define("_EVNT_TYPE_NAME_", "Zeige Eventkategorien");
define("_EVNT_POPUP_", "Ereignis Popup");
define("_EVNT_POPUP_DESC_", "Zeige Ereignisdetails in neuem Fenster.");
define("_EVNT_NOTES_POPUP_", "Ereignisnotizen Popup");
define("_EVNT_NOTES_POPUP_DESC_", "Positioniere Mauszeiger über einem Ereignis um die Notizen dazu anzuzeigen.");

define("_POSITION_", "Position");

define("_SHOW_WEEKS_", "Zeige Kalenderwoche");

define("_WEEK_START_", "Woche beginnt am");
define("_WORK_HOURS_", "Arbeitszeit");
define("_WORK_HOURS_START_", "beginnt um");
define("_WORK_HOURS_END_", "endet um");

define("_HOUR_FORMAT_", "Stundenformat");
define("_HOUR_FORMAT_12_", "12 Stunden");
define("_HOUR_FORMAT_24_", "24 Stunden");

define("_LOCALE_", "Datum/Uhrzeit");

define("_NAV_BAR_LOC_", "Navigationsleiste");
define("_RIGHT_", "Rechts");
define("_LEFT_", "Links");

define("_TIMEZONE_", "Zeitzone");
define("_DST_", "Sommerzeit");
define("_STARTS_", "Beginnt");
define("_ENDS_", "Endet");

define("_IN_", "in");
define("_ON_", "An");
define("_OFF_", "Aus");

define("_THEME_", "Motiv");

##########################
# CONTACT OPTIONS
##########################
define("_CONTACT_OPTS_", "Kontakt Optionen");
define("_PRIMARY_", "Hauptadresse");
define("_FORMAT_", "Format");

##########################
# SUBSCRIPTIONS
##########################
define("_SUBSCRIPTIONS_", "Abonnement");
define("_SUBSCRIPTIONS_DESC_", "E-mail Abonnements für Kalender.");

######################
# NOTIFICATIONS
#####################
define("_NOTIFICATIONS_", "Benachrichtigungen");
define("_NOTIFICATIONS_DESC_", "Benachrichtigungenfilter für neue und aktualisierte Ereignisse.");

define("_TITLE_CONTAINS_", "Titel beinhaltet");
# event X has been updated on calendar Y
define("_UPDATED_ON_", "wurde aktualisiert am");
# event X has been added to calendar Y
define("_ADDED_TO_", "wurde hinzugefügt zu");

#####################
# DST STRINGS
#####################
define("_DST_OPTS1_", "Afrika / Ägypten");
define("_DST_OPTS2_", "Afrika / Namibia");
define("_DST_OPTS3_", "Asien / UDSSR (frühere) - die meisten Staaten");
define("_DST_OPTS4_", "Asien / Irak");
define("_DST_OPTS5_", "Asien / Libanon, Kirgisistan");
define("_DST_OPTS6_", "Asien / Syrien");
define("_DST_OPTS7_", "AustralAsien / Australie, New Süd Wales");
define("_DST_OPTS8_", "AustralAsien / Australien - Tasmanien");
define("_DST_OPTS9_", "AustralAsien / Neuseeland, Chatham");
define("_DST_OPTS10_", "AustralAsien / Tonga");
define("_DST_OPTS11_", "Europa / Europäische Union, England, Grönland");
define("_DST_OPTS12_", "Europa / Russland");
define("_DST_OPTS13_", "Nord Amerika / USA, Kanada, Mexiko");
define("_DST_OPTS14_", "Nord Amerika / Kuba");
define("_DST_OPTS15_", "Süd Amerika / Chile");
define("_DST_OPTS16_", "Süd Amerika / Paraguay");
define("_DST_OPTS17_", "Süd Amerika / Falkland Inseln");

####################
# TIMEZONE STRINGS
####################
define("_GMT_PLUS_0.0_","GMT +00:00 Britannien, Irland, Portugal, Westafrika ");
define("_GMT_PLUS_0.5_","GMT +00:30 ");
define("_GMT_PLUS_1.0_","GMT +01:00 West Europa, Zentral Afrika");
define("_GMT_PLUS_1.5_","GMT +01:30 ");
define("_GMT_PLUS_2.0_","GMT +02:00 Ost Europa, Ost Afrika");
define("_GMT_PLUS_2.5_","GMT +02:30 ");
define("_GMT_PLUS_3.0_","GMT +03:00 Russland, Saudi Arabia");
define("_GMT_PLUS_3.5_","GMT +03:30 ");
define("_GMT_PLUS_4.0_","GMT +04:00 Arabian");
define("_GMT_PLUS_4.5_","GMT +04:30 ");
define("_GMT_PLUS_5.0_","GMT +05:00 West Asien, Pakistan");
define("_GMT_PLUS_5.5_","GMT +05:30 Indien");
define("_GMT_PLUS_6.0_","GMT +06:00 Zentral Asien");
define("_GMT_PLUS_6.5_","GMT +06:30 ");
define("_GMT_PLUS_7.0_","GMT +07:00 Bangkok, Hanoi, Jakarta");
define("_GMT_PLUS_7.5_","GMT +07:30 ");
define("_GMT_PLUS_8.0_","GMT +08:00 China, Singapur, Taiwan");
define("_GMT_PLUS_8.5_","GMT +08:30 ");
define("_GMT_PLUS_9.0_","GMT +09:00 Korea, Japan");
define("_GMT_PLUS_9.5_","GMT +09:30 Zentral Australien");
define("_GMT_PLUS_10.0_","GMT +10:00 Ost Australien");
define("_GMT_PLUS_10.5_","GMT +10:30 ");
define("_GMT_PLUS_11.0_","GMT +11:00 Zentral Pacifik");
define("_GMT_PLUS_11.5_","GMT +11:30 ");
define("_GMT_PLUS_12.0_","GMT +12:00 Fiji, Neuseeland");
define("_GMT_MINUS_12.0_","GMT -12:00 Datumsgrenze ");
define("_GMT_MINUS_11.5_","GMT -11:30 ");
define("_GMT_MINUS_11.0_","GMT -11:00 Samoa");
define("_GMT_MINUS_10.5_","GMT -10:30 ");
define("_GMT_MINUS_10.0_","GMT -10:00 Hawai");
define("_GMT_MINUS_9.5_","GMT -09:30 ");
define("_GMT_MINUS_9.0_","GMT -09:00 Alaska/Pitcairn Inseln");
define("_GMT_MINUS_8.5_","GMT -08:30 ");
define("_GMT_MINUS_8.0_","GMT -08:00 USA/Kanada/Pazifik");
define("_GMT_MINUS_7.5_","GMT -07:30 ");
define("_GMT_MINUS_7.0_","GMT -07:00 USA/Kanada/Mountain");
define("_GMT_MINUS_6.5_","GMT -06:30 ");
define("_GMT_MINUS_6.0_","GMT -06:00 USA/Kanada/Zentral");
define("_GMT_MINUS_5.5_","GMT -05:30 ");
define("_GMT_MINUS_5.0_","GMT -05:00 USA/Kanada/Ost, Kolumbien, Peru");
define("_GMT_MINUS_4.5_","GMT -04:30 ");
define("_GMT_MINUS_4.0_","GMT -04:00 Bolivien, West Brasilien, Chile, Atlantik");
define("_GMT_MINUS_3.5_","GMT -03:30 Neufundland");
define("_GMT_MINUS_3.0_","GMT -03:00 Argentinen, Ost Brasilien, Grönland");
define("_GMT_MINUS_2.5_","GMT -02:30 ");
define("_GMT_MINUS_2.0_","GMT -02:00 Mid-Atlantik");
define("_GMT_MINUS_1.5_","GMT -01:30 ");
define("_GMT_MINUS_1.0_","GMT -01:00 Azoren/Ost Atlantik");
define("_GMT_MINUS_0.5_","GMT -00:30 ");

}

##########################
# ERRORS AND WARNINGS
##########################
define("_WARNING_ATTACH_", "Warnung: Verzeichnis für Dateianhänge %s existiert nicht oder ist nicht beschreibbar.");
define("_WARNING_RSS_", "Warnung: RSS feed Verzeichnis %s ist nicht beschreibbar.");
define("_WARNING_INSTALL_", "Warnung: %s existiert noch. Bitte entfernen Sie diese Datei.");
define("_WARNING_LICENSE_", "Warnung: Thyme's Lizenz läuft in %s Tagen ab.");


# date formats
#
# see PHP's documentation for
# 'date' for more format options 
# some are:
# j = day of the month
# n = month number
# Y = full year number
#################################
# define("_DATE_INT_FULL_", "n/j/Y");
# define("_DATE_INT_NOYR_", "n/j"); # only used in Week view

define("_DATE_INT_FULL_", "d.m.Y");
define("_DATE_INT_NOYR_", "d.m"); # only used in Week view


# alphabet chars
####################
global $_cal_alphabet;
$_cal_alphabet = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P',
   'Q','R','S','T','U','V','W','X','Y','Z');

#####################
# "AUTOMAGIC" 
#####################
# weekdays
global $_cal_weekdays, $_cal_weekdays_abbr, $_cal_months, $_cal_months_abbr;

$_cal_weekdays = array(
  "Sonntag",
  "Montag",
  "Dienstag",
  "Mittwoch",
  "Donnerstag",
  "Freitag",
  "Samstag");

$_cal_months = array(1 => 
  "Januar",
  "Februar",
  "März",
  "April",
  "Mai",
  "Juni",
  "Juli",
  "August",
  "September",
  "Oktober",
  "November",
  "Dezember");


################## END OF TRANSLATION ######################

for($i = 0; $i < 7; $i++)
{
   $_cal_weekdays_abbr[$i] = substr($_cal_weekdays[$i],0,3);
}

# months
for($i = 1; $i < 13; $i++)
{
   $_cal_months_abbr[$i] = substr($_cal_months[$i],0,3);
}



?>
