<?php 
if (!defined('MODULE_FILE')) {
	die ("You can't access this file directly...");
}

require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

$pagetitle = "- $module_name";
if(!isset($oggetto)) $oggetto="Varie";


include("header.php");
OpenTable();
echo "<div align=\"center\">\n"
   	."<p>\n"
  	."<font face=\"Times New Roman, Times, serif\">\n"
  	."<h1>\n"
  	."<font color=\"#FF0000\" size=\"6\"><strong>Contattaci</strong></font>\n"
  	."</h1>\n"
  	."</font>"  
  	."<p>Per qualsiasi cosa, dalle segnalazioni ai consigli, scriveteci a: <a href=\"mailto:trigunstreaming@altervista.org\">trigunstreaming@altervista.org</a><br>Oppure compilate il form<strong></strong></p>\n"
  	."<p><strong><font color=\"#0000FF\">Oggetto del messaggio: $oggetto</font></strong></p>\n"
  	."<form name=\"form1\" method=\"POST\" action=\"modules.php?name=Contattaci&file=send\">"
  	."<p>Se volete una risposta inserite la vostra email: <input name=\"ogg\" type=\"hidden\" value=\"$oggetto\"></p>\n"
  	."<p>\n"
	."<input type=\"text\" name=\"mail\">\n"
	."</p>\n"
  	."<p>&nbsp;  </p>\n"
  	."<p>Inserite qui il vostro messaggio</p>\n"
  	."<p>\n"
    ."<textarea name=\"corpo\" cols=\"100\" rows=\"10\"></textarea>\n"
	."</p>\n"
  	."<p>\n"
    ."<input type=\"submit\" name=\"Submit\" value=\"Invia\">&nbsp;&nbsp;\n" 
    ."<input type=\"reset\" name=\"Reset\" value=\"Cancella\">\n"
  	."</p>\n"
  	."</form>\n"
  	."<p>&nbsp;</p>\n"
  	."<p>&nbsp;</p>\n"
	."</div>\n";
	
CloseTable();
include("footer.php");

?>


