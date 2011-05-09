<?php
# Dansk udgave ved Michael Orkild, www.orkild.dk
# - korrektur ved Frank J. Andersen, www.kratvej28c.dk
# - danske specialtegn: æøå - ÆØÅ
#
# With this set to 1, Nov 2nd 2004 would look
# like 2/11/2004 where applicable. With it
# set to 0, it would look like 11/2/2004.
#
# All date selects are also affected by this
# as they will be day-month-year.
#
###########################################
define("_CAL_EURO_DATE_", 1);

define("_CHARSET_", "iso-8859-1");

define("_LANG_NAME_", "Dansk (DK)");


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
define("_GLOBAL_VIEWS_", "Globale oversigter");

define("_ALLOW_EVERYONE_VIEW_", "Tillad alle at se samtlige kalendere i denne oversigt uafhængige af medlems tilknytning");

define("_HIDE_VIEW_FROM_GUESTS_", "Skjul denne oversigt for gæste brugere");

define("_REQUEST_NOTIFY_OWNER_", "Gør kalender ejer opmærksom ubehnadlede forespørgelser");

define("_ALL_CALENDARS_", "Vis alle kalendere");

#################################
#
### INSTALLER 
#
#################################

# some of these will not be used until 2.0
define("_INSTALLER_", "Installer program");
define("_PACKAGE_", "Pakke");
define("_INSTALL_", "Installer");
define("_INVALID_PACKAGE_", "Filen du har sendt, er ikke en valid Thyme pakke.");
define("_INSTALLED_MODULES_", "Installerede Moduler");
define("_UNINSTALL_", "Afinstallere");
define("_LOCAL_FILE_","Lokal Fil");
define("_UPDATES_", "Opdateringer");
define("_AVAILABLE_UPDATES_", "Tilgængelig opdateringer");
define("_CHECK_FOR_UPDATES_", "Check for opdateringer");
define("_LAST_CHECKED_ON_", "Sidst kontrolleret den"); # e.g. last checked on 1/2/2007
define("_FILE_", "Fil");
define("_WRITABLE_", "Skrivbar");
define("_REFRESH_", "Genopfrisk");
define("_INVALID_DOWNLOAD_", "Invalid nedlæsning. Ikke i stand til at opdatere filen.");
define("_UNABLE_TO_BACKUP_", "Ikke i stand til at lave den aktuelle sikkerhedkopi.");
define("_UPDATES_AVAIL_", "%s tilgængelige opdateringer"); # %s vil blive udskiftet med /# af tilgængelige opdateringer

############################
#
### NEW USER DEFINITIONS
#
###########################
define("_REGISTERED_USERS_", "Registerede brugere");
define("_PUBLIC_", "Offentlig");
define("_PUBLIC_ACCESS_", "Offentlig adgang");

#############################
#
### MULTIPLE REMINDERS
#
#############################
define("_BEFORE_EVENT_MULTI_", "før denne aftale");
define("_USER_CAN_NOT_VIEW_", "%s har ikke adgang til denne kalender oversigt.");
define("_ALLOW_CONFIGURE_REMINDERS_", "Tillad %s at konfigurere aftale påmindelser for alle brugere.");
define("_CALENDAR_ADMINS_", "Kalender administratorer");
define("_EVENT_OWNER_", "Aftale ejer");
define("_SITE_ADMINS_", "Website administrator");
define("_NO_ONE_", "Ingen");

###############################
#
## CONFIGURABLE JOB INTERVALS
#
###############################

define("_REMIND_AT_LEAST_", "Påmind mindst om");
define("_SCHEDULED_TASK_", "Planlagt handling");
define("_NO_SCHEDULED_TASK_", "Thyme er ikke konfiguret til at sende påmindelser");
define("_SCHEDULED_TASK_CONFIGURED_", "Thyme er konfigureret til at sende påmindelser hver");
define("_PHP_CLI_", "PHP CLI lokation");

###################################
#
### CUSTOMIZE SITE
#
###################################
define("_CUSTOMIZE_SITE_", "Tilpas websiden");
define("_SITE_NAME_", "Websidens Navn");
define("_SITE_THEME_", "Websidens tema");
define("_SITE_THEME_DESC_", "Vælges Ingen, tillades brugerne at vælge egne temaer");

# use exact HTML tags, they will be displayed correctly
# when printed
define("_SITE_HEADER_", "Webside overskrift");
define("_SITE_HEADER_DESC_", "Efter <body> tag");

define("_SITE_FOOTER_", "Webside tekst forneden på siden");
define("_SITE_FOOTER_DESC_", "Før </body> tag");

define("_SITE_HEAD_", "Webside hoved");
define("_SITE_HEAD_DESC_", "Mellem <head> </head> tags.");


####################################
#
### LICENSE KEY
#
####################################
define("_ENTER_LICENSE_KEY_", "Skriv licens nummer");
define("_LICENSE_KEY_", "Licens nummer");
define("_LICENSE_KEY_ACCEPTED_", "Licens nummeret er accepteret");
define("_INVALID_LICENSE_KEY_", "Licens nummeret du har indtastet, er ikke gældende for denne hjemmeside");

####################################
#
### EVENT REQUEST DESCRIPTION
#
####################################
define("_REQUEST_MODE_VIEW_ONLY_", "Oversigt - kun medlemmer kan sende aftale forespørgelser. Normal - brugere kan tilføje aftaler direkte.");
define("_REQUEST_MODE_NORMAL_", "Oversigt - kun medlemmer kan se oversigten af kalenderen, Normale brugere kan sende aftale  anmodninger.");

#####################################
#
### TELL A FRIEND FOR GUEST E-MAILS
#
######################################
define("_TELL_A_FRIEND_", "Fortæl en ven/veninde");

define("_YOUR_NAME_", "Dit navn");
define("_YOUR_EMAIL_", "Din e-mail");

define("_YOUR_FRIENDS_NAME_","Din vens/venindes navn");
define("_YOUR_FRIENDS_EMAIL_"," Din vens/venindes e-mail");

define("_EMAIL_EVENT_DISPLAYED_","Aftalen vil blive vist under din besked.");

define("_ALLOW_GUEST_USERS_EMAIL_", "Tillad gæstebrugere at sende aftale oplysninger via e-mail.");

define("_DISABLE_SITE_ADDR_BOOK_", "Deaktiver websidens adressebog for ikke-administratorer");

define("_EMAIL_TO_MULTIPLE_", "Separer flere adresser med et komma.");

# MISC
########
define("_HELP_", "Hjælp");
define("_WARNING_DIR_NOT_WRITABLE_", "Advarsel: Mappen %s er ikke skrivebar.");
define("_WARNING_FILE_NOT_WRITABLE_", "Advarsel: Filen %s er ikke skrivebar.");
define("_DOWNLOAD_", "Nedlæs");
define("_HIDE_QUICK_ADD_", "Skjul 'Opret aftale' boksen");
define("_FORCE_DEFAULT_OPTS_", "Tving standard værdier for alle brugerne. Brug Admin - Default værdier.");
define("_NO_GUEST_TIMEZONE_", "Tillad ikke gæstebrugerne at ændre på tidszonen.");
define("_NUMBER_SYMBOL_", '#');
define("_DISABLE_WYSIWYG_EDITOR_", "Deaktivere WYSIWYG editoren for Aftalens noter.");
define("_SHOW_CALENDAR_NAMES_", "Vis Aftalekalender navne når Vis aftale Katagorier er aktiv i brugerens indstillinger.");
define("_MISC_", "Diverse");
define("_THEME_POPUPS_", "Anvend tema ved aftalens note-popups.");

define("_PUBLIIC_", "Offenligt");
define("_REGISTERED_USERS_", "Registerede brugere");

define("_NEW_", "Ny");

define("_CATEGORY_EDIT_DESC_", "For at redigere en kategori, klik på den titel");

define("_ARE_YOU_SURE_DELETE_", "Er du sikker på du ønsker at slette %s?");

########## END NEW TRANSLATIONS #################





################################
# EDIT / VIEW / POST CALENDARS
################################
define("_CALENDARS_", "Kalendere");
define("_OWNER_", "Ejer");
define("_ARE_YOU_SURE_DELETE_CALENDAR_", "Er du sikker på du ønsker at slette denne kalender?");

define("_COLOR_BY_", "Farv aftaler med");
define("_BY_OWNER_", "Aftale ejer");
define("_BY_CATEGORY_", "Aftale Kategori");
define("_BY_CALENDAR_", "Kalender");

define("_MODE_", "Funktion");

define("_ALLOW_MULTI_CATS_", "Tillad flere kategorier for Aftaler");

define("_REMEMBER_LOCATIONS_", "Husk lokaliteter");

define("_STRICT_EVENT_SECURITY_", "Streng Aftale sikkerhed");
define("_STRICT_EVENT_SECURITY_DESC_", "Kun Aftale ejeren eller kalender administratoren kan modificere eller slette esisterende Aftaler.");

define("_REMOTE_ACCESS_", "Fjern-adgang");
define("_REMOTE_ACCESS_DESC_", "Med fjern-adgang tillades brugere at abonnere til denne kalender via opkobling ved at bruge et program som Mozilla Sunbird, Windates, eller Apple iCal. Dette vil også gøre det muligt at bruge RSS synkronisering fra en RSS læser (f.eks., RssReader, Shrook) og fra visse indholds leverandører (eks., Yahoo!, MSN), eller content management værktøjer/programmer (eks., PHP-Nuke, Mambo, Joomla).");

define("_ENABLE_REMOTE_ACCESS_UPD_", "Gør det muligt for fjern-adgang til opdateringer. Dette tillader autoriserede medlemer at publisere opdateringer til denne kalender ved at bruge 3-parts programmer.");

define("_REMOTE_ACCESS_DESC_USERS_", "Hvis gæste brugeren ikke er medlem af denne kalender, 
  vil personer der forsøger at få adgang til denne kalender bliver bedt om et brugernavn og adgangskode. Når anmodningen 
  er givet, vil adgangen blive godkendt eller nægtet baseret på medlemskonfigurationen tilknyttet kalenderen.");

define("_SYNDICATION_", "Syndikat");

define("_EDIT_EVENT_TYPES_", "Rediger kategorier");

define("_EVENT_TYPES_", "Kategorier");

define("_EVENT_TYPES_DESC_", "

  Vælges ingen, overføres alle kategorier.<BR><BR>");

define("_MULTI_SELECT_WIN_","
       Windows: For at vælge/fravælge et emne, eller at vælge et eller flere ikke sammenhængende emner,<br>eller flere, ikke konkurrenrende emner
       hold<br>CTRL nede medens du vælger den/dem.  ");

define("_REALLY_DELETE_EVENT_TYPE_", "Ønsker du stadig a slette kategorien?"); # question
define("_DELETE_ALL_IN_CATEGORY_", "Slet alle Aftaler i denne kategori.");

define("_VIEWS_NO_ACTION_", "Denne handling kan ikke udføres i en oversigt. Vælg venligst en kalender istedet.");

define("_VIEW_INVALID_CAL_", "Den aktuelle oversigt indeholder en kalender du ikke er medlem af. Aftaler fra denne kalender vil ikke blive vist.");

define("_DESCRIPTION_", "Beskrivelse");
define("_DETAILS_", "Oplysninger");
define("_PUBLISH_","Publicering");
define("_PUBLISH_DESC_", "Udgiv denne kalender til en ekstern web server eller service så som<a class='". _CAL_CSS_BODY_ ." ". _CAL_CSS_ULINE_."' target=_blank
href='http://icalx.com'>iCal Exchange</a>");
define("_SERVER_RESPONSE_", "Server Respons");



######################
# EMAIL EVENT
######################
define("_EMAIL_EVENT_", "E-Mail");
define("_EMAIL_TO_", "Til");
define("_SEND_EMAIL_", "Send");
define("_SUBJECT_", "Emne");
define("_MESSAGE_", "Besked");
# e.g. The event has been sent to abcdefg@alphabet.com
define("_EMAIL_SENT_TO_", "Aftalen er blevet sent til ");
define("_EMAIL_NO_ADDR_WARNING_", "Advarsel: du har ikke angivet en e-mail adresse i Kontakt indstillingerne under funktionen Indstillinger. Din e-mail adresse 
  vil se ud til at komme fra ". @constant("_CAL_MAIL_FROM_"));

######################
# EMAIL SETTINGS
######################
define("_MAIL_PROG_PHP_", "PHP's mail funktion");
define("_MAIL_PROG_CMD_", "lokal opsætning til afsendelse af e-mails (sendmail, qmail, osv.)");
define("_MAIL_PROG_SERVER_", "SMTP server");

define("_MAIL_PROGRAM_", "Send e-mails ved at bruge");

define("_MAIL_FROM_EMAIL_", "E-mail adresse");

define("_MAIL_PATH_", "sti til lokal opsætning af afsendelse af e-mails");
define("_MAIL_AUTH_", "SMTP autencitet");
		
define("_MAIL_AUTH_USER_", "SMTP brugernavn");
define("_MAIL_AUTH_PASS_", "SMTP kodeord");

define("_MAIL_SERVER_", "SMTP server");
define("_MAIL_SERVER_PORT_", "Server Port");

##########################
# ATTACHMENT SETTINGS
##########################
define("_ALLOW_ATTACHMENTS_", "Tillad vedhæftning af filer ");
define("_ATTACHMENTS_PATH_", "Sti til filer");

#############################
# GROUPS AND USERS
#############################
define("_USERS_", "Brugere");
define("_GROUPS_", "Grupper");
define("_EVERYONE_", "Alle");
define("_SUPER_USER_", "Super bruger");

define("_MEMBERS_", "Medlemmer");
define("_MEMBERS_OF_", "Medlem af ");

define("_NAME_", "Navn");
define("_EMAIL_", "E-mail");

define("_ACCESS_LVL_", "Adgangs niveau");
define("_ROLE_", "Rolle");
define("_READ_ONLY_", "Kun oversigt");
define("_NORMAL_","Normal");

define("_ARE_YOU_SURE_DELETE_GROUP_", "Er du sikker på du ønsker at slette denne gruppe?");
define("_GROUPS_SAVE_ATLEAST_1_MEMBER_", "Grupper skal have mindst 1 medlem, Medlemslisten er ikke gemt.");

# displayed as form field must begin with a character. E.g.
# Username must begin with a character.
define("_MUST_BEGIN_WITH_CHAR_", "skal begynde med en karakter(bogstav eller tal).");

######################
# REMINDERS
######################
define("_REMINDERS_", "Påmindelse");
define("_BEFORE_EVENT_","før denne aftale, hos");

define("_WILL_OCCUR_IN_", "Vil ske om"); # event x will occur in 30 minutes



###########################
# EVEVNT REQUESTS
############################
define("_REQUEST_", "Aftale forespørgsel");
define("_REQUESTS_", " Aftale forespørgsler");
define("_REQUEST_ACCEPTED_", "Dit Aftale forespørgsel er blevet godkendt.");
define("_REQUEST_REJECTED_", " Dit Aftale forespørgsel er blevet nægtet.");

define("_NOTIFY_REQUESTOR_", "Informer den der anmoder");
define("_REQUEST_HAS_NOTIFY_", "Anmoderen har udbedt sig om besked.");
define("_REQUESTS_NO_PENDING_", "Der er ingen ubehandlede forespørgsler.");
define("_REQUEST_NOTIFY_EMAIL_", "Gør mig opmærksom på ubehandled anmodninger om");
define("_REQUEST_MSG_PRE_", "Beskeden der vises til brugerne før anmodninger bliver sent.");
define("_REQUEST_MSG_POST_", "Beskeden der vises til brugerne efter anmodningen er sent.");
define("_REQUEST_NOTES_", "Tillægs noter til anmodninger");
define("_REQUEST_NOTIFY_STATUS_", "Gør mig opmærksom på denne anmodnings status om ");

define("_CONTACT_", "Kontakt");

# You have a pending event request on calendar: CALENDAR TITLE
define("_PENDING_REQUEST_", "Du har en ubehandlet aftale forespørgsel i kalenderen:");


#################
# DATE  ITEMS
#################
define("_CALENDAR_", "Kalender");

define("_MONTH_", "Måned");
define("_MONTHS_", "Måned(-er)");

define("_DAY_","Dag");
define("_DAYS_", "Dag(-e)");

define("_YEAR_", "År");
define("_YEARS_", "År");

define("_WEEK_", "Uge");

# Abbreviated week
define("_WEEK_ABBR_", "Uge");

define("_WEEKS_", "Uge(-r)");

define("_HOUR_", "Time");
define("_HR_", "time");
define("_HOURS_", "timer");
define("_HRS_", "timer");

define("_MINS_", "minut");
define("_MINUTES_", "minutter");

define("_DATE_", "Dato");
define("_TIME_", "Tid");

define("_AM_", "am");
define("_AM_SHORT_", "a");
define("_PM_", "pm");
define("_PM_SHORT_", "p");

# VIEWS
define("_TODAY_", "I dag");
define("_THIS_WEEK_", "Denne uge");
define("_THIS_MONTH_", "Denne måned");

##################
# MISCELLANEOUS
##################
define("_EVENT_", "Aftale");
define("_EVENTS_", "Aftaler");
define("_VIEW_", "Oversigt");

# VIEW AS A NOUN
define("_VIEW_NOUN_", "Oversigter");

define("_PRINTABLE_VIEW_", "Printbar Oversigt");

define("_ALLDAY_", "Hele Dagen");

define("_CAL_CALL_FOR_TIMES_", "Bed om tider");
define("_CAL_CALL_FOR_TIMES_MIN_", "(*)");

define("_TYPE_","Type");
define("_EVENT_TYPE_", "Kategori");

define("_WIDTH_", "Bredde");

define("_COLORS_", "Farver");

# List separator. Note space after comma
define("_LIST_SEP_",", ");

###########################
# ADMIN PAGE 
###########################
define("_GLOBAL_SETTINGS_", "Webside indstillinger");
define("_EDIT_DEFAULT_OPTS_", "Standard indstillinger");
define("_PASS_MUST_MATCH_", "Kodeordene du har indtastet passer ikke sammen");
define("_EMPTY_PASSWORD_", "Ikke set kodeord til \"\"!");
define("_ARE_YOU_SURE_DELETE_USER_", "Er du sikker på du ønsker at slette denne bruger?");
define("_DELETE_USERS_EVENTS_", "Slet alle aftaler ejet af denne bruger.");
define("_CALENDARS_OWNED_", "Kalendere ejet af denne bruger");
define("_AUDIT_USERS_", "Kontrollere brugerne");
define("_AUDIT_USERS_DESC_", "Brugerne er fundet i Thyme's database, men har ingen tilsvarende tilmelding i den aktuelle godkendelses modul.<br>Alle bruger indstillinger er sat til uid for den manglende bruger.");

define("_CALENDAR_PUBLISHER_", "Kalender udgiver");
define("_CAL_USER_GUEST_", "Gæste konto");
define("_CAL_PUBLISH_GUEST_DISABLED_", "Kalender udgiveren vil ikke virke hvis 
  gæste kontoen er deaktiveret. Venligst aktiver denne konto i Bruger sektionen.");


####################################
# GENERAL ACTIONS AND RESPONSES
####################################
define("_ADD_", "Tilføj");
define("_NEW_EVENT_", "Ny Aftale");
define("_REMOVE_", "Fjern");
define("_UPDATE_", "Opdater");
define("_NEXT_", "Næste");
define("_PREV_", "Forrige");
define("_DELETE_", "Slet");
define("_SAVE_", "Gem");
define("_TEST_", "Test");
define("_UPDATE_NOW_", "Opdater nu");
define("_SAVE_ADD_", "Gem og tilføj en ny");
define("_CANCEL_", "Annuller");
define("_BROWSE_", "Browse/Gennemlæse");
define("_NONE_", "Ingen");
define("_RESET_", "Nulstil");
define("_CLEAR_ALL_", "Slet alle markeringer");
define("_CHECK_ALL_", "Marker alle");
define("_EDIT_", "Rediger");
define("_CLOSE_", "Luk");
define("_SHOW_", "Vis");
define("_HIDE_", "Gem");
define("_ENABLE_", "Aktiver");
define("_DISABLE_", "Deaktiver");
define("_MOVE_", "Flyt");
define("_UP_", "Op");
define("_DOWN_", "Ned");
define("_ENABLED_", "Aktiver");
define("_CONFIGURE_", "Konfigurer");
define("_ACCEPT_", "Accepter");
define("_REJECT_", "Afvis");
define("_OK_", "OK");
define("_FAILED_", "MISLYKKET");
define("_CHANGE_", "Ændre");
define("_SORT_BY_", "Sorter efter");
define("_SEARCH_", "Søg");
define("_FORCE_", "Tving");
define("_AUTODETECT_", "Autodetekter");
define("_RESET_PASS_", "Skift kodeord");
define("_NEW_PASS_", "Nyt kodeord");
define("_RETYPE_", "Tast en gang til");
define("_UPDATED_", "Opdateret");
define("_SUBMITTED_", "Sendt");
define("_LOGIN_", "Log ind");
define("_USERNAME_", "Brugernavn");
define("_PASSWORD_", "kodeord");
define("_LOGOUT_", "Log ud");
define("_OPTIONS_", "Muligheder");
define("_ADMIN_", "Administrator");
define("_BAD_PASS_", "Forkert brugernavn eller kodeord.");
define("_YES_", "Ja");
define("_NO_", "Nej");
define("_VALUE_", "Værdi");
define("_CUSTOM_", "Tilpasset");
define("_DEFAULT_", "Standard");

######################
# ATTACHMENTS
######################
define("_ATTACHMENTS_", "Vedhæftninger");
define("_ATTACH_DETACH_", "Fjern");
define("_ATTACH_DELETE_", "Slet");
define("_ATTACHMENT_TOO_BIG_", "Vedhæftede fil er større end tilladt.");
define("_DOWNLOAD_ZIP_", "Download Zip");
define("_UPDATE_ATTACHMENTS_", "Opdater Vedhæftninger");

define("_BYTES_", "b");
define("_KBYTES_", "KB");
define("_MBYTES_", "MB");


#################
# EVENT LIST VIEW 
#################
define("_ALL_", "Alle");
define("_UPCOMING_", "Kommende");
define("_PAST_", "Tidligere");

define("_SHOWING_", "viser");
define("_OF_", "af");
define("_FIRST_", "Første");
define("_LAST_", "Sidste");
define("_SHOW_TYPE_", "Kategori");

define("_LIST_SIZE_", "Liste størrelse");

define("_ARE_NO_EVENTS_", "Der er ingen Aftaler at vise.");

define("_EVENTS_CONTAINING_", "Aftaler som indeholder"); # used in event search

define("_ARE_YOU_SURE_DELETE_EVENTS_", "Er du sikker på at du vil slette disse Aftaler?");
define("_DELETE_REPEATING_WARNING_", "
   Du har valgt at slette en eller flere repeterende aftaler.<br>
   Alle tidligere ogkommende aftaler vil blive fjernet! ");

define("_UNCHECK_NO_DELETE_", "Fjern markeringen på aftaler du ikke ønsker at slette:");
define("_DELETE_CHECKED_", "Slet markederede ");

define("_RETURN_", "Returner");
define("_ERROR_", "Fejl!");

######################
# EVENT EDIT/ADD/VIEW
######################
define("_GENERAL_", "Generel");

define("_ORGANIZER_", "Organisator");

define("_URL_", "URL");

define("_REPEATING_", "Gentagelse");

define("_LOCATION_", "Sted");

define("_APPLY_TO_", "Gem ændringer på");
define("_ALL_DATES_", "alle datoer");
define("_THIS_DATE_", "kun denne dato");

define("_RESET_INSTANCE_", "Gendan de oprindelige indstillinger");

define("_MAP_", "Kort");

define("_STARTED_", "Begyndt");

# e.g. Overrides event Weekly Meeting on 2004-2-34
define("_OVERRIDE_EVNT_ON_", "Overstyr aftaler %s på %s");

# e.g. Warning: the event Event Title has an invalid repeating rule
define("_INVALID_RRULE_", "Advarsel: Aftalen %s har en ugyldig gentagelses regel.");

define("_MAX_CHARS_", "maksimale tegn");
define("_EVENT_INFO_", "Aftale information");
define("_TITLE_", "Titel");
define("_NOTES_", "Noter");

define("_CHECK_FOR_CONFLICTS_", "Kontroller for konflikter");

define("_THIS_EVENT_ALLDAY_", "Dette er en <b>heldags Aftale</b>.");
define("_STARTS_AT_", "Begynder klokken");
define("_DURATION_", "Varighed");

define("_FLAG_", "Fremhæv");
define("_FLAG_THIS_", "Fremhæv denne aftale");
define("_IS_FLAGGED_", "Denne aftale er fremhævet");

# e.g. 10 days ago
define("_AGO_", "siden");

define("_REPEATING_NO_", "Denne Aftale gentages ikke.");
define("_REPEATING_REPEAT_", "Gentages");
define("_REPEATING_SELECTED_", "valgte dage");
define("_REPEATING_EVERY1_", "hver");

define("_REPEAT_ON_", "Gentages på den");
define("_REPEAT_ON1_", "første");
define("_REPEAT_ON2_", "anden");
define("_REPEAT_ON3_", "tredje");
define("_REPEAT_ON4_", "fjerde");
define("_REPEAT_ON5_", "femte");
define("_REPEAT_ONL_", "sidste");
define("_REPEAT_ON_OF_", "i måneden, hver");

define("_SIMPLE_", "Enkel");
define("_ADVANCED_","Avanceret");

define("_YEARLY_", "Årligt");
define("_MONTHLY_", "Månedlig");
define("_WEEKLY_", "Ugentlig");
define("_DAILY_", "Dagligt");
define("_EASTER_", "Påske");
define("_EASTER_YEARLY_", "Hver Påske");

define("_MONTH_DAYS_", "Måned Dag(e)");
define("_FROM_LAST_", "fra sidste");

define("_WEEKDAYS_", "Ugedag(e)");

define("_YEARLY_NOTES_", "Standard måned og dag er taget fra
        startdato hvis ingen er valgt.");


define("_SPECIFIC_OCCURRENCES_", "Specifikke forekomster");

define("_STARTING_ON_", "begynder den");

define("_BEFORE_", "Før");
define("_AFTER_", "Efter");

define("_EXCLUDE_DATES_", "Udelad datoer");

define("_CONFIRM_EVNT_RPT_CHANGE_", "Du er ved at ændre på gentagelsesreglen eller datoen for denne Aftale.\n
Alle undtagelser assosieret med dette gentagende aftale vil forsvinde. Er du sikker på du vil gøre dette?\n");


define("_END_DATE_", "Slut dato");
define("_END_DATE_NO_", "Ingen slut dato");
define("_END_DATE_UNTIL_", "Indtil");
define("_END_DATE_AFTER_", "Slut efter");
define("_OCCURRENCES_", "Forekomster");

define("_ADDRESS_", "Adresse");
define("_ADDRESS_1_", "Gade");
define("_ADDRESS_2_", "By, Postnummer");

define("_PHONE_", "Telefon");
define("_ICON_", "Ikon");

#####################
# MODULES
#####################
define("_NAVBAR_", "Navigations menu");
define("_MODULE_", "Modul");
define("_MODULES_", "Moduler");
define("_TODAY_LINK_", "'I dag' link");
define("_MINI_CAL_", "Mini Kalender");
define("_CALENDAR_LINKS_", "Kalender links");
define("_IMAGE_BROWSER_", "Billedbrowser");
define("_QUICK_ADD_EVNT_", "Opret aftale");
define("_GOTO_DATE_", "'Gå til' dato");
define("_SEARCH_EVENTS_", "Søg i aftaler");
define("_EVENT_FILTER_", "Kategori");
define("_COLOR_LEGEND_", "Farveforklaring");

##################
# SYNC 
##################

define("_SYNC_", "Synkronisering");
define("_IMPORT_", "Importer");
define("_EXPORT_", "Eksporter");
define("_IMPORT_FROM_", "Importer fra");
define("_EXPORT_TO_", "Eksporter til");
define("_SYNC_DUPLICATES_", "Hvis dubletter er fundet");
define("_IGNORE_DUPLICATES_", "Ignorer dubletter");
define("_OVERWRITE_EXISTING_EVENT_", "Overskriv eksisterende aftale");
define("_CREATE_NEW_EVENT_", "Lav en nyt aftale");
define("_IMPORT_AS_", "Importer til kategori");
define("_EVENTS_IMPORTED_", "Aftaler importeret");
define("_SYNC_IMPORT_ERROR_", "Fejl: Der opstod en fejl under overføringen af filen du prøver at importere.");
define("_HTML_", "HTML");
define("_PLAINTEXT_", "Almindelig tekst");
define("_ICAL_", "iCalendar (.ics)");
define("_QUIRKS_MODE_", "Quirks Mode");
define("_PERMISSION_DENIED_", "Ingen adgang: Du er ikke ejer af denne Aftale eller en administrator for denne kalender.");
define("_FULL_SYNC_", "Fuld Synkronisering");
define("_FULL_SYNC_DESC_", "Slet Aftaler som findes i kalenderen, men som ikke findes i den importerede fil.");

#########################
# CSS AND STYLE
#########################
define("_COLOR_", "Farve");

define("_STYLE_", "Stil");

define("_PREVIEW_", "Forhåndsvisning");
define("_SAMPLE_", "Eksempel");

define("_BACKGROUND_COLOR_", "Baggrunds farve");
define("_FONT_COLOR_", "Skrift farve");
define("_FONT_SIZE_", "Skrift størrelse");

define("_FONT_STYLE_", "Skrift stil");
define("_BOLD_", "fed");
define("_ITALICS_", "kursiv");
define("_UNDERLINE_", "understregning");

define("_FONT_FAMILY_", "Skrift familie");
define("_FONT_FAMILY_DESC_", "E.g. Tahoma, 'Sans Serif', Arial");

define("_UNDERLINE_LINKS_", "Understreg links");
define("_NEVER_", "Aldrig");
define("_ALWAYS_", "Altid");
define("_HOVER_", "Svæv");
define("_BORDER_COLOR_", "Kantfarve");
define("_TIME_FONT_COLOR_", "Farve på tidspunkt");
define("_TITLE_FONT_COLOR_", "Farve på titel");
define("_TITLE_FONT_STYLE_", "Skrift stil på titel");

#########################
# CALENDAR PUBLISHER
#########################
if(@constant("_CAL_DOING_PUBLISHER_")) { # <- leave this line alone

define("_MINI_MONTH_", "Mini Måned");

define("_SET_DATE_CURRENT_", "Sæt til dags dato");
define("_EDITABLE_", "Redigerbar");
define("_STATIC_", "Statisk");
define("_STATIC_DESC_", "Kalenderen indeholder ingen links der skifter dato eller visning");
define("_HIL_DAY_", "Fremhæv dag");
define("_HIL_WEEK_", "Fremhæv uge");

define("_APPLY_CSS_FROM_", "Brug 'stil' fra");
define("_NO_CSS_", "ingen");
define("_CSS_EDITOR_", "Redigere 'stil'");

define("_LANGUAGE_", "Sprog");
define("_EURO_DATE_", "Europæisk datoformat");
define("_EURO_DATE_DESC_", "Datoer bliver vist som dd/mm/yyyy hvor anvendt");

define("_HEADER_", "Overskrift");
define("_WEEKDAY_HEADER_", "Ugedag overskrift");

define("_NORMAL_DAYS_", "Normale Dage");
define("_DAYS_NOT_IN_MONTH_", "Dage ikke i måned");
define("_HIGHLIGHTED_DAYS_", "Fremhæv dage");

define("_NORMAL_EVENTS_", "Normale Aftaler");
define("_FLAGGED_EVENTS_", "Markerede Aftaler");

define("_SHOW_EVENTS_", "Vis Aftaler");


define("_EVENT_LINKS_", "Aftale links");

define("_EVENT_LINK_URL_", "Aftale link-URL");

define("_EVENT_LINK_URL_DESC_", "

        Denne URL ville blive givet en streng som indeholder
        <font class='"._CAL_CSS_HIL_."'>eid</font> og <font class='"._CAL_CSS_HIL_."'>instance</font>.<br>

        <b>eid</b> er ID'en til Aftalen og <b>post</b> er datoen i
        <b>YYYY-MM-DD</b> format.<br>Disse er synlig som <font class='"._CAL_CSS_HIL_."'>%eid</font>
        og <font class='"._CAL_CSS_HIL_."'>%inst</font>.<br><br>

        F.eks. http://mysite.com/sales/view_sale.php?eid=%eid&instance=%inst kan resultere i:<br>

        http://mysite.com/sales/view_sale.php?<font
		class='"._CAL_CSS_HIL_."'>eid</font>=56&<font
		class='"._CAL_CSS_HIL_."'>instance</font>=2005-10-26<br><br>
 
        Se dokumentation og/eller brugervejledning på extrosoft.com for mere
				information om hvordan man bruger disse.    ");


define("_SHOW_HEADER_", "Vis titel");
define("_ALIGN_HEADER_TEXT_", "Juster øverste tekst");
define("_CENTER_", "Centrer");
define("_HEADER_TEXT_", "Titel tekst");

define("_HEADER_TEXT_DESC_","

   (E.g. <font class='"._CAL_CSS_HIL_."'>Fødselsdage i %måned</font>)<br>
        <font size=1><i>Efterlad tom for at bruge
        standard toptekst. Andre variabler inkludere %ugedag, %mdag, %måned og %år.</i></font> ");


define("_SHOW_HEADER_LINKS_", "Vis titel links");

define("_NEXT_LINK_", "'Næste' link");
define("_PREV_LINK_", "'Forrige' link");

define("_IMG_URL_", "Billed URL");

define("_HEADER_LINKS_", "Titel link");

define("_IMG_URL_DESC_", "
        Dette kan være tekst som '<<' eller en URL til en billedfil<br>
        (E.g. <font
        class='"._CAL_CSS_HIL_."'>http://www.myserver.com/images/next.gif</font>)<br><font
        size=1><i>Lad disse være tomme for at bruge standard billedfilen fra det
        vagte tema.</i></font> ");


define("_DAY_VIEW_", "Dagsvisning");

define("_MONTH_VIEWS_", "Månedsvisning");

define("_SHOW_WEEKS_DESC_", "Bemærk: Mini-måned kalenderen vil aldrig vise uge numre");

define("_ROW_HEIGHT_", "Række højde");
define("_ROW_HEIGHT_DESC_", "Standard er '90' for en måned, '0' for en Mini-måned");

define("_LIMIT_WEEKDAY_NAMES_", "Begræns uge navne til");
define("_CHARS_", "bogstaver");

define("_EXCLUDE_MONTH_DAYS_", "Ekskluderet dage ikke i en måned");

define("_MINI_MONTH_DATE_URL_", "Mini-måned dato URL");

define("_MINI_MONTH_DATE_URL_DESC_", "
        URL som der ledes til ved at klikke på en dag i Mini-måned kalender.
				Dette erstatter følgende strenge:<br>

        %d = dag nummer<br>
        %m = måned nummer<br>
        %y = år nummer<br>

        <br><br>

        E.g. http://www.myserver.com/page.php?day=%d&month=%m&year=%y<br>
        may yield
        <font class='"._CAL_CSS_HIL_."'>http://www.myserver.com/page.php?dag=23&maaned=11&aar=2004</font>

        <br>eller, du kan bruge JavaScript funktion.<br>

        E.g. <font class='"._CAL_CSS_HIL_."'>javascript:myFunction(%y,%m,%d)</font><br><br>

        Standard er et link til denne side som sætter:<br>
        m = %m<br>
        d = %d<br>
        y = %y<br>

        F.Eks. <font class='"._CAL_CSS_HIL_."'>index.php?d=23&m=11&y=2004</font><br><br>
        Se dokumentation og/eller brugervejledningen på Thyme website: www.extrosoft.com for mere
        information om hvordan man bruger disse.");


define("_GENERATED_CODE_", "Genererede Kode");

define("_BASE_PATH_DESC_", "basis sti til Thyme med skråstreg til sidst");
define("_BASE_URL_DESC_", "basis URL til Thyme med skråstreg til sidst");

} # </ CALENDAR PUBLISHER SECTION > <- leave this line alone


######################
#
### RSS FEED MODULES
#
#####################
define("_RSS_FEED_MODULES_", "RSS Feed Moduler");
define("_RSS_", "RSS Feeds");
define("_UPDATE_INTERVAL_", "Opdateringsinterval");
define("_ARE_YOU_SURE_DELETE_RSSMOD_", "Er du sikker på at du vil slette dette RSS modul?");
define("_AUTHOR_", "Fotfatter");

# scrolling
define("_SCROLLING_","Rulning");
define("_OVERFLOW_", "Overflow");
define("_SCROLLBAR_", "Rullefelt");
define("_AUTOSCROLL_", "Autorulning");


# This will keep us from needing to
# have these defined when not looking
# at options
#####################################
if(@constant("_CAL_DOING_OPTS_")) { # <- leave this line alone

######################
# OPTION STRINGS
######################

define("_DEFAULT_VIEW_", "Stardardvisning");

define("_DEFAULT_CALENDAR_", "Standard kalender");

define("_TIME_INTERVALS_", "Tidsintervaller");

define("_EVNT_SIZE_", "Aftale størrelse");
define("_SMALLER_", "Mindre");
define("_SMALLEST_", "Mindst");
define("_EVNT_COLLAPSE_", "Fold Aftaler sammen (Månedsvisning)");
define("_EVNT_COLLAPSE_DESC_", "Fold lange Aftale titler sammen.");
define("_EVNT_TYPE_NAME_", "Vis Aftale kategori navne");
define("_EVNT_POPUP_", "Event popup");
define("_EVNT_POPUP_DESC_", "Vis Aftaler i et nyt vindue.");
define("_EVNT_NOTES_POPUP_", "Aftale noter i popup");
define("_EVNT_NOTES_POPUP_DESC_", "Placere musen over en Aftale
 for at vise noter.");

define("_POSITION_", "Position");

define("_SHOW_WEEKS_", "Vis uge numre");

define("_WEEK_START_", "Ugen begynder på");
define("_WORK_HOURS_", "Arbejdstid/timer på dagen");
define("_WORK_HOURS_START_", "begynder klokken");
define("_WORK_HOURS_END_", "slutter klokken");

define("_HOUR_FORMAT_", "Tidsformat");
define("_HOUR_FORMAT_12_", "12 timer");
define("_HOUR_FORMAT_24_", "24 timer");

define("_NAV_BAR_LOC_", "Navigations menu");
define("_RIGHT_", "Højre");
define("_LEFT_", "Venstre");

define("_TIMEZONE_", "Tidszone");
define("_DST_", "Sommertid");
define("_STARTS_", "Starter");
define("_ENDS_", "Slutter");

define("_IN_", "i");
define("_ON_", "På");
define("_OFF_", "Af");

define("_THEME_", "Tema");

##########################
# CONTACT OPTIONS
##########################
define("_CONTACT_OPTS_", "Kontakt muligheder");
define("_PRIMARY_", "Primær");
define("_FORMAT_", "Format");

##########################
# SUBSCRIPTIONS
##########################
define("_SUBSCRIPTIONS_", "Abonementer");
define("_SUBSCRIPTIONS_DESC_", "E-mail abonementer til kalendere.");

######################
# NOTIFICATIONS
#####################
define("_NOTIFICATIONS_", "Meldinger");
define("_NOTIFICATIONS_DESC_", "Meldingsfiltre for nye og opdaterede Aftaler.");

define("_TITLE_CONTAINS_", "Titel indeholder");
# event X has been updated on calendar Y
define("_UPDATED_ON_", "blev opdateret den");
# event X has been added to calendar Y
define("_ADDED_TO_", "er blevet lagt til");

#####################
# DST STRINGS
#####################
define("_DST_OPTS1_", "Afrika / Egypten");
define("_DST_OPTS2_", "Afrika / Namibia");
define("_DST_OPTS3_", "Asien / USSR (former) - de fleste stater");
define("_DST_OPTS4_", "Asien / Irak");
define("_DST_OPTS5_", "Asien / Libanon, Kyrgyz Republik");
define("_DST_OPTS6_", "Asien / Syrien");
define("_DST_OPTS7_", "Australiensia / Australien, New South Wales");
define("_DST_OPTS8_", "Australiensia / Australien - Tasmanien");
define("_DST_OPTS9_", "Australienasia / New Zealand, Chatham");
define("_DST_OPTS10_", "Australienasia / Tonga");
define("_DST_OPTS11_", "Europa / European Union, UK, Grønland");
define("_DST_OPTS12_", "Europa / Rusland");
define("_DST_OPTS13_", "Nord Amerika / United States, Canada, Mexico");
define("_DST_OPTS14_", "Nord Amerika / Cuba");
define("_DST_OPTS15_", "Syd Amerika / Chile");
define("_DST_OPTS16_", "Syd Amerika / Paraguay");
define("_DST_OPTS17_", "Syd Amerika / Falklands");

####################
# TIMEZONE STRINGS
####################
define("_GMT_PLUS_0.0_","GMT +00:00 England, Ireland, Portugal, Vest Afrika ");
define("_GMT_PLUS_0.5_","GMT +00:30 ");
define("_GMT_PLUS_1.0_","GMT +01:00 Vesteuropa, Central Afrika");
define("_GMT_PLUS_1.5_","GMT +01:30 ");
define("_GMT_PLUS_2.0_","GMT +02:00 Østeuropa, Øst Afrika");
define("_GMT_PLUS_2.5_","GMT +02:30 ");
define("_GMT_PLUS_3.0_","GMT +03:00 Rusland, Saudi Arabia");
define("_GMT_PLUS_3.5_","GMT +03:30 ");
define("_GMT_PLUS_4.0_","GMT +04:00 Arabien");
define("_GMT_PLUS_4.5_","GMT +04:30 ");
define("_GMT_PLUS_5.0_","GMT +05:00 Vest Asien, Pakistan");
define("_GMT_PLUS_5.5_","GMT +05:30 Indien");
define("_GMT_PLUS_6.0_","GMT +06:00 Central Asien");
define("_GMT_PLUS_6.5_","GMT +06:30 ");
define("_GMT_PLUS_7.0_","GMT +07:00 Bangkok, Hanoi, Jakarta");
define("_GMT_PLUS_7.5_","GMT +07:30 ");
define("_GMT_PLUS_8.0_","GMT +08:00 Kina, Singapore, Taiwan");
define("_GMT_PLUS_8.5_","GMT +08:30 ");
define("_GMT_PLUS_9.0_","GMT +09:00 Korea, Japan");
define("_GMT_PLUS_9.5_","GMT +09:30 Central Australien");
define("_GMT_PLUS_10.0_","GMT +10:00 Øst Australien");
define("_GMT_PLUS_10.5_","GMT +10:30 ");
define("_GMT_PLUS_11.0_","GMT +11:00 Central Pasific");
define("_GMT_PLUS_11.5_","GMT +11:30 ");
define("_GMT_PLUS_12.0_","GMT +12:00 Fiji, New Zealand");
define("_GMT_MINUS_12.0_","GMT -12:00 Datolinen ");
define("_GMT_MINUS_11.5_","GMT -11:30 ");
define("_GMT_MINUS_11.0_","GMT -11:00 Samoa");
define("_GMT_MINUS_10.5_","GMT -10:30 ");
define("_GMT_MINUS_10.0_","GMT -10:00 Hawaii");
define("_GMT_MINUS_9.5_","GMT -09:30 ");
define("_GMT_MINUS_9.0_","GMT -09:00 Alaska/Pitcairn Øerne");
define("_GMT_MINUS_8.5_","GMT -08:30 ");
define("_GMT_MINUS_8.0_","GMT -08:00 US/Canada/Pasific");
define("_GMT_MINUS_7.5_","GMT -07:30 ");
define("_GMT_MINUS_7.0_","GMT -07:00 US/Canada/Bjerge");
define("_GMT_MINUS_6.5_","GMT -06:30 ");
define("_GMT_MINUS_6.0_","GMT -06:00 US/Canada/Central");
define("_GMT_MINUS_5.5_","GMT -05:30 ");
define("_GMT_MINUS_5.0_","GMT -05:00 US/Canada/Øst, Colombia, Peru");
define("_GMT_MINUS_4.5_","GMT -04:30 ");
define("_GMT_MINUS_4.0_","GMT -04:00 Bolivia, Vest Brazil, Chile, Atlantic");
define("_GMT_MINUS_3.5_","GMT -03:30 Newfoundland");
define("_GMT_MINUS_3.0_","GMT -03:00 Argentina, Øst Brazil, Grønland");
define("_GMT_MINUS_2.5_","GMT -02:30 ");
define("_GMT_MINUS_2.0_","GMT -02:00 Midt-Atlantic");
define("_GMT_MINUS_1.5_","GMT -01:30 ");
define("_GMT_MINUS_1.0_","GMT -01:00 Azores/Øst Atlanten");
define("_GMT_MINUS_0.5_","GMT -00:30 ");

}

##########################
# ERRORS AND WARNINGS
##########################
define("_WARNING_ATTACH_", "Advarsel: Vedhængsmappen %s exsisterer ikke eller er ikke skrivebar.");
define("_WARNING_RSS_", "Advarsel: RSS feed lager %s er ikke skrivebar.");
define("_WARNING_INSTALL_", "Advarsel: %s eksistere stadig. Venligst fjern denne fil.");
define("_WARNING_LICENSE_", "Advarsel: Thyme's licens vil udløbe om %s dage.");


# Date formats
#
# See PHP's documentation for
# 'date' for more format options 
# some are:
# j = day of the month
# n = month number
# Y = full year number
#################################
define("_DATE_INT_FULL_", "j/n/Y");
define("_DATE_INT_NOYR_", "j/n"); # kun brugt i et Ugeoversigt


# Alphabet chars
####################
global $_cal_alphabet;
$_cal_alphabet = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P',
   'Q','R','S','T','U','V','W','X','Y','Z','Æ','Ø','Å');

#####################
# WEEKDAYS AND MONTHS	
#####################
# weekdays
global $_cal_weekdays, $_cal_weekdays_abbr, $_cal_months, $_cal_months_abbr;

$_cal_weekdays or $_cal_weekdays = array(
  "Søndag",
  "Mandag",
  "Tirsdag",
  "Onsdag",
  "Torsdag",
  "Fredag",
  "Lørdag");

$_cal_months or $_cal_months = array(1 => 
  "Januar",
  "Februar",
  "Marts",
  "April",
  "Maj",
  "Juni",
  "Juli",
  "August",
  "September",
  "Oktober",
  "November",
  "December");

# ABBREVIATED
#################
$_cal_weekdays_abbr or $_cal_weekdays_abbr = array(
  "Søn",
  "Man",
  "Tir",
  "Ons",
  "Tor",
  "Fre",
  "Lør");

$_cal_months_abbr or $_cal_months_abbr = array(1 =>
  "Jan",
  "Feb",
  "Mar",
  "Apr",
  "Maj",
  "Jun",
  "Jul",
  "Aug",
  "Sep",
  "Okt",
  "Nov",
  "Dec");



?>
