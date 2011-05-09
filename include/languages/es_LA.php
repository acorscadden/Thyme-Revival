<?php // New translations and last reviewed on April 19th 2006. 2:35 GMT.  www.babroo.com


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

define("_LANG_NAME_", "Español (LA)");


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
define("_GLOBAL_VIEWS_", "Vistas Globales");

define("_ALLOW_EVERYONE_VIEW_", "Permitir a todos(as) ver todos los calendarios en esta Vista sin importar la lista de miembros.");

define("_HIDE_VIEW_FROM_GUESTS_", "Ocultar esta Vista de usuarios no registrados(as)");

define("_REQUEST_NOTIFY_OWNER_", "Notificar al dueño del calendario cuando hayan solicitudes pendientes");

define("_ALL_CALENDARS_", "Vista de Todos lo Calendarios");

#################################
#
### INSTALLER
#
#################################

# some of these will not be used until 2.0
define("_INSTALLER_", "Instalador");
define("_PACKAGE_", "Paquete");
define("_INSTALL_", "Instalar");
define("_INVALID_PACKAGE_", "El archivo cargado no es un paquete Thyme válido.");
define("_INSTALLED_MODULES_", "Modulos instalados");
define("_UNINSTALL_", "Desinstalar");
define("_LOCAL_FILE_","Archivo Local");
define("_UPDATES_", "Actualizaciones");
define("_AVAILABLE_UPDATES_", "Actualizaciones disponibles");
define("_CHECK_FOR_UPDATES_", "Buscar actualizaciones");
define("_LAST_CHECKED_ON_", "Se busco por última vez"); # e.g. last checked on 1/2/2007
define("_FILE_", "Archivo");
define("_WRITABLE_", "Se puede escribir");
define("_REFRESH_", "Refrezcar");
define("_INVALID_DOWNLOAD_", "Descarga inválida. No es posible cargar el archivo.");
define("_UNABLE_TO_BACKUP_", "No se puede respaldar archivo actual.");
define("_UPDATES_AVAIL_", "Existen %s actualizaciones disponibles"); # %s will be replaced w/# of updates available

############################
#
### NEW USER DEFINITIONS
#
###########################
define("_REGISTERED_USERS_", "Usuarios registrados");
define("_PUBLIC_", "Público");
define("_PUBLIC_ACCESS_", "Acceso Público");

#############################
#
### MULTIPLE REMINDERS
#
#############################
define("_BEFORE_EVENT_MULTI_", "antes de este evento");
define("_USER_CAN_NOT_VIEW_", "%s no tiene acceso para ver este calendario.");
define("_ALLOW_CONFIGURE_REMINDERS_", "Permitir a %s configurar recordatorios de eventos para todos los usuarios.");
define("_CALENDAR_ADMINS_", "Administración de Calendarios");
define("_EVENT_OWNER_", "Dueño del Evento");
define("_SITE_ADMINS_", "Administradores del Sitio");
define("_NO_ONE_", "Nadie");

###############################
#
## CONFIGURABLE JOB INTERVALS
#
###############################

define("_REMIND_AT_LEAST_", "Al menos");
define("_SCHEDULED_TASK_", "Tareas Programables");
define("_NO_SCHEDULED_TASK_", "La Tarea programada en Thyme no esta configurada para ejecutarse");
define("_SCHEDULED_TASK_CONFIGURED_", "La Tarea programada en Thyme está configurado para ejecutarse cada");
define("_PHP_CLI_", "Ubucación de PHP CLI");

###################################
#
### CUSTOMIZE SITE
#
###################################
define("_CUSTOMIZE_SITE_", "Personalizar Sitio");
define("_SITE_NAME_", "Nombre del Sitio");
define("_SITE_THEME_", "Theme (Skin) del Sitio");
define("_SITE_THEME_DESC_", "establecer como valor None, permitiría a los usuarios escojer su propio Theme");

# use exact HTML tags, they will be displayed correctly
# when printed
define("_SITE_HEADER_", "Diseño del Encabezado del sitio");
define("_SITE_HEADER_DESC_", "Después de la etiqueta <body>");

define("_SITE_FOOTER_", "Pie de Página del Sitio");
define("_SITE_FOOTER_DESC_", "Antes de la etiqueta </body>");

define("_SITE_HEAD_", "Información del Encabezado");
define("_SITE_HEAD_DESC_", "Entre las etiquetas <head> y </head>.");


####################################
#
### LICENSE KEY
#
####################################
define("_ENTER_LICENSE_KEY_", "Ingrese su Serial (Licencia)");
define("_LICENSE_KEY_", "Serial (Licencia)");
define("_LICENSE_KEY_ACCEPTED_", "Serial Aceptado");
define("_INVALID_LICENSE_KEY_", "El Serial ingresado no es válido para este sitio.");

####################################
#
### EVENT REQUEST DESCRIPTION
#
####################################
define("_REQUEST_MODE_VIEW_ONLY_", "Vista donde sólo los miembros pueden enviar solicitudes de eventos nuevos. Usuarios normales pueden agregar eventos directamente.");
define("_REQUEST_MODE_NORMAL_", "Vista donde sólo los miembros pueden ver el calendario. Usuarios normales enviar solicitudes de eventos nuevos.");

#####################################
#
### TELL A FRIEND FOR GUEST E-MAILS
#
######################################
define("_TELL_A_FRIEND_", "Enviar a un amigo");

define("_YOUR_NAME_", "Tu Nombre");
define("_YOUR_EMAIL_", "Tu e-mail");

define("_YOUR_FRIENDS_NAME_","Nombre de tu amigo");
define("_YOUR_FRIENDS_EMAIL_","Email de tu amigo");

define("_EMAIL_EVENT_DISPLAYED_","El evento podrá verse en tu mensaje.");

define("_ALLOW_GUEST_USERS_EMAIL_", "Permitir que usuarios no registrados remitan eventos.");

define("_DISABLE_SITE_ADDR_BOOK_", "Desactivar Libreta de Direcciones para los no-admnistradores");

define("_EMAIL_TO_MULTIPLE_", "Separar direccioens múltiples con una coma.");

# MISC
########
define("_HELP_", "Ayuda");
define("_WARNING_DIR_NOT_WRITABLE_", "Precaución: No se puede escribir en el directorio %s .");
define("_WARNING_FILE_NOT_WRITABLE_", "Precaución: No se puede escribir en el archivo archivo %s.");
define("_DOWNLOAD_", "Descarga");
define("_HIDE_QUICK_ADD_", "Ocultar opción de Agregado Rápido de evento");
define("_FORCE_DEFAULT_OPTS_", "Forzar opciones por defecto para todos los usuarios. Puede establecerlo en Administración - Opciones por defecto.");
define("_NO_GUEST_TIMEZONE_", "No permitir a Invitados a cambiar zona horaria.");
define("_NUMBER_SYMBOL_", '°');
define("_DISABLE_WYSIWYG_EDITOR_", "Dehabilitar editor WYSIWYG para las notas del evento.");
define("_SHOW_CALENDAR_NAMES_", "Mostrar nombre del calendario de eventos cuando se muestren la categoría de nombres sea establecidas entre las opciones del usuario.");
define("_MISC_", "Varios");
define("_THEME_POPUPS_", "Aplicar Theme (Skin) a notas en ventanas emergentes.");

define("_PUBLIIC_", "Público");
define("_REGISTERED_USERS_", "Usuarios registrados");

define("_NEW_", "Nuevo");

define("_CATEGORY_EDIT_DESC_", "Para editar una categoría, oprima en este título");

define("_ARE_YOU_SURE_DELETE_", "¿Está seguro que desea borrar este %s?");

########## END NEW TRANSLATIONS #################



################################
# EDIT / VIEW / POST CALENDARS
################################
define("_CALENDARS_", "Calendarios");
define("_OWNER_", "Dueño o creador");
define("_ARE_YOU_SURE_DELETE_CALENDAR_", "¿Está seguro que ud. quiere borrar 
este calendario?");

define("_COLOR_BY_", "Coloree los eventos de acuerdo a");
define("_BY_OWNER_", "Dueño del evento");
define("_BY_CATEGORY_", "Categoría del evento");
define("_BY_CALENDAR_", "Calendario");

define("_STRICT_EVENT_SECURITY_", "Seguridad estricta del evento");
define("_STRICT_EVENT_SECURITY_DESC_", "Solamente el dueño/creador del 
evento o el administrador del calendario puede modificar o borrar eventos 
existentes");

define("_REMOTE_ACCESS_", "Acceso remoto");
define("_REMOTE_ACCESS_DESC_", "Acceso remoto permite a los usuarios 
subscribirse a este calendario remotamente por medio de programas como 
Mozilla Sunbird
Windates, o Apple iCal. Esto hará posible el uso de RSS a traves de lectores 
de RSS (RssReader, Shrook..) proveedores de contenido
(Yahoo!, MSN..), y herramientas de administración de contenido (PHP-Nuke, 
Mambo..).");

define("_ENABLE_REMOTE_ACCESS_UPD_", "Permitir acceso remoto. Esta opción 
permite a usuarios autorizados hacer actualizaciones a este
calendario usando un programa tercero o externo.");

define("_REMOTE_ACCESS_DESC_USERS_", "Si el Usuario Invitado no es miembro 
de este calendario, las personas que traten de entrar a este
calendario necesitaran un nombre de usuario y clave. Una vez se verifique su 
autenticidad, se concedera o negara acceso de acuerdo con
la configuración de la Membresia.");

define("_SYNDICATION_", "Sindicación");

define("_ALLOW_MULTI_CATS_", "Permita categorías múltiples");

define("_REMEMBER_LOCATIONS_", "Recordar lugares");

define("_MODE_", "Modalidad");

define("_EDIT_EVENT_TYPES_", "Configurar categorías");

define("_EVENT_TYPES_", "Categorías");

define("_EVENT_TYPES_DESC_", "

       No seleccione ninguna categoría para habilitar todas las 
categorías<BR><BR>");

define("_MULTI_SELECT_WIN_","
       Windows: Para deseleccionar un item o para seleccionar<br>varios, 
items no-concurrentes
	   presione<br>la tecla ctrl mientras lo selecciona.");

define("_REALLY_DELETE_EVENT_TYPE_", "¿Está seguro(a) que quiere borrar ésta 
categoría?"); # question
define("_DELETE_ALL_IN_CATEGORY_", "Quiere borrar todos los eventos en ésta 
categoría");

define("_VIEWS_NO_ACTION_", "Esta acción no puede realizarse en la modalidad 
de vision.
Por favor seleccione un calendario.");

define("_VIEW_INVALID_CAL_", "Está viendo un calendario del cual ud. no es miembro(a). Los
eventos de este calendario no se pueden mostrar.");

define("_DESCRIPTION_", "Descripción");
define("_DETAILS_", "detalles");
define("_PUBLISH_", "publicar");
define("_PUBLISH_DESC_", "Publicar este calendario a un servidor web remoto 
o a un servicio como
<a class='". _CAL_CSS_BODY_ ." ". _CAL_CSS_ULINE_."' target=_blank
href='http://icalx.com'>iCal Exchange</a>");
define("_SERVER_RESPONSE_", "Respuesta del servidor");



######################
# EMAIL EVENT
######################
define("_EMAIL_EVENT_", "Enviar evento por correo electrónico");
define("_EMAIL_TO_", "A");
define("_SEND_EMAIL_", "Enviar");
define("_SUBJECT_", "Asunto");
define("_MESSAGE_", "Mensaje");
# e.g. The event has been sent to abcdefg@alphabet.com
define("_EMAIL_SENT_TO_", "Este evento ha sido enviado a");
define("_EMAIL_NO_ADDR_WARNING_", "Advertencia: Usted no ha configurado una dirección de correo electrónico
en la sección Opciones de Contacto (Contact Options) bajo Opciones (Options).  Su correo electrónico aparecera como enviado de". @constant("_CAL_MAIL_FROM_"));

######################
# EMAIL SETTINGS
######################
define("_MAIL_PROG_PHP_", "Función de correo electrónico de PHP");
define("_MAIL_PROG_CMD_", "enviador de correo local (sendmail, qmail, etc..)");
define("_MAIL_PROG_SERVER_", "Servidor SMTP");

define("_MAIL_PROGRAM_", "Enviar correo electrónico a traves de este programa");

define("_MAIL_FROM_EMAIL_", "dirección de correo electrónico");

define("_MAIL_PATH_", "trayectoria local para enviar correo (local mailer path) ");
define("_MAIL_AUTH_", "Autenticador SMTP (Authentication)");

define("_MAIL_AUTH_USER_", "nombre de usuario SMTP (username)");
define("_MAIL_AUTH_PASS_", "clave SMTP (password)");

define("_MAIL_SERVER_", "servidor SMTP (server)");
define("_MAIL_SERVER_PORT_", "puerto del servidor (Server Port)");

##########################
# ATTACHMENT SETTINGS
##########################
define("_ALLOW_ATTACHMENTS_", "Permitir adjuntar archivos");
define("_ATTACHMENTS_PATH_", "localización (path) de archivos adjuntos");

#############################
# GROUPS AND USERS
#############################
define("_USERS_", "Usuarios");
define("_GROUPS_", "Grupos");
define("_EVERYONE_", "Todos");
define("_SUPER_USER_", "Super Usuario");

define("_MEMBERS_", "Miembros");
define("_MEMBERS_OF_", "Miembros de");

define("_NAME_", "Nombre");
define("_EMAIL_", "Correo electrónico");

define("_ACCESS_LVL_", "Nivel de acceso");
define("_ROLE_", "Rol");
define("_READ_ONLY_", "Mirar solamente (View Only)");
define("_NORMAL_","Normal");

define("_ARE_YOU_SURE_DELETE_GROUP_", "¿Está seguro(a) que quiere borrar este grupo?");
define("_GROUPS_SAVE_ATLEAST_1_MEMBER_", "Cada grupo debe tener por lo menos 1 miembro(a). La lista de miembros no 
ha sido guardada.");

# displayed as form field must begin with a character. E.g.
# Username must begin with a character.
define("_MUST_BEGIN_WITH_CHAR_", "debe iniciar con un caracter character).");

######################
# REMINDERS
######################
define("_REMINDERS_", "Recordatorios");
define("_BEFORE_EVENT_","antes de este evento, en");

define("_WILL_OCCUR_IN_", "Ocurrirá en"); # event x will occur in 30 minutes



###########################
# EVEVNT REQUESTS
############################
define("_REQUEST_", "Petición de evento");
define("_REQUESTS_", "Petición de eventos");
define("_REQUEST_ACCEPTED_", "La petición de su evento ha sido acceptada.");
define("_REQUEST_REJECTED_", "La petición de su evento ha sido rechazada.");

define("_NOTIFY_REQUESTOR_", "Noticar al peticionario(a)");
define("_REQUEST_HAS_NOTIFY_", "El/la peticionario(a) ha solicitado un aviso.");
define("_REQUESTS_NO_PENDING_", "No hay peticiones pendientes.");
define("_REQUEST_NOTIFY_EMAIL_", "notifíqueme acerca de peticiones pendientes a");
define("_REQUEST_MSG_PRE_", "Mensaje mostrado a usuarios antes de que la petición sea enviada.");
define("_REQUEST_MSG_POST_", "Mensaje mostrado a usuarios despues de que la petición ha sido enviada.");
define("_REQUEST_NOTES_", "Apuntes adicionales acerca de la petición");
define("_REQUEST_NOTIFY_STATUS_", "Notifíqueme acerca de el estado de ésta petición a");

define("_CONTACT_", "Contacto");

# You have a pending event request on calendar: CALENDAR TITLE
define("_PENDING_REQUEST_", "Usted tiene una petición pendiente en el calendario:");


#################
# DATE  ITEMS
#################
define("_CALENDAR_", "Calendario");

define("_MONTH_", "Mes");
define("_MONTHS_", "Meses");

define("_DAY_","Día");
define("_DAYS_", "días");

define("_YEAR_", "Año");
define("_YEARS_", "Años");

define("_WEEK_", "Semana");
define("_WEEKS_", "Semanas");

define("_WEEK_ABBR_", "Semana");

define("_HOUR_", "Hora");
define("_HR_", "hr");
define("_HOURS_", "horas");
define("_HRS_", "hrs");

define("_MINS_", "mins");
define("_MINUTES_", "minutos");

define("_DATE_", "Fecha");
define("_TIME_", "Hora");

define("_AM_", "am");
define("_AM_SHORT_", "a");
define("_PM_", "pm");
define("_PM_SHORT_", "pm");

# VIEWS
define("_TODAY_", "Hoy");
define("_THIS_WEEK_", "Esta semana");
define("_THIS_MONTH_", "Este mes");

##################
# MISC
##################
define("_EVENT_", "Evento");
define("_EVENTS_", "Eventos");
define("_VIEW_", "Ver");

define("_LIST_SEP_", ", ");

# VIEW AS A NOUN
define("_VIEW_NOUN_", "Vista o modalidad visual");

define("_PRINTABLE_VIEW_", "Modalidad imprimible");

define("_ALLDAY_", "Todo el día");

define("_CAL_CALL_FOR_TIMES_", "Contáctenos para las horas");
define("_CAL_CALL_FOR_TIMES_MIN_", "(*)");

define("_TYPE_","Tipo");
define("_EVENT_TYPE_", "Categoría");

define("_WIDTH_", "Ancho/anchura");

define("_COLORS_", "Colores");


###########################
# ADMIN PAGE
###########################
define("_GLOBAL_SETTINGS_", "Configuración del Sitio (Site Settings)");
define("_EDIT_DEFAULT_OPTS_", "Opciones preestablecidas (Default Options)");
define("_PASS_MUST_MATCH_", "Las claves que usted ingreso no son las mismas");
define("_EMPTY_PASSWORD_", "No se ha establecido la clave como \"\"!");
define("_ARE_YOU_SURE_DELETE_USER_", "¿Está seguro(a) que quiere borrar este usuario?");
define("_DELETE_USERS_EVENTS_", "Borrar todos los eventos creados por este usuario.");
define("_CALENDARS_OWNED_", "Estos son los calendarios creados por este usuario");
define("_AUDIT_USERS_", "Hacer auditoría de los usuarios");
define("_AUDIT_USERS_DESC_", "Los usuarios han sido encontrados en la base de datos
de Thyme, pero no están relacionados con el modulo de autenticación corriente.<br>Todos los datos de los usuarios
han sido nombrados con el uid del usuario no presente.");

define("_CALENDAR_PUBLISHER_", "Publicador de calendarios");
define("_CAL_USER_GUEST_", "Cuenta de invitado");
define("_CAL_PUBLISH_GUEST_DISABLED_", "El publicador de calendarios no funcionara 
si
        la cuenta de invitado no está habilitada.  Por favor habilite este tipo de cuenta en la
        <a href='index.php?module=users' 
class='"._CAL_CSS_ULINE_."'>sección de</a> usuarios.");


####################################
# GENERAL ACTIONS AND RESPONSES
####################################
define("_ADD_", "Añadir");
define("_NEW_EVENT_", "Nuevo evento");
define("_REMOVE_", "Remover");
define("_UPDATE_", "Actualizar");
define("_NEXT_", "Proximo");
define("_PREV_", "Anterior");
define("_DELETE_", "Borrar");
define("_SAVE_", "Guardar");
define("_TEST_", "Probar");
define("_UPDATE_NOW_", "Actualizar ahora");
define("_SAVE_ADD_", "Guardar y añadir otro");
define("_CANCEL_", "Cancelar");
define("_BROWSE_", "buscar y echar un vistazo");
define("_NONE_", "Ninguno");
define("_RESET_", "Reset");
define("_CLEAR_ALL_", "deseleccionar todo");
define("_CHECK_ALL_", "escoger todos");
define("_EDIT_", "Editar");
define("_CLOSE_", "Cerrar");
define("_SHOW_", "Mostrar");
define("_HIDE_", "Esconder");
define("_ENABLE_", "Permitir o abilitar");
define("_DISABLE_", "Disabilitar");
define("_MOVE_", "Mover");
define("_UP_", "Hacia arriba");
define("_DOWN_", "Hacia abajo");
define("_ENABLED_", "Habilitado");
define("_CONFIGURE_", "Configurar");
define("_ACCEPT_", "Aceptar");
define("_REJECT_", "Rechazar");
define("_OK_", "OK - Bien");
define("_FAILED_", "FRACASO");
define("_CHANGE_", "Cambiar");
define("_SORT_BY_", "Organizar de acuerdo a");
define("_SEARCH_", "Buscar");
define("_FORCE_", "Forzar");
define("_AUTODETECT_", "Auto detectar");
define("_RESET_PASS_", "Cambiar la clave (password)");
define("_NEW_PASS_", "Nueva clave (password)");
define("_RETYPE_", "Vuelva a escribir la clave");
define("_UPDATED_", "Se actualizo");
define("_SUBMITTED_", "Enviado");
define("_LOGIN_", "Entrar");
define("_USERNAME_", "Nombre de usuario");
define("_PASSWORD_", "Clave");
define("_LOGOUT_", "Salir");
define("_OPTIONS_", "Opciones");
define("_ADMIN_", "Administrar");
define("_BAD_PASS_", "La clave o nombre de usuario son incorrectos.");
define("_YES_", "Si");
define("_NO_", "No");
define("_VALUE_", "Valor (Value)");
define("_CUSTOM_", "modificar para requisitos particulares");
define("_DEFAULT_", "modelo preestablecido (Default)");

######################
# ATTACHMENTS
######################
define("_ATTACHMENTS_", "Archivos adjuntos");
define("_ATTACH_DETACH_", "Separar, apartar");
define("_ATTACH_DELETE_", "Borrar");
define("_ATTACHMENT_TOO_BIG_", "El archivo adjunto es demasiado grande");
define("_DOWNLOAD_ZIP_", "Iniciar descarga del archivo Zip");
define("_UPDATE_ATTACHMENTS_", "Actualizar archivos adjuntos(attachments)");

define("_BYTES_", "b");
define("_KBYTES_", "KB");
define("_MBYTES_", "MB");


#################
# EVENT LIST VIEW
#################
define("_ALL_", "Todos");
define("_UPCOMING_", "Proximos");
define("_PAST_", "Pasados");

define("_SHOWING_", "mostrando");
define("_OF_", "de");
define("_FIRST_", "Primero(a)");
define("_LAST_", "Ultimo(a)");
define("_SHOW_TYPE_", "Categoría");

define("_LIST_SIZE_", "Tamaño de la lista");

define("_ARE_NO_EVENTS_", "No hay eventos para mostrar.");

define("_EVENTS_CONTAINING_", "Eventos que contengan"); # used in event search

define("_ARE_YOU_SURE_DELETE_EVENTS_", "¿Está seguro(a) que quiere borrar
estos eventos?");
define("_DELETE_REPEATING_WARNING_", "
   Usted ha escogido borrar uno o mas eventos que se repiten.<br>
   Todas las instancias (pasadas o futuras)de estos eventos seran borrados! ");

define("_UNCHECK_NO_DELETE_", "Deseleccione cualquier evento que no desee borrar:");
define("_DELETE_CHECKED_", "Borrar instancias seleccionadas");

define("_RETURN_", "Regresar");
define("_ERROR_", "Error!");

######################
# EVENT EDIT/ADD/VIEW
######################
define("_GENERAL_", "General");

define("_ORGANIZER_", "Organizador");

define("_URL_", "URL");

define("_REPEATING_", "Evento se repite");

define("_LOCATION_", "Lugar");

define("_APPLY_TO_", "Aplicar cambios en");
define("_ALL_DATES_", "todas las fechas");
define("_THIS_DATE_", "ésta fecha solamente");

define("_RESET_INSTANCE_", "Devolver ésta instancia a su estado original");

define("_MAP_", "Mapa");

define("_STARTED_", "Iniciado");

# e.g. Overrides event Weekly Meeting on 2004-2-34
define("_OVERRIDE_EVNT_ON_", "Invalidar (override) eventos %s en %s");

# e.g. Warning: the event Event Title has an invalid repeating rule
define("_INVALID_RRULE_", "Advertencia: el evento %s tiene una regla repetitiva inválida.");

define("_MAX_CHARS_", "número máximo de caracteres");
define("_EVENT_INFO_", "Información del evento");
define("_TITLE_", "Título");
define("_NOTES_", "Apuntes");

define("_CHECK_FOR_CONFLICTS_", "comprobar si hay conflictos");

define("_THIS_EVENT_ALLDAY_", "Este es un evento que dura <b>todo el día</b>.");
define("_STARTS_AT_", "Inicia a la(s)");
define("_DURATION_", "Duración");

define("_FLAG_", "Marcar");
define("_FLAG_THIS_", "Marcar este evento");
define("_IS_FLAGGED_", "este evento ha sido marcado");

# e.g. 10 days ago
define("_AGO_", "hace");

define("_REPEATING_NO_", "Este evento no se repite.");
define("_REPEATING_REPEAT_", "Repetir");
define("_REPEATING_SELECTED_", "díass seleccionados");
define("_REPEATING_EVERY1_", "cada");

define("_REPEAT_ON_", "Repetir en el");
define("_REPEAT_ON1_", "primer");
define("_REPEAT_ON2_", "segundo");
define("_REPEAT_ON3_", "tercero");
define("_REPEAT_ON4_", "cuarto");
define("_REPEAT_ON5_", "quinto");
define("_REPEAT_ONL_", "ultimo");
define("_REPEAT_ON_OF_", "del mes, cada");

define("_SIMPLE_", "Simple");
define("_ADVANCED_","Avanzado");

define("_YEARLY_", "Anual");
define("_MONTHLY_", "Mensual");
define("_WEEKLY_", "Semanal");
define("_DAILY_", "Diario");
define("_EASTER_", "Pascua");
define("_EASTER_YEARLY_", "En Pascua cada año");

define("_MONTH_DAYS_", "día(s) del mes");
define("_FROM_LAST_", "del ultimo/anterior");

define("_WEEKDAYS_", "días de la semana");

define("_YEARLY_NOTES_", "El mes y día preestablecidos son basados en la fecha
de inicio si usted no los ha definido.");


define("_SPECIFIC_OCCURRENCES_", "Ocurrencias/instancias específicas");

define("_STARTING_ON_", "Inicia");

define("_BEFORE_", "Antes");
define("_AFTER_", "Despues");

define("_EXCLUDE_DATES_", "Excluir fechas");

define("_CONFIRM_EVNT_RPT_CHANGE_", "Usted está cambiando la regla de repetición
o las fechas de este evento.\n
Todas las excepciones asociadas con este evento repetitivo seran borradas. ¿Está seguro(a) que quiere
hacer esto?\n");


define("_END_DATE_", "Fecha de finalización");
define("_END_DATE_NO_", "No tiene fecha de finalización");
define("_END_DATE_UNTIL_", "Hasta");
define("_END_DATE_AFTER_", "Finalizar despues");
define("_OCCURRENCES_", "ocurrencias");

define("_ADDRESS_", "Dirección");
define("_ADDRESS_1_", "Calle");
define("_ADDRESS_2_", "Ciudad, codigo postal");

define("_PHONE_", "Telefono");
define("_ICON_", "Icono");

#####################
# MODULES
#####################
define("_NAVBAR_", "Barra de navegación");
define("_MODULE_", "Modulo");
define("_MODULES_", "Modulos");
define("_TODAY_LINK_", "El vinculo (link) del día de hoy");
define("_MINI_CAL_", "Mini Calendario");
define("_CALENDAR_LINKS_", "Vinculos del calendario");
define("_IMAGE_BROWSER_", "Navegar/buscar imagenes");
define("_QUICK_ADD_EVNT_", "Añadir evento rapidamente");
define("_GOTO_DATE_", "Ir a la fecha");
define("_SEARCH_EVENTS_", "Buscar eventos");
define("_EVENT_FILTER_", "Categoría");
define("_COLOR_LEGEND_", "Leyenda");

##################
# SYNC
##################

define("_SYNC_", "Syncronizar");
define("_IMPORT_", "Importar");
define("_EXPORT_", "Exportar");
define("_IMPORT_FROM_", "Importar de");
define("_EXPORT_TO_", "Exportar a");
define("_SYNC_DUPLICATES_", "Si se encuantran instancias duplicadas");
define("_IGNORE_DUPLICATES_", "Ignorar instancias duplicadas");
define("_OVERWRITE_EXISTING_EVENT_", "Ignorar y guardar sobre este evento existente");
define("_CREATE_NEW_EVENT_", "Crear un nuevo evento");
define("_IMPORT_AS_", "Importar en la categoría");
define("_EVENTS_IMPORTED_", "Los eventos fueron importados");
define("_SYNC_IMPORT_ERROR_", "Error: hubo un error al procesarse el archivo que usted trataba de importar.");
define("_HTML_", "HTML");
define("_PLAINTEXT_", "texto simple");
define("_ICAL_", "iCalendar (.ics)");
define("_QUIRKS_MODE_", "Modalidad Quirks");
define("_PERMISSION_DENIED_", "Permiso negado: Usted no es el dueno/creador de este evento ni administrador del calendario.");
define("_FULL_SYNC_", "Sincronización total");
define("_FULL_SYNC_DESC_", "Borrar los eventos que existen en Thyme pero que no son hallados en el archivo importado.");

#########################
# CSS AND STYLE
#########################
define("_COLOR_", "Color");

define("_STYLE_", "Estilo");

define("_PREVIEW_", "Revisar (Preview)");
define("_SAMPLE_", "Ver ejemplo (Sample)");

define("_BACKGROUND_COLOR_", "Color de fondo");
define("_FONT_COLOR_", "Color de la fuente");
define("_FONT_SIZE_", "Tamaño de la fuente");

define("_FONT_STYLE_", "Estilo de la fuente");
define("_BOLD_", "negrilla");
define("_ITALICS_", "italico");
define("_UNDERLINE_", "subrayado");

define("_FONT_FAMILY_", "Familia de fuente");
define("_FONT_FAMILY_DESC_", "por ejemplo: Tahoma, 'Sans Serif', Arial");

define("_UNDERLINE_LINKS_", "Subrayar vinculos");
define("_NEVER_", "Nunca");
define("_ALWAYS_", "Siempre");
define("_HOVER_", "Sobre vinculos (Hover)");
define("_BORDER_COLOR_", "Color de bordes");
define("_TIME_FONT_COLOR_", "Color de la fuente de la hora");
define("_TITLE_FONT_COLOR_", "Color de la fuente del título");
define("_TITLE_FONT_STYLE_", "Estilo de la fuente del título");

#########################
# CALENDAR PUBLISHER
#########################
if(@constant("_CAL_DOING_PUBLISHER_")) { # <- leave this line alone

define("_MINI_MONTH_", "Mini Mes");

define("_SET_DATE_CURRENT_", "hacer coincidir con la fecha actual");
define("_EDITABLE_", "Editable");
define("_STATIC_", "Estático");
define("_STATIC_DESC_", "el calendario no contiene vinculos o enlaces 
que cambian la fecha o el modo de visualizar.");
define("_HIL_DAY_", "Resaltar/Marcar día");
define("_HIL_WEEK_", "Resaltar/Marcar Semana");

define("_APPLY_CSS_FROM_", "Aplicar el estilo de");
define("_NO_CSS_", "ninguno");
define("_CSS_EDITOR_", "Editor de estilo");

define("_LANGUAGE_", "Idioma");
define("_EURO_DATE_", "Fechas en formato europeo");
define("_EURO_DATE_DESC_", "Las fechas en formato europeo son día, mes y año donde se pueda");

define("_HEADER_", "Título/Encabezado");
define("_WEEKDAY_HEADER_", "Título para el día de la semana");

define("_NORMAL_DAYS_", "días normales");
define("_DAYS_NOT_IN_MONTH_", "días que no están en el mes");
define("_HIGHLIGHTED_DAYS_", "días resaltados/marcados");

define("_NORMAL_EVENTS_", "Eventos normales");
define("_FLAGGED_EVENTS_", "Eventos marcados");

define("_SHOW_EVENTS_", "Mostrar eventos");


define("_EVENT_LINKS_", "Vinculos/Enlaces del evento");

define("_EVENT_LINK_URL_", "Dirección web (URL) del vinculo del evento");

define("_EVENT_LINK_URL_DESC_", "

        Esta dirección web (url) sera filtrada a traves de un query string que contiene
        <font class='"._CAL_CSS_HIL_."'>eid</font> y <font 
class='"._CAL_CSS_HIL_."'>la instancia</font>.<br>

        <b>eid</b> es el identificador del evento y<b>la instancia</b> es la fecha en formato
        <b>año, mes y día</b>.<br>Estos son anotados por<font 
class='"._CAL_CSS_HIL_."'>%eid</font>
        y <font class='"._CAL_CSS_HIL_."'>%inst</font>.<br><br>

        Por ejemplo http://mysite.com/sales/view_sale.php?eid=%eid&instance=%inst 
se mostraría asi:<br>

        http://mysite.com/sales/view_sale.php?<font
		class='"._CAL_CSS_HIL_."'>eid</font>=56&<font
		class='"._CAL_CSS_HIL_."'>instancia</font>=2005-10-26<br><br>

        Lea el manual de referencia y/o el tutorial en la pagina web de Thyme
		para encontrar mas información acerca del uso de estos parametros. ");


define("_SHOW_HEADER_", "Mostrar título/encabezado");
define("_ALIGN_HEADER_TEXT_", "Alinear el texto del título/encabezdo");
define("_CENTER_", "Centrar");
define("_HEADER_TEXT_", "Texto del título/encabezado");

define("_HEADER_TEXT_DESC_","

   (E.g. <font class='"._CAL_CSS_HIL_."'>Cumpleaños en %month</font>)<br>
        <font size=1><i>Deje en blanco para usar el
        título/encabezado pre establecido. Las otras variable incluyen los siguientes %weekday, %mday, %mon y 
%year.</i></font> ");


define("_SHOW_HEADER_LINKS_", "Mostrar los vinculos del título/encabezado");

define("_NEXT_LINK_", "'Proximo' vinculo");
define("_PREV_LINK_", "vinculo 'anterior'");

define("_IMG_URL_", "Dirección web (url) de la imagen");

define("_HEADER_LINKS_", "Vinculos del título/encabezado");

define("_IMG_URL_DESC_", "
        Este texto puede ser '<<' o una dirección web (url) de una imagen<br>
        (por ejemplo <font
        
class='"._CAL_CSS_HIL_."'>http://www.myserver.com/imagenes/proximo.gif</font>)<br><font
        size=1><i>Deje estos en blanco para usar la imagen pre establecida
		del tema seleccionado.</i></font> ");


define("_DAY_VIEW_", "Visualizar por día");

define("_MONTH_VIEWS_", "Visualizar por mes");

define("_SHOW_WEEKS_DESC_", "Nota, un mini calendario nunca 
mostrara el número de las semanas");

define("_ROW_HEIGHT_", "Altura de la fila");
define("_ROW_HEIGHT_DESC_", "La altura pre establecida es '90' para el mes, '0' para un mini calendario");

define("_LIMIT_WEEKDAY_NAMES_", "Limitar los días de la semana a");
define("_CHARS_", "caracteres");

define("_EXCLUDE_MONTH_DAYS_", "Excluir los días que no están en el mes");

define("_MINI_MONTH_DATE_URL_", "Dirección web (url) del la fecha del mini calendario");

define("_MINI_MONTH_DATE_URL_DESC_", "
        Este es el vinculo (link) que usted obtendraq cuando presione en el día del mini mes.
		Esto reemplaza los siguientes strings:<br>

        %d = el número del día (day)<br>
        %m = el número del mes (month)<br>
        %y = el número del año (year)<br>

        <br><br>

        Por ejemplo: http://www.myserver.com/page.php?day=%d&month=%m&year=%y<br>
        daría como resultado
        <font 
class='"._CAL_CSS_HIL_."'>http://www.myserver.com/page.php?day=23&month=11&year=2004</font>

        <br>o usted podría usar alguna función de JavaScript.<br>

        Por ejemplo <font 
class='"._CAL_CSS_HIL_."'>javascript:myFunction(%y,%m,%d)</font><br><br>

        Lo pre establecido es un vinculo (link) a la pagina actual que establece:<br>
        m = %m<br>
        d = %d<br>
        y = %y<br>

        Por ejemplo <font 
class='"._CAL_CSS_HIL_."'>index.php?d=23&m=11&y=2004</font><br><br>
        Vea el manual de referencia y/o el tutorial en la pagina web de Thyme para aprender el uso de estos.
        </font>");


define("_GENERATED_CODE_", "Generar codigo");

define("_BASE_PATH_DESC_", "trayectoria (path) basico de thyme escrito con raya vertical acostada");
define("_BASE_URL_DESC_", "Dirección base de pagina web (url) de thyme con raya vertical acostada");

} # </ CALENDAR PUBLISHER SECTION > <- leave this line alone


######################
#
### RSS FEED MODULES
#
#####################
define("_RSS_FEED_MODULES_", "Modulos de alimentación RSS (RSS Feed Modules)");
define("_RSS_", "Alimentaciones RSS (RSS Feeds)");
define("_UPDATE_INTERVAL_", "intervalos de actualización");
define("_ARE_YOU_SURE_DELETE_RSSMOD_", "¿Está seguro(a) que desea borrar este modulo de RSS?");
define("_AUTHOR_", "Autor");

# scrolling
define("_SCROLLING_","Movimiento en sentido vertical");
define("_OVERFLOW_", "Desbordamiento (overflow)");
define("_SCROLLBAR_", "Barra de movimiento");
define("_AUTOSCROLL_", "Movimiento en sentido vertical automatico");


# this will keep us from needing to
# have these defined when not looking
# at options
#####################################
if(@constant("_CAL_DOING_OPTS_")) { # <- leave this line alone

######################
# OPTION STRINGS
######################

define("_DEFAULT_VIEW_", "Visualización pre establecida");

define("_DEFAULT_CALENDAR_", "Calendario pre establecido");

define("_TIME_INTERVALS_", "intervalos de hora");

define("_EVNT_SIZE_", "Tamaño del evento");
define("_SMALLER_", "Mas pequeno");
define("_SMALLEST_", "Pequenisimo");
define("_EVNT_COLLAPSE_", "Colapsar, minimizar eventos (cuando ves el mes)");
define("_EVNT_COLLAPSE_DESC_", "Colapsar, minimizar los títulos largos del evento.");
define("_EVNT_TYPE_NAME_", "Mostrar los nombres de categorías de los eventos");
define("_EVNT_POPUP_", "Ventanita (popup) que se abre del evento");
define("_EVNT_POPUP_DESC_", "Mostrar los eventos en una nueva ventana.");
define("_EVNT_NOTES_POPUP_", "Ventanita que estalla (popup) con los apuntes del evento");
define("_EVNT_NOTES_POPUP_DESC_", "Flotar (hover) su raton (mouse) encima de los eventos para ver sus apuntes.");

define("_POSITION_", "Posición");

define("_SHOW_WEEKS_", "Mostrar los números de la semana");

define("_WEEK_START_", "La semana inicia en");
define("_WORK_HOURS_", "Horas de trabajo");
define("_WORK_HOURS_START_", "inician a las");
define("_WORK_HOURS_END_", "terminan a las");

define("_HOUR_FORMAT_", "Formato de hora");
define("_HOUR_FORMAT_12_", "12 horas");
define("_HOUR_FORMAT_24_", "24 horas");

define("_LOCALE_", "Local");

define("_NAV_BAR_LOC_", "Barra de navegación");
define("_RIGHT_", "Derecha");
define("_LEFT_", "Izquierda");

define("_TIMEZONE_", "Zona de tiempo");
define("_DST_", "Ahorración de horas del día (Daylight Saving Time)");
define("_STARTS_", "Inicia");
define("_ENDS_", "Termina");

define("_IN_", "en");
define("_ON_", "Encender (on)");
define("_OFF_", "apagar (off)");

define("_THEME_", "Tema");

##########################
# CONTACT OPTIONS
##########################
define("_CONTACT_OPTS_", "Opciones de Contacto");
define("_PRIMARY_", "Primario");
define("_FORMAT_", "Formato");

##########################
# SUBSCRIPTIONS
##########################
define("_SUBSCRIPTIONS_", "Subscripciones");
define("_SUBSCRIPTIONS_DESC_", "Enviar correos electrónicos a los calendarios.");

######################
# NOTIFICATIONS
#####################
define("_NOTIFICATIONS_", "Notificaciones");
define("_NOTIFICATIONS_DESC_", "Filtros de notificación para eventos nuevos y actualizados.");

define("_TITLE_CONTAINS_", "El título contiene");
# event X has been updated on calendar Y
define("_UPDATED_ON_", "fecha en la que ha sido actualizado(a)");
# event X has been added to calendar Y
define("_ADDED_TO_", "ha sido añadido(a) en o a");

#####################
# DST STRINGS
#####################
define("_DST_OPTS1_", "Africa / Egipto");
define("_DST_OPTS2_", "Africa / Namibia");
define("_DST_OPTS3_", "Asia / USSR (anteriormente) - casi todos los estados");
define("_DST_OPTS4_", "Asia / Iraq");
define("_DST_OPTS5_", "Asia / Libano, Kirgizstan");
define("_DST_OPTS6_", "Asia / Siria");
define("_DST_OPTS7_", "Australasia / Australia, Gales del sur");
define("_DST_OPTS8_", "Australasia / Australia - Tasmania");
define("_DST_OPTS9_", "Australasia / Nueva Zelandia, Chatham");
define("_DST_OPTS10_", "Australasia / Tonga");
define("_DST_OPTS11_", "Europa / Union Europea, Reino Unido, Groenlandia");
define("_DST_OPTS12_", "Europa / Rusia");
define("_DST_OPTS13_", "América del norte / Estados Unidos, Canadá, Mexico");
define("_DST_OPTS14_", "América del norte / Cuba");
define("_DST_OPTS15_", "Sur América / Chile");
define("_DST_OPTS16_", "Sur América / Paraguay");
define("_DST_OPTS17_", "Sur América / Falklands");

####################
# TIMEZONE STRINGS
####################
define("_GMT_PLUS_0.0_","GMT +00:00 Reino Unido, Irlanda, Portugal, Africa Occidental ");
define("_GMT_PLUS_0.5_","GMT +00:30 ");
define("_GMT_PLUS_1.0_","GMT +01:00 Europa occidental, Africa central");
define("_GMT_PLUS_1.5_","GMT +01:30 ");
define("_GMT_PLUS_2.0_","GMT +02:00 Europa Oriental, oriental Africa");
define("_GMT_PLUS_2.5_","GMT +02:30 ");
define("_GMT_PLUS_3.0_","GMT +03:00 Rusia, Arabia Saudita");
define("_GMT_PLUS_3.5_","GMT +03:30 ");
define("_GMT_PLUS_4.0_","GMT +04:00 Arabian");
define("_GMT_PLUS_4.5_","GMT +04:30 ");
define("_GMT_PLUS_5.0_","GMT +05:00 Oeste Asia, Pakistan");
define("_GMT_PLUS_5.5_","GMT +05:30 India");
define("_GMT_PLUS_6.0_","GMT +06:00 Central Asia");
define("_GMT_PLUS_6.5_","GMT +06:30 ");
define("_GMT_PLUS_7.0_","GMT +07:00 Bangkok, Hanoi, Jakarta");
define("_GMT_PLUS_7.5_","GMT +07:30 ");
define("_GMT_PLUS_8.0_","GMT +08:00 China, Singapore, Taiwan");
define("_GMT_PLUS_8.5_","GMT +08:30 ");
define("_GMT_PLUS_9.0_","GMT +09:00 Korea, Japon");
define("_GMT_PLUS_9.5_","GMT +09:30 Central Australia");
define("_GMT_PLUS_10.0_","GMT +10:00 oriental Australia");
define("_GMT_PLUS_10.5_","GMT +10:30 ");
define("_GMT_PLUS_11.0_","GMT +11:00 Central pacífico");
define("_GMT_PLUS_11.5_","GMT +11:30 ");
define("_GMT_PLUS_12.0_","GMT +12:00 Fiji, New Zelandia");
define("_GMT_MINUS_12.0_","GMT -12:00 Dateline ");
define("_GMT_MINUS_11.5_","GMT -11:30 ");
define("_GMT_MINUS_11.0_","GMT -11:00 Samoa");
define("_GMT_MINUS_10.5_","GMT -10:30 ");
define("_GMT_MINUS_10.0_","GMT -10:00 Hawaiian");
define("_GMT_MINUS_9.5_","GMT -09:30 ");
define("_GMT_MINUS_9.0_","GMT -09:00 Alaska/Pitcairn islas");
define("_GMT_MINUS_8.5_","GMT -08:30 ");
define("_GMT_MINUS_8.0_","GMT -08:00 Estados Unidos/Canadá/pacífico");
define("_GMT_MINUS_7.5_","GMT -07:30 ");
define("_GMT_MINUS_7.0_","GMT -07:00 Estados Unidos/Canadá/Mountain");
define("_GMT_MINUS_6.5_","GMT -06:30 ");
define("_GMT_MINUS_6.0_","GMT -06:00 Estados Unidos/Canadá/Central");
define("_GMT_MINUS_5.5_","GMT -05:30 ");
define("_GMT_MINUS_5.0_","GMT -05:00 Estados Unidos/Canadá/oriental, Colombia, Peru");
define("_GMT_MINUS_4.5_","GMT -04:30 ");
define("_GMT_MINUS_4.0_","GMT -04:00 Bolivia, occidental Brazil, Chile, 
Atlántico");
define("_GMT_MINUS_3.5_","GMT -03:30 Newfoundland");
define("_GMT_MINUS_3.0_","GMT -03:00 Argentina, oriental Brazil, Greenland");
define("_GMT_MINUS_2.5_","GMT -02:30 ");
define("_GMT_MINUS_2.0_","GMT -02:00 Mid-Atlántico");
define("_GMT_MINUS_1.5_","GMT -01:30 ");
define("_GMT_MINUS_1.0_","GMT -01:00 Azores/oriental Atlántico");
define("_GMT_MINUS_0.5_","GMT -00:30 ");

}

##########################
# ERRORS AND WARNINGS
##########################
define("_WARNING_ATTACH_", "Advertencia: El directorio de archivos adjuntos %s no existe o no es editable");
define("_WARNING_RSS_", "Advertencia: El deposito de alimentación de RSS %s no es editable.");
define("_WARNING_INSTALL_", "Advertencia: %s todavia existe. Por favor quite este archivo.");
define("_WARNING_LICENSE_", "Advertencia: La licencia de Thyme se caducara en %s días.");


# date formats
#
# see PHP's documentation for
# 'date' for more format options
# some are:
# j = day of the month
# n = month number
# Y = full year number
#################################
define("_DATE_INT_FULL_", "j-n-Y");
define("_DATE_INT_NOYR_", "j-n"); # only used in Week view


# alphabet chars
####################
global $_cal_alphabet;
$_cal_alphabet = 
array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P',
   'Q','R','S','T','U','V','W','X','Y','Z');

#####################
# "AUTOMAGIC"
#####################
# weekdays
global $_cal_weekdays, $_cal_weekdays_abbr, $_cal_months, $_cal_months_abbr;

$_cal_weekdays or $_cal_weekdays = array(
  "Domingo",
  "Lunes",
  "Martes",
  "Miércoles",
  "Jueves",
  "Viernes",
  "Sábado");

$_cal_months or $_cal_months = array(1 =>
  "Enero",
  "Febrero",
  "Marzo",
  "Abril",
  "Mayo",
  "Junio",
  "Julio",
  "Agosto",
  "Septiembre",
  "Octubre",
  "Noviembre",
  "Diciembre");


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
