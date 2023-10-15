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

$content = "<center><strong><a href=\"https://www.facebook.com/Trigunstreaming\">Seguici su<br>Facebook</a></strong></center><br>";
$content .= "<table border=\"0\" width=\"100%\">";
$content .= "<center><div class=\"fb-like\" data-href=\"http://www.trigunstreaming.it\" data-send=\"true\" data-layout=\"box_count\" data-width=\"450\" data-show-faces=\"true\" data-font=\"arial\"></div></center>";
$content .= "<p>&nbsp;</p>";
$content .= "<center><strong><a href=\"http://www.trigunstreaming.it/backend.php\"><img src=\"http://www.commissario-archeologiaroma.it/opencms/multimedia/CommissarioAR/images/large/2009/11/18/1258559030442_rss_logo_normal.jpg\" width=\"40\"><br>Rimani aggiornato<br>iscriviti ai <br>nostri Feed Rss</a></strong></center>";
$content .= "<p>&nbsp;</p>";
$content .= "</table>";

?>