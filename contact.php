<?php
 session_start();

?>

  <!DOCTYPE HTML>
  <head>

    <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
    <META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />

    <title>Club Mars RC - Contact</title>

    <link rel="stylesheet" type="text/css" href="mainstyle.css" />

    <script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
    <script src="js/jquery.form.js"></script>
    <script src="js/jquery-ui-1.8.18.custom.min.js" type="text/javascript"></script>

    <link rel="stylesheet" type="text/css" href="extra/cleditor/jquery.cleditor.css" />
    <script type="text/javascript" src="extra/cleditor/jquery.cleditor.min.js"></script>
    <script type="text/javascript" src="extra/cleditor/jquery.cleditor.icon.min.js"></script>

    <script type="text/javascript" src="js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/jquery.json-2.3.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/dot-luv/jquery-ui-1.8.18.custom.css" />

    <script type="text/javascript">


     $().ready(function(){

        var options = {
           //success     : showResponse,  // post-submit callback
           beforeSend  : beforeSendFile,
           uploadProgress : uploadProgress,
           complete: complete,
           beforeSubmit: function() {
           return $('#contactform').validate().form();
           },
         };

        $('#contactform').ajaxForm(options);

        var bar = $('.bar');
        var percent = $('.percent');
        var status = $('#status');
        var progress = $('#progress');

        $( "#publish_date" ).datepicker({ changeYear: true, changeMonth: false, dateFormat: "yy-mm-dd" });


        function beforeSendFile() {

           progress.show();
           status.empty();
           var percentVal = '0%';
           bar.width(percentVal)
           percent.html(percentVal);
        };

        function uploadProgress(event, position, total, percentComplete) {
          var percentVal = percentComplete + '%';
          bar.width(percentVal)
          percent.html(percentVal);
		      //console.log(percentVal, position, total);
        };

        function complete(xhr) {
		       bar.width('100%');
           percent.html('100%');
          if (xhr.responseText.substring(0,8) != '{"result') {
                $('#result').html(xhr.responseText);
                $('#result').show();
              }
              else {
                var result = jQuery.parseJSON(xhr.responseText);
                $('#result').html(result.msg);
                $('#result').show();
              }
	      };

        function showResponse(responseText, statusText, xhr, $form) {


        };


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

      }); // fin function ready



  </script>

  <style>

       .progress {
          position:relative;
          width:400px;
          border: 1px solid #ddd;
          padding: 1px;
          border-radius: 3px;
          display: none;
          margin-left: 174px;
        }
       .bar { background-color: #B4F5B4; width:0%; height:20px; border-radius: 3px; }
       .percent { position:absolute; display:inline-block; top:3px; left:48%; }

       #contactform {

       background-color:#ADC7DC;
       border:4px solid #90B2CF;
       padding:7px;
       width: 730px;
       margin-left: auto;
	     margin-right: auto;
       font:14px Arial, sans-serif;
       position: relative;
    }


    #result {
      color: red;
      font-weight: bold;
      font-size: 16px;
      position: absolute;
      left: 465px !important;
      padding-top: 2px !important;
      text-align: left !important;
    }


    #contactform .labelfield {
     width: 170px;
     font-size: 16px;
     display: inline-block;
    }


    #contactform input {
      font-size: 16px;
    }

    #contactform select {
      font-size: 16px;
      width: 275px;
    }

    #contactform #fromemail {
     width: 270px;
    }

    #contactform #subject {
     width: 270px;
    }

    #contactform #publish_event {
     margin-left: 4px;
    }

    #contactform #publish_main {
     margin-left: 4px;
    }

    #contactform #file_upload {
     margin-left: 3px;
    }

    #contactform #publish_date {
     margin-left: 4px;
     width: 125px;
    }


#contactform input.error {
   border: 2px solid red;
}
    #contactform p {
      margin: 0;
      padding:0;
      padding-bottom: 4px;
    }

    #contactform button {
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

    #contactform button:hover {background:#f49000;}

    #htmldiv {
      display: inline-block;
      padding-left:4px;
    }


  </style>

  </head>

<body>

    <?php
      $mnuIdSelected='#mnucontact';
      include 'menu.php';
    ?>

    <p>&nbsp;</p>

    <form id="contactform" action="sendmail.php" method="post" enctype="multipart/form-data">

      <div id="result"></div>

       <p>
         <label class="labelfield" for="fromemail">Courriel de</label>
         <input type="text" class="required" name="fromemail" <?php echo 'value="' .$_SESSION['profil']['email'] .'"'; ?> id="fromemail">
      </p>

      <p>
         <label class="labelfield" for="subject">Sujet du message</label>
         <input type="text" class="required" name="subject" id="subject">
      </p>

      <p>
         <label class="labelfield" for="toemail">Message pour</label>
         <select class="required" name="toemail" id="toemail">
            <?php
            if ($_REQUEST['members'] != '1') {
             ?>
                <option value="normand@clubtransportfob.com">Normand Ouelette, Co-Président, Trésorier</option>
                <option value="egirard@locweld.com">Eric Girard, Co-Président</option>
                <option value="samu1480@gmail.com">Samuel Lévesque, Vice-Président, Terrain</option>
                <option value="milhom@videotron.ca">Yves Milette, Secrétaire</option>
                <option value="chuneault@gmail.com">Carl Huneault,  Webmaster</option>
                <option value="huneaultp@yahoo.ca">Pierre Huneault, Photographe</option>
            <?php
            }
            if ($_SESSION['security'] > 1) {
              echo '<option value="allmembers">Tous les membres du club</option>';
              echo '<option value="allmemberspublic">Membres avec courriel public seulement</option>';
            }

            ?>

         </select>
      </p>
      <label class="labelfield" style="float: left;">Message</label>
      <div id="htmldiv">
        <textarea name="messagebox" id="messagebox"></textarea>
      </div>
       <?php
       if ($_SESSION['security'] > 1) {
         echo '<div><label class="labelfield">Fichier(s) attaché(s) au courriel:</label>';
         echo '<input type="file" name="myfile[]" multiple id="file_upload"></div>';
       }
      ?>
      <p></p>


      <?php
        if (($_REQUEST['members'] == '1') && ($_SESSION['security'] > 1)) {
          echo '<p><label class="labelfield" for="publish_event">Publier le courriel dans événements</label>';
          echo '<input type="checkbox" name="publish_event" id="publish_event" value="1" /></p>';
          echo '<p><label class="labelfield" for="publish_date">Date de l\'événement</label>';
          echo '<input type="text" name="publish_date" id="publish_date"></p>';
          echo '<p><label class="labelfield" for="publish_main">Publier dans l\'accueil</label>';
          echo '<input type="checkbox" name="publish_main" id="publish_main" value="1" /></p>';
        }
      ?>

      <div class="progress" id="progress">
        <div class="bar"></div >
        <div class="percent">0%</div >
      </div>
      <div id="status"></div>
      <button type="submit" name="submitform" id="submitform"  tabindex="1003">Envoyer</button>
    </form>

</body>

</html>