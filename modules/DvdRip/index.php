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
$instory = ''; 
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

if (isset($query)) {
	if (strlen($query) < 3) {
		Header("Location: modules.php?name=$module_name&qlen=1");
	}
}

global $admin, $prefix, $db, $module_name, $articlecomm, $multilingual, $admin_file;
if ($multilingual == 1) {
	$queryalang = "AND (s.alanguage='$currentlang' OR s.alanguage='')"; /* stories */
	$queryrlang = "AND rlanguage='$currentlang' "; /* reviews */
} else {
	$queryalang = "";
	$queryrlang = "";
	$queryslang = "";
}

	if (!isset($query)) { $query = ""; }
	if (!isset($type)) { $type = ""; }
	if (!isset($category)) { $category = 0; }
	if (!isset($days)) { $days = 0; }
	if (!isset($author)) { $author = ""; }

switch($op) {

	case "comments":
	break;

	default:
	$ThemeSel = get_theme();
	$offset=10;
	if (!isset($min)) $min=0;
	if (!isset($max)) $max=$min+$offset;
    $min = intval($min);
    $max = intval($max);
	$query = stripslashes(check_html($query, "nohtml"));
	$pagetitle = "- "._SEARCH."";
	include("header.php");
	$topic = intval($topic);
	if ($topic>0) {
		$row = $db->sql_fetchrow($db->sql_query("SELECT topicimage, topictext from ".$prefix."_topics where topicid='$topic'"));
		$topicimage = filter($row['topicimage'], "nohtml");
		$topictext = filter($row['topictext'], "nohtml");
		if (file_exists("themes/$ThemeSel/images/topics$topicimage")) {
			$topicimage = "themes/$ThemeSel/images/topics$topicimage";
		} else {
			$topicimage = "$tipath$topicimage";
		}
	} else {
		$topictext = ""._ALLTOPICS."";
		if (file_exists("themes/$ThemeSel/images/topics/AllTopics.gif")) {
			$topicimage = "themes/$ThemeSel/images/topics/AllTopics.gif";
		} else {
			$topicimage = "$tipath/AllTopics.gif";
		}
	}
	if (file_exists("themes/$ThemeSel/images/topics/AllTopics.gif")) {
		$alltop = "themes/$ThemeSel/images/topics/AllTopics.gif";
	} else {
		$alltop = "$tipath/AllTopics.gif";
	}
	OpenTable();
	echo "<center><strong>Sezione Dvd e BluRay Rip</strong></center>";
	echo "<table width=\"100%\" border=\"0\"><TR><TD>";
	$query="dvd-rip";
	if ($qlen == 1) {
			OpenTable();
			echo ""._SEARCHCHARACTERS."";
			CloseTable();
		}
		$query = stripslashes(check_html($query, "nohtml"));
		$query2 = filter($query, "nohtml", 1);
		$query3 = filter($query, "", 1);
		if ($type=="stories" OR !$type) {

			if ($category > 0) {
				$categ = "AND catid='$category' ";
			} else {
				$categ = "";
			}
			$desi="";
			$myquery = "SELECT COUNT(*) as num FROM ".$prefix."_stories s, ".$prefix."_authors a where s.aid=a.aid $queryalang $categ";
			$q = "select s.sid, s.aid, s.informant, s.title, s.time, s.hometext, s.bodytext, a.url, s.comments, s.topic from ".$prefix."_stories s, ".$prefix."_authors a where s.aid=a.aid $queryalang $categ";
			if (isset($query)) $desi .= "AND (s.title LIKE '%$query2%' OR s.hometext LIKE '%$query3%' OR s.bodytext LIKE '%$query3%' OR s.notes LIKE '%$query3%') ";
			if (!empty($author)) $desi .= "AND s.aid='$author' ";
			if (!empty($topic)) $desi .= "AND s.topic='$topic' ";
			if (!empty($days) && $days!=0) $desi .= "AND TO_DAYS(NOW()) - TO_DAYS(time) <= '$days' ";
			$myquery .= $desi;
			$q .= $desi;
			$q .= " ORDER BY s.time DESC LIMIT $min,$offset";
			$t = $topic;
			$total_pages = $db->sql_fetchrow($db->sql_query($myquery));
			$total_pages = $total_pages[num];
			$result5 = $db->sql_query($q);
			$nrows = $db->sql_numrows($result5);
			$x=0;
			if (!empty($query)) {
				echo "<table width=\"99%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n";
				if ($nrows>0) {
					while($row5 = $db->sql_fetchrow($result5)) {
						$sid = intval($row5['sid']);
						$aid = stripslashes($row5['aid']);
						$informant = filter($row5['informant'], "nohtml");
						$title = filter($row5['title'], "nohtml");
						$time = $row5['time'];
						$hometext = filter($row5['hometext']);
						$bodytext = filter($row5['bodytext']);
						$url = filter($row5['url'], "nohtml");
						$comments = intval($row5['comments']);
						$topic = intval($row5['topic']);
						$row6 = $db->sql_fetchrow($db->sql_query("SELECT topictext from ".$prefix."_topics where topicid='$topic'"));
						$topictext = filter($row6['topictext'], "nohtml");
						$furl = "modules.php?name=News&file=article&sid=$sid";
						$datetime = formatTimestamp($time);
						$query = stripslashes(check_html($query, "nohtml"));
						/*if (empty($informant)) {
							$informant = $anonymous;
						} else {
							$informant = "<a href='modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant'>$informant</a>";
						}*/
						if (!empty($query) AND $query != "*") {
							if (eregi(quotemeta($query),$title)) {
								$a = 1;
							}
							$text = "$hometext$bodytext";
							if (eregi(quotemeta($query),$text)) {
								$a = 2;
							}
							if (eregi(quotemeta($query),$text) AND eregi(quotemeta($query),$title)) {
								$a = 3;
							}
							if ($a == 1) {
								$match = _MATCHTITLE;
							} elseif ($a == 2) {
								$match = _MATCHTEXT;
							} elseif ($a == 3) {
								$match = _MATCHBOTH;
							}
							if (!isset($a)) {
								$match = "";
							} else {
								$match = "$match<br>";
							}
						}
						$topicimage="film.gif";
						echo "<td width='33%'>";
						$title="<a href=\"modules.php?name=News&amp;file=article&amp;sid=$sid$r_options\">$title</a>";
						themeindex($aid, $informant, $datetime, $title, $counter, $topic, $hometext, $notes, $morelink, $topicname, $topicimage, $topictext);
						echo "</td>";
						echo "</td></tr>\n";
						$x++;
					}

					echo "</table>";
				} else {
					echo "<tr><td><center><font class=\"option\"><b>"._NOMATCHES."</b></font></center><br><br>";
					echo "</td></tr></table>";
				}
				//inizio pagine
				$prev=$min-$offset;
				$cpag=($total_pages/$offset);
				if($cpag>1){
					echo "<div id=alphaindex>\n";
					echo "<br><br><center>";
					if ($prev>=0) {
						echo "<a href=\"modules.php?name=$module_name&amp;author=$author&amp;topic=$t&amp;min=$prev&amp;query=$query&amp;type=$type&amp;category=$category\">";
						echo "<b>Precedente</b></a>";
					}
					
					if($cpag<10){
						for($w=0;$w<=$cpag;$w++){
							$pagina=($w)*10;
							echo "<a href=\"modules.php?name=$module_name&amp;author=$author&amp;topic=$t&amp;min=".$pagina."&amp;query=$query&amp;type=$type&amp;category=$category\">".($w+1)."</a>";
						}
					}else{
						
						$bipoint=1;
						$currpag=($min/10);
						$countpag=0;
						if($currpag<=3)$currpag=0;
						else $currpag-=3;
						for($w=$currpag;$w<=$cpag;$w++){
							$pagina=($w)*10;
							if(($w<($currpag+6))||($w>($cpag-3)))echo "<a href=\"modules.php?name=$module_name&amp;author=$author&amp;topic=$t&amp;min=".$pagina."&amp;query=$query&amp;type=$type&amp;category=$category\">".($w+1)."</a>";
							else if($bipoint) {
								echo "...";
								$bipoint=0;
							}
						}
					}
					$next=$min+$offset;
					if ($x>=9) {
						echo "<a href=\"modules.php?name=$module_name&amp;author=$author&amp;topic=$t&amp;min=$max&amp;query=$query&amp;type=$type&amp;category=$category\">";
						echo "<b>Successiva</b></a>";
					}
					echo "</center></div>\n";
				}
			}

		} elseif ($type=="comments") {
			/*
			$sid = intval($sid);
			if (isset($sid)) {
			$row7 = $db->sql_fetchrow($db->sql_query("SELECT title from ".$prefix."_stories where sid='$sid'"));
			$st_title = stripslashes(check_html($row7['title'], "nohtml"));
			$instory = "AND sid='$sid'";
			} else {
			$instory = "";
			}
			*/
			$result8 = $db->sql_query("SELECT tid, sid, subject, date, name from ".$prefix."_comments where (subject like '%$query2%' OR comment like '%$query3%') order by date DESC limit $min,$offset");
			$nrows = $db->sql_numrows($result8);
			$x=0;
			if (!empty($query)) {
				echo "<br><hr noshade size=\"1\"><center><b>"._SEARCHRESULTS."</b></center><br><br>";
				echo "<table width=\"99%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n";
				if ($nrows>0) {
					while($row8 = $db->sql_fetchrow($result8)) {
						$tid = intval($row8['tid']);
						$sid = intval($row8['sid']);
						$subject = filter($row8['subject'], "nohtml");
						$date = $row8['date'];
						$name = filter($row8['name'], "nohtml");
						$row_res = $db->sql_fetchrow($db->sql_query("SELECT title from ".$prefix."_stories where sid='$sid'"));
						$title = filter($row_res['title'], "nohtml");
						$reply = $db->sql_numrows($db->sql_query("SELECT * from ".$prefix."_comments where pid='$tid'"));
						$furl = "modules.php?name=News&amp;file=article&amp;thold=-1&amp;mode=flat&amp;order=1&amp;sid=$sid#$tid";
						if(!$name) {
							$name = "$anonymous";
						} else {
							$name = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$name\">$name</a>";
						}
						$datetime = formatTimestamp($date);
						echo "<tr><td><img src=\"images/folders.gif\" border=\"0\" alt=\"\">&nbsp;<font class=\"option\"><a href=\"$furl\"><b>$subject</b></a></font><font class=\"content\"><br>"._POSTEDBY." $name"
						." "._ON." $datetime<br>"
						.""._ATTACHART.": $title<br>";
						if ($reply == 1) {
							echo "($reply "._SREPLY.")";
							if (is_admin($admin)) {
								echo " [ <a href=\"".$admin_file.".php?op=RemoveComment&amp;tid=$tid&amp;sid=$sid\">"._DELETE."</a> ]";
							}
							echo "<br><br><br></td></tr>\n";
						} else {
							echo "($reply "._SREPLIES.")";
							if (is_admin($admin)) {
								echo " [ <a href=\"".$admin_file.".php?op=RemoveComment&amp;tid=$tid&amp;sid=$sid\">"._DELETE."</a> ]";
							}
							echo "<br><br><br></td></tr>\n";
						}
						$x++;
					}
					echo "</table>";
				} else {
					echo "<tr><td><center><font class=\"option\"><b>"._NOMATCHES."</b></font></center><br><br>";
					echo "</td></tr></table>";
				}

				$prev=$min-$offset;
				if ($prev>=0) {
					print "<br><br><center><a href=\"modules.php?name=$module_name&amp;author=$author&amp;topic=$topic&amp;min=$prev&amp;query=$query&amp;type=$type\">";
					print "<b>$min "._PREVMATCHES."</b></a></center>";
				}

				$next=$min+$offset;
				if ($x>=9) {
					print "<br><br><center><a href=\"modules.php?name=$module_name&amp;author=$author&amp;topic=$topic&amp;min=$max&amp;query=$query&amp;type=$type\">";
					print "<b>"._NEXTMATCHES."</b></a></center>";
				}
			}
		} elseif ($type=="reviews") {
			$res_n = $db->sql_query("SELECT id, title, text, reviewer, score from ".$prefix."_reviews where (title like '%$query2%' OR text like '%$query3%') $queryrlang order by date DESC limit $min,$offset");
			$nrows = $db->sql_numrows($res_n);
			$x=0;
			if (!empty($query)) {
				echo "<br><hr noshade size=\"1\"><center><b>"._SEARCHRESULTS."</b></center><br><br>";
				echo "<table width=\"99%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n";
				if ($nrows>0) {
					while($rown = $db->sql_fetchrow($res_n)) {
						$id = intval($rown['id']);
						$title = filter($rown['title'], "nohtml");
						$text = filter($rown['text']);
						$reviewer = filter($rown['reviewer'], nohmtl);
						$score = intval($rown['score']);
						$furl = "modules.php?name=Reviews&amp;op=showcontent&amp;id=$id";
						$pages = count(explode( "[--pagebreak--]", $text ));
						echo "<tr><td><img src=\"images/folders.gif\" border=\"0\" alt=\"\">&nbsp;<font class=\"option\"><a href=\"$furl\"><b>$title</b></a></font><br>"
						."<font class=\"content\">"._POSTEDBY." $reviewer<br>"
						.""._REVIEWSCORE.": $score/10<br>";
						if ($pages == 1) {
							echo "($pages "._PAGE.")";
						} else {
							echo "($pages "._PAGES.")";
						}
						if (is_admin($admin)) {
							echo " [ <a href=\"modules.php?name=Reviews&amp;op=mod_review&amp;id=$id\">"._EDIT."</a> | <a href=\"modules.php?name=Reviews.php&amp;op=del_review&amp;id_del=$id\">"._DELETE."</a> ]";
						}
						print "<br><br><br></font></td></tr>\n";
						$x++;
					}
					echo "</table>";
				} else {
					echo "<tr><td><center><font class=\"option\"><b>"._NOMATCHES."</b></font></center><br><br>";
					echo "</td></tr></table>";
				}

				$prev=$min-$offset;
				if ($prev>=0) {
					print "<br><br><center><a href=\"modules.php?name=$module_name&amp;author=$author&amp;topic=$t&amp;min=$prev&amp;query=$query&amp;type=$type\">";
					print "<b>$min "._PREVMATCHES."</b></a></center>";
				}

				$next=$min+$offset;
				if ($x>=9) {
					print "<br><br><center><a href=\"modules.php?name=$module_name&amp;author=$author&amp;topic=$t&amp;min=$max&amp;query=$query&amp;type=$type\">";
					print "<b>"._NEXTMATCHES."</b></a></center>";
				}
			}
		} elseif ($type=="users") {
			$res_n3 = $db->sql_query("SELECT user_id, username, name from ".$user_prefix."_users where (username like '%$query2%' OR name like '%$query2%' OR bio like '%$query3%') order by username ASC limit $min,$offset");
			$nrows = $db->sql_numrows($res_n3);
			$x=0;
			if (!empty($query)) {
				echo "<br><hr noshade size=\"1\"><center><b>"._SEARCHRESULTS."</b></center><br><br>";
				echo "<table width=\"99%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n";
				if ($nrows>0) {
					while($rown3 = $db->sql_fetchrow($res_n3)) {
						$uid = intval($rown3['user_id']);
						$uname = filter($rown3['username'], "nohtml");
						$name = filter($rown3['name'], "nohtml");
						$furl = "modules.php?name=Your_Account&amp;op=userinfo&amp;username=$uname";
						if (empty($name)) {
							$name = ""._NONAME."";
						}
						echo "<tr><td><img src=\"images/folders.gif\" border=\"0\" alt=\"\">&nbsp;<font class=\"option\"><a href=\"$furl\"><b>$uname</b></a></font><font class=\"content\"> ($name)";
						if (is_admin($admin)) {
							echo " [ <a href=\"".$admin_file.".php?chng_uid=$uid&amp;op=modifyUser\">"._EDIT."</a> | <a href=\"".$admin_file.".php?op=delUser&amp;chng_uid=$uid\">"._DELETE."</a> ]";
						}
						echo "</font></td></tr>\n";
						$x++;
					}

					echo "</table>";
				} else {
					echo "<tr><td><center><font class=\"option\"><b>"._NOMATCHES."</b></font></center><br><br>";
					echo "</td></tr></table>";
				}

				$prev=$min-$offset;
				if ($prev>=0) {
					print "<br><br><center><a href=\"modules.php?name=$module_name&amp;author=$author&amp;topic=$t&amp;min=$prev&amp;query=$query&amp;type=$type\">";
					print "<b>$min "._PREVMATCHES."</b></a></center>";
				}

				$next=$min+$offset;
				if ($x>=9) {
					print "<br><br><center><a href=\"modules.php?name=$module_name&amp;author=$author&amp;topic=$t&amp;min=$max&amp;query=$query&amp;type=$type\">";
					print "<b>"._NEXTMATCHES."</b></a></center>";
				}
			}
		}
		CloseTable();
		if (isset($query) AND !empty($query)) {
			echo "<br>";
			OpenTable();
			echo "<font class=\"title\">In Più...<br><br>"
			."Non hai trovato quello che cercavi?</font><br><br>"
			."Cerca \"<b>$query</b>\" su:<br><br>"
			."<ul>"
			."<li> <a href=\"http://www.google.com/search?q=$query\" target=\"new\">Google</a>"
			."<li> <a href=\"http://groups.google.com/groups?q=$query\" target=\"new\">Google Groups</a>"
			."</ul>";
			CloseTable();
		}
		include("footer.php");
		break;
}

?>