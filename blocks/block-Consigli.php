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

if ( !defined('BLOCK_FILE') ) {
    Header("Location: ../index.php");
    die();
}

global $prefix, $multilingual, $currentlang, $db, $tipath, $user, $cookie, $userinfo;

getusrinfo($user);

          if (!isset($mode) OR empty($mode)) {
            if(isset($userinfo['umode'])) {
              $mode = $userinfo['umode'];
            } else {
              $mode = "thread";
            }
          }
          if (!isset($order) OR empty($order)) {
            if(isset($userinfo['uorder'])) {
              $order = $userinfo['uorder'];
            } else {
              $order = 0;
            }
          }
          if (!isset($thold) OR empty($thold)) {
            if(isset($userinfo['thold'])) {
              $thold = $userinfo['thold'];
            } else {
              $thold = 0;
            }
          }
$r_options = "";
$r_options .= "&amp;mode=".$mode;
$r_options .= "&amp;order=".$order;
$r_options .= "&amp;thold=".$thold;

if ($multilingual == 1) {
    $querylang = "AND (alanguage='$currentlang' OR alanguage='')"; /* the OR is needed to display stories who are posted to ALL languages */
} else {
    $querylang = "";
}

$content = "<center><strong>Siti Consigliati</strong></center><br>";
$content .= "<table border=\"0\" width=\"100%\">";
$content .= "<center><a href=\"http://cynegi.net?sponsor=10280\" title=\"Cinegi.Net\">Cinegi.net Midweb Network</a></center>";
$content .= "<hr>";
$content .= "<center><a href=\"http://www.forux.it\" title=\"Forux\"><img src=\"http://www.forux.it/wp-content/uploads/2010/09/banner80x15.gif\" border=0 alt=\"Forux\" /></a></center>";
$content .= "<hr>";
$content .= "<center><a href=\"http://www.fortunecat.it/\"><img src=\"http://www.fortunecat.it/img-hotlink/seo.gif\" alt=\"web marketing\" border=\"0\"/></a></center>";
$content .= "<hr>";
$content .= "<center><a href=\"http://www.AbcItaly.com/\"><img src=\"http://www.abcitaly.com/immagini/abcbanner.gif\" alt=\"Motore di ricerca abc\" border=\"0\"/></a></center>";
$content .= "<hr>";
$content .= "<center><a href=\"http://lnx.hackerexpert.com/home/\"><img src=\"http://lnx.hackerexpert.com/home/images/powered/hackerexpert.gif\" alt=\"Motore di ricerca abc\" border=\"0\"/></a></center>";
$content .= "<hr>";
$content .= "<!-- Inizio Banner Cynegi -->\n";
$content .= "<div align=\"center\">\n";
$content .="<iframe align=\"center\" src=\"http://www.cynegi.net/adv.asp?id=10280&f=10\" width=\"120\" height=\"266\" marginwidth=\"0\" marginheight=\"0\" hspace=\"0\" vspace=\"0\" frameborder=\"0\" scrolling=\"no\">";
$content .="<table border=\"1\" align=\"center\" bgcolor=\"#C0C0C0\"><tr><td width=\"120\" height=\"266\" align=\"center\" valign=\"middle\" nowrap><a href=\"http://www.cynegi.net/\">Cynegi Network - Scambio Banner Gratuito</a></td></tr></table></iframe>\n";
$content .="<br clear=all><a href=\"http://www.cynegi.net/?sponsor=10280\"><div style=\"font-family: Verdana, Arial; font-size: xx-small;\">Cynegi Network</div></a></div>\n";
$content .= "<!-- Fine Banner Cynegi -->";
$content .= "\n<hr>\n";
$content .= "<script type=\"text/javascript\">\n";
$content .= "/* <![CDATA[ */\n";
$content .= "document.write('<s'+'cript type=\"text/javascript\" src=\"http://ad.altervista.org/js2.ad/size=125X125/r='+new Date().getTime()+'\"><\/s'+'cript>');\n";
$content .= "/* ]]> */\n";
$content .= "</script>\n";
$content .= "</table>";

?>