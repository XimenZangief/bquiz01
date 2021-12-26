<?php

date_default_timezone_set("Asia/Taipei");
session_start();

class DB{
  protected $dsn="mysql:host=localhostl;charset=utf8;dbname=bquiz01";
  protected $user="admin";
  protected $pwd="1234";
  protected $table;
  protected $pdo;

  public function __construct($table){
    $this->table=$table;
    $this->pdo=new PDO ($this->dsn, $this->user, $this->pwd);
  }
  
  public function find($id){
  $sql= "SELECT * from $this->table where ";
  
  if(is_array($id)){
    foreach ($id as $key => $value) {
      $tmp[]="`$key`='$value'";
    }

    $sql .= implode(" AND ",$tmp);
  }else{
    $sql .= "`id`='$id'";
  }

  return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
  }
}

public function all(...$arg){
  $sql=" SELECT * from $this->table ";

  switch(count($arg)){
    case 2:
      foreach ($arg[0] as $key => $value) {
        $tmp[]="`$key`='$value'";
      }
  
      $sql .= " where ".implode(" AND ",$tmp)." ". $arg[1];
      break;
    case 1:
      if(is_array($arg[0])){
        foreach ($arg[0] as $key => $value) {
          $tmp[]="`$key`='$value'";
        }
    
        $sql .= implode(" AND ",$tmp);
      }else{
        $sql .=$arg[1];
      }
      break;
  }
  return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

}

function to($url){
  header("location:".$url);
}

?>