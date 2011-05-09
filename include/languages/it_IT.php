<?php
###########################################
# Translated by Raffaele Bolliger
# Raffaele dot Bolliger at epfl dot ch
# Version: 1.1
# Created date: 01/13/2006
# Last update: 03/21/2006
# Modified by Raffaele Bolliger
###########################################
#
# Con questa opzione fissata a 1, Nov 2nd 2004 sarà monstrato 
#come 2/11/2004 dove possibile. Con l'ozione 
# a 0, apparirà come 11/2/2004.
#
# all date selects are also affected by this
# as they will be day-month-year
#
###########################################
define("_CAL_EURO_DATE_", 1);

define("_CHARSET_", "iso-8859-1");

define("_LANG_NAME_", "Italiano (IT)");


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
define("_GLOBAL_VIEWS_", "Viste globali");

define("_ALLOW_EVERYONE_VIEW_", "Permetti a chiunque di vedere tutti i calendari in questa vista indipendentemente dalla lista dei loro membri");

define("_HIDE_VIEW_FROM_GUESTS_", "Nascondi questa vista agli utenti invitati (Guest)");

define("_REQUEST_NOTIFY_OWNER_", "Segnala le richieste in attesa al proprietario del calendario");

define("_ALL_CALENDARS_", "Tutte le viste dei calendari");

#################################
#
### INSTALLER 
#
#################################

# some of these will not be used until 2.0
define("_INSTALLER_", "Programmai di installazione");
define("_PACKAGE_", "Pacchetto");
define("_INSTALL_", "Installa");
define("_INVALID_PACKAGE_", "Il file appena caricato non é un pacchetto valido per Thyme.");
define("_INSTALLED_MODULES_", "Moduli installati");
define("_UNINSTALL_", "Disinstalla");
define("_LOCAL_FILE_","File locale");
define("_UPDATES_", "Aggiornamenti");
define("_AVAILABLE_UPDATES_", "Aggiornamenti disponibili");
define("_CHECK_FOR_UPDATES_", "Controlla gli aggiornamenti");
define("_LAST_CHECKED_ON_", "Ultimo controllo:"); # e.g. last checked on 1/2/2007
define("_FILE_", "File");
define("_WRITABLE_", "Scrivibile");
define("_REFRESH_", "Aggiorna");
define("_INVALID_DOWNLOAD_", "Download non riuscito. Impossibile aggiornare il file.");
define("_UNABLE_TO_BACKUP_", "Impossibile effettuare un backup del file corrente.");
define("_UPDATES_AVAIL_", "%s aggiornamenti disponibili"); # %s will be replaced w/# of updates available

############################
#
### NEW USER DEFINITIONS
#
###########################
define("_REGISTERED_USERS_", "Utente registrato");
define("_PUBLIC_", "Pubblico");
define("_PUBLIC_ACCESS_", "Accesso pubblico");

#############################
#
### MULTIPLE REMINDERS
#
#############################
define("_BEFORE_EVENT_MULTI_", "prima di questo evento");
define("_USER_CAN_NOT_VIEW_", "%s non ha il diritto di vedere questo calendario.");
define("_ALLOW_CONFIGURE_REMINDERS_", "Permetti a %s di configurare i promemoria degli eventi per tutti gli utenti.");
define("_CALENDAR_ADMINS_", "Amministratori del calendario");
define("_EVENT_OWNER_", "Proprietario dell'evento");
define("_SITE_ADMINS_", "Amministratori del sito");
define("_NO_ONE_", "Nessuno");

###############################
#
## CONFIGURABLE JOB INTERVALS
#
###############################

define("_REMIND_AT_LEAST_", "Almeno");
define("_SCHEDULED_TASK_", "Attività programmata");
define("_NO_SCHEDULED_TASK_", "L'attività Thyme programmata non é configurata per entrare in funzione");
define("_SCHEDULED_TASK_CONFIGURED_", "L'attività Thyme é programmata per essere eseguita ogni");
define("_PHP_CLI_", "Percorso di PHP CLI");

###################################
#
### CUSTOMIZE SITE
#
###################################
define("_CUSTOMIZE_SITE_", "Personalizza il sito");
define("_SITE_NAME_", "Nome del sito");
define("_SITE_THEME_", "Tema del sito");
define("_SITE_THEME_DESC_", "segliendo Nessuno si permette agli utenti di schegliere il proprio tema");

# use exact HTML tags, they will be displayed correctly
# when printed
define("_SITE_HEADER_", "Intestazione del sito (header)");
define("_SITE_HEADER_DESC_", "Dopo il tag <body>");

define("_SITE_FOOTER_", "Piede di pagina del sito (footer)");
define("_SITE_FOOTER_DESC_", "Prima del tag </body>");

define("_SITE_HEAD_", "Zona Head del sito");
define("_SITE_HEAD_DESC_", "Tra i tag <head> e </head>.");


####################################
#
### LICENSE KEY
#
####################################
define("_ENTER_LICENSE_KEY_", "Inserire il codice di licenza");
define("_LICENSE_KEY_", "Codice di licenza");
define("_LICENSE_KEY_ACCEPTED_", "Codice di licenza accettato");
define("_INVALID_LICENSE_KEY_", "Il codice di licenza appena inseritonon é valido per questo sito");

####################################
#
### EVENT REQUEST DESCRIPTION
#
####################################
define("_REQUEST_MODE_VIEW_ONLY_", "Gli utenti che hanno solamente i diritti di lettura possono sottoporre delle richieste di eventi. Gli utenti normali possono aggiungerli direttamente.");
define("_REQUEST_MODE_NORMAL_", "Gli utenti che hanno slolamente i diritti di lettura possono solamente vedere il calendario. Gli utenti normali possono proporre delle richieste di eventi.");

#####################################
#
### TELL A FRIEND FOR GUEST E-MAILS
#
######################################
define("_TELL_A_FRIEND_", "Dillo ad un amico");

define("_YOUR_NAME_", "Il tuo nome");
define("_YOUR_EMAIL_", "Il tuo e-mail");

define("_YOUR_FRIENDS_NAME_","Il nome del tuo amico");
define("_YOUR_FRIENDS_EMAIL_","L'e-mail del tuo amico");

define("_EMAIL_EVENT_DISPLAYED_","L'evento verrà mostrato sotto il tuo messaggio.");

define("_ALLOW_GUEST_USERS_EMAIL_", "Permetti agli utenti invitati (Guest) di spedire gli eventi per e-mail.");
define("_DISABLE_SITE_ADDR_BOOK_", "Disattiva i contatti del sito per gli utenti che non sono amministratori");

define("_EMAIL_TO_MULTIPLE_", "Separa gli indirizzi multipli con una virgola.");

# MISC
########
define("_HELP_", "Aiuto");
define("_WARNING_DIR_NOT_WRITABLE_", "Attenzione: la cartella %s non é accessibile in scrittura.");
define("_WARNING_FILE_NOT_WRITABLE_", "Attenzione: il file %s non é accessibile in scrittura.");
define("_DOWNLOAD_", "Scarica");
define("_HIDE_QUICK_ADD_", "Nascondi il bottone di aggiunta rapida di eventi");
define("_FORCE_DEFAULT_OPTS_", "Forza le opzioni di default per tutti gli utenti. Gestito in Admin - Opzioni di default.");
define("_NO_GUEST_TIMEZONE_", "Non permettere agli utenti invitati (Guest) di cambiare il fuso orario.");
define("_NUMBER_SYMBOL_", '#');
define("_DISABLE_WYSIWYG_EDITOR_", "Disattiva l'editore WYSIWYG per le note degli eventi.");
define("_SHOW_CALENDAR_NAMES_", "Mostra il nome dei calendari degli eventi quando mostra i nomi delle categorie di eventi
	é selezionato nelle opzioni dell'utente.");
define("_MISC_", "Altro");
define("_THEME_POPUPS_", "Applica il tema nei popup delle note degli eventi.");

define("_PUBLIIC_", "Pubblico");
define("_REGISTERED_USERS_", "Utenti registrati");

define("_NEW_", "Nuovo");

define("_CATEGORY_EDIT_DESC_", "Per modificare una categoria, clicca sul suo titolo");

define("_ARE_YOU_SURE_DELETE_", "Sei sicuro di voler cancellare questo %s?");

########## END NEW TRANSLATIONS #################



################################
# EDIT / VIEW / POST CALENDARS
################################
define("_CALENDARS_", "Calendari");
define("_OWNER_", "Proprietario");
define("_ARE_YOU_SURE_DELETE_CALENDAR_", "Sei sicuro di voler cancellare questo calendario?");

define("_COLOR_BY_", "Colora gli eventi per");
define("_BY_OWNER_", "Proprietario dell'evento");
define("_BY_CATEGORY_", "Categoria dell'evento");
define("_BY_CALENDAR_", "Calendario");

define("_MODE_", "Modo");

define("_ALLOW_MULTI_CATS_", "Permetti diverse categorie per gli eventi");

define("_REMEMBER_LOCATIONS_", "Ricorda i luoghi");

define("_STRICT_EVENT_SECURITY_", "Sicurezza elevata degli eventi");
define("_STRICT_EVENT_SECURITY_DESC_", "Solo il proprietario dell'evento o gli amministratori del calendario possono modificare o cancellare gli eventi esistenti.");

define("_REMOTE_ACCESS_", "Accesso remoto");
define("_REMOTE_ACCESS_DESC_", "L'accesso remoto permette agli utenti di iscriversi a questo calendario a distanza
utilizzando un programma come Mozilla Sunbird, Windates o Apple iCal. Questo
attiverà anche la sindicazione RSS, leggibile con dei client RSS (RssReader, Shrook,...), 
da alcuni fornitori di contenuto (Yahoo!, MSN, ...) e da alcuni CMS (PHP-Nuke, Joomla!, ...).");

define("_ENABLE_REMOTE_ACCESS_UPD_", "Permetti gli aggiornamenti remoti. Questo permette ai membri autorizzati di
pubblicare gli aggiornamenti di questo calendario usando delle applicazioni esterne.");

define("_REMOTE_ACCESS_DESC_USERS_", "Se l'utente invitato (Guest User) non é un membro di questo calendario,
   la persona che desidera accedere a questo calendario deve utilizzare un login e una password. Una volta autentificata, 
   l'accesso sarà autorizzato o negato in base ai soui dati di configurazione.");

define("_SYNDICATION_", "Sindicazione");

define("_EDIT_EVENT_TYPES_", "Modifica le categorie");

define("_EVENT_TYPES_", "Categorie");

define("_EVENT_TYPES_DESC_", "

       Se nessun elemento é selezionato, verranno esportate tutte le categorie.<BR><BR>");

define("_MULTI_SELECT_WIN_","
       Windows: Per deselezionare un elemento o per selezionare diversi elementi non consecutivi,<br />
	   cliccare su <u>ctrl</u> durante la selezione.  ");

define("_REALLY_DELETE_EVENT_TYPE_", "Vuoi veramente cancellare la categoria?"); # question
define("_DELETE_ALL_IN_CATEGORY_", "Cancella tutti gli eventi in questa categoria.");

define("_VIEWS_NO_ACTION_", "Questa azione non può essere eseguita nell'area visione. Selezionare un calendario.");

define("_VIEW_INVALID_CAL_", "La vista corrente contiene un calendario di cui non sei membro. Gli eventi di questo calendario non saranno mostrati.");

define("_DESCRIPTION_", "Descrizione");
define("_DETAILS_", "dettagli");
define("_PUBLISH_", "inivia");
define("_PUBLISH_DESC_", "Pubblica questo calendario su un server remoto o un servizio come
<a class='". _CAL_CSS_BODY_ ." ". _CAL_CSS_ULINE_."' target=_blank
href='http://icalx.com'>iCal Exchange</a>");
define("_SERVER_RESPONSE_", "Risposta del server");



######################
# EMAIL EVENT
######################
define("_EMAIL_EVENT_", "E-Mail");
define("_EMAIL_TO_", "Per");
define("_SEND_EMAIL_", "Invia");
define("_SUBJECT_", "Oggetto");
define("_MESSAGE_", "Messaggio");
# e.g. The event has been sent to abcdefg@alphabet.com
define("_EMAIL_SENT_TO_", "L'evento é stato spedito a ");
define("_EMAIL_NO_ADDR_WARNING_", "Attenzione: non hai configurato un indirizzo e-mail
nella sezione delle opzioni dei contatti. Il tuo e-mail apparirà come provenente da
 ". @constant("_CAL_MAIL_FROM_"));

######################
# EMAIL SETTINGS
######################
define("_MAIL_PROG_PHP_", "Funzioni mail di PHP");
define("_MAIL_PROG_CMD_", "gestionario mail locale (sendmail, qmail, etc..)");
define("_MAIL_PROG_SERVER_", "Server SMTP");

define("_MAIL_PROGRAM_", "Spedisci un mail utilizzando");

define("_MAIL_FROM_EMAIL_", "E-mail proveniente da");

define("_MAIL_PATH_", "Cartella del gestionario locale");
define("_MAIL_AUTH_", "Autentificazione SMTP");

define("_MAIL_AUTH_USER_", "SMTP username");
define("_MAIL_AUTH_PASS_", "SMTP password");

define("_MAIL_SERVER_", "Server SMTP");
define("_MAIL_SERVER_PORT_", "Porta del server");

##########################
# ATTACHMENT SETTINGS
##########################
define("_ALLOW_ATTACHMENTS_", "Permetti l'aggiunta di allegati");
define("_ATTACHMENTS_PATH_", "Cartella degli allegati");

#############################
# GROUPS AND USERS
#############################
define("_USERS_", "Utente");
define("_GROUPS_", "Gruppi");
define("_EVERYONE_", "Tutti");
define("_SUPER_USER_", "SuperUtente");

define("_MEMBERS_", "Membri");
define("_MEMBERS_OF_", "membri di");

define("_NAME_", "Nome");
define("_EMAIL_", "E-Mail");

define("_ACCESS_LVL_", "Livello di accesso");
define("_ROLE_", "Ruolo");
define("_READ_ONLY_", "Visitatore");
define("_NORMAL_","Normale");

define("_ARE_YOU_SURE_DELETE_GROUP_", "Sei sicuro di voler cancellare questo gruppo?");
define("_GROUPS_SAVE_ATLEAST_1_MEMBER_", "I gruppi devono avere almeno un membro. Lista dei membri non salvata.");

# displayed as form field must begin with a character. E.g.
# Username must begin with a character.
define("_MUST_BEGIN_WITH_CHAR_", "deve cominciare con un carattere.");

######################
# REMINDERS
######################
define("_REMINDERS_", "Promemoria");
define("_BEFORE_EVENT_","prima di questo evento, alle");

define("_WILL_OCCUR_IN_", "avrà luogo tra"); # event x will occur in 30 minutes



###########################
# EVEVNT REQUESTS
############################
define("_REQUEST_", "Richiesta di evento");
define("_REQUESTS_", "Richieste di eventi");
define("_REQUEST_ACCEPTED_", "La tua richiesta di evento é stata accettata.");
define("_REQUEST_REJECTED_", "La tua richiesta di evento é stata rifiutata.");

define("_NOTIFY_REQUESTOR_", "Richiedente di notifica");
define("_REQUEST_HAS_NOTIFY_", "Il richiedente ha richiesto una notifica.");
define("_REQUESTS_NO_PENDING_", "Non ci sono richieste in attesa.");
define("_REQUEST_NOTIFY_EMAIL_", "ricordami delle richieste alle");
define("_REQUEST_MSG_PRE_", "Messaggio mostrato agli utenti prima di sottomettere la richiesta.");
define("_REQUEST_MSG_POST_", "Messaggio mostrato agli utenti dopo la sottomissione della richiesta.");
define("_REQUEST_NOTES_", "Note aggiuntive");
define("_REQUEST_NOTIFY_STATUS_", "Mostrami lo stato di questa richiesta alle");

define("_CONTACT_", "Contatto");

# You have a pending event request on calendar: CALENDAR TITLE
define("_PENDING_REQUEST_", "Hai una richiesta in attesa nel calendario:");


#################
# DATE  ITEMS
#################
define("_CALENDAR_", "Calendario");

define("_MONTH_", "Mese");
define("_MONTHS_", "Mese(i)");

define("_DAY_","Giorno");
define("_DAYS_", "Giorno(i)");

define("_YEAR_", "Anno");
define("_YEARS_", "Anni(i)");

define("_WEEK_", "Settimana");

# abreviated week
define("_WEEK_ABBR_", "Sett.");

define("_WEEKS_", "Settimana(e)");

define("_HOUR_", "Ora");
define("_HR_", "ora");
define("_HOURS_", "ore");
define("_HRS_", "ore");

define("_MINS_", "min.");
define("_MINUTES_", "minuti");

define("_DATE_", "Data");
define("_TIME_", "Ora");

define("_AM_", "am");
define("_AM_SHORT_", "am");
define("_PM_", "pm");
define("_PM_SHORT_", "pm");

# VIEWS
define("_TODAY_", "Oggi");
define("_THIS_WEEK_", "Questa settimana");
define("_THIS_MONTH_", "Questo mese");

##################
# MISC 
##################
define("_EVENT_", "Evento");
define("_EVENTS_", "Eventi");
define("_VIEW_", "Vista");

# VIEW AS A NOUN
define("_VIEW_NOUN_", "Mostra");

define("_PRINTABLE_VIEW_", "Anteprima di stampa");

define("_ALLDAY_", "Tutto il giorno");

define("_CAL_CALL_FOR_TIMES_", "Contattaci per fissare un orario");
define("_CAL_CALL_FOR_TIMES_MIN_", "(*)");

define("_TYPE_","Tipo");
define("_EVENT_TYPE_", "Categoria");

define("_WIDTH_", "Larghezza");

define("_COLORS_", "Colori");

# list seperator. Note space after comma
define("_LIST_SEP_",", ");

###########################
# ADMIN PAGE 
###########################
define("_GLOBAL_SETTINGS_", "Impostazioni del sito");
define("_EDIT_DEFAULT_OPTS_", "Opzioni di default");
define("_PASS_MUST_MATCH_", "La password inserita non corrisponde");
define("_EMPTY_PASSWORD_", "La password non sarà messa a \"\"!");
define("_ARE_YOU_SURE_DELETE_USER_", "Sei sicuro di voler cancellare l'utente?");
define("_DELETE_USERS_EVENTS_", "Cancella tutti gli eventi definiti da questo utente.");
define("_CALENDARS_OWNED_", "Calendari di questo utente");
define("_AUDIT_USERS_", "Controlla utenti");
define("_AUDIT_USERS_DESC_", "Utente trovato nella banca dati di Thyme, non avente nessuna corrispondenza 
nell'attuale modulo di autentificazione.<br>Tutti i dati dell'utente sono stati attribuiti all'uid dell'utente mancante.");

define("_CALENDAR_PUBLISHER_", "Pubblica Calendario");
define("_CAL_USER_GUEST_", "Account invitato (Guest)");
define("_CAL_PUBLISH_GUEST_DISABLED_", "Il pubblicatore di calendario non funziona se l'account invitato
é disattivato. Attiva questo conto nell'area Utenti.");


####################################
# GENERAL ACTIONS AND RESPONSES
####################################
define("_ADD_", "Aggiungi");
define("_NEW_EVENT_", "Nuovo envento");
define("_REMOVE_", "Elimina");
define("_UPDATE_", "Aggiorna");
define("_NEXT_", "Prossimo");
define("_PREV_", "Precedente");
define("_DELETE_", "Cancella");
define("_SAVE_", "Salva");
define("_TEST_", "Testa");
define("_UPDATE_NOW_", "Aggiorna ora");
define("_SAVE_ADD_", "Salva e aggiungine un altro");
define("_CANCEL_", "Annulla");
define("_BROWSE_", "percorrere");
define("_NONE_", "Nessuno");
define("_RESET_", "Reset");
define("_CLEAR_ALL_", "Cancella tutto");
define("_CHECK_ALL_", "Seleziona tutto");
define("_EDIT_", "Modifica");
define("_CLOSE_", "Chiudi");
define("_SHOW_", "Mostra");
define("_HIDE_", "Nascondi");
define("_ENABLE_", "Attiva");
define("_DISABLE_", "Disattiva");
define("_MOVE_", "Sposta");
define("_UP_", "Su");
define("_DOWN_", "Giu");
define("_ENABLED_", "Attivato");
define("_CONFIGURE_", "Configura");
define("_ACCEPT_", "Accetta");
define("_REJECT_", "Rifiuta");
define("_OK_", "OK");
define("_FAILED_", "Fallito");
define("_CHANGE_", "Cambia");
define("_SORT_BY_", "Ordina per");
define("_SEARCH_", "Cerca");
define("_FORCE_", "Forza");
define("_AUTODETECT_", "Trova automaticamente");
define("_RESET_PASS_", "Cambia password");
define("_NEW_PASS_", "Nuova password");
define("_RETYPE_", "Ripeti");
define("_UPDATED_", "Aggiornata");
define("_SUBMITTED_", "Inviata");
define("_LOGIN_", "Login");
define("_USERNAME_", "Username");
define("_PASSWORD_", "Password");
define("_LOGOUT_", "Logout");
define("_OPTIONS_", "Opzioni");
define("_ADMIN_", "Admin");
define("_BAD_PASS_", "Username o password sbagliati.");
define("_YES_", "Si");
define("_NO_", "No");
define("_VALUE_", "Valore");
define("_CUSTOM_", "Personalizzato");
define("_DEFAULT_", "Default");

######################
# ATTACHMENTS
######################
define("_ATTACHMENTS_", "Allegati");
define("_ATTACH_DETACH_", "Togli");
define("_ATTACH_DELETE_", "Cancella");
define("_ATTACHMENT_TOO_BIG_", "L'allegato supera la dimensione ammessa.");
define("_DOWNLOAD_ZIP_", "Scarica zip");
define("_UPDATE_ATTACHMENTS_", "Aggiorna gli allegati");

define("_BYTES_", "b");
define("_KBYTES_", "Kb");
define("_MBYTES_", "Mb");


#################
# EVENT LIST VIEW 
#################
define("_ALL_", "Tutti");
define("_UPCOMING_", "Prossimi");
define("_PAST_", "Scaduti");

define("_SHOWING_", "mostra");
define("_OF_", "di");
define("_FIRST_", "Primo");
define("_LAST_", "Ultimo");
define("_SHOW_TYPE_", "Categoria");

define("_LIST_SIZE_", "Lunghezza della lista");

define("_ARE_NO_EVENTS_", "Nessun evento da mostrare.");

define("_EVENTS_CONTAINING_", "L'evento contiene"); # used in event search

define("_ARE_YOU_SURE_DELETE_EVENTS_", "Sei sicuro di voler cancellare questo evento?");
define("_DELETE_REPEATING_WARNING_", "
   Hai deciso di cancellare uno o più eventi ripetuti.<br>
   Tutti gli elementi (passati e futuri) di questo evento saranno rimossi! ");

define("_UNCHECK_NO_DELETE_", "Deseleziona tutti gli eventi che non vuoi cancellare:");
define("_DELETE_CHECKED_", "Elementi selezionati cancellati");

define("_RETURN_", "Ritorna");
define("_ERROR_", "Errore!");

######################
# EVENT EDIT/ADD/VIEW
######################
define("_GENERAL_", "Generale");

define("_ORGANIZER_", "Organizzatore");

define("_URL_", "URL");

define("_REPEATING_", "Ripetizione");

define("_LOCATION_", "Luogo");

define("_APPLY_TO_", "Applica i cambiamenti a");
define("_ALL_DATES_", "tutte le date");
define("_THIS_DATE_", "solo a questa data");

define("_RESET_INSTANCE_", "Rimetti l'elemento al suo stato iniziale");

define("_MAP_", "Mappa");

define("_STARTED_", "iniziato");

# e.g. Overrides event Weekly Meeting on 2004-2-34
define("_OVERRIDE_EVNT_ON_", "Annulla l'evento %s il %s");

# e.g. Warning: the event Event Title has an invalid repeating rule
define("_INVALID_RRULE_", "Attenzione: l'evento %s ha una regola di ripetizione non valida.");

define("_MAX_CHARS_", "caratteri mass.");
define("_EVENT_INFO_", "Informazioni sull'evento");
define("_TITLE_", "Titolo");
define("_NOTES_", "Note");

define("_CHECK_FOR_CONFLICTS_", "controlla i conflitti");

define("_THIS_EVENT_ALLDAY_", "Questo evento occupa l'<b>intera giornata</b>.");
define("_STARTS_AT_", "Inizia alle");
define("_DURATION_", "Durata");

define("_FLAG_", "Etichetta");
define("_FLAG_THIS_", "Marca questo evento");
define("_IS_FLAGGED_", "questo evento é marcato");

# e.g. 10 days ago
define("_AGO_", "fa");

define("_REPEATING_NO_", "Questo evento non é ripetuto.");
define("_REPEATING_REPEAT_", "Ripeti");
define("_REPEATING_SELECTED_", "giorni selezionati");
define("_REPEATING_EVERY1_", "ogni");

define("_REPEAT_ON_", "Ripeti il");
define("_REPEAT_ON1_", "primo");
define("_REPEAT_ON2_", "secondo");
define("_REPEAT_ON3_", "terzo");
define("_REPEAT_ON4_", "quarto");
define("_REPEAT_ON5_", "quinto");
define("_REPEAT_ONL_", "ultimo");
define("_REPEAT_ON_OF_", "del mese, ogni");

define("_SIMPLE_", "Semplice");
define("_ADVANCED_","Avanzato");

define("_YEARLY_", "Annualmente");
define("_MONTHLY_", "Mensilmente");
define("_WEEKLY_", "Settimanalmente");
define("_DAILY_", "Giornalmente");
define("_EASTER_", "Pasqua");
define("_EASTER_YEARLY_", "In relazione a Pasqua");

define("_MONTH_DAYS_", "Mese(i) Giorno(i)");
define("_FROM_LAST_", "dall'ultimo");

define("_WEEKDAYS_", "Giorni");

define("_YEARLY_NOTES_", "Per default, il mese e il giorno sono presi dalla data di inizio, se non selezionati.");


define("_SPECIFIC_OCCURRENCES_", "Occorrenze specifiche");

define("_STARTING_ON_", "inizia il");

define("_BEFORE_", "Prima");
define("_AFTER_", "Dopo");

define("_EXCLUDE_DATES_", "Escludi date");

define("_CONFIRM_EVNT_RPT_CHANGE_", "Stai cambiando la regola o la data di ricorrenza di questo evento.\n
Tutte le eccezioni associate a questo evento ricorrente saranno perse. Sei sicuro di volerlo fare?\n");


define("_END_DATE_", "Data finale");
define("_END_DATE_NO_", "Nessuna data finale");
define("_END_DATE_UNTIL_", "Per ");
define("_END_DATE_AFTER_", "Dopo ");
define("_OCCURRENCES_", "occorrenze");

define("_ADDRESS_", "Indirizzo");
define("_ADDRESS_1_", "Via");
define("_ADDRESS_2_", "Città, NAP");

define("_PHONE_", "Telefono");
define("_ICON_", "Icona");

#####################
# MODULES
#####################
define("_NAVBAR_", "Barra di navigazione");
define("_MODULE_", "Modulo");
define("_MODULES_", "Moduli");
define("_TODAY_LINK_", "Oggi");
define("_MINI_CAL_", "Mini calendario");
define("_CALENDAR_LINKS_", "Link al calendario");
define("_IMAGE_BROWSER_", "Vedi immagini");
define("_QUICK_ADD_EVNT_", "Aggiungi rapidamente evento");
define("_GOTO_DATE_", "Vai alla data");
define("_SEARCH_EVENTS_", "Cerca eventi");
define("_EVENT_FILTER_", "Categoria");
define("_COLOR_LEGEND_", "Legenda");

##################
# SYNC 
##################

define("_SYNC_", "Sincronizza");
define("_IMPORT_", "Importa");
define("_EXPORT_", "Esporta");
define("_IMPORT_FROM_", "Importa da");
define("_EXPORT_TO_", "Esporta verso");
define("_SYNC_DUPLICATES_", "Se dei duplicati sono trovati");
define("_IGNORE_DUPLICATES_", "Ignora i duplicati");
define("_OVERWRITE_EXISTING_EVENT_", "Sovrascrivi gli eventi esistenti");
define("_CREATE_NEW_EVENT_", "Crea un nuovo evento");
define("_IMPORT_AS_", "Importa nella categoria");
define("_EVENTS_IMPORTED_", "Evento importato");
define("_SYNC_IMPORT_ERROR_", "Errore: si é verificato un errore nella lettura del file che stavi importando.");
define("_HTML_", "HTML");
define("_PLAINTEXT_", "Testo");
define("_ICAL_", "iCalendar (.ics)");
define("_QUIRKS_MODE_", "Modo capriccioso");
define("_PERMISSION_DENIED_", "Accesso vietato: non sei il proprietario di questo evento o un amministratore del calendario.");
define("_FULL_SYNC_", "Sincronizzazione completa");
define("_FULL_SYNC_DESC_", "Cancella gli eventi esistenti in Thyme che non esistono nel file importato.");

#########################
# CSS AND STYLE
#########################
define("_COLOR_", "Colore");

define("_STYLE_", "Stile");

define("_PREVIEW_", "Anteprima");
define("_SAMPLE_", "Estratto");

define("_BACKGROUND_COLOR_", "Colore di fondo");
define("_FONT_COLOR_", "Colore del carattere");
define("_FONT_SIZE_", "Taglia del carattere");

define("_FONT_STYLE_", "Stile di carattere");
define("_BOLD_", "grassetto");
define("_ITALICS_", "italico");
define("_UNDERLINE_", "sottolineato");

define("_FONT_FAMILY_", "Famiglia di caratteri");
define("_FONT_FAMILY_DESC_", "Per es.. Tahoma, 'Sans Serif', Arial");

define("_UNDERLINE_LINKS_", "Sottolinea i link");
define("_NEVER_", "Mai");
define("_ALWAYS_", "Sempre");
define("_HOVER_", "Al passaggio");
define("_BORDER_COLOR_", "Colore del bordo");
define("_TIME_FONT_COLOR_", "Colore del carattere times");
define("_TITLE_FONT_COLOR_", "Colore del titolo");
define("_TITLE_FONT_STYLE_", "Stile del titolo");

#########################
# CALENDAR PUBLISHER
#########################
if(@constant("_CAL_DOING_PUBLISHER_")) { # <- leave this line alone

define("_MINI_MONTH_", "Mini mese");

define("_SET_DATE_CURRENT_", "metti alla data corrente");
define("_EDITABLE_", "Editabile");
define("_STATIC_", "Statico");
define("_STATIC_DESC_", "il contenuto del calendario non contiene link per cambiare la data o la vista");
define("_HIL_DAY_", "Evidenzia il giorno");
define("_HIL_WEEK_", "Evidenzia la settimana");

define("_APPLY_CSS_FROM_", "Applica lo stile da");
define("_NO_CSS_", "nessuno");
define("_CSS_EDITOR_", "Editor di stile");

define("_LANGUAGE_", "Lingua");
define("_EURO_DATE_", "Stile delle date europeo");
define("_EURO_DATE_DESC_", "Le date sono mostrate nel formato gg/mm/aaaa quando possibile");

define("_HEADER_", "Titolo");
define("_WEEKDAY_HEADER_", "Titolo dei giorni della settimana");

define("_NORMAL_DAYS_", "Giorni normali");
define("_DAYS_NOT_IN_MONTH_", "Gironi fuori mese");
define("_HIGHLIGHTED_DAYS_", "Giorni evidenziati");

define("_NORMAL_EVENTS_", "Eventi normali");
define("_FLAGGED_EVENTS_", "Eventi marcati");

define("_SHOW_EVENTS_", "Mostra eventi");


define("_EVENT_LINKS_", "Link dell'evento");

define("_EVENT_LINK_URL_", "URL del link all'evento");

define("_EVENT_LINK_URL_DESC_", "

        Questo indirizzo riceverà una richiesta contenente un
        <font class='"._CAL_CSS_HIL_."'>eid</font> e un'<font class='"._CAL_CSS_HIL_."'>istanza</font>.<br>

        <b>eid</b> é l'ID dell'evento e <b>istanza</b> é la data in formato
        <b>AAAA-MM-GG</b>.<br>Sono marcati con <font class='"._CAL_CSS_HIL_."'>%eid</font>
        and <font class='"._CAL_CSS_HIL_."'>%inst</font>.<br><br>

        Per es. http://mysite.com/sales/view_sale.php?eid=%eid&instance=%inst may yield:<br>

        http://mysite.com/sales/view_sale.php?<font
		class='"._CAL_CSS_HIL_."'>eid</font>=56&<font
		class='"._CAL_CSS_HIL_."'>instance</font>=2005-10-26<br><br>
 
        Consulta il manuale di referenza e/o il tutorial sul sito di Thyme per maggiori 
		informazioni sull'utilizzo di questi link.");


define("_SHOW_HEADER_", "Mostra titolo");
define("_ALIGN_HEADER_TEXT_", "Allinea il testo del titolo");
define("_CENTER_", "Centro");
define("_HEADER_TEXT_", "Testo del titolo");

define("_HEADER_TEXT_DESC_","

   (Per es. <font class='"._CAL_CSS_HIL_."'>Compleanni nel mese (%month)</font>)<br>
        <font size=1><i>Lasciare in bianco per usare il titolo di default. 
		Altre variabili disponibili: giorni (%weekday), giorno-mese (%mday), mese (%mon) e anno (%year).</i></font> ");


define("_SHOW_HEADER_LINKS_", "Mostra link nel titolo");

define("_NEXT_LINK_", "'Prossimo' link");
define("_PREV_LINK_", "Link 'precedente'");

define("_IMG_URL_", "URL dell'immagine");

define("_HEADER_LINKS_", "Links del titolo");

define("_IMG_URL_DESC_", "
        Qui si può mettere del testo come '<<' o un link verso un'immagine<br>
		(Per es. <font
        class='"._CAL_CSS_HIL_."'>http://www.myserver.com/images/next.gif</font>)<br><font
        size=1><i>Lasciare in bianco per usare l'immagine di default del tema selezionato.</i></font> ");


define("_DAY_VIEW_", "Vista del giorno");

define("_MONTH_VIEWS_", "Vista mensile");

define("_SHOW_WEEKS_DESC_", "Nota: il calendario del mini mese non mostra i numeri delle settimane");

define("_ROW_HEIGHT_", "Altezza della riga");
define("_ROW_HEIGHT_DESC_", "Il default é di '90' per il mese, '0' per il mini mese");

define("_LIMIT_WEEKDAY_NAMES_", "Limita il nome dei giorni della settimana a");
define("_CHARS_", "caratteri");

define("_EXCLUDE_MONTH_DAYS_", "Escludi i giorni fuori dal mese");

define("_MINI_MONTH_DATE_URL_", "URL della data del mini mese");

define("_MINI_MONTH_DATE_URL_DESC_", "
		Rappresenta il link che accede al giorno del mini mese corrispondente.
        Sostituisce le scritte seguenti:<br>

        %d = il numero del giorno<br>
        %m = il numero del mese<br>
        %y = il numero dell'anno<br>

        <br><br>

        Per es. http://www.myserver.com/page.php?day=%d&month=%m&year=%y<br>
        può diventare
        <font class='"._CAL_CSS_HIL_."'>http://www.myserver.com/page.php?day=23&month=11&year=2004</font>

        <br>é inoltre possibile usare una funzione JavaScript.<br>

        Per es. <font class='"._CAL_CSS_HIL_."'>javascript:myFunction(%y,%m,%d)</font><br><br>

        Il risultato é un link verso la pagina corrente che contiene le variabili seguenti:<br>
        m = %m<br>
        d = %d<br>
        y = %y<br>

        Per es. <font class='"._CAL_CSS_HIL_."'>index.php?d=23&m=11&y=2004</font><br><br>
        Consultare il manuale di referenza e/o il tutorial sul sito di Thyme per ulteriori informazioni.");


define("_GENERATED_CODE_", "Codice generato");

define("_BASE_PATH_DESC_", "percorso di installazione di thyme, con '/' alla fine");
define("_BASE_URL_DESC_", "url di base di thyme, con '/' alla fine");

} # </ CALENDAR PUBLISHER SECTION > <- leave this line alone


######################
#
### RSS FEED MODULES
#
#####################
define("_RSS_FEED_MODULES_", "Modulo dei flussi RSS");
define("_RSS_", "Flussi RSS");
define("_UPDATE_INTERVAL_", "Intervallo di aggiornamento");
define("_ARE_YOU_SURE_DELETE_RSSMOD_", "Sei sicuro di voler cancellare questo modulo RSS?");
define("_AUTHOR_", "Autore");

# scrolling
define("_SCROLLING_","Scorrimento");
define("_OVERFLOW_", "Superamento della capacità");
define("_SCROLLBAR_", "Barra di scorrimento");
define("_AUTOSCROLL_", "Scorrimento automatico");


# this will keep us from needing to
# have these defined when not looking
# at options
#####################################
if(@constant("_CAL_DOING_OPTS_")) { # <- leave this line alone

######################
# OPTION STRINGS
######################

define("_DEFAULT_VIEW_", "Vista di defalut");

define("_DEFAULT_CALENDAR_", "Calendario di default");

define("_TIME_INTERVALS_", "Intervalli di tempo");

define("_EVNT_SIZE_", "Dimensione dell'evento");
define("_SMALLER_", "Più piccolo");
define("_SMALLEST_", "Il più piccolo possibile");
define("_EVNT_COLLAPSE_", "Raggruppa eventi (Vista del mese)");
define("_EVNT_COLLAPSE_DESC_", "Raggruppa i titoli lunghi degli eventi.");
define("_EVNT_TYPE_NAME_", "Mostra i nomi delle categorie di eventi");
define("_EVNT_POPUP_", "Evento popup");
define("_EVNT_POPUP_DESC_", "Mostra gli eventi in una nuova finestra.");
define("_EVNT_NOTES_POPUP_", "Popup delle note dell'evento");
define("_EVNT_NOTES_POPUP_DESC_", "Scorri il mouse su un evento per vedere le note associate.");

define("_POSITION_", "Posizione");

define("_SHOW_WEEKS_", "Mostra il numero delle settimane");

define("_WEEK_START_", "inizio della settimana");
define("_WORK_HOURS_", "Ore lavorative");
define("_WORK_HOURS_START_", "inizia alle");
define("_WORK_HOURS_END_", "finisce alle");

define("_HOUR_FORMAT_", "Formato delle ore");
define("_HOUR_FORMAT_12_", "12 ore");
define("_HOUR_FORMAT_24_", "24 ore");

define("_NAV_BAR_LOC_", "Barra di navigazione");
define("_RIGHT_", "Destra");
define("_LEFT_", "Sinistra");

define("_TIMEZONE_", "Fuso orario");
define("_DST_", "Ora legale");
define("_STARTS_", "Inizia");
define("_ENDS_", "Finisce");

define("_IN_", "di");
define("_ON_", "ON");
define("_OFF_", "OFF");

define("_THEME_", "Tema");

##########################
# CONTACT OPTIONS
##########################
define("_CONTACT_OPTS_", "Opzioni dei contatti");
define("_PRIMARY_", "Principale");
define("_FORMAT_", "Formato");

##########################
# SUBSCRIPTIONS
##########################
define("_SUBSCRIPTIONS_", "Iscrizione");
define("_SUBSCRIPTIONS_DESC_", "iscrizioni per e-mail ai calendari.");

######################
# NOTIFICATIONS
#####################
define("_NOTIFICATIONS_", "Notifiche");
define("_NOTIFICATIONS_DESC_", "Filtri delle notifiche per eventi nuovi e aggiornati.");

define("_TITLE_CONTAINS_", "Il titolo contiene");
# event X has been updated on calendar Y
define("_UPDATED_ON_", "é stato aggiornato sul ");
# event X has been added to calendar Y
define("_ADDED_TO_", "é stato aggiunto al ");

#####################
# DST STRINGS
#####################
define("_DST_OPTS1_", "Africa / Egitto");
define("_DST_OPTS2_", "Africa / Namibia");
define("_DST_OPTS3_", "Asia / USSR (ex) - la maggior parte degli stati");
define("_DST_OPTS4_", "Asia / Iraq");
define("_DST_OPTS5_", "Asia / Libano, Kirgizstan");
define("_DST_OPTS6_", "Asia / Siria");
define("_DST_OPTS7_", "Australasia / Australia, Nuovo Galles");
define("_DST_OPTS8_", "Australasia / Australia - Tasmania");
define("_DST_OPTS9_", "Australasia / Nuova Zelanda, Chatham");
define("_DST_OPTS10_", "Australasia / Tonga");
define("_DST_OPTS11_", "Europa / Unione Europea, Regno Unito, Groenlandia");
define("_DST_OPTS12_", "Europa / Russia");
define("_DST_OPTS13_", "Nord America / Stati Uniti, Canada, Messico");
define("_DST_OPTS14_", "Nord America / Cuba");
define("_DST_OPTS15_", "Sud America / Cile");
define("_DST_OPTS16_", "Sud America / Paraguay");
define("_DST_OPTS17_", "Sud America / Falklands");

####################
# TIMEZONE STRINGS
####################
define("_GMT_PLUS_0.0_","GMT +00:00 Gran Bretagna, Irlanda, Portogallo, Africa Occidentale ");
define("_GMT_PLUS_0.5_","GMT +00:30 ");
define("_GMT_PLUS_1.0_","GMT +01:00 Europa Occidentale, Africa Centrale");
define("_GMT_PLUS_1.5_","GMT +01:30 ");
define("_GMT_PLUS_2.0_","GMT +02:00 Europa dell'Est, Africa Orientale");
define("_GMT_PLUS_2.5_","GMT +02:30 ");
define("_GMT_PLUS_3.0_","GMT +03:00 Russia, Arabia Saudita");
define("_GMT_PLUS_3.5_","GMT +03:30 ");
define("_GMT_PLUS_4.0_","GMT +04:00 Arabia");
define("_GMT_PLUS_4.5_","GMT +04:30 ");
define("_GMT_PLUS_5.0_","GMT +05:00 Asia Occidentale, Pakistan");
define("_GMT_PLUS_5.5_","GMT +05:30 India");
define("_GMT_PLUS_6.0_","GMT +06:00 Asia Centrale");
define("_GMT_PLUS_6.5_","GMT +06:30 ");
define("_GMT_PLUS_7.0_","GMT +07:00 Bangkok, Hanoi, Giacarta");
define("_GMT_PLUS_7.5_","GMT +07:30 ");
define("_GMT_PLUS_8.0_","GMT +08:00 Cina, Singapore, Taiwan");
define("_GMT_PLUS_8.5_","GMT +08:30 ");
define("_GMT_PLUS_9.0_","GMT +09:00 Corea, Giappone");
define("_GMT_PLUS_9.5_","GMT +09:30 Australia Centrale");
define("_GMT_PLUS_10.0_","GMT +10:00 Australia Orientale");
define("_GMT_PLUS_10.5_","GMT +10:30 ");
define("_GMT_PLUS_11.0_","GMT +11:00 Pacifico Centrale");
define("_GMT_PLUS_11.5_","GMT +11:30 ");
define("_GMT_PLUS_12.0_","GMT +12:00 Fiji, Nuova Zelanda");
define("_GMT_MINUS_12.0_","GMT -12:00 Linea del cambiamento del fuso orario");
define("_GMT_MINUS_11.5_","GMT -11:30 ");
define("_GMT_MINUS_11.0_","GMT -11:00 Samoa");
define("_GMT_MINUS_10.5_","GMT -10:30 ");
define("_GMT_MINUS_10.0_","GMT -10:00 Hawai");
define("_GMT_MINUS_9.5_","GMT -09:30 ");
define("_GMT_MINUS_9.0_","GMT -09:00 Alasca/Pitcairn Islands");
define("_GMT_MINUS_8.5_","GMT -08:30 ");
define("_GMT_MINUS_8.0_","GMT -08:00 US/Canada/Pacifico");
define("_GMT_MINUS_7.5_","GMT -07:30 ");
define("_GMT_MINUS_7.0_","GMT -07:00 US/Canada/Montagne");
define("_GMT_MINUS_6.5_","GMT -06:30 ");
define("_GMT_MINUS_6.0_","GMT -06:00 US/Canada/Centrali");
define("_GMT_MINUS_5.5_","GMT -05:30 ");
define("_GMT_MINUS_5.0_","GMT -05:00 US/Canada/Orientali, Colombia, Peru");
define("_GMT_MINUS_4.5_","GMT -04:30 ");
define("_GMT_MINUS_4.0_","GMT -04:00 Bolivia, Brasile Occidentale, Cile, Atlantico");
define("_GMT_MINUS_3.5_","GMT -03:30 Terranova");
define("_GMT_MINUS_3.0_","GMT -03:00 Argentina, Brasile Orientale, Groenlandia");
define("_GMT_MINUS_2.5_","GMT -02:30 ");
define("_GMT_MINUS_2.0_","GMT -02:00 Centro Atlantico");
define("_GMT_MINUS_1.5_","GMT -01:30 ");
define("_GMT_MINUS_1.0_","GMT -01:00 Azorre/Atlantico Orientale");
define("_GMT_MINUS_0.5_","GMT -00:30 ");

}

##########################
# ERRORS AND WARNINGS
##########################
define("_WARNING_ATTACH_", "Attenzione: la cartella degli allegati %s non esiste o non é accessibile in scrittura.");
define("_WARNING_RSS_", "Attenzione: la cartella dei flussi RSS %s non é accessibile in scrittura.");
define("_WARNING_INSTALL_", "Attenzione: %s esite ancora. Cancella manualmente questo file.");
define("_WARNING_LICENSE_", "Atttenzione: la licenza di Thyme scadrà tra %s giorni.");


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
  "Domenica",
  "Lunedì",
  "Martedì",
  "Mercoledì",
  "Giovedì",
  "Venerdì",
  "Sabato");

$_cal_months or $_cal_months = array(1 => 
  "Gennaio",
  "Febbraio",
  "Marzo",
  "Aprile",
  "Maggio",
  "Giugno",
  "Luglio",
  "Agosto",
  "Settembre",
  "Ottobre",
  "Novembre",
  "Dicembre");


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
