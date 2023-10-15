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
$myquery = "SELECT COUNT(*) as num FROM ".$prefix."_stories $querylang ORDER BY sid DESC";
$total_pages = $db->sql_fetchrow($db->sql_query($myquery));
$total_pages = $total_pages[num];

$content = "<center><strong>Ultime Novità da Trigun Streaming!</strong></center><br>";
$content .= "<table border=\"0\" width=\"100%\">";
//$content .= "<tr><td><a href=\"#\" onClick=\"vai();return false;\" onMouseover=\"visualizza();return true;\" onMouseout=\"riparti();return true;\"><IMG SRC=\"loca/01.jpg\" NAME=\"locandine\" BORDER=0></a></td></tr>\n";
//$content .= "<tr><td><hr></td></tr>";
$content .= "<tr><td id='lista'><a href=\"http://subita.trigunstreaming.it\"><strong>18/01/2013</strong><br>Aggiunta sezione per i Film in lingua originale sottotitolati in italiano.</a></td></tr>";
$content .= "<tr><td id='lista'>&nbsp;</td></tr>";
$content .= "<tr><td id='lista'><a href=\"modules.php?name=News&amp;file=article&amp;sid=748\"><strong>18/12/2012</strong><br>Inserita raccolta di Film Catastrofici</a></td></tr>";
$content .= "<tr><td id='lista'>&nbsp;</td></tr>";
$content .= "<tr><td id='lista'><a href=\"modules.php?name=News&amp;file=article&amp;sid=712\"><strong>12/12/2012</strong><br>Inserita raccolta di Film Natalizi</a></td></tr>";
$content .= "<tr><td id='lista'>&nbsp;</td></tr>";
$content .= "<tr><td id='lista'><a href=\"modules.php?name=News&amp;file=article&amp;sid=611\"><strong>28/11/2012</strong><br>Aggiunta una sezione dedicata a Stanlio e Ollio in streaming</a></td></tr>";
$content .= "<tr><td id='lista'>&nbsp;</td></tr>";
$content .= "<tr><td id='lista'><a href=\"http://trigunstreaming.altervista.org/modules.php?name=DvdRip\"><strong>25/11/2012</strong><br>Aggiunta una sezione per i film in qualità Dvd e BluRay</a></td></tr>";
$content .= "<tr><td><hr></td></tr>";
$content .= "</table>";
$content .= "<br><br>";
$content .= "<div id='block'><center><strong>Ad Oggi abbiamo $total_pages Film nel sito! Aiutaci a crescere... Diventa un nostro inserzionista!<a href=\"modules.php?name=Your_Account&op=new_user\">iscriviti gratis!</a></strong></center></div>";
//$content .= "<SCRIPT LANGUAGE=\"JavaScript\">\n";
//$content .= "<!-- Hide JavaScript from Java-Impaired Browsers\n";
//$content .= "sctr=0;\n";
//$content .= "ruota();\n";
//$content .= "// End Hiding -->\n";
//$content .= "</SCRIPT>\n";
?>