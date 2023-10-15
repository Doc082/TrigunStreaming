<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2006 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if (stristr(htmlentities($_SERVER['PHP_SELF']), "meta.php")) {
    Header("Location: ../index.php");
    die();
}

global $commercial_license, $sitename, $slogan, $prefix, $db;
##################################################
# Include for Meta Tags generation               #
##################################################
$metaresult = $db->sql_query("SELECT title FROM ".$prefix."_stories ORDER BY sid DESC LIMIT 10");

$metastring = "<META HTTP-EQUIV=\"Content-Type\" CONTENT=\"text/html; charset="._CHARSET."\">\n";
$metastring .= "<META HTTP-EQUIV=\"EXPIRES\" CONTENT=\"0\">\n";
$metastring .= "<META NAME=\"RESOURCE-TYPE\" CONTENT=\"DOCUMENT\">\n";
$metastring .= "<META NAME=\"DISTRIBUTION\" CONTENT=\"GLOBAL\">\n";
$metastring .= "<META NAME=\"AUTHOR\" CONTENT=\"Mirko 'Doc' Fenu & Nicola 'Yoghi' Adamo\">\n";
$metastring .= "<META NAME=\"COPYRIGHT\" CONTENT=\"Copyright (c) by Mirko 'Doc' Fenu & Nicola 'Yoghi' Adamo\">\n";
// Keywords dinamiche by Mirko Fenu
$metastring .= "<META NAME=\"KEYWORDS\" CONTENT=\"film, streaming, film streaming, trigun streaming, trigun film streaming, trigun, portal, nowvideo streaming, streaming nowvideo, streaming nowvideo ita, streaming ita nowvideo, streaming ita, download streaming film, glee streaming ita, novità film streaming";

while ($metarow = $db->sql_fetchrow($metaresult)) {
	$rtitle = filter($metarow['title'], "nohtml");
	$metastring .= ", $rtitle, $rtitle streaming, $rtitle streaming ita , $rtitle streaming VK, $rtitle streaming nowvideo, $rtitle streaming putlocker, $rtitle download";
}
$metastring .= "\">\n";
//fine codice
$metastring .= "<META NAME=\"DESCRIPTION\" CONTENT=\"$slogan\">\n";
$metastring .= "<META NAME=\"ROBOTS\" CONTENT=\"INDEX, FOLLOW\">\n";
$metastring .= "<META NAME=\"REVISIT-AFTER\" CONTENT=\"1 DAYS\">\n";
$metastring .= "<META NAME=\"RATING\" CONTENT=\"GENERAL\">\n";
$metastring .="<meta property=\"og:title\" content=\"Trigun Anime e Film Streaming\" />\n";
$metastring .="<meta property=\"og:type\" content=\"article\" />\n";
$metastring .="<meta property=\"og:url\" content=\"http://trigunstreaming.altervista.org\" />\n";
$metastring .="<meta property=\"og:image\" content=\"http://trigunstreaming.altervista.org/images/trigun.jpg\" />\n";
$metastring .="<meta property=\"og:site_name\" content=\"Trigun Streaming\" />\n";
$metastring .="<meta property=\"fb:admins\" content=\"100000150967403\" />\n";

###############################################
# DO NOT REMOVE THE FOLLOWING COPYRIGHT LINE! #
# YOU'RE NOT ALLOWED TO REMOVE NOR EDIT THIS. #
###############################################

// IF YOU REALLY NEED TO REMOVE IT AND HAVE MY WRITTEN AUTHORIZATION CHECK: http://phpnuke.org/modules.php?name=Commercial_License
// PLAY FAIR AND SUPPORT THE DEVELOPMENT, PLEASE!
global $commercial_license;
if ($commercial_license != 1) {
	$metastring .= "<META NAME=\"GENERATOR\" CONTENT=\"PHP-Nuke Copyright (c) 2006 by Francisco Burzi. This is free software, and you may redistribute it under the GPL (http://phpnuke.org/files/gpl.txt). PHP-Nuke comes with absolutely no warranty, for details, see the license (http://phpnuke.org/files/gpl.txt).\">\n";
}


echo $metastring;

?>