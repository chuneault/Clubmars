<?php
 header('Content-Type: text/html; charset=utf-8');
 session_start();
?>

<head>

  <title>Club Mars RC - Station Météo</title>

  <link rel="stylesheet" type="text/css" href="mainstyle.css" />

  <script src="js/jquery-2.1.3.min.js" type="text/javascript"></script>
  <script src="js/jquery-ui-1.9.1.custom.min.js" type="text/javascript"></script>
  <link rel="stylesheet" type="text/css" href="css/dot-luv/jquery-ui-1.8.18.custom.css" />



    <script type="text/javascript">

      $(document).ready(function(){});

    </script>

</head>

<body>

   <?php
       $mnuIdSelected='#mnumeteostation';
       include 'menu.php';
    ?>


<div id="meteo-data">
  <iframe style="height: 85%; width: 100%; overflow:hidden;" scrolling="no" id="meteostation" src="http://abon.ca/WDL/index7.html"></iframe>
</div>

</body>