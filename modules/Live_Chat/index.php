<?php

// set to 0 to hide the status
$show_status = 1;

if ( !defined('MODULE_FILE') )
{
    die("You can't access this file directly...");
}

require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));


$pop = !empty($_GET['pop']) ? 1 : 0;

if ($pop == 1)
{
  $ThemeSel = get_theme();
  echo '
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  <title>Live Chat</title>
  <link rel="StyleSheet" href="themes/'.$ThemeSel.'/style/style.css" type="text/css" />
  </head>
  <body>
  ';
}
else
{
  include 'header.php';
  OpenTable();
}
require_once("modules/Live_Chat/lib/class.chat.php");
$chat = new Chat();

echo $chat->showChat($show_status);



if ($pop == 1)
{
  echo '</body></html>';
}
else
{
  CloseTable();
  include 'footer.php';
}
?>
