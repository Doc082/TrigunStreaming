<?php

if ( !defined('ADMIN_FILE') )
{
  die ("Access Denied");
}
$module_name = "Live_Chat";

switch($op) {
  case "liveChat":
    include_once("modules/$module_name/admin/index.php");
  break;
}

?>
