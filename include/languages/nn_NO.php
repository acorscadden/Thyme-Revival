<?php


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

define("_LANG_NAME_", "Norsk");


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
define("_GLOBAL_VIEWS_", "Globale visninger");

define("_ALLOW_EVERYONE_VIEW_", "Tillat samtlige å se alle kalendere i denne visningen uavhengig av deres medlemsliste");

define("_HIDE_VIEW_FROM_GUESTS_", "Gjem denne visningen fra gjestebrukere");

define("_REQUEST_NOTIFY_OWNER_", "Underrett kalenderens eier om ventende forespørsler");

define("_ALL_CALENDARS_", "Vis alle kalendere");

#################################
#
### INSTALLER 
#
#################################

# some of these will not be used until 2.0
define("_INSTALLER_", "Installasjonsprogrammet");
define("_PACKAGE_", "Pakke");
define("_INSTALL_", "Installer");
define("_INVALID_PACKAGE_", "Filen du lastet opp er en ikke-godkjent Thyme pakke.");
define("_INSTALLED_MODULES_", "Installerte moduler");
define("_UNINSTALL_", "Avinnstaller");
define("_LOCAL_FILE_","Lokal fil");
define("_UPDATES_", "Oppdateringer");
define("_AVAILABLE_UPDATES_", "Tilgjengelige oppdateringer");
define("_CHECK_FOR_UPDATES_", "Sjekk for oppdateringer");
define("_LAST_CHECKED_ON_", "Sist sjekket den"); # e.g. last checked on 1/2/2007
define("_FILE_", "Fil");
define("_WRITABLE_", "Skrivbar");
define("_REFRESH_", "Oppdater");
define("_INVALID_DOWNLOAD_", "Ugyldig nedlasting. Kan ikke oppdatere filen.");
define("_UNABLE_TO_BACKUP_", "Kan ikke ta backup av filen.");
define("_UPDATES_AVAIL_", "%s oppdateringer tilgjengelig"); # %s will be replaced w/# of updates available

############################
#
### NEW USER DEFINITIONS
#
###########################
define("_REGISTERED_USERS_", "Registrerte brukere");
define("_PUBLIC_", "Offentlig");
define("_PUBLIC_ACCESS_", "Offentlig aksess");

#############################
#
### MULTIPLE REMINDERS
#
#############################
define("_BEFORE_EVENT_MULTI_", "før dette arrangementet");
define("_USER_CAN_NOT_VIEW_", "%s har ikke tilgang til å se denne kalenderen.");
define("_ALLOW_CONFIGURE_REMINDERS_", "Tillat %s å konfigurere påminnelser for alle brukere.");
define("_CALENDAR_ADMINS_", "Kalender administratorer");
define("_EVENT_OWNER_", "Arrangementseier");
define("_SITE_ADMINS_", "Website administratorer");
define("_NO_ONE_", "Ingen");

###############################
#
## CONFIGURABLE JOB INTERVALS
#
###############################

define("_REMIND_AT_LEAST_", "Minst");
define("_SCHEDULED_TASK_", "Planlagt oppgave");
define("_NO_SCHEDULED_TASK_", "Den Thyme planlagte oppgaven er ikke konfigurert til å kjøre");
define("_SCHEDULED_TASK_CONFIGURED_", "Den Thyme planlagte oppgaven er konfigurert til å kjøre hver");
define("_PHP_CLI_", "PHP CLI lokasjon");

###################################
#
### CUSTOMIZE SITE
#
###################################
define("_CUSTOMIZE_SITE_", "Tilpass website");
define("_SITE_NAME_", "Website navn");
define("_SITE_THEME_", "Website tema");
define("_SITE_THEME_DESC_", "Ved å sette til 'Ingen' kan brukere velge sitt eget tema");

# use exact HTML tags, they will be displayed correctly
# when printed
define("_SITE_HEADER_", "Website topptekst");
define("_SITE_HEADER_DESC_", "Etter <body> taggen");

define("_SITE_FOOTER_", "Website bunntekst");
define("_SITE_FOOTER_DESC_", "Før </body> taggen");

define("_SITE_HEAD_", "Website topp");
define("_SITE_HEAD_DESC_", "Mellom <head> </head> taggene.");


####################################
#
### LICENSE KEY
#
####################################
define("_ENTER_LICENSE_KEY_", "Tast inn lisensnøkkel");
define("_LICENSE_KEY_", "Lisensnøkkel");
define("_LICENSE_KEY_ACCEPTED_", "Lisensnøkkel akseptert");
define("_INVALID_LICENSE_KEY_", "Lisensnøkkelen du tastet inn er ikke gyldig for denne site");

####################################
#
### EVENT REQUEST DESCRIPTION
#
####################################
define("_REQUEST_MODE_VIEW_ONLY_", "Medlemmer som kun har leserettigheter kan sende arrangementsforespørsler. Normale brukere kan legge til arrangementer direkte.");
define("_REQUEST_MODE_NORMAL_", "Medlemmer som kun har leserettigheter kan bare se kalenderen. Normale brukere kan sende arrangementsforespørsler.");

#####################################
#
### TELL A FRIEND FOR GUEST E-MAILS
#
######################################
define("_TELL_A_FRIEND_", "Fortell en venn");

define("_YOUR_NAME_", "Ditt navn");
define("_YOUR_EMAIL_", "Din e-post adresse");

define("_YOUR_FRIENDS_NAME_","Navnet på din venn");
define("_YOUR_FRIENDS_EMAIL_","E-post adressen til din venn");

define("_EMAIL_EVENT_DISPLAYED_","Arrangementet vil vises under beskjeden din.");

define("_ALLOW_GUEST_USERS_EMAIL_", "Tillat gjestebrukere å sende arrangementer via e-post.");

define("_DISABLE_SITE_ADDR_BOOK_", "Koble fra addressebok for ikke-administratorer");

define("_EMAIL_TO_MULTIPLE_", "Separer flere e-post adresser ved å bruke komma.");

# MISC
########
define("_HELP_", "Hjelp");
define("_WARNING_DIR_NOT_WRITABLE_", "Advarsel: Mappen %s er ikke skrivbar.");
define("_WARNING_FILE_NOT_WRITABLE_", "Advarsel: Filen %s er ikke skrivbar.");
define("_DOWNLOAD_", "Last ned");
define("_HIDE_QUICK_ADD_", "Gjem 'Quick Add Event' boksen");
define("_FORCE_DEFAULT_OPTS_", "Tving standardalternativer for alle brukere. Endre i Administrator - Standardalternativer.");
define("_NO_GUEST_TIMEZONE_", "Ikke tillat gjestebrukere å endre tidssone.");
define("_NUMBER_SYMBOL_", 'Nr.');
define("_DISABLE_WYSIWYG_EDITOR_", "Gjør WYSIWYG verktøy utilgjengelig for arrangementsnotater.");
define("_SHOW_CALENDAR_NAMES_", "Vis navn på arrangementskalender når Vis Arrangementsskategori Navn
	er definert i brukers alternativer.");
define("_MISC_", "Div.");
define("_THEME_POPUPS_", "Bruk tema på arrangementsnotater 'popups'.");

define("_PUBLIIC_", "Offentlig");
define("_REGISTERED_USERS_", "Registrerte brukere");

define("_NEW_", "Ny");

define("_CATEGORY_EDIT_DESC_", "For å redigere en kategori, klikk på tittelen");

define("_ARE_YOU_SURE_DELETE_", "Er du sikker på at du vil slette denne %s?");

########## END NEW TRANSLATIONS #################





################################
# EDIT / VIEW / POST CALENDARS
################################
define("_CALENDARS_", "Kalendere");
define("_OWNER_", "Eier");
define("_ARE_YOU_SURE_DELETE_CALENDAR_", "Er du sikker på at du vil slette denne kalenderen?");

define("_COLOR_BY_", "Fargelegg arrangementer etter");
define("_BY_OWNER_", "Arrangementseier");
define("_BY_CATEGORY_", "Arrangementskategori");
define("_BY_CALENDAR_", "Kalender");

define("_MODE_", "Modus");

define("_ALLOW_MULTI_CATS_", "Tillat flere kategorier for arrangementer");

define("_REMEMBER_LOCATIONS_", "Husk lokasjoner");

define("_STRICT_EVENT_SECURITY_", "Streng sikkerhet");
define("_STRICT_EVENT_SECURITY_DESC_", "Kun arrangementseier eller kalenderadministratorer kan
   endre eller slette eksisterende arrangementer.");

define("_REMOTE_ACCESS_", "Fjerntilgang");
define("_REMOTE_ACCESS_DESC_", "Fjerntilgang gjør det mulig for brukere å abbonere på denne kalenderen
	ved å bruke programvare som Mozilla Sunbird, Windates, eller Apple iCal. Dette vil
	også gjøre RSS syndication mulig, lesbar fra RSS programmer (f.eks, RssReader, Shrook)
	noen innholdsleverandører (f.eks, Yahoo!, MSN), og publiseringssystemer (f.eks, PHP-Nuke, Mambo).");

define("_ENABLE_REMOTE_ACCESS_UPD_", "Muliggjør oppdateringer fra fjernaksess. Dette gjør det mulig for autoriserte brukere å publisere
	Oppdateringer for denne kalenderen ved å bruke 3-parts applikasjoner.");

define("_REMOTE_ACCESS_DESC_USERS_", "Hvis gjestebrukeren ikke er medlem av denne kalenderen,
   vil brukernavn og passord bli krevet av personer som ønsker tilgang til denne kalenderen. Når autentisert,
   så vil aksess enten bli gitt eller nektet basert på medlemskonfigurasjonen.");

define("_SYNDICATION_", "Syndikasjon");

define("_EDIT_EVENT_TYPES_", "Editer kategorier");

define("_EVENT_TYPES_", "Kategorier");

define("_EVENT_TYPES_DESC_", "

       La alle være slått av for å bruke alle kategorier.<BR><BR>");

define("_MULTI_SELECT_WIN_","
       Windows: Å slå av en post eller å velge<br>flere, ikke-repeterende poster
       hold nede<br>CTRL-tasten samtidig som du velger den.  ");

define("_REALLY_DELETE_EVENT_TYPE_", "Vil du virkelig slette denne kategorien?"); # question
define("_DELETE_ALL_IN_CATEGORY_", "Slett alle arrangementer i denne kategorien.");

define("_VIEWS_NO_ACTION_", "Denne aksjonen kan ikke utføres under en visning. Vennligst
        velg en kalender.");

define("_VIEW_INVALID_CAL_", "Den nåværende visningen inneholder en kalender du ikke er medlem av. Arrangementer
i denne kalenderen vil ikke bli vist.");

define("_DESCRIPTION_", "Beskrivelse");
define("_DETAILS_", "Detaljer");
define("_PUBLISH_", "Publiser");
define("_PUBLISH_DESC_", "Publiser denne kalenderen til en ekstern web server eller tjeneste som
<a class='". _CAL_CSS_BODY_ ." ". _CAL_CSS_ULINE_."' target=_blank
href='http://icalx.com'>iCal Exchange</a>");
define("_SERVER_RESPONSE_", "Server svar");



######################
# EMAIL EVENT
######################
define("_EMAIL_EVENT_", "E-post");
define("_EMAIL_TO_", "Til");
define("_SEND_EMAIL_", "Send");
define("_SUBJECT_", "Emne");
define("_MESSAGE_", "Beskjed");
# e.g. The event has been sent to abcdefg@alphabet.com
define("_EMAIL_SENT_TO_", "Dette arrangementet har blitt sendt til ");
define("_EMAIL_NO_ADDR_WARNING_", "Advarsel: Du har ikke konfigurert en
e-post addresse i kontaktalternativer fanen under alternativer. Din e-post
vis vises å komme fra ". @constant("_CAL_MAIL_FROM_"));

######################
# EMAIL SETTINGS
######################
define("_MAIL_PROG_PHP_", "PHPs e-post funksjon");
define("_MAIL_PROG_CMD_", "lokal e-post funksjon (sendmail, qmail, etc.)");
define("_MAIL_PROG_SERVER_", "SMTP server");

define("_MAIL_PROGRAM_", "Send post ved å bruke");

define("_MAIL_FROM_EMAIL_", "E-post addresse");

define("_MAIL_PATH_", "lokal mailer sti");
define("_MAIL_AUTH_", "SMTP autentisering");

define("_MAIL_AUTH_USER_", "SMTP brukernavn");
define("_MAIL_AUTH_PASS_", "SMTP passord");

define("_MAIL_SERVER_", "SMTP server");
define("_MAIL_SERVER_PORT_", "Server port");

##########################
# ATTACHMENT SETTINGS
##########################
define("_ALLOW_ATTACHMENTS_", "Tillat filvedlegg");
define("_ATTACHMENTS_PATH_", "Sti til filvedlegg");

#############################
# GROUPS AND USERS
#############################
define("_USERS_", "Brukere");
define("_GROUPS_", "Grupper");
define("_EVERYONE_", "Samtlige");
define("_SUPER_USER_", "Superbruker");

define("_MEMBERS_", "Medlemmer");
define("_MEMBERS_OF_", "Medlem av");

define("_NAME_", "Navn");
define("_EMAIL_", "E-post");

define("_ACCESS_LVL_", "Tilgangsnivå");
define("_ROLE_", "Rolle");
define("_READ_ONLY_", "Kun visning");
define("_NORMAL_","Normal");

define("_ARE_YOU_SURE_DELETE_GROUP_", "Er du sikker på at du vil slette denne gruppen?");
define("_GROUPS_SAVE_ATLEAST_1_MEMBER_", "Grupper må ha minst ett medlem. Medlemsliste ikke lagret.");

# displayed as form field must begin with a character. E.g.
# Username must begin with a character.
define("_MUST_BEGIN_WITH_CHAR_", "må begynne med en bokstav.");

######################
# REMINDERS
######################
define("_REMINDERS_", "Påminnelser");
define("_BEFORE_EVENT_","før dette arrangementet, ved");

define("_WILL_OCCUR_IN_", "vil forekomme i"); # event x will occur in 30 minutes



###########################
# EVEVNT REQUESTS
############################
define("_REQUEST_", "Arrangementsforespørsel");
define("_REQUESTS_", "Arrangementsforespørsler");
define("_REQUEST_ACCEPTED_", "Din arrangementsforespørsel har blitt akseptert.");
define("_REQUEST_REJECTED_", "Din arrangementsforespørsel har blitt avvist.");

define("_NOTIFY_REQUESTOR_", "Meld fra til rekvisitør");
define("_REQUEST_HAS_NOTIFY_", "Rekvisitøren har bedt om å bli varslet.");
define("_REQUESTS_NO_PENDING_", "Det er ingen forespørsler som venter.");
define("_REQUEST_NOTIFY_EMAIL_", "Varsle meg om ventende forespørsler på");
define("_REQUEST_MSG_PRE_", "Beskjed som blir vist til brukere før forespørselen blir sendt.");
define("_REQUEST_MSG_POST_", "Beskjed som blir vist til brukere etter forespørselen er sendt.");
define("_REQUEST_NOTES_", "Ytterligere forespørselsinformasjon");
define("_REQUEST_NOTIFY_STATUS_", "Underrett meg om denne forespørselens status på");

define("_CONTACT_", "Kontakt");

# You have a pending event request on calendar: CALENDAR TITLE
define("_PENDING_REQUEST_", "Du har en ventende arrangementsforespørsel på kalender:");


#################
# DATE  ITEMS
#################
define("_CALENDAR_", "Kalender");

define("_MONTH_", "Måned");
define("_MONTHS_", "Måneder");

define("_DAY_","Dag");
define("_DAYS_", "Dager");

define("_YEAR_", "År");
define("_YEARS_", "År");

define("_WEEK_", "Uke");

# Abbreviated week
define("_WEEK_ABBR_", "Uke");

define("_WEEKS_", "Uke(r)");

define("_HOUR_", "Time");
define("_HR_", "hr");
define("_HOURS_", "timer");
define("_HRS_", "tmr");

define("_MINS_", "min.");
define("_MINUTES_", "minutter");

define("_DATE_", "Dato");
define("_TIME_", "Tid");

define("_AM_", "am");
define("_AM_SHORT_", "a");
define("_PM_", "pm");
define("_PM_SHORT_", "p");

# VIEWS
define("_TODAY_", "I dag");
define("_THIS_WEEK_", "Denne uken");
define("_THIS_MONTH_", "Denne måneden");

##################
# MISCELLANEOUS
##################
define("_EVENT_", "Arrangement");
define("_EVENTS_", "Arrangementer");
define("_VIEW_", "Vis");

# VIEW AS A NOUN
define("_VIEW_NOUN_", "Vis");

define("_PRINTABLE_VIEW_", "Skrivervennlig visning");

define("_ALLDAY_", "Hele dagen");

define("_CAL_CALL_FOR_TIMES_", "Kall for tider");
define("_CAL_CALL_FOR_TIMES_MIN_", "(*)");

define("_TYPE_","Type");
define("_EVENT_TYPE_", "Kategori");

define("_WIDTH_", "Bredde");

define("_COLORS_", "Farger");

# List separator. Note space after comma
define("_LIST_SEP_",", ");

###########################
# ADMIN PAGE 
###########################
define("_GLOBAL_SETTINGS_", "Website innstillinger");
define("_EDIT_DEFAULT_OPTS_", "Standardalternativer");
define("_PASS_MUST_MATCH_", "Passordene du oppga stemmer ikke overens med hverandre");
define("_EMPTY_PASSWORD_", "Ikke setter passord til \"\"!");
define("_ARE_YOU_SURE_DELETE_USER_", "Er du sikker på at du vil slette denne brukeren?");
define("_DELETE_USERS_EVENTS_", "Slett alle arrangementer som er eid av denne brukeren.");
define("_CALENDARS_OWNED_", "Kalendere eid av denne brukeren");
define("_AUDIT_USERS_", "Revider brukere");
define("_AUDIT_USERS_DESC_", "Brukere funnet i Thymes database, men har ikke
korresponderende brukerinformasjon i den nåværende autentiseringsmodulen.<br>Alle brukerverdier
har blitt satt til uid for den manglende brukeren.");

define("_CALENDAR_PUBLISHER_", "Kalenderutgiver");
define("_CAL_USER_GUEST_", "Gjestekonto");
define("_CAL_PUBLISH_GUEST_DISABLED_", "Kalenderutgiveren vil ikke virke hvis
        gjestekontoen er frakoblet. Vennligst koble til denne kontoen i brukerseksjonen.");


####################################
# GENERAL ACTIONS AND RESPONSES
####################################
define("_ADD_", "Legg til");
define("_NEW_EVENT_", "Nytt arrangement");
define("_REMOVE_", "Fjern");
define("_UPDATE_", "Oppdater");
define("_NEXT_", "Neste");
define("_PREV_", "Forrige");
define("_DELETE_", "Slett");
define("_SAVE_", "Lagre");
define("_TEST_", "Test");
define("_UPDATE_NOW_", "Oppdater nå");
define("_SAVE_ADD_", "Lagre og ny");
define("_CANCEL_", "Kanseller");
define("_BROWSE_", "Bla");
define("_NONE_", "Ingen");
define("_RESET_", "Reset");
define("_CLEAR_ALL_", "Fjern alle");
define("_CHECK_ALL_", "Marker alle");
define("_EDIT_", "Rediger");
define("_CLOSE_", "Lukk");
define("_SHOW_", "Vis");
define("_HIDE_", "Gjem");
define("_ENABLE_", "Slå på");
define("_DISABLE_", "Slå av");
define("_MOVE_", "Flytt");
define("_UP_", "Opp");
define("_DOWN_", "Ned");
define("_ENABLED_", "Slått på");
define("_CONFIGURE_", "Konfigurer");
define("_ACCEPT_", "Aksepter");
define("_REJECT_", "Avvis");
define("_OK_", "OK");
define("_FAILED_", "MISLYKKET");
define("_CHANGE_", "Endre");
define("_SORT_BY_", "Sorter ved");
define("_SEARCH_", "Søk");
define("_FORCE_", "Tving");
define("_AUTODETECT_", "Autodetekter");
define("_RESET_PASS_", "Endre passord");
define("_NEW_PASS_", "Nytt passord");
define("_RETYPE_", "Tast en gang til");
define("_UPDATED_", "Oppdatert");
define("_SUBMITTED_", "Sendt");
define("_LOGIN_", "Logg på");
define("_USERNAME_", "Brukernavn");
define("_PASSWORD_", "Passord");
define("_LOGOUT_", "Logg av");
define("_OPTIONS_", "Alternativer");
define("_ADMIN_", "Administrator");
define("_BAD_PASS_", "Feil brukernavn eller passord.");
define("_YES_", "Ja");
define("_NO_", "Nei");
define("_VALUE_", "Verdi");
define("_CUSTOM_", "Tilpasset");
define("_DEFAULT_", "Standard");

######################
# ATTACHMENTS
######################
define("_ATTACHMENTS_", "Vedlegg");
define("_ATTACH_DETACH_", "Fjern vedlegg");
define("_ATTACH_DELETE_", "Slett");
define("_ATTACHMENT_TOO_BIG_", "Vedlegget er større enn tillatt.");
define("_DOWNLOAD_ZIP_", "Last ned Zip");
define("_UPDATE_ATTACHMENTS_", "Oppdater vedlegg");

define("_BYTES_", "b");
define("_KBYTES_", "KB");
define("_MBYTES_", "MB");


#################
# EVENT LIST VIEW 
#################
define("_ALL_", "Alle");
define("_UPCOMING_", "Fremtidige");
define("_PAST_", "Tidligere");

define("_SHOWING_", "viser");
define("_OF_", "av");
define("_FIRST_", "Første");
define("_LAST_", "Siste");
define("_SHOW_TYPE_", "Kategori");

define("_LIST_SIZE_", "Liste størrelse");

define("_ARE_NO_EVENTS_", "Det er ingen arrangementer å vise.");

define("_EVENTS_CONTAINING_", "Arrangementer som inneholder"); # used in event search

define("_ARE_YOU_SURE_DELETE_EVENTS_", "Er du sikker på at du vil slette disse arrangementene?");
define("_DELETE_REPEATING_WARNING_", "
   Du har valgt å slette en eller flere repeterende arrangementer.<br>
   Alle tidligere og fremtidige arrangementer vil bli fjernet! ");

define("_UNCHECK_NO_DELETE_", "Fjern markeringen på arrangementer du ikke ønsker å slette:");
define("_DELETE_CHECKED_", "Slett markerte");

define("_RETURN_", "Returner");
define("_ERROR_", "Feil!");

######################
# EVENT EDIT/ADD/VIEW
######################
define("_GENERAL_", "Generell");

define("_ORGANIZER_", "Organisator");

define("_URL_", "URL");

define("_REPEATING_", "Repeterende");

define("_LOCATION_", "Sted");

define("_APPLY_TO_", "Påfør endringer til");
define("_ALL_DATES_", "alle datoer");
define("_THIS_DATE_", "kun denne datoen");

define("_RESET_INSTANCE_", "Nullstill denne posten til dens orginale status");

define("_MAP_", "Kart");

define("_STARTED_", "Startet");

# e.g. Overrides event Weekly Meeting on 2004-2-34
define("_OVERRIDE_EVNT_ON_", "Overstyrer arrangement %s på %s");

# e.g. Warning: the event Event Title has an invalid repeating rule
define("_INVALID_RRULE_", "Advarsel: Arrangementet %s har en ugyldig repeteringsregel.");

define("_MAX_CHARS_", "maksimale tegn");
define("_EVENT_INFO_", "Arrangementsinformasjon");
define("_TITLE_", "Tittel");
define("_NOTES_", "Notater");

define("_CHECK_FOR_CONFLICTS_", "Sjekk for konflikter");

define("_THIS_EVENT_ALLDAY_", "Dette er et <b>heldagsarrangement</b>.");
define("_STARTS_AT_", "Starter klokken");
define("_DURATION_", "Varighet");

define("_FLAG_", "Flagg");
define("_FLAG_THIS_", "Flagg dette arrangementet");
define("_IS_FLAGGED_", "Dette arrangementet er flagget");

# e.g. 10 days ago
define("_AGO_", "siden");

define("_REPEATING_NO_", "Dette arrangementet repeterer ikke.");
define("_REPEATING_REPEAT_", "Repeter");
define("_REPEATING_SELECTED_", "valgte dager");
define("_REPEATING_EVERY1_", "hver");

define("_REPEAT_ON_", "Repeter på den");
define("_REPEAT_ON1_", "første");
define("_REPEAT_ON2_", "andre");
define("_REPEAT_ON3_", "tredje");
define("_REPEAT_ON4_", "fjerde");
define("_REPEAT_ON5_", "femte");
define("_REPEAT_ONL_", "siste");
define("_REPEAT_ON_OF_", "i måneden, hver");

define("_SIMPLE_", "Enkel");
define("_ADVANCED_","Avansert");

define("_YEARLY_", "Årlig");
define("_MONTHLY_", "Månedlig");
define("_WEEKLY_", "Ukentlig");
define("_DAILY_", "Daglig");
define("_EASTER_", "Påske");
define("_EASTER_YEARLY_", "Hver påske");

define("_MONTH_DAYS_", "Måned dag(er)");
define("_FROM_LAST_", "fra siste");

define("_WEEKDAYS_", "Ukedag(er)");

define("_YEARLY_NOTES_", "Standard måned og dag er tatt fra
        startdato hvis ingen er valgt.");


define("_SPECIFIC_OCCURRENCES_", "Spesifike forekomster");

define("_STARTING_ON_", "starter den");

define("_BEFORE_", "Før");
define("_AFTER_", "Etter");

define("_EXCLUDE_DATES_", "Utelat datoer");

define("_CONFIRM_EVNT_RPT_CHANGE_", "Du er i ferd med å endre repeteringsregel eller datoer for dette arrangementet.\n
Alle unntak assosiert med dette repererende arrangementet vil forsvinne. Er du sikker på at du vil gjøre dette?\n");


define("_END_DATE_", "Sluttdato");
define("_END_DATE_NO_", "Ingen sluttdato");
define("_END_DATE_UNTIL_", "Til");
define("_END_DATE_AFTER_", "Slutt etter");
define("_OCCURRENCES_", "forekomster");

define("_ADDRESS_", "Addresse");
define("_ADDRESS_1_", "Gate/vei");
define("_ADDRESS_2_", "Sted, Postnummer");

define("_PHONE_", "Telefon");
define("_ICON_", "Ikon");

#####################
# MODULES
#####################
define("_NAVBAR_", "Navigasjon");
define("_MODULE_", "Modul");
define("_MODULES_", "Moduler");
define("_TODAY_LINK_", "I dag lenke");
define("_MINI_CAL_", "Mini Cal");
define("_CALENDAR_LINKS_", "Kalender lenker");
define("_IMAGE_BROWSER_", "Bildebrowser");
define("_QUICK_ADD_EVNT_", "'Quick Add Event'");
define("_GOTO_DATE_", "Gå til dato");
define("_SEARCH_EVENTS_", "Søk arrangementer");
define("_EVENT_FILTER_", "Kategori");
define("_COLOR_LEGEND_", "Fargeforklaring");

##################
# SYNC 
##################

define("_SYNC_", "Synkronisering");
define("_IMPORT_", "Importer");
define("_EXPORT_", "Eksporter");
define("_IMPORT_FROM_", "Importer fra");
define("_EXPORT_TO_", "Eksporter til");
define("_SYNC_DUPLICATES_", "Hvis duplikater er funnet");
define("_IGNORE_DUPLICATES_", "Ignorer duplikater");
define("_OVERWRITE_EXISTING_EVENT_", "Overskriv eksisterende arrangement");
define("_CREATE_NEW_EVENT_", "Lag nytt arrangement");
define("_IMPORT_AS_", "Importer til kategori");
define("_EVENTS_IMPORTED_", "Arrangementer importert");
define("_SYNC_IMPORT_ERROR_", "Feil: Det oppstod en feil under overføringen av filen du prøver å importere.");
define("_HTML_", "HTML");
define("_PLAINTEXT_", "Ren tekst");
define("_ICAL_", "iCalendar (.ics)");
define("_QUIRKS_MODE_", "Quirks Mode");
define("_PERMISSION_DENIED_", "Ingen adgang: Du er hverken eier av dette arrangementet, eller
administrator for denne kalenderen.");
define("_FULL_SYNC_", "Full Synkronisering");
define("_FULL_SYNC_DESC_", "Slett arrangementer som finnes i kalenderen, men som ikke finnes i den importerte filen.");

#########################
# CSS AND STYLE
#########################
define("_COLOR_", "Farge");

define("_STYLE_", "Stil");

define("_PREVIEW_", "Forhåndsvis");
define("_SAMPLE_", "Sample");

define("_BACKGROUND_COLOR_", "Bakgrunnsfarge");
define("_FONT_COLOR_", "Skriftfarge");
define("_FONT_SIZE_", "Skriftstørrelse");

define("_FONT_STYLE_", "Skrift");
define("_BOLD_", "fet");
define("_ITALICS_", "kursiv");
define("_UNDERLINE_", "understreking");

define("_FONT_FAMILY_", "Font Family");
define("_FONT_FAMILY_DESC_", "F.eks Tahoma, 'Sans Serif', Arial");

define("_UNDERLINE_LINKS_", "Understrek lenker");
define("_NEVER_", "Aldri");
define("_ALWAYS_", "Alltid");
define("_HOVER_", "Svev");
define("_BORDER_COLOR_", "Kantfarge");
define("_TIME_FONT_COLOR_", "Farge på tidspunkt");
define("_TITLE_FONT_COLOR_", "Farge på tittel");
define("_TITLE_FONT_STYLE_", "Skriftstil på tittel");

#########################
# CALENDAR PUBLISHER
#########################
if(@constant("_CAL_DOING_PUBLISHER_")) { # <- leave this line alone

define("_MINI_MONTH_", "Mini måned");

define("_SET_DATE_CURRENT_", "Sett til dagens dato");
define("_EDITABLE_", "Redigerbar");
define("_STATIC_", "Statisk");
define("_STATIC_DESC_", "Kalenderens innhold har ingen lenker som skifter dato eller visning");
define("_HIL_DAY_", "Fremhev dag");
define("_HIL_WEEK_", "Fremhev uke");

define("_APPLY_CSS_FROM_", "Bruk stil fra");
define("_NO_CSS_", "ingen");
define("_CSS_EDITOR_", "Rediger stil");

define("_LANGUAGE_", "Språk");
define("_EURO_DATE_", "Europeisk datoformat");
define("_EURO_DATE_DESC_", "Datoer blir vist som dd/mm/yyyy hvor anvendt");

define("_HEADER_", "Overskrift");
define("_WEEKDAY_HEADER_", "Ukedag overskrift");

define("_NORMAL_DAYS_", "Normale dager");
define("_DAYS_NOT_IN_MONTH_", "Dager ikke i måned");
define("_HIGHLIGHTED_DAYS_", "Markerte dager");

define("_NORMAL_EVENTS_", "Normale arrangementer");
define("_FLAGGED_EVENTS_", "Flaggede arrangementer");

define("_SHOW_EVENTS_", "Vis arrangementer");


define("_EVENT_LINKS_", "Arrangementslenker");

define("_EVENT_LINK_URL_", "Arrangementslenker URL");

define("_EVENT_LINK_URL_DESC_", "

        Denne URLen vil bli gitt en streng som inneholder
        <font class='"._CAL_CSS_HIL_."'>eid</font> og <font class='"._CAL_CSS_HIL_."'>post</font>.<br>

        <b>eid</b> er IDen til arrangementet og <b>post</b> er datoen i
        <b>DD-MM-YYYY</b> format.<br>Disse er synlige som <font class='"._CAL_CSS_HIL_."'>%eid</font>
        og <font class='"._CAL_CSS_HIL_."'>%inst</font>.<br><br>

        F.eks http://mysite.com/sales/view_sale.php?eid=%eid&instance=%inst kan resultere i:<br>

        http://mysite.com/sales/view_sale.php?<font
		class='"._CAL_CSS_HIL_."'>eid</font>=56&<font
		class='"._CAL_CSS_HIL_."'>instance</font>=2005-10-26<br><br>
 
        Se dokumentasjon og/eller brukerveiledning på extrosoft.com for mer
        informasjon om hvordan bruke disse. ");


define("_SHOW_HEADER_", "Vis tittel");
define("_ALIGN_HEADER_TEXT_", "Juster topptekst");
define("_CENTER_", "Sentrer");
define("_HEADER_TEXT_", "Tittel tekst");

define("_HEADER_TEXT_DESC_","

   (F.eks <font class='"._CAL_CSS_HIL_."'>Fødselsdager i %month</font>)<br>
        <font size=1><i>La være tom for å bruke
        standard topptekst. Andre variable inkluderer %weekday, %mday, %mon and %year.</i></font> ");


define("_SHOW_HEADER_LINKS_", "Vis tittel lenker");

define("_NEXT_LINK_", "'Neste' lenke");
define("_PREV_LINK_", "'Forrige' lenke");

define("_IMG_URL_", "Bilde URL");

define("_HEADER_LINKS_", "Tittel lenker");

define("_IMG_URL_DESC_", "
        Dette kan være tekst som '<<' eller en URL til en billedfil<br>
        (F.eks <font
        class='"._CAL_CSS_HIL_."'>http://www.myserver.com/images/next.gif</font>)<br><font
        size=1><i>La disse være tomme for å bruke standard billedfil fra det
        valgte temaet.</i></font> ");


define("_DAY_VIEW_", "Dagsvisning");

define("_MONTH_VIEWS_", "Månedsvisning");

define("_SHOW_WEEKS_DESC_", "Merk: Mini-måned kalendere vil aldri vise ukenumre");

define("_ROW_HEIGHT_", "Rad høyde");
define("_ROW_HEIGHT_DESC_", "Standard er '90' for en måned, '0' for en Mini-måned");

define("_LIMIT_WEEKDAY_NAMES_", "Begrens navn på ukedager til ");
define("_CHARS_", "bokstaver");

define("_EXCLUDE_MONTH_DAYS_", "Ekskluder dager ikke i valgte måned");

define("_MINI_MONTH_DATE_URL_", "Mini-måned dato URL");

define("_MINI_MONTH_DATE_URL_DESC_", "
        Lenken som ved å klikke en dag i en Mini-måned
        vil lede til. Dette erstatter følgende strenger:<br>

        %d = dag nummer<br>
        %m = måned nummer<br>
        %y = år nummer<br>

        <br><br>

        F.eks http://www.myserver.com/page.php?day=%d&month=%m&year=%y<br>
        kan resultere i
        <font class='"._CAL_CSS_HIL_."'>http://www.myserver.com/page.php?day=23&month=11&year=2004</font>

        <br>eller du kan t.o.m. bruke en JavaScript funksjon.<br>

        F.eks <font class='"._CAL_CSS_HIL_."'>javascript:myFunction(%y,%m,%d)</font><br><br>

        Standard er en lenke til denne siden som setter:<br>
        m = %m<br>
        d = %d<br>
        y = %y<br>

        F.eks <font class='"._CAL_CSS_HIL_."'>index.php?d=23&m=11&y=2004</font><br><br>
        Se dokumentasjon og/eller brukerveiledning på extrosoft.com for mer
        informasjon om hvordan bruke disse.");


define("_GENERATED_CODE_", "Generert kode");

define("_BASE_PATH_DESC_", "base path av thyme med skråstrek på slutten");
define("_BASE_URL_DESC_", "base url av thyme med skråstrek på slutten");

} # </ CALENDAR PUBLISHER SECTION > <- leave this line alone


######################
#
### RSS FEED MODULES
#
#####################
define("_RSS_FEED_MODULES_", "RSS Feed moduler");
define("_RSS_", "RSS Feeds");
define("_UPDATE_INTERVAL_", "Oppdateringsintervall");
define("_ARE_YOU_SURE_DELETE_RSSMOD_", "Er du sikker på at du vil slette denne RSS modulen?");
define("_AUTHOR_", "Forfatter");

# scrolling
define("_SCROLLING_","Rullering");
define("_OVERFLOW_", "Overflow");
define("_SCROLLBAR_", "Rullefelt");
define("_AUTOSCROLL_", "Autorullering");


# This will keep us from needing to
# have these defined when not looking
# at options
#####################################
if(@constant("_CAL_DOING_OPTS_")) { # <- leave this line alone

######################
# OPTION STRINGS
######################

define("_DEFAULT_VIEW_", "Standardvisning");

define("_DEFAULT_CALENDAR_", "Standard kalender");

define("_TIME_INTERVALS_", "Tidsintervaller");

define("_EVNT_SIZE_", "Størrelse på arrangementet");
define("_SMALLER_", "Mindre");
define("_SMALLEST_", "Minst");
define("_EVNT_COLLAPSE_", "Legg sammen arrangementer (månedsvisning)");
define("_EVNT_COLLAPSE_DESC_", "Legg sammen lange arrangementstitler.");
define("_EVNT_TYPE_NAME_", "Vis kategorier for arrangementer");
define("_EVNT_POPUP_", "Arrangement 'popup'");
define("_EVNT_POPUP_DESC_", "Vis arrangementer i et nytt vindu.");
define("_EVNT_NOTES_POPUP_", "Arrangementsnotater 'popup'");
define("_EVNT_NOTES_POPUP_DESC_", "Posisjoner musen din over et arrangement
	for å se merknader.");

define("_POSITION_", "Posisjon");

define("_SHOW_WEEKS_", "Vis uke nummerering");

define("_WEEK_START_", "Uken starter på");
define("_WORK_HOURS_", "Arbeidsdagen");
define("_WORK_HOURS_START_", "starter klokken");
define("_WORK_HOURS_END_", "slutter klokken");

define("_HOUR_FORMAT_", "Tidsformat");
define("_HOUR_FORMAT_12_", "12 hr");
define("_HOUR_FORMAT_24_", "24 hr");

define("_NAV_BAR_LOC_", "Navigasjonsmeny");
define("_RIGHT_", "Høyre");
define("_LEFT_", "Venstre");

define("_TIMEZONE_", "Tidssone");
define("_DST_", "Sommertid");
define("_STARTS_", "Starter");
define("_ENDS_", "Slutter");

define("_IN_", "i");
define("_ON_", "PÅ");
define("_OFF_", "AV");

define("_THEME_", "Tema");

##########################
# CONTACT OPTIONS
##########################
define("_CONTACT_OPTS_", "Kontaktalternativer");
define("_PRIMARY_", "Primær");
define("_FORMAT_", "Format");

##########################
# SUBSCRIPTIONS
##########################
define("_SUBSCRIPTIONS_", "Abbonementer");
define("_SUBSCRIPTIONS_DESC_", "E-post abbonementer til kalendre.");

######################
# NOTIFICATIONS
#####################
define("_NOTIFICATIONS_", "Meldinger");
define("_NOTIFICATIONS_DESC_", "Meldingsfiltre for nye og oppdaterte arrangementer.");

define("_TITLE_CONTAINS_", "Tittel inneholder");
# event X has been updated on calendar Y
define("_UPDATED_ON_", "ble oppdatert den");
# event X has been added to calendar Y
define("_ADDED_TO_", "ble lagt til");

#####################
# DST STRINGS
#####################
define("_DST_OPTS1_", "Afrika / Egypt");
define("_DST_OPTS2_", "Afrika / Namibia");
define("_DST_OPTS3_", "Asia / Tidligere Sovjet - de fleste stater");
define("_DST_OPTS4_", "Asia / Irak");
define("_DST_OPTS5_", "Asia / Libanon, Kirgistan");
define("_DST_OPTS6_", "Asia / Syria");
define("_DST_OPTS7_", "Australasia / Australia, New South Wales");
define("_DST_OPTS8_", "Australasia / Australia - Tasmania");
define("_DST_OPTS9_", "Australasia / New Zealand, Chatham");
define("_DST_OPTS10_", "Australasia / Tonga");
define("_DST_OPTS11_", "Europe / Europeiske Union, UK, Grønland");
define("_DST_OPTS12_", "Europe / Russland");
define("_DST_OPTS13_", "Nord Amerika / USA, Canada, Mexico");
define("_DST_OPTS14_", "Nord Amerika / Cuba");
define("_DST_OPTS15_", "Sør Amerika / Chile");
define("_DST_OPTS16_", "Sør Amerika / Paraguay");
define("_DST_OPTS17_", "Sør Amerika / Falklandsøyene");

####################
# TIMEZONE STRINGS
####################
define("_GMT_PLUS_0.0_","GMT +00:00 England, Ireland, Portugal, Vestafrika ");
define("_GMT_PLUS_0.5_","GMT +00:30 ");
define("_GMT_PLUS_1.0_","GMT +01:00 Vesteuropa, Sentralafrika");
define("_GMT_PLUS_1.5_","GMT +01:30 ");
define("_GMT_PLUS_2.0_","GMT +02:00 Østeuropa, Østafrika");
define("_GMT_PLUS_2.5_","GMT +02:30 ");
define("_GMT_PLUS_3.0_","GMT +03:00 Russland, Saudi Arabia");
define("_GMT_PLUS_3.5_","GMT +03:30 ");
define("_GMT_PLUS_4.0_","GMT +04:00 Arabiske strøk");
define("_GMT_PLUS_4.5_","GMT +04:30 ");
define("_GMT_PLUS_5.0_","GMT +05:00 Vestlige Asia, Pakistan");
define("_GMT_PLUS_5.5_","GMT +05:30 India");
define("_GMT_PLUS_6.0_","GMT +06:00 Sentralasia");
define("_GMT_PLUS_6.5_","GMT +06:30 ");
define("_GMT_PLUS_7.0_","GMT +07:00 Bangkok, Hanoi, Jakarta");
define("_GMT_PLUS_7.5_","GMT +07:30 ");
define("_GMT_PLUS_8.0_","GMT +08:00 Kina, Singapore, Taiwan");
define("_GMT_PLUS_8.5_","GMT +08:30 ");
define("_GMT_PLUS_9.0_","GMT +09:00 Korea, Japan");
define("_GMT_PLUS_9.5_","GMT +09:30 Sentrale Australia");
define("_GMT_PLUS_10.0_","GMT +10:00 Østlige Australia");
define("_GMT_PLUS_10.5_","GMT +10:30 ");
define("_GMT_PLUS_11.0_","GMT +11:00 Det sentrale stillehav");
define("_GMT_PLUS_11.5_","GMT +11:30 ");
define("_GMT_PLUS_12.0_","GMT +12:00 Fiji, New Zealand");
define("_GMT_MINUS_12.0_","GMT -12:00 Datolinjen ");
define("_GMT_MINUS_11.5_","GMT -11:30 ");
define("_GMT_MINUS_11.0_","GMT -11:00 Midwayøyene, Samoa");
define("_GMT_MINUS_10.5_","GMT -10:30 ");
define("_GMT_MINUS_10.0_","GMT -10:00 Hawaii");
define("_GMT_MINUS_9.5_","GMT -09:30 ");
define("_GMT_MINUS_9.0_","GMT -09:00 Alaska");
define("_GMT_MINUS_8.5_","GMT -08:30 ");
define("_GMT_MINUS_8.0_","GMT -08:00 Stillehavskysten (USA og Canada)");
define("_GMT_MINUS_7.5_","GMT -07:30 ");
define("_GMT_MINUS_7.0_","GMT -07:00 Rocky Mountains (USA og Canada)");
define("_GMT_MINUS_6.5_","GMT -06:30 ");
define("_GMT_MINUS_6.0_","GMT -06:00 Midtvesten (USA og Canada)");
define("_GMT_MINUS_5.5_","GMT -05:30 ");
define("_GMT_MINUS_5.0_","GMT -05:00 Østkysten (USA og Canada), Colombia, Peru");
define("_GMT_MINUS_4.5_","GMT -04:30 ");
define("_GMT_MINUS_4.0_","GMT -04:00 Bolivia, vestlige Brasil, Chile, atlanterhavskysten");
define("_GMT_MINUS_3.5_","GMT -03:30 Newfoundland");
define("_GMT_MINUS_3.0_","GMT -03:00 Argentina, østlige Brasil, Grønland");
define("_GMT_MINUS_2.5_","GMT -02:30 ");
define("_GMT_MINUS_2.0_","GMT -02:00 Det sentrale atlanterhav");
define("_GMT_MINUS_1.5_","GMT -01:30 ");
define("_GMT_MINUS_1.0_","GMT -01:00 Azorene/Det østlige atlanterhav");
define("_GMT_MINUS_0.5_","GMT -00:30 ");

}

##########################
# ERRORS AND WARNINGS
##########################
define("_WARNING_ATTACH_", "Advarsel: Vedleggsmappen %s eksisterer ikke eller er ikke skrivbar.");
define("_WARNING_RSS_", "Advarsel: RSS feed lager er ikke skrivbar.");
define("_WARNING_INSTALL_", "Advarsel: %s eksisterer enda. Vennligst fjern denne filen.");
define("_WARNING_LICENSE_", "Advarsel: Thymes lisens vil gå ut om %s dager.");


# Date formats
#
# See PHP's documentation for
# 'date' for more format options 
# some are:
# j = day of the month
# n = month number
# Y = full year number
#################################
define("_DATE_INT_FULL_", "n/j/Y");
define("_DATE_INT_NOYR_", "n/j"); # only used in Week view


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
  "Mars",
  "April",
  "Mai",
  "Juni",
  "Juli",
  "August",
  "September",
  "Oktober",
  "November",
  "Desember");

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
  "Mai",
  "Jun",
  "Jul",
  "Aug",
  "Sep",
  "Okt",
  "Nov",
  "Des");



?>
