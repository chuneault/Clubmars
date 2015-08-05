<?php
 header('Content-Type: text/html; charset=utf-8');
 session_start();
?>

<!DOCTYPE HTML>
<head>

  <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE"/>
  <META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE"/>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />

  <title>Club Mars RC - Événements</title>

  <link rel="stylesheet" type="text/css" href="mainstyle.css" />

  <script src="js/jquery-1.8.2.min.js" type="text/javascript"></script>
  <script src="js/jquery-ui-1.9.1.custom.min.js" type="text/javascript"></script>

  <link rel="stylesheet" type="text/css" href="css/dot-luv/jquery-ui-1.8.18.custom.css" />

  <script type="text/javascript" src="extra/tiny_mce/jquery.tinymce.js"></script>
  <script type="text/javascript" src="js/clubmars_utils.js"></script>

  <link rel="stylesheet" type="text/css" href="css/edit_events.css" />


  <script type="text/javascript">

      $(document).ready(function(){


          $('.btnEditEvent').click(function(){
              debugger;
              editEvent($(this).parent().data('eventid'));
          });

          $('.btnDelEvent').click(function(){
              debugger;
              delEvent($(this).parent().data('eventid'), $(this).parent());
          });

      });

    function editEvent(idEvent) {

       $.get("edit_events.php", {id: idEvent }, function(data){

            $('#editeventdialog').html(data);

            $('#editeventdialog').dialog({
              autoOpen: true,
              modal: true,
              closeOnEscape: false,
              width: 800,
              //resizable: false,
              title : "Édition d'un événement",
              //position: [150,174],
              open:function(){
                  $('textarea.tinymce').tinymce(tinymceOptions);
                },
                close:function(){
                }
            });
        });

    };

      function delEvent(idEvent, pdivMsg) {

          var divMsg = pdivMsg.parent().parent();
          debugger;
          $.post('del_event.php', {id:idEvent },  function (result) {

              if (result == 'ok') {
                 divMsg.remove();

              }
               else
                alert(result);
          });

      }


  </script>

</head>

<body>

   <?php
       $mnuIdSelected='#mnuevents';
       include 'menu.php';
    ?>



<div class="maincontent">


<?php

    require("constant.php");

    connectClubMarsDb();

    $result = mysqli_query($connection, 'select * from events where active = 1 order by event_date DESC, event_id DESC;') or die(mysqli_error($connection));

    while ($row = mysqli_fetch_assoc($result)) {
      echo "<div class=\"mainpanel\" style=\"width: 800px\">\n";
      echo "  <div class=\"content\">\n";
      echo "    <h1>" .$row['title'];

      if ($_SESSION['security'] > 1) {
        echo "<div class='editevent' data-eventid = '" .$row['event_id'] ."'><img class='btnEditEvent' src='images/file_edit.png'><img class='btnDelEvent' src='images/file_delete.png'></div>";
      }

      echo "<label>" .$row['event_date']   ."</label></h1><p></p>\n";

        echo "    <div class=\"contentdesc\">\n";
      echo "    " .$row['description'] ."\n";
      echo "    </div>\n";
      echo "  </div>\n";
      echo "</div>\n";
    }

    // Free the resources associated with the result set
    // This is done automatically at the end of the script
    mysqli_free_result($result);

    // Close Connection
    mysqli_close($connection );

?>

<div id="editeventdialog" style="display: none"></div>

</div>

</body>
</html>
