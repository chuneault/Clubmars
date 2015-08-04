<?php
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

    <script src="js/jquery.ui.timepicker.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="css/jquery.ui.timepicker.css" />


    <link rel="stylesheet" type="text/css" href="extra/cleditor/jquery.cleditor.css" />

    <script type="text/javascript" src="extra/cleditor/jquery.cleditor.min.js"></script>
    <script type="text/javascript" src="extra/cleditor/jquery.cleditor.icon.min.js"></script>

    <script type="text/javascript" src="js/jquery.validate.min.js"></script>

   <link rel="stylesheet" type="text/css" href="css/redmond/jquery-ui-1.9.1.custom.min.css" />

    <script type="text/javascript">


     $().ready(function(){
          $('#trainstarttime').timepicker();

         /*
         $("#messagebox").cleditor();

         $("#contactform").validate({

             errorElement: "p",
             errorLabelContainer: "#result",
             //submitHandler: function(form) { form.ajaxSubmit(); },
             messages: {
               subject: "Le sujet est obligatoire",
               fromemail: {
                           required: "Le courriel est ogligatoire",
                           email: "Le format doit être nom@domain.com"
               }
             },
             rules: {
               fromemail: { required: true, email: true },
               subject :  { required: true }
             }
          }
         );
         */
     }); // fin function ready

     $(function() {
      $( "#tabs" ).tabs();
     });

    </script>

    <style>

      #maintraindiv {
       font: 10px Arial, sans-serif;
      }
    </style>

  </head>

<body>

<?php
  $mnuIdSelected = '#mnutrainer';
  include 'menu.php';
?>

<p>&nbsp;</p>


<div id="maintraindiv">

  <div id="tabs">
      <ul>
          <li><a href="#tabs-1">Nouvelle séance</a></li>
          <li><a href="#tabs-2">Calendrier</a></li>
      </ul>



    <div id="tabs-2">
      <form id="calendarform" class="editform" method="POST">

       <button type="submit">Sauvegarder</button>
       <button type="button" onclick="$('#dialog').dialog('close');" >Quitter</button>
       <div id="result" class="errordiv"></div>
      </form>

    </div>

    <div id="tabs-1">
     <form id="newtrainform" class="editform" method="POST">
        <p>
         <label class="labelfield" for="trainstarttime">Heure de début</label>
         <input type="text" class="ui-widget-content" name="trainstarttime" id="trainstarttime">
       </p>
       <p>
         <label class="labelfield" for="email"><? echo PHP_VERSION ?></label>
         <input type="text" class="ui-widget-content" name="email" id="email" >
       </p>
       <p>
         <label class="labelfield" for="public_email">Courriel publique</label>
         <input type="checkbox" class="ui-widget-content" name="public_email" id="public_email" value="1" >
       </p>

        <p>
         <label class="labelfield" for="current_password">Mot de passe courant</label>
         <input type="password" class="ui-widget-content" name="current_password" id="current_password">
       </p>
       <p>
         <label class="labelfield" for="password">Nouveau mot de passe</label>
         <input type="password" class="ui-widget-content" name="password" id="password">
       </p>
       <p>
         <label class="labelfield" for="confirm_password">Confirmation mot de passe </label>
         <input type="password" class="ui-widget-content" name="confirm_password" id="confirm_password">
       </p>
       <p style="height: 20px"></p>
       <button type="submit">Sauvegarder</button>
       <button type="button"  onclick="$('#dialog').dialog('close');" >Quitter</button>
       <div id="resultprofil" class="errordiv"></div>
       <input type="hidden" name="updatefields" id="updatefieldsprofil">
       <input type="hidden" name="tablename" value="members">
       <input type="hidden" name="function" value="updateProfils">

     </form>

   </div>
  </div>
</div>


</body>

</html>