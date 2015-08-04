<?php

require_once('php/clubmars_utils.php');

function fixGlobalFilesArray($files) {
        $ret = array();

        if(isset($files['tmp_name']))
        {
            if (is_array($files['tmp_name']))
            {
                foreach($files['name'] as $idx => $name)
                {
                    $ret[$idx] = array(
                        '' => $name,
                        'tmp_name' => $files['tmp_name'][$idx],
                        'size' => $files['size'][$idx],
                        'type' => $files['type'][$idx],
                        'error' => $files['error'][$idx]
                    );
                }
            }
            else
            {
                $ret = $files;
            }
        }
        else
        {
            foreach ($files as $key => $value)
            {
                $ret[$key] = fixGlobalFilesArray($value);
            }
        }

        return $ret;
    }

  session_start();

  require("constant.php");

  $result = new ArrayObject();

  $files = fixGlobalFilesArray($_FILES);

  $to = array();

  $bodymsg = $_POST['editor1'];

  if ($_POST['toemail'] != 'eventonly' )
  {
    connectClubMarsDb();
    if (($_POST['toemail'] == 'allmembers' ) || ($_POST['toemail'] == "allmemberspublic")) {

      $sql = 'SELECT email, first_name, last_name FROM clubm532_master.members a where email <> ""';
      if ($_POST['toemail'] == "allmemberspublic") {
        $sql .= ' and public_email = 1';
      }
      $member = mysql_query($sql) or die(mysql_error());
      while ($row = mysql_fetch_assoc($member)) {
        $to[] = array('email' => $row['email'], 'name' => $row['first_name'] .', ' .$row['last_name']);
      }
      mysql_free_result($member);
      mysql_close();

    }
    else {
      $sql = 'SELECT email, first_name, last_name FROM clubm532_master.members where maac = "' .$_POST['toemail'] .'"';
      $member = mysql_query($sql) or die(mysql_error());
      if ($row = mysql_fetch_assoc($member))
        $to[] = array('email' => $row['email'], 'name' => $row['first_name'] .', ' .$row['last_name']);
      mysql_free_result($member);
      mysql_close();
    }

    $resultsendmail = sendmail($to, $_POST['subject'], $bodymsg, $files, $_POST['fromemail']);
    $result = (array)$result;
    if ( $resultsendmail == 'ok') {


      $result['result'] = 'true';
      if (($_POST['toemail'] == 'allmembers' ) || ($_POST['toemail'] == "allmemberspublic")) {
        $result['msg'] = htmlentities('Message envoyé à ' .count($to) .' membres..', ENT_QUOTES, "ISO8859-1");
      } else {
        $result['msg'] = htmlentities('Message envoyé à ' .$to[0]['email'], ENT_QUOTES, "ISO8859-1");
      }
    }
    else {
      $result['result'] = 'false';
      $result['msg'] = $resultsendmail;
    }
  }

  if (((isset($_POST['publish_event']) && $_POST['publish_event'] == '1')) || ($_POST['toemail'] == 'eventonly')) {

     connectClubMarsDb();

     $subject =   str_replace('\'', '\\\'', utf8_decode($_POST['subject']));
     $event_date = $_POST['publish_date'];
     $publish_main = 0;
     if (isset($_POST['publish_main']))
         $publish_main = $_POST['publish_main'];

     if ($publish_main != 1)
       $publish_main = 0;

    $bodymsg = str_replace('\'', '\\\'', utf8_decode($bodymsg));

     $sql = 'INSERT INTO events (`event_date`, `title`, `description`, `active`, `show_main_page`)
            VALUES (\'' .$event_date .'\', \'' .$subject .'\', \''.$bodymsg . '\', 1, ' .$publish_main .')';

     $ok = mysql_query($sql) or die(mysql_error());

     $result['result'] = 'true';

     mysql_close();
  }

  $result = (object)$result;
  echo json_encode($result);

?>