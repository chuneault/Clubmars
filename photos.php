<?php
  header('Content-Type: text/html; charset=utf-8');
  session_start();
?>

<head>
   <title>Club Mars RC - Photos</title>

   <link rel="stylesheet" type="text/css" href="mainstyle.css" />

    <script src="js/jquery-2.1.3.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui-1.9.1.custom.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="css/dot-luv/jquery-ui-1.8.18.custom.css" />


    <script src="js/jquery.blockUI.js" type="text/javascript"></script>
    <script src="js/jquery.pwi.js" type="text/javascript"></script>
	<link   href="css/pwi.css" rel="stylesheet" type="text/css"/>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#photosph").pwi({
                username: 'huneaultp',
				albumThumbSize: 128,
				thumbSize: 144,
				labels: { slideshow: 'Voir en diaporama',
                          albums   : 'Retour aux albums',
					      prev     : 'Précédent',
					      next     : 'Suivant'
                        }
            });
        });
    </script>

</head>

<body>

    <?php
      $mnuIdSelected='#mnuphotos';
      include 'menu.php';
    ?>

      <p>&nbsp;</p>

	  <div id="photosph">
	  </div>


</body>

