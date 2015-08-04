<?php
 header('Content-Type: text/html; charset=utf-8');
 session_start();
?>

  <!DOCTYPE HTML>
  <head>

    <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
    <META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />

    <title>Club Mars RC - Instructeur</title>

    <link rel="stylesheet" type="text/css" href="mainstyle.css" />

    <script src="js/jquery-1.8.2.min.js" type="text/javascript"></script>
    <script src="js/jquery.form.js"></script>
    <script src="js/jquery-ui-1.9.1.custom.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery.json-2.3.min.js"></script>
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/dot-luv/jquery-ui-1.8.18.custom.css" />

    <script type="text/javascript" src="extra/tiny_mce/jquery.tinymce.js"></script>
    <script type="text/javascript" src="js/jquery.ui.timepicker.js"></script>

    <script type="text/javascript" src="js/clubmars_utils.js"></script>

    <script type="text/javascript">

     function submitupdate() {
        debugger;
        <?php
           if ($_GET['sessionId'] != null) {
             echo "var phpaction = 'newsessionupdate.php?action=delete&sessionId=" .$_GET['sessionId'] ."';";
           } else {
             echo "var phpaction = 'newsessionupdate.php';";
           }
        ?>

        var formSerialize =  $("#newTrainSession").serialize();
        $('input[disabled]').each( function() {
             formSerialize = formSerialize + '&' + $(this).attr('name') + '=' + $(this).val();
        });

        $.post(phpaction, formSerialize,
           function(data) {
                if (data.substring(0,8) != '{"result') {
                  $('#newTrainSession #result').html(data);
                  $('#newTrainSession #result').show();
                }
                else {
                  var result = jQuery.parseJSON(data);
                  $('#newTrainSession #result').html(result.msg);
                  $('#newTrainSession #result').show();

                }
           }
        );
     }


     $().ready(function(){

        $('textarea.tinymce').tinymce(tinymceOptions);

        $("#start_date").datepicker({ changeYear: false, changeMonth: true, dateFormat: "yy-mm-dd" });
        $("#start_time,#end_time").timepicker({

             hourText: 'Heure',             // Define the locale text for "Hours"
             minuteText: 'Minute',         // Define the locale text for "Minute"
             amPmText: ['AM', 'PM'],       // Define the locale text for periods
             hours: { starts: 6,                // First displayed hour
                      ends: 21                  // Last displayed hour
             },
             minutes: { starts: 0,                // First displayed minute
                        ends: 30,                 // Last displayed minute
                        interval: 30               // Interval of displayed minutes
            },
            rows: 3
          });

        $("#newTrainSession").validate({
           errorElement: "p",
           errorLabelContainer: "#result",
           submitHandler: function(form) { submitupdate(); },
           messages: {
                     }
        }
       );

       function loadTrainSession(data) {
          $("#start_date").val(data['start_date']);
          $("#start_time").val(data['start_time']);
          $("#end_time").val(data['end_time']);

          $("#start_date").prop('disabled', true);
          $("#start_time").prop('disabled', true);
          $("#end_time").prop('disabled', true);

          $("#submitform").html('Effacer');

          $("#msgbodyextra").html("<p>Bonjour</p><p>Je dois malheureusement annuler la séance de formation</p>");
       }

       <?php

         if ($_GET['sessionId'] != null) {

            require_once("constant.php");
            connectClubMarsDb();

            $result = mysql_query('select * from trainsessions where session_id = ' . $_GET['sessionId'] .' ') or die(mysql_error());
            if($row = mysql_fetch_assoc($result)) {
              echo 'var trainSession = ' . json_encode($row) . ';';
              $students = $row['students'];
            }
            mysql_free_result($result);
            mysql_close();

            echo 'loadTrainSession(trainSession);';
         }

       ?>


      }); // fin function ready

  </script>

  <style>

    #newTrainSession {

       background-color:#ADC7DC;
       border:4px solid #90B2CF;
       padding:7px;
       width: 730px;
       margin-left: auto;
	     margin-right: auto;
       font:14px Arial, sans-serif;
       position: relative;
    }


    #newTrainSession #result {
      color: red;
      font-weight: bold;
      font-size: 16px;
      position: absolute;
      left: 465px !important;
      padding-top: 2px !important;
      text-align: left !important;
    }


    #newTrainSession .labelfield {
     width: 170px;
     font-size: 16px;
     display: inline-block;
    }


    #newTrainSession input {
      font-size: 16px;
    }

    #newTrainSession select {
      font-size: 16px;
      width: 275px;
    }



#newTrainSession input.error {
   border: 2px solid red;
}
    #newTrainSession p {
      margin: 0;
      padding:0;
      padding-bottom: 4px;
    }

    #newTrainSession button {
      background:#d76300;
      border:0;
      color:#fff;
      cursor:pointer;
      font-size:16px;
      font-weight:bold;
      height:26px;
      margin:4px 0 0 4px;
      text-align:center;
      vertical-align:middle;
      -webkit-border-radius:8px;
      -moz-border-radius:8px;
      border-radius:8px;
      padding: 3px;

    }

    #newTrainSession button:hover {background:#f49000;}

    #htmldiv {
      display: inline-block;
      padding-left:4px;
    }


  </style>

  </head>

<body>

    <?php
      $mnuIdSelected='#mnumember';
      include 'menu.php';
    ?>

    <p>&nbsp;</p>

    <form id="newTrainSession" method="post" enctype="multipart/form-data">

      <div id="result"></div>

      <p>
        <label class="labelfield" for="start_date">Date la séance</label>
        <input type="text" class="required" name="start_date" id="start_date">
      </p>

      <p>
        <label class="labelfield" for="start_time">Heure de début</label>
        <input type="text" class="required" name="start_time" id="start_time">
      </p>

      <p>
        <label class="labelfield" for="end_time">Heure de fin</label>
        <input type="text" class="required" name="end_time" id="end_time">
      </p>

      <p>
        <label class="labelfield">Élèves à aviser</label>
        <?php

          require_once("constant.php");
          connectClubMarsDb();

          if (($_GET['sessionId'] != null) && ($students != '')){
            $result = mysql_query('select member_id, first_name, last_name from members where member_id in (' .$students .')') or die(mysql_error());
            while ($row = mysql_fetch_assoc($result)) {
               echo "<input type=\"checkbox\" name=\"students[]\" value=\"" .$row['member_id'] ."\" checked disabled>" .utf8_encode($row['first_name'] ." " .$row['last_name']) ."\n" ;
            }
          }
          else {
            $result = mysql_query('select member_id, first_name, last_name from members where security_level = -1 order by last_update desc;') or die(mysql_error());
            while ($row = mysql_fetch_assoc($result)) {
               echo "<input type=\"checkbox\" name=\"students[]\" value=\"" .$row['member_id'] ."\">" .utf8_encode($row['first_name'] ." " .$row['last_name']) ."\n" ;
            }
          }
          mysql_free_result($result);
          mysql_close();

        ?>
      </p>

      <label class="labelfield">Message a envoyer aux élèves</label>
      <p>
        <textarea class="tinymce" cols="80" id="msgbodyextra" name="msgbodyextra" rows="10">
           <p>Bonjour,</p>
           <p>Je vais &ecirc;tre pr&eacute;sent au Club Mars pour une s&eacute;ance de formation le ??? &agrave; ???. Aux plaisirs de vous rencontrer.</p>
        </textarea>
      </p>

      <p></p>

      <button type="submit" name="submitform" id="submitform" tabindex="1003">Envoyer</button>
    </form>

</body>

</html>