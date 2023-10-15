<?php

$bgcolor1 = "#ffffff";
$bgcolor2 = "#9cbee6";
$bgcolor3 = "#d3e2ea";
$bgcolor4 = "#003366";
$textcolor1 = "#000000";
$textcolor2 = "#000000";

function OpenTable() {
    global $bgcolor1, $bgcolor2;
    echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"0\" bgcolor=\"$bgcolor2\"><tr><td>\n";
    echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"8\" bgcolor=\"$bgcolor1\"><tr><td>\n";
}

function CloseTable() {
    echo "</td></tr></table></td></tr></table>\n";
}

function OpenTable2() {
    global $bgcolor1, $bgcolor2;
    echo "<table border=\"0\" cellspacing=\"1\" cellpadding=\"0\" bgcolor=\"$bgcolor2\" align=\"center\"><tr><td>\n";
    echo "<table border=\"0\" cellspacing=\"1\" cellpadding=\"8\" bgcolor=\"$bgcolor1\"><tr><td>\n";
}

function CloseTable2() {
    echo "</td></tr></table></td></tr></table>\n";
}

function FormatStory($thetext, $notes, $aid, $informant) {
    global $anonymous;
    if (!empty($notes)) {
	$notes = "<br><br><b>"._NOTE."</b> <i>$notes</i>\n";
    } else {
	$notes = "";
    }
    if ("$aid" == "$informant") {
	echo "<font class=\"content\">$thetext$notes</font>\n";
    } else {
	if(!empty($informant)) {
	    $boxstuff = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant\">$informant</a> ";
	} else {
	    $boxstuff = "$anonymous ";
	}
	$boxstuff .= ""._WRITES." <i>\"$thetext\"</i>$notes\n";
	echo "<font class=\"content\">$boxstuff</font>\n";
    }
}

/************************************************************/
/* Function themeheader()                                   */
/************************************************************/

function themeheader() {
    global $banners, $sitename,$prefix, $db;
    echo "<body bgcolor=\"#003366\" text=\"#000000\" link=\"0000ff\">"
	."<br>\n";
	echo "<div id=\"fb-root\"></div>\n";
	echo "<script>(function(d, s, id) {\n";
  	echo "var js, fjs = d.getElementsByTagName(s)[0];\n";
	echo "if (d.getElementById(id)) return;\n";
    echo "js = d.createElement(s); js.id = id;\n";
    echo "js.src = \"//connect.facebook.net/it_IT/all.js#xfbml=1\";\n";
  	echo "fjs.parentNode.insertBefore(js, fjs);\n";
 	echo "}(document, 'script', 'facebook-jssdk'));</script>\n";
	$ads = ads(0);
	echo "$ads";
	echo "<br>";
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"950\" align=\"center\">\n"
	."<tr><td width=\"100%\">\n"
	."<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n"
	."<tr><td width=\"100%\">\n"
	."<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n"
	."<tr><td width=\"100%\" height=\"88\" bgcolor=\"#FFFFFF\">\n"
	."<table border=0 width=100% cellpadding=0 cellspacing=0><tr><td align=\"center\" bgcolor=\"#003366\"><a href=\"index.php\"><img border=\"0\" src=\"themes/DeepBlue/images/logo.jpg\" alt=\"Welcome to $sitename!\" ></a></td></tr></table></td></tr>\n"
	."<tr><td width=\"100%\" bgcolor=\"#d3e2ea\" height=\"19\" valign=\"bottom\" align=\"center\">\n"
	."<div id=\"navigation\">\n"
	."<ul>\n"
	."<li><a href=\"index.php\" title=\"Home\">Home</a>\n"
	."<ul>\n" 
	."<li><a href=\"http://film.trigunstreaming.it\" title=\"Film Home\">Home Film</a></li>\n"
	."<li><a href=\"http://anime.trigunstreaming.it\" title=\"Anime Home\">Home Anime</a></li>\n"
	."</ul>\n"
	."</li>\n"
	."<li><a href=\"modules.php?name=Your_Account\" title=\"Account\">Utenti</a>\n"
	."<ul>\n" 
	."<li><a href=\"modules.php?name=Your_Account\" title=\"Accedi\">Accedi</a></li>\n"
	."<li><a href=\"modules.php?name=Your_Account&op=new_user\" title=\"Registrati\">Registrati</a></li>\n"
	."<li><a href=\"modules.php?name=Your_Account&op=pass_lost\" title=\"Password lost\">Password Dimenticata</a></li>\n"
	."<li><a href=\"modules.php?name=Submit_News\" title=\"Inserisci Articolo\">Inserisci Articolo</a></li>\n"
	."<li><a href=\"modules.php?name=Private_Messages\" title=\"Messaggi Privati\">Messaggi Privati</a></li>\n"
	."</ul>\n"
	."</li>\n"
	."<li><a href=\"modules.php?name=DvdRip\" title=\"Cerca\">Film DVD-Rip</a>\n"
	."</li>\n"
	."<li><a href=\"modules.php?name=Cerca\" title=\"Cerca\">Cerca Film</a>\n"
	."<ul>\n"
	."<li><a href=\"modules.php?name=Cerca\" title=\"Cerca\">Cerca Film</a></li>\n"
	."<li><a href=\"modules.php?name=Stories_Archive&sa=show_all\" title=\"Archivio\">Archivio Film</a></li>\n"
	."</ul>\n"
	."</li>\n"
	."<li><a href=\"modules.php?name=TVStream\" title=\"TV Streaming\">Canali TV</a></li>\n"
	."<li><a href=\"modules.php?name=Forums\" title=\"Forum\">Forum</a>\n"
	."<ul>\n"
	."<li><a href=\"modules.php?name=Forums\" title=\"Forum\">Trigun's Forum</a>\n"
	."<li><a href=\"modules.php?name=Live_Chat\" title=\"Chat\">Trigun's Chat</a></li>\n"
	."</ul>\n"
	."</li>\n"
	."<li><a href=\"modules.php?name=Contattaci\" title=\"Contattaci\">Contattaci</a>\n"
	."<ul>\n"
	."<li><a href=\"modules.php?name=Contattaci&oggetto=Consigli per migliorare\" title=\"Consiglia\">Consigli per migliorare</a></li>\n"
	."<li><a href=\"modules.php?name=Contattaci&oggetto=Segnala un abuso\" title=\"Segnala abuso\">Segnala un abuso</a></li>\n"
	."<li><a href=\"modules.php?name=Contattaci&oggetto=Segnala un errore\" title=\"Segnala errore\">Segnala un errore</a></li>\n"
	."<li><a href=\"modules.php?name=Banner\" title=\"Scambio banner\">Scambio banner</a></li>\n"
	."</ul>\n"
	."</li>\n"
	."<li><a href=\"#\" title=\"Guide Utili\">Guide Utili</a>\n"
	."<ul>\n"
	."<li><a href=\"http://www.trigunstreaming.altervista.org/modules.php?name=Forums&file=viewtopic&p=12&sid=1c26313436d7b893036f318666c1417c#12\" title=\"Guida streaming\">Guida allo Streaming</a></li>\n"
	."<li><a href=\"http://www.trigunstreaming.altervista.org/modules.php?name=Forums&file=viewtopic&p=13&sid=1c26313436d7b893036f318666c1417c#13\" title=\"Guida download\">Guida al Download</a></li>\n"
	."</ul>\n"
	."</li>\n"
	."<li><a href=\"#\" title=\"Trigun\">Trigun</a>\n"
	."<ul>\n"
	."<li><a href=\"modules.php?name=Disclaimer\" title=\"Disclaimer\">Disclaimer</a></li>\n"
	."<li><a href=\"modules.php?name=Top\" title=\"Topten\">Top 10</a></li>\n"
	."<li><a href=\"modules.php?name=Web_Links\" title=\"Link\">Link</a></li>\n"
	."<li><a href=\"modules.php?name=Recommend_Us\" title=\"Invita amico\">Invita un amico</a></li>\n"
	."</ul>\n"
	."</li>\n"
	."</ul>"
	."</div>"
	."<br>"
	."<center><script type=\"text/javascript\">"
	."/* <![CDATA[ */"
	."document.write('<s'+'cript type=\"text/javascript\" src=\"http://ad.altervista.org/js.ad/size=728X90/r='+new Date().getTime()+'\"><\/s'+'cript>');/* ]]> */"
	."</script></center>"
	."</td></tr></table>\n"
	."</td></tr><tr><td width=\"100%\"><table width='100%' cellspacing='0' cellpadding='0' border='0'><tr><td bgcolor='#d3e2ea'>\n"
    ."<p><strong><center>Indice Alfabetico</center></strong></p>"
	."<div id=alphaindex><center><a href='index.php?alpha=1'>0-9</a>&nbsp;<a href='index.php?alpha=A'>A</a>&nbsp;<a href='index.php?alpha=B'>B</a>&nbsp;<a href='index.php?alpha=C'>C</a>&nbsp;<a href='index.php?alpha=D'>D</a>&nbsp;<a href='index.php?alpha=E'>E</a>&nbsp;<a href='index.php?alpha=F'>F</a>&nbsp;<a href='index.php?alpha=G'>G</a>&nbsp;<a href='index.php?alpha=H'>H</a>&nbsp;<a href='index.php?alpha=I'>I</a>&nbsp;<a href='index.php?alpha=J'>J</a>&nbsp;<a href='index.php?alpha=K'>K</a>&nbsp;<a href='index.php?alpha=L'>L</a>&nbsp;<a href='index.php?alpha=M'>M</a>&nbsp;<a href='index.php?alpha=N'>N</a>&nbsp;<a href='index.php?alpha=O'>O</a>&nbsp;<a href='index.php?alpha=P'>P</a>&nbsp;<a href='index.php?alpha=Q'>Q</a>&nbsp;<a href='index.php?alpha=R'>R</a>&nbsp;<a href='index.php?alpha=S'>S</a>&nbsp;<a href='index.php?alpha=T'>T</a>&nbsp;<a href='index.php?alpha=U'>U</a>&nbsp;<a href='index.php?alpha=V'>V</a>&nbsp;<a href='index.php?alpha=W'>W</a>&nbsp;<a href='index.php?alpha=X'>X</a>&nbsp;<a href='index.php?alpha=Y'>Y</a>&nbsp;<a href='index.php?alpha=Z'>Z</a></center></div>\n"
	."<div id=\"new\"><div id=\"countd\" name=\"countd\"><b><center>CountDown<center></b></div></div>\n" 
	// Codice conto alla rovescia fine anno by Mirko Fenu
	//."<script language=\"JavaScript\">\n"
	//."<!-- Hide JavaScript from Java-Impaired Browsers\n"
	//."aggOra();"
	//."// End Hiding -->"
	//."< /script>";
	$public_msg = public_message();
    echo "$public_msg<br>";
    echo "</td></tr></table><table width=\"100%\" cellpadding=\"0\" bgcolor=\"d3e2ea\" cellspacing=\"0\" border=\"0\">\n"
	."<tr valign=\"top\">\n"
	."<td><img src=\"themes/DeepBlue/images/pixel.gif\" width=\"6\" height=\"1\" border=\"0\" alt=\"\"></td>\n"
	."<td width=\"138\" bgcolor=\"d3e2ea\" valign=\"top\">\n";
    blocks("left");
    echo "</td><td><img src=\"themes/DeepBlue/images/pixel.gif\" width=\"10\" height=\"1\" border=\"0\" alt=\"\"></td><td width=\"100%\">\n";
	//inizio codice modificato da Mirko Fenu
	if (defined('INDEX_FILE')) {
	//variabili delle foto n prima pagina
	$Loca1=774;
	$Loca2=751;
	$Loca3=759;
	$Loca4=766;
	$Loca5=696;
	$Loca6=792;
	$altezza=250;
	$x=1;
	for($x=0;$x<=5;$x++){
		if($x==0) $ser=$Loca1;
		if($x==1) $ser=$Loca2;
		if($x==2) $ser=$Loca3;
		if($x==3) $ser=$Loca4;
		if($x==4) $ser=$Loca5;
		if($x==5) $ser=$Loca6;
		$result = $db->sql_query("SELECT sid, title, hometext FROM ".$prefix."_stories WHERE sid='$ser'");
		$row = $db->sql_fetchrow($result);
		$rsid = intval($row['sid']);
		$rtitle = filter($row['title'], "nohtml");
		$rtext = $row['hometext'];
		$rtext=strstr($rtext,"src=\"");
		$rtext=substr($rtext, 5);
		$finalpos=strpos($rtext,"\"");
		$rtext=substr($rtext, 0,$finalpos);
		if($x==0){
			$foto1=$rtext;
			$titolo1=$rtitle;
			$indice1=$rsid;
		}
		if($x==1){
			$foto2=$rtext;
			$titolo2=$rtitle;
			$indice2=$rsid;
		}
		if($x==2){
			$foto3=$rtext;
			$titolo3=$rtitle;
			$indice3=$rsid;
		}
		if($x==3){
			$foto4=$rtext;
			$titolo4=$rtitle;
			$indice4=$rsid;
		}
		if($x==4){
			$foto5=$rtext;
			$titolo5=$rtitle;
			$indice5=$rsid;
		}
		if($x==5){
			$foto6=$rtext;
			$titolo6=$rtitle;
			$indice6=$rsid;
		}
	}
	
	echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\"><tr>\n"
	."<td width=\"100%\" bgcolor=\"#d3e2ea\"><font class=\"option\"><div id=\"new\"><b><center>Le Ultime Uscite - Il Meglio dei Film in Streaming per voi</center></b></div></font></td></tr>\n" 
	."</table>\n"
	."<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\"><tr><td bgcolor=\"#d3e2ea\">\n"
	."<table border=\"0\" cellpadding=\"0\" cellspacing=\"1\" width=\"100%\"><tr><td bgcolor=\"#d3e2ea\">\n"
	."<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\"><tr>\n"
	."<tr><td colspan=\"2\" bgcolor=\"#d3e2ea\"><br>\n"
	."<table border=\"0\" width=\"98%\" align=\"center\"><tr><td>\n"
	."<div id=\"new\"><p><center><a href=\"modules.php?name=News&amp;file=article&amp;sid=$indice1\"> <img src=\"$foto1\" alt=\"$titolo1\" height=\"$altezza\" /><br>$titolo1</a></center></p>\n"
	."</div>\n"
	."</td>\n"
	."<td>"
	."<div id=\"new\"><p><center><a href=\"modules.php?name=News&amp;file=article&amp;sid=$indice2\"> <img src=\"$foto2\" alt=\"$titolo2\" height=\"$altezza\" /><br>$titolo2</a></center></p>\n"
	."</div>\n"
	."</td>\n"
	."<td>"
	."<div id=\"new\"><p><center><a href=\"modules.php?name=News&amp;file=article&amp;sid=$indice3\"> <img src=\"$foto3\" alt=\"$titolo3\" height=\"$altezza\" /><br>$titolo3</a></center></p>\n"
	."</div>\n"
	."</td>\n"
	."</tr>\n"
	."<tr>\n"
	."<td>\n"
	."<div id=\"new\"><p><center><a href=\"modules.php?name=News&amp;file=article&amp;sid=$indice4\"> <img src=\"$foto4\" alt=\"$titolo4\" height=\"$altezza\" /><br>$titolo4</a></center></p>\n"
	."</div>\n"
	."</td>\n"
	."<td>"
	."<div id=\"new\"><p><center><a href=\"modules.php?name=News&amp;file=article&amp;sid=$indice5\"> <img src=\"$foto5\" alt=\"$titolo5\" height=\"$altezza\" /><br>$titolo5</a></center></p>\n"
	."</div>\n"
	."</td>\n"
	."<td>"
	."<div id=\"new\"><p><center><a href=\"modules.php?name=News&amp;file=article&amp;sid=$indice6\"> <img src=\"$foto6\" alt=\"$titolo6\" height=\"$altezza\" /><br>$titolo6</a></center></p>\n"
	."</div>\n"
	."</td>\n"
	."</tr>\n"
	."</table>\n"
	."</td></tr></table>\n"
	."</td></tr></table>\n"
	."</td></tr></table><br>\n"
	."<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\"><tr>\n"
	."<td width=\"100%\" bgcolor=\"#d3e2ea\"><font class=\"option\"><div id=\"new\"><b><center>Gli ultimi Film Inseriti</center></b></div></font></td></tr>\n"
	."</table>\n";
	}
	//fine codice modificato
}

/************************************************************/
/* Function themefooter()                                   */
/*                                                          */
/* Control the footer for your site. You don't need to      */
/* close BODY and HTML tags at the end. In some part call   */
/* the function for right blocks with: blocks(right);       */
/* Also, $index variable need to be global and is used to   */
/* determine if the page your're viewing is the Homepage or */
/* and internal one.                                        */
/************************************************************/

function themefooter() {
    echo "<br>";
    if (defined('INDEX_FILE')) {
	echo "</td><td><img src=\"themes/DeepBlue/images/pixel.gif\" width=\"10\" height=\"1\" border=\"0\" alt=\"\"></td><td valign=\"top\" width=\"138\" bgcolor=\"d3e2ea\">\n";
	blocks("right");
	echo "<td><img src=\"themes/DeepBlue/images/pixel.gif\" width=\"6\" height=\"1\" border=\"0\" alt=\"\">";
    }
 else {
	echo "</td><td colspan=\"2\"><img src=\"themes/DeepBlue/images/pixel.gif\" width=\"10\" height=\"1\" border=\"0\" alt=\"\">";
    }
    echo "<br><br></td></tr></table>\n"
	."<br><center>";
    footmsg();
    echo "</center>";
}


function themeindex ($aid, $informant, $time, $title, $counter, $topic, $thetext, $notes, $morelink, $topicname, $topicimage, $topictext) {
    global $anonymous, $tipath;
    echo "<table id=\"notizie\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\"><tr><td bgcolor=\"#FFFFFF\">\n"
	."<img src=\"themes/DeepBlue/images/dot.gif\" border=\"0\"></td><td width=\"100%\" bgcolor=\"#FFFFFF\"><font class=\"option\"><b><span itemprop=\"name\">&nbsp;$title</span></b></font></td></tr>\n"
	."<tr><td colspan=\"2\" bgcolor=\"#FFFFFF\"><br>\n"
	."<table border=\"0\" width=\"98%\" align=\"center\"><tr><td>\n"
	."<a href=\"modules.php?name=News&new_topic=$topic\"><img src=\"$tipath$topicimage\" alt=\"$topictext\" border=\"0\" align=\"right\"></a>";
	FormatStory($thetext, $notes, $aid, $informant);
    echo "</td></tr><tr><td bgcolor=\"#FFFFFF\" align=\"center\">\n"
	."<p><hr></p>"
	."<font class=\"tiny\">"._POSTEDBY." ";
    formatAidHeader($aid);
    echo " "._ON." $time $timezone ($counter "._READS.")<br></font>\n"
	."<font class=\"content\">$morelink</font></center>\n"
	."<img src=\"themes/DeepBlue/images/pixel.gif\" border=\"0\" height=\"2\">\n"
	."</td></tr></table>\n"
	."</td></tr></table><br>\n";
}

function themearticle ($aid, $informant, $datetime, $title, $thetext, $topic, $topicname, $topicimage, $topictext) {
    global $admin, $sid, $tipath, $r_options;
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\"><tr><td bgcolor=\"#000000\">\n"
	."<table border=\"0\" cellpadding=\"0\" cellspacing=\"1\" width=\"100%\"><tr><td bgcolor=\"#FFFFFF\">\n"
	."<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\"><tr><td bgcolor=\"#FFFFFF\">\n"
	."<img src=\"themes/DeepBlue/images/dot.gif\" border=\"0\"></td><td width=\"100%\" bgcolor=\"#FFFFFF\"><font class=\"option\"><b>&nbsp;$title</b></font></td></tr>\n"
	."<tr><td colspan=\"2\" bgcolor=\"#FFFFFF\"><br>\n"
	."<table border=\"0\" width=\"98%\" align=\"center\"><tr><td>\n"
	."<a href=\"modules.php?name=News&new_topic=$topic\"><img src=\"$tipath$topicimage\" alt=\"$topictext\" border=\"0\" align=\"right\"></a>";
    FormatStory($thetext, $notes="", $aid, $informant);
    echo "<br>";
	echo "<br>";
	echo "<tr><td width=\"100%\" bgcolor=\"#d3e2ea\" height=\"19\" valign=\"bottom\" align=\"center\">\n";
	echo "<div style='float:left;'>\n";
    echo "<a href='http://twitter.com/share' class='twitter-share-button' data-count='horizontal' data-via='MirkoFenu' data-lang='it'>Tweet</a><script type='text/javascript' src='http://platform.twitter.com/widgets.js'></script>\n";
	echo "<g:plusone size='medium'></g:plusone>\n";
	echo "</div>\n";
	echo "<br clear='all'/>\n";
	echo "<br>";
	echo "</td></tr></table>\n"
	."</td></tr></table><br>\n"
	."</td></tr></table>\n"
	."</td></tr></table><br><br>\n";
}

function themesidebox($title, $content) {
    echo "<table border=\"0\" align=\"center\" width=\"138\" cellpadding=\"0\" cellspacing=\"0\">"
	."<tr><td background=\"themes/DeepBlue/images/table-title.gif\" width=\"138\" height=\"20\">"
	."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color=\"#FFFFFF\"><b>$title</b></font>"
	."</td></tr><tr><td><img src=\"themes/DeepBlue/images/pixel.gif\" width=\"100%\" height=\"3\"></td></tr></table>\n"
	."<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"138\">\n"
	."<tr><td width=\"138\" bgcolor=\"#000000\">\n"
	."<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\" width=\"138\">\n"
	."<tr><td width=\"138\" bgcolor=\"#ffffff\">\n"
	."$content"
	."</td></tr></table></td></tr></table><br>";
}

?>