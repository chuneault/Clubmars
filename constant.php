<?php

   // Set Connection Data

    class constant {
      const database = 'clubm532_master';      // Database name.
      const user = 'clubm532_admin';        // Username to access the database.
      const password = 'spektrumdx8';      // Password for the user.
      const server = 'localhost';      // Server address.
      const dbName = 'clubm532_master';
    }

    function connectClubMarsDb() {

    $servername = constant::server;

    $servername =  'clubmars.org';


     // Establish Connection
    $connection = mysql_connect($servername, constant::user, constant::password) or
        exit('MySQL Server could not be reached');

    // Select a Database
    if(!mysql_select_db(constant::dbName))
        exit();
    }

    function prepareJsStringLiteral( $stringLiteral, $mode )
{
    switch ( $mode )
    {
        case ESCAPE_MODE_DOUBLE:
                $searches = array( '"', "\n" );
                $replacements = array( '\\"', "" );
                break;
        case ESCAPE_MODE_SINGLE:
                $searches = array( "'", "\n" );
                $replacements = array( "\\'", "" );
                break;
    }
    return str_replace( $searches, $replacements, $stringLiteral );
}


?>