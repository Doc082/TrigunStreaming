<?php

// define table names
define('TABLE_CHAT', $prefix.'_live_chat');
define('TABLE_ONLINE', $prefix.'_live_online');

// define some options
define('MESSAGE_LIMIT', 50);// how many of the newest messages to get initially

// error handler for the backed chat
function error_handler($errNo, $errStr, $errFile, $errLine)
{
  if(ob_get_length()) ob_clean();
  $error_message = 'ERRNO: '.$errNo."\n".'TEXT: '.$errStr."\n".'LOCATION: '.$errFile.', line '.$errLine;
  echo $error_message;
  exit;
}


class Chat
{

  private $db;
  
  // you can add and remove text colors here
  public $textColors = array
  (
    'Default' => '',
    'Black'   => '#000000',
    'White'   => '#FFFFFF',
    'Yellow'  => '#FFFF00',
    'Red'     => '#FF0000',
    'Blue'    => '#0000FF',
    'Green'   => '#008000',
    'Gray'    => '#808080',
    'Purple'  => '#800080',
    
    'Fuchsia' => '#FF00FF',
    'Silver'  => '#C0C0C0',
    'Olive'   => '#808000',
    'Maroon'  => '#800000',
    'Aqua'    => '#00FFFF',
    'Lime'    => '#00FF00',
    'Teal'    => '#008080',
    'Navy'    => '#000080'
  );
  
  // you can add or remove text sizes here
  public $textSizes = array
  (
    'Default' => '',
    'X-Large' => '24px',
    'Large'   => '18px',
    'Normal'  => '12px',
    'Small'   => '9px',
    'X-Small' => '7px'
  );
  
  // you can add or remove smilies here
  public $smilies = array
  (
    '8)'        => '<img src="modules/Forums/images/smiles/icon_cool.gif" title="Cool" alt="" />',
    '80'        => '<img src="modules/Forums/images/smiles/icon_eek.gif" title="Shocked" alt="" />',
    ':!:'       => '<img src="modules/Forums/images/smiles/icon_exclaim.gif" title="Exclamation" alt="" />',
    ':('        => '<img src="modules/Forums/images/smiles/icon_sad.gif" title="Sad" alt="" />',
    ':)'        => '<img src="modules/Forums/images/smiles/icon_smile.gif" title="Smile" alt="" />',
    ':?:'       => '<img src="modules/Forums/images/smiles/icon_question.gif" title="Question" alt="" />',
    ':?'        => '<img src="modules/Forums/images/smiles/icon_confused.gif" title="Confused" alt="" />',
    ':D'        => '<img src="modules/Forums/images/smiles/icon_biggrin.gif" title="Very Happy" alt="" />',
    ':P'        => '<img src="modules/Forums/images/smiles/icon_razz.gif" title="Razz" alt="" />',
    ':|'        => '<img src="modules/Forums/images/smiles/icon_neutral.gif" title="Neutral" alt="" />',
    ':arrow:'   => '<img src="modules/Forums/images/smiles/icon_arrow.gif" title="Arrow" alt="" />',
    ':cry:'     => '<img src="modules/Forums/images/smiles/icon_cry.gif" title="Crying or Very Sad" alt="" />',
    ':evil:'    => '<img src="modules/Forums/images/smiles/icon_evil.gif" title="Evil or Very Mad" alt="" />',
    ':idea:'    => '<img src="modules/Forums/images/smiles/icon_idea.gif" title="Idea" alt="" />',
    ':lol:'     => '<img src="modules/Forums/images/smiles/icon_lol.gif" title="Laughing" alt="" />',
    ':mrgreen:' => '<img src="modules/Forums/images/smiles/icon_mrgreen.gif" title="Mr. Green" alt="" />',
    ':oops:'    => '<img src="modules/Forums/images/smiles/icon_redface.gif" title="Embarassed" alt="" />',
    ':o'        => '<img src="modules/Forums/images/smiles/icon_surprised.gif" title="Surprised" alt="" />',
    ':roll:'    => '<img src="modules/Forums/images/smiles/icon_rolleyes.gif" title="Rolling Eyes" alt="" />',
    ':twisted:' => '<img src="modules/Forums/images/smiles/icon_twisted.gif" title="Twisted Evil" alt="" />',
    ':wink:'    => '<img src="modules/Forums/images/smiles/icon_wink.gif" title="Wink" alt="" />',
    ':x'        => '<img src="modules/Forums/images/smiles/icon_mad.gif" title="Mad" alt="" />',
  );

  
  function __construct()
  {
    global $db;
    $this->db = $db;
    
  }

  public function __destruct()
  {
    
  }
  
  // this contains the layout of the chat block, edit carefully ;)
  public function showChat($show_status = 0)
  {
    global $bgcolor2;
    $module_name = 'Live_Chat';
    $smilies = $this->smilies;
    $smilie_line = '';
    if (count($smilies) > 0)
    {
      foreach ($smilies as $code => $image)
      {
        $smilie_line .= '<a href="#" onclick="document.getElementById(\'messageBox\').value += \''.$code.' \'; return false;">'.$image.'</a>&nbsp; ';
      }
    }
    
    $color_select = '';
    if (count($this->textColors) > 0)
    {
      $color_select .= '<select name="textColor" id="textColor">'."\n";
      foreach ($this->textColors as $name => $hex)
      {
        $color_select .= '<option value="'.$hex.'" '.(empty($hex) ? '' : 'style="color: '.$hex.'"').'>'.$name.'</option>'."\n";
      }
      $color_select .= '</select>';
    }
    
    $size_select = '';
    if (count($this->textSizes) > 0)
    {
      $size_select .= '<select name="textSize" id="textSize">'."\n";
      foreach ($this->textSizes as $name => $size)
      {
        $size_select .= '<option value="'.$size.'">'.$name.'</option>'."\n";
      }
      $size_select .= '</select>';
    }
    
    $chatBox = '
    <script type="text/javascript" src="modules/'.$module_name.'/chat.js"></script>
    <script type="text/javascript">bgcolor2 = "'.$bgcolor2.'";</script>
    ';
    if ($show_status == 1)
    {
      
      $chatBox .= '
      <script type="text/javascript">show_status = 1;</script>
      <div id="status" style="background-color: '.$bgcolor2.'; width: 80px; height: 14px; padding-left: 2px; position: relative; font-weight: bold; z-index: 101;">Status</div>
      ';
    }
    
    $chatBox .= '
    <table width="100%" cellpadding="0" cellspacing="0">
      <tr>
        <td valign="top" style="width: 100%;">
          <div id="scroll" style="border: 1px solid '.$bgcolor2.';position: relative; height: 260px; overflow: auto; padding: 2px; text-align: justify;"></div>
        </td>
        <td valign="top" style="width: 140px;">
          <div id="online" style="margin-left: 2px; border: 1px solid '.$bgcolor2.';position: relative; width: 138px; height: 260px; overflow: auto; padding: 2px; text-align: justify;"></div>
        </td>
      </tr>
      <tr>
        <td valign="top" colspan="2">
          <div style="border: 1px solid'.$bgcolor2.'; margin-top: 2px; padding: 4px;" align="center">
            <div style="margin-bottom: 4px;">
            Font Size: '.$size_select.'&nbsp;&nbsp;
            Font Color: '.$color_select.'&nbsp;&nbsp;
            
            <span style="cursor: pointer; padding: 3px 8px 1px 8px; border: 1px solid black; text-align: center; font-weight: bold;" id="bold" onclick="toggleStyle(\'bold\', \'textBold\');">B</span>&nbsp;
            <input type="hidden" name="textBold" id="textBold" value="" />
            <span style="cursor: pointer; padding: 3px 8px 1px 8px; border: 1px solid black; text-align: center; font-style: italic;" id="italic" onclick="toggleStyle(\'italic\', \'textItalic\');">I</span>&nbsp;
            <input type="hidden" name="textBold" id="textItalic" value="" />
            <span style="cursor: pointer; padding: 3px 8px 1px 8px; border: 1px solid black; text-align: center; text-decoration: underline;" id="underline" onclick="toggleStyle(\'underline\', \'textUnderline\');">U</span>&nbsp;
            <input type="hidden" name="textBold" id="textUnderline" value="" />
            
            <span style="cursor: pointer; position: relative; top: 4px;" id="smilebutton" onclick="overlayElement(\'smile\', \'smilebutton\');"><img src="modules/'.$module_name.'/images/smilies.png" alt="Smilies" title="Smilies" /></span>
            <div id="smile" style="display: none; position: absolute; width: 100px; background-color: '.$bgcolor2.'; border: 1px solid black; padding: 2px; margin-top: 4px;">'.$smilie_line.'</div>
            
            </div>
            
            <input type="text" id="messageBox" maxlength="2000" style="width: 80%" onkeydown="handleKey(event)"/>
            <input type="button" id="sendMessage" value="Send" onclick="sendMessage();" />&nbsp;&nbsp;
            '.(!empty($_GET['pop']) ? '' : '<span style="cursor: pointer; position: relative; top: 4px;" id="poplink" onclick="chatWindow(\'modules.php?name='.$module_name.'&amp;pop=1\',\'chatWin\',\'640\',\'360\');return false"><img src="modules/'.$module_name.'/images/window.png" alt="Popup Chat Window" title="Popup Chat Window" /></span>').'
            
            <span style="cursor: pointer; position: relative; top: 4px;" onclick="stopChat();"><img src="modules/'.$module_name.'/images/stop.png" id="switch" alt="Stop Chat" title="Stop Chat" /></span>
          </div>
          <!-- <input type="button" value="Stop Updating" id="switch" onclick="stopChat();" /><br /> -->
        </td>
        <!-- <td valign="top" style="width: 140px;"></td> -->
      </tr>
    </table>
    ';
    
    return $chatBox;
  }
  // end layout
  
  private function getMessages($id = 0, $deny = false)
  {
    $id = intval($id);
    if($id > 0)
    {
      $query = 'SELECT * FROM '.TABLE_CHAT.' WHERE id > ' . $id . ' ORDER BY id ASC';
    }
    else
    {
      $query = 'SELECT * FROM '.TABLE_CHAT.' WHERE id > (SELECT MAX( id ) - '.MESSAGE_LIMIT.' FROM '.TABLE_CHAT.') ORDER BY id ASC LIMIT '.MESSAGE_LIMIT;
    }
    $result = $this->db->sql_query($query);
    $response = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';
    $response .= '<response>';
    $response .= '<online>';
    
    $query2 = 'SELECT * FROM '.TABLE_ONLINE.' WHERE timestamp>\''.(time() - 60).'\' ORDER BY username ASC';
    $result2 = $this->db->sql_query($query2);
    if($this->db->sql_numrows($result2) > 0)
    {
      
      while ($row2 = $this->db->sql_fetchrow($result2))
      {
        $response .= '<user><![CDATA['.$row2['username'].']]></user>';
      }
      
    }
    else
    {
      $response .= '<user><![CDATA[ &nbsp; ]]></user>';
    }
   
    $response .= '</online><q>'.$this->db->num_queries.'</q>';
    $response .= '<denied>'.(!$deny ? 'false' : 'true' ).'</denied>';
    if($this->db->sql_numrows($result) > 0)
    {
      while ($row = $this->db->sql_fetchrow($result))
      {
        $id = $row['id'];
        $color = htmlspecialchars ($row['color']);
        $size = htmlspecialchars ($row['size']);
        $style = htmlspecialchars ($row['style']);
        $userName = htmlspecialchars (stripslashes($row['username']));
        $time = htmlspecialchars(date('m/d/Y h:i:s a', $row['timestamp']));
        $message = htmlspecialchars (stripslashes($row['message']));
        $message = $this->parseSmilies($message);
        $response .= '<id>' . $id . '</id>' .
                     '<color><![CDATA[' . $color . ']]></color>' .
                     '<size><![CDATA[' . $size . ']]></size>' .
                     '<style><![CDATA[' . $style . ']]></style>' .
                     '<time>' . $time . '</time>' .
                     '<name><![CDATA[' . $userName . ']]></name>' .
                     '<message><![CDATA[' . $message . ']]></message>';
      }
    }
    $response = $response . '</response>';
    return $response;
  }

  public function showMessages($id, $deny = false)
  {
    if(ob_get_length()) ob_clean();
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . 'GMT');
    header('Cache-Control: no-cache, must-revalidate');
    header('Pragma: no-cache');
    header('Content-Type: text/xml');
    echo $this->getMessages($id, $deny);
  }
  
  public function postMessage($uname, $message, $color, $size, $bold = 0, $italic = 0, $underline = 0)
  {
    $uname = mysql_real_escape_string($uname);
    $message = mysql_real_escape_string(strip_tags($message));
    $color = mysql_real_escape_string($color);
    $size = mysql_real_escape_string($size);
    $style = intval($bold) ."|". intval($italic) ."|". intval($underline);
    
    $query = 'INSERT INTO '.TABLE_CHAT.'(`timestamp`, `username`, `message`, `color`, `size`, `style`) VALUES (UNIX_TIMESTAMP(), \''.$uname.'\', \''.$message.'\', \''.$color.'\', \''.$size.'\', \''.$style.'\')';
    $result = $this->db->sql_query($query);
  }
  
  public function checkOnline($username)
  {
    
    if (empty($username))
    {
      return false;
    }
    $username = mysql_real_escape_string($username);
    
    if (rand(1,20) == 20)
    {
      // get rid of users that are gone
      $query = 'DELETE FROM '.TABLE_ONLINE.' WHERE timestamp < '.(time() - 60).'';
      $result = $this->db->sql_query($query);
    }

    // see if user is in the table
    $query2 = 'SELECT username FROM '.TABLE_ONLINE.' WHERE username=\''.$username.'\' LIMIT 1';
    $result2 = $this->db->sql_query($query2);
    if($this->db->sql_numrows($result2) == 1)
    {
      $query3 = 'UPDATE '.TABLE_ONLINE.' SET timestamp=\''.time().'\' WHERE username=\''.$username.'\' LIMIT 1';
    }
    else
    {
      $query3 = 'INSERT INTO '.TABLE_ONLINE.' (username, timestamp) VALUES (\''.$username.'\', \''.time().'\')';
    }
    $result3 = $this->db->sql_query($query3);
  }
  
  public function takeOffline($username)
  {
    if (empty($username))
    {
      return false;
    }
    $username = mysql_real_escape_string($username);
    $query = 'DELETE FROM '.TABLE_ONLINE.' WHERE username=\''.$username.'\' LIMIT 1';
    $result = $this->db->sql_query($query);
  }
  
  private function parseSmilies($text)
  {
    $smilies = $this->smilies;
    return str_replace(array_keys($smilies), array_values($smilies), $text);
  }
}



// these functions are pulled from mainfile.php and put here.
// this is done because every time mainfile is called it runs over 20 queries.
// putting the functions here brings that number down to about 6, and reduces the server load quite a bit.

if (!function_exists('is_user'))
{
  function is_user($user) {
    if (!$user) { return 0; }

    if (isset($userSave)) return $userSave;
    if (!is_array($user)) {
        $user = base64_decode($user);
        $user = addslashes($user);
        $user = explode(':', $user);
    }
    $uid = $user[0];
    $pwd = $user[2];
    $uid = intval($uid);
    if (!empty($uid) AND !empty($pwd)) {
        global $db, $user_prefix;
        $sql = 'SELECT user_password FROM '.$user_prefix.'_users WHERE user_id=\''.$uid.'\'';
        $result = $db->sql_query($sql);
        $row = $db->sql_fetchrow($result);
        if ($row[0] == $pwd && !empty($row[0])) {
            static $userSave;
            return $userSave = 1;
        }
    }
    static $userSave;
    return $userSave = 0;
  }
}

if (!function_exists('cookiedecode'))
{
  function cookiedecode($user) {
    global $cookie, $db, $user_prefix;
    static $pass;
    if(!is_array($user)) {
        $user = base64_decode($user);
        $user = addslashes($user);
        $cookie = explode(':', $user);
    } else {
        $cookie = $user;
    }
    if (!isset($pass) AND isset($cookie[1])) {
     $sql = 'SELECT user_password FROM '.$user_prefix.'_users WHERE username=\''.$cookie[1].'\'';
     $result = $db->sql_query($sql);
     list($pass) = $db->sql_fetchrow($result);
    }
    if (isset($cookie[2]) AND ($cookie[2] == $pass) AND (!empty($pass))) { return $cookie; }
  }
}
?>
