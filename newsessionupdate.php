<?php

 session_start();

 require("constant.php");
 require_once('php/clubmars_utils.php');

 connectClubMarsDb();

 if ($_GET['action'] == 'delete') {
     $update_sql = "DELETE FROM trainsessions WHERE session_id = " .$_GET['sessionId'];
     $result["result"] = "false";
     $result["msg"] = htmlentities("Votre séances a été effacé et les élèves ont été avisés");
     $students = implode(",", $_POST['students']);
     $sujet = "Séances annulé de votre instructeur " .$_SESSION["profil"]['first_name'] ." " .$_SESSION["profil"]["last_name"];
 } else {
     $update_sql = "INSERT INTO trainsessions (member_id, start_date, start_time, end_time, students) VALUES (" ;
     $update_sql .= $_SESSION["profil"]["member_id"] .", \"" .$_POST['start_date']  ."\", \"" .$_POST['start_time']  ."\", \"" .$_POST['end_time'] ."\"";
     $students = implode(",", $_POST['students']);
     $update_sql .= ", \"" .$students ."\")";
     $result["result"] = "false";
     $result["msg"] = htmlentities("Votre séances a été créée et un courriel a été envoyé aux élèves");
     $sujet = "Nouvelle séances de votre instructeur " .$_SESSION["profil"]['first_name'] ." " .$_SESSION["profil"]["last_name"];
 }

 if (!mysql_query($update_sql)) {
     $result["msg"] = mysql_error();
  } else {

    if ($students != null) {
        $to = array();
        $sql = "select email, first_name, last_name from members where member_id in (" .$students .")";
        $rows = mysql_query($sql) or die(mysql_error());
        while ($row = mysql_fetch_assoc($rows)) {
          $to[] = array('email' => $row['email'], 'name' => $row['first_name'] .', ' .$row['last_name']);
        }
        mysql_free_result($rows);

        $resultsendmail = sendmail($to, $sujet,
                      $_POST["msgbodyextra"], null, $_SESSION["profil"]["email"]);
    }
    $result["result"] = "true";
  }

  echo json_encode($result);

  mysql_close();

?>