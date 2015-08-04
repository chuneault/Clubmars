<?php
/**
 * Created by PhpStorm.
 * User: Carl
 * Date: 2015-01-28
 * Time: 20:32
 */

require("../constant.php");

connectClubMarsDb();

$result = mysql_query('select * from members where public_email = 1 order by last_name DESC') or die(mysql_error());
$data = new StdClass;

$memberList = array();;
$rowCount = 0;

$maxRowCount = $_POST['rowCount'];
$beginRow = $_POST['current'];

while ($row = mysql_fetch_assoc($result)) {
    if (($rowCount >= $beginRow) && ($rowCount <= $maxRowCount)) {
      $member = new StdClass;
      $member->id = $row['member_id'];
      $member->first_name = utf8_encode($row['first_name']);
      $member->last_name = utf8_encode($row['last_name']);
      $member->email = utf8_encode($row['email']);
      $memberList[] = $member;
    }
    $rowCount=$rowCount+1;
}


$data->rows = $memberList;
$data->current = $beginRow;
$data->rowCount = 15;
$data->total = $rowCount;

echo json_encode($data);

mysql_free_result($result);
mysql_close();



