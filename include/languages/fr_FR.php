<?php
###########################################
# Translated by Nicolas Borboën
# Nicolas dot Borboen at epfl dot ch
# Version: 1.0
# Created date: 01/13/2006
# Last update: 01/16/2006
# Modified by Nicolas Borboën
###########################################
#
# With this set to 1, Nov 2nd 2004 would look
# like 2/11/2004 where applicable. With it
# set to 0, it would look like 11/2/2004.
#
# all date selects are also affected by this
# as they will be day-month-year
#
###########################################
define("_CAL_EURO_DATE_", 1);

define("_CHARSET_", "iso-8859-1");

define("_LANG_NAME_", "Français (FR)");

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
define("_GLOBAL_VIEWS_", "Vues Globales");

define("_ALLOW_EVERYONE_VIEW_", "Autoriser tout le monde à voir tous les calendriers de cette vue, sans tenir compte de la liste de membres");

define("_HIDE_VIEW_FROM_GUESTS_", "Cacher cette vue aux utilisateurs invités");

define("_REQUEST_NOTIFY_OWNER_", "Notifier le propriétaire du calendrier de la requête ouverte");

define("_ALL_CALENDARS_", "Vue de tous les calendriers");

#################################
#
### INSTALLER 
#
#################################

# some of these will not be used until 2.0
define("_INSTALLER_", "Installeur");
define("_PACKAGE_", "Paquet");
define("_INSTALL_", "Installer");
define("_INVALID_PACKAGE_", "Le fichier que vous avez uploadé n'est pas un élément Thyme valide.");
define("_INSTALLED_MODULES_", "Modules Installés");
define("_UNINSTALL_", "Désinstaller");
define("_LOCAL_FILE_","Fichier local");
define("_UPDATES_", "Mises à jour");
define("_AVAILABLE_UPDATES_", "Mises à jour disponible");
define("_CHECK_FOR_UPDATES_", "Vérifier les mises à jour");
define("_LAST_CHECKED_ON_", "Dérnière vérification le"); # e.g. last checked on 1/2/2007
define("_FILE_", "Fichier");
define("_WRITABLE_", "Editable");
define("_REFRESH_", "Rafraichir");
define("_INVALID_DOWNLOAD_", "Download invalide. Impossible de mettre à jour le fichier.");
define("_UNABLE_TO_BACKUP_", "Impossible de sauvegarder le fichier courant.");
define("_UPDATES_AVAIL_", "%s mises à jour disponible"); # %s will be replaced w/# of updates available

############################
#
### NEW USER DEFINITIONS
#
###########################
define("_REGISTERED_USERS_", "Registered users");
define("_PUBLIC_", "Public");
define("_PUBLIC_ACCESS_", "Public Access");

#############################
#
### MULTIPLE REMINDERS
#
#############################
define("_BEFORE_EVENT_MULTI_", "avant cet événement");
define("_USER_CAN_NOT_VIEW_", "%s n'a pas les droits pour voir ce calendrier.");
define("_ALLOW_CONFIGURE_REMINDERS_", "Autoriser %s à configurer les rappels d'événements pour tous les utilisateurs.");
define("_CALENDAR_ADMINS_", "Administrateurs du calendrier");
define("_EVENT_OWNER_", "Propriétaire de l'événement");
define("_SITE_ADMINS_", "Administrateur du site");
define("_NO_ONE_", "Personne");

###############################
#
## CONFIGURABLE JOB INTERVALS
#
###############################

define("_REMIND_AT_LEAST_", "Au moins");
define("_SCHEDULED_TASK_", "Tâche planifiée");
define("_NO_SCHEDULED_TASK_", "La tâche planifiée Thyme n'est pas configurée pour fonctionner");
define("_SCHEDULED_TASK_CONFIGURED_", "La tâche planifiée Thyme est configurée pour fonctionner tous les");
define("_PHP_CLI_", "PHP CLI location");

###################################
#
### CUSTOMIZE SITE
#
###################################
define("_CUSTOMIZE_SITE_", "Personnaliser le site");
define("_SITE_NAME_", "Nom du site");
define("_SITE_THEME_", "Thème du site");
define("_SITE_THEME_DESC_", "Aucun paramètres autorisent les utilisateurs à choisir leur propre thème");

# use exact HTML tags, they will be displayed correctly
# when printed
define("_SITE_HEADER_", "En-tête du site");
define("_SITE_HEADER_DESC_", "Après le tag <body>");

define("_SITE_FOOTER_", "Pied de page du site");
define("_SITE_FOOTER_DESC_", "Avant le tag </body>");

define("_SITE_HEAD_", "Tête du site (head)");
define("_SITE_HEAD_DESC_", "Entre les tags <head> et </head>.");


####################################
#
### LICENSE KEY
#
####################################
define("_ENTER_LICENSE_KEY_", "Entrer une clé de licence");
define("_LICENSE_KEY_", "Clé de licence");
define("_LICENSE_KEY_ACCEPTED_", "Clé de licence acceptée");
define("_INVALID_LICENSE_KEY_", "La clé de licence que vous avez entrée n'est pas valide pour ce site");

####################################
#
### EVENT REQUEST DESCRIPTION
#
####################################
define("_REQUEST_MODE_VIEW_ONLY_", "Les utilisateurs ayant uniquement le droit de lecture peuvent soumettre des demandes d'événements. Les utilisateurs commun peuvent ajouter des événements directement.");
define("_REQUEST_MODE_NORMAL_", "Les utilisateurs ayant uniquement le droit de lecture ne peuvent pas soumettre des demandes d'événements (droit lecture seulement). Les utilisateurs commun peuvent soumettre des demandes d'événements.");

#####################################
#
### TELL A FRIEND FOR GUEST E-MAILS
#
######################################
define("_TELL_A_FRIEND_", "Partager avec un ami");

define("_YOUR_NAME_", "Votre nom");
define("_YOUR_EMAIL_", "Votre e-mail");

define("_YOUR_FRIENDS_NAME_","Le nom de votre ami");
define("_YOUR_FRIENDS_EMAIL_","L'e-mail de votre ami");

define("_EMAIL_EVENT_DISPLAYED_","L'événement va être affiché sous le message.");

define("_ALLOW_GUEST_USERS_EMAIL_", "Autoriser les utilisateurs invités aux événements email.");

define("_DISABLE_SITE_ADDR_BOOK_", "Désactiver le carnet d'adresse pour les non-administrateurs");

define("_EMAIL_TO_MULTIPLE_", "Séparer les adresses multiples avec une virgule.");

# MISC
########
define("_HELP_", "Aide");
define("_WARNING_DIR_NOT_WRITABLE_", "Attention: le répertoire %s n'est pas inscriptible.");
define("_WARNING_FILE_NOT_WRITABLE_", "Attention: le fichier %s n'est pas inscriptible.");
define("_DOWNLOAD_", "Download");
define("_HIDE_QUICK_ADD_", "Cacher la boîte d'ajout d'événement rapide");
define("_FORCE_DEFAULT_OPTS_", "Forcer les options par défaut pour tous les utilisateurs. Défini dans les options par défaut de l'administration.");
define("_NO_GUEST_TIMEZONE_", "Ne pas autoriser les invités à changer la zone temporelle.");
define("_NUMBER_SYMBOL_", '#');
define("_DISABLE_WYSIWYG_EDITOR_", "Désactiver l'éditeur WYSIWYG pour les notes d'événements.");
define("_SHOW_CALENDAR_NAMES_", "Montrer le nom du calendrier d'événement lorsque l'affichage de nom de catégorie est défini dans les options de l'utilisateur.");
define("_MISC_", "Divers");
define("_THEME_POPUPS_", "Appliquer ce thèmes aux notes d'événements popup.");

define("_PUBLIIC_", "Publique");
define("_REGISTERED_USERS_", "Utilisateurs enregistrés");

define("_NEW_", "Nouveau");

define("_CATEGORY_EDIT_DESC_", "Pour éditer une catégorie, cliquer sur son titre");

define("_ARE_YOU_SURE_DELETE_", "Êtes vous sûr de vouloir effacer %s?");

########## END NEW TRANSLATIONS #################

################################
# EDIT / VIEW / POST CALENDARS
################################
define("_CALENDARS_", "Calendriers");
define("_OWNER_", "Propriétaire");
define("_ARE_YOU_SURE_DELETE_CALENDAR_", "Êtes vous sûr de vouloir effacer ce calendrier?");

define("_COLOR_BY_", "Colorer les événements par");
define("_BY_OWNER_", "Propriétaire de l'événement");
define("_BY_CATEGORY_", "Catégorie de l'événement");
define("_BY_CALENDAR_", "Calendrier");

define("_MODE_", "Mode");

define("_ALLOW_MULTI_CATS_", "Autoriser les catégories multiples pour un événement");

define("_REMEMBER_LOCATIONS_", "Se souvenir des emplacements");

define("_STRICT_EVENT_SECURITY_", "Sécurité d'événement stricte");
define("_STRICT_EVENT_SECURITY_DESC_", "Seulement le propriétaire de l'événement ou les administrateurs peuvent modifier ou supprimer les événements existants.");

define("_REMOTE_ACCESS_", "Accès distant");
define("_REMOTE_ACCESS_DESC_", "L'accès distant permet aux utilisateurs de s'abonner à ce calendrier
    en utilisant à distance un programme comme Mozilla Sunbird, Windates, ou iCal. Cela active également 
    la syndication RSS, qui peut être vue par les lecteurs de RSS (RssReader, Mozilla ThunderBird...)
    ou par des systèmes de gestion de contenu (CMS) comme Joomla! ou PHP-Nuke.");

define("_ENABLE_REMOTE_ACCESS_UPD_", "Activer les mises à jour à distance. Cela autorise les membres à publier
    des mises à jour pour ce calendrier en utilisant des applications externes.");

define("_REMOTE_ACCESS_DESC_USERS_", "Si les utilisateurs invités (anonymes) ne sont pas autorisés,
    une authentification sera nécessaire. En fonction du résultats et de la configuration du calendrier,
    l'accès sera autorisé ou non.");

define("_SYNDICATION_", "Syndication");

define("_EDIT_EVENT_TYPES_", "Édition des catégories");

define("_EVENT_TYPES_", "Catégories");

define("_EVENT_TYPES_DESC_", "

       Désélectionner tous les messages pour utiliser toutes les catégories.<BR><BR>");

define("_MULTI_SELECT_WIN_","
       Windows: Pour désélectionner une seule entrée ou pour faire une<br>sélection multiple presser la touche <u>ctrl</u> pendant la sélection. ");

define("_REALLY_DELETE_EVENT_TYPE_", "Vraiment effacer la catégorie?"); # question
define("_DELETE_ALL_IN_CATEGORY_", "effacer tous les événements de cette catégorie.");

define("_VIEWS_NO_ACTION_", "Cette action ne peut pas être effectuée sur une Vue. Merci de sélectionner un calendrier.");

define("_VIEW_INVALID_CAL_", "la vue courante contient un calendrier pour lequel vous n'êtes pas membre.
    Les événements de ce calendrier ne seront pas affichés.");

define("_DESCRIPTION_", "Description");
define("_DETAILS_", "détails");
define("_PUBLISH_", "envoyer");
define("_PUBLISH_DESC_", "Publier ce calendrier dans un serveur distant ou dans un service tel que
<a class='". _CAL_CSS_BODY_ ." ". _CAL_CSS_ULINE_."' target=_blank
href='http://icalx.com'>iCal Exchange</a>");
define("_SERVER_RESPONSE_", "Réponse du Serveur");



######################
# EMAIL EVENT
######################
define("_EMAIL_EVENT_", "E-Mail");
define("_EMAIL_TO_", "À");
define("_SEND_EMAIL_", "Envoyer");
define("_SUBJECT_", "Sujet");
define("_MESSAGE_", "Message");
# e.g. The event has been sent to abcdefg@alphabet.com
define("_EMAIL_SENT_TO_", "L'événement a été envoyé à ");
define("_EMAIL_NO_ADDR_WARNING_", "Attention: vous n'avez pas configuré d'e-mail dans la section options des contacts.
    Votre email apparaitera comme étant envoyé de  ". @constant("_CAL_MAIL_FROM_"));

######################
# EMAIL SETTINGS
######################
define("_MAIL_PROG_PHP_", "Fonctions mail de PHP");
define("_MAIL_PROG_CMD_", "Local mailer (sendmail, qmail, etc..)");
define("_MAIL_PROG_SERVER_", "Serveur SMTP");

define("_MAIL_PROGRAM_", "Envoyer les e-mails en utilisant");

define("_MAIL_FROM_EMAIL_", "E-mail de provenance");

define("_MAIL_PATH_", "Chemin local du mailer");
define("_MAIL_AUTH_", "Authentification SMTP");

define("_MAIL_AUTH_USER_", "Nom d'utilisateur SMTP");
define("_MAIL_AUTH_PASS_", "Mot de passe SMTP");

define("_MAIL_SERVER_", "Serveur SMTP");
define("_MAIL_SERVER_PORT_", "Port du Serveur");

##########################
# ATTACHMENT SETTINGS
##########################
define("_ALLOW_ATTACHMENTS_", "Autoriser les pièces jointes");
define("_ATTACHMENTS_PATH_", "Chemin des pièces jointes");

#############################
# GROUPS AND USERS
#############################
define("_USERS_", "Utilisateurs");
define("_GROUPS_", "Groupes");
define("_EVERYONE_", "Tout le monde");
define("_SUPER_USER_", "Super Utilisateur");

define("_MEMBERS_", "Membres");
define("_MEMBERS_OF_", "Membres de");

define("_NAME_", "Nom");
define("_EMAIL_", "E-Mail");

define("_ACCESS_LVL_", "Niveau d'accès");
define("_ROLE_", "Rôle");
define("_READ_ONLY_", "Vue limitée à");
define("_NORMAL_","Normal");

define("_ARE_YOU_SURE_DELETE_GROUP_", "Êtes-vous sûr de vouloir effacer ce groupe?");
define("_GROUPS_SAVE_ATLEAST_1_MEMBER_", "Les groupes doivent posséder au moins un membre. La liste des membres n'a pas été enregistrée.");

# displayed as form field must begin with a character. E.g.
# Username must begin with a character.
define("_MUST_BEGIN_WITH_CHAR_", "doit commencer par une lettre.");

######################
# REMINDERS
######################
define("_REMINDERS_", "Rappels");
define("_BEFORE_EVENT_","avant cet événement, à");

define("_WILL_OCCUR_IN_", "arrivera dans"); # event x will occur in 30 minutes



###########################
# EVEVNT REQUESTS
############################
define("_REQUEST_", "Demande d'événement");
define("_REQUESTS_", "Demandes d'événements");
define("_REQUEST_ACCEPTED_", "Votre demande a été retenue.");
define("_REQUEST_REJECTED_", "Votre demande a été refusée.");

define("_NOTIFY_REQUESTOR_", "Notify Requestor");
define("_REQUEST_HAS_NOTIFY_", "The requestor had requested notification.");
define("_REQUESTS_NO_PENDING_", "Il n'y a aucune requête en attente.");
define("_REQUEST_NOTIFY_EMAIL_", "avertissez moi des demandes en suspens à");
define("_REQUEST_MSG_PRE_", "Le message montré aux utilisateurs avant la demande:");
define("_REQUEST_MSG_POST_", "Le message montré aux utilisateurs après la demande:");
define("_REQUEST_NOTES_", "Message supplémentaire");
define("_REQUEST_NOTIFY_STATUS_", "avertissez moi des statuts de ces demandes à");

define("_CONTACT_", "Contact");

# You have a pending event request on calendar: CALENDAR TITLE
define("_PENDING_REQUEST_", "Vous avez une demande en suspens pour le calendrier:");


#################
# DATE  ITEMS
#################
define("_CALENDAR_", "Calendrier");

define("_MONTH_", "Mois");
define("_MONTHS_", "Mois");

define("_DAY_","Jour");
define("_DAYS_", "Jour(s)");

define("_YEAR_", "Année");
define("_YEARS_", "Année(s)");

define("_WEEK_", "Semaine");

# abreviated week
define("_WEEK_ABBR_", "Sem.");

define("_WEEKS_", "Semaine(s)");

define("_HOUR_", "Heure");
define("_HR_", "hr");
define("_HOURS_", "heures");
define("_HRS_", "hrs");

define("_MINS_", "mn");
define("_MINUTES_", "minutes");

define("_DATE_", "Date");
define("_TIME_", "Heure");

define("_AM_", "am");
define("_AM_SHORT_", "am");
define("_PM_", "pm");
define("_PM_SHORT_", "pm");

# VIEWS
define("_TODAY_", "Aujourd'hui");
define("_THIS_WEEK_", "Cette semaine");
define("_THIS_MONTH_", "Ce mois");

##################
# MISC 
##################
define("_EVENT_", "Événement");
define("_EVENTS_", "Événements");
define("_VIEW_", "Affichage");  #Vue - Affichage?

# VIEW AS A NOUN
define("_VIEW_NOUN_", "Vue");

define("_PRINTABLE_VIEW_", "Vue imprimable");

define("_ALLDAY_", "toute la journée");

define("_CAL_CALL_FOR_TIMES_", "Contact us for times");
define("_CAL_CALL_FOR_TIMES_MIN_", "(*)");

define("_TYPE_","Type");
define("_EVENT_TYPE_", "Catégorie");

define("_WIDTH_", "Largeur");

define("_COLORS_", "Couleurs");

# list seperator. Note space after comma
define("_LIST_SEP_",", ");

###########################
# ADMIN PAGE
###########################
define("_GLOBAL_SETTINGS_", "Configuration du site");
define("_EDIT_DEFAULT_OPTS_", "Options par défaut");
define("_PASS_MUST_MATCH_", "Mot de passe erroné");
define("_EMPTY_PASSWORD_", "Pas de mot de passe entré \"\"!");
define("_ARE_YOU_SURE_DELETE_USER_", "Êtes-vous sûr de vouloir effacer cet utilisateur?");
define("_DELETE_USERS_EVENTS_", "Effacer tous les événements de cet utilisateur.");
define("_CALENDARS_OWNED_", "Calendrier de cet utilisateur");
define("_AUDIT_USERS_", "Audit Users");
define("_AUDIT_USERS_DESC_", "Les utilisateurs ont été trouvés dans la base de donnée de Thyme, mais
    aucune correspondance dans le module actuel d'identification n'existe. Toutes les valeurs de l'utilisateur 
    ont été affectée à l'uid de l'utilisateur manquant.");

define("_CALENDAR_PUBLISHER_", "Éditeur de Calendrier");  # ???
define("_CAL_USER_GUEST_", "Compte Invité");
define("_CAL_PUBLISH_GUEST_DISABLED_", "The Calendar Publisher will not work if
        the guest account is disabled.  Please enable this account in the Users section.");


####################################
# GENERAL ACTIONS AND RESPONSES
####################################
define("_ADD_", "Ajouter");
define("_NEW_EVENT_", "Nouvel événement");
define("_REMOVE_", "Enlever");
define("_UPDATE_", "Mise à jour");
define("_NEXT_", "Suivant");
define("_PREV_", "Précédent");
define("_DELETE_", "Supprimer");
define("_SAVE_", "Sauvegarder");
define("_TEST_", "Test");
define("_UPDATE_NOW_", "Mise à jour immédiate");
define("_SAVE_ADD_", "Sauvegarder et en ajouter un autre");
define("_CANCEL_", "Annuler");
define("_BROWSE_", "parcourir");
define("_NONE_", "Aucun");
define("_RESET_", "Réinitialiser");
define("_CLEAR_ALL_", "Tout effacer");
define("_CHECK_ALL_", "Tout activer"); #check: activer / verifier
define("_EDIT_", "Éditer");
define("_CLOSE_", "Fermer");
define("_SHOW_", "Afficher");
define("_HIDE_", "Masquer");
define("_ENABLE_", "Activer");
define("_DISABLE_", "Désactiver");
define("_MOVE_", "Move");
define("_UP_", "Haut");
define("_DOWN_", "Bas");
define("_ENABLED_", "Activé");
define("_CONFIGURE_", "Configurer");
define("_ACCEPT_", "Accepter");
define("_REJECT_", "Rejeter");
define("_OK_", "OK");
define("_FAILED_", "ÉCHOUÉ");
define("_CHANGE_", "Changer");
define("_SORT_BY_", "Trier par");
define("_SEARCH_", "Rechercher");
define("_FORCE_", "Force");
define("_AUTODETECT_", "Détection auto");
define("_RESET_PASS_", "Changement de mot de passe");
define("_NEW_PASS_", "Nouveau mot de passe");
define("_RETYPE_", "Retaper");
define("_UPDATED_", "Mis à jour");
define("_SUBMITTED_", "Soumis");
define("_LOGIN_", "Entrer");
define("_USERNAME_", "Nom d'utilisateur (pseudo)");
define("_PASSWORD_", "Mot de passe");
define("_LOGOUT_", "Sortir");
define("_OPTIONS_", "Options");
define("_ADMIN_", "Administration");
define("_BAD_PASS_", "Mot de passe ou nom d'utilisateur erroné.");
define("_YES_", "Oui");
define("_NO_", "Non");
define("_VALUE_", "Valeur");
define("_CUSTOM_", "Personnalisation");
define("_DEFAULT_", "Défaut");

######################
# ATTACHMENTS
######################
define("_ATTACHMENTS_", "Fichiers joints");
define("_ATTACH_DETACH_", "Enlever");
define("_ATTACH_DELETE_", "Effacer");
define("_ATTACHMENT_TOO_BIG_", "Le fichier joint dépasse la taille autorisée.");
define("_DOWNLOAD_ZIP_", "Télécharger le Zip");
define("_UPDATE_ATTACHMENTS_", "Mettre à jour les fichiers joints");

define("_BYTES_", "b");
define("_KBYTES_", "KB");
define("_MBYTES_", "MB");


#################
# EVENT LIST VIEW
#################
define("_ALL_", "Tous");
define("_UPCOMING_", "Futurs");
define("_PAST_", "Passés");

define("_SHOWING_", "affiche");
define("_OF_", "de");
define("_FIRST_", "Premier");
define("_LAST_", "Dernier");
define("_SHOW_TYPE_", "Catégorie");

define("_LIST_SIZE_", "Affichage des tailles");

define("_ARE_NO_EVENTS_", "Aucun événement à afficher.");

define("_EVENTS_CONTAINING_", "Events containing"); # used in event search

define("_ARE_YOU_SURE_DELETE_EVENTS_", "Êtes-vous sûr de vouloir effacer ces événements?");
define("_DELETE_REPEATING_WARNING_", "
   Vous avez choisi d'effacer un ou plusieurs événements récursifs.<br>
   Toutes les entrées passées ou futures de cet événement seront effacées! ");

define("_UNCHECK_NO_DELETE_", "Désélectionner les événements que vous ne voulez pas effacer:");
define("_DELETE_CHECKED_", "Effacer la sélection");

define("_RETURN_", "Retour");
define("_ERROR_", "Erreur!");

######################
# EVENT EDIT/ADD/VIEW
######################
define("_GENERAL_", "Général");

define("_ORGANIZER_", "Organiseur");

define("_URL_", "URL");

define("_REPEATING_", "Répéter");

define("_LOCATION_", "Location");

define("_APPLY_TO_", "Appliquer les changements à");
define("_ALL_DATES_", "toutes les dates");
define("_THIS_DATE_", "cette date uniquement");

define("_RESET_INSTANCE_", "Rétablir cette entrée dans son état initial");

define("_MAP_", "Carte");

define("_STARTED_", "Commencé");

# e.g. Overrides event Weekly Meeting on 2004-2-34
define("_OVERRIDE_EVNT_ON_", "Écraser l'événement %s du %s");

# e.g. Warning: the event Event Title has an invalid repeating rule
define("_INVALID_RRULE_", "Attention: l'événement %s a une règle de répétition invalide.");

define("_MAX_CHARS_", "caractères maximum");
define("_EVENT_INFO_", "Information de l'événement");
define("_TITLE_", "Titre");
define("_NOTES_", "Notes");    #Avis?

define("_CHECK_FOR_CONFLICTS_", "Vérifier les conflits");

define("_THIS_EVENT_ALLDAY_", "This is an <b>all day</b> event.");
define("_STARTS_AT_", "Commence à");
define("_DURATION_", "Durée");

define("_FLAG_", "Étiquettes");
define("_FLAG_THIS_", "Étiqueter cet événement");
define("_IS_FLAGGED_", "cet événement est étiqueté");

# e.g. 10 days ago
define("_AGO_", "avant"); #10days ago = il y a 10 jours

define("_REPEATING_NO_", "Cet événement n'est pas répété");
define("_REPEATING_REPEAT_", "Répéter");
define("_REPEATING_SELECTED_", "jours sélectionnés");
define("_REPEATING_EVERY1_", "tous");

define("_REPEAT_ON_", "Répéter le");
define("_REPEAT_ON1_", "premier");
define("_REPEAT_ON2_", "deuxième");
define("_REPEAT_ON3_", "troisième");
define("_REPEAT_ON4_", "quatrième");
define("_REPEAT_ON5_", "cinquième");
define("_REPEAT_ONL_", "dernier");
define("_REPEAT_ON_OF_", "du mois, toujours");

#the "th" like sixth in english is the same than "ième" like sixième in french

define("_SIMPLE_", "Simple");
define("_ADVANCED_","Avancée");

define("_YEARLY_", "Annuellement");
define("_MONTHLY_", "Mensuellement");
define("_WEEKLY_", "Hebdomadaire");
define("_DAILY_", "Journalier");
define("_EASTER_", "Pâques");
define("_EASTER_YEARLY_", "Pâques Annuellement");

define("_MONTH_DAYS_", "Jour(s) du mois");
define("_FROM_LAST_", "depuis le dernier");

define("_WEEKDAYS_", "Jour(s) de la semaine");

define("_YEARLY_NOTES_", "Par défaut, les dates de commencement des mois et des jours sont prisent a
    la date de commencement par défaut (s'ils ne sont pas sélectionnés).");

define("_SPECIFIC_OCCURRENCES_", "Occurrences Spécifiques");

define("_STARTING_ON_", "départ sur");

define("_BEFORE_", "Avant");
define("_AFTER_", "Après");

define("_EXCLUDE_DATES_", "Dates exclues");

define("_CONFIRM_EVNT_RPT_CHANGE_", "Vous changez la règle de répétition ou les dates de cet événement.\n
Toutes les exceptions associées avec cet événement répétitif seront perdues. Êtes-vous sûrs que vous voulez le faire ?\n");

define("_END_DATE_", "Date de fin");
define("_END_DATE_NO_", "Sans date de fin");
define("_END_DATE_UNTIL_", "Jusqu'à ce que");
define("_END_DATE_AFTER_", "Finira après");
define("_OCCURRENCES_", "occurrences");

define("_ADDRESS_", "Adresse");
define("_ADDRESS_1_", "Rue");
define("_ADDRESS_2_", "Ville, Code postal");

define("_PHONE_", "Tél");
define("_ICON_", "Icône");

#####################
# MODULES
#####################
define("_NAVBAR_", "Barre de navigation");
define("_MODULE_", "Module");
define("_MODULES_", "Modules");
define("_TODAY_LINK_", "Liens journaliers");
define("_MINI_CAL_", "Mini Calendrier");
define("_CALENDAR_LINKS_", "Liens Calendriers");
define("_IMAGE_BROWSER_", "Navigateur d'images");
define("_QUICK_ADD_EVNT_", "Ajout rapide d'événement");
define("_GOTO_DATE_", "Aller à la date");
define("_SEARCH_EVENTS_", "Chercher un événement");
define("_EVENT_FILTER_", "Catégories");
define("_COLOR_LEGEND_", "Légende");

##################
# SYNC 
##################

define("_SYNC_", "Synchronisation");
define("_IMPORT_", "Importer");
define("_EXPORT_", "Exporter");
define("_IMPORT_FROM_", "Importer de");
define("_EXPORT_TO_", "Exporter à");
define("_SYNC_DUPLICATES_", "Si des doublons sont trouvés");
define("_IGNORE_DUPLICATES_", "Ignorer les doublons");
define("_OVERWRITE_EXISTING_EVENT_", "Écraser les événements existants");
define("_CREATE_NEW_EVENT_", "Créer un nouvel événement");
define("_IMPORT_AS_", "Importer dans la catégorie");
define("_EVENTS_IMPORTED_", "Événements importés");
define("_SYNC_IMPORT_ERROR_", "Erreur: une erreur est survenue durant l'importation du fichier.");
define("_HTML_", "HTML");
define("_PLAINTEXT_", "Plain text");
define("_ICAL_", "iCalendar (.ics)");
define("_QUIRKS_MODE_", "Mode Caprice");
define("_PERMISSION_DENIED_", "Permission refusée: vous n'êtes pas le propriétaire de cet événement ou un administrateur de ce calendrier.");
define("_FULL_SYNC_", "Synchronisation complète");
define("_FULL_SYNC_DESC_", "Supprimer les événements qui existent dans Thyme, mais qui n'ont pas été trouvés dans le fichier importé.");

#########################
# CSS AND STYLE
#########################
define("_COLOR_", "Couleur");

define("_STYLE_", "Style");

define("_PREVIEW_", "Aperçu");
define("_SAMPLE_", "Exemple");

define("_BACKGROUND_COLOR_", "Couleur de fond");
define("_FONT_COLOR_", "Couleur de la police");
define("_FONT_SIZE_", "Taille de la police");

define("_FONT_STYLE_", "Style de police");
define("_BOLD_", "gras");
define("_ITALICS_", "italic");
define("_UNDERLINE_", "souligné");

define("_FONT_FAMILY_", "Famille de police");
define("_FONT_FAMILY_DESC_", "Ex: Tahoma, 'Sans Serif', Arial");

define("_UNDERLINE_LINKS_", "Souligner les liens");
define("_NEVER_", "Jamais");
define("_ALWAYS_", "Toujours");
define("_HOVER_", "Au survol");
define("_BORDER_COLOR_", "Couleur de la bordure");
define("_TIME_FONT_COLOR_", "Couleur de la police Time");
define("_TITLE_FONT_COLOR_", "Couleur de la police des titres");
define("_TITLE_FONT_STYLE_", "Style de police des titres");

#########################
# CALENDAR PUBLISHER
#########################
if(@constant("_CAL_DOING_PUBLISHER_")) { # <- leave this line alone

define("_MINI_MONTH_", "Mensuelle compacte (MiniMois)");

define("_SET_DATE_CURRENT_", "définir à la date courante");
define("_EDITABLE_", "Éditable");
define("_STATIC_", "Statique");
define("_STATIC_DESC_", "le contenu de calendrier ne contient aucun liens qui change la date ou la vue");
define("_HIL_DAY_", "Mettre en évidence le jour");
define("_HIL_WEEK_", "Mettre en évidence la semaine");

define("_APPLY_CSS_FROM_", "Appliquer le style de");
define("_NO_CSS_", "none");
define("_CSS_EDITOR_", "Éditeur de style");

define("_LANGUAGE_", "Langue");
define("_EURO_DATE_", "Date européanisée");
define("_EURO_DATE_DESC_", "Les dates sont affichées en format dd/mm/yyyy ou c'est utilisable");

define("_HEADER_", "En-tête");
define("_WEEKDAY_HEADER_", "En-tête de jour de la semaine");

define("_NORMAL_DAYS_", "Jours normaux");
define("_DAYS_NOT_IN_MONTH_", "Jours pas dans un mois");
define("_HIGHLIGHTED_DAYS_", "Jours mis en évidences");

define("_NORMAL_EVENTS_", "Événements normaux");
define("_FLAGGED_EVENTS_", "Événements étiquetés");

define("_SHOW_EVENTS_", "Montrer les événements");


define("_EVENT_LINKS_", "Liens d'événements");

define("_EVENT_LINK_URL_", "URL du lien d'événement");

define("_EVENT_LINK_URL_DESC_", "

        Cette URL va être parsée dans une requête contenant un
        <font class='"._CAL_CSS_HIL_."'>eid</font> et une <font class='"._CAL_CSS_HIL_."'>instance</font>.<br>

        <b>eid</b> est l'identifiant (ID) de l'événement (E) et <b>instance</b> est la date dans le format
        <b>YYYY-MM-DD</b>.<br>Ils sont définit par <font class='"._CAL_CSS_HIL_."'>%eid</font>
        et par <font class='"._CAL_CSS_HIL_."'>%inst</font>.<br><br>

        Ex. http://mysite.com/sales/view_sale.php?eid=%eid&instance=%inst may yield:<br>

        http://mysite.com/sales/view_sale.php?<font
		class='"._CAL_CSS_HIL_."'>eid</font>=56&<font
		class='"._CAL_CSS_HIL_."'>instance</font>=2005-10-26<br><br>

        Voir la référence et/ou le didacticiel disponibles sur le site Web de Thyme pour plus d'informations sur les différents usages.");


define("_SHOW_HEADER_", "Montrer les en-têtes");
define("_ALIGN_HEADER_TEXT_", "Aligner le texte des en-têtes");
define("_CENTER_", "Centrer");
define("_HEADER_TEXT_", "Texte d'en-tête");

define("_HEADER_TEXT_DESC_","

   (Ex. <font class='"._CAL_CSS_HIL_."'>Anniversaire en mois (%month)</font>)<br>
        <font size=1><i>Laissez vide pour utiliser l'en-tête par défaut.
        Les autres variables sont %weekday, %mday, %mon et %year.</i></font> ");


define("_SHOW_HEADER_LINKS_", "Montrer les liens d'en-tête");

define("_NEXT_LINK_", "Lien 'Suivant'");
define("_PREV_LINK_", "Lien 'Précédent'");

define("_IMG_URL_", "URL de l'image");

define("_HEADER_LINKS_", "Liens d'en-tête");

define("_IMG_URL_DESC_", "
        Cela peut être un texte comme '<<' ou l'URL d'une image<br>
        (Ex. <font
        class='"._CAL_CSS_HIL_."'>http://www.myserver.com/images/next.gif</font>)<br><font
        size=1><i>Laisser vide pour utiliser l'image par défaut du thème utilisé.</i></font> ");


define("_DAY_VIEW_", "Vue journalière");

define("_MONTH_VIEWS_", "Vue mensuelle");

define("_SHOW_WEEKS_DESC_", "Noter que le calendrier compact (MiniMois) n'affiche jamais le numéro de semaine");

define("_ROW_HEIGHT_", "Hauteur de ligne");
define("_ROW_HEIGHT_DESC_", "Par défaut, elle est de '90' pour un mois, et de '0' pour un mois de calendrier compact (MiniMois)");

define("_LIMIT_WEEKDAY_NAMES_", "Limiter les noms des jour de la semaine à ");
define("_CHARS_", "chars");

define("_EXCLUDE_MONTH_DAYS_", "Exclure les jours qui ne sont pas dans le mois");

define("_MINI_MONTH_DATE_URL_", "URL de date compacte (MiniMois)");

define("_MINI_MONTH_DATE_URL_DESC_", "
        Cliquer sur un lien dans un jour du calendrier compact (MiniMois) va ouvrir ce jour.
        Ceci remplace les différentes chaînes de caractères dans l'URL:<br>

        %d = le jour (numéro)<br>
        %m = le mois (numéro)<br>
        %y = l'année<br>

        <br><br>

        Ex. http://www.myserver.com/page.php?day=%d&month=%m&year=%y<br>
        devient
        <font class='"._CAL_CSS_HIL_."'>http://www.myserver.com/page.php?day=23&month=11&year=2004</font>

        <br> ou vous pouvez utiliser le JavaScript.<br>

        Ex. <font class='"._CAL_CSS_HIL_."'>javascript:myFunction(%y,%m,%d)</font><br><br>

        Par défaut, le lien de la page courante définit:<br>
        m = %m<br>
        d = %d<br>
        y = %y<br>

        Ex. <font class='"._CAL_CSS_HIL_."'>index.php?d=23&m=11&y=2004</font><br><br>
        Voir la Référence et/ou le didacticiel disponibles sur le site Web de Thyme pour plus d'informations sur les différents usages.");


define("_GENERATED_CODE_", "Code Généré");

define("_BASE_PATH_DESC_", "Chemin de base de Thyme avec un / à la fin");
define("_BASE_URL_DESC_", "URL de base de Thyme avec un / à la fin");

} # </ CALENDAR PUBLISHER SECTION > <- leave this line alone


######################
#
### RSS FEED MODULES
#
#####################
define("_RSS_FEED_MODULES_", "Modules de flux RSS");
define("_RSS_", "Flux RSS");
define("_UPDATE_INTERVAL_", "Intervalle de mise à jour");
define("_ARE_YOU_SURE_DELETE_RSSMOD_", "Êtes-vous sûr de vouloir effacer ce module de flux RSS?");
define("_AUTHOR_", "Auteur");

# scrolling
define("_SCROLLING_","Scrolling");
define("_OVERFLOW_", "Overflow");
define("_SCROLLBAR_", "Scrollbar");
define("_AUTOSCROLL_", "Autoscrolling");


# this will keep us from needing to
# have these defined when not looking
# at options
#####################################
if(@constant("_CAL_DOING_OPTS_")) { # <- leave this line alone

######################
# OPTION STRINGS
######################

define("_DEFAULT_VIEW_", "Vue par défaut");

define("_DEFAULT_CALENDAR_", "Calendrier par défaut");

define("_TIME_INTERVALS_", "Intervalles de temps");

define("_EVNT_SIZE_", "Taille des événements");
define("_SMALLER_", "Petite");
define("_SMALLEST_", "La plus petite");
define("_EVNT_COLLAPSE_", "Raccourcir les événements (vue mensuelle)");
define("_EVNT_COLLAPSE_DESC_", "Raccourcir les longs titres d'événement.");
define("_EVNT_TYPE_NAME_", "Montrer les noms des catégories d'événement");
define("_EVNT_POPUP_", "Événements popup");
define("_EVNT_POPUP_DESC_", "Montrer les événements dans une nouvelle fenêtre.");
define("_EVNT_NOTES_POPUP_", "Les notes de l'événement s'ouvrent dans un popup");
define("_EVNT_NOTES_POPUP_DESC_", "Placer la souris au-dessus d'un événement pour afficher les notes.");

define("_POSITION_", "Position");

define("_SHOW_WEEKS_", "Montrer les numéros de semaine");

define("_WEEK_START_", "La semaine commence le");
define("_WORK_HOURS_", "Heures de travail");
define("_WORK_HOURS_START_", "commence à");
define("_WORK_HOURS_END_", "fini à");

define("_HOUR_FORMAT_", "Format de l'heure");
define("_HOUR_FORMAT_12_", "12 hr");
define("_HOUR_FORMAT_24_", "24 hr");

define("_NAV_BAR_LOC_", "Barre de navigation");
define("_RIGHT_", "Droite");
define("_LEFT_", "Gauche");

define("_TIMEZONE_", "Fuseaux horaires");
define("_DST_", "Heure d'été");
define("_STARTS_", "Début");
define("_ENDS_", "Fin");

define("_IN_", "de");
define("_ON_", "ON");
define("_OFF_", "OFF");

define("_THEME_", "Thème");

##########################
# CONTACT OPTIONS
##########################
define("_CONTACT_OPTS_", "Options des contacts");
define("_PRIMARY_", "Primaire");
define("_FORMAT_", "Format");

##########################
# SUBSCRIPTIONS
##########################
define("_SUBSCRIPTIONS_", "Abonnements");
define("_SUBSCRIPTIONS_DESC_", "Abonnements par e-mail aux calendriers.");

######################
# NOTIFICATIONS
#####################
define("_NOTIFICATIONS_", "Notifications");
define("_NOTIFICATIONS_DESC_", "Filtrage des notifications pour les news et les mises à jour d'évenements.");

define("_TITLE_CONTAINS_", "Contenu du titre");
# event X has been updated on calendar Y
define("_UPDATED_ON_", "a été mis à jour");
# event X has been added to calendar Y
define("_ADDED_TO_", "a été ajouté à");

#####################
# DST STRINGS
#####################
define("_DST_OPTS1_", "Afrique / Egypte");
define("_DST_OPTS2_", "Afrique / Nambie");
define("_DST_OPTS3_", "Asie / Russie (Ex-URSS)");
define("_DST_OPTS4_", "Asie / Iraq");
define("_DST_OPTS5_", "Asie / Liban, Kirghizstan");
define("_DST_OPTS6_", "Asie / Syrie");
define("_DST_OPTS7_", "Australie / Australie, Pays de galles");
define("_DST_OPTS8_", "Australie / Australie - Tasmanie");
define("_DST_OPTS9_", "Australie / Nouvelle Zélande, Chatham");
define("_DST_OPTS10_", "Australie / Tonga");
define("_DST_OPTS11_", "Europe / Union Européenne, Royaume Uni, Groenland");
define("_DST_OPTS12_", "Europe / Russie");
define("_DST_OPTS13_", "Amérique du Nord / USA, Canada, Mexique");
define("_DST_OPTS14_", "Amérique du Nord / Cuba");
define("_DST_OPTS15_", "Amérique du Sud / Chili");
define("_DST_OPTS16_", "Amérique du Sud / Paraguay");
define("_DST_OPTS17_", "Amérique du Sud / Les Îles Malouines");

####################
# TIMEZONE STRINGS
####################
define("_GMT_PLUS_0.0_","GMT +00:00 Royaume Uni, Irlande, Portugal, Afrique Occidentale");
define("_GMT_PLUS_0.5_","GMT +00:30 ");
define("_GMT_PLUS_1.0_","GMT +01:00 Europe Occidentale, Afrique Centrale");
define("_GMT_PLUS_1.5_","GMT +01:30 ");
define("_GMT_PLUS_2.0_","GMT +02:00 Europe de l'Est, Afrique Orientale");
define("_GMT_PLUS_2.5_","GMT +02:30 ");
define("_GMT_PLUS_3.0_","GMT +03:00 Russie, Arabie Saoudite");
define("_GMT_PLUS_3.5_","GMT +03:30 ");
define("_GMT_PLUS_4.0_","GMT +04:00 Arabie");
define("_GMT_PLUS_4.5_","GMT +04:30 ");
define("_GMT_PLUS_5.0_","GMT +05:00 Asie Occidentale, Pakistan");
define("_GMT_PLUS_5.5_","GMT +05:30 Inde");
define("_GMT_PLUS_6.0_","GMT +06:00 Asie Centrale");
define("_GMT_PLUS_6.5_","GMT +06:30 ");
define("_GMT_PLUS_7.0_","GMT +07:00 Bangkok, Hanoi, Jakarta");
define("_GMT_PLUS_7.5_","GMT +07:30 ");
define("_GMT_PLUS_8.0_","GMT +08:00 Chine, Singapour, Taiwan");
define("_GMT_PLUS_8.5_","GMT +08:30 ");
define("_GMT_PLUS_9.0_","GMT +09:00 Corée, Japon");
define("_GMT_PLUS_9.5_","GMT +09:30 Australie Centrale");
define("_GMT_PLUS_10.0_","GMT +10:00 Australie Orientale");
define("_GMT_PLUS_10.5_","GMT +10:30 ");
define("_GMT_PLUS_11.0_","GMT +11:00 Pacifique Central");
define("_GMT_PLUS_11.5_","GMT +11:30 ");
define("_GMT_PLUS_12.0_","GMT +12:00 Iles Fiji, Nouvelle Zélande");
define("_GMT_MINUS_12.0_","GMT -12:00 Ligne de changement de fuseau");
define("_GMT_MINUS_11.5_","GMT -11:30 ");
define("_GMT_MINUS_11.0_","GMT -11:00 Samoa");
define("_GMT_MINUS_10.5_","GMT -10:30 ");
define("_GMT_MINUS_10.0_","GMT -10:00 Hawaï");
define("_GMT_MINUS_9.5_","GMT -09:30 ");
define("_GMT_MINUS_9.0_","GMT -09:00 Alaska/Pitcairn Islands");
define("_GMT_MINUS_8.5_","GMT -08:30 ");
define("_GMT_MINUS_8.0_","GMT -08:00 US/Canada/Pacifique");
define("_GMT_MINUS_7.5_","GMT -07:30 ");
define("_GMT_MINUS_7.0_","GMT -07:00 US/Canada/Montagnes Rocheuses");
define("_GMT_MINUS_6.5_","GMT -06:30 ");
define("_GMT_MINUS_6.0_","GMT -06:00 US/Canada/Central");
define("_GMT_MINUS_5.5_","GMT -05:30 ");
define("_GMT_MINUS_5.0_","GMT -05:00 US/Canada/Est, Colombie, Pérou");
define("_GMT_MINUS_4.5_","GMT -04:30 ");
define("_GMT_MINUS_4.0_","GMT -04:00 Bolivie, Brésil de l'ouest, Chili, Atlantique");
define("_GMT_MINUS_3.5_","GMT -03:30 Terre-neuve");
define("_GMT_MINUS_3.0_","GMT -03:00 Argentine, Brésil de l'est, Groenland");
define("_GMT_MINUS_2.5_","GMT -02:30 ");
define("_GMT_MINUS_2.0_","GMT -02:00 Atlantique Central");
define("_GMT_MINUS_1.5_","GMT -01:30 ");
define("_GMT_MINUS_1.0_","GMT -01:00 Açores / L'Atlantique Orientale");
define("_GMT_MINUS_0.5_","GMT -00:30 ");

}

##########################
# ERRORS AND WARNINGS
##########################
define("_WARNING_ATTACH_", "Attention: le répertoire des fichiers joints %s est inéxistant, ou l'accès en écriture est interdit.");
define("_WARNING_RSS_", "Attention: il n'est pas possible d'écrire dans votre répertoire de flux RSS %s .");
define("_WARNING_INSTALL_", "Attention: %s existe toujours. Merci d'enlever ce fichier.");
define("_WARNING_LICENSE_", "Attention: votre licence de Thyme expire dans %s jours.");


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
  "Dimanche",
  "Lundi",
  "Mardi",
  "Mercredi",
  "Jeudi",
  "Vendredi",
  "Samedi");

$_cal_months or $_cal_months = array(1 =>
  "Janvier",
  "Février",
  "Mars",
  "Avril",
  "Mai",
  "Juin",
  "Juillet",
  "Août",
  "Septembre",
  "Octobe",
  "Novembre",
  "Décembre");


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
