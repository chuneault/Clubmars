<?php
   header('Content-Type: text/html; charset=utf-8');
   session_start();
?>

 <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE"/>
 <META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE"/>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

 <script src="js/jquery.form.js"></script>
 <script type="text/javascript" src="js/jquery.validate.min.js"></script>
 <link rel="stylesheet" type="text/css" href="css/edit_events.css" />


 <script type="text/javascript">

  $().ready(function(){

   var  options = {
           complete: complete,
           beforeSubmit: function() {
              return $('#eventform').validate().form();
           },
        };

        $('#eventform').ajaxForm(options);

        function complete(xhr) {
          debugger;
          if (xhr.responseText.substring(0,8) != '{"result') {
                $('#result').html(xhr.responseText);
                $('#result').show();
              }
              else {
                var result = jQuery.parseJSON(xhr.responseText);
                $('#result').html(result.msg);
                $('#result').show();
                if (result.result  == 'true') {
                  $('#editeventdialog').dialog('close');
                  setTimeout('window.location.reload()', 250);
                }
              }
	      };

       $("#loginform").validate({

           errorElement: "p",
           errorLabelContainer: "#result",
           messages: {
                title: "Veuillez inscrire un titre",
                }
        }
       );

     <?php

       require("constant.php");
       connectClubMarsDb();

       $result = mysqli_query($connection, 'select * from events where event_id = ' .$_GET['id']) or die(mysqli_error($connection));
       $row = mysqli_fetch_assoc($result);

     ?>


 });
 </script>

<div id="editevents-modal" title="Édition">
    <form id="eventform" class="eventform" action="saveevent.php" method="POST">

       <input type="hidden" name="event_id" id="event_id" value="<?php echo $_GET['id']?>">
       <p>
         <label class="labelfield" for="eventtitle">Titre:</label>
         <input type="text" id="eventtitle" name="eventtitle" class="required ui-widget-content" tabindex="1001"
            value="<?php echo $row["title"]?>"
          />
       </p>

       <p>
        <textarea class="tinymce" cols="80" rows="10" name="desc" id="desc">
        <?php
          echo $row["description"];
          mysqli_free_result($result);
          mysqli_close($connection );
        ?>

        </textarea>
       </p>

       <button type="submit" name="submit" value="submit" tabindex="1003">Sauvegarder</button>
       <button type="button" onclick="$('#editeventdialog').dialog('close');" tabindex="1004">Annuler</button>
    </form>
    <div id="result"></div>
</div>
