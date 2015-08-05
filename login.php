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

  $member = mysqli_query($connection, 'select * from members where ((member_username = "'.$_POST['username'].'")  or (maac = "' .$_POST['username'].'"))
                          and password = "'.$_POST['password'].'"') or die(mysqli_error($connection));


  if ($row = mysqli_fetch_assoc($member)) {
    $ok = mysqli_query($connection, 'update members set last_login = now(), count_login = count_login + 1 where member_username = "' .$row['member_username'] .'"');
    $result['result'] = 'true';
    $_SESSION['profil'] = $row;
    $_SESSION['security'] = $row['security_level'];
  }
  else {
    $result['result'] = 'false';
    $result['msg'] = 'Utilisateur ou mot de passe invalide';
  }

    echo json_encode($result);
    mysqli_free_result($member);
    mysqli_close($connection);
  }

?>