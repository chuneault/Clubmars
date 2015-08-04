      jQuery(function ($) {

          var login = {
            message: null,
            init: function () {
              $('#mnu_member').click(function (e) {

               e.preventDefault();

               //$("div#makeMeScrollable").smoothDivScroll("stopAutoScrolling");

                // load the contact form using ajax
               $.get("member_login.php", function(data){
                    $('#mnumember').val('1');
                    menuSlider.init('menu','slide');
                    $('#dialog').html(data);
                    $('#dialog').attr('title',"Connnection Membre");
                    $( "#dialog" ).dialog({
		                	autoOpen: true,
			                show: "blind",
			                hide: "blind",
                      modal: true,
                      position: [578,174],
                      resizable: false,
                      closeOnEscape: false,
                      width: 300,
                      close: function(event, ui) { setTimeout('window.location.reload()', 250); },
                      open: function(event, ui) {  }
		                });


                });
              });
            }
         }


         login.init();

         var member = {
            message: null,
            init: function () {
              $('#memberprofil').click(function (e) {

               e.preventDefault();

               $('#liprofil').addClass("jq-current");

              // $("div#makeMeScrollable").smoothDivScroll("stopAutoScrolling");

               $.get("member_profile.php", function(data){
                    $('#dialog').html(data);
                    $('#dialog').attr('title',"Informations du membre");

                    $( "#dialog" ).dialog({
		                	autoOpen: true,
			                show: "blind",
			                hide: "explode",
                      modal: true,
                      closeOnEscape: false,
                      width: 610,
                      resizable: false,
                      close: function(event, ui) { $('#liprofil').removeClass("jq-current"); }

		                });
                });
              });
            }
         }

         member.init();

     });

  function closeSession() {
           $$SESSION = [];
           $.post("login.php", { fonction: "close" } );
           setTimeout('window.location = "index.php";', 100);
         }