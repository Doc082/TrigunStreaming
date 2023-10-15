<?php

$id = 0;
$deny = false;

require_once 'config.php';
require_once 'db/db.php';


if (!ini_get('register_globals')) {
    @import_request_variables('C', '');
}

if(isset($user) && $user != $_COOKIE['user']) {
    die('Illegal Operation');
}
require_once("modules/Live_Chat/lib/class.chat.php");
set_error_handler('error_handler', E_ALL^E_NOTICE);
$chat = new Chat();

$_POST['mode'] = empty($_POST['mode']) ? '' : $_POST['mode'];


if ($_POST['mode'] == 'postMessage')
{
  if (is_user($user))
  {
    $uinfo = cookiedecode($user);
    $id = intval($_POST['id']);
    if ( !empty($uinfo[1]) && !empty($_POST['message']) )
    {
      $chat->postMessage($uinfo[1], $_POST['message'], $_POST['color'], $_POST['size'], $_POST['b'], $_POST['i'], $_POST['u']);
    }
  }
  else
  {
    $deny = true;
  }
}
elseif($_POST['mode'] == 'getNew')
{
  $uinfo = cookiedecode($user);
  $id = intval($_POST['id']);
  $chat->checkOnline($uinfo[1]);
  
}
elseif (!empty($_POST['logout']))
{
  if (is_user($user))
  {
    $uinfo = cookiedecode($user);
    $chat->takeOffline($uinfo[1]);
  }
  exit;
}


$chat->showMessages($id, $deny);
exit;


?>
