<?php

include_once "../base.php";
$db = new DB('news');
$row = $db->find($_GET['id']);

echo "<pre>";
echo $row['text'];
echo "</pre>";


?>