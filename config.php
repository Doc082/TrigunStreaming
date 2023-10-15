
<?php

######################################################################
# PHP-NUKE: Advanced Content Management System
# ============================================
#
# Copyright (c) 2006 by Francisco Burzi
# http://phpnuke.org
#
# This program is free software. You can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License.
######################################################################

if (stristr(htmlentities($_SERVER['PHP_SELF']), "config.php")) {
	   Header("Location: index.php");
    die();
}

######################################################################
# Database & System Config
#
# dbhost:       SQL Database Hostname
# dbuname:      SQL Username
# dbpass:       SQL Password
# dbname:       SQL Database Name
# $prefix:      Your Database table's prefix
# $user_prefix: Your Users' Database table's prefix (To share it)
# $dbtype:      Your Database Server type. Supported servers are:
#               MySQL, mysql4, sqlite, postgres, mssql, oracle,
#               msaccess, db2 and mssql-odbc
#               Be sure to write it exactly as above, case SeNsItIvE!
# $sitekey:	Security Key. CHANGE it to whatever you want, as long
#               as you want. Just don't use quotes.
# $gfx_chk:	Set the graphic security code on every login screen,
#		You need to have GD extension installed:
#		0: No check
#		1: Administrators login only
#		2: Users login only
#		3: New users registration only
#		4: Both, users login and new users registration only
#		5: Administrators and users login only
#		6: Administrators and new users registration only
#		7: Everywhere on all login options (Admins and Users)
#		NOTE: If you aren't sure set this value to 0
# $subscription_url: If you manage subscriptions on your site, you
#                    must write here the url of the subscription
#                    information/renewal page. This will send by
#                    email if set.
# $admin_file: Administration panel filename. "admin" by default for
#   		   "admin.php". To improve security please rename the file
#              "admin.php" and change the $admin_file value to the
#              new filename (without the extension .php)
# $nuke_editor: Turn On/Off the WYSIWYG text editor
#               0: Off, textareas in forms will not show any editor
#               1: On, all textarea in the forms will show the editor
# $display_errors:  Debug control to see PHP generated errors.
#                   false: Don't show errors
#                   true: See all errors ( No notices )
######################################################################

$dbhost = "localhost";
$dbuname = "trigunstreaming";
$dbpass = "nodpavonfa65";
$dbname = "my_trigunstreaming";
$prefix = "nuke";
$user_prefix = "nuke";
$dbtype = "MySQL";
$sitekey = "TRsDEFmcZD6Cx7Y0mMtwdNmczZPeqhAR8eIm1Ia4";
$gfx_chk = 0;
$subscription_url = "";
$admin_file = "admin";
$nuke_editor = 1;
$display_errors = false;

/**********************************************************************/
/* You finished to configure the Database. Now you can change all     */
/* you want in the Administration Section.   To enter just launch     */
/* your web browser pointing it to http://xxxxxx.xxx/admin.php        */
/* (Change xxxxxx.xxx to your domain name, for example: phpnuke.org)  */
/*                                                                    */
/* Remember to go to Preferences section where you can configure your */
/* new site. In that menu you can change all you need to change.      */
/*                                                                    */
/* Congratulations! now you have an automated news portal!            */
/* Thanks for choose PHP-Nuke: The Future of the Web                  */
/**********************************************************************/

// DO NOT TOUCH ANYTHING BELOW THIS LINE UNTIL YOU KNOW WHAT YOU'RE DOING

$prefix = empty($user_prefix) ? $prefix : $user_prefix;
$reasons = array("As Is","Offtopic","Flamebait","Troll","Redundant","Insighful","Interesting","Informative","Funny","Overrated","Underrated");
$badreasons = 4;
/*********************************************************************************
* nukeWYSIWYG(tm) Copyright (c) 2005-2008 Kevin Guske   http://nukeseo.com
* img tag update by Nopsych November 2006               http://www.nopsych.it
* kses developed by Ulf Harnhammar                      http://kses.sf.net
* kses enhancement ideas contributed by sixonetonoffun  http://netflake.com
* FCKeditor by Frederico Caldeira Knabben               http://fckeditor.net
* Original FCKeditor for PHP-Nuke by H.Theisen          http://phpnuker.de
*
* Advanced Editor (nukeWYSIWYG) Configuration Options:
*
* The $advanced_editor setting controls whether or not nukeWYSIWYG(tm)
* will be used.  The site-level setting is below.  But adding a similar
* setting to the modules/xxxx/index.php allows the editor to be enabled
* or disabled at the module level.
*
* The $AllowableHTML array definitions will override/overlay the $AllowableHTML
* array definitions in the standard config.php file.  This is intentional and is
* required for correct operation of the Editor.
**********************************************************************************/
$advanced_editor = 1;  // 0=Editor is turned OFF, 1=Editor is turned ON

// To override the default uploads/ folder used for storing files uploaded
// through nukeWYSIWYG via FCKeditor's filemanager.  It should include the full
// path from the root.
$uploadpath = 'http://cammuth.no-ip.org/upoloads/';

$AllowableHTML = array(
    'a' => array('href' => 1, 'target' => 1, 'title' => array('minlen' => 4, 'maxlen' => 120)),
    'b' => array(),
    'blockquote' => array(),
    'br' => array(),
    'center' => array(),
    'div' => array('align' => 1),
    'em' => array(),
    'font' => array('face' => 1, 'style' => 1, 'color' => 1, 'size' => array('minval' => 1, 'maxval' => 7)),
    'h1'=>array(),
    'h2'=>array(),
    'h3'=>array(),
    'h4'=>array(),
    'h5'=>array(),
    'h6'=>array(),
    'hr' => array(),
    'i' => array(),
    'img' => array('alt' => 1, 'src' => 1, 'hspace' => 1, 'vspace' => 1, 'width' => 1, 'height' => 1, 'border' => 1, 'align' => 1),
    'li' => array(),
    'ol' => array(),
    'p' => array('align' => 1),
    'pre' => array('align' => 1),
    'span' =>array('class' => 1, 'style' => array('font-family' => 1, 'color' => 1)),
    'strong' => array(),
    'strike'=>array(),
    'sub'=>array(),
    'sup'=>array(),
    'table' => array('align' => 1, 'border' => 1, 'cell' => 1, 'width' => 1, 'cellspacing' => 1, 'cellpadding' => 1),
    'td' => array('align' => 1, 'width' => 1, 'valign' => 1, 'height' => 1, 'rowspan' => 1, 'colspan' => 1 ),
    'tr' => array('align' => 1),
    'tt'=>array(),
    'u' => array(),
    'ul' => array(),
);
$CensorList = array("fuck","cunt","fucker","fucking","pussy","cock","c0ck","cum","twat","clit","bitch","fuk","fuking","motherfucker");
$tipath = "images/topics/";

//***************************************************************
// IF YOU WANT TO LEGALY REMOVE ANY COPYRIGHT NOTICES PLAY FAIR AND CHECK: http://phpnuke.org/modules.php?name=Commercial_License
// COPYRIGHT NOTICES ARE GPL SECTION 2(c) COMPLIANT AND CAN'T BE REMOVED WITHOUT PHP-NUKE'S AUTHOR WRITTEN AUTHORIZATION
// THE USE OF COMMERCIAL LICENSE MODE FOR PHP-NUKE HAS BEEN APPROVED BY THE FSF (FREE SOFTWARE FOUNDATION)
// YOU CAN REQUEST INFORMATION ABOUT THIS TO GNU.ORG REPRESENTATIVE. THE EMAIL THREAD REFERENCE IS #213080
// YOU'RE NOT AUTHORIZED TO CHANGE THE FOLLOWING VARIABLE'S VALUE UNTIL YOU ACQUIRE A COMMERCIAL LICENSE
// (http://phpnuke.org/modules.php?name=Commercial_License)
//***************************************************************

$commercial_license = 0;

?>