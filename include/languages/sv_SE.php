<?php

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

define("_CHARSET_", "iso-8859-1");

define("_LANG_NAME_", "Swedish");

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
define("_GLOBAL_VIEWS_", "Globala vyer");

define("_ALLOW_EVERYONE_VIEW_", "Till�t alla anv�ndare att se alla kalendrar i denna visning, oavsett deras medlemslista");

define("_HIDE_VIEW_FROM_GUESTS_", "G�m denna visning f�r gestanv�ndare");

define("_REQUEST_NOTIFY_OWNER_", "Informera kalender�gare om obesvarade f�rfr�gningar");

define("_ALL_CALENDARS_", "Alla-kalendrar visning");

#################################
#
### INSTALLER 
#
#################################

# some of these will not be used until 2.0
define("_INSTALLER_", "Installerare");
define("_PACKAGE_", "Paket");
define("_INSTALL_", "Installera");
define("_INVALID_PACKAGE_", "Dokumentet som du har laddat upp �r inte giltigt Thyme paket.");
define("_INSTALLED_MODULES_", "Installerade moduler");
define("_UNINSTALL_", "Avinstallera");
define("_LOCAL_FILE_","Lokalt dokument");
define("_UPDATES_", "Uppdateringar");
define("_AVAILABLE_UPDATES_", "Tillg�ngliga uppdateringar");
define("_CHECK_FOR_UPDATES_", "Kontrollera uppdateringar");
define("_LAST_CHECKED_ON_", "Senast kontrollerat"); # e.g. last checked on 1/2/2007
define("_FILE_", "Dokument");
define("_WRITABLE_", "Skrivbar(t)");
define("_REFRESH_", "Uppdatera");
define("_INVALID_DOWNLOAD_", "Ogiltig nerladdning. Kan inte uppdatera dokumentet.");
define("_UNABLE_TO_BACKUP_", "Kan inte s�kerhetskopiera aktuellt dokument.");
define("_UPDATES_AVAIL_", "%s uppdateringar tillg�ngliga"); # %s will be replaced w/# av tillg�ngliga uppdateringar

############################
#
### NEW USER DEFINITIONS
#
###########################
define("_REGISTERED_USERS_", "Registrerade anv�ndare");
define("_PUBLIC_", "Allm�nt");
define("_PUBLIC_ACCESS_", "Allm�nt tilltr�de");

#############################
#
### MULTIPLE REMINDERS
#
#############################
define("_BEFORE_EVENT_MULTI_", "f�re denna h�ndelse");
define("_USER_CAN_NOT_VIEW_", "%s har inte tilltr�de att se denna kalender.");
define("_ALLOW_CONFIGURE_REMINDERS_", "Till�ta %s att konfigurera h�ndelsep�minnelse f�r alla anv�ndare.");
define("_CALENDAR_ADMINS_", "Kalender-administrerare");
define("_EVENT_OWNER_", "H�ndelse�gare");
define("_SITE_ADMINS_", "Webbplats-administrerare");
define("_NO_ONE_", "Ingen");

###############################
#
## CONFIGURABLE JOB INTERVALS
#
###############################

define("_REMIND_AT_LEAST_", "�tminstone");
define("_SCHEDULED_TASK_", "Schemalagd uppgift");
define("_NO_SCHEDULED_TASK_", "Den Thyme schemalagda uppgiften �r inte konfigurerad att k�ras");
define("_SCHEDULED_TASK_CONFIGURED_", "Den Thyme schemalagda uppgiften �r konfigurerad att k�ras varje");
define("_PHP_CLI_", "PHP CLI plats");

###################################
#
### CUSTOMIZE SITE
#
###################################
define("_CUSTOMIZE_SITE_", "Anpassa webbplats");
define("_SITE_NAME_", "Webbplatsens namn");
define("_SITE_THEME_", "Webbplatsens mall");
define("_SITE_THEME_DESC_", "Satt till 'Ingen' till�ter anv�ndare att v�lja sin egen mall");

# use exact HTML tags, they will be displayed correctly
# when printed
define("_SITE_HEADER_", "Webbplatsens sidhuvud");
define("_SITE_HEADER_DESC_", "Efter <body> taggen");

define("_SITE_FOOTER_", "Webbplatsens sidfot");
define("_SITE_FOOTER_DESC_", "F�re </body> taggen");

define("_SITE_HEAD_", "Webbplatsens top");
define("_SITE_HEAD_DESC_", "Mellan <head> </head> taggar.");

####################################
#
### LICENSE KEY
#
####################################
define("_ENTER_LICENSE_KEY_", "Sl� in licens-nyckeln");
define("_LICENSE_KEY_", "Licens-nyckel");
define("_LICENSE_KEY_ACCEPTED_", "Licens-nyckel accepterad");
define("_INVALID_LICENSE_KEY_", "Licens-nyckeln som du har slagit in �r inte giltig f�r denna webbplats");

####################################
#
### EVENT REQUEST DESCRIPTION
#
####################################
define("_REQUEST_MODE_VIEW_ONLY_", "Medlemmar med endast l�sr�ttigheter kan l�mna in h�ndelsef�rfr�gningar. Normala medlemmar kan l�gga till h�ndelser direkt.");
define("_REQUEST_MODE_NORMAL_", "Medlemmar med endast l�sr�ttigheter kan endast se kalendern. Normala medlemmar kan l�mna in h�ndelsef�rfr�gningar.");

#####################################
#
### TELL A FRIEND FOR GUEST E-MAILS
#
######################################
define("_TELL_A_FRIEND_", "Ber�tta f�r en v�n");

define("_YOUR_NAME_", "Ditt namn");
define("_YOUR_EMAIL_", "Din e-post adress");

define("_YOUR_FRIENDS_NAME_","Din v�ns namn");
define("_YOUR_FRIENDS_EMAIL_","Din v�ns e-post adress");

define("_EMAIL_EVENT_DISPLAYED_","H�ndelsen kommer att visas nedanf�r ditt meddelande.");

define("_ALLOW_GUEST_USERS_EMAIL_", "Till�t g�stanv�ndare att skicka h�ndelser med e-post .");

define("_DISABLE_SITE_ADDR_BOOK_", "St�nga av webbplatsens adressbok f�r icke-administrat�rer");

define("_EMAIL_TO_MULTIPLE_", "Separera multipla adresser med kommatecken.");

# MISC
########
define("_HELP_", "Hj�lp");
define("_WARNING_DIR_NOT_WRITABLE_", "Varning: Mappen %s �r inte skrivbar.");
define("_WARNING_FILE_NOT_WRITABLE_", "Varning: Dokumentet %s �r inte skrivbart.");
define("_DOWNLOAD_", "Ladda ner");
define("_HIDE_QUICK_ADD_", "G�m 'Snabbtill�gg av h�ndelse' boxen");
define("_FORCE_DEFAULT_OPTS_", "Tvinga f�rvalda alternativ f�r alla anv�ndare. S�tt i 'Admin - F�rvalda alternativ.");
define("_NO_GUEST_TIMEZONE_", "Till�t inte g�stanv�ndare att �ndra tidzon.");
define("_NUMBER_SYMBOL_", '#');
define("_DISABLE_WYSIWYG_EDITOR_", "St�nga av WYSIWYG editorn f�r h�ndelsenoteringar.");
define("_SHOW_CALENDAR_NAMES_", "Visa kalendernamn n�r 'Visa h�ndelsekategorinamn' �r satt i anv�ndaralternativ.");
define("_MISC_", "Diverse");
define("_THEME_POPUPS_", "Anv�nd mall vid h�ndelsenoteringar-popups.");

define("_PUBLIIC_", "Allm�nt");
define("_REGISTERED_USERS_", "Registrerade anv�ndare");

define("_NEW_", "Ny");

define("_CATEGORY_EDIT_DESC_", "Klicka p� kategorinamnet f�r att redigera en kategori");

define("_ARE_YOU_SURE_DELETE_", "�r du s�ker p� att du vill ta bort denna %s?");

########## END NEW TRANSLATIONS #################




################################
# EDIT / VIEW / POST CALENDARS
################################
define("_CALENDARS_", "Kalendrar");
define("_OWNER_", "�gare");
define("_ARE_YOU_SURE_DELETE_CALENDAR_", "�r du s�ker p� att du vill radera kalendern?");

define("_COLOR_BY_", "Tilldela f�rg enligt");
define("_BY_OWNER_", "H�ndelsens �gare");
define("_BY_CATEGORY_", "H�ndelsekategori");
define("_BY_CALENDAR_", "Kalender");

define("_MODE_", "Mode");

define("_ALLOW_MULTI_CATS_", "Till�t flera kategorier f�r h�ndelser");

define("_REMEMBER_LOCATIONS_", "Kom ih�g plats");

define("_STRICT_EVENT_SECURITY_", "Strikt s�kerhet f�r h�ndelsen");
define("_STRICT_EVENT_SECURITY_DESC_", "Befintliga h�ndelser kan bara �ndras och raderas av h�ndelsens �gare eller kalenderadministrat�r.");

define("_REMOTE_ACCESS_", "Fj�rr�tkomst");
define("_REMOTE_ACCESS_DESC_", "Fj�rr�tkomst till�ter anv�ndare att prenumerera p� den h�r kalendern p� distans
	med program som Mozilla Sunbird, Windates, or Apple iCal. Det aktiverar ocks� RSS-publicering, som kan l�sas
	i RSS-l�sare (RssReader, Shrook..), vissa internetportaler (Yahoo!, MSN..), och publiceringsverktyg (PHP-Nuke, Mambo..).");

define("_ENABLE_REMOTE_ACCESS_UPD_", "Till�t uppdatering via fj�rr�tkomst. Det till�ter auktoriserade medlemmar att publicera uppdateringar
till den h�r kalendern med tredjeparts-applikationer.");

define("_REMOTE_ACCESS_DESC_USERS_", "Om g�stanv�ndaren inte �r medlem av den h�r kalendern:
   Personer som f�rs�ker komma �t den h�r kalendern m�ste ha ett anv�ndarnamn och l�senord. Efter verifiering,
   medges �tkomst eller inte baserat p� kalenderns medlemsinst�llningar.");

define("_SYNDICATION_", "Publicering (Syndikering)");

define("_EDIT_EVENT_TYPES_", "Redigera kategorier");

define("_EVENT_TYPES_", "Kategorier");

define("_EVENT_TYPES_DESC_", "

       L�mna alla omarkerade f�r att anv�nda alla kategorier.<BR><BR>");

define("_MULTI_SELECT_WIN_","
       Windows: F�r att avmarkera ett objekt eller v�lja<br>flera, ej sammanh�rande objekt,
       h�ll ner<br>ctrl medan du v�ljer det.  ");

define("_REALLY_DELETE_EVENT_TYPE_", "Vill du verkligen radera kategorin?"); # question
define("_DELETE_ALL_IN_CATEGORY_", "radera alla h�ndelser i denna kategori.");

define("_VIEWS_NO_ACTION_", "Denna �tg�rd kan inte utf�ras p� en visning. V.g.
        v�lj en kalender.");

define("_VIEW_INVALID_CAL_", "Nuvarande visning inneh�ller en kalender som du inte �r medlem av. 
H�ndelser i denna kalender kommer inte att visas.");

define("_DESCRIPTION_", "Beskrivning");
define("_DETAILS_", "detaljer");
define("_PUBLISH_", "publicera");
define("_PUBLISH_DESC_", "Publicera denna kalender till en extern webbserver eller tj�nst s�som t.ex.
<a class='". _CAL_CSS_BODY_ ." ". _CAL_CSS_ULINE_."' target=_blank
href='http://icalx.com'>iCal Exchange</a>");
define("_SERVER_RESPONSE_", "Servern svarade");



######################
# EMAIL EVENT
######################
define("_EMAIL_EVENT_", "E-post");
define("_EMAIL_TO_", "Till");
define("_SEND_EMAIL_", "Skicka");
define("_SUBJECT_", "�mne");
define("_MESSAGE_", "Meddelande");
# e.g. The event has been sent to abcdefg@alphabet.com
define("_EMAIL_SENT_TO_", "H�ndelsen har skickats till ");
define("_EMAIL_NO_ADDR_WARNING_", "Varning: Du har inte konfigurerat en
e-postadress i sektionen  f�r kontaktalternativ. Ditt e-postmeddelande
kommer att visas som att det kommer fr�n ". @constant("_CAL_MAIL_FROM_"));

######################
# EMAIL SETTINGS
######################
define("_MAIL_PROG_PHP_", "PHP's e-postfunktion");
define("_MAIL_PROG_CMD_", "Lokal e-postserver (sendmail, qmail, etc..)");
define("_MAIL_PROG_SERVER_", "SMTP-server");

define("_MAIL_PROGRAM_", "Skicka e-post med");

define("_MAIL_FROM_EMAIL_", "E-postadress");

define("_MAIL_PATH_", "Lokal s�kv�g till e-postserver (mailer path)");
define("_MAIL_AUTH_", "SMTP-verifiering");

define("_MAIL_AUTH_USER_", "SMTP-anv�ndarnamn");
define("_MAIL_AUTH_PASS_", "SMTP-l�senord");

define("_MAIL_SERVER_", "SMTP-server");
define("_MAIL_SERVER_PORT_", "Server-port");

##########################
# ATTACHMENT SETTINGS
##########################
define("_ALLOW_ATTACHMENTS_", "Till�t fil-bilagor");
define("_ATTACHMENTS_PATH_", "S�kv�g till bilaga");

#############################
# GROUPS AND USERS
#############################
define("_USERS_", "Anv�ndare");
define("_GROUPS_", "Grupper");
define("_EVERYONE_", "Alla");
define("_SUPER_USER_", "Superanv�ndare");

define("_MEMBERS_", "Medlemmar");
define("_MEMBERS_OF_", "Medlemmar av");

define("_NAME_", "Namn");
define("_EMAIL_", "E-post");

define("_ACCESS_LVL_", "�tkomstniv�");
define("_ROLE_", "Anv�ndarniv�");
define("_READ_ONLY_", "Endast visning");
define("_NORMAL_","Normal");

define("_ARE_YOU_SURE_DELETE_GROUP_", "Vill du verkligen radera denna grupp?");
define("_GROUPS_SAVE_ATLEAST_1_MEMBER_", "Grupper m�ste ha minst 1 medlem. Medlemslistan sparades inte.");

# displayed as form field must begin with a character. E.g.
# Username must begin with a character.
define("_MUST_BEGIN_WITH_CHAR_", "m�ste b�rja med ett tecken.");

######################
# REMINDERS
######################
define("_REMINDERS_", "P�minnelser");
define("_BEFORE_EVENT_","f�re denna h�ndelse, p�");

define("_WILL_OCCUR_IN_", "b�rjar om"); # event x will occur in 30 minutes



###########################
# EVEVNT REQUESTS
############################
define("_REQUEST_", "H�ndelsef�rfr�gan");
define("_REQUESTS_", "H�ndelsef�rfr�gningar");
define("_REQUEST_ACCEPTED_", "Din h�ndelsef�rfr�gan har accepterats.");
define("_REQUEST_REJECTED_", "Din h�ndelsef�rfr�gan har avb�jts.");

define("_NOTIFY_REQUESTOR_", "Meddela fr�gest�llaren");
define("_REQUEST_HAS_NOTIFY_", "Fr�gest�llaren har beg�rt att meddelas.");
define("_REQUESTS_NO_PENDING_", "Det finns inga obesvarade f�rfr�gningar.");
define("_REQUEST_NOTIFY_EMAIL_", "meddela mig om obesvarade f�rfr�gningar p�");
define("_REQUEST_MSG_PRE_", "Meddelande som visas f�r anv�ndare(-n) innan f�rfr�gan skickas.");
define("_REQUEST_MSG_POST_", "Meddelande som visas f�r anv�ndare(-n) efter att f�rfr�gan skickats.");
define("_REQUEST_NOTES_", "Ytterligare noteringar f�r f�rfr�gan");
define("_REQUEST_NOTIFY_STATUS_", "Meddela status f�r denna f�rfr�gan p�");

define("_CONTACT_", "Kontakt");

# You have a pending event request on calendar: CALENDAR TITLE
define("_PENDING_REQUEST_", "Du har en obesvarad h�ndelsef�rfr�gan i kalender:");


#################
# DATE  ITEMS
#################
define("_CALENDAR_", "Kalender");

define("_MONTH_", "M�nad");
define("_MONTHS_", "M�nad(-er)");

define("_DAY_","dag");
define("_DAYS_", "dag(-ar)");

define("_YEAR_", "�r");
define("_YEARS_", "�r");

define("_WEEK_", "Vecka");

# Abbreviated week
define("_WEEK_ABBR_", "Vecka");

define("_WEEKS_", "vecka(-or)");

define("_HOUR_", "timme");
define("_HR_", "tim");
define("_HOURS_", "timmar");
define("_HRS_", "tim");

define("_MINS_", "min");
define("_MINUTES_", "minuter");

define("_DATE_", "Datum");
define("_TIME_", "Tid");

define("_AM_", "f.m.");
define("_AM_SHORT_", "f.m.");
define("_PM_", "e.m.");
define("_PM_SHORT_", "e.m.");

# VIEWS
define("_TODAY_", "Idag");
define("_THIS_WEEK_", "Denna vecka");
define("_THIS_MONTH_", "Denna m�nad");

##################
# MISC 
##################
define("_EVENT_", "H�ndelse");
define("_EVENTS_", "H�ndelser");
define("_VIEW_", "Visa");

# VIEW AS A NOUN
define("_VIEW_NOUN_", "Visa");

define("_PRINTABLE_VIEW_", "Utskriftsversion");

define("_ALLDAY_", "Hela dagen");

define("_CAL_CALL_FOR_TIMES_", "Kontakta oss f�r tidpunkt");
define("_CAL_CALL_FOR_TIMES_MIN_", "(*)");

define("_TYPE_","Typ");
define("_EVENT_TYPE_", "Kategori");

define("_WIDTH_", "Bredd");

define("_COLORS_", "F�rger");


###########################
# ADMIN PAGE 
###########################
define("_GLOBAL_SETTINGS_", "Inst�llningar f�r webbplats");
define("_EDIT_DEFAULT_OPTS_", "Redigera f�rvalda alternativ");
define("_PASS_MUST_MATCH_", "Angivna l�senord matchar inte");
define("_EMPTY_PASSWORD_", "Not setting password to \"\"!");
define("_ARE_YOU_SURE_DELETE_USER_", "Vill du verkligen radera denna anv�ndare?");
define("_DELETE_USERS_EVENTS_", "Radera alla h�ndelser som tillh�r denna anv�ndare.");
define("_CALENDARS_OWNED_", "Kalendrar som tillh�r denna anv�ndare");
define("_AUDIT_USERS_", "Redigera anv�ndare");
define("_AUDIT_USERS_DESC_", "En anv�ndare hittades i Thymes databas, men motsvarande
post i den befintliga autentiseringsmodulen saknas.<br>Alla anv�ndarv�rden
har satts till den saknade anv�ndarens id (uid).");

define("_CALENDAR_PUBLISHER_", "Kalenderpublicerare");
define("_CAL_USER_GUEST_", "G�stkonto");
define("_CAL_PUBLISH_GUEST_DISABLED_", "Kalenderpubliceraren fungerar inte om
       g�stkontot �r avst�ngt.  V.g. aktivera detta konto i Anv�ndarsektionen.");


####################################
# GENERAL ACTIONS AND RESPONSES
####################################
define("_ADD_", "L�gg till");
define("_NEW_EVENT_", "Ny h�ndelse");
define("_REMOVE_", "Ta bort");
define("_UPDATE_", "Uppdatera");
define("_NEXT_", "N�sta");
define("_PREV_", "F�reg�ende");
define("_DELETE_", "Radera");
define("_SAVE_", "Spara");
define("_TEST_", "Testa");
define("_UPDATE_NOW_", "Uppdatera nu");
define("_SAVE_ADD_", "Spara och l�gg till en annan");
define("_CANCEL_", "Avbryt");
define("_BROWSE_", "Bl�ddra");
define("_NONE_", "Ingen");
define("_RESET_", "�terst�ll");
define("_CLEAR_ALL_", "Avmarkera alla");
define("_CHECK_ALL_", "V�lj alla");
define("_EDIT_", "Redigera");
define("_CLOSE_", "St�ng");
define("_SHOW_", "Visa");
define("_HIDE_", "G�m");
define("_ENABLE_", "Aktivera");
define("_DISABLE_", "St�ng av");
define("_MOVE_", "Flytta");
define("_UP_", "Upp");
define("_DOWN_", "Ner");
define("_ENABLED_", "Aktiverad");
define("_CONFIGURE_", "St�ll in");
define("_ACCEPT_", "Acceptera");
define("_REJECT_", "Neka");
define("_OK_", "OK");
define("_FAILED_", "MISSLYCKADES");
define("_CHANGE_", "�ndra");
define("_SORT_BY_", "Sortera efter");
define("_SEARCH_", "S�k");
define("_FORCE_", "Tvinga");
define("_AUTODETECT_", "Uppt�ck automatiskt");
define("_RESET_PASS_", "�ndra l�senord");
define("_NEW_PASS_", "Nytt l�senord");
define("_RETYPE_", "Skriv om");
define("_UPDATED_", "Uppdaterad");
define("_SUBMITTED_", "Skickad");
define("_LOGIN_", "Logga in");
define("_USERNAME_", "Anv�ndarnamn");
define("_PASSWORD_", "L�senord");
define("_LOGOUT_", "Logga ut");
define("_OPTIONS_", "Alternativ");
define("_ADMIN_", "Admin");
define("_BAD_PASS_", "Fel anv�ndarnamn eller l�senord.");
define("_YES_", "Ja");
define("_NO_", "Nej");
define("_VALUE_", "V�rde");
define("_CUSTOM_", "Individuellt");
define("_DEFAULT_", "F�rinst�llt");

######################
# ATTACHMENTS
######################
define("_ATTACHMENTS_", "Bilagor");
define("_ATTACH_DETACH_", "Ta bort");
define("_ATTACH_DELETE_", "Radera");
define("_ATTACHMENT_TOO_BIG_", "Bilagan �r st�rre �n till�tet.");
define("_DOWNLOAD_ZIP_", "Ladda ner Zip");
define("_UPDATE_ATTACHMENTS_", "Uppdatera bilagor");

define("_BYTES_", "b");
define("_KBYTES_", "KB");
define("_MBYTES_", "MB");


#################
# EVENT LIST VIEW 
#################
define("_ALL_", "Alla");
define("_UPCOMING_", "Kommande");
define("_PAST_", "Tidigare");

define("_SHOWING_", "visar");
define("_OF_", "av");
define("_FIRST_", "F�rsta");
define("_LAST_", "Sista");
define("_SHOW_TYPE_", "Kategori");

define("_LIST_SIZE_", "Listans storlek");

define("_ARE_NO_EVENTS_", "Det finns inga h�ndelser att visa.");

define("_EVENTS_CONTAINING_", "H�ndelser inneh�llande"); # used in event search

define("_ARE_YOU_SURE_DELETE_EVENTS_", "Vill du verkligen radera dessa h�ndelser?");
define("_DELETE_REPEATING_WARNING_", "
   Du har valt att radera en eller flera �terkommande h�ndelser.<br>
   Alla inf�randen (tidigare och kommande) av dessa h�ndelser kommer att raderas! ");

define("_UNCHECK_NO_DELETE_", "Avmarkera alla h�ndelser som du inte vill radera:");
define("_DELETE_CHECKED_", "Radera markerade");

define("_RETURN_", "Tillbaka");
define("_ERROR_", "Fel!");

######################
# EVENT EDIT/ADD/VIEW
######################
define("_GENERAL_", "Allm�nt");

define("_ORGANIZER_", "Kalender");

define("_URL_", "URL");

define("_REPEATING_", "�terkommande");

define("_LOCATION_", "Plats");

define("_APPLY_TO_", "Till�mpa �ndringar p�");
define("_ALL_DATES_", "alla datum");
define("_THIS_DATE_", "bara detta datum");

define("_RESET_INSTANCE_", "�terst�ll inf�randet till ursprungsinst�llningarna");

define("_MAP_", "Karta");

define("_STARTED_", "Startad");

# e.g. Overrides event Weekly Meeting on 2004-2-34
define("_OVERRIDE_EVNT_ON_", "�sidos�tter h�ndelse %s i %s");

# e.g. Warning: the event Event Title has an invalid repeating rule
define("_INVALID_RRULE_", "Varning: H�ndelse %s inneh�ller ett ogiltigt repetitionsvillkor.");

define("_MAX_CHARS_", "max. antal tecken");
define("_EVENT_INFO_", "Information om h�ndelsen");
define("_TITLE_", "Rubrik");
define("_NOTES_", "Meddelande");

define("_CHECK_FOR_CONFLICTS_", "kontrollera konflikter");

define("_THIS_EVENT_ALLDAY_", "Detta �r en heldagsh�ndelse.");
define("_STARTS_AT_", "B�rjar");
define("_DURATION_", "P�g�r");

define("_FLAG_", "Flagga");
define("_FLAG_THIS_", "Flagga denna h�ndelse");
define("_IS_FLAGGED_", "h�ndelsen �r flaggad");

# e.g. 10 days ago
define("_AGO_", "sedan");

define("_REPEATING_NO_", "Denna h�ndelse upprepas inte.");
define("_REPEATING_REPEAT_", "Upprepa");
define("_REPEATING_SELECTED_", "valda dagar");
define("_REPEATING_EVERY1_", "varje");

define("_REPEAT_ON_", "Upprepa den");
define("_REPEAT_ON1_", "f�rsta");
define("_REPEAT_ON2_", "andra");
define("_REPEAT_ON3_", "tredje");
define("_REPEAT_ON4_", "fj�rde");
define("_REPEAT_ON5_", "femte");
define("_REPEAT_ONL_", "sista");
define("_REPEAT_ON_OF_", "i m�naden, varje");

define("_SIMPLE_", "Enkel");
define("_ADVANCED_","Avancerad");

define("_YEARLY_", "Varje �r");
define("_MONTHLY_", "Varje m�nad");
define("_WEEKLY_", "Varje vecka");
define("_DAILY_", "Dagligen");
define("_EASTER_", "P�sk");
define("_EASTER_YEARLY_", "P�sk varje �r");

define("_MONTH_DAYS_", "M�nadens dag(-ar)");
define("_FROM_LAST_", "fr�n sista");

define("_WEEKDAYS_", "Veckodag(-ar)");

define("_YEARLY_NOTES_", "F�rvald m�nad och dag tas fr�n startdatum
       om inget v�ljs.");


define("_SPECIFIC_OCCURRENCES_", "S�rskilda h�ndelser");

define("_STARTING_ON_", "b�rjar p�");

define("_BEFORE_", "F�re");
define("_AFTER_", "Efter");

define("_EXCLUDE_DATES_", "Exkludera datum");

define("_CONFIRM_EVNT_RPT_CHANGE_", "Du h�ller p� att �ndra upprepningsvillkoren eller datum f�r denna h�ndelse.\n
Alla undantag som �r knutna till denna �terkommande h�ndelse kommer att f�rloras. �r du s�ker p� att du vill g�ra detta?\n");


define("_END_DATE_", "Slutdatum");
define("_END_DATE_NO_", "Inget slutdatum");
define("_END_DATE_UNTIL_", "T.o.m.");
define("_END_DATE_AFTER_", "Slutar efter");
define("_OCCURRENCES_", "h�ndelser");

define("_ADDRESS_", "Adress");
define("_ADDRESS_1_", "Gatuadress");
define("_ADDRESS_2_", "Postnummer och Postadress");

define("_PHONE_", "Tel");
define("_ICON_", "Ikon");

#####################
# MODULES
#####################
define("_NAVBAR_", "Nav rad");
define("_MODULE_", "Modul");
define("_MODULES_", "Moduler");
define("_TODAY_LINK_", "Idag l�nk");
define("_MINI_CAL_", "Mini-Kal");
define("_CALENDAR_LINKS_", "Kalender l�nkar");
define("_IMAGE_BROWSER_", "Image Browser");
define("_QUICK_ADD_EVNT_", "Snabbtill�gg av h�ndelse");
define("_GOTO_DATE_", "G� till datum");
define("_SEARCH_EVENTS_", "S�k h�ndelser");
define("_EVENT_FILTER_", "Kategori");
define("_COLOR_LEGEND_", "F�rklaring");

##################
# SYNC 
##################

define("_SYNC_", "Synk");
define("_IMPORT_", "Importera");
define("_EXPORT_", "Exportera");
define("_IMPORT_FROM_", "Importera fr�n");
define("_EXPORT_TO_", "Exportera till");
define("_SYNC_DUPLICATES_", "Om dubletter hittas");
define("_IGNORE_DUPLICATES_", "Beh�ll dubletter or�rda");
define("_OVERWRITE_EXISTING_EVENT_", "Skriv �ver befintlig h�ndelse");
define("_CREATE_NEW_EVENT_", "Skapa ny h�ndelse");
define("_IMPORT_AS_", "Importera till katergori");
define("_EVENTS_IMPORTED_", "H�ndelser importerade");
define("_SYNC_IMPORT_ERROR_", "Fel: Det uppstod ett fel n�r den fil du f�rs�kte importera skulle tolkas.");
define("_HTML_", "HTML");
define("_PLAINTEXT_", "Plain text");
define("_ICAL_", "iCalendar (.ics)");
define("_QUIRKS_MODE_", "Quirks Mode");
define("_PERMISSION_DENIED_", "Medges ej: Du �r inte �gare till eller
administrat�r f�r den h�r kalendern.");
define("_FULL_SYNC_", "Full Synk");
define("_FULL_SYNC_DESC_", "Radera h�ndelser som finns i Thyme men som inte kan hittas i den importerade filen.");

#########################
# CSS AND STYLE
#########################
define("_COLOR_", "F�rg");

define("_STYLE_", "Stil");

define("_PREVIEW_", "F�rhandsvisning");
define("_SAMPLE_", "Exempel");

define("_BACKGROUND_COLOR_", "Bakgrundsf�rg");
define("_FONT_COLOR_", "Typsnittsf�rg");
define("_FONT_SIZE_", "Typsnittsstorlek");

define("_FONT_STYLE_", "Textstil");
define("_BOLD_", "fet");
define("_ITALICS_", "kursiv");
define("_UNDERLINE_", "understrykning");

define("_FONT_FAMILY_", "Typsnittsfamilj");
define("_FONT_FAMILY_DESC_", "T.ex. Tahoma, 'Sans Serif', Arial");

define("_UNDERLINE_LINKS_", "Stryk under l�nkar");
define("_NEVER_", "Aldrig");
define("_ALWAYS_", "Alltid");
define("_HOVER_", "Sv�va");
define("_BORDER_COLOR_", "Ramf�rg");
define("_TIME_FONT_COLOR_", "Typsnittsf�rg f�r tid");
define("_TITLE_FONT_COLOR_", "Typsnittsf�rg f�r rubrik");
define("_TITLE_FONT_STYLE_", "Textstil f�r rubrik");

#########################
# CALENDAR PUBLISHER
#########################
if(@constant("_CAL_DOING_PUBLISHER_")) { # <- leave this line alone

define("_MINI_MONTH_", "Minim�nad");

define("_SET_DATE_CURRENT_", "Satt till dagens datum");
define("_EDITABLE_", "Redigerbar");
define("_STATIC_", "Statisk");
define("_STATIC_DESC_", "kalenderinneh�llet inkluderar inga l�nkar som �ndrar datum eller visningss�tt");
define("_HIL_DAY_", "Markera dag");
define("_HIL_WEEK_", "Markera vecka");

define("_APPLY_CSS_FROM_", "Anv�nd CSS-stil fr�n");
define("_NO_CSS_", "ingen");
define("_CSS_EDITOR_", "CSS-redigerare");

define("_LANGUAGE_", "Spr�k");
define("_EURO_DATE_", "Europeisk datumform");
define("_EURO_DATE_DESC_", "Datum visas om m�jligt som dd/mm/����");

define("_HEADER_", "Rubrik");
define("_WEEKDAY_HEADER_", "Veckodagsrubrik");

define("_NORMAL_DAYS_", "Normala dagar");
define("_DAYS_NOT_IN_MONTH_", "Dagar utanf�r innevarande m�nad");
define("_HIGHLIGHTED_DAYS_", "Markerade dagar");

define("_NORMAL_EVENTS_", "Normala h�ndelser");
define("_FLAGGED_EVENTS_", "Flaggade h�ndelser");

define("_SHOW_EVENTS_", "Visa h�ndelser");


define("_EVENT_LINKS_", "H�ndelsel�nkar");

define("_EVENT_LINK_URL_", "URL f�r h�ndelsel�nk");

define("_EVENT_LINK_URL_DESC_", "

        En fr�gestr�ng (query string) inneh�llande
        <font class='"._CAL_CSS_HIL_."'>eid</font> och <font class='"._CAL_CSS_HIL_."'>instance</font> kommer att skickas till denna url.<br>

        <b>eid</b> �r h�ndelsens ID och <b>instance</b> �r datum i
        <b>YYYY-MM-DD</b>-format.<br>These are noted by <font class='"._CAL_CSS_HIL_."'>%eid</font>
        and <font class='"._CAL_CSS_HIL_."'>%inst</font>.<br><br>

        T.ex. http://mysite.com/sales/view_sale.php?eid=%eid&instance=%inst kan ge:<br>

        http://mysite.com/sales/view_sale.php?<font
		class='"._CAL_CSS_HIL_."'>eid</font>=56&<font
		class='"._CAL_CSS_HIL_."'>instance</font>=2005-10-26<br><br>
 
        Se dokumentationen och/eller instruktionen (Tutorial) p� Thyme:s webbplats f�r mer information
        hur dessa ska anv�ndas. ");


define("_SHOW_HEADER_", "Visa rubrik");
define("_ALIGN_HEADER_TEXT_", "Justera rubriktext");
define("_CENTER_", "Centrera");
define("_HEADER_TEXT_", "Rubriktext");

define("_HEADER_TEXT_DESC_","

   (E.g. <font class='"._CAL_CSS_HIL_."'>F�delsedagar i %month</font>)<br>
        <font size=1><i>L�mna tomt f�r att anv�nda den f�rvalda 
        rubriken. Andra variabler inkluderar %weekday, %mday, %mon och %year.</i></font> ");


define("_SHOW_HEADER_LINKS_", "Visa rubrikl�nkar");

define("_NEXT_LINK_", "N�sta l�nk");
define("_PREV_LINK_", "F�reg�ende l�nk");

define("_IMG_URL_", "Bildens URL");

define("_HEADER_LINKS_", "Rubrikl�nkar");

define("_IMG_URL_DESC_", "
        Kan vara en text s�som t.ex. '<<' eller en URL f�r en bild<br>
        (E.g. <font
        class='"._CAL_CSS_HIL_."'>http://www.myserver.com/images/next.gif</font>)<br><font
        size=1><i>L�mna tomma f�r att anv�nda den valda mallens 
       f�rvalda bild.</i></font> ");


define("_DAY_VIEW_", "Dag-vy");

define("_MONTH_VIEWS_", "M�nads-vy");

define("_SHOW_WEEKS_DESC_", "Observera att en minim�nad aldrig visar veckonummer");

define("_ROW_HEIGHT_", "Radh�jd");
define("_ROW_HEIGHT_DESC_", "F�rval �r '90' f�r en m�nad, '0' f�r en minim�nad");

define("_LIMIT_WEEKDAY_NAMES_", "Begr�nsa veckodagsnamn till ");
define("_CHARS_", "tecken");

define("_EXCLUDE_MONTH_DAYS_", "Exkludera dagar som inte ing�r i m�nad");

define("_MINI_MONTH_DATE_URL_", "URL f� Minim�nad-datum");

define("_MINI_MONTH_DATE_URL_DESC_", "
        L�nken som ett klick p� en dag i minim�nadskalendern
        pekar till. Detta ers�tter f�ljande str�ngar:<br>

        %d = dagens nummer<br>
        %m = m�nadens nummer<br>
        %y = �rets nummer<br>

        <br><br>

        T.ex. http://www.myserver.com/page.php?day=%d&month=%m&year=%y<br>
        kan ge
        <font class='"._CAL_CSS_HIL_."'>http://www.myserver.com/page.php?day=23&month=11&year=2004</font>

        <br>eller du kan t.o.m. anv�nda en Javascript-funktion.<br>

        T.ex. <font class='"._CAL_CSS_HIL_."'>javascript:myFunction(%y,%m,%d)</font><br><br>

        F�rval �r en l�nk till innevarande sida som anger:<br>
        m = %m<br>
        d = %d<br>
        y = %y<br>

        T.ex. <font class='"._CAL_CSS_HIL_."'>index.php?d=23&m=11&y=2004</font><br><br>
        Se dokumentationen och/eller instruktionen (Tutorial) p� Thyme:s webbplats f�r mer information
        hur dessa ska anv�ndas.");


define("_GENERATED_CODE_", "Genererad kod");

define("_BASE_PATH_DESC_", "base path of thyme with trailing slash");
define("_BASE_URL_DESC_", "base url of thyme with trailing slash");

} # </ CALENDAR PUBLISHER SECTION > <- leave this line alone


######################
#
### RSS FEED MODULES
#
#####################
define("_RSS_FEED_MODULES_", "RSS-str�mmoduler");
define("_RSS_", "RSS-str�mmar");
define("_UPDATE_INTERVAL_", "Updatera intervall");
define("_ARE_YOU_SURE_DELETE_RSSMOD_", "�r du s�ker p� att du vill radera den h�r RSS-modulen?");
define("_AUTHOR_", "Skapare");

# scrolling
define("_SCROLLING_","Rullning");
define("_OVERFLOW_", "�verspill");
define("_SCROLLBAR_", "Rullist");
define("_AUTOSCROLL_", "Autorullning");


# this will keep us from needing to
# have these defined when not looking
# at options
#####################################
if(@constant("_CAL_DOING_OPTS_")) { # <- leave this line alone

######################
# OPTION STRINGS
######################

define("_DEFAULT_VIEW_", "F�rvalt visningss�tt");

define("_DEFAULT_CALENDAR_", "F�rvald kalender");

define("_TIME_INTERVALS_", "Tidsintervall");

define("_EVNT_SIZE_", "H�ndelse textstorlek");
define("_SMALLER_", "Mindre");
define("_SMALLEST_", "Minsta");
define("_EVNT_COLLAPSE_", "F�ll ihop h�ndelser (M�nadsvisning)");
define("_EVNT_COLLAPSE_DESC_", "F�ll ihop l�nga h�ndelserubriker.");
define("_EVNT_TYPE_NAME_", "Visa h�ndelsekategorier.");
define("_EVNT_POPUP_", "Snabbmeny f�r h�ndelser");
define("_EVNT_POPUP_DESC_", "Visa h�ndelser i nytt f�nster.");
define("_EVNT_NOTES_POPUP_", "Popup-F�nster f�r h�ndelsemeddelande");
define("_EVNT_NOTES_POPUP_DESC_", "L�t din muspekare sv�va �ver en h�ndelse
	f�r att l�sa dess noteringar.");

define("_POSITION_", "Placering");

define("_SHOW_WEEKS_", "Visa veckonummer");

define("_WEEK_START_", "Veckan inleds med");
define("_WORK_HOURS_", "Arbetstid");
define("_WORK_HOURS_START_", "B�rjar");
define("_WORK_HOURS_END_", "Slutar");

define("_HOUR_FORMAT_", "Tidsformat");
define("_HOUR_FORMAT_12_", "12 tim");
define("_HOUR_FORMAT_24_", "24 tim");

define("_LOCALE_", "Lokalanpassning");

define("_NAV_BAR_LOC_", "Navigeringsrad");
define("_RIGHT_", "H�ger");
define("_LEFT_", "V�nster");

define("_TIMEZONE_", "Tidzon");
define("_DST_", "Sommartid");
define("_STARTS_", "B�rjar");
define("_ENDS_", "Slutar");

define("_IN_", "in");
define("_ON_", "P�");
define("_OFF_", "AV");

define("_THEME_", "Mall");

##########################
# CONTACT OPTIONS
##########################
define("_CONTACT_OPTS_", "Kontaktalternativ");
define("_PRIMARY_", "Prim�r");
define("_FORMAT_", "Format");

##########################
# SUBSCRIPTIONS
##########################
define("_SUBSCRIPTIONS_", "Prenumerationer");
define("_SUBSCRIPTIONS_DESC_", "Prenumerationer p� kalendrar via e-post.");

######################
# NOTIFICATIONS
#####################
define("_NOTIFICATIONS_", "Meddelanden");
define("_NOTIFICATIONS_DESC_", "Meddelandefilter f�r nya och uppdaterade h�ndelser.");

define("_TITLE_CONTAINS_", "Rubriken inneh�ller");
# event X has been updated on calendar Y
define("_UPDATED_ON_", "har uppdaterats den");
# event X has been added to calendar Y
define("_ADDED_TO_", "har lagts till");

#####################
# DST STRINGS
#####################
define("_DST_OPTS1_", "Afrika / Egypten");
define("_DST_OPTS2_", "Afrika / Namibia");
define("_DST_OPTS3_", "Asien / Sovjetunionen (f.d.) - flertalet delstater");
define("_DST_OPTS4_", "Asien / Irak");
define("_DST_OPTS5_", "Asien / Libanon, Kirgizien");
define("_DST_OPTS6_", "Asien / Syrien");
define("_DST_OPTS7_", "Australasia / Australien, New South Wales");
define("_DST_OPTS8_", "Australasia / Australien - Tasmanien");
define("_DST_OPTS9_", "Australasia / Nya Zealand, Chatham");
define("_DST_OPTS10_", "Australasia / Tonga");
define("_DST_OPTS11_", "Europa / EU, UK, Gr�nland");
define("_DST_OPTS12_", "Europa / Ryssland");
define("_DST_OPTS13_", "Nordamerika / USA, Kanada, Mexiko");
define("_DST_OPTS14_", "Nordamerika / Kuba");
define("_DST_OPTS15_", "Sydamerika / Chile");
define("_DST_OPTS16_", "Sydamerika / Paraguay");
define("_DST_OPTS17_", "Sydamerika / Falklands�arna");

####################
# TIMEZONE STRINGS
####################
define("_GMT_PLUS_0.0_","GMT +00:00 Storbritannien, Irland, Portugal, V�stafrika ");
define("_GMT_PLUS_0.5_","GMT +00:30 ");
define("_GMT_PLUS_1.0_","GMT +01:00 V�steuropa, Centralafrika");
define("_GMT_PLUS_1.5_","GMT +01:30 ");
define("_GMT_PLUS_2.0_","GMT +02:00 �steuropa, �stafrika");
define("_GMT_PLUS_2.5_","GMT +02:30 ");
define("_GMT_PLUS_3.0_","GMT +03:00 Ryssland, Saudiarabien");
define("_GMT_PLUS_3.5_","GMT +03:30 ");
define("_GMT_PLUS_4.0_","GMT +04:00 Arabien");
define("_GMT_PLUS_4.5_","GMT +04:30 ");
define("_GMT_PLUS_5.0_","GMT +05:00 V�stra Asien, Pakistan");
define("_GMT_PLUS_5.5_","GMT +05:30 Indien");
define("_GMT_PLUS_6.0_","GMT +06:00 Centralasien");
define("_GMT_PLUS_6.5_","GMT +06:30 ");
define("_GMT_PLUS_7.0_","GMT +07:00 Bangkok, Hanoi, Jakarta");
define("_GMT_PLUS_7.5_","GMT +07:30 ");
define("_GMT_PLUS_8.0_","GMT +08:00 Kina, Singapore, Taiwan");
define("_GMT_PLUS_8.5_","GMT +08:30 ");
define("_GMT_PLUS_9.0_","GMT +09:00 Korea, Japan");
define("_GMT_PLUS_9.5_","GMT +09:30 Centrala Australien");
define("_GMT_PLUS_10.0_","GMT +10:00 �stra Australien");
define("_GMT_PLUS_10.5_","GMT +10:30 ");
define("_GMT_PLUS_11.0_","GMT +11:00 Central Pacific");
define("_GMT_PLUS_11.5_","GMT +11:30 ");
define("_GMT_PLUS_12.0_","GMT +12:00 Fiji, Nya Zealand");
define("_GMT_MINUS_12.0_","GMT -12:00 Datumlinien ");
define("_GMT_MINUS_11.5_","GMT -11:30 ");
define("_GMT_MINUS_11.0_","GMT -11:00 Samoa");
define("_GMT_MINUS_10.5_","GMT -10:30 ");
define("_GMT_MINUS_10.0_","GMT -10:00 Hawaii");
define("_GMT_MINUS_9.5_","GMT -09:30 ");
define("_GMT_MINUS_9.0_","GMT -09:00 Alaska/Pitcairn Islands");
define("_GMT_MINUS_8.5_","GMT -08:30 ");
define("_GMT_MINUS_8.0_","GMT -08:00 USA/Kanada/Pacific");
define("_GMT_MINUS_7.5_","GMT -07:30 ");
define("_GMT_MINUS_7.0_","GMT -07:00 USA/Kanada/Mountain");
define("_GMT_MINUS_6.5_","GMT -06:30 ");
define("_GMT_MINUS_6.0_","GMT -06:00 US/Kanada/Central");
define("_GMT_MINUS_5.5_","GMT -05:30 ");
define("_GMT_MINUS_5.0_","GMT -05:00 US/Kanada/Eastern, Kolumbien, Peru");
define("_GMT_MINUS_4.5_","GMT -04:30 ");
define("_GMT_MINUS_4.0_","GMT -04:00 Bolivien, V�stra Brasilien, Chile, Atlanten");
define("_GMT_MINUS_3.5_","GMT -03:30 Newfoundland");
define("_GMT_MINUS_3.0_","GMT -03:00 Argentina, �stra Brasilien, Gr�nland");
define("_GMT_MINUS_2.5_","GMT -02:30 ");
define("_GMT_MINUS_2.0_","GMT -02:00 Mellersta Atlanten");
define("_GMT_MINUS_1.5_","GMT -01:30 ");
define("_GMT_MINUS_1.0_","GMT -01:00 Azorerna/�stra Atlanten");
define("_GMT_MINUS_0.5_","GMT -00:30 ");

}

##########################
# ERRORS AND WARNINGS
##########################
define("_WARNING_ATTACH_", "Varning: Bilagekatalog %s finns inte eller �r inte skrivbar.");
define("_WARNING_RSS_", "Varning: RSS-str�msarkiv %s �r inte skrivbart.");
define("_WARNING_INSTALL_", "Varning: %s existerar fortfarande. V.g. ta bort denna fil.");
define("_WARNING_LICENSE_", "Varning: Thyme's licens upph�r att g�lla om %s dagar.");


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
$_cal_alphabet = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P',
   'Q','R','S','T','U','V','W','X','Y','Z','�','�','�');

#####################
# "AUTOMAGIC" 
#####################
# weekdays
global $_cal_weekdays, $_cal_weekdays_abbr, $_cal_months, $_cal_months_abbr;

$_cal_weekdays or $_cal_weekdays = array(
  "S�ndag",
  "M�ndag",
  "Tisdag",
  "Onsdag",
  "Torsdag",
  "Fredag",
  "L�rdag");

$_cal_months or $_cal_months = array(1 => 
  "Januari",
  "Februari",
  "Mars",
  "April",
  "Maj",
  "Juni",
  "Juli",
  "Augusti",
  "September",
  "Oktober",
  "November",
  "December");


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


