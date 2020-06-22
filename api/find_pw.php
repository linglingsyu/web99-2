<?php
include_once "../base.php";
$email = $_GET['email'];
$db = new DB("user");
$user = $db->find(['email'=>$email]);
if(empty($user)){
  //找不到此email
  echo "查無此資料";
}else{
  //回傳是個陣列
  echo "您的密碼為:".$user['pw'];
}

?>
