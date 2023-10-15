<?php

/************************************************************************/
/* PHP-NUKE: Advanced Content Management System                         */
/* ============================================                         */
/*                                                                      */
/* Copyright (c) 2006 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if (stristr(htmlentities($_SERVER['PHP_SELF']), "header.php")) {
	Header("Location: index.php");
	die();
}

define('NUKE_HEADER', true);
require_once("mainfile.php");

##################################################
# Include some common header for HTML generation #
##################################################


function head() {
	global $slogan, $sitename, $banners, $nukeurl, $Version_Num, $artpage, $topic, $hlpfile, $user, $hr, $theme, $cookie, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4, $textcolor1, $textcolor2, $forumpage, $adminpage, $userpage, $pagetitle;
	$ThemeSel = get_theme();
	include_once("themes/$ThemeSel/theme.php");
	echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\n";
	echo "<html>\n";
	echo "<head>\n";
	echo "<title>$sitename $pagetitle</title>\n";
	include("includes/meta.php");
	include("includes/javascript.php");

	if (file_exists("themes/$ThemeSel/images/favicon.ico")) {
		echo "<link REL=\"shortcut icon\" HREF=\"themes/$ThemeSel/images/favicon.ico\" TYPE=\"image/x-icon\">\n";
	}
	echo "<link rel=\"alternate\" type=\"application/rss+xml\" title=\"RSS\" href=\"backend.php\">\n";
	echo "<LINK REL=\"StyleSheet\" HREF=\"themes/$ThemeSel/style/style.css\" TYPE=\"text/css\">\n\n\n";
	if (file_exists("includes/custom_files/custom_head.php")) {
		include_once("includes/custom_files/custom_head.php");
	}
	
	echo "<style type=\"text/css\">\n";
	echo "@import url(mystyle.css);\n";
	echo "</style>\n";
	
	echo "\n\n<script type='text/javascript' src='https://apis.google.com/js/plusone.js'>\n";
  	echo "{lang: 'it'}\n";
    echo "</script>";
	echo "\n";
	echo "<script src=\"locandine.js\"></script>\n";
	echo "<script src=\"radio.js\"></script>";
	echo "\n\n\n</head>\n\n";
	if (file_exists("includes/custom_files/custom_header.php")) {
		include_once("includes/custom_files/custom_header.php");
	}
	themeheader();
	global $ab_config;
    if($ab_config['site_switch'] == 1 && is_admin($_COOKIE['admin'])) {
      echo '<center><img src="images/nukesentinel/disabled.png" alt="'._AB_SITEDISABLED.'" title="'._AB_SITEDISABLED.'" border="0" /></center><br />'."\n";
    }
    if($ab_config['disable_switch'] == 1 && is_admin($_COOKIE['admin'])) {
      echo '<center><img src="images/nukesentinel/inactive.png" alt="'._AB_NSDISABLED.'" title="'._AB_NSDISABLED.'" border="0" /></center><br />'."\n";
    }
    if($ab_config['test_switch'] == 1 && is_admin($_COOKIE['admin'])) {
      echo '<center><img src="images/nukesentinel/testmode.png" alt="'._AB_TESTMODE.'" title="'._AB_TESTMODE.'" border="0" /></center><br />'."\n";
    }

}

online();
head();
include("includes/counter.php");
if(defined('HOME_FILE')) {
	message_box();
	blocks("Center");
}

?>