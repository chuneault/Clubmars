
<link rel="stylesheet" type="text/css" href="css/smoothDivScroll.css" />
<link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />


<script src="js/jquery.mousewheel.min.js" type="text/javascript"></script>

<script src="js/menu.js" type="text/javascript"></script>
<script src="mainmenu.js" type="text/javascript"></script>

<script src="js/jquery.prettyPhoto.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" href="css/loginmodal.css" />
<link rel="stylesheet" type="text/css" href="css/memberprofilemodal.css" />


<script type="text/javascript">

    String.prototype.format = function (col) {
        col = typeof col === 'object' ? col : Array.prototype.slice.call(arguments, 0);
        return ("" + this).replace(/\{\{|\}\}|\{(\w+)\}/g, function (m, n) {
            if (m == "{{") { return "{"; }
            if (m == "}}") { return "}"; }
            return col[n];
        });
    };

    String.prototype.beginsWith = function (string) {
        if (this)
            return( ("" + this).substr(0,string.length) == string);
        else
            return '';
    };


    $(document).ready(function(){

    debugger;

    $$SESSION =
       <?php
         echo json_encode($_SESSION, JSON_PRETTY_PRINT)
       ?>;


    if (($$SESSION) && ($$SESSION.profil)) {
      $('#mnu_member').hide();
      $('.jq-member').text($('.jq-member').text().format($$SESSION.profil.first_name,$$SESSION.profil.last_name));
      $$SESSION.profil.instructor != 0 ? $('.trainer').show() : $('.trainer').hide();
      $$SESSION.security >=2 ? $('.seclevel2').show() : $('.seclevel2').hide();
      $('#jq-membernav').show();
    }
    else {
      $('#mnu_member').show();
      $('#jq-membernav').hide();
    }

    menuSlider.init('menu','slide');
    <?php global $showHeaderPhoto; if($showHeaderPhoto==true): ?>
      $("a[rel^='prettyPhoto']").prettyPhoto({
        animationSpeed: 'normal',
        opacity: 0.80,
        showTitle: false
      });
    <?php endif; ?>

  }
 );

<?php global $showHeaderPhoto; if($showHeaderPhoto==true): ?>
   // Initialize the plugin with no custom options
   $(window).load(function() {

       debugger;

       /*
       $("div#makeMeScrollable").smoothDivScroll({

        //startAtElementId: "startAtMe",
        mousewheelScrolling: true,
        mousewheelScrollingStep: 70,
        easingAfterMouseWheelScrollingDuration: 300,
        easingAfterMouseWheelScrollingFunction: 'easeOutQuart',

        autoScrollingInterval: 15,
        autoScrollingStep: 1,
        autoScrollingMode: "",
        autoScrollingDirection: "endlessloopright",

        easingAfterHotSpotScrolling: true,
        easingAfterHotSpotScrollingDistance: 25,
        easingAfterHotSpotScrollingDuration: 300,
		easingAfterHotSpotScrollingFunction: 'easeOutQuart',
		hiddenOnStart: false,
		scrollToEasingDuration: 2000
		});

			 $("div#makeMeScrollable").smoothDivScroll("startAutoScrolling");*/

	   });

       /*function startScrool() {
         $("#makeMeScrollable").smoothDivScroll("startAutoScroll");
       };*/

 <?php endif; ?>

</script>

  <div id="jq-membernav">
    <div class="jq-member">Bienvenue {0}, {1}</div>
      <ul>
          <li id="liprofil" class=""><a href="http://jquery.com/" id="memberprofil" title="Profil du membre"><img src="images/btnprofil.png"></a></li>
          <li id="mnuevents"><a href="events.php"><img src="images/btnevents.png"></a> </li>
          <li id="mnuphotos"><a href="photos.php"><img src="images/btnphotos.png"></a> </li>
          <li id="mnumembers seclevel2"><a href="members.php"><img src="images/btnmembers.png"></a> </li>
          <li class="jq-borderright seclevel2"><a href="contact2.php?members=1" title="Contacter"><img src="images/btnemailmember.png"></a></li>
          <li class=""><a href="#" onclick="closeSession();" title="Fermer"><img src="images/btnclose.png"></a></li>
      </ul>
  </div>

<div id="dialog" style="display: none">
</div>


 <div id="top">
   <img class="clublogo" src="images/Logo3.png" height="100px" alt="Club Mars">

     <a class="btnloginmember" id="mnu_member" href="#"><img src="images/login_member.png"></a>
     <a class="btnfacebook" id="mnufacebook" href="https://www.facebook.com/pages/Club-Mars-Inc/717910474972803"><img src="images/btnfacebook.png"></a>

   <div class="menu">
     <ul id="menu">
        <li id="mnuhome"><a href="index.php">Accueil</a> </li>
         <li id="mnuforms"><a href="formulaires.php">Formulaires</a> </li>
         <li id="mnuexecutif"><a href="executif.php">Ex&eacute;cutif</a> </li>
         <li id="mnumaps"><a href="maps.php">Terrain</a> </li>
         <li id="mnumeteostation"><a href="meteostation.php">Station Météo</a> </li>

         <li id="mnucontact"><a href="contact2.php">Nous Contacter</a> </li>
         <!--
         <li id="mnucalendar"><a href="calendar.php">Calendrier</a> </li>
           <li id="mnuphotos"><a href="photos.php">Photos</a> </li>
           <li id="mnuevents"><a href="events.php">&Eacute;v&eacute;nements</a> </li>
         !-->
      </ul>
      <div id="slide"></div>
    </div>
  </div>

<script type="text/javascript">
<?php
 echo '  $(\''. $mnuIdSelected . '\').val(\'1\');';
?>
</script>

<?php if($showHeaderPhoto==true): ?>

<div style="width: 100%; background: #90B2CF; height: 3px;">&nbsp; </div>
  <div id="makeMeScrollable">
    <a href="images/titles/Title5.jpg" rel="prettyPhoto[gallery1]"><img src="images/titles/Title5.jpg" height="130" alt="" /></a>
        <a href="images/titles/Title1.jpg" rel="prettyPhoto[gallery1]"><img src="images/titles/Title1.jpg" height="130" alt=""/></a>
        <a href="images/titles/Title2.jpg" rel="prettyPhoto[gallery1]"><img src="images/titles/Title2.jpg" height="130" alt=""/></a>
        <a href="images/titles/Title3.jpg" rel="prettyPhoto[gallery1]"><img src="images/titles/Title3.jpg" height="130" alt=""/></a>
        <a href="images/titles/Title4.jpg" rel="prettyPhoto[gallery1]"><img src="images/titles/Title4.jpg" height="130" alt=""/></a>
        <a href="images/titles/Title7.jpg" rel="prettyPhoto[gallery1]"><img src="images/titles/Title7.jpg" height="130" alt=""/></a>
        <a href="images/titles/Title6.jpg" rel="prettyPhoto[gallery1]"><img src="images/titles/Title6.jpg" height="130" alt="" id="startAtMe" /></a>
        <a href="images/titles/Title5.jpg" rel="prettyPhoto[gallery1]"><img src="images/titles/Title5.jpg" height="130" alt=""/></a>
        <a href="images/titles/Title1.jpg" rel="prettyPhoto[gallery1]"><img src="images/titles/Title1.jpg" height="130" alt=""/></a>
        <a href="images/titles/Title2.jpg" rel="prettyPhoto[gallery1]"><img src="images/titles/Title2.jpg" height="130" alt=""/></a>
        <a href="images/titles/Title3.jpg" rel="prettyPhoto[gallery1]"><img src="images/titles/Title3.jpg" height="130" alt=""/></a>
        <a href="images/titles/Title4.jpg" rel="prettyPhoto[gallery1]"><img src="images/titles/Title4.jpg" height="130" alt=""/></a>
        <a href="images/titles/Title7.jpg" rel="prettyPhoto[gallery1]"><img src="images/titles/Title7.jpg" height="130" alt=""/></a>
        <a href="images/titles/Title6.jpg" rel="prettyPhoto[gallery1]"><img src="images/titles/Title6.jpg" height="130" alt=""/></a>
	</div>
	<div style="width: 100%; background: #90B2CF; height: 3px;">&nbsp; </div>

<?php endif; ?>


<!--
<div style="position:fixed; left:0px; bottom:0px; background:url(images/hiver/snow.gif) left top repeat-x; height:247px; width:100%; z-index:-1"> </div>
!-->
<?php if($mnuIdSelected != "#mnuphotos"): ?>
<!--
  <div style="position:fixed; left:0px; bottom:160px; background:url(images/hiver/snowman.png) left top no-repeat; height:193px; width:142px; z-index:0"></div>
!-->
<?php endif; ?>

