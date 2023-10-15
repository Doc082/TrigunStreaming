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


$content = "<center><strong>Ascolta i tuoi cantanti preferiti su Trigunstreaming.it!<br> clicca sul tuo cantante preferito per ascoltare le sue canzoni mentre navighi... </strong></center><br>";
$content .= "<table border=\"0\" width=\"100%\">";
$content .= "<tr><td id='lista'><a href=\"javascript:RadioColdplay()\"><strong>Coldplay</strong></a></td></tr>";
$content .= "<tr><td id='lista'>&nbsp;</td></tr>";
$content .= "<tr><td id='lista'><a href=\"javascript:RadioVasco()\"><strong>Vasco Rossi</strong></a></td></tr>";
$content .= "<tr><td id='lista'>&nbsp;</td></tr>";
$content .= "<tr><td id='lista'><a href=\"javascript:RadioLigabue()\"><strong>Ligabue</strong></a></td></tr>";
$content .= "<tr><td id='lista'>&nbsp;</td></tr>";
$content .= "<tr><td id='lista'><a href=\"javascript:RadioZucchero()\"><strong>Zucchero</strong></a></td></tr>";
$content .= "<tr><td id='lista'>&nbsp;</td></tr>";
$content .= "<tr><td id='lista'><a href=\"javascript:RadioJovanotti()\"><strong>Jovanotti</strong></a></td></tr>";
$content .= "<tr><td id='lista'>&nbsp;</td></tr>";
$content .= "<tr><td id='lista'><a href=\"javascript:RadioTizferro()\"><strong>Tiziano Ferro</strong></a></td></tr>";
$content .= "</table>";
                    
?>