<?php
/**
 * Created by PhpStorm.
 * User: Carl
 * Date: 2015-01-28
 * Time: 14:26
 */

require("constant.php");
connectClubMarsDb();

$result = mysql_query('delete from events where event_id = ' .$_POST['id']) or die(mysql_error());

mysql_close();

if ($result)
  echo "ok";
else
  echo $result;
