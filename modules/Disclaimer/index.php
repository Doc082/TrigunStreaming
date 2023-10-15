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
  	."<font color=\"#FF0000\" size=\"6\"><strong>Disclaimer</strong></font>\n"
  	."</h1>\n"
  	."</font>"  
  	."<p>Trigun Streaming</p>\n"
	."<p>La Nuova community di film in streaming e di Cinema in generale, dove tutti gli appassionati possono discutere, vedere il proprio film preferito, o chattare, senza essere aggrediti dai banner pubblicitari.\n</p>"
	."<p>&nbsp;</p>\n"
	."<p>Per non incorrere a sanzioni, Trigun Streaming si impegna quindi ad eliminare, su segnalazione delle autorità competenti, tramite il form “Contattaci”, ogni eventuale link che violi il diritto d’autore. Questo/questi verranno immediatamente cancellati.\n</p>"
	."<p>&nbsp;</p>\n"
 	."<p>&nbsp;</p>\n"
	."<p><strong>DISCLAIMER</strong></p>"
	."<p>&nbsp;</p>\n"
	."<p>Trigun Streaming è un motore di ricerca link, dedicato ai film, anime e serie tv in genere<br>\n"
	."Nessun video, immagine od altro materiale, è presente sul server di Trigun Streaming.\n"
	."Nessun video è stato caricato su internet dai webmaster di Trigun Streaming, tutto il materiale presente su Trigun Streaming fa riferimento a link esterni, facilmente rintracciabili da motori di ricerca come GOOGLE. <br>"
	."Il nostro sito NON CONTIENE materiale coperto da copyright. <br>\n"
	."Trigun Streaming si limita esclusivamente a selezionare i migliori link presenti sul web.\n"
  	."</div>\n";
	
CloseTable();
include("footer.php");

?>


