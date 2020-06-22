<?php

include_once "../base.php";
$db = new DB("user");
// $acc = $_POST['acc'];
// $pw = $_POST['pw'];
// $email = $_POST['email'];
//因為題目其實沒要求對欄位做檢查,所以直接save就好!
echo $db->save(['acc'=>$_POST['acc'],'pw'=>$_POST['pw'],'email'=>$_POST['email']]);// 1 or 0

?>