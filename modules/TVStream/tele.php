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
if(isset($fn)){
	echo "<center><strong>Avete scelto $fn in Streaming.</strong></center>\n<br><br><center>Se non dovesse funzionare Vi preghiamo di segnalarlo nel forum o sui nostri commenti</center><br><br><br>";
	switch($fn){
		case "Rai1":
			echo "<div align=\"center\"><!-- <iframe src=\"https://www.filmon.com/tv/modules/FilmOnTV/files/flashapp/filmon/FacebookPlayer.swf?channel_id=375\" width=\"800\" height=\"560\" scrolling=\"no\" frameborder=\"0\"></iframe> --> <object width=\"800\" height=\"560\" data=\"data:application/x-silverlight,\" type=\"application/x-silverlight-2\"><param name=\"source\" value=\"http://www.tvindiretta.com/canali/MinoPlayer.xap\" /><param name=\"onerror\" value=\"onSilverlightError\" /><param name=\"background\" value=\"black\" /><param name=\"initParams\" value=\"VideoSource=mms://212.162.68.163/prodtvr1,AutoPlay=true,EnableScrubbing=true,InitialVolume=1,PreviewImage=http://tvindiretta.com/wp-content/uploads/2012/04/bumper-raiuno1.jpg\" /><param name=\"minRuntimeVersion\" value=\"2.0.31005.0\" /><param name=\"autoUpgrade\" value=\"false\" /><param name=\"src\" value=\"data:application/x-silverlight,\" /></object></div>";
			break;
		case "Rai2":
			echo "<div><!-- <iframe src=\"https://www.filmon.com/tv/modules/FilmOnTV/files/flashapp/filmon/FacebookPlayer.swf?channel_id=376\" width=\"800\" height=\"560\" scrolling=\"no\" frameborder=\"0\"></iframe> --> <object width=\"800\" height=\"560\" data=\"data:application/x-silverlight,\" type=\"application/x-silverlight-2\"><param name=\"source\" value=\"http://www.tvindiretta.com/canali/MinoPlayer.xap\" /><param name=\"onerror\" value=\"onSilverlightError\" /><param name=\"background\" value=\"black\" /><param name=\"initParams\" value=\"VideoSource=mms://212.162.68.163/prodtvr2,AutoPlay=true,EnableScrubbing=true,InitialVolume=1,PreviewImage=http://www.tvindiretta.com/wp-content/uploads/2012/04/105551102_640.jpg\" /><param name=\"minRuntimeVersion\" value=\"2.0.31005.0\" /><param name=\"autoUpgrade\" value=\"false\" /><param name=\"src\" value=\"data:application/x-silver					light,\" /></object></div>";
			break;
		case "Rai3":
			echo "<div><!-- <iframe src=\"https://www.filmon.com/tv/modules/FilmOnTV/files/flashapp/filmon/FacebookPlayer.swf?channel_id=377\" width=\"800\" height=\"560\" scrolling=\"no\" frameborder=\"0\"></iframe> --> <object width=\"800\" height=\"560\" data=\"data:application/x-silverlight,\" type=\"application/x-silverlight-2\"><param name=\"source\" value=\"http://www.tvindiretta.com/canali/MinoPlayer.xap\" /><param name=\"onerror\" value=\"onSilverlightError\" /><param name=\"background\" value=\"black\" /><param name=\"initParams\" value=\"VideoSource=mms://212.162.68.163/prodtvr3,AutoPlay=true,EnableScrubbing=true,InitialVolume=1,PreviewImage=http://www.tvindiretta.com/wp-content/uploads/2012/04/105560099_640.jpg\" /><param name=\"minRuntimeVersion\" value=\"2.0.31005.0\" /><param name=\"autoUpgrade\" value=\"false\" /><param name=\"src\" value=\"data:application/x-silverlight,\" /></object></div>";
			break;
		case "Rai4":
			echo "<iframe width=\"800\" height=\"600\" src=\"http://www.rai.tv/dl/RaiTV/dirette/PublishingBlock-ea74b386-9a37-4293-a06b-c003359c6ede.html?channel=Rai%20Uno&amp;amp;iframe\"></iframe>";
			break;
		case "Rai5":
			echo "<iframe width=\"800\" height=\"600\" src=\"http://www.rai.tv/dl/RaiTV/dirette/PublishingBlock-5d691044-de91-4942-8c9c-4b9bda4b8b79.html?channel=Rai%20Uno&amp;amp;iframe\"></iframe>";
			break;
		case "Raigulp":
			echo "<iframe width=\"800\" height=\"600\" src=\"http://www.rai.tv/dl/RaiTV/dirette/PublishingBlock-4a26f83b-8a8e-4a0f-a213-6d936ef1f48d.html?channel=Rai Gulp&amp;amp;iframe\"></iframe>";
			break;
		case "Raimovie":
			echo "<iframe width=\"800\" height=\"600\" style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"http://www.rai.tv/dl/RaiTV/dirette/PublishingBlock-1dc5af18-ecc2-497f-be49-8e2989cbcc2a.html?channel=Rai Movie&amp;amp;iframe\"></iframe>";
			break;
		case "Raiyoyo":
			echo "<iframe width=\"800\" height=\"600\" src=\"http://www.rai.tv/dl/RaiTV/dirette/PublishingBlock-c38d501a-75af-4285-9b5a-54c801d95cbc.html?channel=Ra YoYo&amp;amp;iframe&quot;\"></iframe>";
			break;
		case "Rainews":
			echo "<iframe width=\"800\" height=\"600\" src=\"http://www.rai.tv/dl/RaiTV/dirette/PublishingBlock-233b8482-1cbc-4970-87d5-9d7604b26ddb.html?channel=RaiNews&amp;amp;iframe\"></iframe>";
			break;
		case "Raipremium":
			echo "<iframe width=\"800\" height=\"600\" style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"http://www.rai.tv/dl/RaiTV/dirette/PublishingBlock-2f9bc3f5-b629-44c0-aeb2-d3af4eb1e446.html?channel=Rai Premium&amp;amp;iframe\"></iframe>";
			break;
		case "Raiscuola":
			echo "<iframe width=\"800\" height=\"600\" src=\"http://www.rai.tv/dl/RaiTV/dirette/PublishingBlock-aaca392a-da8b-4fc8-8a74-add9363188e4.html?channel=Rai%20Uno&amp;amp;iframe\"></iframe>";
			break;
		case "Raistoria":
			echo "<iframe width=\"800\" height=\"600\" src=\"http://www.rai.tv/dl/RaiTV/dirette/PublishingBlock-f630463f-a1b1-4ca6-925a-6d9e8801d88c.html?channel=Rai Storia&amp;amp;iframe\"></iframe>";
			break;
		case "Raisport1":
			echo "<iframe width=\"800\" height=\"600\" src=\"http://www.rai.tv/dl/RaiTV/dirette/PublishingBlock-7131f72e-5ca4-45f7-bd50-ebf161d164fc.html?channel=RaiSport 1&amp;amp;iframe\"></iframe>";
			break;
		case "Raisport2":
			echo "<iframe width=\"800\" height=\"600\" src=\"http://www.rai.tv/dl/RaiTV/dirette/PublishingBlock-c7daf6b9-aeb4-48ed-8e0a-3d8afe7c5f8f.html?channel=Rai%20Uno&amp;amp;iframe\"></iframe>";
			break;
		case "Rete4":
			echo "<iframe src=\"http://canaliforyou.altervista.org/RETE_QUATTRO.php\" scrolling=\"no\" frameborder=\"0\" width=\"500\" height=\"450\"></iframe>";
			break;
		case "Canale5":
			echo "<iframe src=\"http://tinyurl.com/canale-five\" scrolling=\"no\" frameborder=\"0\" width=\"500\" height=\"450\"> </iframe>";
			break;
		case "Italia1":
			echo "<center><a href=\"http://www.shadow-net.info/channels/iptv/italia1.php\">Clicca qui per vedere italia uno, richiede lettore VLC</a><center><br><br>";
			break;
		case "Italia2":
			echo "<iframe src=\"http://tinyurl.com/ItaliaTwo\" scrolling=\"no\" frameborder=\"0\" width=\"500\" height=\"450\"> </iframe>";
			break;
		case "Mediasetextra":
			echo "<iframe src=\"http://canaliforyou.altervista.org/Med_Extra.php\" scrolling=\"no\" frameborder=\"0\" width=\"500\" height=\"450\"> </iframe>";
			break;
		case "Dmax":
			echo "<iframe src=\"http://canaliforyou.altervista.org/D_MAX.php\" scrolling=\"no\" frameborder=\"0\" width=\"500\" height=\"450\"> </iframe>";
			break;
		case "Focus":
			echo "<iframe frameborder=0 marginheight=0 marginwidth=0 scrolling='no'src=\"http://emb.aliez.tv/player/live.php?id=7494&w=590&h=376\" width=\"590\" height=\"376\"></iframe>";
			break;
		case "Realtime":
			echo "<iframe src=\"http://tinyurl.com/RialTaim\" scrolling=\"no\" width=\"500\" height=\"400\"></iframe>";
			break;	
		case "La7":
			echo "<iframe src=\"http://tinyurl.com/LaSeven\" scrolling=\"no\" frameborder=\"0\" width=\"500\" height=\"450\"> </iframe>";
			break;
		default:
			echo "<center>Spiacenti, un errore imprevisto (picchiate spitfire) ha impedito l'apertura della pagina, Vi preghiamo di segnalarcelo nei commenti o nel Forum, Grazie a tutti!</center><br><br>";
			break;
	}
}else echo "<center>Spiacenti, un errore imprevisto (picchiate spitfire) ha impedito l'apertura della pagina, Vi preghiamo di segnalarcelo nei commenti o nel Forum, Grazie a tutti!</center><br><br>";
	
CloseTable();
include("footer.php");
?>


