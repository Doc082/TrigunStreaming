<?php

$show_status = 0;

if ( !defined('BLOCK_FILE') ) {
  Header('Location: ../index.php');
  die();
}

global $prefix, $db, $user, $bgcolor2;
require_once("modules/Live_Chat/lib/class.chat.php");
$chat = new Chat();

$content = $chat->showChat($show_status);
$content .= '<div align="right"><a href="http://nukecoder.com" target="blank">Live Chat &copy;</a></div>';


?>
