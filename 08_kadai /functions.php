<?php


//組み分けを一括で行う関数
function view($result){
    $view100  = "";
    $view100 .= '<p class="like'.$result["book_like"].'">';
    $view100 .= '<a href ="bm_detail.php?id='.$result["id"].'">';
    $view100 .= $result["book_name"];
    $view100 .= '</a>';
    $view100 .= '<a href="bm_like.php?id='.$result["id"].'book_like='.$result["book_like"].'">';
    $view100 .= '<span class="like">［Like］</span>';
    $view100 .= '</a>';
    $view100 .= '<a href="bm_delete.php?id='.$result["id"].'">';
    $view100 .= '<span class="delete">［Delete］</span>';
    $view100 .= '</a>';
    $view100 .= '</p>';
    return $view100;
}

//DB接続関数（PDO）
function db_con(){
  $dbname='gs_db';
  try {
    $pdo = new PDO('mysql:dbname='.$dbname.';charset=utf8;host=localhost','root','');
  } catch (PDOException $e) {
    exit('DbConnectError:'.$e->getMessage());
  }
  return $pdo;
}

//SQL処理エラー
function queryError($stmt){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}

/**
* XSS
* @Param:  $str(string) 表示する文字列
* @Return: (string)     サニタイジングした文字列
*/
function h($str){
  return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
}

?>