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

define("_ALLOW_EVERYONE_VIEW_", "Tillåt alla användare att se alla kalendrar i denna visning, oavsett deras medlemslista");

define("_HIDE_VIEW_FROM_GUESTS_", "Göm denna visning för gestanvändare");

define("_REQUEST_NOTIFY_OWNER_", "Informera kalenderägare om obesvarade förfrågningar");

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
define("_INVALID_PACKAGE_", "Dokumentet som du har laddat upp är inte giltigt Thyme paket.");
define("_INSTALLED_MODULES_", "Installerade moduler");
define("_UNINSTALL_", "Avinstallera");
define("_LOCAL_FILE_","Lokalt dokument");
define("_UPDATES_", "Uppdateringar");
define("_AVAILABLE_UPDATES_", "Tillgängliga uppdateringar");
define("_CHECK_FOR_UPDATES_", "Kontrollera uppdateringar");
define("_LAST_CHECKED_ON_", "Senast kontrollerat"); # e.g. last checked on 1/2/2007
define("_FILE_", "Dokument");
define("_WRITABLE_", "Skrivbar(t)");
define("_REFRESH_", "Uppdatera");
define("_INVALID_DOWNLOAD_", "Ogiltig nerladdning. Kan inte uppdatera dokumentet.");
define("_UNABLE_TO_BACKUP_", "Kan inte säkerhetskopiera aktuellt dokument.");
define("_UPDATES_AVAIL_", "%s uppdateringar tillgängliga"); # %s will be replaced w/# av tillgängliga uppdateringar

############################
#
### NEW USER DEFINITIONS
#
###########################
define("_REGISTERED_USERS_", "Registrerade användare");
define("_PUBLIC_", "Allmänt");
define("_PUBLIC_ACCESS_", "Allmänt tillträde");

#############################
#
### MULTIPLE REMINDERS
#
#############################
define("_BEFORE_EVENT_MULTI_", "före denna händelse");
define("_USER_CAN_NOT_VIEW_", "%s har inte tillträde att se denna kalender.");
define("_ALLOW_CONFIGURE_REMINDERS_", "Tillåta %s att konfigurera händelsepåminnelse för alla användare.");
define("_CALENDAR_ADMINS_", "Kalender-administrerare");
define("_EVENT_OWNER_", "Händelseägare");
define("_SITE_ADMINS_", "Webbplats-administrerare");
define("_NO_ONE_", "Ingen");

###############################
#
## CONFIGURABLE JOB INTERVALS
#
###############################

define("_REMIND_AT_LEAST_", "Åtminstone");
define("_SCHEDULED_TASK_", "Schemalagd uppgift");
define("_NO_SCHEDULED_TASK_", "Den Thyme schemalagda uppgiften är inte konfigurerad att köras");
define("_SCHEDULED_TASK_CONFIGURED_", "Den Thyme schemalagda uppgiften är konfigurerad att köras varje");
define("_PHP_CLI_", "PHP CLI plats");

###################################
#
### CUSTOMIZE SITE
#
###################################
define("_CUSTOMIZE_SITE_", "Anpassa webbplats");
define("_SITE_NAME_", "Webbplatsens namn");
define("_SITE_THEME_", "Webbplatsens mall");
define("_SITE_THEME_DESC_", "Satt till 'Ingen' tillåter användare att välja sin egen mall");

# use exact HTML tags, they will be displayed correctly
# when printed
define("_SITE_HEADER_", "Webbplatsens sidhuvud");
define("_SITE_HEADER_DESC_", "Efter <body> taggen");

define("_SITE_FOOTER_", "Webbplatsens sidfot");
define("_SITE_FOOTER_DESC_", "Före </body> taggen");

define("_SITE_HEAD_", "Webbplatsens top");
define("_SITE_HEAD_DESC_", "Mellan <head> </head> taggar.");

####################################
#
### LICENSE KEY
#
####################################
define("_ENTER_LICENSE_KEY_", "Slå in licens-nyckeln");
define("_LICENSE_KEY_", "Licens-nyckel");
define("_LICENSE_KEY_ACCEPTED_", "Licens-nyckel accepterad");
define("_INVALID_LICENSE_KEY_", "Licens-nyckeln som du har slagit in är inte giltig för denna webbplats");

####################################
#
### EVENT REQUEST DESCRIPTION
#
####################################
define("_REQUEST_MODE_VIEW_ONLY_", "Medlemmar med endast läsrättigheter kan lämna in händelseförfrågningar. Normala medlemmar kan lägga till händelser direkt.");
define("_REQUEST_MODE_NORMAL_", "Medlemmar med endast läsrättigheter kan endast se kalendern. Normala medlemmar kan lämna in händelseförfrågningar.");

#####################################
#
### TELL A FRIEND FOR GUEST E-MAILS
#
######################################
define("_TELL_A_FRIEND_", "Berätta för en vän");

define("_YOUR_NAME_", "Ditt namn");
define("_YOUR_EMAIL_", "Din e-post adress");

define("_YOUR_FRIENDS_NAME_","Din väns namn");
define("_YOUR_FRIENDS_EMAIL_","Din väns e-post adress");

define("_EMAIL_EVENT_DISPLAYED_","Händelsen kommer att visas nedanför ditt meddelande.");

define("_ALLOW_GUEST_USERS_EMAIL_", "Tillåt gästanvändare att skicka händelser med e-post .");

define("_DISABLE_SITE_ADDR_BOOK_", "Stänga av webbplatsens adressbok för icke-administratörer");

define("_EMAIL_TO_MULTIPLE_", "Separera multipla adresser med kommatecken.");

# MISC
########
define("_HELP_", "Hjälp");
define("_WARNING_DIR_NOT_WRITABLE_", "Varning: Mappen %s är inte skrivbar.");
define("_WARNING_FILE_NOT_WRITABLE_", "Varning: Dokumentet %s är inte skrivbart.");
define("_DOWNLOAD_", "Ladda ner");
define("_HIDE_QUICK_ADD_", "Göm 'Snabbtillägg av händelse' boxen");
define("_FORCE_DEFAULT_OPTS_", "Tvinga förvalda alternativ för alla användare. Sätt i 'Admin - Förvalda alternativ.");
define("_NO_GUEST_TIMEZONE_", "Tillåt inte gästanvändare att ändra tidzon.");
define("_NUMBER_SYMBOL_", '#');
define("_DISABLE_WYSIWYG_EDITOR_", "Stänga av WYSIWYG editorn för händelsenoteringar.");
define("_SHOW_CALENDAR_NAMES_", "Visa kalendernamn när 'Visa händelsekategorinamn' är satt i användaralternativ.");
define("_MISC_", "Diverse");
define("_THEME_POPUPS_", "Använd mall vid händelsenoteringar-popups.");

define("_PUBLIIC_", "Allmänt");
define("_REGISTERED_USERS_", "Registrerade användare");

define("_NEW_", "Ny");

define("_CATEGORY_EDIT_DESC_", "Klicka på kategorinamnet för att redigera en kategori");

define("_ARE_YOU_SURE_DELETE_", "Är du säker på att du vill ta bort denna %s?");

########## END NEW TRANSLATIONS #################




################################
# EDIT / VIEW / POST CALENDARS
################################
define("_CALENDARS_", "Kalendrar");
define("_OWNER_", "Ägare");
define("_ARE_YOU_SURE_DELETE_CALENDAR_", "Är du säker på att du vill radera kalendern?");

define("_COLOR_BY_", "Tilldela färg enligt");
define("_BY_OWNER_", "Händelsens ägare");
define("_BY_CATEGORY_", "Händelsekategori");
define("_BY_CALENDAR_", "Kalender");

define("_MODE_", "Mode");

define("_ALLOW_MULTI_CATS_", "Tillåt flera kategorier för händelser");

define("_REMEMBER_LOCATIONS_", "Kom ihåg plats");

define("_STRICT_EVENT_SECURITY_", "Strikt säkerhet för händelsen");
define("_STRICT_EVENT_SECURITY_DESC_", "Befintliga händelser kan bara ändras och raderas av händelsens ägare eller kalenderadministratör.");

define("_REMOTE_ACCESS_", "Fjärråtkomst");
define("_REMOTE_ACCESS_DESC_", "Fjärråtkomst tillåter användare att prenumerera på den här kalendern på distans
	med program som Mozilla Sunbird, Windates, or Apple iCal. Det aktiverar också RSS-publicering, som kan läsas
	i RSS-läsare (RssReader, Shrook..), vissa internetportaler (Yahoo!, MSN..), och publiceringsverktyg (PHP-Nuke, Mambo..).");

define("_ENABLE_REMOTE_ACCESS_UPD_", "Tillåt uppdatering via fjärråtkomst. Det tillåter auktoriserade medlemmar att publicera uppdateringar
till den här kalendern med tredjeparts-applikationer.");

define("_REMOTE_ACCESS_DESC_USERS_", "Om gästanvändaren inte är medlem av den här kalendern:
   Personer som försöker komma åt den här kalendern måste ha ett användarnamn och lösenord. Efter verifiering,
   medges åtkomst eller inte baserat på kalenderns medlemsinställningar.");

define("_SYNDICATION_", "Publicering (Syndikering)");

define("_EDIT_EVENT_TYPES_", "Redigera kategorier");

define("_EVENT_TYPES_", "Kategorier");

define("_EVENT_TYPES_DESC_", "

       Lämna alla omarkerade för att använda alla kategorier.<BR><BR>");

define("_MULTI_SELECT_WIN_","
       Windows: För att avmarkera ett objekt eller välja<br>flera, ej sammanhörande objekt,
       håll ner<br>ctrl medan du väljer det.  ");

define("_REALLY_DELETE_EVENT_TYPE_", "Vill du verkligen radera kategorin?"); # question
define("_DELETE_ALL_IN_CATEGORY_", "radera alla händelser i denna kategori.");

define("_VIEWS_NO_ACTION_", "Denna Åtgärd kan inte utföras på en visning. V.g.
        välj en kalender.");

define("_VIEW_INVALID_CAL_", "Nuvarande visning innehåller en kalender som du inte är medlem av. 
Händelser i denna kalender kommer inte att visas.");

define("_DESCRIPTION_", "Beskrivning");
define("_DETAILS_", "detaljer");
define("_PUBLISH_", "publicera");
define("_PUBLISH_DESC_", "Publicera denna kalender till en extern webbserver eller tjänst såsom t.ex.
<a class='". _CAL_CSS_BODY_ ." ". _CAL_CSS_ULINE_."' target=_blank
href='http://icalx.com'>iCal Exchange</a>");
define("_SERVER_RESPONSE_", "Servern svarade");



######################
# EMAIL EVENT
######################
define("_EMAIL_EVENT_", "E-post");
define("_EMAIL_TO_", "Till");
define("_SEND_EMAIL_", "Skicka");
define("_SUBJECT_", "Ämne");
define("_MESSAGE_", "Meddelande");
# e.g. The event has been sent to abcdefg@alphabet.com
define("_EMAIL_SENT_TO_", "Händelsen har skickats till ");
define("_EMAIL_NO_ADDR_WARNING_", "Varning: Du har inte konfigurerat en
e-postadress i sektionen  för kontaktalternativ. Ditt e-postmeddelande
kommer att visas som att det kommer från ". @constant("_CAL_MAIL_FROM_"));

######################
# EMAIL SETTINGS
######################
define("_MAIL_PROG_PHP_", "PHP's e-postfunktion");
define("_MAIL_PROG_CMD_", "Lokal e-postserver (sendmail, qmail, etc..)");
define("_MAIL_PROG_SERVER_", "SMTP-server");

define("_MAIL_PROGRAM_", "Skicka e-post med");

define("_MAIL_FROM_EMAIL_", "E-postadress");

define("_MAIL_PATH_", "Lokal sökväg till e-postserver (mailer path)");
define("_MAIL_AUTH_", "SMTP-verifiering");

define("_MAIL_AUTH_USER_", "SMTP-användarnamn");
define("_MAIL_AUTH_PASS_", "SMTP-lösenord");

define("_MAIL_SERVER_", "SMTP-server");
define("_MAIL_SERVER_PORT_", "Server-port");

##########################
# ATTACHMENT SETTINGS
##########################
define("_ALLOW_ATTACHMENTS_", "Tillåt fil-bilagor");
define("_ATTACHMENTS_PATH_", "Sökväg till bilaga");

#############################
# GROUPS AND USERS
#############################
define("_USERS_", "Användare");
define("_GROUPS_", "Grupper");
define("_EVERYONE_", "Alla");
define("_SUPER_USER_", "Superanvändare");

define("_MEMBERS_", "Medlemmar");
define("_MEMBERS_OF_", "Medlemmar av");

define("_NAME_", "Namn");
define("_EMAIL_", "E-post");

define("_ACCESS_LVL_", "Åtkomstnivå");
define("_ROLE_", "Användarnivå");
define("_READ_ONLY_", "Endast visning");
define("_NORMAL_","Normal");

define("_ARE_YOU_SURE_DELETE_GROUP_", "Vill du verkligen radera denna grupp?");
define("_GROUPS_SAVE_ATLEAST_1_MEMBER_", "Grupper måste ha minst 1 medlem. Medlemslistan sparades inte.");

# displayed as form field must begin with a character. E.g.
# Username must begin with a character.
define("_MUST_BEGIN_WITH_CHAR_", "måste börja med ett tecken.");

######################
# REMINDERS
######################
define("_REMINDERS_", "Påminnelser");
define("_BEFORE_EVENT_","före denna händelse, på");

define("_WILL_OCCUR_IN_", "börjar om"); # event x will occur in 30 minutes



###########################
# EVEVNT REQUESTS
############################
define("_REQUEST_", "Händelseförfrågan");
define("_REQUESTS_", "Händelseförfrågningar");
define("_REQUEST_ACCEPTED_", "Din händelseförfrågan har accepterats.");
define("_REQUEST_REJECTED_", "Din händelseförfrågan har avböjts.");

define("_NOTIFY_REQUESTOR_", "Meddela frågeställaren");
define("_REQUEST_HAS_NOTIFY_", "Frågeställaren har begärt att meddelas.");
define("_REQUESTS_NO_PENDING_", "Det finns inga obesvarade förfrågningar.");
define("_REQUEST_NOTIFY_EMAIL_", "meddela mig om obesvarade förfrågningar på");
define("_REQUEST_MSG_PRE_", "Meddelande som visas för användare(-n) innan förfrågan skickas.");
define("_REQUEST_MSG_POST_", "Meddelande som visas för användare(-n) efter att förfrågan skickats.");
define("_REQUEST_NOTES_", "Ytterligare noteringar för förfrågan");
define("_REQUEST_NOTIFY_STATUS_", "Meddela status för denna förfrågan på");

define("_CONTACT_", "Kontakt");

# You have a pending event request on calendar: CALENDAR TITLE
define("_PENDING_REQUEST_", "Du har en obesvarad händelseförfrågan i kalender:");


#################
# DATE  ITEMS
#################
define("_CALENDAR_", "Kalender");

define("_MONTH_", "Månad");
define("_MONTHS_", "Månad(-er)");

define("_DAY_","dag");
define("_DAYS_", "dag(-ar)");

define("_YEAR_", "År");
define("_YEARS_", "år");

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
define("_THIS_MONTH_", "Denna månad");

##################
# MISC 
##################
define("_EVENT_", "Händelse");
define("_EVENTS_", "Händelser");
define("_VIEW_", "Visa");

# VIEW AS A NOUN
define("_VIEW_NOUN_", "Visa");

define("_PRINTABLE_VIEW_", "Utskriftsversion");

define("_ALLDAY_", "Hela dagen");

define("_CAL_CALL_FOR_TIMES_", "Kontakta oss för tidpunkt");
define("_CAL_CALL_FOR_TIMES_MIN_", "(*)");

define("_TYPE_","Typ");
define("_EVENT_TYPE_", "Kategori");

define("_WIDTH_", "Bredd");

define("_COLORS_", "Färger");


###########################
# ADMIN PAGE 
###########################
define("_GLOBAL_SETTINGS_", "Inställningar för webbplats");
define("_EDIT_DEFAULT_OPTS_", "Redigera förvalda alternativ");
define("_PASS_MUST_MATCH_", "Angivna lösenord matchar inte");
define("_EMPTY_PASSWORD_", "Not setting password to \"\"!");
define("_ARE_YOU_SURE_DELETE_USER_", "Vill du verkligen radera denna användare?");
define("_DELETE_USERS_EVENTS_", "Radera alla händelser som tillhör denna användare.");
define("_CALENDARS_OWNED_", "Kalendrar som tillhör denna användare");
define("_AUDIT_USERS_", "Redigera användare");
define("_AUDIT_USERS_DESC_", "En användare hittades i Thymes databas, men motsvarande
post i den befintliga autentiseringsmodulen saknas.<br>Alla användarvärden
har satts till den saknade användarens id (uid).");

define("_CALENDAR_PUBLISHER_", "Kalenderpublicerare");
define("_CAL_USER_GUEST_", "Gästkonto");
define("_CAL_PUBLISH_GUEST_DISABLED_", "Kalenderpubliceraren fungerar inte om
       gästkontot är avstängt.  V.g. aktivera detta konto i Användarsektionen.");


####################################
# GENERAL ACTIONS AND RESPONSES
####################################
define("_ADD_", "Lägg till");
define("_NEW_EVENT_", "Ny händelse");
define("_REMOVE_", "Ta bort");
define("_UPDATE_", "Uppdatera");
define("_NEXT_", "Nästa");
define("_PREV_", "Föregående");
define("_DELETE_", "Radera");
define("_SAVE_", "Spara");
define("_TEST_", "Testa");
define("_UPDATE_NOW_", "Uppdatera nu");
define("_SAVE_ADD_", "Spara och lägg till en annan");
define("_CANCEL_", "Avbryt");
define("_BROWSE_", "Bläddra");
define("_NONE_", "Ingen");
define("_RESET_", "Återställ");
define("_CLEAR_ALL_", "Avmarkera alla");
define("_CHECK_ALL_", "Välj alla");
define("_EDIT_", "Redigera");
define("_CLOSE_", "Stäng");
define("_SHOW_", "Visa");
define("_HIDE_", "Göm");
define("_ENABLE_", "Aktivera");
define("_DISABLE_", "Stäng av");
define("_MOVE_", "Flytta");
define("_UP_", "Upp");
define("_DOWN_", "Ner");
define("_ENABLED_", "Aktiverad");
define("_CONFIGURE_", "Ställ in");
define("_ACCEPT_", "Acceptera");
define("_REJECT_", "Neka");
define("_OK_", "OK");
define("_FAILED_", "MISSLYCKADES");
define("_CHANGE_", "Ändra");
define("_SORT_BY_", "Sortera efter");
define("_SEARCH_", "Sök");
define("_FORCE_", "Tvinga");
define("_AUTODETECT_", "Upptäck automatiskt");
define("_RESET_PASS_", "Ändra lösenord");
define("_NEW_PASS_", "Nytt lösenord");
define("_RETYPE_", "Skriv om");
define("_UPDATED_", "Uppdaterad");
define("_SUBMITTED_", "Skickad");
define("_LOGIN_", "Logga in");
define("_USERNAME_", "Användarnamn");
define("_PASSWORD_", "Lösenord");
define("_LOGOUT_", "Logga ut");
define("_OPTIONS_", "Alternativ");
define("_ADMIN_", "Admin");
define("_BAD_PASS_", "Fel användarnamn eller lösenord.");
define("_YES_", "Ja");
define("_NO_", "Nej");
define("_VALUE_", "Värde");
define("_CUSTOM_", "Individuellt");
define("_DEFAULT_", "Förinställt");

######################
# ATTACHMENTS
######################
define("_ATTACHMENTS_", "Bilagor");
define("_ATTACH_DETACH_", "Ta bort");
define("_ATTACH_DELETE_", "Radera");
define("_ATTACHMENT_TOO_BIG_", "Bilagan är större än tillåtet.");
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
define("_FIRST_", "Första");
define("_LAST_", "Sista");
define("_SHOW_TYPE_", "Kategori");

define("_LIST_SIZE_", "Listans storlek");

define("_ARE_NO_EVENTS_", "Det finns inga händelser att visa.");

define("_EVENTS_CONTAINING_", "Händelser innehållande"); # used in event search

define("_ARE_YOU_SURE_DELETE_EVENTS_", "Vill du verkligen radera dessa händelser?");
define("_DELETE_REPEATING_WARNING_", "
   Du har valt att radera en eller flera återkommande händelser.<br>
   Alla införanden (tidigare och kommande) av dessa händelser kommer att raderas! ");

define("_UNCHECK_NO_DELETE_", "Avmarkera alla händelser som du inte vill radera:");
define("_DELETE_CHECKED_", "Radera markerade");

define("_RETURN_", "Tillbaka");
define("_ERROR_", "Fel!");

######################
# EVENT EDIT/ADD/VIEW
######################
define("_GENERAL_", "Allmänt");

define("_ORGANIZER_", "Kalender");

define("_URL_", "URL");

define("_REPEATING_", "Återkommande");

define("_LOCATION_", "Plats");

define("_APPLY_TO_", "Tillämpa ändringar på");
define("_ALL_DATES_", "alla datum");
define("_THIS_DATE_", "bara detta datum");

define("_RESET_INSTANCE_", "Återställ införandet till ursprungsinställningarna");

define("_MAP_", "Karta");

define("_STARTED_", "Startad");

# e.g. Overrides event Weekly Meeting on 2004-2-34
define("_OVERRIDE_EVNT_ON_", "Åsidosätter händelse %s i %s");

# e.g. Warning: the event Event Title has an invalid repeating rule
define("_INVALID_RRULE_", "Varning: Händelse %s innehåller ett ogiltigt repetitionsvillkor.");

define("_MAX_CHARS_", "max. antal tecken");
define("_EVENT_INFO_", "Information om händelsen");
define("_TITLE_", "Rubrik");
define("_NOTES_", "Meddelande");

define("_CHECK_FOR_CONFLICTS_", "kontrollera konflikter");

define("_THIS_EVENT_ALLDAY_", "Detta är en heldagshändelse.");
define("_STARTS_AT_", "Börjar");
define("_DURATION_", "Pågår");

define("_FLAG_", "Flagga");
define("_FLAG_THIS_", "Flagga denna händelse");
define("_IS_FLAGGED_", "händelsen är flaggad");

# e.g. 10 days ago
define("_AGO_", "sedan");

define("_REPEATING_NO_", "Denna händelse upprepas inte.");
define("_REPEATING_REPEAT_", "Upprepa");
define("_REPEATING_SELECTED_", "valda dagar");
define("_REPEATING_EVERY1_", "varje");

define("_REPEAT_ON_", "Upprepa den");
define("_REPEAT_ON1_", "första");
define("_REPEAT_ON2_", "andra");
define("_REPEAT_ON3_", "tredje");
define("_REPEAT_ON4_", "fjärde");
define("_REPEAT_ON5_", "femte");
define("_REPEAT_ONL_", "sista");
define("_REPEAT_ON_OF_", "i månaden, varje");

define("_SIMPLE_", "Enkel");
define("_ADVANCED_","Avancerad");

define("_YEARLY_", "Varje år");
define("_MONTHLY_", "Varje månad");
define("_WEEKLY_", "Varje vecka");
define("_DAILY_", "Dagligen");
define("_EASTER_", "Påsk");
define("_EASTER_YEARLY_", "Påsk varje år");

define("_MONTH_DAYS_", "Månadens dag(-ar)");
define("_FROM_LAST_", "från sista");

define("_WEEKDAYS_", "Veckodag(-ar)");

define("_YEARLY_NOTES_", "Förvald månad och dag tas från startdatum
       om inget väljs.");


define("_SPECIFIC_OCCURRENCES_", "Särskilda händelser");

define("_STARTING_ON_", "börjar på");

define("_BEFORE_", "Före");
define("_AFTER_", "Efter");

define("_EXCLUDE_DATES_", "Exkludera datum");

define("_CONFIRM_EVNT_RPT_CHANGE_", "Du håller på att ändra upprepningsvillkoren eller datum för denna händelse.\n
Alla undantag som är knutna till denna återkommande händelse kommer att förloras. Är du säker på att du vill göra detta?\n");


define("_END_DATE_", "Slutdatum");
define("_END_DATE_NO_", "Inget slutdatum");
define("_END_DATE_UNTIL_", "T.o.m.");
define("_END_DATE_AFTER_", "Slutar efter");
define("_OCCURRENCES_", "händelser");

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
define("_TODAY_LINK_", "Idag länk");
define("_MINI_CAL_", "Mini-Kal");
define("_CALENDAR_LINKS_", "Kalender länkar");
define("_IMAGE_BROWSER_", "Image Browser");
define("_QUICK_ADD_EVNT_", "Snabbtillägg av händelse");
define("_GOTO_DATE_", "Gå till datum");
define("_SEARCH_EVENTS_", "Sök händelser");
define("_EVENT_FILTER_", "Kategori");
define("_COLOR_LEGEND_", "Förklaring");

##################
# SYNC 
##################

define("_SYNC_", "Synk");
define("_IMPORT_", "Importera");
define("_EXPORT_", "Exportera");
define("_IMPORT_FROM_", "Importera från");
define("_EXPORT_TO_", "Exportera till");
define("_SYNC_DUPLICATES_", "Om dubletter hittas");
define("_IGNORE_DUPLICATES_", "Behåll dubletter orörda");
define("_OVERWRITE_EXISTING_EVENT_", "Skriv över befintlig händelse");
define("_CREATE_NEW_EVENT_", "Skapa ny händelse");
define("_IMPORT_AS_", "Importera till katergori");
define("_EVENTS_IMPORTED_", "Händelser importerade");
define("_SYNC_IMPORT_ERROR_", "Fel: Det uppstod ett fel när den fil du försökte importera skulle tolkas.");
define("_HTML_", "HTML");
define("_PLAINTEXT_", "Plain text");
define("_ICAL_", "iCalendar (.ics)");
define("_QUIRKS_MODE_", "Quirks Mode");
define("_PERMISSION_DENIED_", "Medges ej: Du är inte ägare till eller
administratör för den här kalendern.");
define("_FULL_SYNC_", "Full Synk");
define("_FULL_SYNC_DESC_", "Radera händelser som finns i Thyme men som inte kan hittas i den importerade filen.");

#########################
# CSS AND STYLE
#########################
define("_COLOR_", "Färg");

define("_STYLE_", "Stil");

define("_PREVIEW_", "Förhandsvisning");
define("_SAMPLE_", "Exempel");

define("_BACKGROUND_COLOR_", "Bakgrundsfärg");
define("_FONT_COLOR_", "Typsnittsfärg");
define("_FONT_SIZE_", "Typsnittsstorlek");

define("_FONT_STYLE_", "Textstil");
define("_BOLD_", "fet");
define("_ITALICS_", "kursiv");
define("_UNDERLINE_", "understrykning");

define("_FONT_FAMILY_", "Typsnittsfamilj");
define("_FONT_FAMILY_DESC_", "T.ex. Tahoma, 'Sans Serif', Arial");

define("_UNDERLINE_LINKS_", "Stryk under länkar");
define("_NEVER_", "Aldrig");
define("_ALWAYS_", "Alltid");
define("_HOVER_", "Sväva");
define("_BORDER_COLOR_", "Ramfärg");
define("_TIME_FONT_COLOR_", "Typsnittsfärg för tid");
define("_TITLE_FONT_COLOR_", "Typsnittsfärg för rubrik");
define("_TITLE_FONT_STYLE_", "Textstil för rubrik");

#########################
# CALENDAR PUBLISHER
#########################
if(@constant("_CAL_DOING_PUBLISHER_")) { # <- leave this line alone

define("_MINI_MONTH_", "Minimånad");

define("_SET_DATE_CURRENT_", "Satt till dagens datum");
define("_EDITABLE_", "Redigerbar");
define("_STATIC_", "Statisk");
define("_STATIC_DESC_", "kalenderinnehållet inkluderar inga länkar som ändrar datum eller visningssätt");
define("_HIL_DAY_", "Markera dag");
define("_HIL_WEEK_", "Markera vecka");

define("_APPLY_CSS_FROM_", "Använd CSS-stil från");
define("_NO_CSS_", "ingen");
define("_CSS_EDITOR_", "CSS-redigerare");

define("_LANGUAGE_", "Språk");
define("_EURO_DATE_", "Europeisk datumform");
define("_EURO_DATE_DESC_", "Datum visas om möjligt som dd/mm/åååå");

define("_HEADER_", "Rubrik");
define("_WEEKDAY_HEADER_", "Veckodagsrubrik");

define("_NORMAL_DAYS_", "Normala dagar");
define("_DAYS_NOT_IN_MONTH_", "Dagar utanför innevarande månad");
define("_HIGHLIGHTED_DAYS_", "Markerade dagar");

define("_NORMAL_EVENTS_", "Normala händelser");
define("_FLAGGED_EVENTS_", "Flaggade händelser");

define("_SHOW_EVENTS_", "Visa händelser");


define("_EVENT_LINKS_", "Händelselänkar");

define("_EVENT_LINK_URL_", "URL för händelselänk");

define("_EVENT_LINK_URL_DESC_", "

        En frågesträng (query string) innehållande
        <font class='"._CAL_CSS_HIL_."'>eid</font> och <font class='"._CAL_CSS_HIL_."'>instance</font> kommer att skickas till denna url.<br>

        <b>eid</b> är händelsens ID och <b>instance</b> är datum i
        <b>YYYY-MM-DD</b>-format.<br>These are noted by <font class='"._CAL_CSS_HIL_."'>%eid</font>
        and <font class='"._CAL_CSS_HIL_."'>%inst</font>.<br><br>

        T.ex. http://mysite.com/sales/view_sale.php?eid=%eid&instance=%inst kan ge:<br>

        http://mysite.com/sales/view_sale.php?<font
		class='"._CAL_CSS_HIL_."'>eid</font>=56&<font
		class='"._CAL_CSS_HIL_."'>instance</font>=2005-10-26<br><br>
 
        Se dokumentationen och/eller instruktionen (Tutorial) på Thyme:s webbplats för mer information
        hur dessa ska användas. ");


define("_SHOW_HEADER_", "Visa rubrik");
define("_ALIGN_HEADER_TEXT_", "Justera rubriktext");
define("_CENTER_", "Centrera");
define("_HEADER_TEXT_", "Rubriktext");

define("_HEADER_TEXT_DESC_","

   (E.g. <font class='"._CAL_CSS_HIL_."'>Födelsedagar i %month</font>)<br>
        <font size=1><i>Lämna tomt för att använda den förvalda 
        rubriken. Andra variabler inkluderar %weekday, %mday, %mon och %year.</i></font> ");


define("_SHOW_HEADER_LINKS_", "Visa rubriklänkar");

define("_NEXT_LINK_", "Nästa länk");
define("_PREV_LINK_", "Föregående länk");

define("_IMG_URL_", "Bildens URL");

define("_HEADER_LINKS_", "Rubriklänkar");

define("_IMG_URL_DESC_", "
        Kan vara en text såsom t.ex. '<<' eller en URL för en bild<br>
        (E.g. <font
        class='"._CAL_CSS_HIL_."'>http://www.myserver.com/images/next.gif</font>)<br><font
        size=1><i>Lämna tomma för att använda den valda mallens 
       förvalda bild.</i></font> ");


define("_DAY_VIEW_", "Dag-vy");

define("_MONTH_VIEWS_", "Månads-vy");

define("_SHOW_WEEKS_DESC_", "Observera att en minimånad aldrig visar veckonummer");

define("_ROW_HEIGHT_", "Radhöjd");
define("_ROW_HEIGHT_DESC_", "Förval är '90' för en månad, '0' för en minimånad");

define("_LIMIT_WEEKDAY_NAMES_", "Begränsa veckodagsnamn till ");
define("_CHARS_", "tecken");

define("_EXCLUDE_MONTH_DAYS_", "Exkludera dagar som inte ingår i månad");

define("_MINI_MONTH_DATE_URL_", "URL fö Minimånad-datum");

define("_MINI_MONTH_DATE_URL_DESC_", "
        Länken som ett klick på en dag i minimånadskalendern
        pekar till. Detta ersätter följande strängar:<br>

        %d = dagens nummer<br>
        %m = månadens nummer<br>
        %y = årets nummer<br>

        <br><br>

        T.ex. http://www.myserver.com/page.php?day=%d&month=%m&year=%y<br>
        kan ge
        <font class='"._CAL_CSS_HIL_."'>http://www.myserver.com/page.php?day=23&month=11&year=2004</font>

        <br>eller du kan t.o.m. använda en Javascript-funktion.<br>

        T.ex. <font class='"._CAL_CSS_HIL_."'>javascript:myFunction(%y,%m,%d)</font><br><br>

        Förval är en länk till innevarande sida som anger:<br>
        m = %m<br>
        d = %d<br>
        y = %y<br>

        T.ex. <font class='"._CAL_CSS_HIL_."'>index.php?d=23&m=11&y=2004</font><br><br>
        Se dokumentationen och/eller instruktionen (Tutorial) på Thyme:s webbplats för mer information
        hur dessa ska användas.");


define("_GENERATED_CODE_", "Genererad kod");

define("_BASE_PATH_DESC_", "base path of thyme with trailing slash");
define("_BASE_URL_DESC_", "base url of thyme with trailing slash");

} # </ CALENDAR PUBLISHER SECTION > <- leave this line alone


######################
#
### RSS FEED MODULES
#
#####################
define("_RSS_FEED_MODULES_", "RSS-strömmoduler");
define("_RSS_", "RSS-strömmar");
define("_UPDATE_INTERVAL_", "Updatera intervall");
define("_ARE_YOU_SURE_DELETE_RSSMOD_", "Är du säker på att du vill radera den här RSS-modulen?");
define("_AUTHOR_", "Skapare");

# scrolling
define("_SCROLLING_","Rullning");
define("_OVERFLOW_", "Överspill");
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

define("_DEFAULT_VIEW_", "Förvalt visningssätt");

define("_DEFAULT_CALENDAR_", "Förvald kalender");

define("_TIME_INTERVALS_", "Tidsintervall");

define("_EVNT_SIZE_", "Händelse textstorlek");
define("_SMALLER_", "Mindre");
define("_SMALLEST_", "Minsta");
define("_EVNT_COLLAPSE_", "Fäll ihop händelser (Månadsvisning)");
define("_EVNT_COLLAPSE_DESC_", "Fäll ihop långa händelserubriker.");
define("_EVNT_TYPE_NAME_", "Visa händelsekategorier.");
define("_EVNT_POPUP_", "Snabbmeny för händelser");
define("_EVNT_POPUP_DESC_", "Visa händelser i nytt fönster.");
define("_EVNT_NOTES_POPUP_", "Popup-Fönster för händelsemeddelande");
define("_EVNT_NOTES_POPUP_DESC_", "Låt din muspekare sväva över en händelse
	för att läsa dess noteringar.");

define("_POSITION_", "Placering");

define("_SHOW_WEEKS_", "Visa veckonummer");

define("_WEEK_START_", "Veckan inleds med");
define("_WORK_HOURS_", "Arbetstid");
define("_WORK_HOURS_START_", "Börjar");
define("_WORK_HOURS_END_", "Slutar");

define("_HOUR_FORMAT_", "Tidsformat");
define("_HOUR_FORMAT_12_", "12 tim");
define("_HOUR_FORMAT_24_", "24 tim");

define("_LOCALE_", "Lokalanpassning");

define("_NAV_BAR_LOC_", "Navigeringsrad");
define("_RIGHT_", "Höger");
define("_LEFT_", "Vänster");

define("_TIMEZONE_", "Tidzon");
define("_DST_", "Sommartid");
define("_STARTS_", "Börjar");
define("_ENDS_", "Slutar");

define("_IN_", "in");
define("_ON_", "PÅ");
define("_OFF_", "AV");

define("_THEME_", "Mall");

##########################
# CONTACT OPTIONS
##########################
define("_CONTACT_OPTS_", "Kontaktalternativ");
define("_PRIMARY_", "Primär");
define("_FORMAT_", "Format");

##########################
# SUBSCRIPTIONS
##########################
define("_SUBSCRIPTIONS_", "Prenumerationer");
define("_SUBSCRIPTIONS_DESC_", "Prenumerationer på kalendrar via e-post.");

######################
# NOTIFICATIONS
#####################
define("_NOTIFICATIONS_", "Meddelanden");
define("_NOTIFICATIONS_DESC_", "Meddelandefilter för nya och uppdaterade händelser.");

define("_TITLE_CONTAINS_", "Rubriken innehåller");
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
define("_DST_OPTS11_", "Europa / EU, UK, Grönland");
define("_DST_OPTS12_", "Europa / Ryssland");
define("_DST_OPTS13_", "Nordamerika / USA, Kanada, Mexiko");
define("_DST_OPTS14_", "Nordamerika / Kuba");
define("_DST_OPTS15_", "Sydamerika / Chile");
define("_DST_OPTS16_", "Sydamerika / Paraguay");
define("_DST_OPTS17_", "Sydamerika / Falklandsöarna");

####################
# TIMEZONE STRINGS
####################
define("_GMT_PLUS_0.0_","GMT +00:00 Storbritannien, Irland, Portugal, Västafrika ");
define("_GMT_PLUS_0.5_","GMT +00:30 ");
define("_GMT_PLUS_1.0_","GMT +01:00 Västeuropa, Centralafrika");
define("_GMT_PLUS_1.5_","GMT +01:30 ");
define("_GMT_PLUS_2.0_","GMT +02:00 Östeuropa, Östafrika");
define("_GMT_PLUS_2.5_","GMT +02:30 ");
define("_GMT_PLUS_3.0_","GMT +03:00 Ryssland, Saudiarabien");
define("_GMT_PLUS_3.5_","GMT +03:30 ");
define("_GMT_PLUS_4.0_","GMT +04:00 Arabien");
define("_GMT_PLUS_4.5_","GMT +04:30 ");
define("_GMT_PLUS_5.0_","GMT +05:00 Västra Asien, Pakistan");
define("_GMT_PLUS_5.5_","GMT +05:30 Indien");
define("_GMT_PLUS_6.0_","GMT +06:00 Centralasien");
define("_GMT_PLUS_6.5_","GMT +06:30 ");
define("_GMT_PLUS_7.0_","GMT +07:00 Bangkok, Hanoi, Jakarta");
define("_GMT_PLUS_7.5_","GMT +07:30 ");
define("_GMT_PLUS_8.0_","GMT +08:00 Kina, Singapore, Taiwan");
define("_GMT_PLUS_8.5_","GMT +08:30 ");
define("_GMT_PLUS_9.0_","GMT +09:00 Korea, Japan");
define("_GMT_PLUS_9.5_","GMT +09:30 Centrala Australien");
define("_GMT_PLUS_10.0_","GMT +10:00 Östra Australien");
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
define("_GMT_MINUS_4.0_","GMT -04:00 Bolivien, Västra Brasilien, Chile, Atlanten");
define("_GMT_MINUS_3.5_","GMT -03:30 Newfoundland");
define("_GMT_MINUS_3.0_","GMT -03:00 Argentina, Östra Brasilien, Grönland");
define("_GMT_MINUS_2.5_","GMT -02:30 ");
define("_GMT_MINUS_2.0_","GMT -02:00 Mellersta Atlanten");
define("_GMT_MINUS_1.5_","GMT -01:30 ");
define("_GMT_MINUS_1.0_","GMT -01:00 Azorerna/Östra Atlanten");
define("_GMT_MINUS_0.5_","GMT -00:30 ");

}

##########################
# ERRORS AND WARNINGS
##########################
define("_WARNING_ATTACH_", "Varning: Bilagekatalog %s finns inte eller är inte skrivbar.");
define("_WARNING_RSS_", "Varning: RSS-strömsarkiv %s är inte skrivbart.");
define("_WARNING_INSTALL_", "Varning: %s existerar fortfarande. V.g. ta bort denna fil.");
define("_WARNING_LICENSE_", "Varning: Thyme's licens upphör att gälla om %s dagar.");


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
   'Q','R','S','T','U','V','W','X','Y','Z','Å','Ä','Ö');

#####################
# "AUTOMAGIC" 
#####################
# weekdays
global $_cal_weekdays, $_cal_weekdays_abbr, $_cal_months, $_cal_months_abbr;

$_cal_weekdays or $_cal_weekdays = array(
  "Söndag",
  "Måndag",
  "Tisdag",
  "Onsdag",
  "Torsdag",
  "Fredag",
  "Lördag");

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


