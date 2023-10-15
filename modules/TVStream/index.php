<?php 
if (!defined('MODULE_FILE')) {
	die ("You can't access this file directly...");
}

require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

$pagetitle = "- $module_name";


include("header.php");
OpenTable();
echo "<div align=\"center\">\n"
 	."<p>\n"
	."<font face=\"Times New Roman, Times, serif\">\n"
	."<h1>\n"
	."<font color=\"#FF0000\" size=\"6\"><strong>Canali Tv in Streaming</strong></font>\n"
	."</h1>\n"
	."</font>\n"  
	."<p>Volete vedere i canali del digitale terrestre? niente di pi&ugrave; facile... niente"
    ."decoder o parabola, solo internet!<br>\n" 
	."<strong>Clicca sul canale che preferisci per vederlo Live!</strong></p>\n"
	."<p>&nbsp;</p>\n"
  	."<table border=0 cellpadding=\"5\">\n"
  	."<tr>\n"
	."<td colspan=\"4\">\n"
	."<div align=\"center\"><strong>Reti Rai</strong>\n"
	."</div></td>\n"
	."</tr>\n"
	."<tr>\n"
	."<td width=\"188\">\n"
	."<a href=\"modules.php?name=TVStream&file=tele&fn=Rai1\"><img src=\"images/rai1.jpg\" alt=\"Rai Uno\" border=\"0\"></a>\n"
	."</td>\n"
	."<td width=\"261\">\n"
	."<a href=\"modules.php?name=TVStream&file=tele&fn=Rai2\"><img src=\"images/rai2.jpg\" alt=\"Rai Due\" border=\"0\"></a>\n"
	."</td>\n"
	."<td width=\"418\">\n"
	."<a href=\"modules.php?name=TVStream&file=tele&fn=Rai3\"><img src=\"images/Rai3.jpg\" alt=\"Rai Tre\" border=\"0\"></a>\n"
	."</td>\n"
	."<td width=\"186\">\n"
	."<a href=\"modules.php?name=TVStream&file=tele&fn=Rai4\"><img src=\"images/rai4.png\" alt=\"Rai Quattro\" border=\"0\"></a>\n"
	."</td>\n"
	."</tr>\n"
	."<tr>\n"
	."<td>\n"
	."<a href=\"modules.php?name=TVStream&file=tele&fn=Rai5\"><img src=\"images/rai5.jpg\" alt=\"Rai Cinque\" border=\"0\"></a>\n"
	."</td>\n"
	."<td>\n"
	."<a href=\"modules.php?name=TVStream&file=tele&fn=Raigulp\"><img src=\"images/RaiGulp.png\" alt=\"Rai Gulp\" border=\"0\"></a>\n"
	."</td>\n"
	."<td>\n"
	."<a href=\"modules.php?name=TVStream&file=tele&fn=Raimovie\"><img src=\"images/RaiMovie.jpg\" alt=\"Rai Movie\" border=\"0\"></a>\n"
	."</td>\n"
	."<td>\n"
	."<a href=\"modules.php?name=TVStream&file=tele&fn=Raiyoyo\"><img src=\"images/RaiYoyo.png\" alt=\"Rai YoYo\" border=\"0\"></a>\n"
	."</td>\n"
	."</tr>\n"
	."<tr>\n"
	."<td>\n"
	."<a href=\"modules.php?name=TVStream&file=tele&fn=Rainews\"><img src=\"images/RaiNews.png\" alt=\"Rai News\" border=\"0\"></a>\n"
	."</td>\n"
	."<td>\n"
	."<a href=\"modules.php?name=TVStream&file=tele&fn=Raipremium\"><img src=\"images/RaiPremium.png\" alt=\"Rai Premium\" border=\"0\"></a>\n"
	."</td>\n"
	."<td>\n"
	."<a href=\"modules.php?name=TVStream&file=tele&fn=Raiscuola\"><img src=\"images/RaiScuola.png\" alt=\"Rai Scuola\" border=\"0\"></a>\n"
	."</td>\n"
	."<td>\n"
	."<a href=\"modules.php?name=TVStream&file=tele&fn=Raistoria\"><img src=\"images/RaiStoria.png\" alt=\"Rai Storia\" border=\"0\"></a>\n"
	."</td>\n"
	."</tr>\n"
	."<tr>\n"
	."<td></td>\n"
	."<td><a href=\"modules.php?name=TVStream&file=tele&fn=Raisport1\"><img src=\"images/RaiSport1.png\" alt=\"Rai Sport 1\" border=\"0\"></a></td>\n"
	."<td><a href=\"modules.php?name=TVStream&file=tele&fn=Raisport2\"><img src=\"images/RaiSport2.jpg\" alt=\"Rai Sport 2\" border=\"0\"></a></td>\n"
	."<td></td>\n"
    ."</tr>\n"
	."<tr>\n"
	."<td colspan=\"4\"><div align=\"center\"><strong>Reti Mediaset</strong></div></td>\n"
    ."</tr>\n"
	."<tr>\n"
	."<td><a href=\"modules.php?name=TVStream&file=tele&fn=Rete4\"><img src=\"images/rete4.jpg\" border=\"0\"></a></td>\n"
	."<td><a href=\"modules.php?name=TVStream&file=tele&fn=Canale5\"><img src=\"images/canale5.jpg\" border=\"0\"></a></td>\n"
	."<td><a href=\"modules.php?name=TVStream&file=tele&fn=Italia1\"><img src=\"images/Italia_1.gif\" border=\"0\"></a></td>\n"
	."<td><a href=\"modules.php?name=TVStream&file=tele&fn=Italia2\"><img src=\"images/Italia_2.png\" border=\"0\"></a></td>\n"
    ."</tr>\n"
	."<tr>\n"
	."<td colspan=\"4\"><div align=\"center\"><a href=\"modules.php?name=TVStream&file=tele&fn=Mediasetextra\"><img src=\"images/mediasetextra.gif\" border=\"0\"></a></div></td>\n"
    ."</tr>\n"
	."<tr>\n"
	."<td colspan=\"4\"><div align=\"center\"><strong>Reti Varie</strong></div></td>\n"
    ."</tr>\n"
	."<tr>\n"
	."<td><a href=\"modules.php?name=TVStream&file=tele&fn=La7\"><img src=\"images/logo_La7_1.jpg\" border=\"0\"></a>\n"
	."</td>\n"
	."<td><a href=\"modules.php?name=TVStream&file=tele&fn=Dmax\"><img src=\"images/dmax.jpg\" border=\"0\"></a>\n"
	."</td>\n"
	."<td><a href=\"modules.php?name=TVStream&file=tele&fn=Focus\"><img src=\"images/focus.jpg\" border=\"0\"></a>\n"
	."</td>\n"
	."<td><a href=\"modules.php?name=TVStream&file=tele&fn=Realtime\"><img src=\"images/realtime.png\" border=\"0\"></a>\n"
	."</td>\n"
	."</tr>\n"
  	."</table>\n"
	."</div>\n";
	
CloseTable();
include("footer.php");

?>


