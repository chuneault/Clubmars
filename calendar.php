<?php
 header('Content-Type: text/html; charset=ISO-8859-1');
 session_start();
?>

  <!DOCTYPE HTML>
  <head>

    <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
    <META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />

    <title>Club Mars RC - Calendriers</title>
    <link rel="stylesheet" type="text/css" href="mainstyle.css" /><!-- jQuery library - I get it from Google API's -->

    <script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui-1.8.18.custom.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="css/dot-luv/jquery-ui-1.8.18.custom.css" />


    <script type='text/javascript' src='js/fullcalendar.min.js'></script>
    <script type='text/javascript' src='js/gcal.js'></script>

    <script type='text/javascript' src='js/jquery.qtip-1.0.0-rc3.min.js'></script>

    <link rel="stylesheet" type="text/css" href="css/fullcalendar.css" />
    <link rel="stylesheet" type="text/css" href="css/fullcalendar.print.css" media="print" />

   <link rel="stylesheet" type="text/css" href="cupertino/theme.css" />



    <script type="text/javascript">


	  $(document).ready(function() {


		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();

		$('#calendar').fullCalendar({
			theme: true,
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			editable: false,
      monthNames: ['Janvier', 'F&eacute;vrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet',
                      'Ao&ucirc;ut', 'Septembre', 'Octobre', 'Novembre', 'D&eacute;cembre'],
      buttonText:{
                    today:    "aujourd'hui",
                    month:    'mois',
                    week:     'semaine',
                    day:      'jour'
                 },
      eventSources: ['http://www.google.com/calendar/feeds/fr.canadian%23holiday%40group.v.calendar.google.com/public/basic'],

      events:

       <?php

        require_once("constant.php");

        connectClubMarsDb();

        $eventslist = array();


        $result = mysql_query('select * from calendar;') or die(mysql_error());
        while ($row = mysql_fetch_assoc($result)) {

           $eventslist[] = array(
                    'title' => utf8_encode($row['event_name']),
                    'color' => '#0A0C73',
                    'textColor' => 'white',
                    'start' =>  $row['event_date'],
                    'url' => 'events.php',
                    'description' => utf8_encode($row['event_desc'])
                   );
        }


        mysql_free_result($result);

        //séance de formation
        $result = mysql_query('select trainsessions.*, members.member_color, members.first_name, members.last_name from trainsessions, members where trainsessions.member_id = members.member_id;') or die(mysql_error());
        while ($row = mysql_fetch_assoc($result)) {
            $eventslist[] = array(
                    'title' => 'Formation',
                    'color' => '#' .$row['member_color'],
                    'textColor' => 'white',
                    'start' =>  $row['start_date'],
                    'url' => 'trainsession.php?sessionId=' .$row['session_id'],
                    'description' => 'Formation donnée par ' .utf8_encode($row['first_name']) .' à partir de ' .$row['start_time']
                   );
        }

        mysql_free_result($result);
        mysql_close();

        echo json_encode($eventslist);

       ?>
     ,
     eventRender: function(event, element) {
        element.qtip({
            content: event.description
        });
    }

		});

	});

  </script><!-- Styles for my specific scrolling content -->

    <style type="text/css">
      #calendar {
		    width: 600px;
		    margin: 0 auto;
		  }
    </style>


  </head>

<body>

    <?php
      $mnuIdSelected='#mnucalendar';
      include 'menu.php';
    ?>

    <p>&nbsp;</p>

    <div id="calendar">&nbsp;</div>
</body>

</html>