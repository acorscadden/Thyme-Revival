
-- 
--  Table structure for table _db_pref_Attachments
-- 

CREATE SEQUENCE _db_pref_attachments_id_seq MINVALUE 1 START 1 INCREMENT 1;

CREATE TABLE _db_pref_Attachments (
  id bigint NOT NULL PRIMARY KEY default nextval('_db_pref_attachments_id_seq'::text),
  eid bigint NOT NULL,
  filename varchar(255),
  filesize bigint,
  filetype varchar(128),
  filedata OID
);

CREATE INDEX _db_pref_ca_eid on _db_pref_Attachments(eid);
CREATE INDEX _db_pref_ca_filetype on _db_pref_Attachments(filetype,filename);

--  --------------------------------------------------------

-- 
--  Table structure for table _db_pref_CalendarMembers
-- 

CREATE TABLE _db_pref_CalendarMembers (
  cid bigint NOT NULL default 0,
  rid bigint NOT NULL default 0,
  rtype int NOT NULL default 0,
  access_lvl int NOT NULL default 0
);

CREATE INDEX _db_pref_ccm_cid on _db_pref_CalendarMembers(cid);
CREATE INDEX _db_pref_ccm_rid on _db_pref_CalendarMembers(rid,rtype);
CREATE INDEX _db_pref_ccm_rid_2 on _db_pref_CalendarMembers(rid);
CREATE INDEX _db_pref_ccm_rtype on _db_pref_CalendarMembers(rtype);
CREATE UNIQUE INDEX _db_pref_ccm_cid_3 on _db_pref_CalendarMembers(cid,rid,rtype);


--  --------------------------------------------------------

-- 
--  Table structure for table _db_pref_Calendars
-- 

CREATE SEQUENCE _db_pref_calendars_id_seq MINVALUE 1 START 1 INCREMENT 1;

CREATE TABLE _db_pref_Calendars (
  id bigint NOT NULL PRIMARY KEY default nextval('_db_pref_calendars_id_seq'::text),
  title varchar(64) NOT NULL default 'calendar',
  type int2 NOT NULL default 0,
  owner bigint NOT NULL default 1,
  options bigint,
  description varchar(255),
  request_pre varchar(1024),
  request_post varchar(1024),
  request_notify int2 default 0,
  request_contact bigint default 0
);

--  --------------------------------------------------------

-- 
--  Table structure for table _db_pref_ContactOpts
-- 

CREATE SEQUENCE _db_pref_contactopts_id_seq MINVALUE 1 START 1 INCREMENT 1;

CREATE TABLE _db_pref_ContactOpts (
  id bigint NOT NULL PRIMARY KEY default nextval('_db_pref_contactopts_id_seq'::text),
  uid bigint NOT NULL default 0,
  email varchar(128)
);

CREATE INDEX _db_pref_cco_uid on _db_pref_ContactOpts(uid);

--  --------------------------------------------------------

-- 
--  Table structure for table _db_pref_DST
-- 

CREATE SEQUENCE _db_pref_dst_id_seq MINVALUE 1 START 1 INCREMENT 1;

CREATE TABLE _db_pref_DST (
  id int NOT NULL PRIMARY KEY default nextval('_db_pref_dst_id_seq'::text),
  title varchar(55),
  starttime int,
  endtime int NOT NULL default 0,
  repeat_on int NOT NULL default 0,
  repeat_on_wday int NOT NULL default 0,
  repeat_on_end int NOT NULL default 0,
  repeat_on_wday_end int NOT NULL default 0,
  rrule_st varchar(255),
  rrule_end varchar(255)
);

--  --------------------------------------------------------

-- 
--  Table structure for table _db_pref_EventTypes
-- 

CREATE TABLE _db_pref_EventTypes (
  id bigint NOT NULL default 0,
  name varchar(30) NOT NULL default '',
  icon varchar(255),
  background varchar(32),
  border varchar(32),
  timecolor varchar(32),
  titlecolor varchar(32),
  fontweight varchar(32),
  fontstyle varchar(32),
  textdecoration varchar(32),
  calendar bigint NOT NULL default 0
);

CREATE INDEX _db_pref_cet_calendar on _db_pref_EventTypes(calendar);
CREATE INDEX _db_pref_cet_calendar_2 on _db_pref_EventTypes(calendar,name);


--  --------------------------------------------------------

-- 
--  Table structure for table _db_pref_Events
-- 

CREATE SEQUENCE _db_pref_events_id_seq MINVALUE 1 START 1 INCREMENT 1;

CREATE TABLE _db_pref_Events (
  id bigint NOT NULL PRIMARY KEY default nextval('_db_pref_events_id_seq'::text),
  version bigint default 1,
  uid varchar(255),
  owner bigint NOT NULL default 1,
  org_name varchar(255),
  org_email varchar(255),
  url varchar(255),
  override_id bigint default 0,
  override_date bigint,
  etype bigint default 0,
  calendar bigint NOT NULL default 1,
  flag int2 default 0,
  title varchar(255) default 'EVENT',
  notes varchar(4000),
  starttime bigint NOT NULL default 0,
  endtime bigint,
  next bigint,
  allday int2 default 1,
  duration time default '00:00:00',
  freq int,
  finterval int,
  byday varchar(255),
  bymonthday varchar(255),
  bymonth varchar(255),
  icon varchar(255),
  bysetpos varchar(255),
  wkst int,
  timezone float default 0,
  dst int,
  location varchar(255),
  addr_st varchar(40),
  addr_ci varchar(40),
  phone varchar(30),
  end_after int,
  added bigint NOT NULL default 0,
  updated bigint NOT NULL default 0,
  use_tz int default 1
);

CREATE INDEX _db_pref_ce_calendar on _db_pref_Events(calendar);
CREATE INDEX _db_pref_ce_etype on _db_pref_Events(etype,calendar);
CREATE INDEX _db_pref_ce_override_id on _db_pref_Events(override_id);
CREATE INDEX _db_pref_ce_override_date on _db_pref_Events(override_date);
CREATE INDEX _db_pref_ce_starttime on _db_pref_Events(starttime);
CREATE INDEX _db_pref_ce_calendar_3 on _db_pref_Events(calendar,etype);
CREATE INDEX _db_pref_ce_freq on _db_pref_Events(freq);
CREATE INDEX _db_pref_ce_finterval on _db_pref_Events(finterval);


--  --------------------------------------------------------

-- 
--  Table structure for table _db_pref_Exceptions
-- 

CREATE SEQUENCE _db_pref_exceptions_id_seq MINVALUE 1 START 1 INCREMENT 1;

CREATE TABLE _db_pref_Exceptions (
  id bigint NOT NULL PRIMARY KEY default nextval('_db_pref_exceptions_id_seq'::text),
  eid bigint NOT NULL default 0,
  exdate bigint NOT NULL default 0
);

CREATE INDEX _db_pref_cex_eid on _db_pref_Exceptions(eid);
CREATE INDEX _db_pref_cex_eid2 on _db_pref_Exceptions(eid,exdate);

--  --------------------------------------------------------

-- 
--  Table structure for table _db_pref_GroupMembers
-- 

CREATE TABLE _db_pref_GroupMembers (
  gid bigint NOT NULL default 0,
  uid bigint NOT NULL default 0
);

CREATE INDEX _db_pref_cgm_gid on _db_pref_GroupMembers(gid);
CREATE INDEX _db_pref_cgm_uid on _db_pref_GroupMembers(uid);

--  --------------------------------------------------------

-- 
--  Table structure for table _db_pref_Groups
-- 

CREATE SEQUENCE _db_pref_groups_id_seq MINVALUE 1 START 1 INCREMENT 1;

CREATE TABLE _db_pref_Groups (
  id bigint NOT NULL PRIMARY KEY default nextval('_db_pref_groups_id_seq'::text),
  name varchar(128) UNIQUE NOT NULL default '',
  description varchar(255) default ''
);

--  --------------------------------------------------------

-- 
--  Table structure for table calModuleSettings
-- 

CREATE TABLE _db_pref_ModuleSettings (
  module varchar(32) NOT NULL default '',
  variable varchar(32) NOT NULL default '',
  setting varchar(128),
  uid bigint
);

CREATE INDEX _db_pref_cms_setting on _db_pref_ModuleSettings(uid,module,variable);

--  --------------------------------------------------------

-- 
--  Table structure for table _db_pref_NavModules
-- 

CREATE TABLE _db_pref_NavModules (
  module varchar(32) NOT NULL default '',
  mod_order int,
  uid bigint,
  leftright int2 default 0,
  PRIMARY KEY(module,uid)
);

CREATE INDEX _db_pref_cnm_uid on _db_pref_NavModules(uid);
CREATE INDEX _db_pref_cnm_uid2 on _db_pref_NavModules(uid,mod_order);

--  --------------------------------------------------------

-- 
--  Table structure for table calNotifications
-- 

CREATE SEQUENCE _db_pref_notifications_id_seq MINVALUE 1 START 1 INCREMENT 1;

CREATE TABLE _db_pref_Notifications (
  id bigint NOT NULL PRIMARY KEY default nextval('_db_pref_notifications_id_seq'::text),
  uid bigint NOT NULL default 0,
  cid bigint NOT NULL default 0,
  name varchar(32),
  etype bigint,
  titlecontains varchar(32),
  contact bigint default 0
);

CREATE INDEX _db_pref_cn_cid on _db_pref_Notifications(cid);

--  --------------------------------------------------------

-- 
--  Table structure for table calRSSModule
-- 

CREATE SEQUENCE _db_pref_rssmodule_id_seq MINVALUE 1 START 1 INCREMENT 1;

CREATE TABLE _db_pref_RSSModule (
  id bigint NOT NULL PRIMARY KEY default nextval('_db_pref_rssmodule_id_seq'::text),
  title varchar(32),
  url varchar(255),
  upd_interval int,
  username varchar(32),
  password varchar(32),
  style varchar(32),
  scrolling int2 default 0,
  description varchar(255)
);

--  --------------------------------------------------------

-- 
--  Table structure for table _db_pref_Reminders
-- 

CREATE SEQUENCE _db_pref_reminders_id_seq MINVALUE 1 START 1 INCREMENT 1;

CREATE TABLE _db_pref_Reminders (
  id bigint NOT NULL PRIMARY KEY default nextval('_db_pref_reminders_id_seq'::text),
  eid bigint NOT NULL default 0,
  uid bigint NOT NULL default 0,
  remindtime bigint NOT NULL default 0,
  contact bigint NOT NULL default 0
);

CREATE INDEX _db_pref_cr_eid on _db_pref_Reminders(eid);
CREATE INDEX _db_pref_cr_uid on _db_pref_Reminders(uid,eid,remindtime);

--  --------------------------------------------------------

-- 
--  Table structure for table _db_pref_Requests
-- 

CREATE SEQUENCE _db_pref_requests_id_seq MINVALUE 1 START 1 INCREMENT 1;

CREATE TABLE _db_pref_Requests (
  id bigint NOT NULL PRIMARY KEY default nextval('_db_pref_requests_id_seq'::text),
  serial int default 0,
  uid varchar(255),
  owner bigint NOT NULL default 1,
  org_name varchar(255),
  org_email varchar(255),
  url varchar(255),
  override_id bigint default 0,
  override_date bigint,
  etype bigint default 0,
  calendar bigint NOT NULL default 1,
  flag int2 default 0,
  title varchar(255) default 'EVENT',
  notes varchar(4000),
  starttime bigint,
  endtime bigint,
  next bigint,
  allday int2 default 1,
  duration time default '00:00:00',
  freq int,
  finterval int,
  byday varchar(255),
  bymonthday varchar(255),
  bymonth varchar(255),
  icon varchar(255),
  bysetpos varchar(255),
  wkst int,
  timezone float default 0,
  dst int2,
  location varchar(255),
  addr_st varchar(40),
  addr_ci varchar(40),
  phone varchar(30),
  end_after int,
  added bigint NOT NULL default 0,
  updated bigint NOT NULL default 0,
  request_notify int2 default 0,
  request_notes varchar(255),
  request_contact varchar(128),
  use_tz int2 default 1
);

--  --------------------------------------------------------

-- 
--  Table structure for table _db_pref_Sessions
-- 

CREATE TABLE _db_pref_Sessions (
  session_id varchar(32) NOT NULL PRIMARY KEY default '',
  session_data text,
  session_expiration bigint
);

--  --------------------------------------------------------

-- 
--  Table structure for table _db_pref_Subscriptions
-- 

CREATE SEQUENCE _db_pref_subscriptions_id_seq MINVALUE 1 START 1 INCREMENT 1;

CREATE TABLE _db_pref_Subscriptions (
  id bigint NOT NULL PRIMARY KEY default nextval('_db_pref_subscriptions_id_seq'::text),
  uid bigint NOT NULL default 0,
  calendar bigint NOT NULL default 0,
  view int,
  contact bigint
);

--  --------------------------------------------------------

-- 
--  Table structure for table _db_pref_UserOptions
-- 

CREATE TABLE _db_pref_UserOptions (
  e_popup int2 default 1,
  e_n_popup int2 default 1,
  default_view varchar(10) NOT NULL default 'm',
  theme varchar(32) NOT NULL default 'default',
  hour_format int2 NOT NULL default '12',
  week_start int2 NOT NULL default 0,
  workday_start_hr int2 NOT NULL default '9',
  workday_end_hr int2 NOT NULL default '18',
  time_interval int2 NOT NULL default '4',
  timezone float NOT NULL default 0,
  dst int2 NOT NULL default '-1',
  id bigint NOT NULL PRIMARY KEY default 0,
  default_cal bigint default 0,
  e_size int2 default 0,
  e_collapse int2 default 0,
  e_typename int2 default 0,
  show_weeks int2 default 1
);

--  --------------------------------------------------------

-- 
--  Table structure for table _db_pref_Users
-- 

CREATE SEQUENCE _db_pref_users_id_seq MINVALUE 2 START 2 INCREMENT 1;

CREATE TABLE _db_pref_Users (
  id bigint NOT NULL PRIMARY KEY default nextval('_db_pref_users_id_seq'::text),
  userid varchar(32) UNIQUE NOT NULL default '',
  pass varchar(32),
  name varchar(128),
  email varchar(128),
  access_lvl int2 default 0
);
    

--  --------------------------------------------------------
--
--  Table structure for table `_db_pref_GlobalSettings`
--

CREATE TABLE _db_pref_GlobalSettings (
  variable varchar(32) NOT NULL PRIMARY KEY,
  setting varchar(255)
);


