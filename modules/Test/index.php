<?php 
global $prefix, $db, $nukeurl;
if (!defined('MODULE_FILE')) {
	die ("You can't access this file directly...");
}

require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

$pagetitle = "- $module_name";
if(!isset($oggetto)) $oggetto="Varie";
include("header.php");

$Loca1=774;
$Loca2=751;
$Loca3=759;
$Loca4=766;
$Loca5=696;
$Loca6=645;
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


OpenTable();
echo "<div align=\"center\">\n"
   	."<td width=\"100%\" bgcolor=\"#FFFFFF\"><font class=\"option\"><b><span itemprop=\"name\">&nbsp;Le Ultime Uscite</span></b></font></td></tr>\n"
	."<tr><td colspan=\"2\" bgcolor=\"#FFFFFF\"><br>\n"
	."<table border=\"0\" width=\"98%\" align=\"center\"><tr><td>\n"
	."<p><center><a href=\"modules.php?name=News&amp;file=article&amp;sid=$indice1\"> <img src=\"$foto1\" alt=\"$titolo1\" height=\"150\" /><br>$titolo1</a></center></p>\n"
	."</td>\n"
	."<td>"
	."<p><center><a href=\"modules.php?name=News&amp;file=article&amp;sid=$indice2\"> <img src=\"$foto2\" alt=\"$titolo2\" height=\"150\" /><br>$titolo2</a></center></p>\n"
	."</td>\n"
	."<td>"
	."<p><center><a href=\"modules.php?name=News&amp;file=article&amp;sid=$indice3\"> <img src=\"$foto3\" alt=\"$titolo3\" height=\"150\" /><br>$titolo3</a></center></p>\n"
	."</td>\n"
	."</tr>\n"
	."<tr>\n"
	."<td>\n"
	."<p><center><a href=\"modules.php?name=News&amp;file=article&amp;sid=$indice4\"> <img src=\"$foto4\" alt=\"$titolo4\" height=\"150\" /><br>$titolo4</a></center></p>\n"
	."</td>\n"
	."<td>"
	."<p><center><a href=\"modules.php?name=News&amp;file=article&amp;sid=$indice5\"> <img src=\"$foto5\" alt=\"$titolo5\" height=\"150\" /><br>$titolo5</a></center></p>\n"
	."</td>\n"
	."<td>"
	."<p><center><a href=\"modules.php?name=News&amp;file=article&amp;sid=$indice6\"> <img src=\"$foto6\" alt=\"$titolo6\" height=\"150\" /><br>$titolo6</a></center></p>\n"
	."</td>\n"
	."</tr>\n"
	."</table>\n"
  	."</div>\n";
	
CloseTable();
include("footer.php");

?>


