<?php
 session_start();

?>

  <link rel="stylesheet" type="text/css" href="css/memberprofilemodal.css" />
  <script type="text/javascript" src="js/jquery.validate.min.js"></script>
  <script type="text/javascript" src="js/jquery.json-2.3.min.js"></script>

  <script src="extra/colorpicker/jquery.colorpicker.js"></script>
  <link href="extra/colorpicker/jquery.colorpicker.css" rel="stylesheet" type="text/css"/>


  <script type="text/javascript">


  function fillFieldsValue(fieldsList, formName, member) {

      for (var id in fieldsList) {
        switch (fieldsList[id].fieldtype) {
          case 'bool':
            $('#'+fieldsList[id].fieldname, formName).attr('checked', member[fieldsList[id].fieldname] != '0');
            break;
          default:
            $('#'+fieldsList[id].fieldname, formName).val( member[fieldsList[id].fieldname]);
            break;
        }

      }
  }


  $().ready(function(){

    $("#birth_date").datepicker({ changeYear: true, changeMonth: false, dateFormat: "yy-mm-dd", yearRange: "1940:2012" });

    <?php

    if ($_SESSION['profil']['instructor'] != 1) {
       echo "$(\"#membertabs-3\").hide();\n";
    } else {
      echo "
         $('#member_color').colorpicker({
		            altField: '#member_color',
					altProperties: 'background-color'

				});
      ";
    }

    require("constant.php");
    connectClubMarsDb();

    $member = mysqli_query($connection, 'select * from members where member_username = "' . $_SESSION['profil']['member_username'] . '"') or die(mysqli_error($connection));


    if($row = mysqli_fetch_assoc($member))
    {
       echo 'var member = ' . json_encode($row) . ';';
    }
    else
    {
    }

    mysqli_free_result($member);
    mysqli_close($connection );

    ?>

    var updateFields = [{fieldname: 'first_name',         fieldtype: 'text'},
                        {fieldname: 'last_name',          fieldtype: 'text'},
                        {fieldname: 'address',            fieldtype: 'text'},
                        {fieldname: 'city',               fieldtype: 'text'},
                        {fieldname: 'postal_code',        fieldtype: 'text'},
                        {fieldname: 'home_phone',         fieldtype: 'text'},
                        {fieldname: 'public_home_phone',  fieldtype: 'bool'},
                        {fieldname: 'cell_phone',         fieldtype: 'text'},
                        {fieldname: 'public_cell_phone',  fieldtype: 'bool'},
                        {fieldname: 'birth_date',         fieldtype: 'text'}

                        ];

    fillFieldsValue(updateFields, '#memberform', member);
    $('#updatefields', '#memberform').val($.toJSON(updateFields));

    var updateFieldsProfil = [{fieldname: 'member_username',  fieldtype: 'text'},
                              {fieldname: 'email',            fieldtype: 'text'},
                              {fieldname: 'public_email',     fieldtype: 'bool'}
                             ];
    fillFieldsValue(updateFieldsProfil, '#profilform', member);
    $('#updatefieldsprofil').val($.toJSON(updateFieldsProfil));

    var updateFieldsInstructor = [{fieldname: 'member_color',  fieldtype: 'text'}
                             ];
    //fillFieldsValue(updateFieldsInstructor, '#instructorform', member);

   $('#member_color').val(member['member_color']);
   $('#member_color').css('background-color', '#' + member['member_color']);

   $('#updatefieldsinstructor').val($.toJSON(updateFieldsInstructor));

  });

 function submitupdateinstructor() {
    debugger;
    $.post('update.php', $("#instructorform").serialize(),
       function(data) {
              $('#resultinstructor').html(data.msg);
              $('#resultinstructor').show();
       }
    ).fail(function(msg) {
         debugger;
         $('#resultinstructor').html(msg.responseText);
         $('#resultinstructor').show();
     });
 }

 function submitupdate() {
    debugger;
    $.post('update.php', $("#memberform").serialize(),
       function(data) {
              $('#memberform #resultmember').html(data.msg);
              $('#memberform #resultmember').show();
            }

    ).fail(function(msg) {
            debugger;
            $('#memberform #resultmember').html(msg.responseText);
            $('#memberform #resultmember').show();
        });
 }


 function submitupdateprofil() {
  $.post('update.php', $("#profilform").serialize(),
       function(data) {
         debugger;
              $('#resultprofil').html(data.msg);
              $('#resultprofil').show();
       }
    ).fail(function(msg) {
          debugger;
          $('#resultprofil').html(msg.responseText);
          $('#resultprofil').show();
      });
 }


  $().ready(function(){

       $("#memberform").validate({
           errorElement: "p",
           errorLabelContainer: "#resultmember",
           submitHandler: function(form) { submitupdate(); },
           messages: {
                     }
        }
       );

       $("#profilform").validate({

           errorElement: "p",
           errorLabelContainer: "#resultprofil",
           submitHandler: function(form) { submitupdateprofil(); },
           messages: {
                     },
           rules: {
             confirm_password: {
                    equalTo: "#password"
                  },
             email: "email"
           }
        }
       );

        $("#instructorform").validate({
           errorElement: "p",
           errorLabelContainer: "#resultinstructor",
           submitHandler: function(form) { submitupdateinstructor(); },
           messages: {
                     }
        }
       );

      debugger;

      $("#member-profile-tabs").tabs();

      function log( message ) {
          $( "<div/>" ).text( message ).prependTo( "#log" );
          $( "#log" ).scrollTop( 0 );
      }

      $( "#city" ).autocomplete({
          source: function( request, response ) {
              $.ajax({
                  url: "http://ws.geonames.org/searchJSON",
                  dataType: "jsonp",
                  data: {
                      country: "CA",
                      featureClass: "P",
                      style: "medium",
                      maxRows: 12,
                      name_startsWith: request.term
                  },
                  success: function( data ) {
                      response( $.map( data.geonames, function( item ) {
                          return {
                              label: item.name + (item.adminName1 ? ", " + item.adminName1 : "") + ", " + item.countryName,
                              value: item.name
                          }
                      }));
                  }
              });
          },
          minLength: 2,
          select: function( event, ui ) {
              log( ui.item ?
              "Selected: " + ui.item.label :
              "Nothing selected, input was " + this.value);
          },
          open: function() {
              $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
          },
          close: function() {
              $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
          }
      });



 });



	</script>

 <div id="member-modal">


   <div id="member-profile-tabs">
	  <ul>
		  <li><a href="#membertabs-1">Info Personnel</a></li>
		  <li><a href="#membertabs-2">Profil Internet</a></li>
		  <?php
             if ($_SESSION['profil']['instructor'] != 0) {
               echo "<li><a href=\"#membertabs-3\">Profil Instructeur</a></li>\n";
             }
          ?>
	  </ul>

    <div id="membertabs-1">
      <form id="memberform" class="editform" method="POST">
       <p>
         <label class="labelfield" for="first_name">Pr&eacute;nom</label>
         <input type="text" class="required ui-widget-content" name="first_name" id="first_name">
       </p>
       <p>
         <label class="labelfield" for="last_name">Nom de famille</label>
         <input type="text" class="required ui-widget-content" name="last_name" id="last_name">
       </p>
       <p>
         <label class="labelfield" for="address">Adresse</label>
         <input type="text" class="required ui-widget-content" name="address" id="address">
       </p>
       <p>
         <label class="labelfield" for="city">Ville</label>
         <input type="text" class="required ui-widget-content" name="city" id="city">
       </p>
       <p>
         <label class="labelfield" for="postal_code">Code Postal</label>
         <input type="text" class="required ui-widget-content" name="postal_code" id="postal_code">
       </p>
       <p>
         <label class="labelfield" for="home_phone">T&eacute;l&eacute;phone maison</label>
         <input type="text" class="ui-widget-content" name="home_phone" id="home_phone" >
       </p>
       <p>
         <label class="labelfield" for="public_home_phone">T&eacute;l&eacute;phone public?</label>
         <input type="checkbox" class="ui-widget-content" name="public_home_phone" id="public_home_phone" value="1" />
       </p>
       <p>
         <label class="labelfield" for="cell_phone">Cellulaire</label>
         <input type="text" class="ui-widget-content" name="cell_phone" id="cell_phone" >
       </p>
       <p>
         <label class="labelfield" for="public_cell_phone">Cellulaire public?</label>
         <input type="checkbox" class="ui-widget-content" name="public_cell_phone" id="public_cell_phone" value="1" />
       </p>
       <p>
         <label class="labelfield" for="birth_date">Date de naissance</label>
         <input type="text" class="ui-widget-content" name="birth_date" id="birth_date" >
       </p>

        <input type="hidden" name="updatefields" id="updatefields">
        <input type="hidden" name="tablename" value="members">
        <input type="hidden" name="function" value="updateMembers">


       <button type="submit">Sauvegarder</button>
       <button type="button" onclick="$('#dialog').dialog('close');" >Quitter</button>
       <div id="resultmember" class="errordiv"></div>
      </form>

    </div>

    <div id="membertabs-2">
     <form id="profilform" class="editform" method="POST">
        <p>
         <label class="labelfield" for="member_username">Utilisateur</label>
         <input type="text" class="ui-widget-content" name="member_username" id="member_username">
       </p>

        <p>
         <label class="labelfield" for="email">Courriel</label>
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
       <button type="button" onclick="$('#dialog').dialog('close');" >Quitter</button>
       <div id="resultprofil" class="errordiv"></div>
       <input type="hidden" name="updatefields" id="updatefieldsprofil">
       <input type="hidden" name="tablename" value="members">
       <input type="hidden" name="function" value="updateProfils">

     </form>

   </div>

   <div id="membertabs-3">
     <form id="instructorform" class="editform" method="POST">
        <p>
         <label class="labelfield" for="member_color">Couleur du chandail</label>
         <input type="text" style="border: 1px solid;" name="member_color" id="member_color">
       </p>

       <input type="hidden" name="updatefields" id="updatefieldsinstructor">
       <input type="hidden" name="tablename" value="members">
       <input type="hidden" name="function" value="updateMembers">

       <p style="height: 20px"></p>
       <button type="submit">Sauvegarder</button>
       <button type="button" onclick="$('#dialog').dialog('close');" >Quitter</button>
       <div id="resultinstructor" class="errordiv"></div>
     </form>
   </div>

</div>