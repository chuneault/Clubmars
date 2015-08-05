<?php
/**
 * Created by PhpStorm.
 * User: Carl
 * Date: 2015-01-28
 * Time: 14:26
 */

require("constant.php");
connectClubMarsDb();

$result = mysqli_query($connection, 'delete from events where event_id = ' .$_POST['id']) or die(mysqli_error($connection));

mysqli_close($connection );

if ($result)
  echo "ok";
else
  echo $result;
