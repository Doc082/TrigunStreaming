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

include("mainfile.php");
include("includes/ipban.php");
global $prefix, $db, $nukeurl;
header("Content-Type: text/xml");
$cat = intval($cat);
if (isset($cat) && !empty($cat)) {
	$catid = $db->sql_fetchrow($db->sql_query("SELECT catid FROM ".$prefix."_stories_cat WHERE title LIKE '%$cat%' LIMIT 1"));
	if ($catid == "") {
		$result = $db->sql_query("SELECT sid, title, hometext FROM ".$prefix."_stories ORDER BY sid DESC LIMIT 10");
	} else {
		$catid = intval($catid);
		$result = $db->sql_query("SELECT sid, title, hometext FROM ".$prefix."_stories WHERE catid='$catid' ORDER BY sid DESC LIMIT 10");
	}
} else {
	$result = $db->sql_query("SELECT sid, title, hometext, time FROM ".$prefix."_stories ORDER BY sid DESC LIMIT 10");
}
 

//echo "<rss version=\"2.0\">\n\n";
//echo "<!DOCTYPE rss PUBLIC \"-//Netscape Communications//DTD RSS 0.91//EN\"\n";
//echo " \"http://my.netscape.com/publish/formats/rss-0.91.dtd\">\n\n";
$verify=1;
echo "<rss version=\"0.91\">\n\n";
echo "<channel>\n";
echo "<title>Trigunstreaming.it - Film in Liberta'</title>\n";
echo "<link>$nukeurl</link>\n";
echo "<description>Nuova community di film in streaming e di Cinema in generale, dove tutti gli appassionati possono discutere, vedere il proprio film preferito, o chattare, senza essere aggrediti dai banner pubblicitari.</description>\n";
echo "<language>$backend_language</language>\n";
echo "<webMaster>trigunstreaming@altervista.org</webMaster>\n";

while ($row = $db->sql_fetchrow($result)) {
	$rsid = intval($row['sid']);
	$rtitle = filter($row['title'], "nohtml");
	$rtext = $row['hometext'];
	$datetime = filter($row['time']);
	$rtext=strstr($rtext,"src=\"");
	$rtext=substr($rtext, 5);
	$finalpos=strpos($rtext,"\"");
	$rtext=substr($rtext, 0,$finalpos);
	
	if($verify)echo "<pubDate>$datetime</pubDate>\n\n";
	$verify=0;
	echo "<item>\n";
	//echo "<img src=\"".$rtext."\" alt=\"\" height=\"150\" />\n";
	echo "<title>".$rtitle."</title>\n";
	echo "<link>$nukeurl/modules.php?name=News&amp;file=article&amp;sid=$rsid</link>\n";
	echo "<pubDate>$datetime</pubDate>\n";
	//echo "<description>".htmlentities($rtext)."</description>\n";
	echo "<description><img src=\"".$rtext."\" alt=\"\" height=\"150\" /></description>\n";
	echo "</item>\n\n";
}
echo "</channel>\n";
echo "</rss>";

?>