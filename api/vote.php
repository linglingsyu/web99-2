<?php

include_once "../base.php";
$id = $_POST['vote'];
$db = new DB("que");
$row = $db->find($id);
$subject = $db->find($row['parent']);
$row['count']++;
$subject['count']++;
$db->save($row);
$db->save($subject);
to("../index.php?do=result&q=".$subject['id']);


?>