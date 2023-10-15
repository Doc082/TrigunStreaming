<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

//MODIFICATO BY MATTEOIAMMA - WWW.MATTEOIAMMARRONE.COM
// - SISTEMA DI PAGINAZIONE AVANZATO
// - SUDDIVISIONE IN UNA O PIU' COLONNE

if ( !defined('MODULE_FILE') )
{
	die("You can't access this file directly...");
}

define('INDEX_FILE', true);
require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);


    $cols = 2; //COLONNE IN CUI SUDDIVIDERE LE NEWS
    $limit = 10; //NEWS PER PAGINA

function theindex($new_topic="0") {
    global $db, $storyhome, $topicname, $topicimage, $topictext, $datetime, $user, $cookie, $nukeurl, $prefix, $multilingual, $currentlang, $articlecomm, $sitename, $user_news, $userinfo, $module_name, $limit, $cols;
    if (is_user($user)) { getusrinfo($user); }
    if ($multilingual == 1) {
	$querylang = "AND (alanguage='$currentlang' OR alanguage='')";
    } else {
	$querylang = "";
    }
    
    include("header.php");
    automated_news();
    if (isset($new_topic)) {
    $new_topic = intval($new_topic);
    } else {
    $new_topic == 0;
    }
    if (isset($userinfo['storynum']) AND $user_news == 1) {
	$storynum = $userinfo['storynum'];
    } else {
	$storynum = $storyhome;
    }
    if ($new_topic == 0) {
	$qdb = "WHERE (ihome='0' OR catid='0')";
	$home_msg = "";
    } else {
	$qdb = "WHERE topic='$new_topic'";
	$result_a = $db->sql_query("SELECT topictext FROM ".$prefix."_topics WHERE topicid='$new_topic'");
	$row_a = $db->sql_fetchrow($result_a);	
	$numrows_a = $db->sql_numrows($result_a);
	$topic_title = check_words(check_html($row_a['topictext'], "nohtml"));
	OpenTable();
	if ($numrows_a == 0) {
	    echo "<center><font class=\"title\">$sitename</font><br><br>"._NOINFO4TOPIC."<br><br>[ <a href=\"modules.php?name=News\">"._GOTONEWSINDEX."</a> | <a href=\"modules.php?name=Topics\">"._SELECTNEWTOPIC."</a> ]</center>";
	} else {
	    echo "<center><font class=\"title\">$sitename: $topic_title</font><br><br>"
		."<form action=\"modules.php?name=Search\" method=\"post\">"
		."<input type=\"hidden\" name=\"topic\" value=\"$new_topic\">"
		.""._SEARCHONTOPIC.": <input type=\"name\" name=\"query\" size=\"30\">&nbsp;&nbsp;"
		."<input type=\"submit\" value=\""._SEARCH."\">"
		."</form>"
		."[ <a href=\"index.php\">"._GOTOHOME."</a> | <a href=\"modules.php?name=Topics\">"._SELECTNEWTOPIC."</a> ]</center>";
	}
	CloseTable();
	echo "<br>";
    }
    $alpha=0;
	if(isset($_GET['alpha'])) $alpha=$_GET['alpha'];
	if($alpha=='1') $qdb .= " AND title REGEXP '^[0-9]'";
	else if($alpha) $qdb .= " AND title REGEXP '^$alpha'";
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
	
    
    


 //     $result = $db->sql_query("SELECT sid, catid, aid, title, time, hometext, bodytext, comments, counter, topic, informant, notes, acomm, score, ratings FROM ".$prefix."_stories $qdb $querylang ORDER BY sid DESC limit $storynum");
   
	$adjacents = 3;	
	$rows = 0;

	$query = "SELECT COUNT(*) as num FROM ".$prefix."_stories $qdb $querylang ORDER BY sid DESC";
	$total_pages = $db->sql_fetchrow($db->sql_query($query));
	$total_pages = $total_pages[num];
	
	/* Setup vars for query. */
	if (defined("HOME_FILE")){
         $targetpage = "index.php?page=niente";
	} else {
		$targetpage = "modules.php?name=$module_name&file=index"; 	//your file name  (the name of this file)
	}
	if($new_topic) $targetpage .= "&new_topic=$new_topic";
	if($alpha) $targetpage .="&alpha=$alpha";
	$page = $_GET['p'];
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0
	
	/* Get data. */
	
			
$news_sel = "SELECT sid, catid, aid, title, time, hometext, bodytext, comments, counter, topic, informant, notes, acomm, score, ratings FROM ".$prefix."_stories $qdb $querylang ORDER BY sid DESC LIMIT $start, $limit";
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
    //MOD BY MATTEOIAMMA
	$s_sid = intval($row['sid']);
	$catid = intval($row['catid']);
	$aid = check_html($row['aid'], "nohtml");
	$title = stripslashes(check_words(check_html($row['title'], "nohtml")));
	$time = $row['time'];
	$hometext = stripslashes($row['hometext']);
    $bodytext = stripslashes($row['bodytext']);
    $comments = stripslashes($row['comments']);
	$counter = intval($row['counter']);
	$topic = intval($row['topic']);
	$informant = check_html($row['informant'], "nohtml");
	$notes = stripslashes($row['notes']);
	$acomm = intval($row['acomm']);
	$score = intval($row['score']);
	$ratings = intval($row['ratings']);
	if ($catid > 0) {
	    $row2 = $db->sql_fetchrow($db->sql_query("SELECT title FROM ".$prefix."_stories_cat WHERE catid='$catid'"));
	    $cattitle = check_words(check_html($row2['title'], "nohtml"));
	}
	getTopics($s_sid);
	formatTimestamp($time);
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
	$sid = intval($s_sid);
	if ($catid != 0) {
	    $row3 = $db->sql_fetchrow($db->sql_query("SELECT title FROM ".$prefix."_stories_cat WHERE catid='$catid'"));
	    $title1 = check_words(check_html($row3['title'], "nohtml"));
	    $title = "<a href=\"modules.php?name=News&amp;file=categories&amp;op=newindex&amp;catid=$catid\"><font class=\"storycat\">$title1</font></a>: <a href=\"modules.php?name=News&file=article&sid=$sid\">$title - Streaming Ita</a>";
	    $morelink .= " | <a href=\"modules.php?name=News&amp;file=categories&amp;op=newindex&amp;catid=$catid\">$title1</a>";
	}
	if ($score != 0) {
	    $rated = substr($score / $ratings, 0, 4);
	} else {
	    $rated = 0;
	}
	$morelink .= " | "._SCORE." $rated";
	$morelink .= ")";
	$morelink = str_replace(" |  | ", " | ", $morelink);
	//MOD BY MATTEOIAMMA
	echo "<td id=\"noti2\" width='33%'>\n";
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
    
    
    include("footer.php");
}

function rate_article($sid, $score) {
    global $prefix, $db, $ratecookie, $sitename, $r_options;
    $score = intval($score);
    $random_num = intval($random_num);
    $sid = intval($sid);
    if ($score) {
	if ($score > 5) { $score = 5; }
	if ($score < 1) { $score = 1; }
	if ($score != 1 AND $score != 2 AND $score != 3 AND $score != 4 AND $score != 5) {
	    Header("Location: index.php");
	    die();
	}
	if (isset($ratecookie)) {
	    $rcookie = base64_decode($ratecookie);
	    $rcookie = addslashes($rcookie);
	    $r_cookie = explode(":", $rcookie);
	}
	for ($i=0; $i < sizeof($r_cookie); $i++) {
	    if ($r_cookie[$i] == $sid) {
		$a = 1;
	    }
	}
	if ($a == 1) {
	    Header("Location: modules.php?name=News&op=rate_complete&sid=$sid&rated=1");
	} else {
	    $result = $db->sql_query("update ".$prefix."_stories set score=score+$score, ratings=ratings+1 where sid='$sid'");
	    $info = base64_encode("$rcookie$sid:");
	    setcookie("ratecookie","$info",time()+3600);
	    update_points(7);
	    Header("Location: modules.php?name=News&op=rate_complete&sid=$sid$r_options");
	}
    } else {
	include("header.php");
	title("$sitename: "._ARTICLERATING."");
	OpenTable();
	echo "<center>"._DIDNTRATE."<br><br>"
	    .""._GOBACK."</center>";
	CloseTable();
	include("footer.php");
    }
}

function rate_complete($sid, $rated=0) {
    global $sitename, $user, $cookie, $userinfo;
    $sid = intval($sid);	
    $r_options = "";
    if (is_user($user)) {
	getusrinfo($user);
	if (isset($userinfo['umode'])) { $r_options .= "&amp;mode=".$userinfo['umode']; }
	if (isset($userinfo['uorder'])) { $r_options .= "&amp;order=".$userinfo['uorder']; }
	if (isset($userinfo['thold'])) { $r_options .= "&amp;thold=".$userinfo['thold']; }
    }
    include("header.php");
    title("$sitename: "._ARTICLERATING."");
    OpenTable();
    if ($rated == 0) {
	echo "<center>"._THANKSVOTEARTICLE."<br><br>"
	    ."[ <a href=\"modules.php?name=News&amp;file=article&amp;sid=$sid$r_options\">"._BACKTOARTICLEPAGE."</a> ]</center>";
    } elseif ($rated == 1) {
	echo "<center>"._ALREADYVOTEDARTICLE."<br><br>"
	    ."[ <a href=\"modules.php?name=News&amp;file=article&amp;sid=$sid$r_options\">"._BACKTOARTICLEPAGE."</a> ]</center>";
    }
    CloseTable();
    include("footer.php");
}

if (!(isset($new_topic))) { $new_topic = 0; }
if (!(isset($op))) { $op = ""; }
if (!(isset($random_num))) { $random_num = ""; }
if (!(isset($gfx_check))) { $gfx_check = ""; }
if (!(isset($rated))) { $rated = 0; }
if (!(isset($score))) { $score = 0; }

switch ($op) {

    default:
    theindex($new_topic);
    break;

    case "rate_article":
    rate_article($sid, $score);
    break;

    case "rate_complete":
    rate_complete($sid, $rated);
    break;

}

?>