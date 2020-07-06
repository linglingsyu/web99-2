<?php

include_once "../base.php";
$db = new DB("news");
foreach ($_POST['id'] as $key=> $id){
  if(!empty($_POST['del']) && in_array($id,$_POST['del'])){
    //$_POST['del']有資料 而且  id在$_POST['del']內的才要刪除
    $db->del($id);
  }else{
    $row = $db->find($id);
    //id是不是在POST['sh']內 有是1  沒有是0
    $row['sh'] = in_array($id,$_POST['sh'])?1:0;
    //這邊如果$_POST['sh']如果是空值會報錯 , 預防的寫法如下
    //  $row['sh'] =  (!empty($_POST['del']) && in_array($id,$_POST['del'])) ? 1 : 0;
    $db->save($row);
  }
}

to("../admin.php?do=news");

?>