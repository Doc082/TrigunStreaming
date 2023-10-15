<?php
/***************************************************************************
 *                                 db.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: db.php,v 1.10.2.3 2005/10/30 15:17:14 acydburn Exp $
 *
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

if (stristr($_SERVER['PHP_SELF'], 'db.php')) {
    Header('Location: index.php');
    die();
}

if (defined('FORUM_ADMIN')) {
    $the_include = '../../../db';
} elseif (defined('INSIDE_FCKCONFIG')) {
    $the_include = INCLUDE_PATH.'db';
} elseif (defined('INSIDE_MOD')) {
    $the_include = '../../db';
} elseif (defined('INSIDE_INSTALL')) {
    $the_include = '../db';
} else {
    $the_include = 'db';
}

switch($dbtype) {

	case 'MySQL':
		include_once($the_include.'/mysql.php');
		break;

	case 'mysql4':
		include_once($the_include.'/mysql4.php');
		break;

	case 'sqlite':
		include_once($the_include.'/sqlite.php');
		break;

	case 'postgres':
		include_once($the_include.'/postgres7.php');
		break;

	case 'mssql':
		include_once($the_include.'/mssql.php');
		break;

	case 'oracle':
		include_once($the_include.'/oracle.php');
		break;

	case 'msaccess':
		include_once($the_include.'/msaccess.php');
		break;

	case 'mssql-odbc':
		include_once($the_include.'/mssql-odbc.php');
		break;

	case 'db2':
		include_once($the_include.'/db2.php');
		break;

}

/** Housekeeping **/
$mysqlErrorConnectDb = '';
$mysqlErrorConfigTableMissing = '';
$checkForConfigTable = '';
$errorMsg = '';
$db = '';

$db = new sql_db($dbhost, $dbuname, $dbpass, $dbname, false);
if (!$db->db_connect_id) {
   $mysqlErrorConnectDb = mysql_error();
}
if (!$db->sql_query('SELECT Default_Theme FROM '.$prefix.'_config WHERE 1;')) {
   $mysqlErrorConfigTableMissing = mysql_error();
}

if ($mysqlErrorConnectDb || $mysqlErrorConfigTableMissing) {
   $errorMsg .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"'
              . '"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'
              . '<head>'
              . '<title>PHP Web Host - Quality Web Hosting For All PHP Applications.</title>'
              . '<style type="text/css">'
              . '/*<![CDATA[*/'
              . 'div.c1 {text-align: center; font-weight:bold;color:red;border:dotted red;border-width: 2px;padding:2em;border-collapse: collapse;}'
              . 'div.c2 {text-align: center;}'
			  . 'p.d1 {font-weight:bold;}'
              . 'p.d2 {text-decoration:none; text-align: center; font-weight:bold; color:red;}'
              . '/*]]>*/'
              . '</style>'
              . '</head>'
              . '<body>'
              . '<br /><br />'
              . '<div class="c2">'
              . '<img src="images/logo.gif" alt="MySQL Error" />'
   ;

   $useAlso = '';
   if ($mysqlErrorConnectDb) {
      $useAlso = 'Also, t';
      $errorMsg .= '<p>&nbsp;</p><p class="d1">There seems to be a problem connecting to the '.$dbtype.' server.</p>'
                .  '<div class="c1">'
                .  'MySQL is Reporting'
                .  '<p class="d2">'
                .  $mysqlErrorConnectDb
                .  '</p>'
                .  '<p>If you are the System Administrator and installing this for the first time, did you remember to create your database first?</p>'
                .  '</div>'
      ;
   }

   if ($mysqlErrorConfigTableMissing) {
      if (empty($useAlso)) $useAlso = 'T';
      $errorMsg .= '<p>&nbsp;</p><p class="d1">'.$useAlso.'here seems to be a problem with the System Configuration Table - it\'s missing.</p>'
                .  '<div class="c1">'
                .  'If you are the System Administrator and installing this for the first time, did you remember to run the <a href="http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'INSTALLATION/installSQL.php">INSTALLATION/installSQL.php file</a>?'
                .  '</div>'
      ;
   }

   $errorMsg .= '<p>&nbsp;</p><p class="d1">If you are not the System Administrator, please report this to the Administrator and/or Web Master ASAP.</p>'
             .  '<p class="d1">We will be back as soon as possible.</p>'
             .  '</div>'
             .  '</body></html>'
   ;

   echo $errorMsg;
   exit();
}   
?>
