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
define("_CAL_EURO_DATE_", 0);

define("_CHARSET_", "UTF-8");

define("_LANG_NAME_", "English (US)");


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
define("_GLOBAL_VIEWS_", "Global Views");

define("_ALLOW_EVERYONE_VIEW_", "Allow everyone to see all calendars in this View regardless of their member lists");

define("_HIDE_VIEW_FROM_GUESTS_", "Hide this View from guest users");

define("_REQUEST_NOTIFY_OWNER_", "Notify calendar owner of pending requests");

define("_ALL_CALENDARS_", "All Calendars View");

#################################
#
### INSTALLER 
#
#################################

# some of these will not be used until 2.0
define("_INSTALLER_", "Installer");
define("_PACKAGE_", "Package");
define("_INSTALL_", "Install");
define("_INVALID_PACKAGE_", "The file you've uploaded is not a valid Thyme package.");
define("_INSTALLED_MODULES_", "Installed Modules");
define("_UNINSTALL_", "Uninstall");
define("_LOCAL_FILE_","Local File");
define("_UPDATES_", "Updates");
define("_AVAILABLE_UPDATES_", "Available Updates");
define("_CHECK_FOR_UPDATES_", "Check for Updates");
define("_LAST_CHECKED_ON_", "Last checked on"); # e.g. last checked on 1/2/2007
define("_FILE_", "File");
define("_WRITABLE_", "Writable");
define("_REFRESH_", "Refresh");
define("_INVALID_DOWNLOAD_", "Invalid download. Unable to update file.");
define("_UNABLE_TO_BACKUP_", "Unable to backup current file.");
define("_UPDATES_AVAIL_", "%s updates available"); # %s will be replaced w/# of updates available

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
define("_BEFORE_EVENT_MULTI_", "before this event");
define("_USER_CAN_NOT_VIEW_", "%s does not have access to view this calendar.");
define("_ALLOW_CONFIGURE_REMINDERS_", "Allow %s to configure event reminders for all users.");
define("_CALENDAR_ADMINS_", "Calendar admins");
define("_EVENT_OWNER_", "Event owner");
define("_SITE_ADMINS_", "Site admins");
define("_NO_ONE_", "No one");

###############################
#
## CONFIGURABLE JOB INTERVALS
#
###############################

define("_REMIND_AT_LEAST_", "At least");
define("_SCHEDULED_TASK_", "Scheduled Task");
define("_NO_SCHEDULED_TASK_", "The Thyme scheduled task is not configured to run");
define("_SCHEDULED_TASK_CONFIGURED_", "The Thyme scheduled task is configured to run every");
define("_PHP_CLI_", "PHP CLI location");

###################################
#
### CUSTOMIZE SITE
#
###################################
define("_CUSTOMIZE_SITE_", "Customize Site");
define("_SITE_NAME_", "Site Name");
define("_SITE_THEME_", "Site Theme");
define("_SITE_THEME_DESC_", "Setting to None allows users to choose their own theme");

# use exact HTML tags, they will be displayed correctly
# when printed
define("_SITE_HEADER_", "Site header");
define("_SITE_HEADER_DESC_", "After <body> tag");

define("_SITE_FOOTER_", "Site footer");
define("_SITE_FOOTER_DESC_", "Before </body> tag");

define("_SITE_HEAD_", "Site Head");
define("_SITE_HEAD_DESC_", "Between <head> </head> tags.");


####################################
#
### LICENSE KEY
#
####################################
define("_ENTER_LICENSE_KEY_", "Enter license key");
define("_LICENSE_KEY_", "License key");
define("_LICENSE_KEY_ACCEPTED_", "License key accepted");
define("_INVALID_LICENSE_KEY_", "The license key you entered is not valid for this site");

####################################
#
### EVENT REQUEST DESCRIPTION
#
####################################
define("_REQUEST_MODE_VIEW_ONLY_", "View-only members may submit event requests. Normal users may add events directly.");
define("_REQUEST_MODE_NORMAL_", "View-only members may only view the calendar. Normal users may submit event requests.");

#####################################
#
### TELL A FRIEND FOR GUEST E-MAILS
#
######################################
define("_TELL_A_FRIEND_", "Tell a friend");

define("_YOUR_NAME_", "Your name");
define("_YOUR_EMAIL_", "Your e-mail");

define("_YOUR_FRIENDS_NAME_","Your friend's name");
define("_YOUR_FRIENDS_EMAIL_","Your friend's e-mail");

define("_EMAIL_EVENT_DISPLAYED_","The event will be displayed below your message.");

define("_ALLOW_GUEST_USERS_EMAIL_", "Allow guest users to e-mail events.");

define("_DISABLE_SITE_ADDR_BOOK_", "Disable site address book for non-admins");

define("_EMAIL_TO_MULTIPLE_", "Separate multiple addresses with a comma.");

# MISC
########
define("_HELP_", "Help");
define("_WARNING_DIR_NOT_WRITABLE_", "Warning: The directory %s is not writable.");
define("_WARNING_FILE_NOT_WRITABLE_", "Warning: The file %s is not writable.");
define("_DOWNLOAD_", "Download");
define("_HIDE_QUICK_ADD_", "Hide Quick Add event box");
define("_FORCE_DEFAULT_OPTS_", "Force default options for all users. Set in Admin - Default Options.");
define("_NO_GUEST_TIMEZONE_", "Do not allow guest users to change timezone.");
define("_NUMBER_SYMBOL_", '#');
define("_DISABLE_WYSIWYG_EDITOR_", "Disable WYSIWYG editor for event notes.");
define("_SHOW_CALENDAR_NAMES_", "Show event calendar names when Show Event Category Names
	is set in a user's options.");
define("_MISC_", "Misc.");
define("_THEME_POPUPS_", "Apply theme to event notes popups.");

define("_PUBLIIC_", "Public");
define("_REGISTERED_USERS_", "Registered Users");

define("_NEW_", "New");

define("_CATEGORY_EDIT_DESC_", "To edit a category, click on its title");

define("_ARE_YOU_SURE_DELETE_", "Are you sure you want to delete this %s?");

########## END NEW TRANSLATIONS #################





################################
# EDIT / VIEW / POST CALENDARS
################################
define("_CALENDARS_", "Calendars");
define("_OWNER_", "Owner");
define("_ARE_YOU_SURE_DELETE_CALENDAR_", "Are you sure you want to delete this calendar?");

define("_COLOR_BY_", "Color events by");
define("_BY_OWNER_", "Event Owner");
define("_BY_CATEGORY_", "Event Category");
define("_BY_CALENDAR_", "Calendar");

define("_MODE_", "Mode");

define("_ALLOW_MULTI_CATS_", "Allow multiple categories for events");

define("_REMEMBER_LOCATIONS_", "Remember locations");

define("_STRICT_EVENT_SECURITY_", "Strict event security");
define("_STRICT_EVENT_SECURITY_DESC_", "Only the event owner or calendar admins can
   modify or delete existing events.");

define("_REMOTE_ACCESS_", "Remote Access");
define("_REMOTE_ACCESS_DESC_", "Remote access allows users to subscribe to this calendar remotely
	using a program such as Mozilla Sunbird, Windates, or Apple iCal. This will
	also enable RSS syndication, viewable from RSS readers (e.g., RssReader, Shrook)
	some content providers (e.g., Yahoo!, MSN), and content management tools (e.g., PHP-Nuke, Mambo).");

define("_ENABLE_REMOTE_ACCESS_UPD_", "Enable remote access updates. This allows authorized members to publish
updates to this calendar using a 3rd-party application.");

define("_REMOTE_ACCESS_DESC_USERS_", "If the Guest User is not a member of this calendar,
   persons attempting to access this calendar will require a username and password. Once authenticated,
   access is granted or denied based on its Members configuration.");

define("_SYNDICATION_", "Syndication");

define("_EDIT_EVENT_TYPES_", "Edit Categories");

define("_EVENT_TYPES_", "Categories");

define("_EVENT_TYPES_DESC_", "

       Leave all unselected to use all categories.<BR><BR>");

define("_MULTI_SELECT_WIN_","
       Windows: To unselect an item or select<br>multiple, non-concurrent items
       hold down<br>CTRL while selecting it.  ");

define("_REALLY_DELETE_EVENT_TYPE_", "Really delete category?"); # question
define("_DELETE_ALL_IN_CATEGORY_", "Delete all events in this category.");

define("_VIEWS_NO_ACTION_", "This action can not be performed on a view. Please
        select a calendar.");

define("_VIEW_INVALID_CAL_", "The current View contains a calendar you are not a member of. Events
from this calendar will not be displayed.");

define("_DESCRIPTION_", "Description");
define("_DETAILS_", "Details");
define("_PUBLISH_", "Post");
define("_PUBLISH_DESC_", "Publish this calendar to a remote web server or service such as
<a class='". _CAL_CSS_BODY_ ." ". _CAL_CSS_ULINE_."' target=_blank
href='http://icalx.com'>iCal Exchange</a>");
define("_SERVER_RESPONSE_", "Server Response");



######################
# EMAIL EVENT
######################
define("_EMAIL_EVENT_", "E-Mail");
define("_EMAIL_TO_", "To");
define("_SEND_EMAIL_", "Send");
define("_SUBJECT_", "Subject");
define("_MESSAGE_", "Message");
# e.g. The event has been sent to abcdefg@alphabet.com
define("_EMAIL_SENT_TO_", "The event has been sent to ");
define("_EMAIL_NO_ADDR_WARNING_", "Warning: you have not configured an
email address in the Contact Options section under Options. Your e-mail
will appear to come from ". @constant("_CAL_MAIL_FROM_"));

######################
# EMAIL SETTINGS
######################
define("_MAIL_PROG_PHP_", "PHP's mail function");
define("_MAIL_PROG_CMD_", "local mailer (sendmail, qmail, etc.)");
define("_MAIL_PROG_SERVER_", "SMTP server");

define("_MAIL_PROGRAM_", "Send mail using");

define("_MAIL_FROM_EMAIL_", "E-mail address");

define("_MAIL_PATH_", "local mailer path");
define("_MAIL_AUTH_", "SMTP Authentication");

define("_MAIL_AUTH_USER_", "SMTP username");
define("_MAIL_AUTH_PASS_", "SMTP password");

define("_MAIL_SERVER_", "SMTP server");
define("_MAIL_SERVER_PORT_", "Server Port");

##########################
# ATTACHMENT SETTINGS
##########################
define("_ALLOW_ATTACHMENTS_", "Allow file attachments");
define("_ATTACHMENTS_PATH_", "Attachments path");

#############################
# GROUPS AND USERS
#############################
define("_USERS_", "Users");
define("_GROUPS_", "Groups");
define("_EVERYONE_", "Everyone");
define("_SUPER_USER_", "Super User");

define("_MEMBERS_", "Members");
define("_MEMBERS_OF_", "Members of");

define("_NAME_", "Name");
define("_EMAIL_", "E-mail");

define("_ACCESS_LVL_", "Access Level");
define("_ROLE_", "Role");
define("_READ_ONLY_", "View Only");
define("_NORMAL_","Normal");

define("_ARE_YOU_SURE_DELETE_GROUP_", "Are you sure you want to delete this group?");
define("_GROUPS_SAVE_ATLEAST_1_MEMBER_", "Groups must have at least 1 member. Member list not saved.");

# displayed as form field must begin with a character. E.g.
# Username must begin with a character.
define("_MUST_BEGIN_WITH_CHAR_", "must begin with a character.");

######################
# REMINDERS
######################
define("_REMINDERS_", "Reminders");
define("_BEFORE_EVENT_","before this event, at");

define("_WILL_OCCUR_IN_", "Will occur in"); # event x will occur in 30 minutes



###########################
# EVEVNT REQUESTS
############################
define("_REQUEST_", "Event Request");
define("_REQUESTS_", "Event Requests");
define("_REQUEST_ACCEPTED_", "Your event request has been accepted.");
define("_REQUEST_REJECTED_", "Your event request has been rejected.");

define("_NOTIFY_REQUESTOR_", "Notify requestor");
define("_REQUEST_HAS_NOTIFY_", "The requestor had requested notification.");
define("_REQUESTS_NO_PENDING_", "There are no pending requests.");
define("_REQUEST_NOTIFY_EMAIL_", "Notify me of pending requests at");
define("_REQUEST_MSG_PRE_", "Message displayed to users before request is submitted.");
define("_REQUEST_MSG_POST_", "Message displayed to users after request is submitted.");
define("_REQUEST_NOTES_", "Additional Request Notes");
define("_REQUEST_NOTIFY_STATUS_", "Notify me of this request's status at");

define("_CONTACT_", "Contact");

# You have a pending event request on calendar: CALENDAR TITLE
define("_PENDING_REQUEST_", "You have a pending event request on calendar:");


#################
# DATE  ITEMS
#################
define("_CALENDAR_", "Calendar");

define("_MONTH_", "Month");
define("_MONTHS_", "Month(s)");

define("_DAY_","Day");
define("_DAYS_", "Day(s)");

define("_YEAR_", "Year");
define("_YEARS_", "Year(s)");

define("_WEEK_", "Week");

# Abbreviated week
define("_WEEK_ABBR_", "Week");

define("_WEEKS_", "Week(s)");

define("_HOUR_", "Hour");
define("_HR_", "hr");
define("_HOURS_", "hours");
define("_HRS_", "hrs");

define("_MINS_", "mins");
define("_MINUTES_", "minutes");

define("_DATE_", "Date");
define("_TIME_", "Time");

define("_AM_", "am");
define("_AM_SHORT_", "a");
define("_PM_", "pm");
define("_PM_SHORT_", "p");

# VIEWS
define("_TODAY_", "Today");
define("_THIS_WEEK_", "This Week");
define("_THIS_MONTH_", "This Month");

##################
# MISCELLANEOUS
##################
define("_EVENT_", "Event");
define("_EVENTS_", "Events");
define("_VIEW_", "View");

# VIEW AS A NOUN
define("_VIEW_NOUN_", "View");

define("_PRINTABLE_VIEW_", "Printable View");

define("_ALLDAY_", "All Day");

define("_CAL_CALL_FOR_TIMES_", "Call for times");
define("_CAL_CALL_FOR_TIMES_MIN_", "(*)");

define("_TYPE_","Type");
define("_EVENT_TYPE_", "Category");

define("_WIDTH_", "Width");

define("_COLORS_", "Colors");

# List separator. Note space after comma
define("_LIST_SEP_",", ");

###########################
# ADMIN PAGE 
###########################
define("_GLOBAL_SETTINGS_", "Site Settings");
define("_EDIT_DEFAULT_OPTS_", "Default Options");
define("_PASS_MUST_MATCH_", "The passwords you entered do not match");
define("_EMPTY_PASSWORD_", "Not setting password to \"\"!");
define("_ARE_YOU_SURE_DELETE_USER_", "Are you sure you want to delete this user?");
define("_DELETE_USERS_EVENTS_", "Delete all events owned by this user.");
define("_CALENDARS_OWNED_", "Calendars owned by this user");
define("_AUDIT_USERS_", "Audit Users");
define("_AUDIT_USERS_DESC_", "Users found in Thyme's database, but have no
corresponding entry in the current authentication module.<br>All user values
have been set to the uid of the missing user.");

define("_CALENDAR_PUBLISHER_", "Calendar Publisher");
define("_CAL_USER_GUEST_", "Guest Account");
define("_CAL_PUBLISH_GUEST_DISABLED_", "The Calendar Publisher will not work if
        the guest account is disabled.  Please enable this account in the Users section.");


####################################
# GENERAL ACTIONS AND RESPONSES
####################################
define("_ADD_", "Add");
define("_NEW_EVENT_", "New Event");
define("_REMOVE_", "Remove");
define("_UPDATE_", "Update");
define("_NEXT_", "Next");
define("_PREV_", "Prev");
define("_DELETE_", "Delete");
define("_SAVE_", "Save");
define("_TEST_", "Test");
define("_UPDATE_NOW_", "Update Now");
define("_SAVE_ADD_", "Save and Add Another");
define("_CANCEL_", "Cancel");
define("_BROWSE_", "Browse");
define("_NONE_", "None");
define("_RESET_", "Reset");
define("_CLEAR_ALL_", "Clear All");
define("_CHECK_ALL_", "Check All");
define("_EDIT_", "Edit");
define("_CLOSE_", "Close");
define("_SHOW_", "Show");
define("_HIDE_", "Hide");
define("_ENABLE_", "Enable");
define("_DISABLE_", "Disable");
define("_MOVE_", "Move");
define("_UP_", "Up");
define("_DOWN_", "Down");
define("_ENABLED_", "Enabled");
define("_CONFIGURE_", "Configure");
define("_ACCEPT_", "Accept");
define("_REJECT_", "Reject");
define("_OK_", "OK");
define("_FAILED_", "FAILED");
define("_CHANGE_", "Change");
define("_SORT_BY_", "Sort by");
define("_SEARCH_", "Search");
define("_FORCE_", "Force");
define("_AUTODETECT_", "Autodetect");
define("_RESET_PASS_", "Change Password");
define("_NEW_PASS_", "New Password");
define("_RETYPE_", "Retype");
define("_UPDATED_", "Updated");
define("_SUBMITTED_", "Submitted");
define("_LOGIN_", "Log in");
define("_USERNAME_", "Username");
define("_PASSWORD_", "Password");
define("_LOGOUT_", "Logout");
define("_OPTIONS_", "Options");
define("_ADMIN_", "Admin");
define("_BAD_PASS_", "Wrong username or password.");
define("_YES_", "Yes");
define("_NO_", "No");
define("_VALUE_", "Value");
define("_CUSTOM_", "Custom");
define("_DEFAULT_", "Default");

######################
# ATTACHMENTS
######################
define("_ATTACHMENTS_", "Attachments");
define("_ATTACH_DETACH_", "Detach");
define("_ATTACH_DELETE_", "Delete");
define("_ATTACHMENT_TOO_BIG_", "Attachment is larger than the allowed size.");
define("_DOWNLOAD_ZIP_", "Download Zip");
define("_UPDATE_ATTACHMENTS_", "Update Attachments");

define("_BYTES_", "b");
define("_KBYTES_", "KB");
define("_MBYTES_", "MB");


#################
# EVENT LIST VIEW 
#################
define("_ALL_", "All");
define("_UPCOMING_", "Upcoming");
define("_PAST_", "Past");

define("_SHOWING_", "showing");
define("_OF_", "of");
define("_FIRST_", "First");
define("_LAST_", "Last");
define("_SHOW_TYPE_", "Category");

define("_LIST_SIZE_", "List size");

define("_ARE_NO_EVENTS_", "There are no events to view.");

define("_EVENTS_CONTAINING_", "Events containing"); # used in event search

define("_ARE_YOU_SURE_DELETE_EVENTS_", "Are you sure you want to delete these events?");
define("_DELETE_REPEATING_WARNING_", "
   You have chosen to delete one or more repeating events.<br>
   All instances (past and future) of these events will be deleted! ");

define("_UNCHECK_NO_DELETE_", "Uncheck any events you do not wish to delete:");
define("_DELETE_CHECKED_", "Delete Checked");

define("_RETURN_", "Return");
define("_ERROR_", "Error!");

######################
# EVENT EDIT/ADD/VIEW
######################
define("_GENERAL_", "General");

define("_ORGANIZER_", "Organizer");

define("_URL_", "URL");

define("_REPEATING_", "Repeating");

define("_LOCATION_", "Location");

define("_APPLY_TO_", "Apply changes to");
define("_ALL_DATES_", "all dates");
define("_THIS_DATE_", "this date only");

define("_RESET_INSTANCE_", "Reset this instance to its original state");

define("_MAP_", "Map");

define("_STARTED_", "Started");

# e.g. Overrides event Weekly Meeting on 2004-2-34
define("_OVERRIDE_EVNT_ON_", "Overrides event %s on %s");

# e.g. Warning: the event Event Title has an invalid repeating rule
define("_INVALID_RRULE_", "Warning: The event %s has an invalid repeating rule.");

define("_MAX_CHARS_", "maximum chars");
define("_EVENT_INFO_", "Event Information");
define("_TITLE_", "Title");
define("_NOTES_", "Notes");

define("_CHECK_FOR_CONFLICTS_", "Check for conflicts");

define("_THIS_EVENT_ALLDAY_", "This is an <b>all day</b> event.");
define("_STARTS_AT_", "Starts at");
define("_DURATION_", "Duration");

define("_FLAG_", "Flag");
define("_FLAG_THIS_", "Flag this event");
define("_IS_FLAGGED_", "This event is flagged");

# e.g. 10 days ago
define("_AGO_", "ago");

define("_REPEATING_NO_", "This event does not repeat.");
define("_REPEATING_REPEAT_", "Repeat");
define("_REPEATING_SELECTED_", "selected days");
define("_REPEATING_EVERY1_", "every");

define("_REPEAT_ON_", "Repeat on the");
define("_REPEAT_ON1_", "first");
define("_REPEAT_ON2_", "second");
define("_REPEAT_ON3_", "third");
define("_REPEAT_ON4_", "fourth");
define("_REPEAT_ON5_", "fith");
define("_REPEAT_ONL_", "last");
define("_REPEAT_ON_OF_", "of the month, every");

define("_SIMPLE_", "Simple");
define("_ADVANCED_","Advanced");

define("_YEARLY_", "Yearly");
define("_MONTHLY_", "Monthly");
define("_WEEKLY_", "Weekly");
define("_DAILY_", "Daily");
define("_EASTER_", "Easter");
define("_EASTER_YEARLY_", "Easter Yearly");

define("_MONTH_DAYS_", "Month Day(s)");
define("_FROM_LAST_", "from Last");

define("_WEEKDAYS_", "Weekday(s)");

define("_YEARLY_NOTES_", "Default month and day are taken from
        start date if none are selected.");


define("_SPECIFIC_OCCURRENCES_", "Specific Occurrences");

define("_STARTING_ON_", "starting on");

define("_BEFORE_", "Before");
define("_AFTER_", "After");

define("_EXCLUDE_DATES_", "Exclude Dates");

define("_CONFIRM_EVNT_RPT_CHANGE_", "You are changing the recurrence rule or dates of this event.\n
All exceptions accociated with this recurring event will be lost. Are you sure you want to do this?\n");


define("_END_DATE_", "End Date");
define("_END_DATE_NO_", "No End Date");
define("_END_DATE_UNTIL_", "Until");
define("_END_DATE_AFTER_", "End after");
define("_OCCURRENCES_", "occurrences");

define("_ADDRESS_", "Address");
define("_ADDRESS_1_", "Street");
define("_ADDRESS_2_", "City, ST ZIP");

define("_PHONE_", "Phone");
define("_ICON_", "Icon");

#####################
# MODULES
#####################
define("_NAVBAR_", "Nav Bar");
define("_MODULE_", "Module");
define("_MODULES_", "Modules");
define("_TODAY_LINK_", "Today Link");
define("_MINI_CAL_", "Mini Cal");
define("_CALENDAR_LINKS_", "Calendar Links");
define("_IMAGE_BROWSER_", "Image Browser");
define("_QUICK_ADD_EVNT_", "Quick Add Event");
define("_GOTO_DATE_", "Goto Date");
define("_SEARCH_EVENTS_", "Search Events");
define("_EVENT_FILTER_", "Category");
define("_COLOR_LEGEND_", "Legend");

##################
# SYNC 
##################

define("_SYNC_", "Sync");
define("_IMPORT_", "Import");
define("_EXPORT_", "Export");
define("_IMPORT_FROM_", "Import from");
define("_EXPORT_TO_", "Export to");
define("_SYNC_DUPLICATES_", "If duplicates are found");
define("_IGNORE_DUPLICATES_", "Ignore duplicates");
define("_OVERWRITE_EXISTING_EVENT_", "Overwrite existing event");
define("_CREATE_NEW_EVENT_", "Create new event");
define("_IMPORT_AS_", "Import to category");
define("_EVENTS_IMPORTED_", "Events Imported");
define("_SYNC_IMPORT_ERROR_", "Error: There was an error parsing the file you attempted to import.");
define("_HTML_", "HTML");
define("_PLAINTEXT_", "Plain text");
define("_ICAL_", "iCalendar (.ics)");
define("_QUIRKS_MODE_", "Quirks Mode");
define("_PERMISSION_DENIED_", "Permission denied: You are not the owner of this event or an
administrator of this calendar.");
define("_FULL_SYNC_", "Full Sync");
define("_FULL_SYNC_DESC_", "Delete events that exist in Thyme but aren't found in the imported file.");

#########################
# CSS AND STYLE
#########################
define("_COLOR_", "Color");

define("_STYLE_", "Style");

define("_PREVIEW_", "Preview");
define("_SAMPLE_", "Sample");

define("_BACKGROUND_COLOR_", "Background Color");
define("_FONT_COLOR_", "Font Color");
define("_FONT_SIZE_", "Font Size");

define("_FONT_STYLE_", "Font Style");
define("_BOLD_", "bold");
define("_ITALICS_", "italics");
define("_UNDERLINE_", "underline");

define("_FONT_FAMILY_", "Font Family");
define("_FONT_FAMILY_DESC_", "E.g. Tahoma, 'Sans Serif', Arial");

define("_UNDERLINE_LINKS_", "Underline Links");
define("_NEVER_", "Never");
define("_ALWAYS_", "Always");
define("_HOVER_", "Hover");
define("_BORDER_COLOR_", "Border Color");
define("_TIME_FONT_COLOR_", "Time Font Color");
define("_TITLE_FONT_COLOR_", "Title Font Color");
define("_TITLE_FONT_STYLE_", "Title Font Style");

#########################
# CALENDAR PUBLISHER
#########################
if(@constant("_CAL_DOING_PUBLISHER_")) { # <- leave this line alone

define("_MINI_MONTH_", "Mini Month");

define("_SET_DATE_CURRENT_", "Set to current date");
define("_EDITABLE_", "Editable");
define("_STATIC_", "Static");
define("_STATIC_DESC_", "Calendar content contains no links that change date or view");
define("_HIL_DAY_", "Highlight Day");
define("_HIL_WEEK_", "Highlight Week");

define("_APPLY_CSS_FROM_", "Apply Style from");
define("_NO_CSS_", "none");
define("_CSS_EDITOR_", "Style Editor");

define("_LANGUAGE_", "Language");
define("_EURO_DATE_", "European style date");
define("_EURO_DATE_DESC_", "Dates displayed as dd/mm/yyyy where applicable");

define("_HEADER_", "Header");
define("_WEEKDAY_HEADER_", "Weekday Header");

define("_NORMAL_DAYS_", "Normal Days");
define("_DAYS_NOT_IN_MONTH_", "Days not in month");
define("_HIGHLIGHTED_DAYS_", "Highlighted Days");

define("_NORMAL_EVENTS_", "Normal Events");
define("_FLAGGED_EVENTS_", "Flagged Events");

define("_SHOW_EVENTS_", "Show Events");


define("_EVENT_LINKS_", "Event Links");

define("_EVENT_LINK_URL_", "Event Link URL");

define("_EVENT_LINK_URL_DESC_", "

        This url will be passed a query string containing
        <font class='"._CAL_CSS_HIL_."'>eid</font> and <font class='"._CAL_CSS_HIL_."'>instance</font>.<br>

        <b>eid</b> is the ID of the event and <b>instance</b> is the date in
        <b>YYYY-MM-DD</b> format.<br>These are noted by <font class='"._CAL_CSS_HIL_."'>%eid</font>
        and <font class='"._CAL_CSS_HIL_."'>%inst</font>.<br><br>

        E.g. http://mysite.com/sales/view_sale.php?eid=%eid&instance=%inst may yield:<br>

        http://mysite.com/sales/view_sale.php?<font
		class='"._CAL_CSS_HIL_."'>eid</font>=56&<font
		class='"._CAL_CSS_HIL_."'>instance</font>=2005-10-26<br><br>
 
        See the Reference and/or Tutorial on the Thyme website for more information
        on how to use these. ");


define("_SHOW_HEADER_", "Show Header");
define("_ALIGN_HEADER_TEXT_", "Align Header Text");
define("_CENTER_", "Center");
define("_HEADER_TEXT_", "Header Text");

define("_HEADER_TEXT_DESC_","

   (E.g. <font class='"._CAL_CSS_HIL_."'>Birthdays in %month</font>)<br>
        <font size=1><i>Leave blank to use the
        default header. Other variables include %weekday, %mday, %mon and %year.</i></font> ");


define("_SHOW_HEADER_LINKS_", "Show Header Links");

define("_NEXT_LINK_", "'Next' link");
define("_PREV_LINK_", "'Previous' link");

define("_IMG_URL_", "Image URL");

define("_HEADER_LINKS_", "Header Links");

define("_IMG_URL_DESC_", "
        This can be text such as '<<' or a URL to an image<br>
        (E.g. <font
        class='"._CAL_CSS_HIL_."'>http://www.myserver.com/images/next.gif</font>)<br><font
        size=1><i>Leave these blank to use the default image from the
        selected theme.</i></font> ");


define("_DAY_VIEW_", "Day View");

define("_MONTH_VIEWS_", "Month Views");

define("_SHOW_WEEKS_DESC_", "Note: Mini-month calendar will never show week numbers");

define("_ROW_HEIGHT_", "Row Height");
define("_ROW_HEIGHT_DESC_", "Default is '90' for a Month, '0' for a Mini-month");

define("_LIMIT_WEEKDAY_NAMES_", "Limit weekday names to ");
define("_CHARS_", "chars");

define("_EXCLUDE_MONTH_DAYS_", "Exclude days not in month");

define("_MINI_MONTH_DATE_URL_", "Mini-month date URL");

define("_MINI_MONTH_DATE_URL_DESC_", "
        The link that clicking on a day in a Mini-month
        calendar will point to. This replaces the following strings:<br>

        %d = the day number<br>
        %m = the month number<br>
        %y = the year number<br>

        <br><br>

        E.g. http://www.myserver.com/page.php?day=%d&month=%m&year=%y<br>
        may yield
        <font class='"._CAL_CSS_HIL_."'>http://www.myserver.com/page.php?day=23&month=11&year=2004</font>

        <br>or you may even use a JavaScript function.<br>

        E.g. <font class='"._CAL_CSS_HIL_."'>javascript:myFunction(%y,%m,%d)</font><br><br>

        The default is a link to the current page that sets:<br>
        m = %m<br>
        d = %d<br>
        y = %y<br>

        E.g. <font class='"._CAL_CSS_HIL_."'>index.php?d=23&m=11&y=2004</font><br><br>
        See the Reference and/or Tutorial on the Thyme website for more
        information on how to use these.");


define("_GENERATED_CODE_", "Generated Code");

define("_BASE_PATH_DESC_", "base path of thyme with trailing slash");
define("_BASE_URL_DESC_", "base url of thyme with trailing slash");

} # </ CALENDAR PUBLISHER SECTION > <- leave this line alone


######################
#
### RSS FEED MODULES
#
#####################
define("_RSS_FEED_MODULES_", "RSS Feed Modules");
define("_RSS_", "RSS Feeds");
define("_UPDATE_INTERVAL_", "Update interval");
define("_ARE_YOU_SURE_DELETE_RSSMOD_", "Are you sure you want to delete this RSS module?");
define("_AUTHOR_", "Author");

# scrolling
define("_SCROLLING_","Scrolling");
define("_OVERFLOW_", "Overflow");
define("_SCROLLBAR_", "Scrollbar");
define("_AUTOSCROLL_", "Autoscrolling");


# This will keep us from needing to
# have these defined when not looking
# at options
#####################################
if(@constant("_CAL_DOING_OPTS_")) { # <- leave this line alone

######################
# OPTION STRINGS
######################

define("_DEFAULT_VIEW_", "Default view");

define("_DEFAULT_CALENDAR_", "Default calendar");

define("_TIME_INTERVALS_", "Time intervals");

define("_EVNT_SIZE_", "Event size");
define("_SMALLER_", "Smaller");
define("_SMALLEST_", "Smallest");
define("_EVNT_COLLAPSE_", "Collapse events (Month view)");
define("_EVNT_COLLAPSE_DESC_", "Collapse long event titles.");
define("_EVNT_TYPE_NAME_", "Show event category names");
define("_EVNT_POPUP_", "Event popup");
define("_EVNT_POPUP_DESC_", "Display events in a new window.");
define("_EVNT_NOTES_POPUP_", "Event notes popup");
define("_EVNT_NOTES_POPUP_DESC_", "Hover your mouse over an event
	to view its notes.");

define("_POSITION_", "Position");

define("_SHOW_WEEKS_", "Show week numbers");

define("_WEEK_START_", "Week starts on");
define("_WORK_HOURS_", "Work hours");
define("_WORK_HOURS_START_", "starts at");
define("_WORK_HOURS_END_", "ends at");

define("_HOUR_FORMAT_", "Hour format");
define("_HOUR_FORMAT_12_", "12 hr");
define("_HOUR_FORMAT_24_", "24 hr");

define("_NAV_BAR_LOC_", "Nav bar");
define("_RIGHT_", "Right");
define("_LEFT_", "Left");

define("_TIMEZONE_", "Time zone");
define("_DST_", "Daylight Saving Time");
define("_STARTS_", "Starts");
define("_ENDS_", "Ends");

define("_IN_", "in");
define("_ON_", "ON");
define("_OFF_", "OFF");

define("_THEME_", "Theme");

##########################
# CONTACT OPTIONS
##########################
define("_CONTACT_OPTS_", "Contact Options");
define("_PRIMARY_", "Primary");
define("_FORMAT_", "Format");

##########################
# SUBSCRIPTIONS
##########################
define("_SUBSCRIPTIONS_", "Subscriptions");
define("_SUBSCRIPTIONS_DESC_", "E-mail subscriptions to calendars.");

######################
# NOTIFICATIONS
#####################
define("_NOTIFICATIONS_", "Notifications");
define("_NOTIFICATIONS_DESC_", "Notification filters for new and updated events.");

define("_TITLE_CONTAINS_", "Title contains");
# event X has been updated on calendar Y
define("_UPDATED_ON_", "has been updated on");
# event X has been added to calendar Y
define("_ADDED_TO_", "has been added to");

#####################
# DST STRINGS
#####################
define("_DST_OPTS1_", "Africa / Egypt");
define("_DST_OPTS2_", "Africa / Namibia");
define("_DST_OPTS3_", "Asia / USSR (former) - most states");
define("_DST_OPTS4_", "Asia / Iraq");
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
define("_WARNING_ATTACH_", "Warning: Attachments directory %s does not exist or is not writable.");
define("_WARNING_RSS_", "Warning: RSS feed repository %s is not writable.");
define("_WARNING_INSTALL_", "Warning: %s still exists. Please remove this file.");
define("_WARNING_LICENSE_", "Warning: Thyme's license will expire in %s days.");


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
  "Sunday",
  "Monday",
  "Tuesday",
  "Wednesday",
  "Thursday",
  "Friday",
  "Saturday");

$_cal_months or $_cal_months = array(1 => 
  "January",
  "February",
  "March",
  "April",
  "May",
  "June",
  "July",
  "August",
  "September",
  "October",
  "November",
  "December");

# ABBREVIATED
#################
$_cal_weekdays_abbr or $_cal_weekdays_abbr = array(
  "Sun",
  "Mon",
  "Tue",
  "Wed",
  "Thu",
  "Fri",
  "Sat");

$_cal_months_abbr or $_cal_months_abbr = array(1 =>
  "Jan",
  "Feb",
  "Mar",
  "Apr",
  "May",
  "Jun",
  "Jul",
  "Aug",
  "Sep",
  "Oct",
  "Nov",
  "Dec");



?>
