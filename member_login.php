<?php
   session_start();
   $_SESSION = array();
?>
 <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE"/>
 <META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE"/>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <link rel="stylesheet" type="text/css" href="css/loginmodal.css" />
 <script type="text/javascript" src="js/jquery.validate.min.js"></script>
 <link rel="stylesheet" type="text/css" href="css/dot-luv/jquery-ui-1.8.18.custom.css" />
 <script type="text/javascript">


 function submitlogin() {

    /* Send the data using post and put the results in a div */
    $.post('login.php', $("#loginform").serialize(),
       function(data) {
        debugger;
        if (data.substring(0,8) != '{"result') {
          $('#resultloginmember').html(data);
          $('#resultloginmember').show();
        }
        else {
          var result = jQuery.parseJSON(data);
          if (result.result == 'true') {
              window.memberLogin = true;
              $('#dialog').dialog('close');
          }
          else  {
            $('#resultloginmember').html(result.msg);
            $('#resultloginmember').show();
          }
        }
       }

    );

 }

  $().ready(function(){

       $("#loginform").validate({

           errorElement: "p",
           errorLabelContainer: "#resultloginmember",
           submitHandler: function(form) { submitlogin(); },
           messages: {
                username: "Veuillez inscrire un utilisateur",
                password: "Le mot de passe doit contenir 4 caratères minimun"
                }
        }
       );

 });
 </script>

<div id="login-modal">

    <form id="loginform" method="POST">
       <p>
         <label class="labelfield" for="username">Utilisateur:</label>
         <input type="text" id="username" name="username" class="required ui-widget-content" tabindex="1001">
       </p>
       <p>
         <label class="labelfield" for="password">Mot de passe:</label>
         <input type="password" id="password" name="password"  class="required ui-widget-content" tabindex="1002" minlength="4">
       </p>
       <button type="submit" name="submit" value="submit" tabindex="1003">Entrer</button>
       <button type="button" onclick="$('#dialog').dialog('close');" tabindex="1004">Annuler</button>
    </form>
    <div id="resultloginmember"></div>
</div>
