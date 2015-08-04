<?php

 session_start();

 require("constant.php");

 connectClubMarsDb();

 $updatefields = json_decode(stripslashes($_POST["updatefields"]));

 $update_sql = "UPDATE " .$_POST["tablename"] ." SET last_update = NOW()";
 foreach ($updatefields as $fields) {

    switch ($fields->fieldtype) {
      case "text":
        $update_sql .= ", " .$fields->fieldname ." = '" .mysql_real_escape_string($_POST[$fields->fieldname]) ."' ";
        break;
      case "bool":
        $update_sql .= ", " .$fields->fieldname ." = " .($_POST[$fields->fieldname] != null ? '1 ' : '0 ');
        break;
    }
 }
  $result["result"] = "false";

  if (isset($_POST['function']) && $_POST['function'] == 'updateMembers') {
    $result["msg"] = htmlentities("Votre profil a été modifié avec succès");
  }
  else {

    if ((strlen($_POST['current_password']) > 0) && (strlen($_POST['confirm_password']) > 0)) {
      if  ($_SESSION['profil']['password'] != $_POST['current_password']) {
        $result["msg"] = htmlentities("Votre mot de passe courant ne correspond pas");
        echo json_encode($result);
        mysql_close();
        exit;
      } else {
       $update_sql .= ", password = '" .$_POST['confirm_password'] ."'";
      }
    }

    $result["msg"] = htmlentities("Votre profil internet a été modifié avec succès");
  }


 $update_sql .= "WHERE member_id = " .$_SESSION["profil"]["member_id"];

  if (!mysql_query($update_sql)) {
     $result["msg"] = mysql_error();
  } else {
    $result["result"] = "true";
      if (isset($_POST['member_username']) && strlen($_POST['member_username']) > 0) {
        $_SESSION['profil']['member_username'] = $_POST['member_username'];
      }
      if (isset($_POST['confirm_password']) && strlen($_POST['confirm_password']) > 0) {
         $_SESSION['profil']['password'] = $_POST['confirm_password'];
      }
  }

  echo json_encode($result);

  mysql_close();

?>