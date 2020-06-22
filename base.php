<?php

date_default_timezone_set("Asia/Taipei");
session_start();

class DB
{
  private $dsn = "mysql:host=localhost;charset=utf8;dbname=db88";
  private $root = "root";
  private $password = "";
  private $table="";
  private $pdo;

  public function __construct($table){
    $this->table = $table;
    $this->pdo = new PDO($this->dsn,$this->root,$this->password);
  }

  public function all(...$arg){
    $sql = "select * from `$this->table`";

    if(!empty($arg[0]) && is_array($arg[0])){
      foreach ($arg[0] as $key => $value){
        $tmp[] = sprintf("`%s`='%s'",$key,$value);
      }
      $sql = $sql . " where " . implode(" && ",$tmp);
    }
    if(!empty($arg[1])){
      $sql = $sql . $arg[1];
    }
    return $this->pdo->query($sql)->fetchAll();
  }

  public function find($arg){
    $sql = "select * from `$this->table`";
    if(is_array($arg)){
      foreach ($arg as $key => $value){
        $tmp[] = sprintf("`%s`='%s'",$key,$value);
      }
      $sql = $sql . " where " . implode(" && ",$tmp);
    }else{
      $sql = $sql . " where `id` = " . "'" . $arg ."'";
    }
    return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
  }


  public function count(...$arg){
      $sql = "select count(*) from $this->table";
  
      if(!empty($arg[0]) && is_array($arg[0])){
        foreach ($arg[0] as $key => $value){
          $tmp[] = sprintf("`%s`='%s'",$key,$value);
        }
        $sql = $sql . " where " . implode(" && ",$tmp);
      }
      if(!empty($arg[1])){
        $sql = $sql . $arg[1];
      }
      return $this->pdo->query($sql)->fetchColumn();
  }

  public function save($arg){
    if(!empty($arg['id'])){
      foreach($arg as $key=>$value){
        if($key != "id"){
          $tmp[] = sprintf("`%s`='%s'",$key,$value);
        }
      }
      $sql = "update `$this->table` set " . implode(",",$tmp) . " where `id` ='" . $arg['id'] . "'";
    }else{
      $sql = "insert into `$this->table` (`" . implode("`,`",array_keys($arg)) . "`) values ('" . implode("','",$arg) . "')";  
    }
    return $this->pdo->exec($sql);
  }

  public function del($arg){
      $sql = "delect from $this->table";
      if(is_array($arg)){
        foreach ($arg as $key => $value){
          $tmp[] = sprintf("`%s`='%s'",$key,$value);
        }
        $sql = $sql . " where " . implode(" && ",$tmp);
      }else{
        $sql = $sql . " where `id` = " . "'" . $arg ."'";
      }
      return $this->pdo->exec($sql);
  }

  public function q($sql){
    return $this->pdo->query($sql)->fetchAll();
  }

  public function to($url){
    header("location:".$url);
  }
}

  // 判斷瀏覽人次
  $total = new DB('total');
  //先判斷有無今日的資料
  $chk = $total->find(['date'=>date("Y-m-d")]);
  if(empty($chk) && empty($_SESSION['visited'])){
      //沒有今日資料&session是空的(今日第一次拜訪) 要新增今日資料
    $total->save(["date"=>date("Y-m-d"),'total'=>1]);
    $_SESSION['visited'] = 1;
  }elseif(empty($chk) && !empty($_SESSION['visited'])){
      //沒有今日資料但拜訪過了(直接改日期 但瀏覽器沒關 or 電腦沒關放到隔天) 要新增今日資料
    $total->save(["date"=>date("Y-m-d"),'total'=>1]);
  }elseif( !empty($chk) && empty($_SESSION['visited'])){
      //有今天的資料但沒session 表示是新來的 人數要+1
    $chk['total']++;
    $total->save($chk);
    $_SESSION['visited'] = 1;

   }
  // else{
  //   //有今天的資料,也有session->不用做事
 
  // }



?>