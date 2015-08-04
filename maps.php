<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
?>

<head>

	
	<title>Club Mars RC - Terrain</title>
	<link rel="stylesheet" type="text/css" href="mainstyle.css" /><!-- jQuery library - I get it from Google API's -->

	<script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
	<script src="js/jquery-ui-1.8.18.custom.min.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="css/dot-luv/jquery-ui-1.8.18.custom.css" />

	<script type='text/javascript' src='js/jquery.qtip-1.0.0-rc3.min.js'></script>

	<script type="text/javascript">


		$(document).ready(function() {


		});

	</script>



</head>

<body>

  <?php
	$mnuIdSelected='#mnumaps';
	include 'menu.php';
  ?>

  <p>&nbsp;</p>


  <div class="maincontent">

	<div class="mainpanel" style="width: 800px">
	   <div class="content">
	     <h1>Installations</h1>
		 <p>&nbsp;</p>
		 <div>
		    <div>
			<p>Nos installations sont situés le long de l&#39;autoroute 640 entre Repentigny et Terrebonne. &nbsp;</p>
			<p>&nbsp;</p>
			<p><a href="http://maps.google.ca/maps?hl=en&amp;ie=UTF8&amp;ll=45.726412,-73.551933&amp;spn=0.002573,0.004372&amp;t=h&amp;z=18" onclick="window.open(this.href, 'ClubMarsInstallations', 'resizable=no,status=no,location=no,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no'); return false;">Installations du club Mars sur Google Maps</a></p>
			<p>&nbsp;</p>
			<p>Les installations du club comprenent :</p>
			<p>&nbsp;</p>
			<p>&bull; Une piste gazonnée de 70&#39; x 550&#39;. &nbsp;Le gazon est gardé très court et tondu au moins une fois par semaine</p>
			<p>&bull; Une aire de vol pour hélicoptère&nbsp;</p>
			<p>&bull; 5 postes de pilotage pour avions</p>
			<p>&bull; 1 poste de pilotage pour hélicoptère</p>
			<p>&bull; Cabane contenant le paneau des fréquences ainsi que des tablettes pour déposer les télécommandes</p>
			<p>&bull; Aire de repos et repas, contenant 5 tables ainsi qu&#39;un espace pour faire un feu</p>
			<p>&bull; Aire de jeu pour les enfants</p>
			<p>&bull; Stationnement pouvant contenir environ 70 autos</p>

			<p>&nbsp;</p><p><img alt="" src="images/terrain//Piste_0.jpg" style="margin-left: 10px; margin-right: 10px; margin-top: 10px; margin-bottom: 10px; width: 300px; height: 200px; " title="" /><img alt="" src="images/terrain//Pit2_0.jpg" style="margin-left: 10px; margin-right: 10px; margin-top: 10px; margin-bottom: 10px; width: 300px; height: 200px; " title="" /></p><p><img alt="" src="images/terrain//Heli_0.JPG" style="margin-left: 10px; margin-right: 10px; margin-top: 10px; margin-bottom: 10px; width: 300px; height: 201px; " title="" /><img alt="" src="images/terrain//Pit_0.jpg" style="margin-left: 10px; margin-right: 10px; margin-top: 10px; margin-bottom: 10px; width: 300px; height: 200px; " title="" /></p><p style="text-align: center; "><img alt="" src="images/terrain//Playground_0.jpg" style="margin-left: 10px; margin-right: 10px; margin-top: 10px; margin-bottom: 10px; width: 300px; height: 199px; " title="" /></p>
			</div>
             <p>&nbsp;</p>
		 </div>

	   </div>
	</div>

  </div>

</body>
</html>
