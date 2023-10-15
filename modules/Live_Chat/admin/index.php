<?php


if ( !defined('ADMIN_FILE') )
{
  die ("Access Denied");
}
global $prefix, $db, $admin_file;
$aid = substr("$aid", 0,25);
$row = $db->sql_fetchrow($db->sql_query("SELECT title, admins FROM ".$prefix."_modules WHERE title='Live_Chat'"));
$row2 = $db->sql_fetchrow($db->sql_query("SELECT name, radminsuper FROM ".$prefix."_authors WHERE aid='$aid'"));
$admins = explode(",", $row['admins']);
$auth_user = 0;
for ($i=0; $i < sizeof($admins); $i++) {
    if ($row2['name'] == "$admins[$i]" AND !empty($row['admins'])) {
        $auth_user = 1;
    }
}

if ($row2['radminsuper'] == 1 || $auth_user == 1) {
  

// start the good stuff

$do = !empty($_GET['do']) ? $_GET['do'] : '';

include 'header.php';

OpenTable();
echo '<div align="right"><a href="'.$admin_file.'.php">Back to Nuke Administration</a></div>';

echo '
<table align="center" style="border: 1px solid '.$bgcolor2.'">
  <tr>
    <td align="center" style="padding: 0px 8px 0px 8px;"><a href="'.$admin_file.'.php?op=liveChat"><img src="modules/'.$module_name.'/images/admin/live_chat.gif" alt="" /><br />Live Chat Admin</a></td>
    ';
    if (!empty($_GET['user']))
    {
      echo '
      <td align="center" style="padding: 0px 8px 0px 8px; border-left: 1px solid '.$bgcolor2.';">
      <a href="'.$admin_file.'.php?op=liveChat&amp;do=del_user_msgs&amp;username='.stripslashes($_GET['user']).'"><img src="modules/'.$module_name.'/images/admin/user_delete.png" alt="" /><br />Delete <strong>'.stripslashes($_GET['user']).'</strong>&#039;s messages</a>
      </td>';
    }
    echo'
    <td align="center" style="padding: 0px 8px 0px 8px; border-left: 1px solid '.$bgcolor2.';">
      <a href="'.$admin_file.'.php?op=liveChat&amp;do=time_range"><img src="modules/'.$module_name.'/images/admin/time_range.png" alt="" /><br />Delete Time Range</a>
    </td>
    <td align="center" style="padding: 0px 8px 0px 8px; border-left: 1px solid '.$bgcolor2.';">
      <a href="'.$admin_file.'.php?op=liveChat&amp;do=clear_chat"><img src="modules/'.$module_name.'/images/admin/clear_chat.png" alt="" /><br />Empty Chat Table</a>
    </td>
  </tr>
</table>
';


echo "<br />";

// build chat history list
$link_append = "";
$ord = '';
$dir = '';
// get item order
$_GET['order'] = !empty($_GET['order']) ? $_GET['order'] : '';

switch($_GET['order'])
{
  case 'name':
    $ord = ' ORDER BY username';
  break;

  case 'time':
    $ord = ' ORDER BY timestamp';
  break;

}

$_GET['dir'] = !empty($_GET['dir']) ? $_GET['dir'] : 'A';
if (!empty($ord))
{
  $dir = ($_GET['dir'] == 'A') ? ' ASC' : ' DESC';
  $link_append .= '&amp;order='. $_GET['order'] .'&amp;dir='. $_GET['dir'];
}
if (!empty($_GET['user']))
{
  
  $username = mysql_real_escape_string(check_html(stripslashes($_GET['user']), 'nohtml'));
  $link_append .= "&amp;user=".$username;
  $user_cond = ' WHERE username=\''.$username.'\'';
  echo '<div align="center" class="title">Viewing Messages From: <strong>'.stripslashes($_GET['user']).'</strong></div>';
}
else
{
  $username = '';
  $user_cond = '';
}


$page = (!empty($_GET['page']) ) ? intval($_GET['page']) : 1;
$show = (!empty($_GET['show']) ) ? intval($_GET['show']) : 20;
$start = ($page * $show) - $show;


$limit = ' LIMIT '.$start.','.$show;
// append order to link
$link_limit = '&amp;page='. $page .'&amp;show='. $show;

if (!empty($_GET['user']))
{
  
  $username = mysql_real_escape_string(check_html(stripslashes($_GET['user']), 'nohtml'));
  $link_append .= "&amp;user=".$username;
  $user_cond = ' WHERE username=\''.$username.'\'';
}
else
{
  $user_id = false;
  $username = '';
  $user_cond = '';
}


switch ($do) {
  
  // handle emptying the chat table
  case 'clear_chat':
    if (!empty($_GET['cfm']) && $_GET['cfm'] == 1)
    {
      // truncate table
      $sql = 'TRUNCATE TABLE `'.$prefix.'_live_chat`';
      if (!($result = $db->sql_query($sql)))
      {
        echo '
        <table align="center" style="border: 1px solid '.$bgcolor2.'; font-size: 14px;">
        <tr>
          <td align="center" valign="top" style="padding: 0px 8px 0px 8px;"><img src="modules/'.$module_name.'/images/admin/error.png" alt="" /></td>
          <td align="center" valign="top" style="padding: 0px 8px 0px 8px; border-left: 1px solid '.$bgcolor2.';">
            Error, could not empty chat table!
          </td>
        </tr>
        </table><br />';
      }
      else
      {
        echo '
        <table align="center" style="border: 1px solid '.$bgcolor2.'; font-size: 14px;">
        <tr>
          <td align="center" valign="top" style="padding: 0px 8px 0px 8px;"><img src="modules/'.$module_name.'/images/admin/info.png" alt="" /></td>
          <td align="center" valign="top" style="padding: 0px 8px 0px 8px; border-left: 1px solid '.$bgcolor2.';">
            The Chat Table has been emptied
          </td>
        </tr>
        </table><br />';
      }
    }
    else
    {
      echo '
      <table align="center" style="border: 1px solid '.$bgcolor2.'; font-size: 14px;">
      <tr>
        <td align="center" valign="top" style="padding: 0px 8px 0px 8px;"><img src="modules/'.$module_name.'/images/admin/warning.png" alt="" /></td>
        <td align="center" valign="top" style="padding: 0px 8px 0px 8px; border-left: 1px solid '.$bgcolor2.';">
        Are you sure you want to <strong>empty the chat table</strong>?<br />
        This cannot be reversed and all current messages will be lost!<br /><br />
        <a href="'.$admin_file.'.php?op=liveChat&amp;do=clear_chat&amp;cfm=1">YES, empty it!</a> | <a href="'.$admin_file.'.php?op=liveChat'.$link_append.$link_limit.'">Cancel</a>
        </td>
      </tr>
      </table><br />';
    }
  break;
  
  
  // handle deleting single messages
  case 'del_msg':
    if (!empty($_GET['cfm']) && $_GET['cfm'] == 1 && !empty($_GET['id']))
    {
      // delete message
      $id = intval($_GET['id']);
      if ($id == 0) { die('INVALID ID'); }
      $sql = 'DELETE FROM `'.$prefix.'_live_chat` WHERE id=\''.$id.'\'';
      if (!($result = $db->sql_query($sql)))
      {
        echo '
        <table align="center" style="border: 1px solid '.$bgcolor2.'; font-size: 14px;">
        <tr>
          <td align="center" valign="top" style="padding: 0px 8px 0px 8px;"><img src="modules/'.$module_name.'/images/admin/error.png" alt="" /></td>
          <td align="center" valign="top" style="padding: 0px 8px 0px 8px; border-left: 1px solid '.$bgcolor2.';">
            Error, could not delete the message!
          </td>
        </tr>
        </table><br />';
      }
      else
      {
        echo '
        <table align="center" style="border: 1px solid '.$bgcolor2.'; font-size: 14px;">
        <tr>
          <td align="center" valign="top" style="padding: 0px 8px 0px 8px;"><img src="modules/'.$module_name.'/images/admin/info.png" alt="" /></td>
          <td align="center" valign="top" style="padding: 0px 8px 0px 8px; border-left: 1px solid '.$bgcolor2.';">
            Message Deleted
          </td>
        </tr>
        </table><br />';
      }
    }
    else
    {
      echo '
      <table align="center" style="border: 1px solid '.$bgcolor2.'; font-size: 14px;">
      <tr>
        <td align="center" valign="top" style="padding: 0px 8px 0px 8px;"><img src="modules/'.$module_name.'/images/admin/warning.png" alt="" /></td>
        <td align="center" valign="top" style="padding: 0px 8px 0px 8px; border-left: 1px solid '.$bgcolor2.';">
        Are you sure you want to <strong>delete this message(id: '.$id.')?</strong>?<br />
        <br />
        <a href="'.$admin_file.'.php?op=liveChat'.$link_append.$link_limit.'&amp;do=del_msg&amp;id='.$id.'&amp;cfm=1">YES, delete it!</a> | <a href="'.$admin_file.'.php?op=liveChat'.$link_append.$link_limit.'">Cancel</a>
        </td>
      </tr>
      </table><br />';
    }
  break;
  
  
  // handle deleting user messages
  case 'del_user_msgs':
    if (!empty($_GET['cfm']) && $_GET['cfm'] == 1 && !empty($_GET['username']))
    {
      // delete message
      $username = mysql_real_escape_string(stripslashes($_GET['username']));
      $sql = 'DELETE FROM `'.$prefix.'_live_chat` WHERE username=\''.$username.'\'';
      if (!($result = $db->sql_query($sql)))
      {
        echo '
        <table align="center" style="border: 1px solid '.$bgcolor2.'; font-size: 14px;">
        <tr>
          <td align="center" valign="top" style="padding: 0px 8px 0px 8px;"><img src="modules/'.$module_name.'/images/admin/error.png" alt="" /></td>
          <td align="center" valign="top" style="padding: 0px 8px 0px 8px; border-left: 1px solid '.$bgcolor2.';">
            Error, could not delete messages from: '.stripslashes($username).'!
          </td>
        </tr>
        </table><br />';
      }
      else
      {
        echo '
        <table align="center" style="border: 1px solid '.$bgcolor2.'; font-size: 14px;">
        <tr>
          <td align="center" valign="top" style="padding: 0px 8px 0px 8px;"><img src="modules/'.$module_name.'/images/admin/info.png" alt="" /></td>
          <td align="center" valign="top" style="padding: 0px 8px 0px 8px; border-left: 1px solid '.$bgcolor2.';">
            '.stripslashes($username).'&#039;s Messages Deleted!
          </td>
        </tr>
        </table><br />';
      }
    }
    else
    {
      $username = stripslashes($_GET['username']);
      echo '
      <table align="center" style="border: 1px solid '.$bgcolor2.'; font-size: 14px;">
      <tr>
        <td align="center" valign="top" style="padding: 0px 8px 0px 8px;"><img src="modules/'.$module_name.'/images/admin/warning.png" alt="" /></td>
        <td align="center" valign="top" style="padding: 0px 8px 0px 8px; border-left: 1px solid '.$bgcolor2.';">
        Are you sure you want to <strong>delete all of '.$username.'&#039;s messages</strong>?<br />
        <br />
        <a href="'.$admin_file.'.php?op=liveChat'.$link_append.$link_limit.'&amp;do=del_user_msgs&amp;username='.$username.'&amp;cfm=1">YES, delete it!</a> | <a href="'.$admin_file.'.php?op=liveChat'.$link_append.$link_limit.'">Cancel</a>
        </td>
      </tr>
      </table><br />';
    }
  break;
  
  
  // handle deleting messages older than X
  case 'time_range':
    if (!empty($_POST['time_value']) && !empty($_POST['time_type']))
    {
      switch($_POST['time_type'])
      {
        case 'h':
          $target = time() - (intval($_POST['time_value']) * 3600);
          $out = $_POST['time_value'].' hours';
        break;
        
        case 'm':
          $target = time() - (intval($_POST['time_value']) * 60);
          $out = $_POST['time_value'].' minutes';
        break;
        
        case 'd':
          $target = time() - (intval($_POST['time_value']) * 86400);
          $out = $_POST['time_value'].' days';
        break;
        
        case 'w':
          $target = time() - (intval($_POST['time_value']) * 604800);
          $out = $_POST['time_value'].' weeks';
        break;
      }
      
      
      $sql = 'DELETE FROM `'.$prefix.'_live_chat` WHERE timestamp<\''.$target.'\'';
      if (!($result = $db->sql_query($sql)))
      {
        echo '
        <table align="center" style="border: 1px solid '.$bgcolor2.'; font-size: 14px;">
        <tr>
          <td align="center" valign="top" style="padding: 0px 8px 0px 8px;"><img src="modules/'.$module_name.'/images/admin/error.png" alt="" /></td>
          <td align="center" valign="top" style="padding: 0px 8px 0px 8px; border-left: 1px solid '.$bgcolor2.';">
            Error, could not delete messages older than '.$out.'!
          </td>
        </tr>
        </table><br />';
      }
      else
      {
        echo '
        <table align="center" style="border: 1px solid '.$bgcolor2.'; font-size: 14px;">
        <tr>
          <td align="center" valign="top" style="padding: 0px 8px 0px 8px;"><img src="modules/'.$module_name.'/images/admin/info.png" alt="" /></td>
          <td align="center" valign="top" style="padding: 0px 8px 0px 8px; border-left: 1px solid '.$bgcolor2.';">
            Messages older than '.$out.' deleted!<br /><strong>'.$db->sql_affectedrows().'</strong> messages deleted!
          </td>
        </tr>
        </table><br />';
      }
    }
    else
    {
      echo '
      <table align="center" style="border: 1px solid '.$bgcolor2.'; font-size: 14px;">
      <tr>
        <td align="center" valign="top" style="padding: 0px 8px 0px 8px;"><img src="modules/'.$module_name.'/images/admin/warning.png" alt="" /></td>
        <td align="center" valign="top" style="padding: 0px 8px 0px 8px; border-left: 1px solid '.$bgcolor2.';">
        Delete Messages older than:<br />
          <form action="'.$admin_file.'.php?op=liveChat&amp;do=time_range'.$link_append.$link_limit.'" method="post">
          <input type="text" name="time_value" size="4" value="" />
          <select name="time_type">
            <option value="h">Hours</option>
            <option value="m">Minutes</option>
            <option value="d">Days</option>
            <option value="w">Weeks</option>
          </select>
          <input type="submit" value="Delete" />
          </form>
          <em>Note: Messages will be deleted<br />
          without further confirmation!</em>
        </td>
      </tr>
      </table><br />';
    }
    
  break;
  
}


list($total) = $db->sql_fetchrow($db->sql_query('SELECT count(id) FROM '.$prefix.'_live_chat'.$user_cond));
$total_pages = ceil($total / $show);

if ($total_pages > 1)
{
  $page_range = range(1, $total_pages);
  $page_back = $page > 1 ? $page - 1 : '';
  $page_next = $page < $total_pages ? $page + 1 : '';
}

$sql = 'SELECT * FROM '.$prefix.'_live_chat'.$user_cond.$ord.$dir.$limit;

if (!($result = $db->sql_query($sql)))
{
  die('DB ERROR');
}

echo '
<div style="float: left">Total Messages: '.$total.'</div>
<div style="float: right">Show:
'.($show == 20 ? '<strong>20</strong>' : '<a href="'.$admin_file.'.php?op=liveChat'.$link_append.'&amp;show=20">20</a>').' | 
'.($show == 50 ? '<strong>50</strong>' : '<a href="'.$admin_file.'.php?op=liveChat'.$link_append.'&amp;show=50">50</a>').' |
'.($show == 100 ? '<strong>100</strong>' : '<a href="'.$admin_file.'.php?op=liveChat'.$link_append.'&amp;show=100">100</a>').'
</div>
<br />';

echo '<table width="100%" cellpadding="4" cellspacing="2">
<tr style="background-color: '.$bgcolor2.'">
  <th>ID</th>
  <th>
    <a href="'.$admin_file.'.php?op=liveChat&amp;order=time&amp;dir=A'.$link_limit.'"><img src="modules/'.$module_name.'/images/admin/asc.png" alt="" /></a>
    Timestamp
    <a href="'.$admin_file.'.php?op=liveChat&amp;order=time&amp;dir=D'.$link_limit.'"><img src="modules/'.$module_name.'/images/admin/desc.png" alt="" /></a>
  </th>
  <th>
    <a href="'.$admin_file.'.php?op=liveChat&amp;order=name&amp;dir=A'.$link_limit.'"><img src="modules/'.$module_name.'/images/admin/asc.png" alt="" /></a>
    Username
    <a href="'.$admin_file.'.php?op=liveChat&amp;order=name&amp;dir=D'.$link_limit.'"><img src="modules/'.$module_name.'/images/admin/desc.png" alt="" /></a>
  </th>
  <th>Message</th>
  <th>Delete</th>
</tr>
';
while ($r = $db->sql_fetchrow($result))
{
  echo '
  <tr style="background-color: '.$bgcolor2.'">
    <td align="right" width="5">'.$r['id'].'</td>
    <td align="center" width="25%">'.date("m-d-Y h:i:s a", $r['timestamp']).'</td>
    <td align="center" width="25%"><a href="'.$admin_file.'.php?op=liveChat&amp;user='.$r['username'].'">'.$r['username'].'</a></td>
    <td width="25%">'.substr(stripslashes($r['message']), 0, 30).'</td>
    <td align="center" width="5">&nbsp;<a href="'.$admin_file.'.php?op=liveChat'.$link_append.$link_limit.'&amp;do=del_msg&amp;id='.$r['id'].'"><img src="modules/'.$module_name.'/images/admin/delete.png" alt="" /></a></td>
  </tr>
  ';
}

echo '</table>';

if ($total_pages > 1)
{
  echo '<div align="center">';
  if (!empty($page_back))
  {
    echo '<a href="'.$admin_file.'.php?op=liveChat'.$link_append.'&amp;show='.$show.'&amp;page='.$page_back.'">&lt;- Previous</a> ';
  }
  
  foreach ($page_range as $pnum)
  {
    if ($pnum == $page)
    {
      echo '<strong>'.$pnum.'</strong> ';
    }
    else
    {
      echo '<a href="'.$admin_file.'.php?op=liveChat'.$link_append.'&amp;show='.$show.'&amp;page='.$pnum.'">'.$pnum.'</a> ';
    }
  }
  
  if (!empty($page_next))
  {
    echo '<a href="'.$admin_file.'.php?op=liveChat'.$link_append.'&amp;show='.$show.'&amp;page='.$page_next.'">Next -&gt;</a> ';
  }
  echo '</div>';
}

CloseTable();
include 'footer.php';

// end the good stuff


} else {
  include_once("header.php");
  GraphicAdmin();
  OpenTable();
  echo "<center><b>"._ERROR."</b><br /><br />You do not have administration permission for module \"$module_name\"</center>";
  CloseTable();
  include_once("footer.php");
}

?>
