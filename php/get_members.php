<?php
/**
 * Created by PhpStorm.
 * User: Carl
 * Date: 2015-01-28
 * Time: 20:32
 */

require("../constant.php");

connectClubMarsDb();

$result = mysqli_query($connection, 'select * from members order by last_name DESC') or die(mysqli_error($connection));
$data = new StdClass;

$memberList = array();

$rowCount = 0;
$pageCount = 1;
$rowTotal = 0;

$maxRowCount = $_POST['rowCount'];
$beginPage = (int) $_POST['current'];

while ($row = mysqli_fetch_assoc($result)) {
    if ($pageCount == $beginPage)  {
      $member = new StdClass;
      $member->id = $row['member_id'];
      $member->first_name = $row['first_name'];
      $member->last_name = $row['last_name'];
      $member->email = $row['email'];
      $memberList[] = $member;
    }
    $rowTotal = $rowTotal + 1;
    $rowCount = $rowCount+1;
    if ($rowCount >= $maxRowCount) {
        $pageCount = $pageCount+1;
        $rowCount = 1;
    }
}


$data->rows = $memberList;
$data->current = $beginPage;
$data->total = $rowTotal;

echo json_encode($data);

mysqli_free_result($result);
mysqli_close($connection);