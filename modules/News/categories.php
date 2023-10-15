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

if (!defined('MODULE_FILE')) {
	die ("You can't access this file directly...");
}

require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

	$cols = 1; //COLONNE IN CUI SUDDIVIDERE LE NEWS
    $limit = 5; //NEWS PER PAGINA

define('INDEX_FILE', true);
$categories = 1;
$cat = $catid;
automated_news();

function theindex($catid) {
	global $storyhome, $httpref, $httprefmax, $topicname, $topicimage, $topictext, $datetime, $user, $cookie, $nukeurl, $prefix, $multilingual, $currentlang, $db, $articlecomm, $module_name, $userinfo, $limit, $cols;
        if (is_user($user)) { getusrinfo($user); }
	if ($multilingual == 1) {
		$querylang = "AND (alanguage='$currentlang' OR alanguage='')"; /* the OR is needed to display stories who are posted to ALL languages */
	} else {
		$querylang = "";
	}
	include("header.php");
	if (isset($userinfo['setstorynum'])) {
		$storynum = $userinfo['setstorynum'];
	} else {
		$storynum = $storyhome;
	}
	if ($currentlang == "italian"){
    define("_NEXT", "Successiva");
    define("_PREVIOUS", "Precedente");
    } else   {
    define("_NEXT", "Next");
    define("_PREVIOUS", "Previous");
    }
 
    //MOD BY MATTEOIAMMA
    
    echo '
    <style type="text/css">
    div.pagination {

	padding: 3px;

	margin: 3px;

}



div.pagination a { padding: 2px 5px; margin: 2px; border: solid 1px #aaaadd; text-decoration: none; /* no underline */

	background-image: url(images/menu-texture.png); }

div.pagination a:hover, div.pagination a:active {

	border: 1px solid #000099;



	color: #000;

}

div.pagination span.current {

	padding: 2px 5px 2px 5px;

	margin: 2px;

		border: 1px solid #000099;

		

		font-weight: bold;

		background-color: #000099;

		color: #FFF;

	}

	div.pagination span.disabled { padding: 2px 5px; margin: 2px; border: solid 1px #eee; color: #ddd; background-image: url(images/back-body.png); }
	</style>
	' ;
	
    
    


 	$catid = intval($catid);
	$db->sql_query("update ".$prefix."_stories_cat set counter=counter+1 where catid='$catid'");
	
   
	$adjacents = 3;	
	$rows = 0;

	$query = "SELECT COUNT(*) as num FROM ".$prefix."_stories where catid='$catid' $querylang ORDER BY sid DESC";
	$total_pages = $db->sql_fetchrow($db->sql_query($query));
	$total_pages = $total_pages[num];
	
	/* Setup vars for query. */
	if (defined("HOME_FILE")){
         $targetpage = "index.php?page=niente";
	} else {
		$targetpage = "modules.php?name=$module_name&file=categories&op=newindex&catid=$catid"; 	//your file name  (the name of this file)
	}
	$page = $_GET['p'];
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0
	
	/* Get data. */
	
			
$news_sel = "SELECT sid, aid, title, time, hometext, bodytext, comments, counter, topic, informant, notes, acomm, score, ratings FROM ".$prefix."_stories where catid='$catid' $querylang ORDER BY sid DESC LIMIT $start, $limit";
	$result = $db->sql_query($news_sel);
	

	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
	$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\">";
		//previous button
		if ($page > 1) 
			$pagination.= "<a href=\"$targetpage&p=$prev\">« "._PREVIOUS."</a>";
		else
			$pagination.= "<span class=\"disabled\">« "._PREVIOUS."</span>";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a href=\"$targetpage&p=$counter\">$counter</a>";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage&p=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage&p=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage&p=$lastpage\">$lastpage</a>";		
			}
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<a href=\"$targetpage&p=1\">1</a>";
				$pagination.= "<a href=\"$targetpage&p=2\">2</a>";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage&p=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage&p=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage&p=$lastpage\">$lastpage</a>";		
			}
			else
			{
				$pagination.= "<a href=\"$targetpage&p=1\">1</a>";
				$pagination.= "<a href=\"$targetpage&p=2\">2</a>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage&p=$counter\">$counter</a>";					
				}
			}
		}
		
		if ($page < $counter - 1) 
			$pagination.= "<a href=\"$targetpage&p=$next\">"._NEXT." »</a>";
		else
			$pagination.= "<span class=\"disabled\">"._NEXT." »</span>";
		$pagination.= "</div>\n";		
	}
	echo "<table>";
    while ($row = $db->sql_fetchrow($result)) {
    $rows++;
    //MOD BY MIRKOFENU
		$s_sid = intval($row['sid']);
		$aid = filter($row['aid'], "nohtml");
		$title = filter($row['title'], "nohtml");
		$time = $row['time'];
		$hometext = filter($row['hometext']);
		$bodytext = filter($row['bodytext']);
		$comments = intval($row['comments']);
		$counter = intval($row['counter']);
		$topic = intval($row['topic']);
		$informant = filter($row['informant'], "nohtml");
		$notes = filter($row['notes']);
		$acomm = intval($row['acomm']);
		$score = intval($row['score']);
		$ratings = intval($row['ratings']);
		getTopics($s_sid);
		formatTimestamp($time);
		$subject = filter($subject, "nohtml");
		$introcount = strlen($hometext);
		$fullcount = strlen($bodytext);
		$totalcount = $introcount + $fullcount;
		$c_count = $comments;
		$r_options = "";
		if (isset($userinfo['umode'])) { $r_options .= "&amp;mode=".$userinfo['umode']; }
		if (isset($userinfo['uorder'])) { $r_options .= "&amp;order=".$userinfo['uorder']; }
		if (isset($userinfo['thold'])) { $r_options .= "&amp;thold=".$userinfo['thold']; }
		$story_link = "<a href=\"modules.php?name=News&amp;file=article&amp;sid=$s_sid$r_options\">";
		$morelink = "(";
		if ($fullcount > 0 OR $c_count > 0 OR $articlecomm == 0 OR $acomm == 1) {
			$morelink .= "$story_link<b>"._READMORE."</b></a> | ";
		} else {
			$morelink .= "";
		}
		if ($fullcount > 0) { $morelink .= "$totalcount "._BYTESMORE." | "; }
		if ($articlecomm == 1 AND $acomm == 0) {
			if ($c_count == 0) { $morelink .= "$story_link"._COMMENTSQ."</a>"; } elseif ($c_count == 1) { $morelink .= "$story_link$c_count "._COMMENT."</a>"; } elseif ($c_count > 1) { $morelink .= "$story_link$c_count "._COMMENTS."</a>"; }
		}
		if ($score != 0) {
			$rated = substr($score / $ratings, 0, 4);
		} else {
			$rated = 0;
		}
		$morelink .= " | "._SCORE." $rated";
		$morelink .= ")";
		$morelink = str_replace(" |  | ", " | ", $morelink);
		$sid = intval($s_sid);
		$row2 = $db->sql_fetchrow($db->sql_query("select title from ".$prefix."_stories_cat where catid='$catid'"));
		$title1 = filter($row2['title'], "nohtml");
		$title = "$title1: $title";
		//MOD BY MATTEOIAMMA
		echo "<td width='33%'>";
		themeindex($aid, $informant, $datetime, $title, $counter, $topic, $hometext, $notes, $morelink, $topicname, $topicimage, $topictext);
		echo "</td>";
   		if ($rows==$cols) {     
        	echo("</tr><tr>\n");
        	$rows=0;    
  		} 
        	
	}
	echo "</table>";
    	echo $pagination;
    //MOD BY MATTEOIAMMA
	if ($httpref==1) {
		$referer = $_SERVER['HTTP_REFERER'];
		if ($referer=="" OR ereg("unknown", $referer) OR eregi($nukeurl,$referer)) {
		} else {
			$db->sql_query("insert into ".$prefix."_referer values (NULL, '$referer')");
		}
		$numrows = $db->sql_numrows($db->sql_query("select * from ".$prefix."_referer"));
		if($numrows==$httprefmax) {
			$db->sql_query("delete from ".$prefix."_referer");
		}
	}
	include("footer.php");
}

switch ($op) {

	case "newindex":
	if ($catid == 0 OR $catid == "") {
		Header("Location: modules.php?name=$module_name");
	}
	theindex($catid);
	break;

	default:
	Header("Location: modules.php?name=$module_name");

}

?>