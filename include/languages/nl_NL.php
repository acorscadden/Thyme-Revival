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

define("_LANG_NAME_", "Dutch (NL)");

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
define("_GLOBAL_VIEWS_", "Globaal Overzicht");

define("_ALLOW_EVERYONE_VIEW_", "Laat toe aan iedereen alle kalenders te zien in dit Overzicht ongeacht van hun ledenlijsten");

define("_HIDE_VIEW_FROM_GUESTS_", "Verberg dit Overzicht voor gastgebruikers");

define("_REQUEST_NOTIFY_OWNER_", "Waarschuw kalender eigenaar van hangende aanvragen");

define("_ALL_CALENDARS_", "Alle Kalenders Overzicht");

#################################
#
### INSTALLER
#
#################################

# some of these will not be used until 2.0
define("_INSTALLER_", "Installer");
define("_PACKAGE_", "Pakket");
define("_INSTALL_", "Installeer");
define("_INVALID_PACKAGE_", "De file die u oplaadde is geen geldig Thyme pakket.");
define("_INSTALLED_MODULES_", "Installeerde Modules");
define("_UNINSTALL_", "Verwijder Installatie");
define("_LOCAL_FILE_","Locale File");
define("_UPDATES_", "Updates");
define("_AVAILABLE_UPDATES_", "Beschikbare Updates");
define("_CHECK_FOR_UPDATES_", "Controleer voor Updates");
define("_LAST_CHECKED_ON_", "Laatst gecontroleerd op"); # e.g. last checked on 1/2/2007
define("_FILE_", "File");
define("_WRITABLE_", "Schrijfbaar");
define("_REFRESH_", "Vernieuw");
define("_INVALID_DOWNLOAD_", "Ongeldige download. Update file onmogelijk.");
define("_UNABLE_TO_BACKUP_", "Backup huidige file onmogelijk.");
define("_UPDATES_AVAIL_", "%s updates beschikbaar"); # %s will be replaced w/# of updates available

############################
#
### NEW USER DEFINITIONS
#
###########################
define("_REGISTERED_USERS_", "Geregistreerde gebruikers");
define("_PUBLIC_", "Publiek");
define("_PUBLIC_ACCESS_", "Publieke Toegang");

#############################
#
### MULTIPLE REMINDERS
#
#############################
define("_BEFORE_EVENT_MULTI_", "voor dit evenement");
define("_USER_CAN_NOT_VIEW_", "%s heeft geen toegang om deze kalender te zien.");
define("_ALLOW_CONFIGURE_REMINDERS_", "Geef %s toegang om event herinneringen te bewerken voor alle gebruikers.");
define("_CALENDAR_ADMINS_", "Kalender administrators");
define("_EVENT_OWNER_", "Evenement eigenaar");
define("_SITE_ADMINS_", "Site administrators");
define("_NO_ONE_", "Niemand");

###############################
#
## CONFIGURABLE JOB INTERVALS
#
###############################

define("_REMIND_AT_LEAST_", "Tenminste");
define("_SCHEDULED_TASK_", "Geplande Taak");
define("_NO_SCHEDULED_TASK_", "De Thyme geplande taak is niet ingesteld voor behandeling");
define("_SCHEDULED_TASK_CONFIGURED_", "De Thyme geplande taak is ingesteld voor elke behandeling");
define("_PHP_CLI_", "PHP CLI lokatie");

###################################
#
### CUSTOMIZE SITE
#
###################################
define("_CUSTOMIZE_SITE_", "Instellen Site");
define("_SITE_NAME_", "Site Naam");
define("_SITE_THEME_", "Site Thema");
define("_SITE_THEME_DESC_", "instellen op Geen laat gebruikers toe hun eigen thema te kiezen");

# use exact HTML tags, they will be displayed correctly
# when printed
define("_SITE_HEADER_", "Site hoofding");
define("_SITE_HEADER_DESC_", "Na <body> tag");

define("_SITE_FOOTER_", "Site voetnoot");
define("_SITE_FOOTER_DESC_", "Voor </body> tag");

define("_SITE_HEAD_", "Site Hoofd");
define("_SITE_HEAD_DESC_", "Tussen <head> </head> tags.");


####################################
#
### LICENSE KEY
#
####################################
define("_ENTER_LICENSE_KEY_", "Enter licentie code");
define("_LICENSE_KEY_", "Licentie code");
define("_LICENSE_KEY_ACCEPTED_", "Licentie code aanvaard");
define("_INVALID_LICENSE_KEY_", "De opgegeven licentie code is niet geldig voor deze site");

####################################
#
### EVENT REQUEST DESCRIPTION
#
####################################
define("_REQUEST_MODE_VIEW_ONLY_", "Enkel-overzicht leden mogen eventaanvragen indienen. Normale gebruikers mogen rechtstreeks toevoegen.");
define("_REQUEST_MODE_NORMAL_", "Enkel-overzicht leden mogen de kalender enkel bekijken. Normale gebruikers mogen eventaanvragen indienen.");

#####################################
#
### TELL A FRIEND FOR GUEST E-MAILS
#
######################################
define("_TELL_A_FRIEND_", "Vertel een Vriend");

define("_YOUR_NAME_", "Uw naam");
define("_YOUR_EMAIL_", "Uw e-mail");

define("_YOUR_FRIENDS_NAME_","Naam van vriend");
define("_YOUR_FRIENDS_EMAIL_","E-mail van vriend");

define("_EMAIL_EVENT_DISPLAYED_","Het event zal getoond worden onder uw bericht.");

define("_ALLOW_GUEST_USERS_EMAIL_", "Gastgebruikers toelaten een event te zenden.");

define("_DISABLE_SITE_ADDR_BOOK_", "Site adresboek onbruikaar maken voor niet-admins");

define("_EMAIL_TO_MULTIPLE_", "Scheid meerdere adressen met een comma.");

# MISC
########
define("_HELP_", "Hulp");
define("_WARNING_DIR_NOT_WRITABLE_", "Waarschuwing: De folder %s is NIET schrijfbaar.");
define("_WARNING_FILE_NOT_WRITABLE_", "Waarschuwing: De file %s is NIET schrijfbaar.");
define("_DOWNLOAD_", "Download");
define("_HIDE_QUICK_ADD_", "Verberg Snel Evenement Toevoegen box");
define("_FORCE_DEFAULT_OPTS_", "Forceer standaardopties voor alle gebruikers. Stel in in Admin - Standaardopties.");
define("_NO_GUEST_TIMEZONE_", "Gastgebruikers niet toelaten om tijzone te veranderen.");
define("_NUMBER_SYMBOL_", '#');
define("_DISABLE_WYSIWYG_EDITOR_", "WYSIWYG editor onbruikbaar maken voor evenement nota's.");
define("_SHOW_CALENDAR_NAMES_", "Toon kalendernamen wanneer tonen evenement categorienamen
        ingesteld is in gebruikersopties.");
define("_MISC_", "Misc");
define("_THEME_POPUPS_", "Gebruik thema voor evenementnota's popups.");

define("_PUBLIIC_", "Publiek");
define("_REGISTERED_USERS_", "Geregistreerde Gebruikers");

define("_NEW_", "Nieuw");

define("_CATEGORY_EDIT_DESC_", "Om een categorie te bewerken, klik op z'n titel");

define("_ARE_YOU_SURE_DELETE_", "Ben je zeker? Wil je %s verwijderen?");

########## END NEW TRANSLATIONS #################


################################
# EDIT / VIEW / POST CALENDARS
################################
define("_CALENDARS_", "Kalenders");
define("_OWNER_", "Eigenaar");
define("_ARE_YOU_SURE_DELETE_CALENDAR_", "Weet u zeker dat u deze kalender wilt verwijderen?");

define("_COLOR_BY_", "Kleur evenementen met");
define("_BY_OWNER_", "Eigenaar evenement");
define("_BY_CATEGORY_", "Evenementcategorie");
define("_BY_CALENDAR_", "Kalender");

define("_MODE_", "Mode");

define("_ALLOW_MULTI_CATS_", "Meerdere categorieën voor evenementen toestaan");

define("_REMEMBER_LOCATIONS_", "Locaties onthouden");

define("_STRICT_EVENT_SECURITY_", "Strikte evenementbeveiliging");
define("_STRICT_EVENT_SECURITY_DESC_", "Alleen de eigenaar of de kalenderadministrator kan bestaande evenementen wijzigen of verwijderen.");

define("_REMOTE_ACCESS_", "Toegang-op-afstand");
define("_REMOTE_ACCESS_DESC_", "Toegang-op-afstand maakt het mogelijk dat gebruikers zich op afstand abonneren op deze kalender met programma's zoals Mozilla Sunbird, Windates, of Apple iCal. Het maakt ook RSS syndication mogelijk, zichtbaar van RSS readers (RssReader, Shrook..,) sommige contentproviders (Yahoo!, MSN..) en content management tools (PHP-Nuke, Mambo..).");

define("_ENABLE_REMOTE_ACCESS_UPD_", "Toegang-op-afstand updates toestaan. Dit staat geautoriseerde gebruikers toe updates op deze kalender te publiseren middels 3rd-party toepassingen.");

define("_REMOTE_ACCESS_DESC_USERS_", "Als de gastgebruiker geen lid is van deze kalender, voor toegang tot deze kalender is een gebruikersnaam en wachtwoord nodig. Eenmaal gewaarmerkt, word toegang verleend of geweigerd op basis van de ledenconfiguratie.");

define("_SYNDICATION_", "Syndicatie");

define("_EDIT_EVENT_TYPES_", "Wijzig categorieën");

define("_EVENT_TYPES_", "Categorieën");

define("_EVENT_TYPES_DESC_", "Laat alles ongeselecteerd om alle categorieën te gebruiken.<BR><BR>");

define("_MULTI_SELECT_WIN_","
       Windows: houd de Ctrl-toets tijdens het selecteren ingedrukt <br>om een item te de-selecteren of om meerdere, <br>niet-gelijktijdige items te selecteren.");

define("_REALLY_DELETE_EVENT_TYPE_", "Wilt u echt deze categorie verwijderen?"); # question
define("_DELETE_ALL_IN_CATEGORY_", "verwijder alle evenementen in deze categorie.");

define("_VIEWS_NO_ACTION_", "Deze actie kan niet op een overzicht worden uitgevoerd. Selecteer een kalender.");

define("_VIEW_INVALID_CAL_", "Het huidige overzicht bevat een kalender waar u geen lid van bent. Evenementen van deze kalender zullen niet worden weergegeven.");

define("_DESCRIPTION_", "Beschrijving");
define("_DETAILS_", "details");
define("_PUBLISH_", "publiceer");
define("_PUBLISH_DESC_", "Publiceer deze kalender op een webserver of service op afstand zoals
<a class='". _CAL_CSS_BODY_ ." ". _CAL_CSS_ULINE_."' target=_blank
href='http://icalx.com'>iCal Exchange</a>");
define("_SERVER_RESPONSE_", "Serverrespons");



######################
# EMAIL EVENT
######################
define("_EMAIL_EVENT_", "E-Mail");
define("_EMAIL_TO_", "Aan");
define("_SEND_EMAIL_", "Zend");
define("_SUBJECT_", "Onderwerp");
define("_MESSAGE_", "Bericht");
# e.g. Het evenement is verzonden aan abcdefg@alphabet.com
define("_EMAIL_SENT_TO_", "Het evenement is verzonden aan ");
define("_EMAIL_NO_ADDR_WARNING_", "Waarschuwing: u hebt geen emailadres opgegeven in de sectie Contactopties onder Opties. Uw e-mail lijkt te komen van ". @constant("_CAL_MAIL_FROM_"));

######################
# EMAIL SETTINGS
######################
define("_MAIL_PROG_PHP_", "PHP's mailfunctie");
define("_MAIL_PROG_CMD_", "lokale mailer (sendmail, qmail, etc..)");
define("_MAIL_PROG_SERVER_", "SMTP server");

define("_MAIL_PROGRAM_", "Verzend mail middels");

define("_MAIL_FROM_EMAIL_", "Emailadres");

define("_MAIL_PATH_", "lokaal mailerpad");
define("_MAIL_AUTH_", "SMTP Authenticatie");

define("_MAIL_AUTH_USER_", "SMTP gebruikersnaam");
define("_MAIL_AUTH_PASS_", "SMTP wachtwoord");

define("_MAIL_SERVER_", "SMTP server");
define("_MAIL_SERVER_PORT_", "Serverpoort");

##########################
# ATTACHMENT SETTINGS
##########################
define("_ALLOW_ATTACHMENTS_", "Bijlagen toestaan");
define("_ATTACHMENTS_PATH_", "Pad bijlagen");

#############################
# GROUPS AND USERS
#############################
define("_USERS_", "Gebruikers");
define("_GROUPS_", "Groepen");
define("_EVERYONE_", "Iedereen");
define("_SUPER_USER_", "Supergebruiker");
define("_MEMBERS_", "Leden");
define("_MEMBERS_OF_", "Leden van");

define("_NAME_", "Naam");
define("_EMAIL_", "Email");

define("_ACCESS_LVL_", "Toegansniveau");
define("_ROLE_", "Rol");
define("_READ_ONLY_", "Alleen bekijen");
define("_NORMAL_","Normaal");

define("_ARE_YOU_SURE_DELETE_GROUP_", "Weet u zeker dat u deze groep wilt verwijderen?");
define("_GROUPS_SAVE_ATLEAST_1_MEMBER_", "Groepen moeten tenminste 1 lid hebben. Ledenlijst niet bewaard.");

# displayed as form field must begin with a character. E.g.
# Username must begin with a character.
define("_MUST_BEGIN_WITH_CHAR_", "moet beginnen met een letter.");

######################
# REMINDERS
######################
define("_REMINDERS_", "Herinneringen");
define("_BEFORE_EVENT_","voor dit evenement, op");

define("_WILL_OCCUR_IN_", "zal ingaan binnen"); # event x will occur in 30 minutes



###########################
# EVEVNT REQUESTS
############################
define("_REQUEST_", "Evenementaanvraag");
define("_REQUESTS_", "Evenementaanvragen");
define("_REQUEST_ACCEPTED_", "Uw evenementaanvraag is aanvaard.");
define("_REQUEST_REJECTED_", "Uw evenementaanvraag is afgewezen.");

define("_NOTIFY_REQUESTOR_", "Bericht aanvrager");
define("_REQUEST_HAS_NOTIFY_", "De aanvrager heeft om bericht gevraagd.");
define("_REQUESTS_NO_PENDING_", "Er zijn geen lopende aanvragen.");
define("_REQUEST_NOTIFY_EMAIL_", "bericht mij van een lopende aanvraag op");
define("_REQUEST_MSG_PRE_", "Bericht aan gebruikers getoond voordat aanvraag is verzonden.");
define("_REQUEST_MSG_POST_", "Bericht aan gebruikers getoond nadat aanvraag is verzonden.");
define("_REQUEST_NOTES_", "Aanvullende aanvraagnota's");
define("_REQUEST_NOTIFY_STATUS_", "Bericht me van de status van deze aanvraag op");

define("_CONTACT_", "Contact");

# You have a pending event request on calendar: CALENDAR TITLE
define("_PENDING_REQUEST_", "U heeft een lopende evenementaanvraag op kalender:");


#################
# DATE  ITEMS
#################
define("_CALENDAR_", "Kalender");

define("_MONTH_", "Maand");
define("_MONTHS_", "Maand(en)");

define("_DAY_","Dag");
define("_DAYS_", "Dag(en)");

define("_YEAR_", "Jaar");
define("_YEARS_", "Jaren");

define("_WEEK_", "Week");

# abreviated week
define("_WEEK_ABBR_", "Wk.");

define("_WEEKS_", "Weken");

define("_HOUR_", "Uur");
define("_HR_", "u.");
define("_HOURS_", "uren");
define("_HRS_", "u.");

define("_MINS_", "min.");
define("_MINUTES_", "minuten");

define("_DATE_", "Datum");
define("_TIME_", "Tijd");

define("_AM_", "vm");
define("_AM_SHORT_", "vm");
define("_PM_", "nm");
define("_PM_SHORT_", "nm");

# VIEWS
define("_TODAY_", "Vandaag");
define("_THIS_WEEK_", "Deze week");
define("_THIS_MONTH_", "Deze maand");

##################
# MISC 
##################
define("_EVENT_", "Evenement");
define("_EVENTS_", "Evenementen");
define("_VIEW_", "Bekijk");

# VIEW AS A NOUN
define("_VIEW_NOUN_", "Overzicht");

define("_PRINTABLE_VIEW_", "Afdrukbaar overzicht");

define("_ALLDAY_", "Alle dagen");

define("_CAL_CALL_FOR_TIMES_", "Contact ons voor tijden");
define("_CAL_CALL_FOR_TIMES_MIN_", "(*)");

define("_TYPE_","Type");
define("_EVENT_TYPE_", "Categorie");

define("_WIDTH_", "Breedte");

define("_COLORS_", "Kleuren");

# list seperator. Note space after comma
define("_LIST_SEP_",", ");

###########################
# ADMIN PAGE 
###########################
define("_GLOBAL_SETTINGS_", "Site-instellingen");
define("_EDIT_DEFAULT_OPTS_", "Standaardopties");
define("_PASS_MUST_MATCH_", "Het opgegeven wachtwoord klopt niet");
define("_EMPTY_PASSWORD_", "Wachtwoord niet ingesteld op \"\"!");
define("_ARE_YOU_SURE_DELETE_USER_", "Weet u zeker dat u deze gebruiker wilt verwijderen?");
define("_DELETE_USERS_EVENTS_", "Verwijder alle evenementen van deze gebruiker.");
define("_CALENDARS_OWNED_", "Kalenders eigendom van deze gebruiker");
define("_AUDIT_USERS_", "Controleer gebruikers");
define("_AUDIT_USERS_DESC_", "Gebruikers gevonden in Thyme's database, maar deze hebben geen corresponderende ingang in de huidige authenticatiemodule.<br>Alle gebruikerswaarden zijn ingesteld op de uid van de ontbrekende gebruiker.");

define("_CALENDAR_PUBLISHER_", "Kalenderpublisher");
define("_CAL_USER_GUEST_", "Gastgebruiker");
define("_CAL_PUBLISH_GUEST_DISABLED_", "De kalenderpublisher zal niet werken als Gastgebruiker uitstaat. Zet de gebruiker aan in de Gebruikerssectie.");


####################################
# GENERAL ACTIONS AND RESPONSES
####################################
define("_ADD_", "Toevoegen");
define("_NEW_EVENT_", "Nieuw evenement");
define("_REMOVE_", "Verwijderen");
define("_UPDATE_", "Bijwerken");
define("_NEXT_", "Volgende");
define("_PREV_", "Vorige");
define("_DELETE_", "Wissen");
define("_SAVE_", "Bewaren");
define("_TEST_", "Testen");
define("_UPDATE_NOW_", "Nu bijwerken");
define("_SAVE_ADD_", "Bewaar en andere toevoegen");
define("_CANCEL_", "Annuleren");
define("_BROWSE_", "Bladeren");
define("_NONE_", "Geen");
define("_RESET_", "Herstellen");
define("_CLEAR_ALL_", "Alles wissen");
define("_CHECK_ALL_", "Alles controleren");
define("_EDIT_", "Wijzigen");
define("_CLOSE_", "Sluiten");
define("_SHOW_", "Tonen");
define("_HIDE_", "Verbergen");
define("_ENABLE_", "Aanzetten");
define("_DISABLE_", "Uitzetten");
define("_MOVE_", "Verplaatsen");
define("_UP_", "Op");
define("_DOWN_", "Neer");
define("_ENABLED_", "Aan/Uit");
define("_CONFIGURE_", "Configureren");
define("_ACCEPT_", "Accepteren");
define("_REJECT_", "Afwijzen");
define("_OK_", "OK");
define("_FAILED_", "MISLUKT");
define("_CHANGE_", "Veranderen");
define("_SORT_BY_", "Sorteren op");
define("_SEARCH_", "Zoeken");
define("_FORCE_", "Forceren");
define("_AUTODETECT_", "Autodetect");
define("_RESET_PASS_", "Wachtwoord wijzigen");
define("_NEW_PASS_", "Nieuw wachtwoord");
define("_RETYPE_", "Nogmaals");
define("_UPDATED_", "Bijgewerkt");
define("_SUBMITTED_", "Verzonden");
define("_LOGIN_", "Aanmelden");
define("_USERNAME_", "Gebruikersnaam");
define("_PASSWORD_", "Wachtwoord");
define("_LOGOUT_", "Afmelden");
define("_OPTIONS_", "Opties");
define("_ADMIN_", "Admin");
define("_BAD_PASS_", "Gebruikersnaam of wachtwoord onjuist.");
define("_YES_", "Ja");
define("_NO_", "Nee");
define("_VALUE_", "Waarde");
define("_CUSTOM_", "Aangepast");
define("_DEFAULT_", "Standaard");

######################
# ATTACHMENTS
######################
define("_ATTACHMENTS_", "Bijlagen");
define("_ATTACH_DETACH_", "Losmaken");
define("_ATTACH_DELETE_", "Wissen");
define("_ATTACHMENT_TOO_BIG_", "Bijlage is groter dan de toegestane grootte.");
define("_DOWNLOAD_ZIP_", "Download Zip");
define("_UPDATE_ATTACHMENTS_", "Bijlagen bijwerken");

define("_BYTES_", "B");
define("_KBYTES_", "KB");
define("_MBYTES_", "MB");


#################
# EVENT LIST VIEW 
#################
define("_ALL_", "Alle");
define("_UPCOMING_", "Toekomstige");
define("_PAST_", "Verleden");

define("_SHOWING_", "Tonen");
define("_OF_", "van");
define("_FIRST_", "Eerste");
define("_LAST_", "Laatste");
define("_SHOW_TYPE_", "Categorie");

define("_LIST_SIZE_", "Lijstgrootte");

define("_ARE_NO_EVENTS_", "Er zijn geen evenementen te bekijken.");

define("_EVENTS_CONTAINING_", "Evenementen met"); # used in event search

define("_ARE_YOU_SURE_DELETE_EVENTS_", "Weet u zeker dat u deze evenementen wilt verwijderen?");
define("_DELETE_REPEATING_WARNING_", "
   U hebt gekozen om een of meer repeterende evenementen te verwijderen.<br>
   Alle gevallen (verleden en toekomst) van deze evenementen zullen worden verwijderd! ");

define("_UNCHECK_NO_DELETE_", "De-selecteer de evenementen die u niet wilt verwijderen:");
define("_DELETE_CHECKED_", "Verwijder geselecteerde");

define("_RETURN_", "Terug");
define("_ERROR_", "Fout!");

######################
# EVENT EDIT/ADD/VIEW
######################
define("_GENERAL_", "Algemeen");

define("_ORGANIZER_", "Organiser");

define("_URL_", "URL");

define("_REPEATING_", "Repeterend");

define("_LOCATION_", "Locatie");

define("_APPLY_TO_", "Wijzigingen toepassen op");
define("_ALL_DATES_", "alle data");
define("_THIS_DATE_", "alleen deze datum");

define("_RESET_INSTANCE_", "Herstel alle gevallen naar hun originele status");

define("_MAP_", "Map");

define("_STARTED_", "Gestart");

# e.g. Overrides event Weekly Meeting on 2004-2-34
define("_OVERRIDE_EVNT_ON_", "Overschrijf het evenement %s op %s");

# e.g. Warning: the event Event Title has an invalid repeating rule
define("_INVALID_RRULE_", "Waarschuwing: het evenement %s heeft een ongeldige repeteringsregel.");

define("_MAX_CHARS_", "maximum kar.");
define("_EVENT_INFO_", "Evenementinformatie");
define("_TITLE_", "Titel");
define("_NOTES_", "Notities");

define("_CHECK_FOR_CONFLICTS_", "controleer op conflicten");

define("_THIS_EVENT_ALLDAY_", "Dit is een <b>alle dagen</b> evenement.");
define("_STARTS_AT_", "Start op");
define("_DURATION_", "Duur");

define("_FLAG_", "Markeren");
define("_FLAG_THIS_", "Markeer dit evenement");
define("_IS_FLAGGED_", "dit evenement is gemarkeerd");

# e.g. 10 days ago
define("_AGO_", "geleden");

define("_REPEATING_NO_", "Dit evenement repeteert niet.");
define("_REPEATING_REPEAT_", "Repeteren");
define("_REPEATING_SELECTED_", "geselecteerde dagen");
define("_REPEATING_EVERY1_", "elke");

define("_REPEAT_ON_", "Repeteer op de");
define("_REPEAT_ON1_", "eerste");
define("_REPEAT_ON2_", "tweede");
define("_REPEAT_ON3_", "derde");
define("_REPEAT_ON4_", "vierde");
define("_REPEAT_ON5_", "vijfde");
define("_REPEAT_ONL_", "laatste");
define("_REPEAT_ON_OF_", "van de maand, elke");

define("_SIMPLE_", "Simpel");
define("_ADVANCED_","Geavanceerd");

define("_YEARLY_", "Jaarlijks");
define("_MONTHLY_", "Maandelijks");
define("_WEEKLY_", "Wekelijks");
define("_DAILY_", "Dagelijks");
define("_EASTER_", "Pasen");
define("_EASTER_YEARLY_", "Pasen jaarlijks");

define("_MONTH_DAYS_", "Maanddag(en)");
define("_FROM_LAST_", "van laatste ");

define("_WEEKDAYS_", "Weekdag(en)");

define("_YEARLY_NOTES_", "Standaardmaand en -dag worden van de startdatum genomen als er geen geselecteerd worden.");


define("_SPECIFIC_OCCURRENCES_", "Specifieke gebeurtenissen");

define("_STARTING_ON_", "starten op");

define("_BEFORE_", "voor");
define("_AFTER_", "na");

define("_EXCLUDE_DATES_", "Data uitsluiten");

define("_CONFIRM_EVNT_RPT_CHANGE_", "U verandert de repeteringsregel of -data van dit evenement.\n
Alle, met dit evenement geassocieerde, uitzonderingen zullen verloren gaan. Weet u zeker dat u dat wilt?\n");


define("_END_DATE_", "Einddatum");
define("_END_DATE_NO_", "Geen einddatum");
define("_END_DATE_UNTIL_", "Tot");
define("_END_DATE_AFTER_", "Einde na");
define("_OCCURRENCES_", "gebeurtenissen");

define("_ADDRESS_", "Adres");
define("_ADDRESS_1_", "Straat");
define("_ADDRESS_2_", "Stad, Postcode");

define("_PHONE_", "Telefoon");
define("_ICON_", "Ikoon");

#####################
# MODULES
#####################
define("_NAVBAR_", "Nav.balk");
define("_MODULE_", "Module");
define("_MODULES_", "Modules");
define("_TODAY_LINK_", "Vandaag-link");
define("_MINI_CAL_", "Minikalender");
define("_CALENDAR_LINKS_", "Kalenderlinks");
define("_IMAGE_BROWSER_", "Image-browser");
define("_QUICK_ADD_EVNT_", "Snel evenement toevoegen");
define("_GOTO_DATE_", "Ga naar datum");
define("_SEARCH_EVENTS_", "Zoek evenementen");
define("_EVENT_FILTER_", "Categorie");
define("_COLOR_LEGEND_", "Legende");

##################
# SYNC 
##################

define("_SYNC_", "Synchroniseren");
define("_IMPORT_", "Importeren");
define("_EXPORT_", "Exporteren");
define("_IMPORT_FROM_", "Importeer van");
define("_EXPORT_TO_", "Exporteer naar");
define("_SYNC_DUPLICATES_", "Als duplicaten worden gevonden");
define("_IGNORE_DUPLICATES_", "Negeer duplicaten");
define("_OVERWRITE_EXISTING_EVENT_", "Overschrijf bestaand evenement");
define("_CREATE_NEW_EVENT_", "Maak nieuw evenement");
define("_IMPORT_AS_", "Importeer naar categorie");
define("_EVENTS_IMPORTED_", "Evenementen geïmporteerd");
define("_SYNC_IMPORT_ERROR_", "Fout: er is een fout ontstaan bij het ontleden van het te importeren bestand.");
define("_HTML_", "HTML");
define("_PLAINTEXT_", "Platte tekst");
define("_ICAL_", "iKalender (.ics)");
define("_QUIRKS_MODE_", "Quirks Mode");
define("_PERMISSION_DENIED_", "Toestemming afgewezen: u bent geen eigenaar van dit evenement of administrator van deze kalender.");
define("_FULL_SYNC_", "Volledige Sync");
define("_FULL_SYNC_DESC_", "Verwijder evenementen die in Thyme bestaan, maar die niet gevonden worden in het geïmporteerde bestand.");

#########################
# CSS AND STYLE
#########################
define("_COLOR_", "Kleur");

define("_STYLE_", "Stijl");

define("_PREVIEW_", "Afdrukvoorbeeld");
define("_SAMPLE_", "Voorbeeld");

define("_BACKGROUND_COLOR_", "Achtergrond kleur");
define("_FONT_COLOR_", "Fontkleur");
define("_FONT_SIZE_", "Fontgrootte");

define("_FONT_STYLE_", "Fontstijl");
define("_BOLD_", "vet");
define("_ITALICS_", "cursief");
define("_UNDERLINE_", "onderstreept");

define("_FONT_FAMILY_", "Fontfamilie");
define("_FONT_FAMILY_DESC_", "Bijv. Tahoma, 'Sans Serif', Arial");

define("_UNDERLINE_LINKS_", "Onderstreep links");
define("_NEVER_", "Nooit");
define("_ALWAYS_", "Altijd");
define("_HOVER_", "Zweven");
define("_BORDER_COLOR_", "Randkleur");
define("_TIME_FONT_COLOR_", "Fontkleur tijd");
define("_TITLE_FONT_COLOR_", "Fontkleur titel");
define("_TITLE_FONT_STYLE_", "Fontstijl titel");

#########################
# CALENDAR PUBLISHER
#########################
if(@constant("_CAL_DOING_PUBLISHER_")) { # <- leave this line alone

define("_MINI_MONTH_", "Mini maand");

define("_SET_DATE_CURRENT_", "zet op huidige datum");
define("_EDITABLE_", "Wijzigbaar");
define("_STATIC_", "Statisch");
define("_STATIC_DESC_", "kalenderinhoud bevat geen links die datum of overzicht wijzigen");
define("_HIL_DAY_", "Markeer Dag");
define("_HIL_WEEK_", "Markeer Week");

define("_APPLY_CSS_FROM_", "Stijl toepassen van");
define("_NO_CSS_", "geen");
define("_CSS_EDITOR_", "Stijl-editor");

define("_LANGUAGE_", "Taal");
define("_EURO_DATE_", "Europese datumstijl");
define("_EURO_DATE_DESC_", "Data worden weergegeven als dd/mm/yyyy waar van toepassing");

define("_HEADER_", "Header");
define("_WEEKDAY_HEADER_", "Weekdagheader");

define("_NORMAL_DAYS_", "Normale dagen");
define("_DAYS_NOT_IN_MONTH_", "Dagen niet in maand");
define("_HIGHLIGHTED_DAYS_", "Gemarkeerde dagen");

define("_NORMAL_EVENTS_", "Normale evenementen");
define("_FLAGGED_EVENTS_", "Gemarkeerde evenementen");

define("_SHOW_EVENTS_", "Toon evenementen");


define("_EVENT_LINKS_", "Evenementenlinks");

define("_EVENT_LINK_URL_", "Evenementlink URL");

define("_EVENT_LINK_URL_DESC_", "

        Aan deze url zal een query string worden doorgegeven welke
        <font class='"._CAL_CSS_HIL_."'>eid</font> en <font class='"._CAL_CSS_HIL_."'>instantie bevat</font>.<br>

        <b>eid</b> is de ID van het evenement en <b>instance</b> is de datum in
        <b>YYYY-MM-DD</b> formaat.<br>Deze zijn genoteerd door <font class='"._CAL_CSS_HIL_."'>%eid</font>
        en <font class='"._CAL_CSS_HIL_."'>%inst</font>.<br><br>

        Bijv http://mysite.com/sales/view_sale.php?eid=%eid&instance=%inst kan opleveren:<br>

        http://mysite.com/sales/view_sale.php?<font
		class='"._CAL_CSS_HIL_."'>eid</font>=56&<font
		class='"._CAL_CSS_HIL_."'>instantie</font>=2005-10-26<br><br>
 
        Zie de Reference en/of Tutorial op de Thyme website voor meer informatie over hoe deze te gebruiken. ");


define("_SHOW_HEADER_", "Toon Header");
define("_ALIGN_HEADER_TEXT_", "Headertekst uitlijnen");
define("_CENTER_", "Centreren");
define("_HEADER_TEXT_", "Headertekst");

define("_HEADER_TEXT_DESC_","

      (Bijv. <font class='"._CAL_CSS_HIL_."'>Verjaardagen in %month</font>)<br>
      <font size=1><i>Laat deze blanco om de standaardheader te gebruiken. Andere variabelen omvatten %weekday, %mday, %mon en %year.</i></font> ");


define("_SHOW_HEADER_LINKS_", "Toon headerlinks");

define("_NEXT_LINK_", "'Volgende' link");
define("_PREV_LINK_", "'Vorige' link");

define("_IMG_URL_", "Image URL");

define("_HEADER_LINKS_", "Headerlinks");

define("_IMG_URL_DESC_", "
        Dit kan tekst zijn zoals '<<' of een URL naar een afbeelding<br>
        (Bijv. <font
        class='"._CAL_CSS_HIL_."'>http://www.myserver.com/images/next.gif</font>)<br><font
        size=1><i>Laat deze blanco om de staadaardafbeelding van het geselecteerde thema te
        gebruiken.</i></font> ");


define("_DAY_VIEW_", "Dagoverzicht");

define("_MONTH_VIEWS_", "Maandoverzicht");

define("_SHOW_WEEKS_DESC_", "Let er op dat een Mini-maandkalender geen weeknummers laat zien");

define("_ROW_HEIGHT_", "Rijhoogte");
define("_ROW_HEIGHT_DESC_", "Standaard is '90' voor een maand, '0' voor een minimaand");

define("_LIMIT_WEEKDAY_NAMES_", "Beperk weekdagnamen tot ");
define("_CHARS_", "kar.");

define("_EXCLUDE_MONTH_DAYS_", "Dagen niet in maand uitsluiten");

define("_MINI_MONTH_DATE_URL_", "Minimaand datum URL");

define("_MINI_MONTH_DATE_URL_DESC_", "
        De link waar een klik op een dag in een mini maandkalender naar verwijst.
        Dit vervangt de volgende strings:<br>

        %d = dagnummer<br>
        %m = maandnummer<br>
        %y = jaarnummer<br>

        <br><br>

        Bijv. http://www.myserver.com/page.php?day=%d&month=%m&year=%y<br>
        kan opleveren
        <font class='"._CAL_CSS_HIL_."'>http://www.myserver.com/page.php?day=23&month=11&year=2004</font>

        <br>of u kunt zelfs een JavaScript functie gebruiken.<br>

        Bijv. <font class='"._CAL_CSS_HIL_."'>javascript:myFunction(%y,%m,%d)</font><br><br>

        Standaard is een link naar de huidige pagina welke instelt:<br>
        m = %m<br>
        d = %d<br>
        y = %y<br>

        Bijv. <font class='"._CAL_CSS_HIL_."'>index.php?d=23&m=11&y=2004</font><br><br>
        Zie de Reference en/of Tutorial op de Thyme website voor meer
        informatie over hoe deze te gebruiken.");


define("_GENERATED_CODE_", "Gegenereerde code");

define("_BASE_PATH_DESC_", "basispad van thyme met een eindslash /");
define("_BASE_URL_DESC_", "basis url van thyme met een eindslash /");

} # </ CALENDAR PUBLISHER SECTION > <- leave this line alone


######################
#
### RSS FEED MODULES
#
#####################
define("_RSS_FEED_MODULES_", "RSS Feed Modules");
define("_RSS_", "RSS Feeds");
define("_UPDATE_INTERVAL_", "Update interval");
define("_ARE_YOU_SURE_DELETE_RSSMOD_", "Weet u zeker dat u deze RSS module wilt verwijderen?");
define("_AUTHOR_", "Auteur");

# scrolling
define("_SCROLLING_","Scroll");
define("_OVERFLOW_", "Overflow");
define("_SCROLLBAR_", "Scrollbalk");
define("_AUTOSCROLL_", "Autoscroll");


# this will keep us from needing to
# have these defined when not looking
# at options
#####################################
if(@constant("_CAL_DOING_OPTS_")) { # <- leave this line alone

######################
# OPTION STRINGS
######################

define("_DEFAULT_VIEW_", "Stadaardoverzicht");

define("_DEFAULT_CALENDAR_", "Standaardkalender");

define("_TIME_INTERVALS_", "Tijdintervallen");

define("_EVNT_SIZE_", "Evenementgrootte");
define("_SMALLER_", "Kleiner");
define("_SMALLEST_", "Kleinste");
define("_EVNT_COLLAPSE_", "Evenementen inklappen (Maandoverzicht)");
define("_EVNT_COLLAPSE_DESC_", "Lange evenementtitels inklappen.");
define("_EVNT_TYPE_NAME_", "Toon namen evenementcategorieën");
define("_EVNT_POPUP_", "Evenement popup");
define("_EVNT_POPUP_DESC_", "Toon evenementen in een nieuw venster.");
define("_EVNT_NOTES_POPUP_", "Evenementnotities popup");
define("_EVNT_NOTES_POPUP_DESC_", "Zweef met uw muis over een evenement
    om de nota's te zien.");

define("_POSITION_", "Posities");

define("_SHOW_WEEKS_", "Toon weeknummers");

define("_WEEK_START_", "Week start op");
define("_WORK_HOURS_", "Werktijden");
define("_WORK_HOURS_START_", "start om");
define("_WORK_HOURS_END_", "eindigt om");

define("_HOUR_FORMAT_", "Uurformaat");
define("_HOUR_FORMAT_12_", "12 u.");
define("_HOUR_FORMAT_24_", "24 u.");

define("_LOCALE_", "Lokaal");

define("_NAV_BAR_LOC_", "Nav-balk");
define("_RIGHT_", "Rechts");
define("_LEFT_", "Links");

define("_TIMEZONE_", "Tijdzone");
define("_DST_", "Zomertijd");
define("_STARTS_", "Start");
define("_ENDS_", "Eindigt");

define("_IN_", "in");
define("_ON_", "AAN");
define("_OFF_", "UIT");

define("_THEME_", "Thema");

##########################
# CONTACT OPTIONS
##########################
define("_CONTACT_OPTS_", "Contactopties");
define("_PRIMARY_", "Primair");
define("_FORMAT_", "Formaat");

##########################
# SUBSCRIPTIONS
##########################
define("_SUBSCRIPTIONS_", "Abonnementen");
define("_SUBSCRIPTIONS_DESC_", "E-mail abonnementen op kalenders.");

######################
# NOTIFICATIONS
#####################
define("_NOTIFICATIONS_", "Berichten");
define("_NOTIFICATIONS_DESC_", "Berichtenfilters voor nieuwe en bijgewerkte evenementen.");

define("_TITLE_CONTAINS_", "Titel bevat");
# event X has been updated on calendar Y
define("_UPDATED_ON_", "is gewijgigd op");
# event X has been added to calendar Y
define("_ADDED_TO_", "is toegevoegd aan");

#####################
# DST STRINGS
#####################
define("_DST_OPTS1_", "Afrika / Egypte");
define("_DST_OPTS2_", "Afrika / Namibië");
define("_DST_OPTS3_", "Azië / USSR (voormalige - meeste staten");
define("_DST_OPTS4_", "Azië / Irak");
define("_DST_OPTS5_", "Azië / Libanon, Kirgizstan");
define("_DST_OPTS6_", "Azië / Syrië");
define("_DST_OPTS7_", "Australazië / Australië, New South Wales");
define("_DST_OPTS8_", "Australazië / Australië - Tasmanië");
define("_DST_OPTS9_", "Australazië / Nieuw Zeeland, Chatham");
define("_DST_OPTS10_", "Australazië / Tonga");
define("_DST_OPTS11_", "Europa / Europese Unie, UK, Groenland");
define("_DST_OPTS12_", "Europa / Rusland");
define("_DST_OPTS13_", "North America / United States, Canada, Mexico");
define("_DST_OPTS14_", "North America / Cuba");
define("_DST_OPTS15_", "South America / Chile");
define("_DST_OPTS16_", "South America / Paraguay");
define("_DST_OPTS17_", "South America / Falklands");

####################
# TIMEZONE STRINGS
####################
define("_GMT_PLUS_0.0_","GMT +00:00 Brittannië, Ierland, Portugal, West Afrika ");
define("_GMT_PLUS_0.5_","GMT +00:30 ");
define("_GMT_PLUS_1.0_","GMT +01:00 West Europa, Centraal Afrika");
define("_GMT_PLUS_1.5_","GMT +01:30 ");
define("_GMT_PLUS_2.0_","GMT +02:00 Oost Europa, Oost Afrika");
define("_GMT_PLUS_2.5_","GMT +02:30 ");
define("_GMT_PLUS_3.0_","GMT +03:00 Rusland, Saudi Arabië");
define("_GMT_PLUS_3.5_","GMT +03:30 ");
define("_GMT_PLUS_4.0_","GMT +04:00 Arabië");
define("_GMT_PLUS_4.5_","GMT +04:30 ");
define("_GMT_PLUS_5.0_","GMT +05:00 West Azië, Pakistan");
define("_GMT_PLUS_5.5_","GMT +05:30 India");
define("_GMT_PLUS_6.0_","GMT +06:00 Centraal Azië");
define("_GMT_PLUS_6.5_","GMT +06:30 ");
define("_GMT_PLUS_7.0_","GMT +07:00 Bangkok, Hanoi, Jakarta");
define("_GMT_PLUS_7.5_","GMT +07:30 ");
define("_GMT_PLUS_8.0_","GMT +08:00 China, Singapore, Taiwan");
define("_GMT_PLUS_8.5_","GMT +08:30 ");
define("_GMT_PLUS_9.0_","GMT +09:00 Korea, Japan");
define("_GMT_PLUS_9.5_","GMT +09:30 Centraal Australië");
define("_GMT_PLUS_10.0_","GMT +10:00 Oost Australië");
define("_GMT_PLUS_10.5_","GMT +10:30 ");
define("_GMT_PLUS_11.0_","GMT +11:00 Centraal Pacific");
define("_GMT_PLUS_11.5_","GMT +11:30 ");
define("_GMT_PLUS_12.0_","GMT +12:00 Fiji, Nieuw Zeeland");
define("_GMT_MINUS_12.0_","GMT -12:00 Datumgrens ");
define("_GMT_MINUS_11.5_","GMT -11:30 ");
define("_GMT_MINUS_11.0_","GMT -11:00 Samoa");
define("_GMT_MINUS_10.5_","GMT -10:30 ");
define("_GMT_MINUS_10.0_","GMT -10:00 Hawaï");
define("_GMT_MINUS_9.5_","GMT -09:30 ");
define("_GMT_MINUS_9.0_","GMT -09:00 Alaska/Pitcairn Eilanden");
define("_GMT_MINUS_8.5_","GMT -08:30 ");
define("_GMT_MINUS_8.0_","GMT -08:00 US/Canada/Pacific");
define("_GMT_MINUS_7.5_","GMT -07:30 ");
define("_GMT_MINUS_7.0_","GMT -07:00 US/Canada/Mountains");
define("_GMT_MINUS_6.5_","GMT -06:30 ");
define("_GMT_MINUS_6.0_","GMT -06:00 US/Canada/Centraal");
define("_GMT_MINUS_5.5_","GMT -05:30 ");
define("_GMT_MINUS_5.0_","GMT -05:00 US/Canada/Oosten, Colombia, Peru");
define("_GMT_MINUS_4.5_","GMT -04:30 ");
define("_GMT_MINUS_4.0_","GMT -04:00 Bolivia, West Brazilië, Chili, Atlantic");
define("_GMT_MINUS_3.5_","GMT -03:30 Newfoundland");
define("_GMT_MINUS_3.0_","GMT -03:00 Argentinië, Oost Brazilië, Groenland");
define("_GMT_MINUS_2.5_","GMT -02:30 ");
define("_GMT_MINUS_2.0_","GMT -02:00 Midden-Atlantisch");
define("_GMT_MINUS_1.5_","GMT -01:30 ");
define("_GMT_MINUS_1.0_","GMT -01:00 Azoren/Oost Atlantisch");
define("_GMT_MINUS_0.5_","GMT -00:30 ");

}

##########################
# ERRORS AND WARNINGS
##########################
define("_WARNING_ATTACH_", "Waarschuwing: Map voor bijlagen %s bestaat niet of is niet schrijfbaar.");
define("_WARNING_RSS_", "Waarschuwing: RSS feed repository %s is niet schrijfbaar.");
define("_WARNING_INSTALL_", "Waarschuwing: %s bestaat reeds. Wijder dit bestand eerst.");
define("_WARNING_LICENSE_", "Waarschuwing: Thyme's licentie loopt af in %s dagen.");


# date formats
#
# see PHP's documentation for
# 'date' for more format options 
# some are:
# j = day of the month
# n = month number
# Y = full year number
#################################
define("_DATE_INT_FULL_", "j/n/Y");
define("_DATE_INT_NOYR_", "j/n"); # only used in Week view


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

$_cal_weekdays or $_cal_weekdays = array(
  "Zondag",
  "Maandag",
  "Dinsdag",
  "Woensdag",
  "Donderdag",
  "Vrijdag",
  "Zaterdag");

$_cal_months or $_cal_months = array(1 => 
  "Januari",
  "Februari",
  "Maart",
  "April",
  "Mei",
  "Juni",
  "Juli",
  "Augustus",
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



?>
