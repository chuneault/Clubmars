<?php
 header('Content-Type: text/html; charset=utf-8');
 session_start();
?>

<head>

  <title>Club Mars RC - Membres</title>

  <link rel="stylesheet" type="text/css" href="mainstyle.css" />

  <script src="js/jquery-2.1.3.min.js" type="text/javascript"></script>
  <script src="js/jquery-ui-1.9.1.custom.min.js" type="text/javascript"></script>
  <link rel="stylesheet" type="text/css" href="css/dot-luv/jquery-ui-1.8.18.custom.css" />

  <script type="text/javascript" src="js/clubmars_utils.js"></script>

   <script src="extra/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
   <link rel="stylesheet" type="text/css" href="extra/bootstrap/css/bootstrap.min.css" />

   <script src="extra/bootgrid/jquery.bootgrid.js" type="text/javascript"></script>
   <link rel="stylesheet" type="text/css" href="extra/bootgrid/jquery.bootgrid.min.css" />


    <script type="text/javascript">

      $(document).ready(function(){

          $("#grid-data").bootgrid({
              ajax: true,
              post: function ()
              {
                  /* To accumulate custom parameter with the request object */
                  return {
                      id: "b0df282a-0d67-40e5-8558-c9e93b7befed"

                  };
              },
              //rowCount: 25,
              url: "php/get_members.php",
              formatters: {
                  "link": function(column, row)
                  {
                      return "<a href=\"#\">" +row.email + "</a>";
                  }
              }
          });


      });


  </script>

</head>

<body>

   <?php
       $mnuIdSelected='';
       include 'menu.php';
    ?>


<div>

    <table id="grid-data" class="table table-condensed table-hover table-striped">
        <thead>
        <tr>
            <th data-column-id="id" data-type="numeric">ID</th>
            <th data-column-id="first_name">Prénom</th>
            <th data-column-id="last_name">Nom</th>
            <th data-column-id="email" data-formatter="link" data-sortable="false">Courriel</th>
        </tr>
        </thead>
    </table>

</div>

</body>