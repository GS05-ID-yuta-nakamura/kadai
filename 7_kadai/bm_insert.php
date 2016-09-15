<?php
//1. POSTデータ取得
$bookname   = $_POST["bookname"];
$url  = $_POST["url"];
$comment = $_POST["comment"];
$score  = $_POST["score"];
$bookstatus  = $_POST["status"];
$best  = $_POST["best"];

//2. DB接続します
//全コピーしてアドレス部分だけ書き換えていく
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}


//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_bm_table(id, book_name, book_url, book_comment, book_score, status, best_phrase,
indate )VALUES(NULL, :a1, :a2, :a3, :a4, :a5, :a6,sysdate())");
$stmt->bindValue(':a1', $bookname, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a2', $url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a3', $comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a4', $score, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a5', $bookstatus, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a6', $best, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}else{

//header location のコロンの後は半角スペース
//５．index.phpへリダイレクト
  header("Location: bm_insert_view.php");
  exit;

}
?>