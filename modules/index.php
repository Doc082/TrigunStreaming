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
  	."<font color=\"#FF0000\" size=\"6\"><strong>Scambio Banner</strong></font></h1>\n"
  	."</font>\n"
  	."<p><strong>Avete un sito web o un blog? Se siete interessati allo scambio banner contattateci all'indirizzo</strong>: <a href=\"mailto:trigunstreaming@altervista.org\">trigunstreaming@altervista.org</a></p>\n"
  	."<p><font color=\"#000000\">Questi sono i nostri banner, se vi &egrave; piaciuto il sito inseriteli :-)</font></p>\n"
  	."<p>&nbsp;</p>\n"
  	."<p><font color=\"#000000\"><strong>Banner grande</strong></font></p>\n"
  	."<p>\n"
    ."<a href=\"http://www.trigunstreaming.it\"><img src=\"http://www.trigunstreaming.it/images/banners/banner.jpg\" border=\"1\"></a>\n"   
  	."<p><font color=\"#0000FF\"><strong>HTML:</strong></font> &lt;a href=&quot;http://www.trigunstreaming.it&quot;&gt;&lt;img src=&quot;http://www.trigunstreaming.it/images/banners/banner.jpg&quot; border=&quot;1&quot;&gt;&lt;/a&gt;\n"
  	."<p>\n"  
  	."<p>\n"   
  	."<p><strong>Banner piccolo</strong></p>\n"
  	."<p>\n"
    ."<a href=\"http://www.trigunstreaming.it\"><img src=\"http://www.trigunstreaming.it/images/banners/bannerpiccolo.jpg\" border=\"1\"></a> \n"
  	."<p><strong><font color=\"#0000FF\">HTML:</font></strong> &lt;a href=&quot;http://www.trigunstreaming.it&quot;&gt;&lt;img src=&quot;http://www.trigunstreaming.it/images/banners/bannerpiccolo.jpg&quot; border=&quot;1&quot;&gt;&lt;/a&gt;\n"   
  	."<p>&nbsp;</p>\n"
	."</div>"
	."<div align=\"center\"><strong>Banner mini</strong></div>\n"
	."<div align=\"center\">"
  	."<p>\n"
  	."<a href=\"http://www.trigunstreaming.it\"><img src=\"http://www.trigunstreaming.it/images/banners/bannermini.jpg\" border=\"1\"></a>\n"   
  	."<p> <font color=\"#0000FF\"><strong>HTML</strong>:</font>&lt;a href=&quot;http://www.trigunstreaming.it&quot;&gt;&lt;img src=&quot;http://www.trigunstreaming.it/images/banners/bannermini.jpg&quot; border=&quot;1&quot;&gt;&lt;/a&gt;  \n"
  	."<p>\n"  
  	."</div>\n";
	
CloseTable();
include("footer.php");

?>


