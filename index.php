<?php
 header('Content-Type: text/html; charset=utf-8');
 session_start();
?>

<head>
  <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE"/>
  <META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE"/>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />

  <title>Club Mars RC - Photos</title>

  <link rel="stylesheet" type="text/css" href="mainstyle.css" />

  <script src="js/jquery-2.1.3.min.js" type="text/javascript"></script>
  <script src="js/jquery-ui-1.9.1.custom.min.js" type="text/javascript"></script>
  <link rel="stylesheet" type="text/css" href="css/dot-luv/jquery-ui-1.8.18.custom.css" />

  <link rel="stylesheet" href="css/nivo-slider/default/default.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="css/nivo-slider/nivo-slider.css" type="text/css" media="screen" />

  <script type="text/javascript" src="js/jquery.nivo.slider.pack.js"></script>

   <script type="text/javascript">

   $(document).ready(function(){

    /* $("#specialdialog").dialog({
       autoOpen: true,
       modal: true,
	   position: "top",
	   width: 520,
	   open: function(){
            jQuery('.ui-widget-overlay').bind('click',function(){
                jQuery('#specialdialog').dialog('close');
            })
        }
     }); */

	 }
   );
  </script>

</head>

<body>

    <?php
       global $showHeaderPhoto;
       $showHeaderPhoto = true;
       $mnuIdSelected='#mnuhome';
       include 'menu.php';
    ?>

<div class="maincontent">

  <div class="maindiv">

  <?php

    require("constant.php");

    connectClubMarsDb();

    $result = mysqli_query($connection, 'select * from events where active = 1 and show_main_page = 1 order by event_date desc;') or die(mysqli_error($connection));

    while ($row = mysqli_fetch_assoc($result)) {
      echo "<div class=\"mainpanel\">\n";
      echo "  <div class=\"content\">\n";
      echo "	  <h1>" .$row['title']  ."<label>" .$row['event_date']   ."</label></h1>\n";
      echo "    <div class=\"contentdesc\">\n";
      echo "	  " .$row['description'] ."\n";
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

   </div>

   <div class="rightdiv">

     <div class="eventdiv">
        <!-- <img src="images/funfly2013.jpg" alt="" style="width: 275px"  /> /!-->
     </div>


     <div class="meteodiv">
       <iframe marginheight="0" marginwidth="0" name="wxButtonFrame" id="wxButtonFrame" height="163" src="http://btn.meteomedia.ca/weatherbuttons/template7.php?placeCode=CAQC0750&category0=Cities&containerWidth=180&btnNo=&backgroundColor=blue&multipleCity=0&citySearch=0&celsiusF=C" align="top" frameborder="0" width="180" scrolling="no" allowTransparency="true"></iframe>
     </div>

     <div class="sponserdiv">
        <div class="slider-wrapper theme-default">
            <div id="slider" class="nivoSlider">
               <a href="http://www.amr-rc.com" target="_blank"><img src="images/commandite/amrcarte.jpg" alt=""/></a>
               <a href="http://www.ndheli.com" target="_blank"><img src="images/commandite/ndheli.png" alt=""/></a>
               <a href="http://www.anonyme-gis.com" target="_blank"><img src="images/commandite/anonyme.png" alt=""/></a>
               <a href="http://www.yellowpages.ca/bus/Quebec/Pointe-Claire/Ted-s-Hobby-Shop/2572544.html" target="_blank"><img src="images/commandite/teds.jpg" alt=""/></a>
               <a href="http://www.distributionauxmodelistes.com" target="_blank"><img src="images/commandite/DistMod.png" alt=""/></a>
               <a href="http://www.zonehobbies.net" target="_blank"><img src="images/commandite/zonehobbies.jpg" alt=""/></a>
            </div>
        </div>
     </div>

   </div>

</div>

<div id="specialdialog" title="N'oubliez pas le Fun Fly, 10 et 11 août !!">
   
   <!--  <img src="images/funfly2013.jpg" alt="" style="height: 700px"  /> /!-->
   
</div>

 <script type="text/javascript">

    $(window).load(function() {
        $('#slider').nivoSlider({
          effect: 'random', // Specify sets like: 'fold,fade,sliceDown'
          directionNav: true, // Next & Prev navigation
          directionNavHide: true, // Only show on hover
          controlNav: false, // 1,2,3... navigation
          pauseOnHover: true, // Stop animation while hovering
          prevText: 'Prev', // Prev directionNav text
          nextText: 'Next', // Next directionNav text
          randomStart: true // Start on a random slide
         }
        );
    });
 </script>


</body>
