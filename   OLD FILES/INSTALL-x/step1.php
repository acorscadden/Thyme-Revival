<?php

//
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 eXtrovert Software and Thymenews                  |
// +----------------------------------------------------------------------+
// | This source file is subject to the license you agreed to when this   |
// | software package was installed. A copy of the license has also been  |
// | distributed with this software. See LICENSE.txt under the base       |
// | install directory. If you do not have a copy of this license file,   |
// | or obtained this software through a 3rd party without agreeing to    |
// | the license, please cease using this software and send an e-mail to  |
// | license@thymenews.com.                                               |
// +----------------------------------------------------------------------+
//


  function check_step1 ()
  {
    global $_cal_config;
    $drivers = array ('mysql' => 'mysql_connect', 'pgsql' => 'pg_connect', 'mssql' => 'mssql_connect');
    if (!function_exists ($drivers[$_REQUEST['db_driver']]))
    {
      echo '<BR>' . _ERROR_ . ': your PHP installation does not have support
	for the database driver you have selected. Consult the PHP documentation
	for instructions on how to enable support for your database.<br>';
      return 0;
    }

    if (($_REQUEST['db_driver'] == 'mysql' AND !$_REQUEST['db_host']))
    {
      $_REQUEST['db_host'] = 'localhost';
    }

    if ((($_cal_config['_cal_exists_'] AND $_REQUEST['db_user'] == $_cal_config['_CAL_DBUSER_']) AND strlen ($_REQUEST['db_pass'] == 0)))
    {
      $_REQUEST['db_pass'] = $_cal_config['_CAL_DBPASS_'];
    }

    if ($_REQUEST['inst_user'])
    {
      define ('_CAL_DBUSER_', $_REQUEST['inst_user']);
      define ('_CAL_DBPASS_', $_REQUEST['inst_pass']);
    }
    else
    {
      define ('_CAL_DBUSER_', $_REQUEST['db_user']);
      define ('_CAL_DBPASS_', $_REQUEST['db_pass']);
    }

    define ('_CAL_DBHOST_', $_REQUEST['db_host']);
    define ('_CAL_DBPORT_', $_REQUEST['db_port']);
    if ((!$_REQUEST['create_db'] OR $_REQUEST['db_driver'] == 'orcl'))
    {
      define ('_CAL_DBNAME_', $_REQUEST['db_name']);
    }
    else
    {
      if (($_REQUEST['create_db'] AND $_REQUEST['db_driver'] == 'pgsql'))
      {
        define ('_CAL_DBNAME_', 'template1');
      }
    }

    define ('_CAL_SQL_DRIVER_', $_REQUEST['db_driver']);
    require_once 'include/classes/class.sql.php';
    $s = new _cal_sql ();
    if (!$s->_connected)
    {
      echo '<br>' . _ERROR_ . ': the user <b>' . @constant ('_CAL_DBUSER_') . '</b> could not connect';
      if (@constant ('_CAL_DBNAME_'))
      {
        echo ' to the <b>' . @constant ('_CAL_DBNAME_') . '</b> database';
      }

      echo '.<br>';
      return 0 - 1;
    }

    $retval = 1;
    if (($_REQUEST['create_db'] AND $_REQUEST['db_driver'] != 'orcl'))
    {
      $retval = $s->query ('create database ' . $_REQUEST['db_name']);
      if (($_REQUEST['db_driver'] == 'mysql' AND $_REQUEST['inst_user']))
      {
        $s->query ('grant all on ' . $_REQUEST['db_name'] . '.* to \'' . $_REQUEST['db_user'] . '\'@\'' . $_REQUEST['db_host'] . '\'');
        $s->query ('flush privileges');
      }
      else
      {
        if ($_REQUEST['db_driver'] == 'mssql')
        {
          mssql_select_db ($_REQUEST['db_name'], $s->dbHandle);
        }
      }

      if (!$retval)
      {
        return 0;
      }
    }

    if (($_REQUEST['create_user'] OR $_REQUEST['grant_user']))
    {
      if ($_REQUEST['db_driver'] == 'mysql')
      {
        if (!$s->query ('grant all on ' . $_REQUEST['db_name'] . '.* to \'' . $_REQUEST['db_user'] . '\'@\'' . $_REQUEST['db_host'] . '\'' . ($_REQUEST['create_user'] ? ' identified by \'' . $_REQUEST['db_pass'] . '\'' : '')))
        {
          return 0;
        }

        if (!$s->query ('flush privileges'))
        {
          return 0;
        }
      }
      else
      {
        if ($_REQUEST['db_driver'] == 'pgsql')
        {
          if (!$s->query ('create user ' . $_REQUEST['db_user'] . ' ' . 'with password \'' . $_REQUEST['db_pass'] . '\''))
          {
            return 0;
          }
        }
        else
        {
          if ($_REQUEST['db_driver'] == 'mssql')
          {
            $s->query ('' . 'grant all on ' . $_REQUEST['db_name'] . ' to ' . $_REQUEST['db_user']);
          }
          else
          {
            if ($_REQUEST['db_driver'] == 'orcl')
            {
              if ($_REQUEST['create_user'])
              {
                list ($df) = $s->query ('SELECT NAME from v$datafile where FILE# =
			(select MAX(FILE#) from v$datafile)');
                $df = dirname ($df['name']);
                $s->query ('CREATE TABLESPACE ' . $_REQUEST['db_user'] . '
                DATAFILE \'' . $df . '/' . $_REQUEST['db_user'] . '.dbf\'
                SIZE 10M
                AUTOEXTEND ON NEXT 10M');
                if (!$s->query ('create user ' . $_REQUEST['db_user'] . ' ' . 'identified by ' . $_REQUEST['db_pass'] . ' DEFAULT
		TABLESPACE ' . $_REQUEST['db_user']))
                {
                  echo '<BR>' . _ERROR_ . ': could not create user. If this user already exists,
			please uncheck "Create User" in the previous step.<br>';
                  return 0;
                }
              }

              $cmds = array ('GRANT CREATE SESSION TO ' . $_REQUEST['db_user'], 'GRANT CREATE TABLE TO ' . $_REQUEST['db_user'], 'GRANT CREATE SEQUENCE TO ' . $_REQUEST['db_user'], 'ALTER USER ' . $_REQUEST['db_user'] . ' quota unlimited on ' . $_REQUEST['db_user']);
              $i = 0;
              while (($i < count ($cmds) AND $retval))
              {
                $retval = $s->query ($cmds[$i]);
                if (!$retval)
                {
                  echo $cmds[$i] . ' - failed<br>';
                }

                ++$i;
              }
            }
          }
        }
      }
    }

    $sql = new _cal_sql ($_REQUEST['db_user'], $_REQUEST['db_pass'], $_REQUEST['db_name'], $_REQUEST['db_host'], $_REQUEST['db_port']);
    if (!$sql->_connected)
    {
      return 0;
    }

    $sql->quiet = true;
    $sql->query ('drop table thymeinst');
    $sql->quiet = false;
    if (!$sql->query ('create table thymeinst (fld varchar(32))'))
    {
      echo 'Error: user <b>' . $_REQUEST['db_user'] . '</b> can not create and/or drop tables in the <b>' . $_REQUEST['db_name'] . '</b> database.<br>';
      return 0;
    }

    if (!$sql->query ('insert into thymeinst (fld) values (\'test\')'))
    {
      echo 'Error: user <b>' . $_REQUEST['db_user'] . '</b> can not insert data into tables in the <b>' . $_REQUEST['db_name'] . '</b> database. Even though we have granted them permissions
        to do so.<br>';
      return 0;
    }

    if (!$sql->query ('update thymeinst set fld = \'test2\''))
    {
      echo 'Error: user <b>' . $_REQUEST['db_user'] . '</b> can not update table data in the <b>' . $_REQUEST['db_name'] . '</b> database. Even though we have granted them permissions
        to do so.<br>';
      return 0;
    }

    if (!$sql->query ('delete from thymeinst'))
    {
      echo 'Error: user <b>' . $_REQUEST['db_user'] . '</b> can not delete table data in the <b>' . $_REQUEST['db_name'] . '</b> database. Even though we have granted them permissions
        to do so.<br>';
      return 0;
    }

    $query = 'alter table thymeinst add column testfld varchar(2)';
    if ($_REQUEST['db_driver'] != 'mssql')
    {
      if (!$sql->query ($query))
      {
        echo 'Error: user <b>' . $_REQUEST['db_user'] . '</b> can not alter tables in the <b>' . $_REQUEST['db_name'] . '</b> database. Even though we have granted them permissions
           to do so.<br>';
        return 0;
      }
    }

    if (!$sql->query ('drop table thymeinst'))
    {
      echo 'Error: user <b>' . $_REQUEST['db_user'] . '</b> can not drop tables in the <b>' . $_REQUEST['db_name'] . '</b> database. Even though we have granted them permissions
        to do so.<br>';
      return 0;
    }

    return 1;
  }

  function step1 ()
  {
    global $_cal_html;
    global $_cal_form;
    global $_cal_config;
    $_cal_html->print_heading ('Step 1 :: Database Configuration');
    $db_drivers = array ('mssql' => 'Microsoft SQL Server', 'mysql' => 'MySQL', 'pgsql' => 'PostgreSQL');
    if ((!$_REQUEST['db_driver'] AND $_cal_config['_CAL_SQL_DRIVER_']))
    {
      $_cal_form->defaults['db_driver'] = $_cal_config['_CAL_SQL_DRIVER_'];
      $_cal_form->defaults['db_name'] = $_cal_config['_CAL_DBNAME_'];
      $_cal_form->defaults['db_host'] = $_cal_config['_CAL_DBHOST_'];
      $_cal_form->defaults['db_user'] = $_cal_config['_CAL_DBUSER_'];
      $_cal_form->defaults['db_port'] = $_cal_config['_CAL_DBPORT_'];
      $_cal_form->defaults['db_pass'] = $_cal_config['_CAL_DBPASS_'];
      $_cal_form->defaults['db_pref'] = $_cal_config['_CAL_DBPREFIX_'];
      $_cal_html->js_onload[] = 'update_db(\'' . $_cal_config['_CAL_SQL_DRIVER_'] . '\');';
    }
    else
    {
      if (!$_REQUEST['db_driver'])
      {
        $_cal_form->defaults['db_driver'] = 'mysql';
        $_cal_form->defaults['db_name'] = 'thyme';
        $_cal_form->defaults['db_user'] = 'thyme';
        $_cal_form->defaults['db_pass'] = 'mypassword';
        $_cal_form->defaults['db_pref'] = 'thyme_';
        $_cal_html->js_onload[] = 'update_db(\'mysql\');';
      }
      else
      {
        $_cal_form->defaults['db_driver'] = $_REQUEST['db_driver'];
        $_cal_form->defaults['db_name'] = $_REQUEST['db_name'];
        $_cal_form->defaults['db_host'] = $_REQUEST['db_host'];
        $_cal_form->defaults['db_user'] = $_REQUEST['db_user'];
        $_cal_form->defaults['db_port'] = $_REQUEST['db_port'];
        $_cal_form->defaults['db_pass'] = $_REQUEST['db_pass'];
        $_cal_form->defaults['db_pref'] = $_REQUEST['db_pref'];
        $_cal_form->defaults['inst_user'] = $_REQUEST['inst_user'];
        $_cal_form->defaults['inst_pass'] = $_REQUEST['inst_pass'];
      }
    }

    echo '<s';
    echo 'cript language=\'javascript\' type=\'text/javascript\'>

   var db_configs = new Array();

   db_configs[\'pgsql\'] = new Array();
   db_configs[\'pgsql\'][\'notes\'] = \'<B>NOTE:</B> For most PostgreSQL default installations, running on the same host, you may have to leave <b>Host</b> and <b>Port</b> blank or authentication will fail.\';


   db_configs[\'mssql\'] = new Array();
   db_configs[\'mssql\'][\'note';
    echo 's\'] = \'\';


   db_configs[\'mysql\'] = new Array();
   db_configs[\'mysql\'][\'notes\'] = \'<B>NOTE:</b> The default port for a MySQL server is 3306. For most installation configurations running on the same host, you should leave the port field blank.\';


function update_db(driver)
{

   document.getElementById(\'notes\').innerHTML = db_configs[driver][\'notes\'];


}

</script>
Enter the inform';
    echo 'ation below to configure the database settings. If you want to use a different
username/password (that may have access to create users/databases) to configure your database, enter them
under the "Advanced Install Options" section. This username/password will not be saved
anywhere, in any file. NOTE: if "Create User" is selected and the user already exists, their password
may be reset to the pa';
    echo 'ssword entered under "Database Configuration" <br><br>
';
    if (($_cal_config['_cal_exists_'] AND $_cal_form->defaults['db_user'] == $_cal_config['_CAL_DBUSER_']))
    {
      $expass = ' (Leave blank to use existing password)';
    }

    $_cal_form->defaults['db_pass'] = $_cal_form->defaults['inst_pass'] = '';
    require_once 'include/classes/class.template.php';
    $tmpl = new _cal_template ();
    $tmpl->row_header_width = 200;
    $tmpl->print_header ();
    $tmpl->new_section ('Database Configuration');
    if ($_cal_config['source'])
    {
      $tmpl->section_row ('', '' . '<b><font class=\'hil\'>Thyme has detected these settings from your
	' . $_cal_config['source'] . ' installation.</b></font>');
      $tmpl->section_row ('', 'In most cases you can click \'Test\' (just to be sure), then
	\'Next\' to continue with the installation.');
      $tmpl->section_spacer ();
    }

    $tmpl->section_row ('Driver', $_cal_form->select ('db_driver', $db_drivers, 'onChange=\'update_db(this.options[this.selectedIndex].value)\''));
    $tmpl->section_row ('Host', $_cal_form->textbox ('db_host', 30));
    $tmpl->section_row ('Port', $_cal_form->textbox ('db_port', 5));
    $tmpl->section_row ('Username', $_cal_form->textbox ('db_user', 30));
    $tmpl->section_row ('Password', $_cal_form->password ('db_pass', 30) . $expass);
    $tmpl->section_row ('Database Name', $_cal_form->textbox ('db_name', 30));
    $tmpl->section_row ('Table prefix', $_cal_form->textbox ('db_pref', 30));
    $tmpl->section_row ('', '<input type=button class=button onClick="test_db1()" value="Test">
		&nbsp; &nbsp; &nbsp; <a href="install.php?faq#step1" target=_blank>Help</a>');
    $tmpl->end_section ();
    $_REQUEST['show_hide'] = 2;
    $tmpl->new_section ('Advanced Install Options', true);
    $tmpl->section_row ('Create Database', $_cal_form->checkbox ('create_db'));
    $tmpl->section_row ('Create User', $_cal_form->checkbox ('create_user'));
    $tmpl->section_row ('Installation User', $_cal_form->textbox ('inst_user', 30));
    $tmpl->section_row ('Installation Password', $_cal_form->password ('inst_pass', 30));
    $tmpl->section_row ('', '<input type=button class=button onClick="test_db2()" value="Test">');
    $tmpl->end_section ();
    $tmpl->print_footer ();
    echo '
<br>
';
    echo '<s';
    echo 'pan id=\'notes\'> </span>


<br><br>
<table cellpadding=5>
<tr class=\'toolbar\'>
  <td align=\'center\'>
';
    echo $_cal_form->submit ('action', 'Previous', ' style="width: 80px;"');
    echo '
';
    echo $_cal_form->submit ('action', 'Next', ' default name="next" selected style="width: 80px;"');
    echo '</tr>
</table>
';
    if ($_REQUEST['db_driver'])
    {
      $_cal_html->js_onload[] = 'update_db(\'' . $_REQUEST['db_driver'] . '\');';
    }

  }

  define ('_SHOW_', 'show');
  define ('_HIDE_', 'hide');
  require_once 'include/js/newWin.js';
  echo '<s';
  echo 'cript language=\'javascript\' type=\'text/javascript\'>
<!--

var elms = document.forms[\'';
  echo $_cal_form->name;
  echo '\'].elements;

var u;
var p;
var driver;
var host;
var port;
var db;

function set_vars()
{
   u = elms[\'db_user\'].value;
   p = elms[\'db_pass\'].value;
   driver = elms[\'db_driver\'].value;
   host = elms[\'db_host\'].value;
   port = elms[\'db_port\'].value;
   db = elms[\'db_name\'].value;
}
function test_db1()
{

   set_vars();

   var url = \'INSTALL/test_db.php?u=\' + u + \'&p=\' +';
  echo ' p + \'&d=\' + driver + \'&h=\' + host + \'&pt=\' + port;
   if(!elms[\'create_db\'].checked) url += \'&db=\' + db;

   newWin(url,300,300); 

}

function test_db2()
{

   set_vars();

   u = elms[\'inst_user\'].value;
   p = elms[\'inst_pass\'].value;

   var url = \'INSTALL/test_db.php?u=\' + u + \'&p=\' + p + \'&d=\' + driver + \'&h=\' + host + \'&pt=\' + port;
   newWin(url,300,300); 

}
-->
</scri';
  echo 'pt>

';
?>