<?php

  //error_reporting(E_ALL);
  //error_reporting(E_STRICT);

  session_start();

  require("constant.php");

  connectClubMarsDb();

  $newtitle = str_replace('\'', '\\\'', utf8_decode($_POST['eventtitle']));
  $newdesc = str_replace('\'', '\\\'', utf8_decode($_POST['desc']));
  $eventid = $_POST['event_id'];

  $sql = 'update events set title = \'' .$newtitle .'\', description = \'' .$newdesc .'\' where event_id = ' .$eventid;

  $ok = mysqli_query($connection, $sql) or die(mysqli_error($connection));

  if ($ok) {
   $result['result'] = 'true';
   $result['msg'] = htmlentities('Sauvegardé');
  } else {
    $result['result'] = 'false';
  }

  mysqli_close($connection );

  echo json_encode($result);

?>