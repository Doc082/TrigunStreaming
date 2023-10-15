<?php 
//PHPNUKE MODULO CREATO DA Doc82
if (!defined('MODULE_FILE')) {
	die ("You can't access this file directly...");
}

require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

$pagetitle = "- $module_name";

include("header.php");
OpenTable();
if(isset($ogg)){	
	mail( "trigunstreaming@altervista.org", $ogg, "From: $mail Testo: $corpo");
	echo "<div align=\"center\">";
	echo "<p><strong>Messaggio inviato con successo</strong></p>";
	echo "<p>&nbsp;</p>";
	echo "<p>Se avete lasciato la vostra email, riceverete presto una risposta, A presto!";
	echo "</div>";
} else echo "<center><strong>Errore: Messaggio non inviato</strong></center> ";	
CloseTable();
include("footer.php");
?>


