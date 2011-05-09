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

define("_CHARSET_", "UTF-8");

define("_LANG_NAME_", "Português (BR)");


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
define("_GLOBAL_VIEWS_", "Visualizações Globais");

define("_ALLOW_EVERYONE_VIEW_", "Permitir que todos vejam todos os calendários neste modo de visualização independentemente de suas listas de membros ");

define("_HIDE_VIEW_FROM_GUESTS_", "Ocultar esta visualização de usuários visitantes");

define("_REQUEST_NOTIFY_OWNER_", "Notificar o proprietário do calendário de requisições pendentes");

define("_ALL_CALENDARS_", "Todos os modos de visualização dos calendários");

#################################
#
### INSTALLER 
#
#################################

# some of these will not be used until 2.0
define("_INSTALLER_", "Assistente de Instalação");
define("_PACKAGE_", "Pacote");
define("_INSTALL_", "Instalar");
define("_INVALID_PACKAGE_", " O arquivo que você enviou não é um pacote Thyme válido.");
define("_INSTALLED_MODULES_", "Módulos Instalados");
define("_UNINSTALL_", "Desinstalar");
define("_LOCAL_FILE_","Arquivos Locais");
define("_UPDATES_", "Atualizações");
define("_AVAILABLE_UPDATES_", "Atualizações Disponíveis");
define("_CHECK_FOR_UPDATES_", "Verificar Atualizações");
define("_LAST_CHECKED_ON_", "Última vez verificado em"); # e.g. last checked on 1/2/2007
define("_FILE_", "Arquivo");
define("_WRITABLE_", "Gravável");
define("_REFRESH_", "Atualizar");
define("_INVALID_DOWNLOAD_", "Download inválido. Não foi possível atualizar este arquivo.");
define("_UNABLE_TO_BACKUP_", "Não foi possível fazer o backup do arquivo.");
define("_UPDATES_AVAIL_", "%s Atualizações Disponíveis"); # %s will be replaced w/# of updates available

############################
#
### NEW USER DEFINITIONS
#
###########################
define("_REGISTERED_USERS_", "Usuários Registrados");
define("_PUBLIC_", "Público");
define("_PUBLIC_ACCESS_", "Acesso Público");

#############################
#
### MULTIPLE REMINDERS
#
#############################
define("_BEFORE_EVENT_MULTI_", "Antes deste evento");
define("_USER_CAN_NOT_VIEW_", "%s Não tem acesso para visualizar este calendário.");
define("_ALLOW_CONFIGURE_REMINDERS_", "Permitir que %s configurem lembretes de eventos para todos os usuários.");
define("_CALENDAR_ADMINS_", "Administradores de Calendários");
define("_EVENT_OWNER_", "Proprietário de Evento");
define("_SITE_ADMINS_", "Administradores do Site");
define("_NO_ONE_", "Ninguém");

###############################
#
## CONFIGURABLE JOB INTERVALS
#
###############################

define("_REMIND_AT_LEAST_", "Ao menos");
define("_SCHEDULED_TASK_", "Tarefa agendada");
define("_NO_SCHEDULED_TASK_", " A tarefa agendada pelo Thyme não está configurada para ser executada");
define("_SCHEDULED_TASK_CONFIGURED_", " A tarefa agendada pelo Thyme está configurada para ser executada a cada");
define("_PHP_CLI_", "Localização do PHP CLI ");

###################################
#
### CUSTOMIZE SITE
#
###################################
define("_CUSTOMIZE_SITE_", "Personalizar Site");
define("_SITE_NAME_", "Nome do Site");
define("_SITE_THEME_", "Tema do Site");
define("_SITE_THEME_DESC_", " Ajustado para nenhum permite que os usuários escolham seus próprios temas");

# use exact HTML tags, they will be displayed correctly
# when printed
define("_SITE_HEADER_", "Corpo do Site");
define("_SITE_HEADER_DESC_", "Depois do tag <body>");

define("_SITE_FOOTER_", "Rodapé do Site");
define("_SITE_FOOTER_DESC_", "Antes do tag </body>");

define("_SITE_HEAD_", "Cabeçalho do Site");
define("_SITE_HEAD_DESC_", "Entre os tags <head> </head>.");


####################################
#
### LICENSE KEY
#
####################################
define("_ENTER_LICENSE_KEY_", "Insira a chave de sua licença");
define("_LICENSE_KEY_", "Chave da Licença");
define("_LICENSE_KEY_ACCEPTED_", "Chave da licença aceita");
define("_INVALID_LICENSE_KEY_", "A chave da licença que você inseriu não é válida para este site");

####################################
#
### EVENT REQUEST DESCRIPTION
#
####################################
define("_REQUEST_MODE_VIEW_ONLY_", "Membros com permissão de somente visualização podem submeter requisições de eventos. Usuários normais podem adicionar eventos diretamente.");
define("_REQUEST_MODE_NORMAL_", "Membros com permissão de somente visualização podem somente ver o calendário. Usuários normais podem submeter requisições de eventos.");

#####################################
#
### TELL A FRIEND FOR GUEST E-MAILS
#
######################################
define("_TELL_A_FRIEND_", "Contar a um amigo");

define("_YOUR_NAME_", "Seu nome");
define("_YOUR_EMAIL_", "Seu e-mail");

define("_YOUR_FRIENDS_NAME_","Nome de seu amigo");
define("_YOUR_FRIENDS_EMAIL_","E-mail de seu amigo");

define("_EMAIL_EVENT_DISPLAYED_","O evento será exibido abaixo de sua mensagem.");

define("_ALLOW_GUEST_USERS_EMAIL_", "Permitir que usuários visitantes enviem eventos por e-mail.");

define("_DISABLE_SITE_ADDR_BOOK_", "Desativar o livro de endereços do site para não-administradores");

define("_EMAIL_TO_MULTIPLE_", "Separar endereços múltiplos com uma vírgula.");

# MISC
########
define("_HELP_", "Ajuda");
define("_WARNING_DIR_NOT_WRITABLE_", "Aviso: O diretório %s não é gravável.");
define("_WARNING_FILE_NOT_WRITABLE_", "Aviso: O arquivo %s não é gravável.");
define("_DOWNLOAD_", "Download");
define("_HIDE_QUICK_ADD_", "Ocultar a caixa de adicionamento rápido de eveventos");
define("_FORCE_DEFAULT_OPTS_", "Forçar opções padrão para todos os usuários. Ajuste em Admin - opções padrão.");
define("_NO_GUEST_TIMEZONE_", " Não permitir que usuários visitantes modifiquem os fuso-horários.");
define("_NUMBER_SYMBOL_", '#');
define("_DISABLE_WYSIWYG_EDITOR_", "Desativar o editoe WYSIWYG para notas de eventos.");
define("_SHOW_CALENDAR_NAMES_", " Mostrar os nomes dos calendários de eventos quando mostrar os nomes das categorias dos eventos estiver ativado nas opções de usuário.");
define("_MISC_", "Misc.");
define("_THEME_POPUPS_", "Aplicar tema para os popups de notas de eventos.");

define("_PUBLIIC_", "Público");
define("_REGISTERED_USERS_", "Usuários Registrados");

define("_NEW_", "Novo");

define("_CATEGORY_EDIT_DESC_", " Para Editar a categoria, clique em seu título");

define("_ARE_YOU_SURE_DELETE_", "Você tem certeza que quer apagar estes %s?");

########## END NEW TRANSLATIONS #################


define("_ALLOW_EVERYONE_VIEW_", "Permitir que todos vejam todos os calendários neste modo de visualização, independentemente de suas listas de membros");



################################
# EDIT / VIEW / POST CALENDARS
################################
define("_CALENDARS_", "Calendários");
define("_OWNER_", "Proprietário");
define("_ARE_YOU_SURE_DELETE_CALENDAR_", "Você tem certeza que quer apagar este calendário?");

define("_COLOR_BY_", "Colorir eventos por");
define("_BY_OWNER_", "Proprietário do Evento");
define("_BY_CATEGORY_", "Categoria do Evento");
define("_BY_CALENDAR_", "Calendário");

define("_MODE_", "Modo");

define("_ALLOW_MULTI_CATS_", "Permitir múltiplas categorias para eventos");

define("_REMEMBER_LOCATIONS_", "Lembrar posicionamentos");

define("_STRICT_EVENT_SECURITY_", " Evento de estrita segurança");
define("_STRICT_EVENT_SECURITY_DESC_", "Somente o proprietário do evento ou os administradores do calendário podem modificar ou apagar eventos existentes.");

define("_REMOTE_ACCESS_", "Acesso Remoto");
define("_REMOTE_ACCESS_DESC_", "Acesso Remoto permite que usuários se inscrevam neste calendário de modo remoto
	utilizando um programa como Mozilla Sunbird, Windates, ou Apple iCal.Isto também permitirá o uso de publicação RSS através de leitores RSS (ex. RSSReader, Shrook)
	Alguns provedores de conteúdo (ex. Yahoo, MSN), e ferramentas de gerenciamento de conteúdo (ex. PHP-Nuke, Mambo).");

define("_ENABLE_REMOTE_ACCESS_UPD_", "Permitir atualizações por acesso remoto. Isto permite membros autorizados a publicar atualizações a este calendário utilizando aplicações de terceira parte.");

define("_REMOTE_ACCESS_DESC_USERS_", "Se o usuário visitante não é um membro deste calendário, pessoas tentando acessar este calendário irão requerer um nome de usuário e uma senha. Uma vez autenticado, o acesso é permitido ou negado baseado em suas configurações de membro.");

define("_SYNDICATION_", "Publicação");

define("_EDIT_EVENT_TYPES_", "Editar Categorias");

define("_EVENT_TYPES_", "Categorias");

define("_EVENT_TYPES_DESC_", "

       Não selecione nenuma categoria para utilizar todas as categorias.<BR><BR>");

define("_MULTI_SELECT_WIN_","
       Windows: Para des-selecionar um ítem ou selecionar<br>multiplos ítens não concorrentes, pressione<br>CTRL ao selecioná-lo.  ");

define("_REALLY_DELETE_EVENT_TYPE_", " Realmente apagar categoria?"); # question
define("_DELETE_ALL_IN_CATEGORY_", "Apagar todos os eventos nesta categoria.");

define("_VIEWS_NO_ACTION_", "This action can not be performed on a view. Please
        select a calendar.");

define("_VIEW_INVALID_CAL_", "O modo de visualização atual contém um calendário do qual você não é membro. Eventos deste calendário não serão exibidos.");

define("_DESCRIPTION_", "Descrição");
define("_DETAILS_", "Detalhes");
define("_PUBLISH_", "Enviar");
define("_PUBLISH_DESC_", "Publicar este calendário em um servidor remoto ou serviço similar
<a class='". _CAL_CSS_BODY_ ." ". _CAL_CSS_ULINE_."' target=_blank
href='http://icalx.com'>iCal Exchange</a>");
define("_SERVER_RESPONSE_", "Resposta do Servidor");



######################
# EMAIL EVENT
######################
define("_EMAIL_EVENT_", "E-Mail");
define("_EMAIL_TO_", "Para");
define("_SEND_EMAIL_", "Enviar");
define("_SUBJECT_", "Assunto");
define("_MESSAGE_", "Mensagem");
# e.g. The event has been sent to abcdefg@alphabet.com
define("_EMAIL_SENT_TO_", "O evento foi enviado para ");
define("_EMAIL_NO_ADDR_WARNING_", "Aviso: Você não configurou um endereço de e-mail na seção de opções de contato. Seu endereço eletrônico aparecerá como enviado de ". @constant("_CAL_MAIL_FROM_"));

######################
# EMAIL SETTINGS
######################
define("_MAIL_PROG_PHP_", "Função de e-mail do PHP");
define("_MAIL_PROG_CMD_", "Programa de E-mail local (sendmail, qmail, etc.)");
define("_MAIL_PROG_SERVER_", "Servidor SMTP");

define("_MAIL_PROGRAM_", "Enviar e-mail utilizando");

define("_MAIL_FROM_EMAIL_", "Endereço de E-mail");

define("_MAIL_PATH_", "Caminho local para enviar e-mail");
define("_MAIL_AUTH_", "Autenticação SMTP");

define("_MAIL_AUTH_USER_", "Nome de usuário SMTP");
define("_MAIL_AUTH_PASS_", "Senha SMTP");

define("_MAIL_SERVER_", "Servidor SMTP");
define("_MAIL_SERVER_PORT_", "Porta do Servidor");

##########################
# ATTACHMENT SETTINGS
##########################
define("_ALLOW_ATTACHMENTS_", "Permitir anexar arquivos");
define("_ATTACHMENTS_PATH_", "Caminho de Anexos");

#############################
# GROUPS AND USERS
#############################
define("_USERS_", "Usuários");
define("_GROUPS_", "Grupos");
define("_EVERYONE_", "Todos");
define("_SUPER_USER_", "Super Usuário");

define("_MEMBERS_", "Membros");
define("_MEMBERS_OF_", "Membros de");


define("_NAME_", "Nome");
define("_EMAIL_", "E-mail");

define("_ACCESS_LVL_", "Nível de Acesso");
define("_ROLE_", "Função");
define("_READ_ONLY_", "Somente Ver");
define("_NORMAL_","Normal");

define("_ARE_YOU_SURE_DELETE_GROUP_", "Você tem certeza que deseja apagar este grupo?");
define("_GROUPS_SAVE_ATLEAST_1_MEMBER_", "Grupos devem ter pelo menos 1 membro. Lista de membros não foi salva.");

# displayed as form field must begin with a character. E.g.
# Username must begin with a character.
define("_MUST_BEGIN_WITH_CHAR_", "Deve começar com um caractere.");

######################
# REMINDERS
######################
define("_REMINDERS_", "Lembretes");
define("_BEFORE_EVENT_","antes deste evento, em");

define("_WILL_OCCUR_IN_", "Ocorrerá em"); # event x will occur in 30 minutes



###########################
# EVEVNT REQUESTS
############################
define("_REQUEST_", "Requisição de Evento");
define("_REQUESTS_", "Requisição de Eventos");
define("_REQUEST_ACCEPTED_", "Seu pedido de evento foi aceito.");
define("_REQUEST_REJECTED_", "Seu pedido de evento foi rejeitado.");

define("_NOTIFY_REQUESTOR_", "Notificar pessoa que fez o pedido");
define("_REQUEST_HAS_NOTIFY_", "A pessoa que fez o pedido solicitou notificação.");
define("_REQUESTS_NO_PENDING_", "Não há solicitações pendentes.");
define("_REQUEST_NOTIFY_EMAIL_", "Notifique-me de solicitações pendentes em");
define("_REQUEST_MSG_PRE_", "Mensagem exibida aos usuários antes que sua solicitação seja enviada.");
define("_REQUEST_MSG_POST_", "Mensagem exibida aos usuários depois da solicitação enviada.");
define("_REQUEST_NOTES_", "Notas aicionais de solicitação");
define("_REQUEST_NOTIFY_STATUS_", "Notifique-me do status desta solicitação em");

define("_CONTACT_", "Contato");

# You have a pending event request on calendar: CALENDAR TITLE
define("_PENDING_REQUEST_", "Você tem uma solicitação de evento pendente em seu calendário:");


#################
# DATE  ITEMS
#################
define("_CALENDAR_", "Calendário");

define("_MONTH_", "Mês");
define("_MONTHS_", "Mês(es)");

define("_DAY_","Dia");
define("_DAYS_", "Dia(s)");

define("_YEAR_", "Ano");
define("_YEARS_", "Ano(s)");

define("_WEEK_", "Semana");

# Abbreviated week
define("_WEEK_ABBR_", "Semana");

define("_WEEKS_", "Semana(s)");

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
define("_PM_SHORT_", "p");

# VIEWS
define("_TODAY_", "Hoje");
define("_THIS_WEEK_", "Esta Semana");
define("_THIS_MONTH_", "Este Mês");

##################
# MISCELLANEOUS
##################
define("_EVENT_", "Evento");
define("_EVENTS_", "Eventos");
define("_VIEW_", "Visualização");

# VIEW AS A NOUN
define("_VIEW_NOUN_", "Visualização");

define("_PRINTABLE_VIEW_", "Visualizar Impressão");

define("_ALLDAY_", "Dia Todo");

define("_CAL_CALL_FOR_TIMES_", "Contate-nos para horários");
define("_CAL_CALL_FOR_TIMES_MIN_", "(*)");

define("_TYPE_","Tipo");
define("_EVENT_TYPE_", "Categoria");

define("_WIDTH_", "Largura");

define("_COLORS_", "Cores");

# List separator. Note space after comma
define("_LIST_SEP_",", ");

###########################
# ADMIN PAGE 
###########################
define("_GLOBAL_SETTINGS_", "Configurações do site");
define("_EDIT_DEFAULT_OPTS_", "Opções padrão");
define("_PASS_MUST_MATCH_", "A senha que você inseriu é inválida");
define("_EMPTY_PASSWORD_", "Não há senha definida para \"\"!");
define("_ARE_YOU_SURE_DELETE_USER_", "Você tem certeza que quer apagar este usuário?");
define("_DELETE_USERS_EVENTS_", "Apagar todos os eventos de propriedade deste usuário.");
define("_CALENDARS_OWNED_", "Calendários de propriedade deste usuário");
define("_AUDIT_USERS_", "Auditar Usuários");
define("_AUDIT_USERS_DESC_", "Usuários encontrados nos bancos de dados do Thyme, mas não há entradas correspondentes no atual módulo de autenticação.<br> Todos os dados deste usuário foram ajustados ao uid do usuário em falta.");

define("_CALENDAR_PUBLISHER_", "Publicador de calendários");
define("_CAL_USER_GUEST_", "Conta de visitante");
define("_CAL_PUBLISH_GUEST_DISABLED_", "O publicador de calendário não funcionará se a conta de visitante estiver desabilitada. Por favor, habilite esta conta na seção de Usuários.");


####################################
# GENERAL ACTIONS AND RESPONSES
####################################
define("_ADD_", "Adicionar");
define("_NEW_EVENT_", "Novo Enento");
define("_REMOVE_", "Remover");
define("_UPDATE_", "Atualizar");
define("_NEXT_", "Próximo");
define("_PREV_", "Anterior");
define("_DELETE_", "Apagar");
define("_SAVE_", "Salvar");
define("_TEST_", "Testar");
define("_UPDATE_NOW_", "Atualizar agora");
define("_SAVE_ADD_", "Salvar e adicionar outro");
define("_CANCEL_", "Cancelar");
define("_BROWSE_", "Navegar");
define("_NONE_", "Nenhum");
define("_RESET_", "Reiniciar");
define("_CLEAR_ALL_", "Limpar tudo");
define("_CHECK_ALL_", "Checar tudo");
define("_EDIT_", "Editar");
define("_CLOSE_", "Fechar");
define("_SHOW_", "Mostrar");
define("_HIDE_", "Ocultar");
define("_ENABLE_", "Habilitar");
define("_DISABLE_", "Desabilitar");
define("_MOVE_", "Mover");
define("_UP_", "Acima");
define("_DOWN_", "Abaixo");
define("_ENABLED_", "Habilitado");
define("_CONFIGURE_", "Configurar");
define("_ACCEPT_", "Aceitar");
define("_REJECT_", "Rejeitar");
define("_OK_", "OK");
define("_FAILED_", "FALHOU");
define("_CHANGE_", "Modificar");
define("_SORT_BY_", "Organizar por");
define("_SEARCH_", "Busca");
define("_FORCE_", "Forçar");
define("_AUTODETECT_", "Autodetectar");
define("_RESET_PASS_", "Alterar senha");
define("_NEW_PASS_", "Nova Senha");
define("_RETYPE_", "Re-digitar");
define("_UPDATED_", "Atualizado");
define("_SUBMITTED_", "Submetido");
define("_LOGIN_", "Log in");
define("_USERNAME_", "Nome de usuário");
define("_PASSWORD_", "Senha");
define("_LOGOUT_", "Sair");
define("_OPTIONS_", "Opções");
define("_ADMIN_", "Administrador");
define("_BAD_PASS_", "Nome de usuário ou senha incorretos.");
define("_YES_", "Sim");
define("_NO_", "Não");
define("_VALUE_", "Valor");
define("_CUSTOM_", "Personalizar");
define("_DEFAULT_", "Padrão");

######################
# ATTACHMENTS
######################
define("_ATTACHMENTS_", "Arquivos Anexos");
define("_ATTACH_DETACH_", "Desanexar");
define("_ATTACH_DELETE_", "Apagar");
define("_ATTACHMENT_TOO_BIG_", "O arquivo anexo é maior que o tamanho permitido.");
define("_DOWNLOAD_ZIP_", "Baixar Zip");
define("_UPDATE_ATTACHMENTS_", "Atualizar arquivos anexos");

define("_BYTES_", "b");
define("_KBYTES_", "KB");
define("_MBYTES_", "MB");


#################
# EVENT LIST VIEW 
#################
define("_ALL_", "Todos");
define("_UPCOMING_", "Próximo");
define("_PAST_", "Passado");

define("_SHOWING_", "mostrando");
define("_OF_", "de");
define("_FIRST_", "Primeiro");
define("_LAST_", "Último");
define("_SHOW_TYPE_", "Categoria");

define("_LIST_SIZE_", "Tamanho da Lista");

define("_ARE_NO_EVENTS_", "Não há eventos para mostrar.");

define("_EVENTS_CONTAINING_", "Eventos que contenham"); # used in event search

define("_ARE_YOU_SURE_DELETE_EVENTS_", "Você tem certeza que quer apagar estes eventos?");
define("_DELETE_REPEATING_WARNING_", "
   Você decidiu apagar um ou mais eventos repetidos.<br>
  Todas as instâncias (passadas ou futuras) destes eventos serão apagadas! ");

define("_UNCHECK_NO_DELETE_", "Des-selecione todos os eventos que não deseja apagar:");
define("_DELETE_CHECKED_", "Apagados os selecionados");

define("_RETURN_", "Retornar");
define("_ERROR_", "Erro!");

######################
# EVENT EDIT/ADD/VIEW
######################
define("_GENERAL_", "Geral");

define("_ORGANIZER_", "Organizador");

define("_URL_", "URL");

define("_REPEATING_", "Repetidos");

define("_LOCATION_", "Localização");

define("_APPLY_TO_", "Aplicar mudanças a");
define("_ALL_DATES_", "Todas as datas");
define("_THIS_DATE_", "somente esta data");

define("_RESET_INSTANCE_", "Restaurar esta instância ao seu estado original");

define("_MAP_", "Mapa");

define("_STARTED_", "Iniciado");

# e.g. Overrides event Weekly Meeting on 2004-2-34
define("_OVERRIDE_EVNT_ON_", "Cancelar evento %s em %s");

# e.g. Warning: the event Event Title has an invalid repeating rule
define("_INVALID_RRULE_", "Aviso: O evento %s tem uma regra de repetição inválida.");

define("_MAX_CHARS_", "caracteres máximos");
define("_EVENT_INFO_", "Informação do Evento");
define("_TITLE_", "Título");
define("_NOTES_", "Notas");

define("_CHECK_FOR_CONFLICTS_", "Verificar Conflitos");

define("_THIS_EVENT_ALLDAY_", "Este é um  <b>todo o dia</b> evento.");
define("_STARTS_AT_", "Começa em");
define("_DURATION_", "Duração");

define("_FLAG_", "Bandeira");
define("_FLAG_THIS_", "Marcar este evento com bandeira");
define("_IS_FLAGGED_", "Este evento está marcado com bandeira");

# e.g. 10 days ago
define("_AGO_", "atraz");

define("_REPEATING_NO_", "Este evento não se repete.");
define("_REPEATING_REPEAT_", "Repetir");
define("_REPEATING_SELECTED_", "dias selecionados");
define("_REPEATING_EVERY1_", "todo");

define("_REPEAT_ON_", "Repetir em");
define("_REPEAT_ON1_", "primeiro");
define("_REPEAT_ON2_", "segundo");
define("_REPEAT_ON3_", "terceiro");
define("_REPEAT_ON4_", "quarto");
define("_REPEAT_ON5_", "quinto");
define("_REPEAT_ONL_", "último");
define("_REPEAT_ON_OF_", "do mês, a cada");

define("_SIMPLE_", "Simples");
define("_ADVANCED_","Avançado");

define("_YEARLY_", "Anualmente");
define("_MONTHLY_", "Mensalmente");
define("_WEEKLY_", "Semanalmente");
define("_DAILY_", "Diariamente");
define("_EASTER_", "Páscoa");
define("_EASTER_YEARLY_", "Páscoa anualmente");

define("_MONTH_DAYS_", "Dia(s) do mês");
define("_FROM_LAST_", "A partir do último");

define("_WEEKDAYS_", "Dia(s) da semana");

define("_YEARLY_NOTES_", "O mês e o dia preestabelecidos são baseados na data
de inicio, se nenhum for selecionado.");


define("_SPECIFIC_OCCURRENCES_", "Ocorrências específicas");

define("_STARTING_ON_", "começando em");

define("_BEFORE_", "Antas");
define("_AFTER_", "Depois");

define("_EXCLUDE_DATES_", "Excluir Datas");

define("_CONFIRM_EVNT_RPT_CHANGE_", " Você está modificando a regra de recorrência ou datas deste evento.\n
Todas as excessões associadas a este evento recorrente serão perdidas. Você tem certeza que quer fazer isso?\n");


define("_END_DATE_", "Data de término");
define("_END_DATE_NO_", "Não há data de término");
define("_END_DATE_UNTIL_", "Até");
define("_END_DATE_AFTER_", "Terminar após");
define("_OCCURRENCES_", "ocorrências");

define("_ADDRESS_", "Endereço");
define("_ADDRESS_1_", "Rua");
define("_ADDRESS_2_", "Cidade, Estado CEP");

define("_PHONE_", "Telefone");
define("_ICON_", "Ícone");

#####################
# MODULES
#####################
define("_NAVBAR_", "Barra de navegação");
define("_MODULE_", "Módulo");
define("_MODULES_", "Módulos");
define("_TODAY_LINK_", "Link de hoje");
define("_MINI_CAL_", "Mini Calendário");
define("_CALENDAR_LINKS_", "Links do Calendário");
define("_IMAGE_BROWSER_", "Navegador de imagens");
define("_QUICK_ADD_EVNT_", "Adicione um evento rapidamente");
define("_GOTO_DATE_", "Ir para data");
define("_SEARCH_EVENTS_", "Buscar eventos");
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
define("_SYNC_DUPLICATES_", "Se duplicações forem encontradas");
define("_IGNORE_DUPLICATES_", "Ignorar duplicação");
define("_OVERWRITE_EXISTING_EVENT_", "Sobre-escrever evento existente");
define("_CREATE_NEW_EVENT_", "Criar novo evento");
define("_IMPORT_AS_", "Importar para a categoria");
define("_EVENTS_IMPORTED_", "Eventos Importados");
define("_SYNC_IMPORT_ERROR_", "Erro: Há um erro existente no arquivo que você tentou importar.");
define("_HTML_", "HTML");
define("_PLAINTEXT_", "Texto");
define("_ICAL_", "iCalendar (.ics)");
define("_QUIRKS_MODE_", "Modo Quirks");
define("_PERMISSION_DENIED_", "Permissão negada: você não é o proprietário deste evento ou um administrador deste calendário.");
define("_FULL_SYNC_", "Sincronização completa");
define("_FULL_SYNC_DESC_", "Apagar eventos existentes no Thyme mas não são encontrados no arquivo importado.");

#########################
# CSS AND STYLE
#########################
define("_COLOR_", "Cor");

define("_STYLE_", "Estilo");

define("_PREVIEW_", "Visualizar");
define("_SAMPLE_", "Amostra");

define("_BACKGROUND_COLOR_", "Cor do plano de fundo");
define("_FONT_COLOR_", "Cor da fonte");
define("_FONT_SIZE_", "Tamanho da fonte");

define("_FONT_STYLE_", "Estilo da fonte");
define("_BOLD_", "Negrito");
define("_ITALICS_", "italico");
define("_UNDERLINE_", "sublinhado");

define("_FONT_FAMILY_", "Família da fonte");
define("_FONT_FAMILY_DESC_", "E.g. Tahoma, 'Sans Serif', Arial");

define("_UNDERLINE_LINKS_", "Sublinhar links");
define("_NEVER_", "Nunca");
define("_ALWAYS_", "Sempre");
define("_HOVER_", "Hover");
define("_BORDER_COLOR_", "Cor da borda");
define("_TIME_FONT_COLOR_", "Cor da fonte das horas");
define("_TITLE_FONT_COLOR_", "Cor da fonte do título");
define("_TITLE_FONT_STYLE_", "Estilo da fonte do título");

#########################
# CALENDAR PUBLISHER
#########################
if(@constant("_CAL_DOING_PUBLISHER_")) { # <- leave this line alone

define("_MINI_MONTH_", "Mini Mês");

define("_SET_DATE_CURRENT_", "Ajustar à data atual");
define("_EDITABLE_", "Editável");
define("_STATIC_", "Estático");
define("_STATIC_DESC_", "Conteúdo do calendário não contém links que modifiquem a data ou o modo de visualização");
define("_HIL_DAY_", "Destacar Dia");
define("_HIL_WEEK_", "Destacar Semana");

define("_APPLY_CSS_FROM_", "Aplicar estilo de");
define("_NO_CSS_", "nenhum");
define("_CSS_EDITOR_", "Editor de estilos");

define("_LANGUAGE_", "Idioma");
define("_EURO_DATE_", "Data em estilo Europeu");
define("_EURO_DATE_DESC_", "Datas mostradas como  dd/mm/aaaa onde aplicável");

define("_HEADER_", "Cabeçalho");
define("_WEEKDAY_HEADER_", "Cabeçalho do Dia da Semana");

define("_NORMAL_DAYS_", "Dias Normais");
define("_DAYS_NOT_IN_MONTH_", "Dias que não estão no mês");
define("_HIGHLIGHTED_DAYS_", "Dias destacados");

define("_NORMAL_EVENTS_", "Eventos Normais");
define("_FLAGGED_EVENTS_", "Eventos destacados com bandeira");

define("_SHOW_EVENTS_", "Mostrar Eventos");


define("_EVENT_LINKS_", "Links dos Eventos");

define("_EVENT_LINK_URL_", "URL dos links dos eventos");

define("_EVENT_LINK_URL_DESC_", "
      Este link (url) sera filtrado através de uma query string que contêm
        <font class='"._CAL_CSS_HIL_."'>eid</font> e <font class='"._CAL_CSS_HIL_."'>a instância</font>.<br>

        <b>eid</b> é o identificador do evento <b>e o registro</b> da data em formato
        <b>ano, mês e dia</b>.<br>Estes são anotados por<font class='"._CAL_CSS_HIL_."'>%eid</font>
        e <font class='"._CAL_CSS_HIL_."'>%inst</font>.<br><br>

        Por exemplo http://mysite.com/sales/view_sale.php?eid=%eid&instance=%inst se mostrara assim:<br>

        http://mysite.com/sales/view_sale.php?<font
		class='"._CAL_CSS_HIL_."'>eid</font>=56&<font
		class='"._CAL_CSS_HIL_."'>registo</font>=2005-10-26<br><br>

        Veja o manual e/o tutorial na pagina web do Thyme para mais 
        informações de como usar este. ");


define("_SHOW_HEADER_", "Mostrar Cabeçalho");
define("_ALIGN_HEADER_TEXT_", "Alinhar texto do cabeçalho");
define("_CENTER_", "Centro");
define("_HEADER_TEXT_", "Texto do cabeçalho");

define("_HEADER_TEXT_DESC_","

   (E.g. <font class='"._CAL_CSS_HIL_."'>Aniversários no %mês</font>)<br>
        <font size=1><i>Deixe em branco para utilizar o cabeçalho padrão. 
Outras variáveis incluem  %weekday, %mday, %mon and %year.</i></font> ");


define("_SHOW_HEADER_LINKS_", "Mostrar links do cabeçalho");

define("_NEXT_LINK_", "'Próximo Link");
define("_PREV_LINK_", "link anterior");

define("_IMG_URL_", "URL da imagem");

define("_HEADER_LINKS_", "Links do cabeçalho");

define("_IMG_URL_DESC_", "
        Este pode ser um texto como '<<' ou uma URL para uma imagem<br>
        (E.g. <font
        class='"._CAL_CSS_HIL_."'>http://www.myserver.com/images/next.gif</font>)<br><font
        size=1><i> Deixe em branco para utilizar a imagem padrão do tema selecionado.</i></font> ");


define("_DAY_VIEW_", "Visualização do Dia");

define("_MONTH_VIEWS_", "Visualização dos meses");

define("_SHOW_WEEKS_DESC_", "Nota: o calendário Mini-mês nunca mostrará números das semanas");

define("_ROW_HEIGHT_", "Altura da linha");
define("_ROW_HEIGHT_DESC_", "O padrão é '90'  para mês, '0' para um Mini-mês");

define("_LIMIT_WEEKDAY_NAMES_", "Limitar os nomes dos dias da semana para ");
define("_CHARS_", "chars");

define("_EXCLUDE_MONTH_DAYS_", "Excluir dias fora do mês");

define("_MINI_MONTH_DATE_URL_", "URL da data do Mini-mês");

define("_MINI_MONTH_DATE_URL_DESC_", "
        Este link ao clicar no dia do mini mês do calendário o redireccionará.
		Este substitui os seguintes strings:<br>

        %d = o numero do dia (day)<br>
        %m = o numero do mês (month)<br>
        %y = o numero do ano (year)<br>

        <br><br>

        Por exemplo: http://www.myserver.com/page.php?day=%d&month=%m&year=%y<br>
        dar como resultado
        <font class='"._CAL_CSS_HIL_."'>http://www.myserver.com/page.php?day=23&month=11&year=2004</font>

        <br>Ou poderá usar alguma função do JavaScript.<br>

        Por exemplo <font class='"._CAL_CSS_HIL_."'>javascript:myFunction(%y,%m,%d)</font><br><br>

        O preestabelecido é um link á pagina atual:<br>
        m = %m<br>
        d = %d<br>
        y = %y<br>

        Por exemplo <font class='"._CAL_CSS_HIL_."'>index.php?d=23&m=11&y=2004</font><br><br>
        Veja o manual e/o tutorial na pagina web do Thyme para mais 
        informações de como usar este.");


define("_GENERATED_CODE_", "Código gerado");

define("_BASE_PATH_DESC_", "Caminho base do Thyme ");
define("_BASE_URL_DESC_", "URL base do Thyme");

} # </ CALENDAR PUBLISHER SECTION > <- leave this line alone


######################
#
### RSS FEED MODULES
#
#####################
define("_RSS_FEED_MODULES_", "Módulos RSS");
define("_RSS_", "RSS");
define("_UPDATE_INTERVAL_", "Intervalo de atualização");
define("_ARE_YOU_SURE_DELETE_RSSMOD_", " Você tem certeza que quer apagar este módulo RSS?");
define("_AUTHOR_", "Autor");

# scrolling
define("_SCROLLING_","Rolagem");
define("_OVERFLOW_", "Excesso");
define("_SCROLLBAR_", "Barra de rolagem");
define("_AUTOSCROLL_", "Rolagem automática");


# This will keep us from needing to
# have these defined when not looking
# at options
#####################################
if(@constant("_CAL_DOING_OPTS_")) { # <- leave this line alone

######################
# OPTION STRINGS
######################

define("_DEFAULT_VIEW_", "Visualização padrão");

define("_DEFAULT_CALENDAR_", "Calendário padrão");

define("_TIME_INTERVALS_", "Intervalos de tempo");

define("_EVNT_SIZE_", "Tamanho do Evento");
define("_SMALLER_", "menor");
define("_SMALLEST_", "O menor");
define("_EVNT_COLLAPSE_", "Colapso, minimizar eventos (Visualização do mês)");
define("_EVNT_COLLAPSE_DESC_", "Colapsar, minimizar títulos longos de eventos.");
define("_EVNT_TYPE_NAME_", "Mostrar os nomes das categorias dos eventos");
define("_EVNT_POPUP_", "Popup de evento");
define("_EVNT_POPUP_DESC_", "Mostrar eventos em uma nova janela.");
define("_EVNT_NOTES_POPUP_", "Popup de notas dos eventos");
define("_EVNT_NOTES_POPUP_DESC_", "Passe o mouse sobre um evento para ver suas notas.");

define("_POSITION_", "Posição");

define("_SHOW_WEEKS_", "Mostrar números das semanas");

define("_WEEK_START_", "Semana começa em");
define("_WORK_HOURS_", "Horas de trabalho");
define("_WORK_HOURS_START_", "Começa em");
define("_WORK_HOURS_END_", "termina em");

define("_HOUR_FORMAT_", "Formato das horas");
define("_HOUR_FORMAT_12_", "12 hr");
define("_HOUR_FORMAT_24_", "24 hr");

define("_NAV_BAR_LOC_", "Barra de navegação");
define("_RIGHT_", "Direita");
define("_LEFT_", "Esquerda");

define("_TIMEZONE_", "Time Zone");
define("_DST_", "Luz do dia - horas de economia");
define("_STARTS_", "Começa");
define("_ENDS_", "Termina");

define("_IN_", "em");
define("_ON_", "em");
define("_OFF_", "desligar");

define("_THEME_", "Thema");

##########################
# CONTACT OPTIONS
##########################
define("_CONTACT_OPTS_", "Opções de contato");
define("_PRIMARY_", "Primário");
define("_FORMAT_", "Formatar");

##########################
# SUBSCRIPTIONS
##########################
define("_SUBSCRIPTIONS_", "Inscrições");
define("_SUBSCRIPTIONS_DESC_", "Enviar inscrições aos calendários por e-mail.");

######################
# NOTIFICATIONS
#####################
define("_NOTIFICATIONS_", "Notificações");
define("_NOTIFICATIONS_DESC_", "Filtros de notificações para eventos novos e atualizados.");

define("_TITLE_CONTAINS_", "Título contém");
# event X has been updated on calendar Y
define("_UPDATED_ON_", "Foi atualizado em");
# event X has been added to calendar Y
define("_ADDED_TO_", "foi adicionado a");

#####################
# DST STRINGS
#####################
define("_DST_OPTS1_", "Africa / Egito");
define("_DST_OPTS2_", "Africa / Namibia");
define("_DST_OPTS3_", "Asia / USSR (former) - most states");
define("_DST_OPTS4_", "Asia / Iraque");
define("_DST_OPTS5_", "Asia / Lebanon, Kyrgyz Republic");
define("_DST_OPTS6_", "Asia / Syria");
define("_DST_OPTS7_", "Australasia / Australia, New South Wales");
define("_DST_OPTS8_", "Australasia / Australia - Tasmania");
define("_DST_OPTS9_", "Australasia / New Zealand, Chatham");
define("_DST_OPTS10_", "Australasia / Tonga");
define("_DST_OPTS11_", "Europe / European Union, UK, Greenland");
define("_DST_OPTS12_", "Europe / Russia");
define("_DST_OPTS13_", "North America / United States, Canada, Mexico");
define("_DST_OPTS14_", "North America / Cuba");
define("_DST_OPTS15_", "South America / Chile");
define("_DST_OPTS16_", "South America / Paraguay");
define("_DST_OPTS17_", "South America / Falklands");

####################
# TIMEZONE STRINGS
####################
define("_GMT_PLUS_0.0_","GMT +00:00 Britain, Ireland, Portugal, Western Africa ");
define("_GMT_PLUS_0.5_","GMT +00:30 ");
define("_GMT_PLUS_1.0_","GMT +01:00 Western Europe, Central Africa");
define("_GMT_PLUS_1.5_","GMT +01:30 ");
define("_GMT_PLUS_2.0_","GMT +02:00 Eastern Europe, Eastern Africa");
define("_GMT_PLUS_2.5_","GMT +02:30 ");
define("_GMT_PLUS_3.0_","GMT +03:00 Russia, Saudi Arabia");
define("_GMT_PLUS_3.5_","GMT +03:30 ");
define("_GMT_PLUS_4.0_","GMT +04:00 Arabian");
define("_GMT_PLUS_4.5_","GMT +04:30 ");
define("_GMT_PLUS_5.0_","GMT +05:00 West Asia, Pakistan");
define("_GMT_PLUS_5.5_","GMT +05:30 India");
define("_GMT_PLUS_6.0_","GMT +06:00 Central Asia");
define("_GMT_PLUS_6.5_","GMT +06:30 ");
define("_GMT_PLUS_7.0_","GMT +07:00 Bangkok, Hanoi, Jakarta");
define("_GMT_PLUS_7.5_","GMT +07:30 ");
define("_GMT_PLUS_8.0_","GMT +08:00 China, Singapore, Taiwan");
define("_GMT_PLUS_8.5_","GMT +08:30 ");
define("_GMT_PLUS_9.0_","GMT +09:00 Korea, Japan");
define("_GMT_PLUS_9.5_","GMT +09:30 Central Australia");
define("_GMT_PLUS_10.0_","GMT +10:00 Eastern Australia");
define("_GMT_PLUS_10.5_","GMT +10:30 ");
define("_GMT_PLUS_11.0_","GMT +11:00 Central Pacific");
define("_GMT_PLUS_11.5_","GMT +11:30 ");
define("_GMT_PLUS_12.0_","GMT +12:00 Fiji, New Zealand");
define("_GMT_MINUS_12.0_","GMT -12:00 Dateline ");
define("_GMT_MINUS_11.5_","GMT -11:30 ");
define("_GMT_MINUS_11.0_","GMT -11:00 Samoa");
define("_GMT_MINUS_10.5_","GMT -10:30 ");
define("_GMT_MINUS_10.0_","GMT -10:00 Hawaiian");
define("_GMT_MINUS_9.5_","GMT -09:30 ");
define("_GMT_MINUS_9.0_","GMT -09:00 Alaska/Pitcairn Islands");
define("_GMT_MINUS_8.5_","GMT -08:30 ");
define("_GMT_MINUS_8.0_","GMT -08:00 US/Canada/Pacific");
define("_GMT_MINUS_7.5_","GMT -07:30 ");
define("_GMT_MINUS_7.0_","GMT -07:00 US/Canada/Mountain");
define("_GMT_MINUS_6.5_","GMT -06:30 ");
define("_GMT_MINUS_6.0_","GMT -06:00 US/Canada/Central");
define("_GMT_MINUS_5.5_","GMT -05:30 ");
define("_GMT_MINUS_5.0_","GMT -05:00 US/Canada/Eastern, Colombia, Peru");
define("_GMT_MINUS_4.5_","GMT -04:30 ");
define("_GMT_MINUS_4.0_","GMT -04:00 Bolivia, Western Brazil, Chile, Atlantic");
define("_GMT_MINUS_3.5_","GMT -03:30 Newfoundland");
define("_GMT_MINUS_3.0_","GMT -03:00 Argentina, Eastern Brazil, Greenland");
define("_GMT_MINUS_2.5_","GMT -02:30 ");
define("_GMT_MINUS_2.0_","GMT -02:00 Mid-Atlantic");
define("_GMT_MINUS_1.5_","GMT -01:30 ");
define("_GMT_MINUS_1.0_","GMT -01:00 Azores/Eastern Atlantic");
define("_GMT_MINUS_0.5_","GMT -00:30 ");

}

##########################
# ERRORS AND WARNINGS
##########################
define("_WARNING_ATTACH_", "Aviso: Diretório para arquivos anexos %s does não existe, ou não há permissão para escrever.");
define("_WARNING_RSS_", "Aviso: Repositório de RSS %s não tem permissão para escrever.");
define("_WARNING_INSTALL_", "Aviso: %s ainda existe. Por favor remova este arquivo.");
define("_WARNING_LICENSE_", "Aviso: A licença do Thyme expirará em  %s dias.");


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
   'Q','R','S','T','U','V','W','X','Y','Z');

#####################
# WEEKDAYS AND MONTHS
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

# ABBREVIATED
#################
$_cal_weekdays_abbr or $_cal_weekdays_abbr = array(
  "Dom",
  "Seg",
  "Ter",
  "Qua",
  "Qui",
  "Sex",
  "Sab");

$_cal_months_abbr or $_cal_months_abbr = array(1 =>
  "Jan",
  "Fev",
  "Mar",
  "Abr",
  "Mai",
  "Jun",
  "Jul",
  "Ago",
  "Set",
  "Out",
  "Nov",
  "Dez");



?>
