<?php

  session_start();


  if (isset($_POST['fonction']) && ($_POST['fonction'] == 'close')) {
     $_SESSION = array();
     session_destroy();
  }
  else {

  require("constant.php");

  $result = new ArrayObject();

  connectClubMarsDb();

  $member = mysql_query('select * from members where ((member_username = "'.$_POST['username'].'")  or (maac = "' .$_POST['username'].'"))
                          and password = "'.$_POST['password'].'"') or die(mysql_error());


  if ($row = mysql_fetch_assoc($member)) {
    $ok = mysql_query('update members set last_login = now(), count_login = count_login + 1 where member_username = "' .$row['member_username'] .'"');
    $result['result'] = 'true';
    $_SESSION['profil'] = $row;
    $_SESSION['security'] = $row['security_level'];
  }
  else {
    $result['result'] = 'false';
    $result['msg'] = 'Utilisateur ou mot de passe invalide';
  }

    echo json_encode($result);
    mysql_free_result($member);
    mysql_close();
  }

?>