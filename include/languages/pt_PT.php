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

define("_CHARSET_", "utf-8");

define("_LANG_NAME_", "Portugues (PT)");


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
define("_GLOBAL_VIEWS_", "Vista Global");

define("_ALLOW_EVERYONE_VIEW_", "Permita que todos vejam todos os calendários nesta vista independentemente das suas listas de membro");

define("_HIDE_VIEW_FROM_GUESTS_", "Esconda esta vista dos utilizadores convidados");

define("_REQUEST_NOTIFY_OWNER_", "Notifique o proprietário do calendário, de pedidos pendentes");

define("_ALL_CALENDARS_", "Todas as vistas dos calendários");

#################################
#
### INSTALLER 
#
#################################

# some of these will not be used until 2.0
define("_INSTALLER_", "Actualizações");
define("_PACKAGE_", "Pacote");
define("_INSTALL_", "Instalar");
define("_INVALID_PACKAGE_", "o ficheiro que você esta a enviar não é um pacote válido do Thyme.");
define("_INSTALLED_MODULES_", "Módulos Instalados");
define("_UNINSTALL_", "Desinstalar");
define("_LOCAL_FILE_","Ficheiro Local");
define("_UPDATES_", "Actualizar");
define("_AVAILABLE_UPDATES_", "Actualizações Disponíveis");
define("_CHECK_FOR_UPDATES_", "Verificar se existe Actualizações");
define("_LAST_CHECKED_ON_", "Ultima verificação em"); # e.g. last checked on 1/2/2007
define("_FILE_", "Ficheiro");
define("_WRITABLE_", "Escrita");
define("_REFRESH_", "Actualizar");
define("_INVALID_DOWNLOAD_", "Download inválido. Não é possivel actualizar o ficheiro.");
define("_UNABLE_TO_BACKUP_", "Não é possivel efectuar o backup (copia) do ficheiro.");
define("_UPDATES_AVAIL_", "%s actualizações disponiveis"); # %s will be replaced w/# of updates available

############################
#
### NEW USER DEFINITIONS
#
###########################
define("_REGISTERED_USERS_", "Utilizadores registados");
define("_PUBLIC_", "Público");
define("_PUBLIC_ACCESS_", "Acesso Público");

#############################
#
### MULTIPLE REMINDERS
#
#############################
define("_BEFORE_EVENT_MULTI_", "antes deste evento");
define("_USER_CAN_NOT_VIEW_", "%s não tem acesso para ver este calendário.");
define("_ALLOW_CONFIGURE_REMINDERS_", "Reserve %s para configurar lembretes do evento para todos os utilizadores.");
define("_CALENDAR_ADMINS_", "Administradores do Calendário");
define("_EVENT_OWNER_", "Proprietário do evento");
define("_SITE_ADMINS_", "Administrador do site");
define("_NO_ONE_", "Ninguém");

###############################
#
## CONFIGURABLE JOB INTERVALS
#
###############################

define("_REMIND_AT_LEAST_", "Ao menos");
define("_SCHEDULED_TASK_", "Tarefa Programada");
define("_NO_SCHEDULED_TASK_", "A tarefa programada do Thyme não esta configurada para funcionar");
define("_SCHEDULED_TASK_CONFIGURED_", "A tarefa programada do Thyme esta configurada para funcionar");
define("_PHP_CLI_", "Localização do PHP CLI");

###################################
#
### CUSTOMIZE SITE
#
###################################
define("_CUSTOMIZE_SITE_", "Alterar o Site");
define("_SITE_NAME_", "Nome do Site");
define("_SITE_THEME_", "Tema do Site");
define("_SITE_THEME_DESC_", "ajustar a nenhum, para permitir que os utilizadores escolham o seu próprio tema");

# use exact HTML tags, they will be displayed correctly
# when printed
define("_SITE_HEADER_", "Corpo do Site");
define("_SITE_HEADER_DESC_", "Depois <body> tag");

define("_SITE_FOOTER_", "Rodapé do Site");
define("_SITE_FOOTER_DESC_", "Antes </body> tag");

define("_SITE_HEAD_", "Cabeçalho do Site");
define("_SITE_HEAD_DESC_", "Entre <head> </head> tags.");


####################################
#
### LICENSE KEY
#
####################################
define("_ENTER_LICENSE_KEY_", "Introduzir o número da licença");
define("_LICENSE_KEY_", "Número da licença");
define("_LICENSE_KEY_ACCEPTED_", "Número da licença aceite");
define("_INVALID_LICENSE_KEY_", "O Número da licença introduzido não é valido para este site");

####################################
#
### EVENT REQUEST DESCRIPTION
#
####################################
define("_REQUEST_MODE_VIEW_ONLY_", "Os utilizadores somente de vizualização podem submeter pedidos de eventos. Utilizadores Normais podem adicionar eventos directamente.");
define("_REQUEST_MODE_NORMAL_", "Os utilizadores somente de vizualização, podem só visualizar o calendário. Utilizadores Normais podem submeter pedidos de eventos.");

#####################################
#
### TELL A FRIEND FOR GUEST E-MAILS
#
######################################
define("_TELL_A_FRIEND_", "Envie a um amigo");

define("_YOUR_NAME_", "Seu nome");
define("_YOUR_EMAIL_", "Seu e-mail");

define("_YOUR_FRIENDS_NAME_","O nome do seu amigo");
define("_YOUR_FRIENDS_EMAIL_","O e-mail do seu amigo");

define("_EMAIL_EVENT_DISPLAYED_","O evento será visualizado abaixo da sua mensagem.");

define("_ALLOW_GUEST_USERS_EMAIL_", "Permitir o utilizador convidado nos eventos de e-mail.");

define("_DISABLE_SITE_ADDR_BOOK_", "Desactivar o livro de endereços do site para não-admins");

define("_EMAIL_TO_MULTIPLE_", "Separar varios endereços com uma vírgula.");

# MISC
########
define("_HELP_", "Ajuda");
define("_WARNING_DIR_NOT_WRITABLE_", "Atenção: O directorio %s não é de escrita.");
define("_WARNING_FILE_NOT_WRITABLE_", "Atenção: o ficheiro %s não é de escrita.");
define("_DOWNLOAD_", "Download");
define("_HIDE_QUICK_ADD_", "Esconder a caixa de adicionar evento rapidamente.");
define("_FORCE_DEFAULT_OPTS_", "Forçar as opções por defeito para todos os utilizadores. Ajuste em Administrar - Opções predefínidas.");
define("_NO_GUEST_TIMEZONE_", "Não permitir que o utilizador convidado mude o timezone.");
define("_NUMBER_SYMBOL_", '#');
define("_DISABLE_WYSIWYG_EDITOR_", "Desactivar o editor WYSIWYG para as notas do evento.");
define("_SHOW_CALENDAR_NAMES_", "Mostrar nome do evento no calendario, quando mostra os nomes das categorias dos eventos. 
	É ajustado em opções de um utilizador.");
define("_MISC_", "Varios");
define("_THEME_POPUPS_", "Aplique o tema, ás janelas de notas do evento.");

define("_PUBLIIC_", "Público");
define("_REGISTERED_USERS_", "Utilizadores Registados");

define("_NEW_", "Novo");

define("_CATEGORY_EDIT_DESC_", "Para editar a categoria, clique sobre o título");

define("_ARE_YOU_SURE_DELETE_", "Tem a certeza que deseja apagar isto %s?");

########## END NEW TRANSLATIONS #################



################################
# EDIT / VIEW / POST CALENDARS
################################
define("_CALENDARS_", "Calendários");
define("_OWNER_", "Proprietário");
define("_ARE_YOU_SURE_DELETE_CALENDAR_", "Tem a certeza que deseja apagar este calendário?");

define("_COLOR_BY_", "Eventos da cor por");
define("_BY_OWNER_", "Organizador do evento");
define("_BY_CATEGORY_", "Categoria do evento");
define("_BY_CALENDAR_", "Calendário");

define("_MODE_", "Modalidade");

define("_ALLOW_MULTI_CATS_", "Permite multiplas categorias para eventos");

define("_REMEMBER_LOCATIONS_", "Recordar lugares");

define("_STRICT_EVENT_SECURITY_", "Segurança estrita do evento");
define("_STRICT_EVENT_SECURITY_DESC_", "Apenas o organizador/criador do evento 
ou o administrador do calendário pode modificar ou apagar eventos existentes");

define("_REMOTE_ACCESS_", "Acesso Remoto");
define("_REMOTE_ACCESS_DESC_", "O acesso remoto permite aos utilizadores subscreverem a este 
calendário remotamente por meio de programas como o Mozilla Sunbird, Windates, o Apple iCal. 
Isto permitirá também o uso de RSS atravês de leitores de RSS (RssReader, Shrook..) provedores 
de conteúdo (Yahoo!, MSN..), e ferramentas de administração de conteúdo (PHP-Nuke, Mambo..).");

define("_ENABLE_REMOTE_ACCESS_UPD_", "Permitir actualizações por acesso remoto. Esta opção permite utilizadores autorizados 
a fazerem actualizações a este calendário usando un programa externo de terceiros.");

define("_REMOTE_ACCESS_DESC_USERS_", "Se o Utilizador convidado não é membro deste calendário, 
as pessoas que tentem entrar neste calendário necessitam de um nome de utilizador e uma palavra-passe. Uma vez autorizada, 
o acesso é concedido ou negado de acordo com a configuração dos Membros.");

define("_SYNDICATION_", "Indicação");

define("_EDIT_EVENT_TYPES_", "Configurar categorias");

define("_EVENT_TYPES_", "Categorias");

define("_EVENT_TYPES_DESC_", "

       Não seleccione nenhuma categoria para poder usar todas as categorias<BR><BR>");

define("_MULTI_SELECT_WIN_","
       Windows: Para des seleccionar um idem ou para seleccionar<br>varios, 
idems não-concorrentes pressione<br>a tecla ctrl ao seleccioná-lo.");

define("_REALLY_DELETE_EVENT_TYPE_", "Tem a certeza que deseja apagar esta categoria?"); # question
define("_DELETE_ALL_IN_CATEGORY_", "Apagar todos os eventos desta categoria");

define("_VIEWS_NO_ACTION_", "Esta acção não se pode realizar neste modo de visualização.
Por favor seleccione um calendário.");

define("_VIEW_INVALID_CAL_", "Esta visualizando um calendário do qual não é membro(a). Os
eventos deste calendário não se podem mostrar.");

define("_DESCRIPTION_", "Descrição");
define("_DETAILS_", "detalhes");
define("_PUBLISH_", "publicar");
define("_PUBLISH_DESC_", "Publicar este calendário a um servidor de web remoto ou preste serviços como
<a class='". _CAL_CSS_BODY_ ." ". _CAL_CSS_ULINE_."' target=_blank
href='http://icalx.com'>iCal Exchange</a>");
define("_SERVER_RESPONSE_", "Resposta do servidor");



######################
# EMAIL EVENT
######################
define("_EMAIL_EVENT_", "Enviar evento por correio electrónico");
define("_EMAIL_TO_", "para");
define("_SEND_EMAIL_", "Enviar");
define("_SUBJECT_", "Assunto");
define("_MESSAGE_", "Mensagem");
# e.g. The event has been sent to abcdefg@alphabet.com
define("_EMAIL_SENT_TO_", "Este evento foi enviado a");
define("_EMAIL_NO_ADDR_WARNING_", "Atenção: Você não configurou um endereço
de correio electrónico na secção das Opções do Contacto. Seu correio 
electrónico aparecera como enviado de". @constant("_CAL_MAIL_FROM_"));

######################
# EMAIL SETTINGS
######################
define("_MAIL_PROG_PHP_", "Função de correio electrónico de PHP");
define("_MAIL_PROG_CMD_", "Programa de correio local (sendmail, qmail, etc..)");
define("_MAIL_PROG_SERVER_", "Servidor SMTP");

define("_MAIL_PROGRAM_", "Enviar correio electrónico através deste programa");

define("_MAIL_FROM_EMAIL_", "Endereço do correio electrónico");

define("_MAIL_PATH_", "Caminho local para enviar correio electrónico (local mailer path)");
define("_MAIL_AUTH_", "Autenticação SMTP");

define("_MAIL_AUTH_USER_", "Nome de utilizador SMTP");
define("_MAIL_AUTH_PASS_", "Palavra-passe do SMTP");

define("_MAIL_SERVER_", "Servidor SMTP");
define("_MAIL_SERVER_PORT_", "Porta do Servidor (Server Port)");

##########################
# ATTACHMENT SETTINGS
##########################
define("_ALLOW_ATTACHMENTS_", "Permitir anexar ficheiros");
define("_ATTACHMENTS_PATH_", "Localização dos ficheiros");

#############################
# GROUPS AND USERS
#############################
define("_USERS_", "Utilizadores");
define("_GROUPS_", "Grupos");
define("_EVERYONE_", "Todos");
define("_SUPER_USER_", "Super utilizador");

define("_MEMBERS_", "Membros");
define("_MEMBERS_OF_", "Membros de");

define("_NAME_", "Nome");
define("_EMAIL_", "Correio electrónico");

define("_ACCESS_LVL_", "Nível de acesso");
define("_ROLE_", "Nivel");
define("_READ_ONLY_", "Só de Leitura");
define("_NORMAL_","Normal");

define("_ARE_YOU_SURE_DELETE_GROUP_", "Tem a certeza que deseja eliminar este grupo?");
define("_GROUPS_SAVE_ATLEAST_1_MEMBER_", "Cada grupo deve ter pelo menos 1 membro(a). A lista dos membros não foi guardada.");

# displayed as form field must begin with a character. E.g.
# Username must begin with a character.
define("_MUST_BEGIN_WITH_CHAR_", "deve iniciar com um caráter.");

######################
# REMINDERS
######################
define("_REMINDERS_", "Lambretes");
define("_BEFORE_EVENT_","antes deste evento, em");

define("_WILL_OCCUR_IN_", "Ocorrerá em"); # event x will occur in 30 minutes



###########################
# EVENT REQUESTS
############################
define("_REQUEST_", "Pedido de evento");
define("_REQUESTS_", "Pedidos de eventos");
define("_REQUEST_ACCEPTED_", "O pedido do evento foi aceite.");
define("_REQUEST_REJECTED_", "O pedido do evento foi rejeitado.");

define("_NOTIFY_REQUESTOR_", "Notificar o requerente");
define("_REQUEST_HAS_NOTIFY_", "O requerente solicita a notificação.");
define("_REQUESTS_NO_PENDING_", "Não há pedidos pendentes.");
define("_REQUEST_NOTIFY_EMAIL_", "notifique-me de pedidos pendentes em");
define("_REQUEST_MSG_PRE_", "Mensagem mostrada aos utilizadores depois do pedido ser enviado.");
define("_REQUEST_MSG_POST_", "Mensagem mostrada aos utilizadores depois do pedido ser enviado.");
define("_REQUEST_NOTES_", "Notas adicionais do pedido");
define("_REQUEST_NOTIFY_STATUS_", "Notifique-me do estado deste pedido em");

define("_CONTACT_", "Contacto");

# You have a pending event request on calendar: CALENDAR TITLE
define("_PENDING_REQUEST_", "Você tem um pedido pendente do evento no calendário:");


#################
# DATE  ITEMS
#################
define("_CALENDAR_", "Calendário");

define("_MONTH_", "Mês");
define("_MONTHS_", "Meses");

define("_DAY_","Dia");
define("_DAYS_", "Dias");

define("_YEAR_", "Ano");
define("_YEARS_", "Anos");

define("_WEEK_", "Semana");

# abreviated week
define("_WEEK_ABBR_", "Semana");

define("_WEEKS_", "Semanas");

define("_HOUR_", "Hora");
define("_HR_", "hr");
define("_HOURS_", "horas");
define("_HRS_", "hrs");

define("_MINS_", "mins");
define("_MINUTES_", "minutos");

define("_DATE_", "Data");
define("_TIME_", "Hora");

define("_AM_", "am");
define("_AM_SHORT_", "a");
define("_PM_", "pm");
define("_PM_SHORT_", "pm");

# VIEWS
define("_TODAY_", "Hoje");
define("_THIS_WEEK_", "Esta semana");
define("_THIS_MONTH_", "Este mês");

##################
# MISC
##################
define("_EVENT_", "Evento");
define("_EVENTS_", "Eventos");
define("_VIEW_", "Visualizar");

# VIEW AS A NOUN
define("_VIEW_NOUN_", "Visualizar");

define("_PRINTABLE_VIEW_", "Vista para Impressão");

define("_ALLDAY_", "Todo o dia");

define("_CAL_CALL_FOR_TIMES_", "Contacte-nos para as horas");
define("_CAL_CALL_FOR_TIMES_MIN_", "(*)");

define("_TYPE_","Tipo");
define("_EVENT_TYPE_", "Categoria");

define("_WIDTH_", "Largura");

define("_COLORS_", "Cores");

# list seperator. Note space after comma
define("_LIST_SEP_",", ");

###########################
# ADMIN PAGE
###########################
define("_GLOBAL_SETTINGS_", "Configurações Gerais");
define("_EDIT_DEFAULT_OPTS_", "Opções predefínidas");
define("_PASS_MUST_MATCH_", "As palavras-passe que introduziu são invalidas");
define("_EMPTY_PASSWORD_", "Não esta defínida a palavra-passe para \"\"!");
define("_ARE_YOU_SURE_DELETE_USER_", "Tem a certeza que quer apagar este utilizador?");
define("_DELETE_USERS_EVENTS_", "Apagar todos os eventos criados por este utilizador.");
define("_CALENDARS_OWNED_", "Estes são os calendários criados por este utilizador");
define("_AUDIT_USERS_", "Auditoria aos utilizadores");
define("_AUDIT_USERS_DESC_", "Utilizadores encontrados na base de dados
do Thyme, e que não estão relacionados com o modulo de autenticação corrente.<br>Todos os dados dos utilizadores
foram ajustados ao uid do utilizador em falta.");

define("_CALENDAR_PUBLISHER_", "Publicador de calendarios");
define("_CAL_USER_GUEST_", "Conta de convidado");
define("_CAL_PUBLISH_GUEST_DISABLED_", "O publicador de calendarios não funcionara 
        se a conta de convidado não estiver activada.  Por favor active esta conta na secção dos utilizadores.");      


####################################
# GENERAL ACTIONS AND RESPONSES
####################################
define("_ADD_", "Adicionar");
define("_NEW_EVENT_", "Novo evento");
define("_REMOVE_", "Remover");
define("_UPDATE_", "Actualizar");
define("_NEXT_", "Proximo");
define("_PREV_", "Anterior");
define("_DELETE_", "Apagar");
define("_SAVE_", "Guardar");
define("_TEST_", "Testar");
define("_UPDATE_NOW_", "Actualizar agora");
define("_SAVE_ADD_", "Guarde e adicione outro");
define("_CANCEL_", "Cancelar");
define("_BROWSE_", "Navegar/Procurar imagens");
define("_NONE_", "Nenhum");
define("_RESET_", "reiniciar");
define("_CLEAR_ALL_", "limpar todos");
define("_CHECK_ALL_", "selecionar todos");
define("_EDIT_", "Editar");
define("_CLOSE_", "Fechar");
define("_SHOW_", "Mostrar");
define("_HIDE_", "Esconder");
define("_ENABLE_", "Activar");
define("_DISABLE_", "Desactivar");
define("_MOVE_", "Mover");
define("_UP_", "Para cima");
define("_DOWN_", "Para baixo");
define("_ENABLED_", "Activo");
define("_CONFIGURE_", "Configurar");
define("_ACCEPT_", "Aceitar");
define("_REJECT_", "Rejeitar");
define("_OK_", "OK");
define("_FAILED_", "FALHA");
define("_CHANGE_", "Modificar");
define("_SORT_BY_", "Organizar de acordo a");
define("_SEARCH_", "Procurar");
define("_FORCE_", "Forçar");
define("_AUTODETECT_", "Auto detectar");
define("_RESET_PASS_", "Apagar a Palavra-passe");
define("_NEW_PASS_", "Nova Palavra-passe");
define("_RETYPE_", "Repetir e escrever a Palavra-passe");
define("_UPDATED_", "Em actualização");
define("_SUBMITTED_", "Submetido");
define("_LOGIN_", "Iniciar Sessão");
define("_USERNAME_", "Nome de usuário");
define("_PASSWORD_", "Palavra-passe");
define("_LOGOUT_", "Terminar Sessão");
define("_OPTIONS_", "Opções");
define("_ADMIN_", "Administrar");
define("_BAD_PASS_", "A palavra-passe ou o nome do usuário estão incorrectos.");
define("_YES_", "Sim");
define("_NO_", "Não");
define("_VALUE_", "Valor");
define("_CUSTOM_", "Modificar para requisitos particulares");
define("_DEFAULT_", "por defeito (Default)");

######################
# ATTACHMENTS
######################
define("_ATTACHMENTS_", "Anexos");
define("_ATTACH_DETACH_", "Destaque");
define("_ATTACH_DELETE_", "Apagar");
define("_ATTACHMENT_TOO_BIG_", "O anexo é demasiado grande");
define("_DOWNLOAD_ZIP_", "Iniciar descarga do ficheiro Zip");
define("_UPDATE_ATTACHMENTS_", "Actualizar anexos");

define("_BYTES_", "b");
define("_KBYTES_", "KB");
define("_MBYTES_", "MB");


#################
# EVENT LIST VIEW
#################
define("_ALL_", "Todo");
define("_UPCOMING_", "Proximo");
define("_PAST_", "Passado");

define("_SHOWING_", "mostrando");
define("_OF_", "de");
define("_FIRST_", "Primeiro(a)");
define("_LAST_", "Ultimo(a)");
define("_SHOW_TYPE_", "Categoria");

define("_LIST_SIZE_", "Tamanho da lista");

define("_ARE_NO_EVENTS_", "Não há eventos para mostrar.");

define("_EVENTS_CONTAINING_", "Eventos que contenham"); # used in event search

define("_ARE_YOU_SURE_DELETE_EVENTS_", "Tem a certeza que deseja apagar estes eventos?");
define("_DELETE_REPEATING_WARNING_", "
   Você escolheu apagar um ou mais eventos que se repetem.<br>
   Todos os registos (passados e futuros) destes eventos seram apagados! ");

define("_UNCHECK_NO_DELETE_", "Des seleccione os eventos que não deseja apagar:");
define("_DELETE_CHECKED_", "Apagar o que esta seleccionado");

define("_RETURN_", "Regressar");
define("_ERROR_", "Erro!");

######################
# EVENT EDIT/ADD/VIEW
######################
define("_GENERAL_", "Geral");

define("_ORGANIZER_", "Organizador");

define("_URL_", "URL");

define("_REPEATING_", "repetir");

define("_LOCATION_", "Posição");

define("_APPLY_TO_", "Aplique mudanças a");
define("_ALL_DATES_", "todas as datas");
define("_THIS_DATE_", "esta data somente");

define("_RESET_INSTANCE_", "Restaurar estes registos ao seu estado original");

define("_MAP_", "Mapa");

define("_STARTED_", "Iniciado");

# e.g. Overrides event Weekly Meeting on 2004-2-34
define("_OVERRIDE_EVNT_ON_", "Cancela o eventos %s em %s");

# e.g. Warning: the event Event Title has an invalid repeating rule
define("_INVALID_RRULE_", "Atenção: O evento %s têm uma regra repetida inválida.");

define("_MAX_CHARS_", "número máximo de carateres");
define("_EVENT_INFO_", "Informação do evento");
define("_TITLE_", "Titulo");
define("_NOTES_", "Notas");

define("_CHECK_FOR_CONFLICTS_", "comprovar se existe conflitos");

define("_THIS_EVENT_ALLDAY_", "Este é um evento que dura <b>todo o dia</b>.");
define("_STARTS_AT_", "Inicia as");
define("_DURATION_", "Duração");

define("_FLAG_", "Marcar");
define("_FLAG_THIS_", "Marcar este evento");
define("_IS_FLAGGED_", "este evento foi marcado");

# e.g. 10 days ago
define("_AGO_", "há");

define("_REPEATING_NO_", "Este evento não se repete.");
define("_REPEATING_REPEAT_", "Repetir");
define("_REPEATING_SELECTED_", "dias seleccionados");
define("_REPEATING_EVERY1_", "cada");

define("_REPEAT_ON_", "Repetir no");
define("_REPEAT_ON1_", "primeiro");
define("_REPEAT_ON2_", "segundo");
define("_REPEAT_ON3_", "terceiro");
define("_REPEAT_ON4_", "quarto");
define("_REPEAT_ON5_", "quinto");
define("_REPEAT_ONL_", "último");
define("_REPEAT_ON_OF_", "do mês, cada");

define("_SIMPLE_", "Simples");
define("_ADVANCED_","Avançado");

define("_YEARLY_", "Anual");
define("_MONTHLY_", "Mensal");
define("_WEEKLY_", "Semanal");
define("_DAILY_", "Diário");
define("_EASTER_", "Páscoa");
define("_EASTER_YEARLY_", "Páscoa anual");

define("_MONTH_DAYS_", "dia(s) do mês");
define("_FROM_LAST_", "do último");

define("_WEEKDAYS_", "dias da semana");

define("_YEARLY_NOTES_", "O mês e o dia preestabelecido são baseados na data
de inicio, se nenhum forem selecionados.");


define("_SPECIFIC_OCCURRENCES_", "Ocorrências Específicas");

define("_STARTING_ON_", "Inicia em");

define("_BEFORE_", "Antes");
define("_AFTER_", "Depois");

define("_EXCLUDE_DATES_", "Apagar data");

define("_CONFIRM_EVNT_RPT_CHANGE_", "Você esta modificando a regra de repetição ou as datas deste evento.\n
Todas as excepções associadas com este evento repetitivo seram apagadas. Tem a certeza que você quer fazer isto?\n");


define("_END_DATE_", "Fim da Data");
define("_END_DATE_NO_", "Não tem Data Fechada");
define("_END_DATE_UNTIL_", "Ate");
define("_END_DATE_AFTER_", "Finalizar depois");
define("_OCCURRENCES_", "ocorrências");

define("_ADDRESS_", "Morada");
define("_ADDRESS_1_", "Rua");
define("_ADDRESS_2_", "Cidade, Código Postal");

define("_PHONE_", "Telefone");
define("_ICON_", "Icone");

#####################
# MODULES
#####################
define("_NAVBAR_", "Barra de navegação");
define("_MODULE_", "Modulo");
define("_MODULES_", "Modulos");
define("_TODAY_LINK_", "Ligação do dia");
define("_MINI_CAL_", "Mini Calendário");
define("_CALENDAR_LINKS_", "Ligações do calendário");
define("_IMAGE_BROWSER_", "Navegar/Procurar imagens");
define("_QUICK_ADD_EVNT_", "Adicionar evento rapidamente");
define("_GOTO_DATE_", "Ir para o Dia");
define("_SEARCH_EVENTS_", "Procurar eventos");
define("_EVENT_FILTER_", "Categoria");
define("_COLOR_LEGEND_", "Legenda");

##################
# SYNC
##################

define("_SYNC_", "Sincronizar");
define("_IMPORT_", "Importar");
define("_EXPORT_", "Exportar");
define("_IMPORT_FROM_", "Importar de");
define("_EXPORT_TO_", "Exportar para");
define("_SYNC_DUPLICATES_", "Se registos duplicadas são encontrados");
define("_IGNORE_DUPLICATES_", "Ignorar registos duplicadas");
define("_OVERWRITE_EXISTING_EVENT_", "Ignorar e guardar sobre este evento existente");
define("_CREATE_NEW_EVENT_", "Criar un novo evento");
define("_IMPORT_AS_", "Importar para a categoria");
define("_EVENTS_IMPORTED_", "Os eventos foram importados");
define("_SYNC_IMPORT_ERROR_", "Error: existe um erro ao processar o ficheiro que esta a importar.");
define("_HTML_", "HTML");
define("_PLAINTEXT_", "texto simple");
define("_ICAL_", "iCalendar (.ics)");
define("_QUIRKS_MODE_", "Modalidade Quirks");
define("_PERMISSION_DENIED_", "Permissão negada: Você não é o organizador/criador deste evento 
nem o administrador do calendario.");
define("_FULL_SYNC_", "Sincronização total");
define("_FULL_SYNC_DESC_", "Apagar os eventos que existem no Thyme mas não se encontram no ficheiro importado.");

#########################
# CSS AND STYLE
#########################
define("_COLOR_", "Cor");

define("_STYLE_", "Estilo");

define("_PREVIEW_", "Visualizar");
define("_SAMPLE_", "Ver exemplo");

define("_BACKGROUND_COLOR_", "Cor de fundo");
define("_FONT_COLOR_", "Cor da fonte");
define("_FONT_SIZE_", "Tamanho da fonte");

define("_FONT_STYLE_", "Estilo da fonte");
define("_BOLD_", "negrito");
define("_ITALICS_", "italico");
define("_UNDERLINE_", "sublinhado");

define("_FONT_FAMILY_", "Familia da fonte");
define("_FONT_FAMILY_DESC_", "por exemplo: Tahoma, 'Sans Serif', Arial");

define("_UNDERLINE_LINKS_", "Sublinhar ligações");
define("_NEVER_", "Nunca");
define("_ALWAYS_", "Sempre");
define("_HOVER_", "Hover");
define("_BORDER_COLOR_", "Color da borda");
define("_TIME_FONT_COLOR_", "Cor da fonte da hora");
define("_TITLE_FONT_COLOR_", "Cor da fonte do titulo");
define("_TITLE_FONT_STYLE_", "Estilo da fonte do titulo");

#########################
# CALENDAR PUBLISHER
#########################
if(@constant("_CAL_DOING_PUBLISHER_")) { # <- leave this line alone

define("_MINI_MONTH_", "Mini Mês");

define("_SET_DATE_CURRENT_", "ajuste á data actual");
define("_EDITABLE_", "Editavel");
define("_STATIC_", "Estático");
define("_STATIC_DESC_", "o calendário não contêm ligações que alterem a data na visualização.");
define("_HIL_DAY_", "Destacar dia");
define("_HIL_WEEK_", "Destacar Semana");

define("_APPLY_CSS_FROM_", "Aplicar o estilo de");
define("_NO_CSS_", "nenhum");
define("_CSS_EDITOR_", "Editor de estilo");

define("_LANGUAGE_", "Idioma");
define("_EURO_DATE_", "Datas em formato europeu");
define("_EURO_DATE_DESC_", "As datas em formato europeu são dia, mês e ano");

define("_HEADER_", "Titulo/Cabeçalho");
define("_WEEKDAY_HEADER_", "Titulo/Cabeçalho para o dia da semana");

define("_NORMAL_DAYS_", "dias normais");
define("_DAYS_NOT_IN_MONTH_", "dias que não estão no mês");
define("_HIGHLIGHTED_DAYS_", "dias destacados");

define("_NORMAL_EVENTS_", "Eventos normais");
define("_FLAGGED_EVENTS_", "Eventos marcados");

define("_SHOW_EVENTS_", "Mostrar eventos");


define("_EVENT_LINKS_", "Ligação dos eventos");

define("_EVENT_LINK_URL_", "Ligação web (URL) do evento");

define("_EVENT_LINK_URL_DESC_", "

        Esta ligação web (url) sera filtrada através de um query string que contêm
        <font class='"._CAL_CSS_HIL_."'>eid</font> e <font class='"._CAL_CSS_HIL_."'>a instancia</font>.<br>

        <b>eid</b> é o identificador do evento <b>e o registo</b> da data em formato
        <b>ano, mês e dia</b>.<br>Estes são anotados por<font class='"._CAL_CSS_HIL_."'>%eid</font>
        e <font class='"._CAL_CSS_HIL_."'>%inst</font>.<br><br>

        Por exemplo http://mysite.com/sales/view_sale.php?eid=%eid&instance=%inst se mostrara assim:<br>

        http://mysite.com/sales/view_sale.php?<font
		class='"._CAL_CSS_HIL_."'>eid</font>=56&<font
		class='"._CAL_CSS_HIL_."'>registo</font>=2005-10-26<br><br>

        Veja o manual e/o tutorial na pagina web do Thyme para mais 
        informações de como usar este. ");


define("_SHOW_HEADER_", "Mostrar cabeçalho");
define("_ALIGN_HEADER_TEXT_", "Alinhar o texto do cabeçalho");
define("_CENTER_", "Centro");
define("_HEADER_TEXT_", "Texto do Cabeçalho");

define("_HEADER_TEXT_DESC_","

   (Por exemplo <font class='"._CAL_CSS_HIL_."'>Aniversario em %month</font>)<br>
        <font size=1><i>Deixe em branco para usar 
        o cabeçalho preestabelecido. Outras variaveis incluem %weekday, %mday, %mon e %year.</i></font> ");


define("_SHOW_HEADER_LINKS_", "Mostrar as ligações do cabeçalho");

define("_NEXT_LINK_", "'Proxima' ligação");
define("_PREV_LINK_", "Ligação 'anterior'");

define("_IMG_URL_", "Ligação (url) da imagem");

define("_HEADER_LINKS_", "Ligação do cabeçalho");

define("_IMG_URL_DESC_", "
        Este texto pode ser '<<' ou uma ligação (url) a uma imagem<br>
        (por exemplo: <font      
        class='"._CAL_CSS_HIL_."'>http://www.myserver.com/imagens/proximo.gif</font>)<br><font
        size=1><i>Deixe em branco para usar a imagem preestabelecida
		do tema selecionado.</i></font> ");


define("_DAY_VIEW_", "Mostrar por dia");

define("_MONTH_VIEWS_", "Mostrar por mês");

define("_SHOW_WEEKS_DESC_", "Nota, um mini calendário nunca mostrara o numero de semanas");

define("_ROW_HEIGHT_", "Altura da celula");
define("_ROW_HEIGHT_DESC_", "A altura preestabelecida é '90' para o mês, '0' para um mini calendário");

define("_LIMIT_WEEKDAY_NAMES_", "Limitar os dias da semana a");
define("_CHARS_", "caracteres");

define("_EXCLUDE_MONTH_DAYS_", "Excluir os dias que não estão no mês");

define("_MINI_MONTH_DATE_URL_", "mini ligação(Link) da data do mês");

define("_MINI_MONTH_DATE_URL_DESC_", "
        Esta ligação (link) ao cliquar no dia do mini mês do calendário o redireccionará.
		Este substitui os seguintes strings:<br>

        %d = o numero do dia (day)<br>
        %m = o numero do mês (month)<br>
        %y = o numero do ano (year)<br>

        <br><br>

        Por exemplo: http://www.myserver.com/page.php?day=%d&month=%m&year=%y<br>
        dar como resultado
        <font class='"._CAL_CSS_HIL_."'>http://www.myserver.com/page.php?day=23&month=11&year=2004</font>

        <br>Ou poderá usar alguna função do JavaScript.<br>

        Por exemplo <font class='"._CAL_CSS_HIL_."'>javascript:myFunction(%y,%m,%d)</font><br><br>

        O preestabelecido é uma ligação (link) á pagina actual:<br>
        m = %m<br>
        d = %d<br>
        y = %y<br>

        Por exemplo <font class='"._CAL_CSS_HIL_."'>index.php?d=23&m=11&y=2004</font><br><br>
        Veja o manual e/o tutorial na pagina web do Thyme para mais 
        informações de como usar este.");


define("_GENERATED_CODE_", "Gerar codigo");

define("_BASE_PATH_DESC_", "Direcção principal do thyme");
define("_BASE_URL_DESC_", "Direcção principal da pagina web (url) do thyme");

} # </ CALENDAR PUBLISHER SECTION > <- leave this line alone


######################
#
### RSS FEED MODULES
#
#####################
define("_RSS_FEED_MODULES_", "Modulos de alimentação RSS (RSS Feed Modules)");
define("_RSS_", "Alimentação RSS (RSS Feeds)");
define("_UPDATE_INTERVAL_", "intervalo actualizado");
define("_ARE_YOU_SURE_DELETE_RSSMOD_", "Tem a certeza que deseja apagar este modulo RSS?");
define("_AUTHOR_", "Autor");

# scrolling
define("_SCROLLING_","Movimento em sentido vertical");
define("_OVERFLOW_", "Excesso (overflow)");
define("_SCROLLBAR_", "Barra de movimento");
define("_AUTOSCROLL_", "Movimento em sentido vertical automático");


# this will keep us from needing to
# have these defined when not looking
# at options
#####################################
if(@constant("_CAL_DOING_OPTS_")) { # <- leave this line alone

######################
# OPTION STRINGS
######################

define("_DEFAULT_VIEW_", "Visualização por defeito");

define("_DEFAULT_CALENDAR_", "Calendário por defeito");

define("_TIME_INTERVALS_", "intervalos de tempo");

define("_EVNT_SIZE_", "Tamanho do evento");
define("_SMALLER_", "Pequeno");
define("_SMALLEST_", "Pequenissimo");
define("_EVNT_COLLAPSE_", "Colapso, minimizar eventos (vista do mês)");
define("_EVNT_COLLAPSE_DESC_", "Colapso, minimizar os titulos longos do evento.");
define("_EVNT_TYPE_NAME_", "Mostra os nomes das categorias dos eventos");
define("_EVNT_POPUP_", "Janela com evento");
define("_EVNT_POPUP_DESC_", "Mostra os eventos numa nova janela.");
define("_EVNT_NOTES_POPUP_", "Janela com a nota do evento");
define("_EVNT_NOTES_POPUP_DESC_", "Passe o rato(mouse) por cima dos eventos 
para ver as suas notas.");

define("_POSITION_", "Posição");

define("_SHOW_WEEKS_", "Mostrar os numeros da semana");

define("_WEEK_START_", "A semana inicia em");
define("_WORK_HOURS_", "Horas de trabalho");
define("_WORK_HOURS_START_", "iniciam as");
define("_WORK_HOURS_END_", "terminam as");

define("_HOUR_FORMAT_", "Formato da hora");
define("_HOUR_FORMAT_12_", "12 hr");
define("_HOUR_FORMAT_24_", "24 hr");

define("_NAV_BAR_LOC_", "Barra de navegação");
define("_RIGHT_", "Direita");
define("_LEFT_", "Esquerda");

define("_TIMEZONE_", "Zona de tempo");
define("_DST_", "Daylight Saving Time");
define("_STARTS_", "Inicia");
define("_ENDS_", "Termina");

define("_IN_", "em");
define("_ON_", "ligar (on)");
define("_OFF_", "desligado (off)");

define("_THEME_", "Tema");

##########################
# CONTACT OPTIONS
##########################
define("_CONTACT_OPTS_", "Opções do Contacto");
define("_PRIMARY_", "Primário");
define("_FORMAT_", "Formato");

##########################
# SUBSCRIPTIONS
##########################
define("_SUBSCRIPTIONS_", "Subscrições");
define("_SUBSCRIPTIONS_DESC_", "Enviar correio electrónico aos calendários.");

######################
# NOTIFICATIONS
#####################
define("_NOTIFICATIONS_", "Notificações");
define("_NOTIFICATIONS_DESC_", "Filtros de notificação para eventos novos e actualizados.");

define("_TITLE_CONTAINS_", "O titulo comtêm");
# event X has been updated on calendar Y
define("_UPDATED_ON_", "foi actualizado(a)");
# event X has been added to calendar Y
define("_ADDED_TO_", "foi adicionado(a) a");

#####################
# DST STRINGS
#####################
define("_DST_OPTS1_", "Africa / Egipto");
define("_DST_OPTS2_", "Africa / Namibia");
define("_DST_OPTS3_", "Asia / USSR (anteriormente) - com todos os estados");
define("_DST_OPTS4_", "Asia / Iraque");
define("_DST_OPTS5_", "Asia / Libano, Kirgizstan");
define("_DST_OPTS6_", "Asia / Siria");
define("_DST_OPTS7_", "Australasia / Australia, Novo Gales do sul");
define("_DST_OPTS8_", "Australasia / Australia - Tasmania");
define("_DST_OPTS9_", "Australasia / Nova Zelandia, Chatham");
define("_DST_OPTS10_", "Australasia / Tonga");
define("_DST_OPTS11_", "Europa / União Europeia, Reino Unido, Groenlandia");
define("_DST_OPTS12_", "Europa / Russia");
define("_DST_OPTS13_", "America do norte / Estados Unidos, Canada, Mexico");
define("_DST_OPTS14_", "America do norte / Cuba");
define("_DST_OPTS15_", "Sul America / Chile");
define("_DST_OPTS16_", "Sul America / Paraguay");
define("_DST_OPTS17_", "Sul America / Falklands");

####################
# TIMEZONE STRINGS
####################
define("_GMT_PLUS_0.0_","GMT +00:00 Reino Unido, Irlanda, Portugal, Africa Ocidental ");
define("_GMT_PLUS_0.5_","GMT +00:30 ");
define("_GMT_PLUS_1.0_","GMT +01:00 Europa Ocidental, Africa Central");
define("_GMT_PLUS_1.5_","GMT +01:30 ");
define("_GMT_PLUS_2.0_","GMT +02:00 Europa Oriental, Africa Oriental");
define("_GMT_PLUS_2.5_","GMT +02:30 ");
define("_GMT_PLUS_3.0_","GMT +03:00 Russia, Arabia Saudita");
define("_GMT_PLUS_3.5_","GMT +03:30 ");
define("_GMT_PLUS_4.0_","GMT +04:00 Arabia");
define("_GMT_PLUS_4.5_","GMT +04:30 ");
define("_GMT_PLUS_5.0_","GMT +05:00 Asia Oeste, Pakistão");
define("_GMT_PLUS_5.5_","GMT +05:30 India");
define("_GMT_PLUS_6.0_","GMT +06:00 Asia Central");
define("_GMT_PLUS_6.5_","GMT +06:30 ");
define("_GMT_PLUS_7.0_","GMT +07:00 Bangekoke, Hanoi, Jakarta");
define("_GMT_PLUS_7.5_","GMT +07:30 ");
define("_GMT_PLUS_8.0_","GMT +08:00 China, Singapora, Taiwan");
define("_GMT_PLUS_8.5_","GMT +08:30 ");
define("_GMT_PLUS_9.0_","GMT +09:00 Koreia, Japão");
define("_GMT_PLUS_9.5_","GMT +09:30 Australia Central");
define("_GMT_PLUS_10.0_","GMT +10:00 Australia Oriental");
define("_GMT_PLUS_10.5_","GMT +10:30 ");
define("_GMT_PLUS_11.0_","GMT +11:00 Pacifico Central");
define("_GMT_PLUS_11.5_","GMT +11:30 ");
define("_GMT_PLUS_12.0_","GMT +12:00 Fiji, Nova Zelandia");
define("_GMT_MINUS_12.0_","GMT -12:00 Dateline ");
define("_GMT_MINUS_11.5_","GMT -11:30 ");
define("_GMT_MINUS_11.0_","GMT -11:00 Samoa");
define("_GMT_MINUS_10.5_","GMT -10:30 ");
define("_GMT_MINUS_10.0_","GMT -10:00 Hawai");
define("_GMT_MINUS_9.5_","GMT -09:30 ");
define("_GMT_MINUS_9.0_","GMT -09:00 Alaska/Ilhas Pitcairn");
define("_GMT_MINUS_8.5_","GMT -08:30 ");
define("_GMT_MINUS_8.0_","GMT -08:00 Estados Unidos/Canada/pacifico");
define("_GMT_MINUS_7.5_","GMT -07:30 ");
define("_GMT_MINUS_7.0_","GMT -07:00 Estados Unidos/Canada/Montanha");
define("_GMT_MINUS_6.5_","GMT -06:30 ");
define("_GMT_MINUS_6.0_","GMT -06:00 Estados Unidos/Canada/Central");
define("_GMT_MINUS_5.5_","GMT -05:30 ");
define("_GMT_MINUS_5.0_","GMT -05:00 Estados Unidos/Canada/oriental, Colombia, Peru");
define("_GMT_MINUS_4.5_","GMT -04:30 ");
define("_GMT_MINUS_4.0_","GMT -04:00 Bolivia, occidental Brazil, Chile, Atlantico");
define("_GMT_MINUS_3.5_","GMT -03:30 Newfoundland");
define("_GMT_MINUS_3.0_","GMT -03:00 Argentina, oriental Brazil, Greenland");
define("_GMT_MINUS_2.5_","GMT -02:30 ");
define("_GMT_MINUS_2.0_","GMT -02:00 Mid-Atlantico");
define("_GMT_MINUS_1.5_","GMT -01:30 ");
define("_GMT_MINUS_1.0_","GMT -01:00 Açores/oriental Atlantico");
define("_GMT_MINUS_0.5_","GMT -00:30 ");

}

##########################
# ERRORS AND WARNINGS
##########################
define("_WARNING_ATTACH_", "Atenção: o directorio dos anexos %s não existe ou não tem premissões de escrita");
define("_WARNING_RSS_", "Atenção: O deposito da alimentação de RSS %s não tem premissão de escrita.");
define("_WARNING_INSTALL_", "Atenção: %s já existe. Por favor remova este ficheiro.");
define("_WARNING_LICENSE_", "Atenção: A licencia de Thyme expira dentro de %s dias.");


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
$_cal_alphabet = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P',
   'Q','R','S','T','U','V','W','X','Y','Z','Ç');

#####################
# "AUTOMAGIC"
#####################
# weekdays
global $_cal_weekdays, $_cal_weekdays_abbr, $_cal_months, $_cal_months_abbr;

$_cal_weekdays or $_cal_weekdays = array(
  "Domingo",
  "Segunda",
  "Terça",
  "Quarta",
  "Quinta",
  "Sexta",
  "Sábado");

$_cal_months or $_cal_months = array(1 =>
  "Janeiro",
  "Fevereiro",
  "Março",
  "Abril",
  "Maio",
  "Junho",
  "Julho",
  "Agosto",
  "Setembro",
  "Outubro",
  "Novembro",
  "Dezembro");


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
