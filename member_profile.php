<?php
 session_start();

?>

  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
  <link rel="stylesheet" type="text/css" href="css/memberprofilemodal.css" />
  <script src="js/jquery-2.1.3.min.js" type="text/javascript"></script>
  <script type="text/javascript" src="js/jquery.validate.min.js"></script>
  <script type="text/javascript" src="js/jquery.json-2.3.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/dot-luv/jquery-ui-1.8.18.custom.css" />

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
       echo "$(\"#tabs-3\").hide();\n";
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

    $member = mysql_query('select * from members where member_username = "' . $_SESSION['profil']['member_username'] . '"') or die(mysql_error());


    if($row = mysql_fetch_assoc($member))
    {
       echo 'var member = ' . json_encode($row) . ';';
    }
    else
    {
    }

    mysql_free_result($member);
    mysql_close();

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
            if (data.substring(0,8) != '{"result') {
              $('#resultinstructor').html(data);
              $('#resultinstructor').show();
            }
            else {
              var result = jQuery.parseJSON(data);
              $('#resultinstructor').html(result.msg);
              $('#resultinstructor').show();
            }
       }
    );
 }

 function submitupdate() {
    debugger;
    $.post('update.php', $("#memberform").serialize(),
       function(data) {
           debugger;
            if (data.substring(0,8) != '{"result') {
              $('#memberform #resultmember').html(data);
              $('#memberform #resultmember').show();
            }
            else {
              var result = jQuery.parseJSON(data);
              $('#memberform #resultmember').html(result.msg);
              $('#memberform #resultmember').show();

            }
       }
    );
 }


 function submitupdateprofil() {
  $.post('update.php', $("#profilform").serialize(),
       function(data) {
         if (data.substring(0,8) != '{"result') {
              $('#resultprofil').html(data);
              $('#resultprofil').show();
            }
            else {
              debugger;
              var result = jQuery.parseJSON(data);
              $('#resultprofil').html(result.msg);
              $('#resultprofil').show();

            }
       }
    );
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

 });



  //AutoComplete
  $(function() {

    $( "#tabs" ).tabs();

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


   <div id="tabs">
	  <ul>
		  <li><a href="#tabs-1">Info Personnel</a></li>
		  <li><a href="#tabs-2">Profil Internet</a></li>
		  <?php
             if ($_SESSION['profil']['instructor'] != 0) {
               echo "<li><a href=\"#tabs-3\">Profil Instructeur</a></li>\n";
             }
          ?>
	  </ul>

    <div id="tabs-1">
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

    <div id="tabs-2">
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

   <div id="tabs-3">
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