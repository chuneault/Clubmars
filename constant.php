<?php

   // Set Connection Data

    $connection = null;

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

        global $connection;
         // Establish Connection
        $connection = mysqli_connect($servername, constant::user, constant::password, constant::dbName) or
            exit('MySQL Server could not be reached');

        $connection ->set_charset("utf8");
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